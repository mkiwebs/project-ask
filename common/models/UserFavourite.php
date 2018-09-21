<?php

namespace common\models;

use Yii;
use common\models\Question;
use common\models\BlogArticle;
use common\models\AppEvent;
/**
 * This is the model class for table "user_favourites".
 *
 * @property integer $fav_id
 * @property integer $fav_type
 * @property integer $user_id
 * @property integer $item_id
 * @property string $date_added
 */
class UserFavourite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_favourites';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fav_type', 'user_id', 'item_id'], 'required'],
            [['fav_type', 'user_id', 'item_id'], 'integer'],
            [['date_added'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fav_id' => 'Fav ID',
            'fav_type' => 'Fav Type',
            'user_id' => 'User ID',
            'item_id' => 'Item ID',
            'date_added' => 'Date Added',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
              $this->date_added = date("YmdHis");
            } else {
               $this->date_updated = date("YmdHis");
            }
            
            return true;
        }
        else{
            return false;
        }
    }

    public static function favouriteUrl($fav_type,$item_id)
    {
        switch ($fav_type) {
            case 1:
                $favouriteUrl = '/app-articles/'.$item_id;
                break;
            case 2:
                $favouriteUrl = '/app-events/'.$item_id;
                break;
            case 3:
                $favouriteUrl = '/questions/'.$item_id;
                break;
            
            default:
                $favouriteUrl = '';
                break;
        }
        return $favouriteUrl;
    }

    public static function favouriteBody($fav_type,$item_id)
    {
        $body = array();
        switch ($fav_type) {
            case 1:
                //fetch one BlogArticle
                $body =  BlogArticle::find()
                        ->where(['id' => $item_id])
                        ->one();
                $result = array(
                            'id' => $item_id,
                            'content' =>   $body->article_title,
                            'images_url' => $body->images_url,
                            'type'    => "article",
                            'fav_url'    => self::favouriteUrl($fav_type,$item_id),
                            'date_added' =>$body->created_at
                            );
                return $result;
                break;
            case 2:
                //fetch one Event
                    $body =  AppEvent::find()
                                        ->where(['event_id' => $item_id])
                                        ->one();
                    return $body;
                break;
            case 3:
                //fetch one Question
                    $body =  Question::find()
                        ->where(['id' => $item_id])
                        ->one();
                    $result = array(
                            'id'         => $item_id,
                            'content'    => $body->content,
                            'type'    => "question",
                            'fav_url'    => self::favouriteUrl($fav_type,$item_id),
                            'date_added' => $body->date_added
                            );
                return $result;
                break;
            
            default:
                return $body;
                break;
        }

    }


}
