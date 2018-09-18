<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TicketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
//print_r($dataProvider);
?>
<!-- Info boxes -->
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-ticket"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">New Users</span>
                <span class="info-box-number"><?= $new_user_count;?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-info-circle"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">New Questions</span>
                <span class="info-box-number"><?= $new_questions; ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-thumbs-up"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Users Online</span>
                <span class="info-box-number"><?= $online_users;?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa  fa-inbox"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number"><?= $total_users;?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-md-6">
        <!-- TABLE: LATEST TICKETS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Latest Questions</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?= GridView::widget([
                    //'headerRowOptions'=>['class'=>'box-header'],
                    'dataProvider' => $recentQuestions,
                    //'filterModel' => $searchModel,
                    'layout' => '{items}',
                    'emptyText' => '-',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'username',
                        'content:ntext',
                        'date_added',
                        [
                        'attribute' =>'question_status',
                        'value' => function($data){
                                        //return "Pending";
                                        if ($data->question_status == 10 ) {
                                            return "Pending";
                                        } else {
                                            return "Pending1";
                                        }
                                        
                                    }
                        ],
                        
                        [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Action'

                        ],
                    ],
                ]); ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-6">
        <!-- TABLE: LATEST TICKETS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Latest Questions</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?= GridView::widget([
                    //'headerRowOptions'=>['class'=>'box-header'],
                    'dataProvider' => $recentQuestions,
                    //'filterModel' => $searchModel,
                    'layout' => '{items}',
                    'emptyText' => '-',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'username',
                        'content:ntext',
                        'date_added',
                        [
                        'attribute' =>'question_status',
                        'value' => function($data){
                                        //return "Pending";
                                        if ($data->question_status == 10 ) {
                                            return "Pending";
                                        } else {
                                            return "Pending1";
                                        }
                                        
                                    }
                        ],
                        
                        [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Action'

                        ],
                    ],
                ]); ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
<!-- /.col-md-6 -->
</div>
<!-- full-width row -->
<div class="row">
    <div class="col-md-12">
        <!-- TABLE: LATEST TICKETS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Latest Questions</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?= GridView::widget([
                    //'headerRowOptions'=>['class'=>'box-header'],
                    'dataProvider' => $recentQuestions,
                    //'filterModel' => $searchModel,
                    'layout' => '{items}',
                    'emptyText' => '-',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'username',
                        'content:ntext',
                        'date_added',
                        [
                        'attribute' =>'question_status',
                        'value' => function($data){
                                        //return "Pending";
                                        if ($data->question_status == 10 ) {
                                            return "Pending";
                                        } else {
                                            return "Pending1";
                                        }
                                        
                                    }
                        ],
                        
                        [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Action'

                        ],
                    ],
                ]); ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
<!-- /.col-md-6 -->
</div>
<!-- second row -->
<div class="row">
    <div class="col-md-6">
        <!-- TABLE: LATEST TICKETS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Latest Questions</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?= GridView::widget([
                    //'headerRowOptions'=>['class'=>'box-header'],
                    'dataProvider' => $recentQuestions,
                    //'filterModel' => $searchModel,
                    'layout' => '{items}',
                    'emptyText' => '-',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'username',
                        'content:ntext',
                        'date_added',
                        [
                        'attribute' =>'question_status',
                        'value' => function($data){
                                        //return "Pending";
                                        if ($data->question_status == 10 ) {
                                            return "Pending";
                                        } else {
                                            return "Pending1";
                                        }
                                        
                                    }
                        ],
                        
                        [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Action'

                        ],
                    ],
                ]); ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-6">
        <!-- TABLE: LATEST TICKETS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Latest Questions</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?= GridView::widget([
                    //'headerRowOptions'=>['class'=>'box-header'],
                    'dataProvider' => $recentQuestions,
                    //'filterModel' => $searchModel,
                    'layout' => '{items}',
                    'emptyText' => '-',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'username',
                        'content:ntext',
                        'date_added',
                        [
                        'attribute' =>'question_status',
                        'value' => function($data){
                                        //return "Pending";
                                        if ($data->question_status == 10 ) {
                                            return "Pending";
                                        } else {
                                            return "Pending1";
                                        }
                                        
                                    }
                        ],
                        
                        [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Action'

                        ],
                    ],
                ]); ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
<!-- /.col-md-6 -->
</div>

</div>
