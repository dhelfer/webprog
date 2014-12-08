<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use \app\models\Article;
use \app\models\Category;
use \app\models\Subcategory;

class SiteController extends Controller {

    public function behaviors() {
        //allow all:        index
        //allow guest:      login
        //allow logged in:  logout
        //deny all:         contact|about
        return [
            [
                'class' => AccessControl::className(),
                'only' => ['index', 'login', 'logout', 'contact', 'about'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['contact', 'about'],
                        'allow' => false,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($category = null, $subcategory = null) {
        if (!is_null($category)) {
            $selectedCategory = Category::findOne(['categoryId' => $category]);
            if ($selectedCategory) {
                $articles = Article::find()->where(['categoryId' => $selectedCategory->categoryId])->all();
            } else {
                return $this->render('error', ['name' => 'Ein Fehler ist aufgetreten', 'message' => 'Die angegebene Kategorie ist ungültig']);
            }
        } elseif (!is_null($subcategory)) {
            $selectedCategory = Subcategory::findOne(['subCategoryId' => $subcategory]);
            if ($selectedCategory) {
                $articles = Article::find()->where(['subCategoryId' => $selectedCategory->subCategoryId])->all();
            } else {
                return $this->render('error', ['name' => 'Ein Fehler ist aufgetreten', 'message' => 'Die angegebene Subkategorie ist ungültig']);
            }
        } else {
            $articles = Article::find()->where(['released' => '1'])->all();
        }
        
        return $this->render('index', ['articles' => $articles]);
    }

    public function actionLogin($user = null) {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $model->username = $user;
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->redirect(['site/index']);
        } else {
            return $this->render('login', ['model' => $model]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

}
