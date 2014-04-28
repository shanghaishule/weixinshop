<?php
class rightsAction extends frontendAction {
    public function index() {
    	$data = $this->getXmlArray();
    	
    	// 写入文件
    	$filename = 'rights.txt';
    	$fh = fopen($filename, "w");
    	foreach ($data as $key => $value){
    		fwrite($fh, $key."=".$value."\r\n");
    	}
    	fwrite($fh, "\r\n\r\n");
    	//关闭文件
    	fclose($fh);
    	
    	//写入表
    	M('wxpay_rights')->add($data);
    	
    	echo "success";
    	/*
    	switch ($data['msgtype']) {
    		case 'request' : // 新增投诉单，这里可以记录到数据库，以作相应处理
    			print_r($data);
    			break;
    		case 'confirm' : // 买家确认反馈已经得到解决
    			print_r($data);
    			break;
    		case 'reject' : // 买家拒绝问题已经完善解决，需要再次协商
    			print_r($data);
    			break;
    	}
    	*/
        //$this->display();
    	//$this->show('微信支付维权页面!由腾讯方主动调起本页面。');
    }
}
?>