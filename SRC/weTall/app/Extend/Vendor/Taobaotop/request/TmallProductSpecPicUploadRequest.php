<?php
/**
 * TOP API: tmall.product.spec.pic.upload request
 * 
 * @author auto create
 * @since 1.0, 2012-11-05 12:39:25
 */
class TmallProductSpecPicUploadRequest
{
	/** 
	 * 上传的认证图片文件
	 **/
	private $certifyPic;
	
	/** 
	 * 上传的认证图片的认证类型
	 **/
	private $certifyType;
	
	private $apiParas = array();
	
	public function setCertifyPic($certifyPic)
	{
		$this->certifyPic = $certifyPic;
		$this->apiParas["certify_pic"] = $certifyPic;
	}

	public function getCertifyPic()
	{
		return $this->certifyPic;
	}

	public function setCertifyType($certifyType)
	{
		$this->certifyType = $certifyType;
		$this->apiParas["certify_type"] = $certifyType;
	}

	public function getCertifyType()
	{
		return $this->certifyType;
	}

	public function getApiMethodName()
	{
		return "tmall.product.spec.pic.upload";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->certifyPic,"certifyPic");
		RequestCheckUtil::checkNotNull($this->certifyType,"certifyType");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
