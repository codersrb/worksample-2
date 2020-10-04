<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ProjectTypes;
use app\models\Contacts;
use app\models\ContactTypes;
use app\models\ContactStatus;
use app\models\ContactSource;
use app\models\Tags;
use app\models\Countries;
use kartik\select2\Select2;
use unclead\multipleinput\MultipleInput;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model app\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contactType')->radioList(['Person' => 'Person', 'Company' => 'Company/Location',], ['prompt' => '']) ?>


    <div class="box box-default">
        <div class="box-header with-border">
            <h3>Contact Information</h3>
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-md-6">
                    <?php
                    echo $form->field($model, 'primaryContact')->widget(MultipleInput::className(), [
                        'max' => 3,
                        'columns' => [
                            [
                            'name'  => 'fullName',
                            'title' => 'Full Name',
                            ],
                            [
                                'name'  => 'phoneNumber',
                                'title' => 'Phone Number',
                            ],
                            [
                                'name'  => 'Email',
                                'title' => 'Email Address',
                            ]
                        ]
                    ]);
                    ?>

                    <?= Html::checkbox('subContact', false, ['label' => 'This is a sub-contact of', 'class' => 'sub-contact-of']) ?>

                    <?php echo $form->field($model, 'fkSubContactID')->widget(Select2::classname(), [
                        'data' => Contacts::find()->select(['contactPersonFullName'])->joinWith('contactPersons')->indexBy('pkContactID')->column(),
                        'options' => ['placeholder' => 'Select a sub contact ...', 'style' => 'display: none;'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>

                    <p>&nbsp;</p>
                    <p>&nbsp;</p>

                    <?php echo $form->field($model, 'referrerID')->widget(Select2::classname(), [
                        'data' => Contacts::find()->select(['contactPersonFullName'])->joinWith('contactPersons')->indexBy('pkContactID')->column(),
                        'options' => ['placeholder' => 'Select a Referred Contact'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Referrer Contact'); ?>

                </div>
                <div class="col-md-6">

                    <?php
                    echo $form->field($model, 'secondaryContact')->widget(MultipleInput::className(), [
                        'max' => 3,
                        'columns' => [
                            [
                                'name'  => 'fullName',
                                'title' => 'Full Name',
                            ],
                            [
                                'name'  => 'phoneNumber',
                                'title' => 'Phone Number',
                            ],
                            [
                                'name'  => 'Email',
                                'title' => 'Email Address',
                            ],
                        ]
                    ]);
                    ?>

                </div>
            </div>
        </div>
    </div>


    <div class="box box-default">
        <div class="box-header with-border">
            <h3>Contact Address</h3>
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-md-6">

                    <?= $form->field($model, 'contactAddress')->textInput() ?>

                    <?= $form->field($model, 'contactAddress2')->textInput() ?>

                    <div class="row">

                        <div class="col-md-3"><?= $form->field($model, 'contactCity')->textInput() ?></div>

                        <div class="col-md-3"><?= $form->field($model, 'contactState')->textInput() ?></div>

                        <div class="col-md-3"><?= $form->field($model, 'contactZip')->textInput() ?></div>

                        <div class="col-md-3">
                            <?= $form->field($model, 'contactCountry')->widget(Select2::classname(), [
                                'data' => Countries::find()->select(['countryName'])->indexBy('countryName')->column(),
                                'options' => ['placeholder' => 'Select a country ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>

                    </div>

                </div>
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55565170.29301636!2d-132.08532758867793!3d31.786060306224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited+States!5e0!3m2!1sen!2sin!4v1530501646470" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>



    <div class="box box-default">
        <div class="box-header with-border">
            <h3>Billing Address</h3>
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group field-contacts-contactbillingaddresstype required updated">
                        <label class="control-label">Billing Address</label>
                        <input type="hidden" name="Contacts[contactBillingAddressType]" value="" disabled="disabled">
                        <div id="contacts-contactbillingaddresstype" class="form-container checkboxes" prompt=""
                             aria-required="true">
                            <label>
                                <input <?= ($model->contactBillingAddressType == 'Contact') ? 'checked' : ''; ?> type="radio" name="Contacts[contactBillingAddressType]" value="Contact">
                                Bill Contact Address <span class="selected"></span></label>
                            <label>
                                <input <?= ($model->contactBillingAddressType == 'ParentContact') ? 'checked' : ''; ?> type="radio" name="Contacts[contactBillingAddressType]" value="ParentContact">
                                Bill Parent Contact <span class="selected"></span></label>
                            <label>
                                <input <?= ($model->contactBillingAddressType == 'DifferentAddress') ? 'checked' : ''; ?> type="radio" name="Contacts[contactBillingAddressType]" value="DifferentAddress">
                                Bill Different Address <span class="selected"></span></label>
                        </div>
                        <div class="help-block"></div>
                    </div>

                    <?= $form->field($model, 'contactBillingAddress')->textInput() ?>

                    <?= $form->field($model, 'contactBillingAddress2')->textInput() ?>

                    <div class="row">
                        <div class="col-md-3"><?= $form->field($model, 'contactBillingCity')->textInput() ?></div>
                        <div class="col-md-3"><?= $form->field($model, 'contactBillingState')->textInput() ?></div>
                        <div class="col-md-3"><?= $form->field($model, 'contactBillingZip')->textInput() ?></div>
                        <div class="col-md-3">
                            <?= $form->field($model, 'contactBillingCountry')->widget(Select2::classname(), [
                                'data' => Countries::find()->select(['countryName'])->indexBy('countryName')->column(),
                                'options' => ['placeholder' => 'Select a country ...'],
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
            <h3>Additional Information</h3>
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'contactOpportunityTitle')->textInput() ?>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'contactPropertyAddress')->textInput() ?>
                        </div>
                        <div class="col-md-2"><?= $form->field($model, 'contactPropertyCity')->textInput() ?></div>
                        <div class="col-md-2"><?= $form->field($model, 'contactPropertyState')->textInput() ?></div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'contactPropertyCountry')->widget(Select2::classname(), [
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
                            <?= $form->field($model, 'contactProjectTypeID')->widget(Select2::classname(), [
                                'data' => ProjectTypes::find()->select(['projectTypeName'])->indexBy('pkProjectTypeID')->column(),
                                'options' => ['placeholder' => 'Select a state ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>


                        <div class="col-md-4">
                            <?= $form->field($model, 'contactTags')->widget(Select2::classname(), [
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
                            <?= $form->field($model, 'contactContactTypeID')->widget(Select2::classname(), [
                                'data' => ContactTypes::find()->select(['contactTypeName'])->indexBy('pkContactTypeID')->column(),
                                'options' => ['placeholder' => 'Select a type ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>

                        <div class="col-md-4">
                            <?= $form->field($model, 'contactStatusID')->widget(Select2::classname(), [
                                'data' => ContactStatus::find()->select(['contactStatusName'])->indexBy('pkContactStatusID')->column(),
                                'options' => ['placeholder' => 'Select a status ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>

                        <div class="col-md-4">

                            <?= $form->field($model, 'contactSourceID')->widget(Select2::classname(), [
                                'data' => ContactSource::find()->select(['contactSourceName'])->indexBy('pkContactSourceID')->column(),
                                'options' => ['placeholder' => 'Select a source ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>

                    </div>
                    <?= Html::hiddenInput('ProjectCompletion[projectCompletionStatus]', NULL); ?>
                    <div class="form-group field-projectcompletion-projectcompletionstatus updated">
                        <h3>Project Completion
                            <div class="progress-bar-box"><span class="status completed"></span><span
                                        class="status completed"></span><span class="status completed"></span><span
                                        class="status completed"></span><span class="status completed"></span><span
                                        class="status completed"></span><span class="status"></span><span
                                        class="status"></span><span class="status"></span></div>
                            <span class="progress-percentage">70%</span></h3>
                        <input type="hidden" name="ProjectCompletion[projectCompletionStatus]" value="">
                        <div id="projectcompletion-projectcompletionstatus" prompt="">
                            <div class="input-row"><span class="label-icon"><img
                                            src="<?php echo \yii\helpers\Url::to('/images/measurement.png'); ?>"
                                            alt="measurement"/></span>
                                <div class="form-container checkboxes">
                                    <label>
                                        <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                               value="Measurement">
                                        Measurement <span class="selected"></span></label>
                                </div>
                            </div>
                            <div class="input-row"><span class="label-icon"><img
                                            src="<?php echo \yii\helpers\Url::to('/images/design.png'); ?>"
                                            alt="design"/></span>
                                <div class="form-container checkboxes">
                                    <label>
                                        <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                               value="Design">
                                        Design <span class="selected"></span></label>
                                </div>
                            </div>
                            <div class="input-row"><span class="label-icon"><img
                                            src="<?php echo \yii\helpers\Url::to('/images/selectionmade.png'); ?>"
                                            alt="selectionmade"/></span>
                                <div class="form-container checkboxes">
                                    <label>
                                        <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                               value="SelectionMade">
                                        SelectionMade <span class="selected"></span></label>
                                </div>
                            </div>
                            <div class="input-row"><span class="label-icon"><img
                                            src="<?php echo \yii\helpers\Url::to('/images/estimate.png'); ?>"
                                            alt="selectionmade"/></span>
                                <div class="form-container checkboxes">
                                    <label>
                                        <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                               value="Estimate">
                                        Estimate <span class="selected"></span></label>
                                </div>
                            </div>
                            <div class="input-row"><span class="label-icon"><img
                                            src="<?php echo \yii\helpers\Url::to('/images/deposit.png'); ?>"
                                            alt="deposit"/></span>
                                <div class="form-container checkboxes">
                                    <label>
                                        <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                               value="Deposit">
                                        Deposit <span class="selected"></span></label>
                                </div>
                            </div>
                            <div class="input-row"><span class="label-icon"><img
                                            src="<?php echo \yii\helpers\Url::to('/images/productordered.png'); ?>"
                                            alt="productordered"/></span>
                                <div class="form-container checkboxes">
                                    <label>
                                        <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                               value="ProductOrdered">
                                        ProductOrdered <span class="selected"></span></label>
                                </div>
                            </div>
                            <div class="input-row"><span class="label-icon"><img
                                            src="<?php echo \yii\helpers\Url::to('/images/delivery.png'); ?>"
                                            alt="delivery"/></span>
                                <div class="form-container checkboxes">
                                    <label>
                                        <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                               value="Delivery">
                                        Delivery <span class="selected"></span></label>
                                </div>
                            </div>
                            <div class="input-row"><span class="label-icon"><img
                                            src="<?php echo \yii\helpers\Url::to('/images/installation.png'); ?>"
                                            alt="installation"/></span>
                                <div class="form-container checkboxes">
                                    <label>
                                        <input type="checkbox" name="ProjectCompletion[projectCompletionStatus]"
                                               value="Installation">
                                        Installation <span class="selected"></span></label>
                                </div>
                            </div>
                            <div class="input-row"><span class="label-icon"><img
                                            src="<?php echo \yii\helpers\Url::to('/images/finalPayment.png'); ?>"
                                            alt="finalPayment"/></span>
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
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">
            <h3>Contractor Information</h3>
        </div>

        <div class="box-body">
            <div class="form-group field-contacts-contactcontractor updated">
                <label class="control-label">Do you have a Contractor/Installer</label>
                <input type="hidden" name="Contacts[contactContractor]" value="">
                <div id="contacts-contactcontractor" prompt="" aria-invalid="false" class="form-container checkboxes">
                    <label>
                        <input type="radio" name="Contacts[contactContractor]" value="Yes" <?= ($model->contactContractor == 'Yes') ? 'checked' : '' ?>>
                        Yes (Please include their information below) <span class="selected"></span></label>
                    <label>
                        <input type="radio" name="Contacts[contactContractor]" value="No" <?= ($model->contactContractor == 'No') ? 'checked' : '' ?>>
                        No <span class="selected"></span></label>
                </div>
                <div class="help-block"></div>
            </div>


            <div class="form-group field-contacts-contactreferral updated">
                <label class="control-label">If no, would you like our referral list</label>
                <input type="hidden" name="Contacts[contactReferral]" value="">
                <div id="contacts-contactreferral" prompt="" aria-invalid="false" class="form-container checkboxes" >
                    <label>
                        <input type="radio" name="Contacts[contactReferral]" value="Yes" <?= ($model->contactReferral == 'Yes') ? 'checked' : '' ?>>
                        Yes <span class="selected"></span></label>
                    <label>
                        <input type="radio" name="Contacts[contactReferral]" value="No" <?= ($model->contactReferral == 'No') ? 'checked' : '' ?>>
                        No <span class="selected"></span></label>
                </div>
                <div class="help-block"></div>
            </div>


            <div class="form-group field-contactcontractorinfo-selectiontype required updated">
                <label class="control-label">If yes, would you prefer</label>
                <input type="hidden" name="ContactContractorInfo[selectionType]" value="">
                <div id="contactcontractorinfo-selectiontype" prompt="" aria-required="true"
                     class="form-container checkboxes">
                    <label>
                        <input type="radio" name="ContactContractorInfo[selectionType]" value="Own" <?= ($modelContactContractorInfo->selectionType == 'Own') ? 'checked' : '' ?>>
                        To make a selection on your own <span class="selected"></span></label>
                    <label>
                        <input type="radio" name="ContactContractorInfo[selectionType]" value="Rok" <?= ($modelContactContractorInfo->selectionType == 'Rok') ? 'checked' : '' ?>>
                        To ROK to give you final design to two contractors from the list who service your country so
                        they may provide you with quotes and you choose from them. <span
                                class="selected"></span></label>
                </div>
                <div class="help-block"></div>
            </div>

            <div class="job-required-services updated">
                <label class="control-label">What service will you require for this job ?</label>
                <div class="form-group form-container checkboxes">
                    <input type="hidden" name="ContactContractorInfo[ServiceDemolition]" value="0">
                    <label>
                        <input type="checkbox" id="contactcontractorinfo-servicedemolition"
                               name="ContactContractorInfo[ServiceDemolition]" value="1"
                        <?= ($modelContactContractorInfo->ServiceDemolition == 1) ? 'checked' : '' ?>
                        >
                        Demolation <span class="selected"></span></label>
                    <input type="hidden" name="ContactContractorInfo[ServicePaint]" value="0">
                    <label>
                        <input type="checkbox" id="contactcontractorinfo-servicepaint"
                               name="ContactContractorInfo[ServicePaint]" value="1"
                            <?= ($modelContactContractorInfo->ServicePaint == 1) ? 'checked' : '' ?>
                        >
                        Paint <span class="selected"></span></label>
                    <input type="hidden" name="ContactContractorInfo[ServiceBacksplashInstallation]" value="0">
                    <label>
                        <input type="checkbox" id="contactcontractorinfo-servicebacksplashinstallation"
                               name="ContactContractorInfo[ServiceBacksplashInstallation]" value="1"
                            <?= ($modelContactContractorInfo->ServiceBacksplashInstallation == 1) ? 'checked' : '' ?>
                        >
                        Backsplash Installation <span class="selected"></span></label>
                    <input type="hidden" name="ContactContractorInfo[ServiceCountertopInstallation]" value="0">
                    <label>
                        <input type="checkbox" id="contactcontractorinfo-servicecountertopinstallation"
                               name="ContactContractorInfo[ServiceCountertopInstallation]" value="1"
                            <?= ($modelContactContractorInfo->ServiceCountertopInstallation == 1) ? 'checked' : '' ?>
                        >
                        Countertop Installation <span class="selected"></span></label>
                    <input type="hidden" name="ContactContractorInfo[ServiceApplianceInstallationGas]" value="0">
                    <label>
                        <input type="checkbox" id="contactcontractorinfo-serviceapplianceinstallationgas"
                               name="ContactContractorInfo[ServiceApplianceInstallationGas]" value="1"
                            <?= ($modelContactContractorInfo->ServiceApplianceInstallationGas == 1) ? 'checked' : '' ?>
                        >
                        Appliance Installation Gas <span class="selected"></span></label>
                    <input type="hidden" name="ContactContractorInfo[ServiceApplianceInstallationElectric]" value="0">
                    <label>
                        <input type="checkbox" id="contactcontractorinfo-serviceapplianceinstallationelectric"
                               name="ContactContractorInfo[ServiceApplianceInstallationElectric]" value="1"
                            <?= ($modelContactContractorInfo->ServiceApplianceInstallationElectric == 1) ? 'checked' : '' ?>
                        >
                        Appliance Installation Electric <span class="selected"></span></label>
                    <input type="hidden" name="ContactContractorInfo[ServiceSinkInstallation]" value="0">
                    <label>
                        <input type="checkbox" id="contactcontractorinfo-servicesinkinstallation"
                               name="ContactContractorInfo[ServiceSinkInstallation]" value="1"
                            <?= ($modelContactContractorInfo->ServiceSinkInstallation == 1) ? 'checked' : '' ?>
                        >
                        Sink Installation <span class="selected"></span></label>
                    <input type="hidden" name="ContactContractorInfo[ServiceElectrical]" value="0">
                    <label>
                        <input type="checkbox" id="contactcontractorinfo-serviceelectrical"
                               name="ContactContractorInfo[ServiceElectrical]" value="1"
                            <?= ($modelContactContractorInfo->ServiceElectrical == 1) ? 'checked' : '' ?>
                        >
                        Electric <span class="selected"></span></label>
                    <input type="hidden" name="ContactContractorInfo[ServicePlumbing]" value="0">
                    <label>
                        <input type="checkbox" id="contactcontractorinfo-serviceplumbing"
                               name="ContactContractorInfo[ServicePlumbing]" value="1"
                            <?= ($modelContactContractorInfo->ServicePlumbing == 1) ? 'checked' : '' ?>
                        >
                        Plumbing <span class="selected"></span></label>
                    <input type="hidden" name="ContactContractorInfo[ServicePlumbing]" value="0">
                    <label>
                        <input type="checkbox" id="contactcontractorinfo-serviceplumbing"
                               name="ContactContractorInfo[ServicePlumbing]" value="1"
                            <?= ($modelContactContractorInfo->ServicePlumbing == 1) ? 'checked' : '' ?>
                        >
                        Plumbing <span class="selected"></span></label>
                </div>
            </div>
            <div class="contractor-info-box">
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

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-warning btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$showServices = '';
if($modelContactContractorInfo->selectionType != 'Own') {
    $showServices = '
    $("[name=\'ContactContractorInfo[selectionType]\']").change(function(){
    if($(this).val() == \'Own\') {
        $(\'.job-required-services\').show();
    } else {
        $(\'.job-required-services\').hide();
    }
    
    
});

$(\'.job-required-services\').hide();

';


}
$js=<<<EOD



$("[name='Contacts[contactContractor]']").change(function(){
    if($(this).val() == 'Yes') {
        $('.field-contacts-contactreferral').hide();
        $('.field-contactcontractorinfo-selectiontype').hide();
    } else {
        $('.field-contacts-contactreferral').show();
    }
});


$("[name='Contacts[contactReferral]']").change(function(){
    if($(this).val() == 'Yes') {
        $('.field-contactcontractorinfo-selectiontype').show();
    } else {
        $('.field-contactcontractorinfo-selectiontype').hide();
    }
});


$showServices


$(".sub-contact-of").change(function(){
    if($(this).is(':checked')) {
        $('.field-contacts-fkcontactpersonid').show();
    } else {
        $('.field-contacts-fkcontactpersonid').hide();
    }
});


$("[name='Contacts[contactBillingAddressType]']").change(function(){
    var val = $(this).val();
    console.log( val );
    
    if(val == 'Contact') {
        $('#contacts-contactbillingaddress').val( $('#contacts-contactaddress').val() );
        $('#contacts-contactbillingaddress2').val( $('#contacts-contactaddress2').val() );
        $('#contacts-contactbillingcity').val( $('#contacts-contactcity').val() );
        $('#contacts-contactbillingstate').val( $('#contacts-contactstate').val() );
        $('#contacts-contactbillingzip').val( $('#contacts-contactzip').val() );
    } else if(val == 'ParentContact') {
        // Run Ajax here
        
        var contactID = $('#contacts-fkcontactpersonid').val();
        
        $.getJSON('/contacts/get-address-by-id?id='+contactID, function(data) {
            $('#contacts-contactbillingaddress').val( data.data.contactAddress );
            $('#contacts-contactbillingaddress2').val( data.data.contactAddress2 );
            $('#contacts-contactbillingcity').val( data.data.contactCity );
            $('#contacts-contactbillingstate').val( data.data.contactState );
            $('#contacts-contactbillingzip').val( data.data.contactZip );
        });
        
    } else {
    
        $('#contacts-contactbillingaddress').val('');
        $('#contacts-contactbillingaddress2').val('');
        $('#contacts-contactbillingcity').val('');
        $('#contacts-contactbillingstate').val('');
        $('#contacts-contactbillingzip').val('');
    }
});


$("[name='ContactContractorInfo[selectionType]']").trigger('change');

EOD;

$this->registerJs(
    $js,
    View::POS_READY
);
?>
