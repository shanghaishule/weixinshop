// JavaScript Document
$(document).ready(function(){
//	$("#BanCont").SlideBtn({
//		BanBtn:        ".banner_link"         //数字按钮    如果不需要请 ""
//		,BtnClick:      "banner_link_red"        //数字按钮效果
//		,BanTxt:        ""          //文本  如果不需要请 ""
//		,MoveSpeed:      4                //间隔时间
//		,ShowNum:        0                //首先显示第几个
//		,Orientation:   "right"            //移动方向
//		,LeftRightBtn:   true             //左右按钮是否生效
//		,SlideCont:     "li"              //移动的类
//		,AutoPlay:       true             //是否自动播放
//		,MoveShowLR:     false             //按钮移动上去显示
//		});

	$("#LeftRight1").SlideTab({
		TabBtn:".pr_list_frist"
		,TabCont:".pr_list_second"
		,TabBtnLi:"li"
		,TabShow:0
		,TabBtnStyle:"pr_list_frist_link"
		,TabTime:300
		});
		
	$("#LeftRight2").SlideTab({
		TabBtn:".pr_list_frist"
		,TabBtnLi:"li"
		,TabCont:".pr_list_3"
		,TabShow:0
		,TabBtnStyle:"pr_list_frist_link"
		,TabTime:300
		});
	
	$("#LeftRight3").SlideTab({
		TabBtn:".pr_list_frist"
		,TabBtnLi:"li"
		,TabCont:".pr_list_3"
		,TabShow:0
		,TabBtnStyle:"pr_list_frist_link"
		,TabTime:300
		});
	
	$("#LeftRight4").SlideTab({
		TabBtn:".pr_list_frist"
		,TabBtnLi:"li"
		,TabCont:".pr_list_3"
		,TabShow:0
		,TabBtnStyle:"pr_list_frist_link"
		,TabTime:300
		});
	});