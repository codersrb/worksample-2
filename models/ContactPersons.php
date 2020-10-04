<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%contact_persons}}".
 *
 * @property int $pkContactPersonID Contact Person ID
 * @property int $fkContactID Contact ID
 * @property string $contactPersonFullName Full Name
 * @property string $contactPersonPhone Phone
 * @property string $contactPersonEmail Email
 * @property int $fkContactPersonID Contact Person ID
 * @property string $contactPersonType Type
 *
 * @property Contacts $fkContact
 */
class ContactPersons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact_persons}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkContactID', 'contactPersonFullName', 'contactPersonPhone', 'contactPersonEmail', 'contactPersonType'], 'required'],
            [['fkContactID', 'fkContactPersonID'], 'integer'],
            [['contactPersonFullName', 'contactPersonPhone', 'contactPersonEmail', 'contactPersonType'], 'string'],
            [['fkContactID'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['fkContactID' => 'pkContactID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkContactPersonID' => 'Contact Person ID',
            'fkContactID' => 'Contact ID',
            'contactPersonFullName' => 'Full Name',
            'contactPersonPhone' => 'Phone Number',
            'contactPersonEmail' => 'Email Address',
            'fkContactPersonID' => 'Contact Person ID',
            'contactPersonType' => 'Type',
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
