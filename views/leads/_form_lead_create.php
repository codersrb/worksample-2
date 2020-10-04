<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Contacts;

/* @var $this yii\web\View */
/* @var $model app\models\Leads */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leads-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'fkContactID')->widget(Select2::classname(), [
        'data' => Contacts::find()->select(['contactPersonFullName'])->joinWith('contactPersons')->indexBy('pkContactID')->column(),
        'options' => ['placeholder' => 'Select a contact ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
