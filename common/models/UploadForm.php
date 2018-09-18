<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $articleFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['articleFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,gif'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function embeddImage()
    {
        if ($this->validate()) {
            $save_path = \Yii::getAlias('@backend') . '/web/uploads/' . $ymd . '/';
             if (!file_exists($save_path)) {
                 mkdir($save_path, 0777, true);
             }

            $fileName = Yii::$app->security->generateRandomString(20);
            $this->articleFile->saveAs($save_path . $fileName.'.' . $this->articleFile->extension);
            $imageUrl = Yii::$app->request->baseUrl.'/uploads/'.$fileName.'.' . $this->articleFile->extension;
            return $imageUrl;
        } else {
            return "Error";
        }
    }
}