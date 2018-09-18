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
        <!-- TABLE: RECENT QUESTIONS -->
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
                        //'user.username',
                        [
                        'attribute' => 'user.username',
                        'contentOptions' => ['style' => 'width:10px;']
                        ],
                        
                        [
                        'attribute' => 'content',
                         "format" => "html",
                         //'contentOptions' => ['style' => 'width:10px;']
                         'contentOptions' => [
                                    'style' => ['max-width' => '100px;']],
                         'value' => function($data){ //return "Pending";
                                        if (strlen($data->content) > 30 ) {
                                            return substr($data->content, 0,30)."...";
                                        } else {
                                            return $data->content;
                                        }
                                      }
                        ],
                        //'date_added',
                        [
                        'attribute' =>'question_status',
                        'value' => function($data){ //return "Pending";
                                        if ($data->question_status == 10 ) {
                                            return "Pending";
                                        } else {
                                            return "Pending1";
                                        }
                                      }
                        ],
                        
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template'=>'{view}',
                            'urlCreator' => function ($action, $model, $key, $index) {
                                             return Url::toRoute(['question/view', 'id' => $model->id]);

                                            }

                        ],
                    ],
                ]); ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-6">
        <!-- TABLE: LATEST LOGS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Latest Logs</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $recent_logs,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        'log_time',
                        'log_activity',
                        'user.username',
                        //'device',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template'=>'{view}',
                            'urlCreator' => function ($action, $model, $key, $index) {
                                                return Url::toRoute(['app-log/view', 'id' => $model->id]);

                                            }

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
                <h3 class="box-title">Latest Articles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?= GridView::widget([
                        'dataProvider' => $recent_articles,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                            'attribute' => 'article_title',
                             "format" => "html",
                             //'contentOptions' => ['style' => 'width:10px;']
                             'contentOptions' => [
                                        'style' => ['max-width' => '100px;']],
                             'value' => function($data){ //return "Pending";
                                            if (strlen($data->article_title) > 30 ) {
                                                return substr($data->article_title, 0,30)."...";
                                            } else {
                                                return $data->article_title;
                                            }
                                          }
                            ],
                            'created_at',
                            //'draft',
                            [
                            'attribute' =>'draft',
                            'value' => function($data){ //return "Pending";
                                            if ($data->draft == 0 ) {
                                                return "Published";
                                            } else {
                                                return "Draft";
                                            }
                                          }
                            ],
                            //'category',
                            // 'keywords',
                            // 'article_views',
                            //'author',
                            // 'date_modified',
                            // 'images_url:ntext',
                            // 'related_articles',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template'=>'{view}',
                                'urlCreator' => function ($action, $model, $key, $index) {
                                                    return Url::toRoute(['article/view', 'id' => $model->id]);

                                                }

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
                <h3 class="box-title">Events Calendar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <?= GridView::widget([
                   'dataProvider' => $recent_events,
                   'columns' => [
                       ['class' => 'yii\grid\SerialColumn'],

                       'event_date',
                       'event_venue',
                       'event_address:ntext',
                       'event_phone',
                       //'event_image',
                       // 'description:ntext',
                       // 'related_category',
                       // 'event_id',

                       [
                           'class' => 'yii\grid\ActionColumn',
                           'template'=>'{view}',
                           'urlCreator' => function ($action, $model, $key, $index) {
                                               return Url::toRoute(['app-event/view', 'id' => $model->event_id]);

                                           }

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
