<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "app_release".
 *
 * @property integer $id
 * @property string $date_added
 * @property string $release_features
 * @property string $file_link
 * @property string $app_version
 * @property string $version_code
 */
class AppRelease extends \yii\db\ActiveRecord
{
    //public $uploadFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_release';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['release_name','release_features','app_version', 'version_code'], 'required'],
            [['date_added'], 'safe'],
            //[['uploadFile'], 'file','skipOnEmpty' => false,'on' => 'create'],
            [['release_features','release_name','file_link'], 'string'],
            [['app_version', 'version_code'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'release_name' =>'Release Name',
            'date_added' => 'Date Added',
            'release_features' => 'Release Features',
            'file_link' => 'File Link',
            'app_version' => 'App Version',
            'uploadFile' => 'Apk file',
            'version_code' => 'Version Code',
        ];
    }

    public function uploadApk()
    {
        //$domainUrl = "http://localhost/projects/advanced/backend/web/";
        $domainUrl = "http://lyfey.ovicko.com/";
        $ymd = date("Ymd");
        $save_path = \Yii::getAlias('@backend') . '/web/apkRelease/' . $ymd . '/';
        if (!file_exists($save_path)) {
          mkdir($save_path, 0777, true);
        }
        
        if ($this->validate()) {
            $this->uploadFile->saveAs($save_path.$this->uploadFile->baseName . '.' . $this->uploadFile->extension);
            $this->file_link = $domainUrl.'apkRelease/' . $ymd . '/'.$this->uploadFile->baseName . '.' . $this->uploadFile->extension;
            return true;
        } else {
            return false;
        }
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
              $this->date_added = date("YmdHis");
            }
            return true;
        }
        else{
            return false;
        }
    }
}
