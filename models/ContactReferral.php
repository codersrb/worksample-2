<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%contact_referral}}".
 *
 * @property int $pkContactReferralID Contact referral ID
 * @property int $fkContactID Contact ID
 * @property int $fkReferredBy Referred By
 *
 * @property Contacts $fkContact
 * @property Contacts $fkReferredBy0
 */
class ContactReferral extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact_referral}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkContactID', 'fkReferredBy'], 'required'],
            [['fkContactID', 'fkReferredBy'], 'integer'],
            [['fkContactID'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['fkContactID' => 'pkContactID']],
            [['fkReferredBy'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['fkReferredBy' => 'pkContactID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkContactReferralID' => 'Contact referral ID',
            'fkContactID' => 'Contact ID',
            'fkReferredBy' => 'Referred By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkContact()
    {
        return $this->hasOne(Contacts::className(), ['pkContactID' => 'fkContactID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkReferredBy0()
    {
        return $this->hasOne(Contacts::className(), ['pkContactID' => 'fkReferredBy']);
    }
}
