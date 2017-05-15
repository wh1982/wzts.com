<?php
class SellerPromotionSkuAddRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jingdong.seller.promotion.sku.add";
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
                                                             	                        	                                                                                                                          private $promoId;
                              public function setPromoId($promoId ){
                 $this->promoId=$promoId;
              }

              public function getPromoId(){
              	return $this->promoId;
              }
                                                                                                                                                                                                                                                                                                                                                                                                                                      private $skuIds;
                              public function setSkuIds($skuIds ){
                 $this->skuIds=$skuIds;
              }

              public function getSkuIds(){
              	return $this->skuIds;
              }
                                                                                                                                                                                                                                                                                                                                                                                                                                      private $jdPrices;
                              public function setJdPrices($jdPrices ){
                 $this->jdPrices=$jdPrices;
              }

              public function getJdPrices(){
              	return $this->jdPrices;
              }
                                                                                                                                                                                                                                                                                                                                                                                                                                      private $promoPrices;
                              public function setPromoPrices($promoPrices ){
                 $this->promoPrices=$promoPrices;
              }

              public function getPromoPrices(){
              	return $this->promoPrices;
              }
                                                                                                                                                                                                                                                                                                                                              private $seq;
                              public function setSeq($seq ){
                 $this->seq=$seq;
              }

              public function getSeq(){
              	return $this->seq;
              }
                                                                                                                                                                                                                                                                                                                                              private $num;
                              public function setNum($num ){
                 $this->num=$num;
              }

              public function getNum(){
              	return $this->num;
              }
                                                                                                                                                                                                                                                                                                                                                                                                                                      private $bindType;
                              public function setBindType($bindType ){
                 $this->bindType=$bindType;
              }

              public function getBindType(){
              	return $this->bindType;
              }
                                                                                                                                        	}





        
 

