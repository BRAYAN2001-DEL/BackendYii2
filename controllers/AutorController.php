<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Autor;

class AutorController extends ActiveController
{
    public $modelClass = 'app\models\Autor';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['view']);
        return $actions;
    }

    // GET /autor
    public function actionIndex($nacionalidad = null)
    {
        $query = Autor::find();

        if ($nacionalidad) {
            $query->andWhere(['nacionalidad' => $nacionalidad]);
        }

        return $query->all();
    }

    // GET /autor/{id}
    public function actionView($id)
    {
        $autor = Autor::findOne($id);
        $autor->libros; // Cargar relaciones de libros
        return $autor;
    }
    
    // POST /autor
    public function actionCreate()
    {
        $model = new Autor();
        $model->load(Yii::$app->request->post(), '');
        
        if ($model->save()) {
            Yii::$app->response->setStatusCode(201);
            return ['status' => 'success', 'data' => $model];
        } else {
            Yii::$app->response->setStatusCode(422);
            return ['status' => 'error', 'data' => $model->getErrors()];
        }
    }
    
    // PUT /autor/{id}
    public function actionUpdate($id)
    {
        $model = Autor::findOne($id);
        $model->load(Yii::$app->request->getBodyParams(), '');
        
        if ($model->save()) {
            return ['status' => 'success', 'data' => $model];
        } else {
            Yii::$app->response->setStatusCode(422);
            return ['status' => 'error', 'data' => $model->getErrors()];
        }
    }
    
    // DELETE /autor/{id}
    public function actionDelete($id)
    {
        $model = Autor::findOne($id);
        if ($model->delete()) {
            return ['status' => 'success', 'message' => 'Autor eliminado exitosamente.'];
        } else {
            Yii::$app->response->setStatusCode(422);
            return ['status' => 'error', 'message' => 'Error al eliminar el autor.'];
        }
    }
}
