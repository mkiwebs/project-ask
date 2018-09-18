<?php
namespace app\components;

use Yii;

/**
* Manages global access of Lyfey backend
*/
class LyfeyAccess
{
    public static $permission_error = "You don't have permissions to access or perform this action";
    
	public static function hasPermission( $action )
	{
		 if ( !Yii::$app->user->isGuest && Yii::$app->user->can( $action )) {

		 	 return true;
		 } else {
		 	return false;
		 }
	}
}