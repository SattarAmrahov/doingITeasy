<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\Locations;

/* @var $this yii\web\View */
/* @var $model backend\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip_code')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Locations::find()->all(), 'location_id', 'zip_code'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Zip Code', 'id' => 'zipCode'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS

$("#zipCode").change(function(){
	var locationID = $(this).val();
	$.get('index.php?r=locations/get-city-district', {locationID : locationID}, function(data){
		var data = $.parseJSON(data);
		$('#customers-city').attr('value', data.city);
		$('#customers-district').attr('value', data.district);
	});
});

JS;
$this->registerJs($script);
?>