<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%project_completion}}".
 *
 * @property int $pkProjectCompletionID Project Completion ID
 * @property int $fkContactID Contact ID
 * @property string $projectCompletionStatus Project Status
 *
 * @property Contacts $fkContact
 */
class ProjectCompletion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%project_completion}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkContactID'], 'required'],
            [['projectCompletionStatus'], 'safe'],
            [['projectCompletionStatus'], 'default', 'value'=> NULL],
            [['fkContactID'], 'integer'],
            [['fkContactID'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['fkContactID' => 'pkContactID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkProjectCompletionID' => 'Project Completion ID',
            'fkContactID' => 'Contact ID',
            'projectCompletionStatus' => 'Project Completion',
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
