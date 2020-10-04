<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Modules;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userTempPassword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userRole')->dropDownList(['User' => 'User', 'Admin' => 'Admin',], ['prompt' => 'Select a Role']) ?>

    <?= $form->field($model, 'userStatus')->dropDownList(['Pending' => 'Pending', 'Active' => 'Active', 'Inactive' => 'Inactive',], ['prompt' => 'Select a Status']) ?>

    <?php
        $modules = Modules::find()->where(['fkParentModuleID' => NULL])->all();

        if($modules) {
            ?>
            <p>&nbsp;</p>
            <h4>Modules Access</h4>
            <hr/>
            <?php
            foreach($modules as $module) {
                ?>
                <div class="form-group">
                    <?php echo Html::checkbox('fkModuleID[' .$module->pkModuleID. ']', $model->hasModuleByID($module->pkModuleID), ['label' => $module->moduleName]); ?>
                    <?php
                    if($module->modules) {
                        foreach($module->modules as $subModule) {
                            ?>
                                <div class="form-group margin-left-10">
                                    <?php echo Html::checkbox('fkModuleID[' .$subModule->pkModuleID. ']', $model->hasModuleByID($subModule->pkModuleID), ['label' => $subModule->moduleName]); ?>
                                </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
            }
        }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
