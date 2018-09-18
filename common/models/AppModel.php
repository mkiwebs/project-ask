<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_category".
 *
 * @property integer $category_id
 * @property string $category_name
 */
class AppModel 
{
    private static $SUCCESS_CODE = 201;
    private static $ERROR_CODE   = 401;

    public function saveToLog($event)
    {
       //assigning attributes
       // echo 'mail sent to admin using the event';
       $app_log_model = new AppLog();
       $app_log_model->log_time = date("YmdHis");
       $app_log_model->log_activity = 'created a new category';
       $app_log_model->user_id = Yii::$app->user->identity->id;
       $app_log_model->device = "1";
       // $app_log_model->id = "1";

       //$app_log_model->save();
       if ($app_log_model->save()) {
           return true;
       } else {
          //var_dump($app_log_model->getErrors());
           return $app_log_model->getErrors() ;
       }
       
       //var_dump($app_log_model->attributes);
    }

    public static function webViewHeader()
    {
     
     $header_html = '<!doctype html>
      <html lang="en">
        <head>
          <!-- Required meta tags -->
          <meta charset="utf-8">
          <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0 user-scalable=no">
          <meta name="apple-mobile-web-capable" content="yes">
          <meta name="apple-mobile-web-status-bar-style" content="black">
          <meta name="format-detection" content="telephone=no">
          <!-- Optional JavaScript -->
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
          <!-- Bootstrap CSS -->
          <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        </head>
        <style type="text/css">
            html {
                font-size: 30% 
            }
            .red{
                background-color:#f5f5f5;
            }
            .blue{
                background-color:blue;
            }
            .green{
                background-color:green;
            }
            .yellow{
                background-color:yellow;
            }
            .col-xs-5ths,
            .col-sm-5ths,
            .col-md-5ths,
            .col-lg-5ths {
                min-height: 10px;
                margin-left: -25px;
                margin-right: -25px;
            }

            .col-xs-5ths {
                width: 100%;
                float: left;
            }
        </style>
          
           <body style="min-width: 320px; max-width: 640px; margin: 0 auto;">
            <div class="container">';

     return $header_html;
    }

    public static function webViewFooter()
    {
      $footer_html = ' </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>';

      return $footer_html;
    }

    public static function cardView( $data )
    {
      return '
        <div class="card">
          <div class="card-body">'
          . $data .
          '</div>
        </div>
      ';
    }



    public static function AnswerHeading( $data )
    {
      return '
      <h5 class="card-title">'. $data['username'] .'<small class="pull-right">'."      
          ".$data['date'].' </small></h5>';
    }

    public static function materialHeader( $data )
    {
      return '<!DOCTYPE html>
  <html>
    <head>
    <!-- Required meta tags -->
          <meta charset="utf-8">
          <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0 user-scalable=no">
          <meta name="apple-mobile-web-capable" content="yes">
          <meta name="apple-mobile-web-status-bar-style" content="black">
          <meta name="format-detection" content="telephone=no">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>


    <body style="min-width: 320px; max-width: 640px; margin: 0 auto;">
    '.$data.'
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    </body>
  </html>
        ';
    }
}
