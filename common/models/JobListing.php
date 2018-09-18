<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "job_listing".
 *
 * @property integer $id
 * @property string $job_title
 * @property string $description
 * @property string $date_added
 * @property string $category
 * @property string $company_name
 * @property string $location
 * @property string $published
 * @property string $job_type
 */
class JobListing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_listing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_title', 'description','category', 'company_name', 'location', 'published', 'job_type'], 'required'],
            [['description'], 'string'],
            [['date_added'], 'safe'],
            [['job_title', 'company_name', 'location'], 'string', 'max' => 255],
            [['category', 'published', 'job_type'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_title' => 'Job Title',
            'description' => 'Description',
            'date_added' => 'Date Added',
            'category' => 'Category',
            'company_name' => 'Company Name',
            'location' => 'Location',
            'published' => 'Published',
            'job_type' => 'Job Type',
        ];
    }

    //get subcounty
    //  public function getSubCounty()
    // {
    //     return  $this->hasMany(SubCounty::className(),['countyCode' => 'id']);
    //     /*return  $this->hasOne(User::className(),['dept_user' => 'id']);*/
    // }

    public function fields() {
        return [
            'id',
            'job_title',
            'description',
            'date_added'=> function ($model) {
                            return date("d/m/Y",strtotime($model->date_added));
                        },
            'category'=> function ($model) {
                          return $model->jobCategory->category_name;
                        },
            'company_name',
            'location',
            'job_type'=> function ($model) {
                            switch ($model->job_type) {
                                case '1':
                                    return "Internship";
                                    break;
                                case '2':
                                    return "Part time";
                                    break;
                                case '3':
                                    return "Full time";
                                    break;
                                
                                default:
                                return "Not specified";
                                    break;
                            }
                         
                        }

        ];
    }


    public function getJobCategory()
    {
        return  $this->hasOne(JobCategory::className(),['id' => 'category']);
    }

    public static function categoryDropdown()
    {
     return Arrayhelper::map(JobCategory::find()->orderBy('id')->asArray()->all(),'id','category_name');
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

    public function getJobType()
    {
        if ($this->job_type === '1') {
            return 'Internship';
        }
        else if ($this->job_type === '2') {
             return 'Part time';
        }
        else if ($this->job_type === '3') {
             return 'Full time';
        }
    }
}
