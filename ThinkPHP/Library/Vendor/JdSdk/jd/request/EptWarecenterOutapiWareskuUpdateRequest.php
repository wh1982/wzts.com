<?php
class EptWarecenterOutapiWareskuUpdateRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jingdong.ept.warecenter.outapi.waresku.update";
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
		$this->apiParas["skuId"] = $skuId;
	}

	public function getSkuId(){
	  return $this->skuId;
	}

                        	                   			private $wareId;
    	                        
	public function setWareId($wareId){
		$this->wareId = $wareId;
		$this->apiParas["wareId"] = $wareId;
	}

	public function getWareId(){
	  return $this->wareId;
	}

                        	                   			private $status;
    	                        
	public function setStatus($status){
		$this->status = $status;
		$this->apiParas["status"] = $status;
	}

	public function getStatus(){
	  return $this->status;
	}

                        	                   			private $rfId;
    	                        
	public function setRfId($rfId){
		$this->rfId = $rfId;
		$this->apiParas["rfId"] = $rfId;
	}

	public function getRfId(){
	  return $this->rfId;
	}

                        	                   			private $attributes;
    	                        
	public function setAttributes($attributes){
		$this->attributes = $attributes;
		$this->apiParas["attributes"] = $attributes;
	}

	public function getAttributes(){
	  return $this->attributes;
	}

                        	                   			private $supplyPrice;
    	                        
	public function setSupplyPrice($supplyPrice){
		$this->supplyPrice = $supplyPrice;
		$this->apiParas["supplyPrice"] = $supplyPrice;
	}

	public function getSupplyPrice(){
	  return $this->supplyPrice;
	}

                        	                   			private $stock;
    	                        
	public function setStock($stock){
		$this->stock = $stock;
		$this->apiParas["stock"] = $stock;
	}

	public function getStock(){
	  return $this->stock;
	}

                        	                   			private $hsCode;
    	                        
	public function setHsCode($hsCode){
		$this->hsCode = $hsCode;
		$this->apiParas["hsCode"] = $hsCode;
	}

	public function getHsCode(){
	  return $this->hsCode;
	}

                            }





        
 

