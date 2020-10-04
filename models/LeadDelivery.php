<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%lead_delivery}}".
 *
 * @property int $pkLeadDesignID Lead Delivery ID
 * @property int $fkLeadID Lead ID
 * @property string $ldlPreferredDate1 Preferred Date 1
 * @property string $ldlPreferredDate2 Preferred Date 2
 * @property string $ldlPreferredDate3 Preferred Date 3
 * @property string $ldlContractorName1 Contractor Name
 * @property string $ldlContractorDateTime1 Contact Date
 * @property string $ldlContractorName2 Contractor Name
 * @property string $ldlContractorDateTime2 Contact Date
 * @property string $ldlDemoFor Demo Coordinated For
 * @property string $ldlDemoAt
 * @property string $ldlDemoBy Delivery / Assembly At
 * @property string $ldlDemoNotes Notes
 * @property string $ldlDeliveryFor Delivery For
 * @property string $ldlDeliveryAt Delivery At
 * @property string $ldlDeliveryBy Delivery By
 * @property string $ldlDeliveryNotes Notes
 * @property string $ldlCabinetFor Cabinet For
 * @property string $ldlCabinetAt Cabinet At
 * @property string $ldlCabinetBy Cabinet By
 * @property string $ldlCabinetNotes Notes
 * @property string $ldlCounterTopFor Countertop for
 * @property string $ldlCounterTopAt Countertop At
 * @property string $ldlCounterTopBy Countertop By
 * @property string $ldlCounterTopNotes Notes
 * @property string $ldlBackSplashFor Backsplash For
 * @property string $ldlBackSplashAt Backsplash At
 * @property string $ldlBackSplashBy BackSplash At
 * @property string $ldlBackSplashNotes Notes
 * @property string $ldlDesignEmail Design and Packing Slip Emailed
 * @property string $ldlPOEmail1 PO Email
 * @property string $ldlPOProduct1 Product Title
 * @property string $ldlPOEmail2 PO Email
 * @property string $ldlPOProduct2 Product Title
 * @property string $ldlPOEmail3 PO Email
 * @property string $ldlPOProduct3 Product Title
 * @property string $ldlPOEmail4 PO Email
 * @property string $ldlPOProduct4 Product Title
 * @property string $ldlPOEmail5 PO Email
 * @property string $ldlPOProduct5 Product Title
 * @property string $ldlCustomerApprovalCreated Date Customer Approval
 * @property string $ldlCustomerApprovalEmaled Date Customer Approval Email To
 * @property string $ldlCustomerRequestForQuoteEmailedOn Request For Quotation Email On
 * @property string $ldlAdded Added At
 * @property string $ldlModified Modified At
 *
 * @property Leads $fkLead
 */
class LeadDelivery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lead_delivery}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'ldlAdded',
                'updatedAtAttribute' => 'ldlModified',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkLeadID', 'ldlPreferredDate1', 'ldlContractorName1', 'ldlContractorDateTime1', 'ldlDemoFor', 'ldlDemoAt', 'ldlDemoBy', 'ldlDeliveryFor', 'ldlDeliveryAt', 'ldlDeliveryBy', 'ldlCabinetFor', 'ldlCabinetAt', 'ldlCabinetBy', 'ldlCounterTopFor', 'ldlCounterTopAt', 'ldlCounterTopBy', 'ldlBackSplashFor', 'ldlBackSplashAt', 'ldlBackSplashBy', 'ldlPOEmail1', 'ldlPOProduct1'], 'required'],
            [['fkLeadID'], 'integer'],
            [['ldlPreferredDate1', 'ldlPreferredDate2', 'ldlPreferredDate3', 'ldlContractorDateTime1', 'ldlContractorDateTime2', 'ldlDemoAt', 'ldlDemoBy', 'ldlDeliveryAt', 'ldlCabinetAt', 'ldlCounterTopAt', 'ldlBackSplashAt', 'ldlDesignEmail', 'ldlCustomerApprovalCreated', 'ldlAdded', 'ldlModified'], 'safe'],
            [['ldlContractorName1', 'ldlContractorName2', 'ldlDemoFor', 'ldlDemoNotes', 'ldlDeliveryFor', 'ldlDeliveryBy', 'ldlDeliveryNotes', 'ldlCabinetFor', 'ldlCabinetBy', 'ldlCabinetNotes', 'ldlCounterTopFor', 'ldlCounterTopBy', 'ldlCounterTopNotes', 'ldlBackSplashFor', 'ldlBackSplashBy', 'ldlBackSplashNotes', 'ldlPOEmail1', 'ldlPOProduct1', 'ldlPOEmail2', 'ldlPOProduct2', 'ldlPOEmail3', 'ldlPOProduct3', 'ldlPOEmail4', 'ldlPOProduct4', 'ldlPOEmail5', 'ldlPOProduct5', 'ldlCustomerApprovalEmaled', 'ldlCustomerRequestForQuoteEmailedOn'], 'string'],
            [['fkLeadID'], 'exist', 'skipOnError' => true, 'targetClass' => Leads::className(), 'targetAttribute' => ['fkLeadID' => 'pkLeadID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkLeadDesignID' => 'Lead Delivery ID',
            'fkLeadID' => 'Lead ID',
            'ldlPreferredDate1' => 'Preferred Date 1',
            'ldlPreferredDate2' => 'Preferred Date 2',
            'ldlPreferredDate3' => 'Preferred Date 3',
            'ldlContractorName1' => 'Contractor Name',
            'ldlContractorDateTime1' => 'Contact Date',
            'ldlContractorName2' => 'Contractor Name',
            'ldlContractorDateTime2' => 'Contact Date',
            'ldlDemoFor' => 'Demo Coordinated For',
            'ldlDemoAt' => 'Demo At',
            'ldlDemoBy' => 'Delivery / Assembly At',
            'ldlDemoNotes' => 'Notes',
            'ldlDeliveryFor' => 'Delivery For',
            'ldlDeliveryAt' => 'Delivery At',
            'ldlDeliveryBy' => 'Delivery By',
            'ldlDeliveryNotes' => 'Notes',
            'ldlCabinetFor' => 'Cabinet For',
            'ldlCabinetAt' => 'Cabinet At',
            'ldlCabinetBy' => 'Cabinet By',
            'ldlCabinetNotes' => 'Notes',
            'ldlCounterTopFor' => 'Countertop for',
            'ldlCounterTopAt' => 'Countertop At',
            'ldlCounterTopBy' => 'Countertop By',
            'ldlCounterTopNotes' => 'Notes',
            'ldlBackSplashFor' => 'Backsplash For',
            'ldlBackSplashAt' => 'Backsplash At',
            'ldlBackSplashBy' => 'BackSplash By',
            'ldlBackSplashNotes' => 'Notes',
            'ldlDesignEmail' => 'Design, & Packing slips are emailed to customer\'s contract/Installer, copying Sales Support',
            'ldlPOEmail1' => 'PO Email',
            'ldlPOProduct1' => 'Product Title',
            'ldlPOEmail2' => 'PO Email',
            'ldlPOProduct2' => 'Product Title',
            'ldlPOEmail3' => 'PO Email',
            'ldlPOProduct3' => 'Product Title',
            'ldlPOEmail4' => 'PO Email',
            'ldlPOProduct4' => 'Product Title',
            'ldlPOEmail5' => 'PO Email',
            'ldlPOProduct5' => 'Product Title',
            'ldlCustomerApprovalCreated' => 'Date packing slips & Customer Approval Form Created',
            'ldlCustomerApprovalEmaled' => 'Date the design, packing slips, Customer Approval Form and requested date(s) fo delivery and assembly, emailed to:',
            'ldlCustomerRequestForQuoteEmailedOn' => 'Date a Request for Quotes along with design, packing slips, and Contact & Order Information form are emailed to 2 Contractor(s) on referral list (quotes should be emailed to customer within 24h). Copy Sales Support on emails:',
            'ldlAdded' => 'Added At',
            'ldlModified' => 'Modified At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkLead()
    {
        return $this->hasOne(Leads::className(), ['pkLeadID' => 'fkLeadID']);
    }
}
