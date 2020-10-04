<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%lead_design}}".
 *
 * @property int $pkLeadDesignID Lead Design ID
 * @property int $fkLeadID Lead ID
 * @property string $ldDoorFinishSelection1st Door Finish Selection 1
 * @property string $ldDoorFinishSelection2nd Door Finish Selection 2
 * @property string $ldGraniteColorSelection Granite Color Selection
 * @property string $ldGraniteColorSelectionCut Cut
 * @property string $ldQuartzColorSelection Quartz Color Selection
 * @property string $ldQuartzColorSelectionCut Cut
 * @property string $ldbackSplashLeadSelection Backsplash Selection
 * @property string $ldSinkSelection Sink Selection
 * @property string $ldKnobsSelection Knobs Selection
 * @property string $ldAccessoriesSelection Accessories Selection
 * @property string $ldNotes Notes
 * @property string $ldDesign2D3D Design 2d & 3D
 * @property int $ldInitialDesign Initial Design
 * @property string $ldDesignCompletedBy Completed By
 * @property string $ldDesignEmailed Design Email to Customer
 * @property string $ldFinalEmail Final Email to Customer
 * @property string $ldFinalApproval Final Approval
 * @property string $ldFollowUp1st Follow Up 1
 * @property string $ldFollowUp2nd Follow Up 2
 * @property string $ldAdded Added At
 * @property string $ldModified Modified At
 *
 * @property Leads $fkLead
 * @property LeadDesignRevisions[] $leadDesignRevisions
 */
class LeadDesign extends \yii\db\ActiveRecord
{
    /**
     * @var LeadDesignRevisions
     */
    public $revisions;

    /**
     * @var Lead Design Image
     */
    public $designImage;

    public $ldDesign2D3DFiles;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lead_design}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'ldAdded',
                'updatedAtAttribute' => 'ldModified',
                'value' => new Expression('NOW()'),
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkLeadID', 'ldDoorFinishSelection1st', 'ldDoorFinishSelection2nd', 'ldGraniteColorSelection', 'ldGraniteColorSelectionCut', 'ldQuartzColorSelection', 'ldQuartzColorSelectionCut', 'ldbackSplashLeadSelection', 'ldSinkSelection', 'ldKnobsSelection', 'ldAccessoriesSelection', 'ldNotes', 'ldDesignCompletedBy'], 'required'],
            [['fkLeadID', 'ldInitialDesign'], 'integer'],
            [['ldDoorFinishSelection1st', 'ldDoorFinishSelection2nd', 'ldGraniteColorSelection', 'ldGraniteColorSelectionCut', 'ldQuartzColorSelection', 'ldQuartzColorSelectionCut', 'ldbackSplashLeadSelection', 'ldSinkSelection', 'ldKnobsSelection', 'ldAccessoriesSelection', 'ldNotes', 'ldDesign2D3D', 'ldInitialDesign', 'ldDesignCompletedBy'], 'string'],
            [['ldDesignEmailed', 'ldFinalEmail', 'ldFinalApproval', 'ldFollowUp1st', 'ldFollowUp2nd', 'ldAdded', 'ldModified'], 'safe'],
            [['fkLeadID'], 'exist', 'skipOnError' => true, 'targetClass' => Leads::className(), 'targetAttribute' => ['fkLeadID' => 'pkLeadID']],

            [['ldDesign2D3DFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkLeadDesignID' => 'Lead Design ID',
            'fkLeadID' => 'Lead ID',
            'ldDoorFinishSelection1st' => 'Door Finish Selection 1',
            'ldDoorFinishSelection2nd' => 'Door Finish Selection 2',
            'ldGraniteColorSelection' => 'Granite Color Selection',
            'ldGraniteColorSelectionCut' => 'Cut',
            'ldQuartzColorSelection' => 'Quartz Color Selection',
            'ldQuartzColorSelectionCut' => 'Cut',
            'ldbackSplashLeadSelection' => 'Backsplash Selection',
            'ldSinkSelection' => 'Sink Selection',
            'ldKnobsSelection' => 'Knobs Selection',
            'ldAccessoriesSelection' => 'Accessories Selection',
            'ldNotes' => 'Notes',
            'ldDesign2D3D' => 'Design 2d & 3D',
            'ldDesign2D3DFiles' => 'Design 2d & 3D',
            'ldInitialDesign' => 'Initial Design',
            'ldDesignCompletedBy' => 'Completed By',
            'ldDesignEmailed' => 'Design Email to Customer',
            'ldFinalEmail' => 'Final Email to Customer',
            'ldFinalApproval' => 'Final Approval',
            'ldFollowUp1st' => 'Follow Up 1',
            'ldFollowUp2nd' => 'Follow Up 2',
            'ldAdded' => 'Added At',
            'ldModified' => 'Modified At',
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
     * @return \yii\db\ActiveQuery
     */
    public function getLeadDesignRevisions()
    {
        return $this->hasMany(LeadDesignRevisions::className(), ['fkLeadDesignID' => 'pkLeadDesignID']);
    }

    /**
     * Upload Image method
     */
    public function upload($filesArray)
    {
        try {
            if ($this->validate()) {
                if ($this->save()) {
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
                        }
                    }
                } else {
                    throw new \Exception(current($this->getFirstErrors()));
                }
            }
            return true;
        } catch (\Exception $ex) {
            Yii::$app->session->setFlash('success', $ex->getMessage());
        }
    }
}
