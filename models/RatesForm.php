<?php

namespace app\models;

use yii\base\Model;

class RatesForm extends Model
{
    public $value;
    public $dateStart;
    public $dateEnd;

    public function attributeLabels()
    {
        return ['value' => 'Евро', 'dateStart' => 'Дата начала'];
    }

    public function rules(){
        return [
            [['value', 'dateStart'], 'required'],
            [['value', 'dateStart', 'dateEnd'], 'safe']
        ];
    }
}