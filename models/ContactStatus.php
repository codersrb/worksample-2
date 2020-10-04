<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%contact_status}}".
 *
 * @property int $pkContactStatusID Contact Status ID
 * @property string $contactStatusName Contact Status
 *
 * @property Contacts[] $contacts
 */
class ContactStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact_status}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contactStatusName'], 'required'],
            [['contactStatusName'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkContactStatusID' => 'Contact Status ID',
            'contactStatusName' => 'Contact Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['contactStatusID' => 'pkContactStatusID']);
    }
}
