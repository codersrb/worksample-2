<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%contacts}}".
 *
 * @property int $pkContactID Contact ID
 * @property string $contactType Contact Type
 * @property string $contactAddress Address
 * @property string $contactAddress2 Address 2
 * @property string $contactCity City
 * @property string $contactState State
 * @property string $contactZip Zip
 * @property string $contactCountry Country
 * @property string $contactBillingAddressType Billing Address
 * @property string $contactBillingAddress Address
 * @property string $contactBillingAddress2 Address 2
 * @property string $contactOpportunityTitle Opportunity Title
 * @property string $contactPropertyAddress Address
 * @property string $contactPropertyCity City
 * @property string $contactPropertyState State
 * @property string $contactPropertyCountry Country
 * @property int $contactProjectTypeID Project Type
 * @property int $contactContactTypeID Type of Contact
 * @property int $contactStatusID Status
 * @property int $contactSource Source
 * @property string $contactContractor
 * @property string $contactReferral
 *
 * @property ContactPersons[] $contactPersons
 * @property ProjectTypes $contactProjectType
 * @property ContactTypes $contactContactType
 * @property ContactStatus $contactStatus
 * @property ProjectCompletion[] $projectCompletions
 * @property ContactReferral[] $contactReferrals
 * @property ContactReferral[] $contactReferrals0
 */
class Contacts extends \yii\db\ActiveRecord
{

    public $contactPersonFullName;
    public $contactTypeName;
    public $contactSourceName;
    public $contactPersonPhone;
    public $contactPersonEmail;
    public $contactTags;
    public $tagName;
    public $tagIDs;
    public $fkContactPersonID;
    public $referrerID;
    public $fkReferredBy;

    public $primaryContact;
    public $secondaryContact;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contacts}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'contactAdded',
                'updatedAtAttribute' => 'contactModified',
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
            [['contactType', 'contactAddress', 'contactAddress2', 'contactCity', 'contactState', 'contactZip', 'contactCountry', 'contactBillingAddressType', 'contactBillingAddress', 'contactBillingAddress2', 'contactBillingCity', 'contactBillingState', 'contactBillingZip', 'contactBillingCountry'], 'required'],
            [['contactType', 'contactAddress', 'contactAddress2', 'contactCity', 'contactState', 'contactZip', 'contactCountry', 'contactBillingAddressType', 'contactBillingAddress', 'contactBillingAddress2', 'contactBillingCity', 'contactBillingState', 'contactBillingZip', 'contactBillingCountry', 'contactOpportunityTitle', 'contactPropertyAddress', 'contactPropertyCity', 'contactPropertyState', 'contactPropertyCountry', 'contactContractor', 'contactReferral'], 'string'],
            [['contactProjectTypeID', 'contactContactTypeID', 'contactStatusID', 'contactSourceID', 'referrerID', 'fkSubContactID'], 'integer'],
            // Additional Information
            [['contactOpportunityTitle', 'contactPropertyAddress', 'contactPropertyCity', 'contactPropertyState', 'contactPropertyCountry', 'contactProjectTypeID', 'contactContactTypeID', 'contactStatusID', 'contactSourceID'], 'safe'],

            [['contactAdded', 'contactModified'], 'safe'],
            [['contactProjectTypeID'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectTypes::className(), 'targetAttribute' => ['contactProjectTypeID' => 'pkProjectTypeID']],
            [['contactContactTypeID'], 'exist', 'skipOnError' => true, 'targetClass' => ContactTypes::className(), 'targetAttribute' => ['contactContactTypeID' => 'pkContactTypeID']],
            [['contactStatusID'], 'exist', 'skipOnError' => true, 'targetClass' => ContactStatus::className(), 'targetAttribute' => ['contactStatusID' => 'pkContactStatusID']],
            [['contactSourceID'], 'exist', 'skipOnError' => true, 'targetClass' => ContactSource::className(), 'targetAttribute' => ['contactSourceID' => 'pkContactSourceID']],
            [['fkSubContactID'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['fkSubContactID' => 'pkContactID']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkContactID' => 'Contact ID',
            'contactType' => 'This is a',
            'contactAddress' => 'Address',
            'contactAddress2' => 'Address 2',
            'contactCity' => 'City',
            'contactState' => 'State',
            'contactZip' => 'Zip',
            'contactCountry' => 'Country',
            'contactBillingAddressType' => 'Billing Address',
            'contactBillingAddress' => 'Address',
            'contactBillingAddress2' => 'Address 2',
            'contactBillingCity' => 'City',
            'contactBillingState' => 'State',
            'contactBillingZip' => 'Zip',
            'contactBillingCountry' => 'Country',
            'contactOpportunityTitle' => 'Opportunity Title',
            'contactPropertyAddress' => 'Property Address',
            'contactPropertyCity' => 'City',
            'contactPropertyState' => 'State',
            'contactPropertyCountry' => 'Country',
            'contactProjectTypeID' => 'Project Type',
            'contactTags' => 'Tags',
            'contactContactTypeID' => 'Type of Contact',
            'contactStatusID' => 'Status',
            'contactSourceID' => 'Source',
            'contactContractor' => 'Do you have a Contractor/Installer',
            'contactReferral' => 'If no, would you like our referral list',
            'contactAdded' => 'Added At',
            'contactModified' => 'Modified At',

            'contactPersonFullName' => 'Full Name',
            'tagIDs' => 'Tags',
            'fkContactPersonID' => 'Sub contact of',
            'fkSubContactID' => 'Sub contact of',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactPersons()
    {
        return $this->hasMany(ContactPersons::className(), ['fkContactID' => 'pkContactID']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactReferrals()
    {
        return $this->hasMany(ContactReferral::className(), ['fkContactID' => 'pkContactID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactReferrals0()
    {
        return $this->hasMany(ContactReferral::className(), ['fkReferredBy' => 'pkContactID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactTags()
    {
        return $this->hasMany(ContactTags::className(), ['fkContactID' => 'pkContactID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactProjectType()
    {
        return $this->hasOne(ProjectTypes::className(), ['pkProjectTypeID' => 'contactProjectTypeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactContactType()
    {
        return $this->hasOne(ContactTypes::className(), ['pkContactTypeID' => 'contactContactTypeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactStatus()
    {
        return $this->hasOne(ContactStatus::className(), ['pkContactStatusID' => 'contactStatusID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactSource()
    {
        return $this->hasOne(ContactSource::className(), ['pkContactSourceID' => 'contactSourceID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactContractorInfos()
    {
        return $this->hasMany(ContactContractorInfo::className(), ['fkContactID' => 'pkContactID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectCompletions()
    {
        return $this->hasMany(ProjectCompletion::className(), ['fkContactID' => 'pkContactID']);
    }


    public function getFullAddress($html = false)
    {
        if($html) {
            $fullAddress = $this->contactAddress. ',<br/>' . $this->contactCity. ' ' . $this->contactZip.' ' . $this->contactCountry;
        }

        return $fullAddress;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkSubContact()
    {
        return $this->hasOne(Contacts::className(), ['pkContactID' => 'fkSubContactID']);
    }
}
