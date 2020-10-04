<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%contact_contractor_info}}".
 *
 * @property int $pkContactContractorInfoID Contact Contractor Info
 * @property int $fkContactID Contact ID
 * @property string $selectionType Contractor Selection
 * @property int $ServiceDemolition Demolation
 * @property int $ServicePaint Paint
 * @property int $ServiceBacksplashInstallation Backsplash Installation
 * @property int $ServiceCountertopInstallation Countertop Installation
 * @property int $ServiceApplianceInstallationGas Appliance Installation Gas
 * @property int $ServiceApplianceInstallationElectric Appliance Installation Electric
 * @property int $ServiceSinkInstallation Sink Installation
 * @property int $ServiceElectrical Electric
 * @property int $ServicePlumbing Plumbing
 * @property string $contractorCompanyName Company Name
 * @property string $contractorCompanyOfficePhone Office Phone
 * @property string $contractorCompanyStreetAddress Company Street Address
 * @property string $contractorCompanyCity City
 * @property string $contractorCompanyState State
 * @property string $contractorCompanyZip Zip
 * @property string $contractorName Contractor Name
 * @property string $contractorCellPhone Cellphone
 * @property string $contractorOfficePhone Office Phone
 * @property string $contractorExt Ext
 * @property string $contractorEmail Email
 * @property string $contractorPMName Project Manager
 * @property string $contractorPMCellphone Cellphone
 * @property string $contractorPMOfficePhone Office Phone
 * @property string $contractorPMExt Ext
 * @property string $contractorPMEmail Email
 *
 * @property Contacts $fkContact
 */
class ContactContractorInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact_contractor_info}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkContactID', 'selectionType'], 'required'],
            [['fkContactID', 'ServiceDemolition', 'ServicePaint', 'ServiceBacksplashInstallation', 'ServiceCountertopInstallation', 'ServiceApplianceInstallationGas', 'ServiceApplianceInstallationElectric', 'ServiceSinkInstallation', 'ServiceElectrical', 'ServicePlumbing'], 'integer'],
            [['selectionType', 'contractorCompanyName', 'contractorCompanyOfficePhone', 'contractorCompanyStreetAddress', 'contractorCompanyCity', 'contractorCompanyState', 'contractorCompanyZip', 'contractorName', 'contractorCellPhone', 'contractorOfficePhone', 'contractorExt', 'contractorEmail', 'contractorPMName', 'contractorPMCellphone', 'contractorPMOfficePhone', 'contractorPMExt', 'contractorPMEmail'], 'string'],
            [['fkContactID'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['fkContactID' => 'pkContactID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkContactContractorInfoID' => 'Contact Contractor Info',
            'fkContactID' => 'Contact ID',
            'selectionType' => 'If yes, would you prefer',
            'ServiceDemolition' => 'Demolation',
            'ServicePaint' => 'Paint',
            'ServiceBacksplashInstallation' => 'Backsplash Installation',
            'ServiceCountertopInstallation' => 'Countertop Installation',
            'ServiceApplianceInstallationGas' => 'Appliance Installation Gas',
            'ServiceApplianceInstallationElectric' => 'Appliance Installation Electric',
            'ServiceSinkInstallation' => 'Sink Installation',
            'ServiceElectrical' => 'Electric',
            'ServicePlumbing' => 'Plumbing',
            'contractorCompanyName' => 'Company Name',
            'contractorCompanyOfficePhone' => 'Office Phone',
            'contractorCompanyStreetAddress' => 'Company Street Address',
            'contractorCompanyCity' => 'City',
            'contractorCompanyState' => 'State',
            'contractorCompanyZip' => 'Zip',
            'contractorName' => 'Contractor Name',
            'contractorCellPhone' => 'Cellphone',
            'contractorOfficePhone' => 'Office Phone',
            'contractorExt' => 'Ext',
            'contractorEmail' => 'Email',
            'contractorPMName' => 'Project Manager',
            'contractorPMCellphone' => 'Cellphone',
            'contractorPMOfficePhone' => 'Office Phone',
            'contractorPMExt' => 'Ext',
            'contractorPMEmail' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkContact()
    {
        return $this->hasOne(Contacts::className(), ['pkContactID' => 'fkContactID']);
    }
}
