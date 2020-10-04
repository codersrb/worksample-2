<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */

$this->title = 'Contact ID : '.$model->pkContactID;
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pkContactID], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pkContactID], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>




    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'contactType:text:This is a',
    ]]); ?>

    <div class="box box-default">
        <div class="box-header with-border">
            <h3>Contact Information</h3>
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-md-6">
                    <label class="control-label" for="contacts-primarycontact">Primary Contact</label>
                    <?php
                        foreach($model->getContactPersons()->where(['contactPersonType' => 'Primary'])->all() as $eachPerson) {
                            ?>
                            <?= DetailView::widget([
                                'model' => $eachPerson,
                                'attributes' => [
                                    'contactPersonFullName',
                                    'contactPersonPhone',
                                    'contactPersonEmail'
                                ]]); ?>
                            <?php
                        }
                    ?>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'fkContactPersonID',
                            'referrerID',
                        ]]); ?>

                </div>

                <div class="col-md-6">
                    <label class="control-label" for="contacts-primarycontact">Secondary Contact</label>
                    <?php
                    foreach($model->getContactPersons()->where(['contactPersonType' => 'Secondary'])->all() as $eachPerson) {
                        ?>
                        <?= DetailView::widget([
                            'model' => $eachPerson,
                            'attributes' => [
                                'contactPersonFullName',
                                'contactPersonPhone',
                                'contactPersonEmail'
                            ]]); ?>
                        <?php
                    }
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
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'contactAddress',
                            'contactAddress2',
                            'contactCity',
                            'contactState',
                            'contactZip',
                            'contactCountry',
                        ]]); ?>
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
                <div class="col-md-12">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'contactBillingAddressType',
                            'contactBillingAddress',
                            'contactBillingAddress2',
                            'contactBillingCity',
                            'contactBillingState',
                            'contactBillingZip',
                            'contactBillingCountry',
                        ]]); ?>
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
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'contactOpportunityTitle',
                            'contactPropertyAddress',
                            'contactPropertyCity',
                            'contactPropertyState',
                            'contactPropertyCountry',
                            [
                                    'attribute' => 'contactProjectTypeID',
                                    'value' => $model->contactProjectType->projectTypeName
                            ],
                            [
                                'attribute' => 'contactContactTypeID',
                                'value' => $model->contactContactType->contactTypeName
                            ],
                            [
                                'attribute' => 'contactStatusID',
                                'value' => $model->contactStatus->contactStatusName
                            ],
                            [
                                'attribute' => 'contactSourceID',
                                'value' => $model->contactSource->contactSourceName
                            ],
                            [
                                'attribute' => 'contactSourceID',
                                'value' => $model->contactSource->contactSourceName
                            ],
                            [
                                'attribute' => 'contactTags',
                                'value' => implode(',', $model->getContactTags()->select(['tagName'])->joinWith('fkTag')->column())
                            ],
                        ]]); ?>
                </div>
            </div>
        </div>
    </div>


    <div class="box box-default">
        <div class="box-header with-border">
            <h3>Contractor Information</h3>
        </div>
        <div class="box-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'contactContractor',
                    'contactReferral',
                ]]); ?>


            <?= DetailView::widget([
                'model' => $model->getContactContractorInfos()->one(),
                'attributes' => [
                    'selectionType',
                ]]); ?>

            <h4>Contractor</h4>
            <?= DetailView::widget([
                'model' => $model->getContactContractorInfos()->one(),
                'attributes' => [
                    'contractorCompanyName',
                    'contractorCompanyOfficePhone',
                    'contractorCompanyStreetAddress',
                    'contractorCompanyCity',
                    'contractorCompanyState',
                    'contractorCompanyZip',
                ]]); ?>

            <h4>Contractor</h4>
            <?= DetailView::widget([
                'model' => $model->getContactContractorInfos()->one(),
                'attributes' => [
                    'contractorName',
                    'contractorCellPhone',
                    'contractorOfficePhone',
                    'contractorExt',
                    'contractorEmail',
                ]]); ?>

            <h4>Contractor Project Manager</h4>
            <?= DetailView::widget([
                'model' => $model->getContactContractorInfos()->one(),
                'attributes' => [
                    'contractorPMName',
                    'contractorPMCellphone',
                    'contractorPMOfficePhone',
                    'contractorPMExt',
                    'contractorPMEmail',
                ]]); ?>
        </div>
    </div>



</div>
