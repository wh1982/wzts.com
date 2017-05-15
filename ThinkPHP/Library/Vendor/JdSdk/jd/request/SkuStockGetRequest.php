<?php
class SkuStockGetRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jingdong.sku.stock.get";
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
                                    	                   			private $skuId;
    	                                                            
	public function setSkuId($skuId){
		$this->skuId = $skuId;
		$this->apiParas["sku_id"] = $skuId;
	}

	public function getSkuId(){
	  return $this->skuId;
	}

                        	                   			private $areaId;
    	                                                            
	public function setAreaId($areaId){
		$this->areaId = $areaId;
		$this->apiParas["area_id"] = $areaId;
	}

	public function getAreaId(){
	  return $this->areaId;
	}

}





        
 

