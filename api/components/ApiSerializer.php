<?php
namespace api\components;

use Yii;
use yii\rest\Serializer;

class ApiSerializer extends Serializer 
{
    public function serialize($data) 
    {
        $d = parent::serialize($data);
        $m = $d['_meta'];
        unset($d['_meta']);
        $l = $d['_links'];
        unset($d['_links']);
        return array_merge($d, $m,$l);
    }
}
?>