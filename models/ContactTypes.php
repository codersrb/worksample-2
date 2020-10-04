<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%contact_types}}".
 *
 * @property int $pkContactTypeID Contact Type ID
 * @property string $contactTypeName Contact Type Name
 *
 * @property Contacts[] $contacts
 */
class ContactTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact_types}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contactTypeName'], 'required'],
            [['contactTypeName'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkContactTypeID' => 'Contact Type ID',
            'contactTypeName' => 'Contact Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['contactContactTypeID' => 'pkContactTypeID']);
    }
}
