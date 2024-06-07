<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Libro;

class LibroController extends ActiveController
{
    public $modelClass = 'app\models\Libro';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['view']);
        return $actions;
        //process
    }

    // GET /libro
    public function actionIndex($genero = null, $autor = null, $anio = null)
    {
        $query = Libro::find();

        if ($genero) {
            $query->andWhere(['genero' => $genero]);
        }

        if ($autor) {
            $query->andWhere(['autores' => $autor]);
        }

        if ($anio) {
            $query->andWhere(['anio_publicacion' => $anio]);
        }

        return $query->all();
    }

    // GET /libro/{id}
    public function actionView($id)
    {
        $libro = Libro::findOne($id);
        $libro->autores; // Cargar relaciones de autores
        return $libro;
    }
    
    // POST /libro
    public function actionCreate()
    {
        $model = new Libro();
        $model->load(Yii::$app->request->post(), '');
        
        if ($model->save()) {
            Yii::$app->response->setStatusCode(201);
            return ['status' => 'success', 'data' => $model];
        } else {
            Yii::$app->response->setStatusCode(422);
            return ['status' => 'error', 'data' => $model->getErrors()];
        }
    }
    
    // PUT /libro/{id}
    public function actionUpdate($id)
    {
        $model = Libro::findOne($id);
        $model->load(Yii::$app->request->getBodyParams(), '');
        
        if ($model->save()) {
            return ['status' => 'success', 'data' => $model];
        } else {
            Yii::$app->response->setStatusCode(422);
            return ['status' => 'error', 'data' => $model->getErrors()];
        }
    }
    
    // DELETE /libro/{id}
    public function actionDelete($id)
    {
        $model = Libro::findOne($id);
        if ($model->delete()) {
            return ['status' => 'success', 'message' => 'Libro eliminado exitosamente.'];
        } else {
            Yii::$app->response->setStatusCode(422);
            return ['status' => 'error', 'message' => 'Error al eliminar el libro.'];
        }
    }
}
