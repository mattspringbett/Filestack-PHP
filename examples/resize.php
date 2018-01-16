<?php

include('../vendor/autoload.php');

$apiKey = '';

$config = array('apiKey'=>$apiKey);
$filestackObj = new NakedCreativity\Filestack\Filestack($config);

$options = array('monochrome'=>'','polaroid'=>array('color'=>'white'));

//$options = array('blur'=>array('amount'=>'7'));

$response = $filestackObj->image('http://i0.kym-cdn.com/entries/icons/mobile/000/011/365/GRUMPYCAT.jpg',$options);

echo $response;

?>