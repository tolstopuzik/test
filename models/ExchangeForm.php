<?php

namespace app\models;
use yii\web\UploadedFile;
use yii\base\Model;

class ExchangeForm extends Model
{
    public $csvFile;

    public function rules()
    {
        return [
            [['csvFile'], 'file', 'skipOnEmpty' => false, /*'extensions' => ['csv']*/],
        ];
    }

    public function upload()
    {
        if ( $this->validate() ) {
            $this->csvFile->saveAs('uploads/' . $this->csvFile->baseName . '.' . $this->csvFile->extension);
            return $this->csvFile->baseName . '.' . $this->csvFile->extension;
        } else {
            return false;
        }
    }

}