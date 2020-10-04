<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add User', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </p>

    <div class="box">
        <div class="box-body table-responsive no-padding">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'pkUserID:text:User ID',
                    [
                        'attribute' => 'userName',
                        'value' => function($model){
                            return Html::a($model->userName, ['update', 'id' => $model->pkUserID]);
                        },
                        'format' => 'html'
                    ],
                    'userEmail:email',
//                    'userAuthKey',
//                    'userPassword',
//                    'userResetToken',
                    // 'userNumber',
                    // 'userProfilePicture',
                    // 'userAdded',
                    // 'userModified',
                     'userRole',
                     'userStatus',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
