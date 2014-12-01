<?php

namespace app\controllers;

use Yii;
use app\models\Article;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Comment;
use \app\models\ArticlePreview;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller {

    public function behaviors() {
        return [
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
            $model->released = true;
            
            if (!empty($id)) {
                $preview = ArticlePreview::findOne($id);
                $model->title = $preview->title;
                $model->article = $preview->article;
            }
            
            if ($model->load($post)) {
                if (strpos($model->categoryValue, 'SubCategory') === 0) {
                    $model->subCategoryId = str_replace('SubCategory', '', $model->categoryValue);
                } else if (strpos($model->categoryValue, 'Category') === 0) {
                    $model->categoryId = str_replace('Category', '', $model->categoryValue);
                } else {
                    return $this->render('create', ['model' => $model]);
                }

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->articleId]);
                }
            } else {
                return $this->render('create', ['model' => $model]);
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
}
