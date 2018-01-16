<?php

namespace NakedCreativity\Filestack;

class Filestack {
	
	private $apiKey;
	private $apiUrl;
	private $processEndpoint = 'https://process.filestackapi.com';
	private $restEndpoint = 'https://www.filestackapi.com/api/';

	public function __construct($configArray,$guzzleObj=null){

		if(!isset($configArray['apiKey']) || empty($configArray['apiKey'])){
			//Todo - throw Exception
		}

		$this->apiKey = $configArray['apiKey'];

		$this->processUrl = $this->processEndpoint.'/'.$this->apiKey.'/';

		if(empty($guzzleObj)){
			$this->guzzleObj = new \GuzzleHttp\Client();
		}

	}


	protected function makeProcessRequest($url){

		$filestackResponse = $this->guzzleObj->request('POST', $this->processUrl.$url);

		//Todo - if the response is not a 200

		return $filestackResponse->getBody();

	}

	protected function makeCrudRequest($url,$payload){

		$filestackResponse = $this->guzzleObj->request('POST', $url, ['body' => $payload]);

		//Todo - if the response is not a 200

		return $filestackResponse->getBody();

	}

	public function generateUrlComponent($task,$options){

		$urlString = $task.'=';

			if(is_array($options)){

				print_r($options);

				foreach($options as $itemKey => $item){

					if(is_array($item)){

						foreach($item as $subItem){
							$items .= $subItem.',';
						}

						$items = rtrim($items,',');
						$items = '['.$items.']';

					}
					else{
						$items = rtrim($items,',');
						$items .= $item.',';
					}

					
				}
				
				$urlString .= $itemKey.':'.$items;
				
				
			}
			else if(empty($options)){
				$urlString = $task;
			}
			else
			{
				$urlString .= $options.',';
			}
			
		$urlString = rtrim($urlString,',');

		return $urlString;

	}



	public function image($url,$options){

		foreach($options as $optionKey => $option){

			$urlComponents[] = $this->generateUrlComponent($optionKey,$option);

		}

		print_r($urlComponents);

		$filestackJson = $this->makeProcessRequest(implode('/',$urlComponents).'/'.$url);

		return $filestackJson;

	}


	public function store($payload,$options=null,$location='S3'){

		$url = $this->restEndpoint.'/store/'.$location.'?key='.$this->apiKey;

		$response = $this->makeCrudRequest($url,$payload);

		return $response;

	}






}


?>