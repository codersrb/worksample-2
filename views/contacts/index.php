<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-index">

    <p>
        <?= Html::a('Add New Contact', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="box">
            <div class="box-body table-responsive no-padding">
                <?= GridView::widget([
                'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,
                'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                    'pkContactID',
                    [
                        'attribute' => 'contactPersonFullName',
                        'value' => function($model){
                            return Html::a($model->contactPersonFullName, ['update', 'id' => $model->pkContactID]);
                        },
                        'format' => 'html'
                    ],
                    'contactTypeName:text:Type',
                    [
                            'attribute' => 'contactAddress',
                            'label' => 'Contact Address',
                            'format' => 'html',
                            'value' => function($model){
                                return $model->getFullAddress(true);
                            }
                    ],
                    'contactPersonPhone:text:Phone',
                    'contactPersonEmail:text:Email',
                    [   'label' => 'Jobs',
                        'format' => 'raw',
                        'value' => function($model) {
                            return '<span style="font-size:10px;color:red">Under Development</span>';
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
                ]); ?>
            </div>
        </div>
        </div>
