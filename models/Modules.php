<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%modules}}".
 *
 * @property int $pkModuleID Module ID
 * @property string $moduleName Name
 * @property string $Route Route
 * @property int $fkParentModuleID Parent Module
 *
 * @property Modules $fkParentModule
 * @property Modules[] $modules
 * @property UserModules[] $userModules
 */
class Modules extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%modules}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['moduleName', 'Route'], 'required'],
            [['moduleName', 'Route'], 'string'],
            [['fkParentModuleID'], 'integer'],
            [['fkParentModuleID'], 'exist', 'skipOnError' => true, 'targetClass' => Modules::className(), 'targetAttribute' => ['fkParentModuleID' => 'pkModuleID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkModuleID' => 'Module ID',
            'moduleName' => 'Name',
            'Route' => 'Route',
            'fkParentModuleID' => 'Parent Module',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkParentModule()
    {
        return $this->hasOne(Modules::className(), ['pkModuleID' => 'fkParentModuleID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModules()
    {
        return $this->hasMany(Modules::className(), ['fkParentModuleID' => 'pkModuleID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserModules()
    {
        return $this->hasMany(UserModules::className(), ['fkModuleID' => 'pkModuleID']);
    }
}
