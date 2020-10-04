<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use app\models\LeadReminders;
/* @var $this yii\web\View */
/* @var $model app\models\LeadDesign */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lead-design-form">

    <ul class="nav nav-tabs">
        <li><a href="<?= Url::to(['update', 'id' => $leadModel->pkLeadID]); ?>">Details</a></li>
        <li><a href="<?= Url::to(['measurements', 'id' => $leadModel->pkLeadID]); ?>">Measurement</a></li>
        <li><a href="<?= Url::to(['design', 'id' => $leadModel->pkLeadID]); ?>">Design</a></li>
        <li><a href="#">Estimate</a></li>
        <li><a href="<?= Url::to(['delivery', 'id' => $leadModel->pkLeadID]); ?>">Delivery</a></li>
        <li><a href="<?= Url::to(['photos', 'id' => $leadModel->pkLeadID]); ?>">Photos</a></li>
        <li><a href="<?= Url::to(['notes', 'id' => $leadModel->pkLeadID]); ?>">Notes</a></li>
        <li class="active"><a href="<?= Url::to(['reminder', 'id' => $leadModel->pkLeadID]); ?>">Reminder</a></li>
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


    <div class="box box-default">
        <div class="box-body">
            <h4>Add New Reminder</h4>

            <div class="row">
                <?php $form = ActiveForm::begin(); ?>
                <div class="col-md-12">
                    <?= $form->field($model, 'leadReminderDate')->widget(\kartik\datetime\DateTimePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd HH:ii:ss', 'autoclose' => true]]); ?>
                    <?= $form->field($model, 'leadReminderText')->textarea(['row' => 12]); ?>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <?= Html::submitButton('Add New Reminder', ['class' => 'btn btn-success btn-flat']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>

            </div>

            <hr/>

            <h3>Reminders</h3>

            <div class="row">
                <?php
                $allReminders = LeadReminders::find()->where(['fkLeadID' => $leadModel->pkLeadID])->orderBy(['leadReminderDate' => SORT_DESC])->all();

                if(count($allReminders) > 0) {
                    foreach($allReminders as $eachReminder) :
                        ?>
                        <div class="col-md-12">
                            <blockquote>
                                <?= nl2br($eachReminder->leadReminderText); ?>
                                <p class="small">At <?= $eachReminder->leadReminderDate; ?> - by <?= $eachReminder->fkUser->userName; ?></p>
                            </blockquote>
                        </div>
                    <?php endforeach; ?>

                    <?php
                } else {
                    ?>
                        <div class="col-md-12">
                            <p>No Notes available.</p>
                        </div>
                    <?php
                }
                ?>

            </div>

        </div>
    </div>




</div>
