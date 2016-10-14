<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
use Yii;
use yii\rest\ActiveController;
//use app\models\Todo;

/**
 * Description of TodoController
 *
 * @author AnhVu
 */
class TodoController extends ActiveController{
    //put your code here
    public $modelClass = 'app\models\Todo';
    
   
    
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        unset($actions['index']);
        return $actions;
    }
    
    /* Declare methods supported by APIs */
    protected function verbs(){
        return [
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH','POST'],
            'delete' => ['DELETE'],
            'view' => ['GET'],
            'index'=>['GET'],
        ];
    }
    
    public function actionIndex($count = 10){
        return \app\models\Todo::find()->all();
    }
    
    public function actionView($id){
        return \app\models\Todo::findOne($id);
    }
    
    public function actionCreate(){
        $model = new \app\models\Todo();
        $model->load(\yii::$app->request->get(),'');
        $model->status = 1;
        $model->save();
        return $model;
    }
}
