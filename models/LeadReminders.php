<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%lead_reminders}}".
 *
 * @property int $pkLeadReminderID Lead Reminder ID
 * @property int $fkLeadID Lead ID
 * @property string $leadReminderDate Reminder Date
 * @property string $leadReminderAdded Added At
 * @property string $leadReminderModified Modified At
 *
 * @property Leads $fkLead
 * @property User $fkUser
 */
class LeadReminders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lead_reminders}}';
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'leadReminderAdded',
                'updatedAtAttribute' => 'leadReminderModified',
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
            [['fkLeadID', 'leadReminderDate', 'leadReminderText'], 'required'],
            [['fkLeadID'], 'integer'],
            [['leadReminderText'], 'string'],
            [['leadReminderDate', 'leadReminderAdded', 'leadReminderModified'], 'safe'],
            [['fkLeadID'], 'exist', 'skipOnError' => true, 'targetClass' => Leads::className(), 'targetAttribute' => ['fkLeadID' => 'pkLeadID']],
            [['fkUserID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fkUserID' => 'pkUserID']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkLeadReminderID' => 'Lead Reminder ID',
            'fkLeadID' => 'Lead ID',
            'leadReminderDate' => 'Reminder Date',
            'leadReminderAdded' => 'Added At',
            'leadReminderModified' => 'Modified At',
            'fkUserID' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkLead()
    {
        return $this->hasOne(Leads::className(), ['pkLeadID' => 'fkLeadID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkUser()
    {
        return $this->hasOne(User::className(), ['pkUserID' => 'fkUserID']);
    }
}
