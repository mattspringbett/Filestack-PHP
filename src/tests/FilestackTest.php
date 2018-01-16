<?php

class FilestackTest extends PHPUnit_Framework_TestCase
{

	public static function setUpBeforeClass(){

		require_once('../../vendor/autoload.php');

	}


	public function setUp(){

        $this->filestackObj = new NakedCreativity\Filestack\Filestack(['apiKey'=>'ADFgKR8OMTVur7o7iAIbrz']);
        $this->imageUrl = 'http://www.planwallpaper.com/static/images/canberra_hero_image_JiMVvYU.jpg';

    }

    public function testCrop(){

    	$inputArray = ['dim'=>[10,20,200,250]];

    	$resizeString = $this->filestackObj->generateUrlComponent('crop',$inputArray);

    	$this->assertEquals($resizeString,'crop=dim:[10,20,200,250]');

    }


    public function testResize(){

    	$inputArray = ['height'=>100,'width'=>500,'align'=>['top','left']];

    	$resizeString = $this->filestackObj->generateUrlComponent('resize',$inputArray);

    	$this->assertEquals($resizeString,'resize=height:100,width:500,align:[top,left]');

    }

    public function testImage(){

    	$inputArray = ['resize'=>['height'=>100,'width'=>500,'align'=>['top','left']]];

    	$filestackUrl = $this->filestackObj->image($this->imageUrl,$inputArray);

    	echo $filestackUrl;

    }

    public function testStoreFromUrl(){

       $filestackJson = $this->filestackObj->store('https://eu.jotform.com/uploads/nakedcreativity/63143379069361/366439420700484177/DSCF2341.jpg');
    
        print_r($filestackJson);

    }

}
?>