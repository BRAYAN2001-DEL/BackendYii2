<?php

namespace app\models;

use yii\mongodb\ActiveRecord;

class Usuario extends ActiveRecord
{
    public static function collectionName()
    {
        return 'usuario'; // Nombre de tu colección en MongoDB
    }

    public function attributes()
    {
        return ['nombre', 'apellido']; // Atributos de tu modelo
    }
}
