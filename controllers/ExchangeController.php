<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models as M;
use yii\web\UploadedFile;
use app\extensions as E;

class ExchangeController extends Controller
{
    public function beforeAction($action){
        if(Yii::$app->controller->action->id == 'getrates'){
            $this->enableCsrfValidation = false;
        }
        return true;
    }
    public function actionIndex(){
        $model = new M\ExchangeForm();
        if (Yii::$app->request->isPost) {
            $model->csvFile = UploadedFile::getInstance($model, 'csvFile');
            if( $file = $model->upload() )
                $this->setRates($file);
        }

        return $this->render('index', ['model' => $model]);
    }

    public function actionRates(){
        $model = new M\RatesForm();
        $rates = [];
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            if($model->load(Yii::$app->request->post()) && $model->validate()) {
                $exchange = new E\Exchange();
                $rates = $exchange->getRates($model->value, $model->dateStart, $model->dateEnd);
            }
        }
        return $this->render('rates', ['model' => $model, 'rates' => $rates ]);
    }

    protected function setRates( $filename ) {
        $file = yii::$app->basePath.'/web/uploads/'. $filename;

        if( is_file( $file )){
            $f = fopen($file, 'a+');
            while( $row = fgetcsv($f) ){
                $model = new M\Exchange();
                $model->date = date('Y-m-d', strtotime($row[0]));
                $model->rate = (float)$row[1];
                if( $model->validate() )
                    $model->save();
            }
        } else
            return false;
    }

    public function actionGetrates(){
        header('Content-Type: application/json');
        $request = Yii::$app->request;

        if ($request->isPost) {
            $json = file_get_contents("php://input");
            $data = json_decode($json);
            if( $data ) {
                $exchange = new E\Exchange();
                if (!empty($data->interval))
                    die(json_encode($exchange->getRates($data->value, $data->dateStart, $data->dateEnd),JSON_UNESCAPED_UNICODE));
                else
                    die(json_encode($exchange->getRates($data->value, $data->date), JSON_UNESCAPED_UNICODE));
            }
        }
        die(json_encode(['status'=>'error'], JSON_UNESCAPED_UNICODE));
    }

}