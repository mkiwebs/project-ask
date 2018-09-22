<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "app_likes".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $item_id
 * @property string $item_type
 */
class AppLikes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_likes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'item_id', 'item_type'], 'required'],
            // a1 and a2 need to be unique together, only a1 will receive error message
            ['user_id', 'unique', 'targetAttribute' => ['user_id', 'item_id','item_type']],
            [['user_id', 'item_id'], 'integer'],
            [['item_type'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'item_id' => 'Item ID',
            'item_type' => 'Item Type',
        ];
    }

    /*
    Check if the user has already liked the item_id
    @return int 
    */
    public static function likeExists($user_id,$item_id)
    {
     
        $exists = 0;      
        $model = self::find()
            ->where( [ 'item_id' => (int)$item_id, 'user_id' => (int)$user_id ] )
            ->exists();
        if ( $model === true ) {
            $exists = 1;
        } 

        return $exists;
    }
}
