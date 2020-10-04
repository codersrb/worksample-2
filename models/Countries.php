<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%countries}}".
 *
 * @property int $pkCountryID
 * @property string $countryCode
 * @property string $countryName
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%countries}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['countryCode'], 'string', 'max' => 2],
            [['countryName'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkCountryID' => 'Pk Country ID',
            'countryCode' => 'Country Code',
            'countryName' => 'Country Name',
        ];
    }
}
