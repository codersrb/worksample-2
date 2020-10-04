<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%project_types}}".
 *
 * @property int $pkProjectTypeID Project Type ID
 * @property string $projectTypeName Type Name
 *
 * @property Contacts[] $contacts
 */
class ProjectTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%project_types}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['projectTypeName'], 'required'],
            [['projectTypeName'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkProjectTypeID' => 'Project Type ID',
            'projectTypeName' => 'Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['contactProjectTypeID' => 'pkProjectTypeID']);
    }
}
