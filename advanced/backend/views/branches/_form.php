<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Companies;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Branches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branches-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>


   

    <?= $form->field($model, 'companies_company_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Companies::find()->all(), 'company_id', 'company_name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a company ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive' ], ['prompt' => 'Select Branch Status']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit', function(e){
    var \$form = $(this);
    $.post(
        \$form.attr("action"), \$form.serialize()
    )
    .done( function(result){
        console.log(result);
        if (result == 1) {
            $(\$form).trigger("reset");
            $.pjax.reload({container: '#branchesGrid'})
        } else {
            
            $("#message").html(result);
        }
    })
    .fail(function(){
        console.log("server error");
    });
    return false;
});

JS;
$this->registerJs($script);

?>