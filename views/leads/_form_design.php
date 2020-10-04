<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model app\models\LeadDesign */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lead-design-form">

    <ul class="nav nav-tabs">
        <li><a href="<?= Url::to(['update', 'id' => $leadModel->pkLeadID]); ?>">Details</a></li>
        <li><a href="<?= Url::to(['measurements', 'id' => $leadModel->pkLeadID]); ?>">Measurement</a></li>
        <li class="active"><a href="<?= Url::to(['design', 'id' => $leadModel->pkLeadID]); ?>">Design</a></li>
        <li><a href="#">Estimate</a></li>
        <li><a href="<?= Url::to(['delivery', 'id' => $leadModel->pkLeadID]); ?>">Delivery</a></li>
        <li><a href="<?= Url::to(['photos', 'id' => $leadModel->pkLeadID]); ?>">Photos</a></li>
        <li><a href="<?= Url::to(['notes', 'id' => $leadModel->pkLeadID]); ?>">Notes</a></li>
        <li><a href="<?= Url::to(['reminder', 'id' => $leadModel->pkLeadID]); ?>">Reminder</a></li>
    </ul>

    <div class="box-default estimate-box">
        <div class="box-body">
            <div class="col-md-12">
                <h3>Estimate: <?= $leadModel->pkLeadID; ?></h3>
                <div class="pull-right">
                    <a href="javascript:void(0)" class="btn btn-primary btn-xs">View Estimate</a>
                    <a href="javascript:void(0)" class="btn btn-success btn-xs">Mark Won</a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-xs">Mark Lost</a>
                </div>
            </div>
            <div class="clearfix">
                <div class="col-md-3">
                    Opportunity for <?= $leadModel->fkContact->contactPersons[0]->contactPersonFullName; ?>
                </div>
                <div class="col-md-3">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <?= $leadModel->fkContact->contactPersons[0]->contactPersonEmail; ?>
                </div>
            </div>

            <div class="clearfix">
                <div class="col-md-3">
                    <?= $leadModel->fkContact->contactAddress; ?>,<br/>
                    <?= $leadModel->fkContact->contactAddress2; ?>,<br/>
                    <?= $leadModel->fkContact->contactCity; ?> <?= $leadModel->fkContact->contactState; ?> <?= $leadModel->fkContact->contactCountry; ?> <?= $leadModel->fkContact->contactZip; ?><br/>
                </div>
                <div class="col-md-3">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <?= $leadModel->fkContact->contactPersons[0]->contactPersonPhone; ?>
                </div>
            </div>


        </div>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-body">
            <h4>Customer Selections</h4>

            <div class="row">
                <div class="col-md-3">
                    Door Finish Selections:
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'ldDoorFinishSelection1st')->dropDownList(['1st Choice' => '1st Choice', '2nd Choice' => '2nd Choice']) ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'ldDoorFinishSelection2nd')->dropDownList(['1st Choice' => '1st Choice', '2nd Choice' => '2nd Choice']) ?>
                </div>
            </div>


            <div class="row">
                <div class="col-md-3">
                    Granite Color Selection:
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldGraniteColorSelection')->dropDownList(['1st Choice' => '1st Choice', '2nd Choice' => '2nd Choice']) ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'ldGraniteColorSelectionCut')->dropDownList(['1st Choice' => '1st Choice', '2nd Choice' => '2nd Choice']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Quartz Color Selection:
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldQuartzColorSelection')->dropDownList(['1st Choice' => '1st Choice', '2nd Choice' => '2nd Choice']) ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'ldQuartzColorSelectionCut')->dropDownList(['1st Choice' => '1st Choice', '2nd Choice' => '2nd Choice']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'ldbackSplashLeadSelection')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'ldSinkSelection')->textInput() ?>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'ldKnobsSelection')->textInput() ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'ldSinkSelection')->textInput() ?>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'ldAccessoriesSelection')->textarea(['rows' => 3]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'ldNotes')->textarea(['rows' => 6]) ?>
                </div>
            </div>

            <hr/>


            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'ldDesign2D3DFiles[]')->fileInput(['multiple' => true]) ?>
                    <span>
                        <?php
                        $count = \app\models\LeadImages::find()
                            ->where(['leadImageType' => '2D3D'])
                            ->andWhere(['fkLeadID' => $leadModel->pkLeadID])
                            ->count();

                        echo Html::a($count.' Images', ['/leads/photos', 'id' => $leadModel->pkLeadID, 'type' => '2D3D']);
                        ?>
                    </span>
                </div>
            </div>


            <div class="row">

                <div class="col-md-2">
                    <?= $form->field($model, 'ldInitialDesign')->checkbox() ?>
                </div>

                <div class="col-md-2">
                    Design Completed by:
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'ldDesignCompletedBy')->textInput() ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'ldDesignEmailed')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>

            </div>


            <div class="row">
                <div class="col-md-6">
                    <?php
                    echo $form->field($model, 'revisions')->widget(MultipleInput::className(), [
                        'max' => 10,
                        'columns' => [
                            [
                                'name'  => 'pkLeadDesignRevisionID',
                                'title' => 'pkLeadDesignRevisionID',
                                'type' => 'hiddenInput'
                            ],
                            [
                                'name'  => 'ldrApproved',
                                'title' => 'Approved',
                                'type' => 'checkbox'
                            ],
                            [
                                'name'  => 'ldrModificationRequest',
                                'title' => 'Modification Request',
                                'type' => 'checkbox'
                            ],
                            [
                                'name'  => 'ldrEmailedToCustomer',
                                'title' => 'Emailed to Customer',
                                'type'  => \kartik\date\DatePicker::className(),
                                'options' => ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]
                            ]
                        ]
                    ]);
                    ?>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'ldFinalEmail')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'ldFinalApproval')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
            </div>


            <hr/>
            <h5 class="text-orange">Autoreminder</h5>
            <p>If you do not hear from the customer from 7 days from emailing the original design or any revisions, place a follow up call and send an email, copying Sales Support</p>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'ldFollowUp1st')->textInput()->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'ldFollowUp2nd')->textInput()->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
            </div>



        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
