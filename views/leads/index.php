<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leads Opportunities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leads-index">

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?php echo Html::a('Create Lead', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </p>
        
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <?= GridView::widget([
                'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                            'attribute' => 'contactOpportunityTitle',
                            'value' => function($model){
                                return Html::a($model->contactOpportunityTitle, ['update', 'id' => $model->pkLeadID]);
                            },
                            'format' => 'html'
                    ],
                    'contactPersonFullName',
                    'contactStatusName',
                    'age',
                    'progress',
                    'lastContacted',
                    'contactSourceName',
                    'estimated',
                    'leadAdded:text:Created Date',
                    ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
                ],
                ]); ?>
            </div>
        </div>
        </div>
