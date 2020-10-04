<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%lead_design_revisions}}".
 *
 * @property int $pkLeadDesignRevisionID Lead Design Revision ID
 * @property int $fkLeadDesignID Lead Design ID
 * @property int $ldrApproved Approved
 * @property int $ldrModificationRequest Modification Request
 * @property string $ldrEmailedToCustomer Emailed to Customer
 *
 * @property LeadDesign $fkLeadDesign
 */
class LeadDesignRevisions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lead_design_revisions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkLeadDesignID', 'ldrApproved', 'ldrModificationRequest'], 'required'],
            [['fkLeadDesignID', 'ldrApproved', 'ldrModificationRequest'], 'integer'],
            [['ldrEmailedToCustomer'], 'safe'],
            [['fkLeadDesignID'], 'exist', 'skipOnError' => true, 'targetClass' => LeadDesign::className(), 'targetAttribute' => ['fkLeadDesignID' => 'pkLeadDesignID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkLeadDesignRevisionID' => 'Lead Design Revision ID',
            'fkLeadDesignID' => 'Lead Design ID',
            'ldrApproved' => 'Approved',
            'ldrModificationRequest' => 'Modification Request',
            'ldrEmailedToCustomer' => 'Emailed to Customer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkLeadDesign()
    {
        return $this->hasOne(LeadDesign::className(), ['pkLeadDesignID' => 'fkLeadDesignID']);
    }
}
