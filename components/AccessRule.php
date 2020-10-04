<?php

namespace app\components;

use yii;

class AccessRule extends \yii\filters\AccessRule {

    /**
     * @inheritdoc
     */
    protected function matchRole($user)
    {
        $currentRoute = '/'.Yii::$app->urlManager->parseRequest(Yii::$app->request)[0];

        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
                // Check if the user is logged in, and the roles match
            } elseif (!$user->getIsGuest() && $role === $user->identity->userRole) {

                if($user->identity->hasModuleByRoute($currentRoute)) {
                    return true;
                }
            }
        }

        return false;
    }
}