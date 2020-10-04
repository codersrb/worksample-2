<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use app\models\LeadImages;

/**
 * This is the model class for table "{{%lead_measurements}}".
 *
 * @property int $pkLeadMeasurementID Lead Measurement ID
 * @property int $fkLeadID Lead ID
 * @property int $lmDayWeekDay Weekdays
 * @property int $lmDayWeekEnd Weekends
 * @property string $lmDayStart Start Date
 * @property string $lmDayEnd End Date
 * @property int $lmDayFlexible Flexible
 * @property string $lmDayTime Day Time
 * @property int $lmDayTimeEveningTimeFrame Evening Timeframe
 * @property int $lmDayTimeFlexible Daytime Flexible
 * @property string $lmAppointmentStartDate Start Date
 * @property string $lmAppointmentEndDate End Date
 * @property string $lmAppointmentScheduledBy Scheduled By
 * @property string $lmAppointmentReminder Reminder
 * @property string $lmMeasurementCompleteDate Measurement Date
 * @property string $lmMeasurementCompletedBy Completed By
 * @property string $lmMeasurementSketch Sketch
 * @property string $lmMeasurementBeforePhotos Before Photos
 * @property int $lmRangeW Range W
 * @property int $lmRangeD Range D
 * @property int $lmRangeH Range H
 * @property int $lmHoodW Hood W
 * @property int $lmHoodD Hood D
 * @property int $lmHoodH Hood H
 * @property int $lmDishwasherW Dishwasher W
 * @property int $lmDishwasherD Dishwasher D
 * @property int $lmDishwasherH Dishwasher H
 * @property int $lmCookTopW Cooktop W
 * @property int $lmCookTopD Cooktop D
 * @property int $lmCookTopH Cooktop H
 * @property int $lmMicrowaveW Microwave W
 * @property int $lmMicrowaveD Microwave D
 * @property int $lmMicrowaveH Microwave H
 * @property int $lmSinkW Sink W
 * @property int $lmSinkD Sink D
 * @property int $lmSinkH Sink H
 * @property int $lmOvenW Oven W
 * @property int $lmOvenD Oven D
 * @property int $lmOvenH Oven H
 * @property int $lmRefridgeratorW Refridgerator W
 * @property int $lmRefridgeratorD Refridgerator D
 * @property int $lmRefridgeratorH Refridgerator H
 * @property string $lmOther Other
 * @property string $lmConfimedViaEmail Confirmed Via
 * @property string $lmConfirmedStartDate Start Date
 * @property string $lmConfirmedEndDate End Date
 *
 * @property Leads $fkLeadID
 */
class LeadMeasurements extends \yii\db\ActiveRecord
{

    /**
     * @var
     */
    public $lmMeasurementSketchFiles;
    /**
     * @var
     */
    public $lmMeasurementBeforePhotosFiles;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lead_measurements}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkLeadID', 'lmDayWeekDay', 'lmDayWeekEnd', 'lmDayStart', 'lmDayEnd', 'lmDayFlexible', 'lmDayTime', 'lmDayTimeEveningTimeFrame', 'lmDayTimeFlexible', 'lmAppointmentStartDate', 'lmAppointmentEndDate', 'lmAppointmentScheduledBy', 'lmAppointmentReminder', 'lmMeasurementCompleteDate', 'lmMeasurementCompletedBy', 'lmRangeW', 'lmRangeD', 'lmRangeH', 'lmHoodW', 'lmHoodD', 'lmHoodH', 'lmDishwasherW', 'lmDishwasherD', 'lmDishwasherH', 'lmCookTopW', 'lmCookTopD', 'lmCookTopH', 'lmMicrowaveW', 'lmMicrowaveD', 'lmMicrowaveH', 'lmSinkW', 'lmSinkD', 'lmSinkH', 'lmOvenW', 'lmOvenD', 'lmOvenH', 'lmRefridgeratorW', 'lmRefridgeratorD', 'lmRefridgeratorH', 'lmOther', 'lmConfimedViaEmail', 'lmConfirmedStartDate', 'lmConfirmedEndDate'], 'required'],
            [['fkLeadID', 'lmDayWeekDay', 'lmDayWeekEnd', 'lmDayFlexible', 'lmDayTimeEveningTimeFrame', 'lmDayTimeFlexible', 'lmRangeW', 'lmRangeD', 'lmRangeH', 'lmHoodW', 'lmHoodD', 'lmHoodH', 'lmDishwasherW', 'lmDishwasherD', 'lmDishwasherH', 'lmCookTopW', 'lmCookTopD', 'lmCookTopH', 'lmMicrowaveW', 'lmMicrowaveD', 'lmMicrowaveH', 'lmSinkW', 'lmSinkD', 'lmSinkH', 'lmOvenW', 'lmOvenD', 'lmOvenH', 'lmRefridgeratorW', 'lmRefridgeratorD', 'lmRefridgeratorH'], 'integer'],
            [['lmDayStart', 'lmDayEnd', 'lmAppointmentStartDate', 'lmAppointmentEndDate', 'lmMeasurementCompleteDate', 'lmConfirmedStartDate', 'lmConfirmedEndDate'], 'safe'],
            [['lmDayTime', 'lmAppointmentScheduledBy', 'lmAppointmentReminder', 'lmMeasurementCompletedBy', 'lmMeasurementSketch', 'lmMeasurementBeforePhotos', 'lmOther', 'lmConfimedViaEmail'], 'string'],
            [['fkLeadID'], 'exist', 'skipOnError' => true, 'targetClass' => Leads::className(), 'targetAttribute' => ['fkLeadID' => 'pkLeadID']],

            [['lmMeasurementSketchFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 10],
            [['lmMeasurementBeforePhotosFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkLeadMeasurementID' => 'Lead Measurement ID',
            'fkLeadID' => 'Lead ID',
            'lmDayWeekDay' => 'Weekdays',
            'lmDayWeekEnd' => 'Weekends',
            'lmDayStart' => 'Start Date',
            'lmDayEnd' => 'End Date',
            'lmDayFlexible' => 'Flexible',
            'lmDayTime' => 'Day Time',
            'lmDayTimeEveningTimeFrame' => 'Evening Timeframe',
            'lmDayTimeFlexible' => 'Flexible',
            'lmAppointmentStartDate' => 'Start Date',
            'lmAppointmentEndDate' => 'End Date',
            'lmAppointmentScheduledBy' => 'Scheduled By',
            'lmAppointmentReminder' => 'Reminder',
            'lmMeasurementCompleteDate' => 'Measurement Date',
            'lmMeasurementCompletedBy' => 'Completed By',
            'lmMeasurementSketch' => 'Sketch',
            'lmMeasurementSketchFiles' => 'Sketch',
            'lmMeasurementBeforePhotos' => 'Before Photos',
            'lmMeasurementBeforePhotosFiles' => 'Before Photos',
            'lmRangeW' => 'Width',
            'lmRangeD' => 'Depth',
            'lmRangeH' => 'Height',
            'lmHoodW' => 'Width',
            'lmHoodD' => 'Depth',
            'lmHoodH' => 'Height',
            'lmDishwasherW' => 'Width',
            'lmDishwasherD' => 'Depth',
            'lmDishwasherH' => 'Height',
            'lmCookTopW' => 'Width',
            'lmCookTopD' => 'Depth',
            'lmCookTopH' => 'Height',
            'lmMicrowaveW' => 'Width',
            'lmMicrowaveD' => 'Depth',
            'lmMicrowaveH' => 'Height',
            'lmSinkW' => 'Width',
            'lmSinkD' => 'Depth',
            'lmSinkH' => 'Height',
            'lmOvenW' => 'Width',
            'lmOvenD' => 'Depth',
            'lmOvenH' => 'Height',
            'lmRefridgeratorW' => 'Width',
            'lmRefridgeratorD' => 'Depth',
            'lmRefridgeratorH' => 'Height',
            'lmOther' => 'Other',
            'lmConfimedViaEmail' => 'Confirmed Via',
            'lmConfirmedStartDate' => 'Start Date',
            'lmConfirmedEndDate' => 'End Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkLeadID0()
    {
        return $this->hasOne(Leads::className(), ['pkLeadID' => 'fkLeadID']);
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
