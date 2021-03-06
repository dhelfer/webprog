<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\helpers\Html;
use \app\models\Image;
use \yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

    public function behaviors() {
        //allow all:        View
        //allow guest:      Create|Activate|Reset
        //allow logged in:  Update|Updateimage|Updateimageconfirm
        //deny all:         Index|Delete
        return [
            [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['view', 'create', 'activate', 'reset', 'update', 'updateimage', 'updateimageconfirm', 'index', 'delete'],
                'rules' => [
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions' => ['create', 'activate', 'reset'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['update', 'updateimage', 'updateimageconfirm'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'delete'],
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->userId]);
            
            $messageLines = Yii::$app->params['mail']['message'];
            $messageLines[1] = str_replace('{activationkey}', $model->activationKey, str_replace('{username}', $model->userName, $messageLines[1]));
            
            $activationMailSent = Yii::$app->mailer->compose()
                ->setTo($model->email)
                ->setFrom([Yii::$app->params['mail']['fromAddress'] => Yii::$app->params['mail']['fromName']])
                ->setSubject(Yii::$app->params['mail']['subject'])
                ->setTextBody($messageLines[0] . ': ' . $messageLines[1])
                ->setHtmlBody($messageLines[0] . '<br><a href="' . $messageLines[1] . '">' . $messageLines[1] . '</a>')
                ->send();
            
            return $this->render('activate', ['activationMailSent' => $activationMailSent]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->userId]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionActivate($user, $activationkey) {
        $userObject = User::findByUsernameAndActive($user, 0);
        if ($userObject) {
            if ($userObject->activationKey === $activationkey) {
                if ($userObject->activate()) {
                    return $this->render('activate', ['activationDone' => true, 'user' => $user]);
                } else {
                    return $this->render('activate', ['activationDone' => false]);
                }
            } else {
                return $this->render('activate', ['activationDone' => false]);
            }
        } else {
            return $this->render('../site/error', ['name' => 'Account-Aktivierung', 'message' => 'Benutzer konnte nicht gefunden werden.']);
        }
    }
    
    public function actionReset($user = null, $passwordResetKey = null) {
        if (Yii::$app->getRequest()->isPost) {
            $post = Yii::$app->getRequest()->post('User');
            
            if (isset($post['passwordResetKeyCheck'])) {
                $userObject = User::findOne($post['userId']);
                if ($userObject) {
                    if ($userObject->passwordResetKey === $post['passwordResetKeyCheck']) {
                        $userObject->password = $post['password'];
                        $userObject->saltPassword();
                        if ($userObject->save(false)) {
                            return $this->render('resetted', ['message' => '<p>Ihr Password wurde erfolgreich geändert.</p>' . Html::a('Login', 'index.php?r=site/login&user=' . $userObject->userName)]);
                        } else {
                            return $this->render('resetted', ['message' => 'Interner Server Error.']);
                        }
                    } else {
                        return $this->render('resetted', ['message' => 'Der Resetcode ist falsch oder abgelaufen..']);
                    }
                } else {
                    return $this->render('../site/error', ['name' => 'Passwort zurücksetzen', 'message' => 'Benutzer konnte nicht gefunden werden.']);
                }
            } else {
                if (isset($post['userName'])) {
                    $userObject = User::findByUsername($post['userName']);
                    if ($userObject) {
                        $userObject->passwordResetKey = $userObject->createKey();
                        $userObject->activationKey = \yii\db\Expression::className('null');

                        if ($userObject->save(false)) {
                            $messageLines = Yii::$app->params['mail']['resetMessage'];
                            $messageLines[1] = str_replace('{passwordResetKey}', $userObject->passwordResetKey, str_replace('{username}', $userObject->userName, $messageLines[1]));

                            $activationMailSent = Yii::$app->mailer->compose()
                                ->setTo($userObject->email)
                                ->setFrom([Yii::$app->params['mail']['fromAddress'] => Yii::$app->params['mail']['fromName']])
                                ->setSubject(Yii::$app->params['mail']['resetSubject'])
                                ->setTextBody($messageLines[0] . ': ' . $messageLines[1])
                                ->setHtmlBody($messageLines[0] . '<br><a href="' . $messageLines[1] . '">' . $messageLines[1] . '</a>')
                                ->send();

                            if ($activationMailSent) {
                                return $this->render('resetted', ['message' => 'Eine Email mit einem Link, um Ihr Passwort zurückzusetzen, wurde an Sie versandt.']);
                            } else {
                                return $this->render('resetted', ['message' => 'Die Email mit einem Link, um Ihr Passwort zurückzusetzen, konnte nicht versandt werden.']);
                            }
                        } else {
                            return $this->render('resetted', ['message' => 'Interner Server Error.']);
                        }
                    } else {
                        return $this->render('../site/error', ['name' => 'Passwort zurücksetzen', 'message' => 'Benutzer konnte nicht gefunden werden.']);
                    }
                }
            }
        } else {
            if (!is_null($user) && !is_null($passwordResetKey)) {
                $userObject = User::findByUsername($user);
                if ($userObject->passwordResetKey === $passwordResetKey) {
                    $userObject->password = null;
                    return $this->render('reset', ['model' => $userObject, 'passwordResetKey' => $passwordResetKey]);
                } else {
                    return $this->render('reset');
                }
            } else {
                return $this->render('reset');
            }
        }
    }
    
    public function actionUpdateimage($id = null) {
        if (Yii::$app->request->isPost ) {
            $post = Yii::$app->request->post();
            
            if (!isset($post['User']['userId'])) {
                die('Keine User-Id definiert.');
            }
            $model = User::findOne($post['User']['userId']);
            
            if (isset($post['cancel'])) {
                if (!isset($model)) {
                    die('Keine User-Id definiert.');
                }
                return $this->render('view', ['model' => $model]);
            }
            
            $image = new Image;
            $model->file = UploadedFile::getInstance($model, 'file');
            $image->physicalPath = time() . $model->file->baseName . '.' . $model->file->extension;
            if ($image->save()) {
                $model->imageId = $image->imageId;
                if(file_exists($model->file->tempName)) {
                    $model->password2 = '***';
                    $model->accessToken = '***';
                    $model->activationKey = '***';
                    
                    if ($model->save(false)) {
                        if ($model->file->saveAs(Yii::$app->params['resources']['path']['temp-upload'] . $image->physicalPath)) {
                            if (file_exists(Yii::$app->params['resources']['path']['temp-upload'] . $image->physicalPath)) {
                                if ($image->crop(
                                    Yii::$app->params['user']['avatarImage']['aspectRatio'],
                                    Yii::$app->params['resources']['path']['user-avatar-images'])) {
                                    return $this->render('updateimage2', ['model' => $model]);
                                }
                            }
                        }
                    }
                    return $this->render('updateimage1', ['model' => $model]);
                }
            }
        } else {
            if (is_null($id)) {
                die('Keine User-Id definiert.');
            }
            return $this->render('updateimage1', ['model' => $this->findModel($id)]);
        }
    }
    
    public function actionUpdateimageconfirm() {
        if (Yii::$app->request->isPost ) {
            $post = Yii::$app->request->post();
            
            if (!isset($post['User']['userId'])) {
                die('Keine User-Id definiert.');
            }
            $model = User::findOne($post['User']['userId']);
            
            if (isset($post['cancel'])) {
                if (!isset($model)) {
                    die('Keine User-Id definiert.');
                }
                return $this->render('updateimage1', ['model' => $model]);
            }
            
            return $this->redirect(['view', 'id' => $model->userId]);
        }
    }
}
