<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_modules}}".
 *
 * @property int $pkUserModuleID User Module ID
 * @property int $fkUserID User ID
 * @property int $fkModuleID Module ID
 *
 * @property Modules $fkModule
 * @property Users $fkUser
 */
class UserModules extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_modules}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkUserID', 'fkModuleID'], 'required'],
            [['fkUserID', 'fkModuleID'], 'integer'],
            [['fkModuleID'], 'exist', 'skipOnError' => true, 'targetClass' => Modules::className(), 'targetAttribute' => ['fkModuleID' => 'pkModuleID']],
            [['fkUserID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['fkUserID' => 'pkUserID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkUserModuleID' => 'User Module ID',
            'fkUserID' => 'User ID',
            'fkModuleID' => 'Module ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkModule()
    {
        return $this->hasOne(Modules::className(), ['pkModuleID' => 'fkModuleID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkUser()
    {
        return $this->hasOne(Users::className(), ['pkUserID' => 'fkUserID']);
    }
}
