<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Exchange extends ActiveRecord
{
    public static function tableName(){
        return 'rates';
    }

    public function rules()
    {
        return [
            [['date', 'rate'], 'required'],
        ];
    }
}