<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use app\models\Subcategory;
use app\models\Category;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    </head>
    <body>
            <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => '<i class="fa fa-home"></i> SolCity',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-fixed-top solcity-menu',
                ],
            ]);

            if (Yii::$app->user->isGuest) {
                $categories = Category::find()->all();
                $items = array();
                foreach ($categories as $category) {
                    $items[] = array(
                        'label' => $category->name,
                        'url' => 'index.php?r=category/view&id=' . $category->categoryId,
                    );
                    $subcategories = Subcategory::findAll(array('categoryId' => $category->categoryId));
                    if (count($subcategories) > 0) {
                        $items[count($items) - 1]['items'] = array();
                        foreach ($subcategories as $subcategory) {
                            $items[count($items) - 1]['items'][] = array(
                                'label' => $subcategory->name,
                                'url' => 'index.php?r=sub-category/view&id=' . $subcategory->subCategoryId,
                            );
                        }
                    }
                }
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar'],
                    'items' => $items,
                ]);
            } else {
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar'],
                    'items' => [
                        ['label' => 'Neuen Artikel erfassen', 'url' => 'index.php?r=article/create'],
                        ['label' => 'RSS Feeds verwalten', 'url' => 'index.php?r=webcrawler/index'],
                        ['label' => 'RSS Import Status', 'url' => 'index.php?r=webcrawler/report'],
                        ['label' => 'RSS-Artikel freigeben', 'url' => 'index.php?r=webcrawler/confirm'],
                    ],
                ]);
            }

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    Yii::$app->user->isGuest ? [
                        'label' => '<i class="fa fa-sign-in fa-lg"></i>',
                        'url' => ['/site/login'],
                            ] : [
                        'label' => '<i class="fa fa-sign-out fa-lg"></i>',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']
                            ],
                ],
                'encodeLabels' => false,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; SolCity  <?= date('Y') ?></p>
                <p class="pull-right"></p>
            </div>
        </footer>

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
