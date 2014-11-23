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
        $state = Importer::widget([
            'options' => [
                'action' => 'import',
                'json' => true,
            ]
        ]);
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
    
    public function actionFeeditemstructure() {
        if (!empty(Yii::$app->request->post('feedUrl'))) {
            try {
                $item = Importer::widget([
                    'options' => [
                        'action' => 'getItemStructure',
                        'url' => Yii::$app->request->post('feedUrl'),
                        'json' => true
                    ]
                ]);

                $articleAttributes = Article::rssRelevantAttributes();
                $htmlAA = '<table class="table-feeditemstructure"><tr>';
                foreach ($articleAttributes as $articleAttribute) {
                    $htmlAA .= '<td><div id="' . $articleAttribute . '" ondrop="drop(event)" ondragover="allowDrop(event)">' . $articleAttribute . '</div></td>';
                }
                $htmlAA .= '</tr></table>';

                $itemAttributes = json_decode($item, true);
                $htmlIA = '<table class="table-feeditemstructure table-feeditemstructure-draggable"><tr>';
                foreach ($itemAttributes as $itemAttribute) {
                    $htmlIA .= '<td><div id="' . $itemAttribute . '" draggable="true" ondragstart="drag(event)">' . $itemAttribute . '</div></td>';
                }
                $htmlIA .= '</tr></table>';

                $default = '<b>Default Mapping:</b><br>';
                $default .= 'article->title = rss->title<br>';
                $default .= 'article->article = rss->description<br>';
                $default .= 'article->originLink = rss->link<br><br>';

                return '<div class="panel panel-default"><div class="panel-body">' . $default . '<br><p><b>Artikel-Attribute</b></p>' . $htmlAA . '<p><b>RSS-Feed-Attribute</b></p>' . $htmlIA . '</div></div>';
            } catch (Exception $ex) {
                return 'Fehler beim Laden des RSS-Feeds';
            }
        } else {
            return 'Keine RSS-Feed-Url angegeben';
        }
    }
    
    public function actionConfirmall() {
        if (!empty(Yii::$app->request->post('selection'))) {
            $query = Article::find();
            foreach (Yii::$app->request->post('selection') as $id) {
                $query = $query->orWhere(['articleId' => $id]);
            }
            $articles = $query->all();
            foreach ($articles as $article) {
                if (!$article->release()) {
                    echo 'failed to release article: ' . $article->articleId . '<br>';
                    //@todo: log error
                }
            }
        }
        $this->redirect(['confirm']);
    }
    
    public function actionCrawlall() {
        if (!empty(Yii::$app->request->post('selection'))) {
            foreach (Yii::$app->request->post('selection') as $id) {
                $state = Importer::widget([
                    'options' => [
                        'action' => 'import',
                        'json' => true,
                        'webcrawlerId' => $id,
                    ]
                ]);
            }
            $this->redirect(['report']);
        } else {
            $this->redirect(['index']);
        }
    }
}
