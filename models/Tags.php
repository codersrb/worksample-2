<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tags}}".
 *
 * @property int $pkTagID Tag ID
 * @property string $tagName Tag Name
 *
 * @property ContactTags[] $contactTags
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tags}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tagName'], 'required'],
            [['tagName'], 'string', 'max' => 255],
            [['tagName'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkTagID' => 'Tag ID',
            'tagName' => 'Tag Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactTags()
    {
        return $this->hasMany(ContactTags::className(), ['fkTagID' => 'pkTagID']);
    }
}
