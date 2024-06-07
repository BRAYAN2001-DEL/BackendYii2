<?php

namespace app\models;

use yii\mongodb\ActiveRecord;

class Autor extends ActiveRecord
{
    public static function collectionName()
    {
        return 'autores';
    }

    public function attributes()
    {
        return ['nombre', 'fecha_nacimiento', 'nacionalidad', 'biografia', 'libros_publicados'];
    }

    public function getLibros()
    {
        return $this->hasMany(Libro::className(), ['_id' => 'libro_id']);
    }
}
