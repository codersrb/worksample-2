<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model app\models\LeadMeasurements */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lead-measurements-form">

    <ul class="nav nav-tabs">
        <li><a href="<?= Url::to(['update', 'id' => $leadModel->pkLeadID]); ?>">Details</a></li>
        <li class="active"><a href="<?= Url::to(['measurements', 'id' => $leadModel->pkLeadID]); ?>">Measurement</a></li>
        <li><a href="<?= Url::to(['design', 'id' => $leadModel->pkLeadID]); ?>">Design</a></li>
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
            <h4>Measurement Appointment Details</h4>

            <div class="row">
                <div class="col-md-3">
                    <p>What days of the week do you prefer ?</p>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'lmDayWeekDay')->checkbox() ?>
                    <?= $form->field($model, 'lmDayStart')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'lmDayWeekEnd')->checkbox() ?>
                    <?= $form->field($model, 'lmDayEnd')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'lmDayFlexible')->checkbox() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <p>What time do you prefer ?</p>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'lmDayTime')->radioList([ 'Morning' => 'Morning', 'Evening' => 'Evening', ], ['prompt' => '']) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'lmDayTimeEveningTimeFrame')->checkbox() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'lmDayTimeFlexible')->checkbox() ?>
                </div>
            </div>
        </div>
    </div>


    <div class="box box-default">
        <div class="box-body">
            <h4>Confirmed Appointment</h4>

            <div class="row">
                <div class="col-md-3">
                    <p>Appointment Scheduled:</p>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'lmAppointmentStartDate')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'lmAppointmentEndDate')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <p>Appointment Sheduled by: </p>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'lmAppointmentScheduledBy')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <p>Appointment Reminder</p>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'lmAppointmentReminder')->radioList([ 'Call' => 'Courtey call to confirm appointment', 'Email' => 'Email reminder', ], ['prompt' => '']) ?>
                </div>
            </div>
        </div>
    </div>


    <div class="box box-default property-measurement">
        <div class="box-body">
            <h4>Property Measurement</h4>

            <div class="row">
                <div class="col-md-3">
                    <p>Measurement Completed: </p>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'lmMeasurementCompleteDate')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'lmMeasurementCompletedBy')->textInput() ?>
                </div>

            </div>

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'lmMeasurementSketchFiles[]')->fileInput(['multiple' => true]) ?>
                    <span>
                        <?php
                        $count = \app\models\LeadImages::find()
                            ->where(['leadImageType' => 'Sketch'])
                            ->andWhere(['fkLeadID' => $leadModel->pkLeadID])
                            ->count();

                        echo Html::a($count.' Images', ['/leads/photos', 'id' => $leadModel->pkLeadID, 'type' => 'Sketch']);
                        ?>
                        </span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'lmMeasurementBeforePhotosFiles[]')->fileInput(['multiple' => true]) ?>
                    <span>
                        <?php
                        $count = \app\models\LeadImages::find()
                            ->where(['leadImageType' => 'BeforePhotos'])
                            ->andWhere(['fkLeadID' => $leadModel->pkLeadID])
                            ->count();

                        echo Html::a($count.' Images', ['/leads/photos', 'id' => $leadModel->pkLeadID, 'type' => 'BeforePhotos']);
                        ?>
                    </span>
                </div>
            </div>


            <div class="row">
                <div class="col-md-3">
                    Property Details: <a href="javascript:void(0)" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-notes">Add Note</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <p>Appliance Sizes</p>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4 form-box">
                            <h4>Range</h4>
                            <?= $form->field($model, 'lmRangeW')->textInput() ?>
                            <?= $form->field($model, 'lmRangeD')->textInput() ?>
                            <?= $form->field($model, 'lmRangeH')->textInput() ?>
                        </div>
                        <div class="col-md-4 form-box">
                            <h4>Hood</h4>
                            <?= $form->field($model, 'lmHoodW')->textInput() ?>
                            <?= $form->field($model, 'lmHoodD')->textInput() ?>
                            <?= $form->field($model, 'lmHoodH')->textInput() ?>
                        </div>
                        <div class="col-md-4 form-box">
                            <h4>Dishwasher</h4>
                            <?= $form->field($model, 'lmDishwasherW')->textInput() ?>
                            <?= $form->field($model, 'lmDishwasherD')->textInput() ?>
                            <?= $form->field($model, 'lmDishwasherH')->textInput() ?>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4 form-box">
                            <h4>Cook-top</h4>
                            <?= $form->field($model, 'lmCookTopW')->textInput() ?>
                            <?= $form->field($model, 'lmCookTopD')->textInput() ?>
                            <?= $form->field($model, 'lmCookTopH')->textInput() ?>
                        </div>
                        <div class="col-md-4 form-box">
                            <h4>Microwave</h4>
                            <?= $form->field($model, 'lmMicrowaveW')->textInput() ?>
                            <?= $form->field($model, 'lmMicrowaveD')->textInput() ?>
                            <?= $form->field($model, 'lmMicrowaveH')->textInput() ?>
                        </div>
                        <div class="col-md-4 form-box">
                            <h4>Sink</h4>
                            <?= $form->field($model, 'lmSinkW')->textInput() ?>
                            <?= $form->field($model, 'lmSinkD')->textInput() ?>
                            <?= $form->field($model, 'lmSinkH')->textInput() ?>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-4 form-box">
                            <h4>Oven</h4>
                            <?= $form->field($model, 'lmOvenW')->textInput() ?>
                            <?= $form->field($model, 'lmOvenD')->textInput() ?>
                            <?= $form->field($model, 'lmOvenH')->textInput() ?>
                        </div>
                        <div class="col-md-4 form-box">
                            <h4>Refridgerator</h4>
                            <?= $form->field($model, 'lmRefridgeratorW')->textInput() ?>
                            <?= $form->field($model, 'lmRefridgeratorD')->textInput() ?>
                            <?= $form->field($model, 'lmRefridgeratorH')->textInput() ?>
                        </div>
                        <div class="col-md-4 form-box other">
                            <?= $form->field($model, 'lmOther')->textInput() ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <p>Appliance Confirmed via</p>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'lmConfimedViaEmail')->textInput() ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'lmConfirmedStartDate')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'lmConfirmedEndDate')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
            </div>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<div class="modal fade" id="modal-notes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Notes</h4>
            </div>
            <div class="modal-body">

                <div class="lead-notes-form">

                    <?php $form = ActiveForm::begin(['id' => 'add-notes']); ?>

                    <?= Html::hiddenInput('fkLeadID', $leadModel->pkLeadID); ?>
                    <?= Html::hiddenInput('leadNoteAddedFrom', 'Measurement'); ?>

                    <div class="form-group">
                        <?= Html::textarea('leadNoteText','', ['class' => 'form-control']); ?>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Save Note', ['class' => 'btn btn-success btn-flat']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
$js=<<<EOD
$('#add-notes').submit(function(e) {
    e.preventDefault();
    
    var data = $(this).serialize();
    
    
    $.ajax({
        url: '/leads/add-notes',
        method: 'post',
        data,
        success: function(data) {
            alert(data.message);
        },
        error: function(){
            alert('There is some error');
        }
    });    
});
EOD;

$this->registerJs(
    $js,
    View::POS_READY
);
?>