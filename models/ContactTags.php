<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%contact_tags}}".
 *
 * @property int $pkContactTagID Contact Tag ID
 * @property int $fkContactID Contact ID
 * @property int $fkTagID Tag ID
 *
 * @property Contacts $fkContact
 * @property Tags $fkTag
 */
class ContactTags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact_tags}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkContactID', 'fkTagID'], 'required'],
            [['fkContactID', 'fkTagID'], 'integer'],
            [['fkTagID', 'fkContactID'], 'unique', 'targetAttribute' => ['fkTagID', 'fkContactID']],
            [['fkContactID'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['fkContactID' => 'pkContactID']],
            [['fkTagID'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['fkTagID' => 'pkTagID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkContactTagID' => 'Contact Tag ID',
            'fkContactID' => 'Contact ID',
            'fkTagID' => 'Tag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkContact()
    {
        return $this->hasOne(Contacts::className(), ['pkContactID' => 'fkContactID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkTag()
    {
        return $this->hasOne(Tags::className(), ['pkTagID' => 'fkTagID']);
    }

    public static function findOrAdd($tagName, $fkContactID)
    {
        $find = Tags::findOne(['tagName' => $tagName]);

        if($find) {

            $findContactTag = self::find()->where(['fkTagID' => $find->pkTagID, 'fkContactID' => $fkContactID])->one();

            if(!$findContactTag) {
                self::addContactTag($find->pkTagID, $fkContactID);
                return true;
            }

        } else {

            $addTag = new Tags;
            $addTag->tagName = $tagName;

            if($addTag->save()) {
                self::addContactTag($addTag->pkTagID, $fkContactID);
                return true;
            } else {
                return false;
            }
        }
    }

    public static function addContactTag($fkTagID, $fkContactID)
    {
        $contactTag = new Self;
        $contactTag->fkTagID = $fkTagID;
        $contactTag->fkContactID = $fkContactID;

        if($contactTag->save()) {
            return true;
        }
        return false;
    }
}
