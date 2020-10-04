<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $pkUserID User ID
 * @property string $userEmail Email
 * @property string $userAuthKey Auth Key
 * @property string $userPassword Password
 * @property string $userResetToken Reset Token
 * @property string $userName Name
 * @property string $userNumber Number
 * @property string $userProfilePicture Profile Picture
 * @property string $userAdded Added On
 * @property string $userModified Modified On
 * @property string $userRole User Role
 * @property string $userStatus Status
 *
 * @property UserModules[] $userModules
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 'Active';
    const STATUS_PENDING = 'Pending';
    const STATUS_INACTIVE = 'Inactive';
    const ROLE_USER = 'User';
    const ROLE_ADMIN = 'Admin';
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    public $created_at;
    public $updated_at;
    public $userTempPassword;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{users}}';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['pkUserID' => $id, 'userStatus' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['userEmail' => $username, 'userStatus' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'userResetToken' => $token,
            'userStatus' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'userAdded',
                'updatedAtAttribute' => 'userModified',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userEmail', 'userTempPassword', 'userName', 'userNumber', 'userRole', 'userStatus'], 'required', 'on' => self::SCENARIO_CREATE],
            [['userEmail', 'userName', 'userNumber', 'userRole', 'userStatus'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['userAdded', 'userModified'], 'safe'],
            [['userRole', 'userStatus'], 'string'],
            [['userEmail'], 'string', 'max' => 150],
            [['userAuthKey'], 'string', 'max' => 32],
            [['userPassword'], 'string', 'max' => 100],
            [['userResetToken'], 'string', 'max' => 255],
            [['userName'], 'string', 'max' => 60],
            [['userNumber'], 'string', 'max' => 16],
            [['userProfilePicture'], 'string', 'max' => 500],
            [['userEmail'], 'unique'],
            [['userNumber'], 'unique'],
            ['userStatus', 'default', 'value' => self::STATUS_ACTIVE],
            ['userStatus', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_PENDING, self::STATUS_INACTIVE]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkUserID' => 'User ID',
            'userTempPassword' => 'User Password'
        ];
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->userAuthKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->userPassword);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->userPassword = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->userAuthKey = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->userResetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->userResetToken = null;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserModules()
    {
        return $this->hasMany(UserModules::className(), ['fkUserID' => 'pkUserID']);
    }

    /**
     * @param $pkModuleID
     * @return bool
     */
    public function hasModuleByID($pkModuleID)
    {
        if($this->pkUserID == 1) {
            return true;
        }

        $userModule = UserModules::find()->where(['fkUserID' => $this->pkUserID, 'fkModuleID' => $pkModuleID])->one();

        return ($userModule) ? true : false;
    }

    /**
     * @param $route
     * @return bool
     */
    public function hasModuleByRoute($route)
    {
        $exclude = [
            '/',
            '/site/logout',
            '/site/profile',
            ''
        ];

//        print_r($route); exit;


        if($this->pkUserID == 1) {
            return true;
        }

        if(in_array($route, $exclude)) {
            return true;
        }


        $module = Modules::find()->where(['Route' => $route])->one();

        if($module) {
            $userModule = UserModules::find()->where(['fkUserID' => $this->pkUserID, 'fkModuleID' => $module->pkModuleID])->one();
            return ($userModule) ? true : false;
        }

        return false;
    }
}
