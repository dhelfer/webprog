<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\models\Article;
use \app\models\Webcrawler;
use \app\models\User;
use \app\commands\WebCrawlerCmdController;

class WebcrawlerController extends \yii\web\Controller {
    public function actionImport() {
        $states = WebCrawlerCmdController::import();
        return $this->render('import_state', [
            'states' => $states,
        ]);
    }

    public function actionConfirm() {
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find()->where(['userId' => User::find()->where("username = 'SOLCITY_RSS_CRAWLER'")->one()->userId, 'released' => 0]),
        ]);

        return $this->render('confirm', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Webcrawler::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRelease($id) {
        if (Article::find()->where('articleId = :articleId', ['articleId' => $id])->one()->release()) {
            return $this->redirect(['confirm']);
        } else {
            //die('asdf');
        }
    }
    
    /**
     * Creates a new Webcrawler model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Webcrawler();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Updates an existing Webcrawler model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Deletes an existing Webcrawler model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Finds the Webcrawler model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Webcrawler the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Webcrawler::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
