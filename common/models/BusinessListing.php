<?php

namespace common\models;

use Yii;
use yii\helpers\Arrayhelper;
/**
 * This is the model class for table "business_listing".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $website
 * @property string $established_year
 * @property string $vat
 * @property string $emp_range
 * @property string $description
 * @property string $schedule
 * @property string $products
 * @property string $category
 * @property string $logo
 */
class BusinessListing extends \yii\db\ActiveRecord
{
//required on insert
   public $featuredFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business_listing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address','published', 'phone','description', 'schedule', 'products', 'category'], 'required'],
            [['description', 'schedule', 'products'], 'string'],
            [['name', 'address', 'website', 'logo'], 'string', 'max' => 255],
            [['phone', 'established_year', 'vat', 'emp_range', 'category'], 'string', 'max' => 100],
            [[ 'featuredFile' ] ,'file', 'skipOnEmpty' => true,'extensions' => 'png, jpg'] ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Company name',
            'address' => 'Address',
            'phone' => 'Phone',
            'website' => 'Website',
            'established_year' => 'Established Year',
            'vat' => 'Vat',
            'emp_range' => 'Emp Range',
            'description' => 'Description',
            'schedule' => 'Schedule',
            'products' => 'Products',
            'category' => 'Category',
            'logo' => 'Company Logo',
            'featuredFile' => 'Company Logo',
            'published' => 'Published',
        ];
    }

    public function upload( $ymd , $fileName ) {
      if ( $this->featuredFile !== null && $this->featuredFile->name !== '' ) {
        $save_path = \Yii::getAlias ( '@backend' ) . '/web/uploads/' . $ymd . '/';
        if ( !file_exists ( $save_path ) ) {
          mkdir ( $save_path , 0777 , true );
        }

        if ( !$this->featuredFile->saveAs ( $save_path . $fileName ) ) {
          $this->addError ( 'featuredFile' , 'File could not be uploaded' );
          throw new \Exception ( 'File upload error' );
        }
      }
    }

    public function unlinkOldFile( $filename ) {
      if ( $filename !== '' ) {
        $save_path = \Yii::getAlias ( '@backend' ) . '/web/uploads/' . $filename;
        unlink ( $save_path );
      }
    }

    public function getBusinessCategory()
    {
        return  $this->hasOne(BusinessCategory::className(),['id' => 'category']);
    }

    public static function categoryDropdown()
    {
     return Arrayhelper::map(BusinessCategory::find()->orderBy('category_name')->asArray()->all(),'id','category_name');
    }

}
