<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\ProjectTypes;
use app\models\ContactTypes;
use app\models\ContactStatus;
use app\models\ContactSource;
use app\models\Tags;
use app\models\Countries;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\Leads */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leads-form">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?= Url::to(['update', 'id' => $model->pkLeadID]); ?>">Details</a></li>
        <li><a href="<?= Url::to(['measurements', 'id' => $model->pkLeadID]); ?>">Measurement</a></li>
        <li><a href="<?= Url::to(['design', 'id' => $model->pkLeadID]); ?>">Design</a></li>
        <li><a href="#">Estimate</a></li>
        <li><a href="<?= Url::to(['delivery', 'id' => $model->pkLeadID]); ?>">Delivery</a></li>
        <li><a href="<?= Url::to(['photos', 'id' => $model->pkLeadID]); ?>">Photos</a></li>
        <li><a href="<?= Url::to(['notes', 'id' => $model->pkLeadID]); ?>">Notes</a></li>
        <li><a href="<?= Url::to(['reminder', 'id' => $model->pkLeadID]); ?>">Reminder</a></li>
    </ul>
    <p class="text-danger">Most of the section which are not working will start to work when we develop the next pages
        on same module. i.e. Estimate, Delivery, Etc</p>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-default estimate-box">
        <div class="box-body">
            <div class="col-md-12">
                <h3>Estimate:
                    <?= $model->pkLeadID; ?>
                </h3>
                <div class="pull-right"><a href="javascript:void(0)" class="btn btn-primary btn-xs">View Estimate</a> <a
                            href="javascript:void(0)" class="btn btn-success btn-xs">Mark Won</a> <a
                            href="javascript:void(0)" class="btn btn-danger btn-xs">Mark Lost</a></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"> Opportunity for
                    <?= $model->fkContact->contactPersons[0]->contactPersonFullName; ?>
                </div>
                <div class="col-md-3"><i class="fa fa-envelope" aria-hidden="true"></i>
                    <?= $model->fkContact->contactPersons[0]->contactPersonEmail; ?>
                </div>
            </div>
            <div class="clearfix">
                <div class="col-md-3">
                    <?= $model->fkContact->contactAddress; ?>
                    ,<br/>
                    <?= $model->fkContact->contactAddress2; ?>
                    ,<br/>
                    <?= $model->fkContact->contactCity; ?>
                    <?= $model->fkContact->contactState; ?>
                    <?= $model->fkContact->contactCountry; ?>
                    <?= $model->fkContact->contactZip; ?>
                    <br/>
                </div>
                <div class="col-md-3"><i class="fa fa-phone" aria-hidden="true"></i>
                    <?= $model->fkContact->contactPersons[0]->contactPersonPhone; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="box-default">
        <div class="box-body">
            <div class="form-group field-projectcompletion-projectcompletionstatus updated">
                <h3>Project Completion
                    <div class="progress-bar-box"><span class="status completed"></span><span
                                class="status completed"></span><span class="status completed"></span><span
                                class="status completed"></span><span class="status completed"></span><span
                                class="status completed"></span><span class="status"></span><span class="status"></span><span
                                class="status"></span></div>
                    <span class="progress-percentage">70%</span></h3>
                <input type="hidden" name="ProjectCompletion[projectCompletionStatus]" value="">
                <div id="projectcompletion-projectcompletionstatus" prompt="">
                    <div class="input-row"><span class="label-icon"><img src="/images/measurement.png"
                                                                         alt="measurement"></span>
                        <div class="form-container checkboxes">
                            <label>
                                <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                       value="Measurement">
                                Measurement <span class="selected"></span></label>
                        </div>
                    </div>
                    <div class="input-row"><span class="label-icon"><img src="/images/design.png" alt="design"></span>
                        <div class="form-container checkboxes">
                            <label>
                                <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]" value="Design">
                                Design <span class="selected"></span></label>
                        </div>
                    </div>
                    <div class="input-row"><span class="label-icon"><img src="/images/selectionmade.png"
                                                                         alt="selectionmade"></span>
                        <div class="form-container checkboxes">
                            <label>
                                <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                       value="SelectionMade">
                                SelectionMade <span class="selected"></span></label>
                        </div>
                    </div>
                    <div class="input-row"><span class="label-icon"><img src="/images/estimate.png" alt="selectionmade"></span>
                        <div class="form-container checkboxes">
                            <label>
                                <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                       value="Estimate">
                                Estimate <span class="selected"></span></label>
                        </div>
                    </div>
                    <div class="input-row"><span class="label-icon"><img src="/images/deposit.png" alt="deposit"></span>
                        <div class="form-container checkboxes">
                            <label>
                                <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                       value="Deposit">
                                Deposit <span class="selected"></span></label>
                        </div>
                    </div>
                    <div class="input-row"><span class="label-icon"><img src="/images/productordered.png"
                                                                         alt="productordered"></span>
                        <div class="form-container checkboxes">
                            <label>
                                <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                       value="ProductOrdered">
                                ProductOrdered <span class="selected"></span></label>
                        </div>
                    </div>
                    <div class="input-row"><span class="label-icon"><img src="/images/delivery.png"
                                                                         alt="delivery"></span>
                        <div class="form-container checkboxes">
                            <label>
                                <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                       value="Delivery">
                                Delivery <span class="selected"></span></label>
                        </div>
                    </div>
                    <div class="input-row"><span class="label-icon"><img src="/images/installation.png"
                                                                         alt="installation"></span>
                        <div class="form-container checkboxes">
                            <label>
                                <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                       value="Installation">
                                Installation <span class="selected"></span></label>
                        </div>
                    </div>
                    <div class="input-row"><span class="label-icon"><img src="/images/finalPayment.png"
                                                                         alt="finalPayment"></span>
                        <div class="form-container checkboxes">
                            <label>
                                <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                       value="FinalPayment">
                                FinalPayment <span class="selected"></span></label>
                        </div>
                    </div>
                </div>
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <div class="box-default schedule">
        <div class="box-header with-border">
            <h3>Schedule</h3>
            <div class="pull-right"><a href="javascript:void(0)" class="btn btn-primary btn-xs">Add Reminder</a> <a
                        href="javascript:void(0)" class="btn btn-primary btn-xs">Schedule Estimate</a></div>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th>Date</th>
                    <th>Event</th>
                    <th>Assigned To</th>
                </tr>
                <tr>
                    <td align="center" colspan="3">No Events</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3>Additional Information</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($modelContact, 'contactOpportunityTitle')->textInput() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($modelContact, 'contactPropertyAddress')->textInput() ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($modelContact, 'contactPropertyCity')->textInput() ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($modelContact, 'contactPropertyState')->textInput() ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($modelContact, 'contactPropertyCountry')->widget(Select2::classname(), [
                                'data' => Countries::find()->select(['countryName'])->indexBy('countryName')->column(),
                                'options' => ['placeholder' => 'Select a country ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($modelContact, 'contactProjectTypeID')->widget(Select2::classname(), [
                                'data' => ProjectTypes::find()->select(['projectTypeName'])->indexBy('pkProjectTypeID')->column(),
                                'options' => ['placeholder' => 'Select a state ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($modelContact, 'contactTags')->widget(Select2::classname(), [
                                'data' => Tags::find()->select(['tagName'])->indexBy('tagName')->column(),
                                'options' => ['placeholder' => 'Select Tags', 'multiple' => true],
                                'maintainOrder' => true,
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'tags' => true,
                                    'maximumInputLength' => 10
                                ],
                                'toggleAllSettings' => [
                                    'selectLabel' => '<i class="glyphicon glyphicon-ok-circle"></i> Tag All',
                                    'unselectLabel' => '<i class="glyphicon glyphicon-remove-circle"></i> Untag All',
                                    'selectOptions' => ['class' => 'text-success'],
                                    'unselectOptions' => ['class' => 'text-danger'],
                                ],
                            ]); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($modelContact, 'contactContactTypeID')->widget(Select2::classname(), [
                                'data' => ContactTypes::find()->select(['contactTypeName'])->indexBy('pkContactTypeID')->column(),
                                'options' => ['placeholder' => 'Select a type ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($modelContact, 'contactStatusID')->widget(Select2::classname(), [
                                'data' => ContactStatus::find()->select(['contactStatusName'])->indexBy('pkContactStatusID')->column(),
                                'options' => ['placeholder' => 'Select a status ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($modelContact, 'contactSourceID')->widget(Select2::classname(), [
                                'data' => ContactSource::find()->select(['contactSourceName'])->indexBy('pkContactSourceID')->column(),
                                'options' => ['placeholder' => 'Select a source ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3>Contractor Information</h3>
        </div>
        <div class="box-body">
            <?= $form->field($modelContact, 'contactContractor')->radioList(['Yes' => 'Yes (Please include their information below)', 'No' => 'No',], ['prompt' => '']) ?>
            <?= $form->field($modelContact, 'contactReferral')->radioList(['Yes' => 'Yes', 'No' => 'No',], ['prompt' => '']) ?>
            <?= $form->field($modelContactContractorInfo, 'selectionType')->radioList(['Own' => 'To make a selection on your own', 'Rok' => 'To ROK to give you final design to two contractors from the list who service your country so they may provide you with quotes and you choose from them.',], ['prompt' => '']) ?>
            <div class="contractor-info-box">
                <div class="job-required-services updated" style="">
                    <label class="control-label">What service will you require for this job ?</label>
                    <div class="form-group form-container checkboxes">
                        <input type="hidden" name="ContactContractorInfo[ServiceDemolition]" value="0">
                        <label>
                            <input type="checkbox" id="contactcontractorinfo-servicedemolition"
                                   name="ContactContractorInfo[ServiceDemolition]" value="1">
                            Demolation <span class="selected"></span></label>
                        <input type="hidden" name="ContactContractorInfo[ServicePaint]" value="0">
                        <label>
                            <input type="checkbox" id="contactcontractorinfo-servicepaint"
                                   name="ContactContractorInfo[ServicePaint]" value="1">
                            Paint <span class="selected"></span></label>
                        <input type="hidden" name="ContactContractorInfo[ServiceBacksplashInstallation]" value="0">
                        <label>
                            <input type="checkbox" id="contactcontractorinfo-servicebacksplashinstallation"
                                   name="ContactContractorInfo[ServiceBacksplashInstallation]" value="1">
                            Backsplash Installation <span class="selected"></span></label>
                        <input type="hidden" name="ContactContractorInfo[ServiceCountertopInstallation]" value="0">
                        <label>
                            <input type="checkbox" id="contactcontractorinfo-servicecountertopinstallation"
                                   name="ContactContractorInfo[ServiceCountertopInstallation]" value="1">
                            Countertop Installation <span class="selected"></span></label>
                        <input type="hidden" name="ContactContractorInfo[ServiceApplianceInstallationGas]" value="0">
                        <label>
                            <input type="checkbox" id="contactcontractorinfo-serviceapplianceinstallationgas"
                                   name="ContactContractorInfo[ServiceApplianceInstallationGas]" value="1">
                            Appliance Installation Gas <span class="selected"></span></label>
                        <input type="hidden" name="ContactContractorInfo[ServiceApplianceInstallationElectric]"
                               value="0">
                        <label>
                            <input type="checkbox" id="contactcontractorinfo-serviceapplianceinstallationelectric"
                                   name="ContactContractorInfo[ServiceApplianceInstallationElectric]" value="1">
                            Appliance Installation Electric <span class="selected"></span></label>
                        <input type="hidden" name="ContactContractorInfo[ServiceSinkInstallation]" value="0">
                        <label>
                            <input type="checkbox" id="contactcontractorinfo-servicesinkinstallation"
                                   name="ContactContractorInfo[ServiceSinkInstallation]" value="1">
                            Sink Installation <span class="selected"></span></label>
                        <input type="hidden" name="ContactContractorInfo[ServiceElectrical]" value="0">
                        <label>
                            <input type="checkbox" id="contactcontractorinfo-serviceelectrical"
                                   name="ContactContractorInfo[ServiceElectrical]" value="1">
                            Electric <span class="selected"></span></label>
                        <input type="hidden" name="ContactContractorInfo[ServicePlumbing]" value="0">
                        <label>
                            <input type="checkbox" id="contactcontractorinfo-serviceplumbing"
                                   name="ContactContractorInfo[ServicePlumbing]" value="1">
                            Plumbing <span class="selected"></span></label>
                        <input type="hidden" name="ContactContractorInfo[ServicePlumbing]" value="0">
                        <label>
                            <input type="checkbox" id="contactcontractorinfo-serviceplumbing"
                                   name="ContactContractorInfo[ServicePlumbing]" value="1">
                            Plumbing <span class="selected"></span></label>
                    </div>
                </div>
                <p>&nbsp;</p>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($modelContactContractorInfo, 'contractorCompanyName')->textInput() ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($modelContactContractorInfo, 'contractorCompanyOfficePhone')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($modelContactContractorInfo, 'contractorCompanyStreetAddress')->textInput() ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($modelContactContractorInfo, 'contractorCompanyCity')->textInput() ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($modelContactContractorInfo, 'contractorCompanyState')->textInput() ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($modelContactContractorInfo, 'contractorCompanyZip')->textInput() ?>
                    </div>
                </div>
                <p>&nbsp;</p>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($modelContactContractorInfo, 'contractorName')->textInput() ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($modelContactContractorInfo, 'contractorCellPhone')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($modelContactContractorInfo, 'contractorOfficePhone')->textInput() ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($modelContactContractorInfo, 'contractorExt')->textInput() ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($modelContactContractorInfo, 'contractorEmail')->textInput() ?>
                    </div>
                </div>
                <p>&nbsp;</p>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($modelContactContractorInfo, 'contractorPMName')->textInput() ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($modelContactContractorInfo, 'contractorPMCellphone')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($modelContactContractorInfo, 'contractorPMOfficePhone')->textInput() ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($modelContactContractorInfo, 'contractorPMExt')->textInput() ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($modelContactContractorInfo, 'contractorPMEmail')->textInput() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>
