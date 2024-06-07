<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Usuario;

class UsuarioController extends ActiveController
{
    public $modelClass = 'app\models\Usuario'; // Clase de modelo a utilizar

    public function actionCreate()
    {
        $model = new Usuario();
        $model->load(Yii::$app->request->getBodyParams(), '');
        
        if ($model->save()) {
            Yii::$app->response->setStatusCode(201);
            return ['status' => 'success', 'data' => $model];
        } else {
            Yii::$app->response->setStatusCode(422);
            return ['status' => 'error', 'data' => $model->getErrors()];
        }
    }
}
