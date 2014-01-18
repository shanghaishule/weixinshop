function upyunPicUpload(domid,width,height,token){
	art.dialog.data('width', width);
	art.dialog.data('height', height);
	art.dialog.data('domid', domid);
	art.dialog.data('lastpic', $('#'+domid).val());
	art.dialog.open('/index.php?g=User&m=Upyun&a=upload&token='+token+'&width='+width,{lock:false,title:'上传图片',width:400,height:140,yesText:'关闭',background: '#000',opacity: 0.87});
}
function viewImg(domid){
	if($('#'+domid).val()){
		var html='<img src="'+$('#'+domid).val()+'" />';
	}else{
		var html='没有图片';
	}
	art.dialog({title:'图片预览',content:html});
}