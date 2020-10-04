<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->userName;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pkUserID], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pkUserID], [
        'class' => 'btn btn-danger btn-flat',
        'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
        ],
        ]) ?>
    </p>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'pkUserID',
            'userEmail:email',
//            'userAuthKey',
//            'userPassword',
//            'userResetToken',
            'userName',
            'userNumber',
//            'userProfilePicture',
            'userAdded',
            'userModified',
            'userRole',
            'userStatus',
    ],
    ]) ?>

</div>
