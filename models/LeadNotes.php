<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%lead_notes}}".
 *
 * @property int $pkLeadNoteID Lead Note ID
 * @property int $fkLeadID Lead ID
 * @property string $leadNoteText Note Text
 * @property string $leadNoteAddedFrom Added From
 * @property string $leadNoteAdded Added At
 * @property string $leadNoteModified Modified At
 *
 * @property Leads $fkLead
 * @property User $fkUser
 */
class LeadNotes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lead_notes}}';
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'leadNoteAdded',
                'updatedAtAttribute' => 'leadNoteModified',
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
            [['fkLeadID', 'leadNoteText', 'leadNoteAddedFrom'], 'required'],
            [['fkLeadID', 'fkUserID'], 'integer'],
            [['leadNoteText'], 'string'],
            [['leadNoteAdded', 'leadNoteModified'], 'safe'],
            [['leadNoteAddedFrom'], 'string', 'max' => 255],
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
            'pkLeadNoteID' => 'Lead Note ID',
            'fkLeadID' => 'Lead ID',
            'leadNoteText' => 'Note Text',
            'leadNoteAddedFrom' => 'Added From',
            'leadNoteAdded' => 'Added At',
            'leadNoteModified' => 'Modified At',
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
