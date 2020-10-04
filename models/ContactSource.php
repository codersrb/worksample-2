<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%contact_source}}".
 *
 * @property int $pkContactSourceID Source ID
 * @property string $contactSourceName Source Name
 *
 * @property Contacts[] $contacts
 */
class ContactSource extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact_source}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contactSourceName'], 'required'],
            [['contactSourceName'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkContactSourceID' => 'Source ID',
            'contactSourceName' => 'Source Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['contactSourceID' => 'pkContactSourceID']);
    }
}
