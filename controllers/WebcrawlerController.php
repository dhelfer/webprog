<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\models\Article;
use \app\models\Webcrawler;
use \app\models\User;
use \solcity\rssparser\Importer;
use \app\models\WebcrawlerImportLog;
use \yii\grid\GridView;

class WebcrawlerController extends \yii\web\Controller {
    public function actionImport() {
        $state = Importer::widget(['options' => ['action' => 'import']]);
        $this->redirect('index.php?r=webcrawler/report');
    }

    public function actionConfirm() {
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find()->where(['userId' => User::find()->where("username = '" . Yii::$app->params['rssimport']['user'] . "'")->one()->userId, 'released' => 0]),
            'pagination' => [
                'pageSize' => Yii::$app->params['standard']['pagination']['pageSize'],
            ]
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
        if (Article::findOne($id)->release()) {
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
    
    public function actionReport() {
        return $this->render('import_state');
    }
    
    public function actionDetaillog() {
        if (!is_null(Yii::$app->request->post('runNumber'))) {
            return GridView::widget([
                'dataProvider' => new ActiveDataProvider([
                    'query' => WebcrawlerImportLog::find()->where(['runNumber' => Yii::$app->request->post('runNumber')]),
                    'pagination' => false,
                ]),
                'layout' => "{items}",
                'columns' => [
                    'state:html',
                    'runNumber',
                    'executionTime',
                    'articleId',
                    'article.originLink:url',
                    'message',
                ],
            ]);
        } else {
            return '';
        }
    }
    
    public function actionDeletearticle($id) {
        $logs = WebcrawlerImportLog::find()->where(['articleId' => $id])->all();
        foreach ($logs as $log) {
            $log->delete();
        }
        
        Article::findOne($id)->delete();
        return $this->redirect(['confirm']);
    }
}
