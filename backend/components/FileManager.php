<?php
namespace app\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class FileManager extends Widget {

	public function init()
	{
		# code...
	}
	
	public function run()
	{

		$this->listFolderFiles( \Yii::$app->params['DIR_IMAGES'] );

	}

	protected function listFolderFiles( $dir ){
	    $ffs = scandir($dir);

	    unset($ffs[array_search('.', $ffs, true)]);
	    unset($ffs[array_search('..', $ffs, true)]);

	    // prevent empty ordered elements
	    if (count($ffs) < 1)
	        return;

	    echo '<ol>';
	    foreach($ffs as $ff){
	        echo '<li>'.$ff;
	        if(is_dir($dir.'/'.$ff)) $this->listFolderFiles($dir.'/'.$ff);
	        echo '</li>';
	    }
	    echo '</ol>';
	}

}