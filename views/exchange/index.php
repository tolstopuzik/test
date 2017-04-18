<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="body-content">
<h1>Загрузка курсов</h1>
    <div class="row">
        <div class="col-lg-4">
        <? $form = ActiveForm::begin();
            echo $form->field($model, 'csvFile')->fileInput();
        ?>
            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <? ActiveForm::end();?>
        </div>
    </div>

</div>

