<?php

/**
 * 商品优惠策略详情
 * @author auto create
 */
class Promotion
{
	
	/** 
	 * 减价件数，1只减一件，0表示多件
	 **/
	public $decrease_num;
	
	/** 
	 * 优惠类型，PRICE表示按价格优惠，DISCOUNT表示按折扣优惠
	 **/
	public $discount_type;
	
	/** 
	 * 优惠额度
	 **/
	public $discount_value;
	
	/** 
	 * 优惠结束日期
	 **/
	public $end_date;
	
	/** 
	 * 是否免邮（暂不可用，预留参数）
	 **/
	public $free_postage;
	
	/** 
	 * 预留字段
	 **/
	public $group_id;
	
	/** 
	 * 带指定渠道参数的宝贝详情URL
	 **/
	public $item_detail_url;
	
	/** 
	 * 商品数字ID
	 **/
	public $num_iid;
	
	/** 
	 * 优惠描述
	 **/
	public $promotion_desc;
	
	/** 
	 * 优惠ID
	 **/
	public $promotion_id;
	
	/** 
	 * 优惠标题，显示在宝贝详情页面的优惠图标的tip。
	 **/
	public $promotion_title;
	
	/** 
	 * 优惠开始日期
	 **/
	public $start_date;
	
	/** 
	 * 优惠策略状态，ACTIVE表示有效，UNACTIVE表示无效
	 **/
	public $status;
	
	/** 
	 * 对应的人群标签ID
	 **/
	public $tag_id;	
}
?>