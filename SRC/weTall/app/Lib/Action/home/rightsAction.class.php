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
    	 
        //$this->display();
    	$this->show('微信支付维权页面!');
    }
}
?>