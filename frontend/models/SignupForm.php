<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\base\Security;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    //public $email;
    public $first_name;
    public $last_name;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->recommend_code = date('His').Yii::$app->security->generateRandomString(4);

        // $transaction = Yii::$app->db->beginTransaction();

        // try {

        //     $model->save ();

        //     $transaction->commit ();

        //     return $user;

        // } catch ( \Exception $ex ) {

        //     $transaction->rollBack();
        // }
        
       return $user->save() ? $user : null;
    }
}
