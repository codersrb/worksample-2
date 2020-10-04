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
        <li><a href="<?= Url::to(['design', 'id' => $leadModel->pkLeadID]); ?>">Design</a></li>
        <li><a href="#">Estimate</a></li>
        <li class="active"><a href="<?= Url::to(['delivery', 'id' => $leadModel->pkLeadID]); ?>">Delivery</a></li>
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
            <h4>Delivery</h4>

            <div class="row">
                <div class="col-md-12">
                    <p>Customer Preferred Delivery & Assembly/Instalation Dates:</p>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'ldlPreferredDate1')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'ldlPreferredDate2')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'ldlPreferredDate3')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p>Customer who were sent Request for Quote email</p>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'ldlContractorName1')->textInput() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'ldlContractorDateTime1')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'ldlContractorName2')->textInput() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'ldlContractorDateTime2')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                        </div>
                    </div>

                </div>
            </div>

            <hr/>

            <h3>Confirm Job Details</h3>



            <h4>Demo Details</h4>
            <div class="row">
                <div class="col-md-3">Demo Coordinated for</div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlDemoFor')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlDemoAt')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">Demo labor performed by</div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlDemoBy')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <?= $form->field($model, 'ldlDemoNotes')->textarea(['rows' => 6]) ?>
                </div>
            </div>

            <br/>
            <br/>

            <h4>Cabinet Delivery & Assembly Details</h4>
            <div class="row">
                <div class="col-md-3">Delivery/Assembly for cabinets cordinated for</div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlDeliveryFor')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlDeliveryAt')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">Delivery/Assembly for cabinet by</div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlDeliveryBy')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <?= $form->field($model, 'ldlDeliveryNotes')->textarea(['rows' => 6]) ?>
                </div>
            </div>


            <br/>
            <br/>

            <h4>Cabinet Instalation Details</h4>
            <div class="row">
                <div class="col-md-3">Installation for cabinets cordinated for</div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlCabinetFor')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlCabinetAt')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">Installation for cabinet by</div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlCabinetBy')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <?= $form->field($model, 'ldlCabinetNotes')->textarea(['rows' => 6]) ?>
                </div>
            </div>


            <br/>
            <br/>

            <h4>Countertop Instalation Details</h4>
            <div class="row">
                <div class="col-md-3">Installation for countertop cordinated for</div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlCounterTopFor')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlCounterTopAt')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">Installation for countertop by</div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlCounterTopBy')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <?= $form->field($model, 'ldlCounterTopNotes')->textarea(['rows' => 6]) ?>
                </div>
            </div>


            <br/>
            <br/>

            <h4>Backsplash/Tile Instalation Details</h4>
            <div class="row">
                <div class="col-md-3">Installation for backsplash cordinated for</div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlBackSplashFor')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlBackSplashAt')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">Installation for backsplash by</div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ldlBackSplashBy')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <?= $form->field($model, 'ldlBackSplashNotes')->textarea(['rows' => 6]) ?>
                </div>
            </div>



            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'ldlDesignEmail')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <p>POs created and emailed to: </p>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'ldlPOEmail1')->textInput() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'ldlPOProduct1')->textInput() ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'ldlPOEmail2')->textInput() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'ldlPOProduct2')->textInput() ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'ldlPOEmail3')->textInput() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'ldlPOProduct3')->textInput() ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'ldlPOEmail4')->textInput() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'ldlPOProduct4')->textInput() ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'ldlPOEmail5')->textInput() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'ldlPOProduct5')->textInput() ?>
                        </div>
                    </div>


                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'ldlCustomerApprovalCreated')->widget(\kartik\date\DatePicker::classname(), ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true]]); ?>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'ldlCustomerApprovalEmaled')->textInput(); ?>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'ldlCustomerRequestForQuoteEmailedOn')->textInput(); ?>
                </div>
            </div>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
