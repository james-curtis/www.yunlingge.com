<?php
/**
 * TOP API: taobao.tbk.dg.material.optional request
 * 
 * @author auto create
 * @since 1.0, 2018.04.02
 */
class TbkDgMaterialOptionalRequest
{
	/** 
	 * mm_xxx_xxx_xxx的第三位
	 **/
	private $adzoneId;
	
	/** 
	 * 后台类目ID，用,分割，最大10个，该ID可以通过taobao.itemcats.get接口获取到
	 **/
	private $cat;
	
	/** 
	 * 折扣价范围上限，单位：元
	 **/
	private $endPrice;
	
	/** 
	 * 淘客佣金比率上限，如：1234表示12.34%
	 **/
	private $endTkRate;
	
	/** 
	 * 是否有优惠券，设置为true表示该商品有优惠券，设置为false或不设置表示不判断这个属性
	 **/
	private $hasCoupon;
	
	/** 
	 * 是否海外商品，设置为true表示该商品是属于海外商品，设置为false或不设置表示不判断这个属性
	 **/
	private $isOverseas;
	
	/** 
	 * 是否商城商品，设置为true表示该商品是属于淘宝商城商品，设置为false或不设置表示不判断这个属性
	 **/
	private $isTmall;
	
	/** 
	 * 所在地
	 **/
	private $itemloc;
	
	/** 
	 * 第几页，默认：１
	 **/
	private $pageNo;
	
	/** 
	 * 页大小，默认20，1~100
	 **/
	private $pageSize;
	
	/** 
	 * 链接形式：1：PC，2：无线，默认：１
	 **/
	private $platform;
	
	/** 
	 * 查询词
	 **/
	private $q;
	
	/** 
	 * 排序_des（降序），排序_asc（升序），销量（total_sales），淘客佣金比率（tk_rate）， 累计推广量（tk_total_sales），总支出佣金（tk_total_commi），价格（price）
	 **/
	private $sort;
	
	/** 
	 * 店铺dsr评分，筛选高于等于当前设置的店铺dsr评分的商品0-50000之间
	 **/
	private $startDsr;
	
	/** 
	 * 折扣价范围下限，单位：元
	 **/
	private $startPrice;
	
	/** 
	 * 淘客佣金比率下限，如：1234表示12.34%
	 **/
	private $startTkRate;
	
	private $apiParas = array();
	
	public function setAdzoneId($adzoneId)
	{
		$this->adzoneId = $adzoneId;
		$this->apiParas["adzone_id"] = $adzoneId;
	}

	public function getAdzoneId()
	{
		return $this->adzoneId;
	}

	public function setCat($cat)
	{
		$this->cat = $cat;
		$this->apiParas["cat"] = $cat;
	}

	public function getCat()
	{
		return $this->cat;
	}

	public function setEndPrice($endPrice)
	{
		$this->endPrice = $endPrice;
		$this->apiParas["end_price"] = $endPrice;
	}

	public function getEndPrice()
	{
		return $this->endPrice;
	}

	public function setEndTkRate($endTkRate)
	{
		$this->endTkRate = $endTkRate;
		$this->apiParas["end_tk_rate"] = $endTkRate;
	}

	public function getEndTkRate()
	{
		return $this->endTkRate;
	}

	public function setHasCoupon($hasCoupon)
	{
		$this->hasCoupon = $hasCoupon;
		$this->apiParas["has_coupon"] = $hasCoupon;
	}

	public function getHasCoupon()
	{
		return $this->hasCoupon;
	}

	public function setIsOverseas($isOverseas)
	{
		$this->isOverseas = $isOverseas;
		$this->apiParas["is_overseas"] = $isOverseas;
	}

	public function getIsOverseas()
	{
		return $this->isOverseas;
	}

	public function setIsTmall($isTmall)
	{
		$this->isTmall = $isTmall;
		$this->apiParas["is_tmall"] = $isTmall;
	}

	public function getIsTmall()
	{
		return $this->isTmall;
	}

	public function setItemloc($itemloc)
	{
		$this->itemloc = $itemloc;
		$this->apiParas["itemloc"] = $itemloc;
	}

	public function getItemloc()
	{
		return $this->itemloc;
	}

	public function setPageNo($pageNo)
	{
		$this->pageNo = $pageNo;
		$this->apiParas["page_no"] = $pageNo;
	}

	public function getPageNo()
	{
		return $this->pageNo;
	}

	public function setPageSize($pageSize)
	{
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize()
	{
		return $this->pageSize;
	}

	public function setPlatform($platform)
	{
		$this->platform = $platform;
		$this->apiParas["platform"] = $platform;
	}

	public function getPlatform()
	{
		return $this->platform;
	}

	public function setQ($q)
	{
		$this->q = $q;
		$this->apiParas["q"] = $q;
	}

	public function getQ()
	{
		return $this->q;
	}

	public function setSort($sort)
	{
		$this->sort = $sort;
		$this->apiParas["sort"] = $sort;
	}

	public function getSort()
	{
		return $this->sort;
	}

	public function setStartDsr($startDsr)
	{
		$this->startDsr = $startDsr;
		$this->apiParas["start_dsr"] = $startDsr;
	}

	public function getStartDsr()
	{
		return $this->startDsr;
	}

	public function setStartPrice($startPrice)
	{
		$this->startPrice = $startPrice;
		$this->apiParas["start_price"] = $startPrice;
	}

	public function getStartPrice()
	{
		return $this->startPrice;
	}

	public function setStartTkRate($startTkRate)
	{
		$this->startTkRate = $startTkRate;
		$this->apiParas["start_tk_rate"] = $startTkRate;
	}

	public function getStartTkRate()
	{
		return $this->startTkRate;
	}

	public function getApiMethodName()
	{
		return "taobao.tbk.dg.material.optional";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->adzoneId,"adzoneId");
		RequestCheckUtil::checkMaxValue($this->startDsr,50000,"startDsr");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
