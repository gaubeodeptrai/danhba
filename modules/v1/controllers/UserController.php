<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\v1\controllers;
use app\models\User;
use yii\rest\ActiveController;

/**
 * Description of UserController
 *
 * @author AnhVu
 */
class UserController extends ActiveController {
    public $modelClass = 'app\models\User';
    
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
          'class' => \yii\filters\auth\HttpBasicAuth::className(),
          'auth' => function ($username, $password){
            $user = User::findByUsername($username);
            if ($user && $user->validate($password)){
                return $user;
            }
          }
          ];
          return $behaviors;   
    }
    
    public function actions()
    {
     $actions = parent::actions();
     unset($actions['view'], $actions['update']);
     return $actions;
    }
    public function actionView($id)
    {
     if ($id == Yii::$app->user->getId()) {
        return User::findOne($id);
     }
     throw new ForbiddenHttpException;
    }
    
    public function actionUpdate($id){
        if (!\Yii::$app->request->isPut){
            return new HttpRequestMethodException();
        }
        $user = User::findIdentity($id);
        if (\Yii::$app->request->post('password')!==''){
            $user->setPassword(\Yii::$app->request->post('password'));
        }
        return $user->save;
    } 
}
