<?php

/**
 * 出库订单确认信息
 * @author auto create
 */
class WlbWmsStockOutOrderConfirm
{
	
	/** 
	 * 运输公司名称
	 **/
	public $carriers_name;
	
	/** 
	 * 支持出入库单多次确认 0 最后一次确认或是一次性确认；1 多次确认；当多次确认时，确认的ITEM种类全部被确认时，确认完成默  认值为 0 例如输入2认为是0
	 **/
	public $confirm_type;
	
	/** 
	 * 仓库订单编码
	 **/
	public $order_code;
	
	/** 
	 * 订单出库时间
	 **/
	public $order_confirm_time;
	
	/** 
	 * 订单商品信息
	 **/
	public $order_items;
	
	/** 
	 * 单据类型301 调拨出库单303 领用出库单901 退供出库单903 其他出库单
	 **/
	public $order_type;
	
	/** 
	 * 外部业务编码，消息ID，用于去重一个合作伙伴中要求唯一
	 **/
	public $out_biz_code;
	
	/** 
	 * 包裹信息
	 **/
	public $package_infos;
	
	/** 
	 * 仓配订单编码
	 **/
	public $store_order_code;
	
	/** 
	 * 运单号或者是托运单号
	 **/
	public $tms_order_code;
	
	/** 
	 * 总包裹数
	 **/
	public $total_package_qty;
	
	/** 
	 * 总体积，单位立方厘米
	 **/
	public $total_package_volume;
	
	/** 
	 * 总重量，单位克
	 **/
	public $total_package_weight;	
}
?>