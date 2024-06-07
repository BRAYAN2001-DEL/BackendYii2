<?php

namespace app\models;

use yii\mongodb\ActiveRecord;

class Libro extends ActiveRecord
{
    public static function collectionName()
    {
        return 'libros';
    }

    public function attributes()
    {
        return ['titulo', 'autores', 'anio_publicacion', 'genero', 'descripcion', 'isbn'];
    }

    public function getAutores()
    {
        return $this->hasMany(Autor::className(), ['_id' => 'autor_id']);
    }

    public function rules()
{
    return [
        [['titulo', 'autores', 'anio_publicacion', 'genero', 'descripcion', 'isbn'], 'required'],
        [['anio_publicacion'], 'integer'],
        [['descripcion'], 'string'],
        [['titulo', 'genero'], 'string', 'max' => 255],
        [['isbn'], 'string', 'max' => 20],
    ];
}

}
