<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
?>
<div class="body-content">
<h1>Курсы</h1>
    <div class="row">
        <div class="col-lg-4">
        <? $form = ActiveForm::begin();
            echo $form->field($model, 'value')->textInput();
        echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'dateStart',
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'class' => 'form-control'
        ]);
        echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'dateEnd',
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'class' => 'form-control'
        ]);
        ?>
            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <? ActiveForm::end();?>
        </div>
        <? if(count($rates)){?>
        <div class="col-lg-4">
            <h1>Результат:</h1>
            <? foreach ($rates as $k => $v){?>
            <p><?=$k?> : <?=$v?>$</p>
            <?}?>
        </div>
        <?}?>
    </div>

</div>

