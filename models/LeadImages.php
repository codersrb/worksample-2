<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%lead_images}}".
 *
 * @property int $pkLeadImageID Lead Image ID
 * @property int $fkLeadID Lead ID
 * @property int $leadImageName Lead Image Name
 * @property string $leadImageType Lead Image Type
 *
 * @property Leads $fkLead
 */
class LeadImages extends \yii\db\ActiveRecord
{

    /**
     * @var
     */
    public $leadImageNameFiles;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lead_images}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkLeadID', 'leadImageName', 'leadImageType'], 'required'],
            [['fkLeadID'], 'integer'],
            [['leadImageType', 'leadImageName'], 'string', 'max' => 255],
            [['fkLeadID'], 'exist', 'skipOnError' => true, 'targetClass' => Leads::className(), 'targetAttribute' => ['fkLeadID' => 'pkLeadID']],

            [['leadImageNameFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkLeadImageID' => 'Lead Image ID',
            'fkLeadID' => 'Lead ID',
            'leadImageName' => 'Lead Image Name',
            'leadImageType' => 'Lead Image Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkLead()
    {
        return $this->hasOne(Leads::className(), ['pkLeadID' => 'fkLeadID']);
    }


    /**
     * Upload Image method
     */
    public function upload($filesArray)
    {
        try {
            if (1) {
                if (1) {
                    foreach ($filesArray as $fileAlias => $eachFileArr) {

                        $saveTo = $eachFileArr['saveTo'];
                        $alias = $eachFileArr['alias'];

                        $this->$fileAlias = \yii\web\UploadedFile::getInstances($this, $fileAlias);

                        if ($this->$fileAlias) {
                            // Path Configs
                            $imageBase = Url::to('@app') . '/web' . Yii::$app->params['leadImagePath'];

                            foreach ($this->$fileAlias as $eachFile) {

                                $imageName = \yii\helpers\Inflector::slug($this->fkLeadID . '-' . Yii::$app->security->generateRandomString()) . '.' . $eachFile->extension;
                                $uploadedImageFile = $imageBase . $imageName;

                                if ($eachFile->saveAs($uploadedImageFile)) {
                                    @chmod($uploadedImageFile, 0755);
                                    $imageModel = new LeadImages;
                                    $imageModel->fkLeadID = $this->fkLeadID;
                                    $imageModel->leadImageName = $imageName;
                                    $imageModel->leadImageType = $alias;
                                    if(!$imageModel->save()) {
                                        throw new \Exception(current($imageModel->getFirstErrors()));
                                    }
                                } else {
                                    throw new \Exception('Error while saving '.$alias);
                                }
                            }
                        } else {
                            throw new \Exception('Error while accessing Files array ');
                        }
                    }
                } else {
                    throw new \Exception(current($this->getFirstErrors()));
                }
            }
            return true;
        } catch (\Exception $ex) {
            echo '<pre>';
            print_r($ex->getMessage());
            print_r($ex->getTrace());
            exit;

            +6-+6
            -
            Yii::$app->session->setFlash('success', $ex->getMessage().' '. $ex->getLine());
        }
    }
}
