<?php
/**
 * TOP API: taobao.user.seller.get request
 * 
 * @author auto create
 * @since 1.0, 2015.07.29
 */
class UserSellerGetRequest
{
	/** 
	 * 需要返回的字段列表，可选值为返回示例值中的可以看到的字段
	 **/
	private $fields;
	
	private $apiParas = array();
	
	public function setFields($fields)
	{
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields()
	{
		return $this->fields;
	}

	public function getApiMethodName()
	{
		return "taobao.user.seller.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->fields,"fields");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
