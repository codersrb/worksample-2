<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ContactTypes;
use app\models\ContactSource;
use app\models\Contacts;
use app\models\Tags;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\ContactsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-search">
    <div class="box-group" id="accordion">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="">
                        Filter your Results:
                    </a>
                    &nbsp;

                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse" aria-expanded="false">
                <div class="box-body">

                    <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
                    ]); ?>
                    <div class="row">

                        <div class="col-md-2"><?= $form->field($model, 'contactAddress')->label('Keyword') ?></div>
                        <div class="col-md-2"><?= $form->field($model, 'contactPersonPhone')->label('Phone') ?></div>
                        <div class="col-md-2"><?= $form->field($model, 'contactPersonEmail')->label('Email') ?></div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'contactContactTypeID')->widget(Select2::classname(), [
                                'data' => ContactTypes::find()->select(['contactTypeName'])->indexBy('pkContactTypeID')->column(),
                                'options' => ['placeholder' => 'Select a type ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>

                        <div class="col-md-2">
                            <?= $form->field($model, 'contactSourceID')->widget(Select2::classname(), [
                                'data' => ContactSource::find()->select(['contactSourceName'])->indexBy('pkContactSourceID')->column(),
                                'options' => ['placeholder' => 'Select a source ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>

                        <div class="col-md-2">
                            <?= $form->field($model, 'tagIDs')->widget(Select2::classname(), [
                                'data' => Tags::find()->select(['tagName'])->indexBy('pkTagID')->column(),
                                'options' => ['placeholder' => 'Select Tags ...', 'multiple' => true],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'tags' => true,
                                ],
                            ]); ?>
                        </div>

                        <div class="col-md-2">
                            <?php echo $form->field($model, 'fkReferredBy')->widget(Select2::classname(), [
                                'data' => Contacts::find()->select(['contactPersonFullName'])->joinWith('contactPersons')->indexBy('pkContactID')->column(),
                                'options' => ['placeholder' => 'Select a Referred Contact'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])->label('Referrer Contact'); ?>
                        </div>

                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Update Results', ['class' => 'btn btn-primary btn-flat']) ?>
                        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default btn-flat']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="box btn-box-gray">
                    <div class="pull-right">
                        <a href="javascript:void(0)" class="btn btn-primary btn-xs">Import Contacts</a>
                        <a href="javascript:void(0)" class="btn btn-primary btn-xs">Export Contacts</a>
                        <a href="javascript:void(0)" class="btn btn-primary add-contact btn-xs">Add a Contact</a>
                    </div>
                </div>
</div>
