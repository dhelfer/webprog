<?php

namespace app\models;

use \yii\helpers\Html;
use \Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $articleId
 * @property string $title
 * @property string $article
 * @property string $originLink
 * @property integer $userId
 * @property integer $subCategoryId
 * @property integer $released
 * @property integer $categoryId
 * @property integer $teaserImage
 * @property string $dateCreated
 * @property string $dateLastUpdated
 *
 * @property Category $category
 * @property Subcategory $subCategory
 * @property User $user
 * @property Comment[] $comments
 * @property Image[] $images
 * @property WebcrawlerImportLog[] $webcrawlerImportLogs
 * @property Image $headerImage
 */
class Article extends \yii\db\ActiveRecord {
    const ARTICLELEN = 200;

    private $categoryValue;
    public $file;

    public function setCategoryValue($categoryValue) {
        $this->categoryValue = $categoryValue;
    }

    public function getCategoryValue() {
        if (!isset($this->categoryValue)) {
            if (isset($this->categoryId)) {
                $this->categoryValue = 'Category' . $this->categoryId;
            } elseif (isset($this->subCategoryId)) {
                $this->categoryValue = 'SubCategory' . $this->subCategoryId;
            } else {
                $this->categoryValue = null;
            }
        }
        return $this->categoryValue;
    }

    public function getCategoryOrSubCategory() {
        if (isset($this->category)) {
            return $this->category;
        } elseif (isset($this->subCategory)) {
            return $this->subCategory;
        } else {
            return null;
        }
    }

    public static function rssRelevantAttributes() {
        return [
            'title',
            'article',
            'originLink',
            'teaserImage',
            'dateCreated',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'originLink'], 'string'],
            [['userId', 'categoryValue', 'title'], 'required'],
            [['userId', 'subCategoryId', 'released', 'categoryId', 'teaserImage'], 'integer'],
            [['dateCreated', 'dateLastUpdated'], 'safe'],
            [['file'], 'file', 'extensions' => 'jpg, jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'articleId' => 'Article ID',
            'title' => 'Titel',
            'article' => 'Artikel',
            'originLink' => 'Link zum Originalartikel',
            'userId' => 'User ID',
            'subCategoryId' => 'Unterkategorie',
            'released' => 'Released',
            'categoryId' => 'Kategorie',
            'teaserImage' => 'Headerbild',
            'dateCreated' => 'Erstellt am',
            'dateLastUpdated' => 'Zuletzt bearbeitet am',
            'categoryValue' => 'Kategorie',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(Category::className(), ['categoryId' => 'categoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategory() {
        return $this->hasOne(Subcategory::className(), ['subCategoryId' => 'subCategoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments() {
        return $this->hasMany(Comment::className(), ['articleId' => 'articleId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages() {
        return $this->hasMany(Image::className(), ['articleId' => 'articleId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebcrawlerImportLogs() {
        return $this->hasMany(WebcrawlerImportLog::className(), ['articleId' => 'articleId']);
    }

    public function release() {
        $this->released = 1;
        return $this->save();
    }

    public function getReleaseLink() {
        return Html::a('<i class="fa fa-check-circle fa-2x green"></i>', 'index.php?r=webcrawler/release&id=' . $this->articleId, ['class' => 'icon-animated']);
    }

    public function getShortArticle() {
        $pos = strlen($this->article);
        if ($pos >= self::ARTICLELEN) {
            if (!empty(strpos($this->article, " ", self::ARTICLELEN))) {
                $pos = strpos($this->article, " ", self::ARTICLELEN);
            }
        }

        return substr($this->article, 0, $pos);
    }

//    public function showReadMore() {
//        return strlen($this->article) > self::ARTICLELEN || !empty($this->originLink);
//    }

    public function findDuplicateByOriginlink() {
        return Article::find()->where(['originLink' => $this->originLink])->one();
    }

    public function buildOriginLinkAsHtml($text, $options = []) {
        return Html::a($text, $this->originLink, $options);
    }

    public function buildArticleDetailLinkAsHtml($text, $options = []) {
        return Html::a($text, 'index.php?r=article/view&id=' . $this->articleId, $options);
    }

    public function findPrimaryCategorieValueChoice() {
        if (is_null($this->getCategoryValue())) {
            //get most used category from user with awesome select statement
            /*
              select		count(articleId) as articleCount, concat('Category', cast(ifnull(categoryId, 0) as char)) as category
              from		sc_article
              where		userId = 1
              group by	categoryId
              union
              select		count(articleId) as articleCount, concat('SubCategory', cast(ifnull(subCategoryId, 0) as char)) as category
              from		sc_article
              where		userId = 1
              group by	subCategoryId
              order by	articleCount desc
             */
            $lastArticle = Article::find()->where(['userId' => \Yii::$app->user->id])->orderBy('dateCreated DESC')->one();
            if ($lastArticle) {
                return $lastArticle->getCategoryValue();
            } else {
                return null;
            }
        } else {
            return $this->categoryValue;
        }
    }

    public function getTeaserImage() {
        if (!empty($this->teaserImage)) {
            $image = Image::findOne($this->teaserImage);
            if ($image) {
                return $image->physicalPath;
            } else {
                return \Yii::$app->params['resources']['default']['article']['teaser_image'];
            }
        } else {
            return \Yii::$app->params['resources']['default']['article']['teaser_image'];
        }
    }

    public function getViewDetailLink() {
        if (!empty($this->originLink)) {
            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $this->originLink, ['class' => 'icon-animated', 'target' => '_blank']);
        } else {
            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'index.php?r=article/view&id=' . $this->articleId, ['class' => 'icon-animated']);
        }
    }

    public function getUpdateLink() {
        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'index.php?r=article/update&id=' . $this->articleId, ['class' => 'icon-animated']);
    }

    public function getHeaderImage() {
        return $this->hasOne(Image::className(), ['imageId' => 'teaserImage']);
    }
    
    public function getDateCreatedFormatted() {
        return Yii::$app->formatter->asDatetime($this->dateCreated, 'php:d.m.Y H:i');
    }
}
