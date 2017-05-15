<?php
class AreaIpQueryRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jingdong.area.ip.query";
	}
	
	public function getApiParas(){
		return json_encode($this->apiParas);
	}
	
	public function check(){
		
	}
	
	public function putOtherTextParam($key, $value){
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
                                    	                   			private $ip;
    	                        
	public function setIp($ip){
		$this->ip = $ip;
		$this->apiParas["ip"] = $ip;
	}

	public function getIp(){
	  return $this->ip;
	}

}





        
 

