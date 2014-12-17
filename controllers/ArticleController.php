<?php

namespace app\controllers;

use \Yii;
use app\models\Article;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Comment;
use \app\models\ArticlePreview;
use app\models\Image;
use \yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller {
    public function behaviors() {
        //allow all:        View
        //allow logged in:  Create|Createuploadimage|Createadjustimage|Comment|Uploadheaderimage
        //deny all:         Index|Update|Delete
        return [
            [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['view', 'create', 'createuploadimage', 'createadjustimage', 'Comment', 'Uploadheaderimage', 'index', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions' => ['create', 'createuploadimage', 'createadjustimage', 'Comment', 'Uploadheaderimage'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'update', 'delete'],
                        'allow' => false,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null) {
        $post = Yii::$app->request->post();
        if (isset($post['article_preview'])) {
            if (!empty($id)) {
                $model = ArticlePreview::findOne($id);
            } else {
                $model = new ArticlePreview();
            }
            $model->title = $post['Article']['title'];
            $model->article = $post['Article']['article'];
            $model->userId = Yii::$app->user->identity->userId;
            if ($model->save()) {
                return $this->render('preview', ['model' => $model]);
            }
        } else {
            $model = new Article();
            $model->userId = Yii::$app->user->identity->userId;
            
            if (!empty($id)) {
                $preview = ArticlePreview::findOne($id);
                $model->title = $preview->title;
                $model->article = $preview->article;
            }
            
            if (Yii::$app->request->isPost && $model->load($post)) {
                if (strpos($model->categoryValue, 'SubCategory') === 0) {
                    $model->subCategoryId = str_replace('SubCategory', '', $model->categoryValue);
                } else if (strpos($model->categoryValue, 'Category') === 0) {
                    $model->categoryId = str_replace('Category', '', $model->categoryValue);
                } else {
                    return $this->render('create', ['model' => $model]);
                }
                
                if ($model->save()) {
                    return $this->render('create', ['model' => $model, 'defineHeaderImage' => true]);
                }
            } else {
                return $this->render('create', ['model' => $model]);
            }
        }
    }
    
    public function actionCreateuploadimage() {
        if (Yii::$app->request->isPost ) {
            $post = Yii::$app->request->post();
            
            if (!isset($post['Article']['articleId'])) {
                return $this->render('create', ['model' => new Article]);
            }
            $model = Article::findOne($post['Article']['articleId']);
            
            if (isset($post['cancel'])) {
                if (!isset($model)) {
                    $model = new Article;
                }
                return $this->render('create', ['model' => $model]);
            }
            
            $image = new Image;
            $model->file = UploadedFile::getInstance($model, 'file');
            $image->physicalPath = $model->file->baseName . '.' . $model->file->extension;
            if ($image->save()) {
                $model->teaserImage = $image->imageId;
                if(file_exists($model->file->tempName)) {
                    if ($model->save()) {
                        if ($model->file->saveAs(Yii::$app->params['resources']['path']['temp-upload'] . $image->physicalPath)) {
                            if (file_exists(Yii::$app->params['resources']['path']['temp-upload'] . $image->physicalPath)) {
                                if ($image->crop(
                                        Yii::$app->params['article']['teaserImage']['aspectRatio'],
                                        Yii::$app->params['resources']['path']['article-header-images'])) {
                                    return $this->render('create', ['model' => $model, 'adjustHeaderImage' => true]);
                                }
                            }
                        }
                    }
                }
            }
            return $this->render('create', ['model' => $model, 'defineHeaderImage' => true]);
        }
    }
    
    public function actionCreateadjustimage() {
        if (Yii::$app->request->isPost ) {
            $post = Yii::$app->request->post();
            
            if (!isset($post['Article']['articleId'])) {
                return $this->render('create', ['model' => new Article]);
            }
            $model = Article::findOne($post['Article']['articleId']);
            
            if (isset($post['cancel'])) {
                if (!isset($model)) {
                    $model = new Article;
                }
                return $this->render('create', ['model' => $model, 'defineHeaderImage' => true]);
            }
            
            $model->released = true;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->articleId]);
            }
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->articleId]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionComment() {
        if (!empty(Yii::$app->request->post('Comment'))) {
            $model = new Comment();
            if (!$model->load(Yii::$app->request->post()) || !$model->save()) {
                return $this->redirect([
                    'view',
                    'id' => $model->articleId,
                    'newComment' => $model,
                ]);
            }
        }
        return $this->redirect(['view', 'id' => $model->articleId]);
    }
    
    public function actionUploadheaderimage() {
        $model = new Image;
        
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            
            $model->physicalPath = 'uploads/' . $model->file->baseName . '.' . $model->file->extension;
            if ($model->validate()) {                
                $model->file->saveAs($model->physicalPath);
            }
        }
    }
}
