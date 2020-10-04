<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%leads}}".
 *
 * @property int $pkLeadID Lead ID
 * @property int $fkContactID Contact ID
 * @property string $leadAdded Added At
 * @property string $leadModified Modified At
 *
 * @property Contacts $fkContact
 */
class Leads extends \yii\db\ActiveRecord
{

    public $contactOpportunityTitle;
    public $contactPersonFullName;
    public $contactSourceName;
    public $contactStatusName;

    public $age;
    public $progress;
    public $lastContacted;
    public $estimated;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%leads}}';
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'leadAdded',
                'updatedAtAttribute' => 'leadModified',
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
            [['fkContactID'], 'required'],
            [['fkContactID'], 'integer'],
            [['leadAdded', 'leadModified'], 'safe'],
            [['fkContactID'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['fkContactID' => 'pkContactID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkLeadID' => 'Lead ID',
            'fkContactID' => 'Contact ID',
            'leadAdded' => 'Added At',
            'leadModified' => 'Modified At',
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
