<?php

error_reporting(0);
@ini_set ('memory_limit', '512M');
@set_time_limit(1000);
@set_magic_quotes_runtime(0);
include('config.ini.php');

//参数设置
define('SOFT_VERSION', '1.01版');
define('SOFT_RELEASE', $version);
define('ROOT_PATH', dirname(__FILE__).'/../');//网站根目录
define('SOFT_NAME', '同盟科技微信公共平台'.SOFT_VERSION);
define('DBCHARSET','UTF8');//编码 分为 UTF8 GBK
//----------------------语言包
$lang = array(
'license'=>'<div class="license"><h1>系统安装协议</h1>
                <p>版权所有 (c)2012-2013 保留所有权利。 </p>
				<p>感谢您选择同盟科技微信公共平台基于 PHP + MySQL   的技术开发，全部源码开放。</p>
				<p>本版本更新</p>
				<p>1、增加至32套3G模板</p>
				<p>2、上传改为本地上传</p>
				<p>3、全新的后台UI界面</p>
				<p>4、增加后台更新系统</p>
				<p><b>版本最新更新：</b> 2013年12月14日</p>
                <p align=right>同盟科技微信平台</p>
</div>',
'agreement_yes' => '我同意，继续安装',
'agreement_no' => '我不同意',
'title_install' => ' VFAn微信公共平台V'.SOFT_VERSION.' 安装程序',
'error_quit_msg' => '您必须解决以上问题，安装才可以继续',
'click_to_back' => '点击返回上一步',

'writeable' => '可写',
'nodir' => '目录不存在',
'nofile' => '文件所在目录不可写',
'unwriteable' => '不可写',
'env_check' => '环境检查',
'install_required' => '所需配置',
'install_best' => '推荐',
'curr_server' => '当前服务器',
'priv_check' => '权限检查',
'step1_file' => '目录文件',
'step1_need_status' => '所需状态',
'step1_status' => '当前状态',
'supportted' => '支持',
'none' => '无',
'unsupportted' => '不支持',
'func_depend' => '函数检查',
'check_result' => '检查结果',//检查结果
'suggestion' => '建议',//建议
'old_step' => '上一步',
'new_step' => '下一步',
'notset' => '不限制',
'project' => '项目',
'func_name' => '函数名称',//函数名称

'php_check' => '请使用php 5.0 以上版本',
'mysql_connect_comment' => '请检查 mysql 模块是否正确加载',
'file_get_contents_comment' => '该函数需要 php.ini 中 allow_url_fopen 选项开启。请联系空间商，确定开启了此项功能',
'mb_convert_encoding_comment' => '该函数需要 php.ini 中 增加 mb_string 扩展。请联系空间商，确定开启了此项功能',

'step_env_check_title' => '开始安装',
'step_env_check_desc' => '环境以及文件目录权限检查',
'step_db_init_title' => '安装数据库',
'step_db_init_desc' => '正在执行数据库安装',
'step_app_reg_title' => '设置运行环境',
'step_app_reg_desc' => '检测服务器环境',

'os' => '操作系统',
'php' => 'PHP 版本',
'unlimit' => '不限制',
'version' => '版本',
'gdversion' => 'GD 库',
'allow' => '允许',
'unix' => 'LINUX',
'diskspace' => '磁盘空间',

'tips_siteinfo' => '请填写站点信息',
'sitename' => '站点名称',
'siteurl' => '站点 URL',
'error_message' => '错误信息',

'database_errno_2003' => '无法连接数据库，请检查数据库是否启动，数据库服务器地址是否正确',
'database_errno_1044' => '无法创建新的数据库，请检查数据库名称填写是否正确',
'database_errno_1045' => '无法连接数据库，请检查数据库用户名或者密码是否正确',
'database_errno_1064' => 'SQL 语法错误',
'database_connect_error' => '数据库连接错误',
'database_version_old' => '数据库版本过低，请使用4.1以上版本的数据库',

'dbname_invalid' => '数据库名为空，请填写数据库名称',
'tablepre_invalid' => '数据表前缀为空，或者格式错误，请检查',
'dbport_invvalid' => '数据库端口不能为空，请检查',
'admin_username_invalid' => '非法用户名，用户名长度不应当超过 15 个英文字符，且不能包含特殊字符，一般是中文，字母或者数字',
'admin_password_invalid' => '密码和上面不一致，请重新输入',
'admin_invalid' => '您的信息管理员信息没有填写完整，请仔细填写每个项目',
'tips_dbinfo' => '数据库信息',
'dbhost' => '数据库服务器',
'dbuser' => '数据库用户名',
'dbpw' => '数据库密码',
'dbname' => '数据库名',
'tablepre' => '数据表前缀',
'dbport' =>'数据库端口',
'tips_admininfo' => '网站信息',
'username' => '管理员账号',
'password' => '管理员密码',
'password_comment' => '管理员密码不能为空',
'password2' => '重复密码',

'dbinfo_dbhost_invalid' => '数据库服务器为空，或者格式错误，请检查',
'dbinfo_dbname_invalid' => '数据库名为空，或者格式错误，请检查',
'admininfo_sitename_invalid' => '网站名称不能为空',
'admininfo_username_invalid' => '管理员用户名为空，或者格式错误，请检查',
'admininfo_password_invalid' => '管理员密码为空，请填写',
'admininfo_password2_invalid' => '两次密码不一致，请检查',
'install_in_processed' => '正在安装...',
'create_table' => '数据表',
'succeed' => '建立成功',
'install_succeed' => '安装成功，点击进入',
'forceinstall' => '强制安装',
'dbinfo_forceinstall_invalid' => '当前数据库当中已经含有同样表前缀的数据表，您可以修改“表名前缀”来避免删除旧的数据，或者选择强制安装。强制安装会删除旧数据，且无法恢复',
'forceinstall_check_label' => '删除数据，重新安装',
'insert_demo_data' => '演示数据',
'database_nonexistence' => '数据库操作对象不存在',
'method_undefined' => '未定义方法',
'file_all_pass'=>'文件权限全部通过',

'install_succ_remark'=>'<p class=\'nest\'>系统安装完成：</p>
		<p class=\'nes\'>1.系统后台地址：<a href=\'http://'.$_SERVER['HTTP_HOST'].trim(str_replace(strstr($_SERVER['SCRIPT_NAME'], '/install'),"",$_SERVER['SCRIPT_NAME'])).'/admin.php\' target=\'_blank\'>http://'.$_SERVER['HTTP_HOST'].trim(str_replace(strstr($_SERVER['SCRIPT_NAME'], '/install'),"",$_SERVER['SCRIPT_NAME'])).'/admin.php</a></p>
		<p class=\'nes\'>2.系统前台地址：<a href=\'http://'.$_SERVER['HTTP_HOST'].trim(str_replace(strstr($_SERVER['SCRIPT_NAME'], '/install'),"",$_SERVER['SCRIPT_NAME'])).'\' target=\'_blank\'>http://'.$_SERVER['HTTP_HOST'].trim(str_replace(strstr($_SERVER['SCRIPT_NAME'], '/install'),"",$_SERVER['SCRIPT_NAME'])).'</a></p>',
'undefine_func'=>'环境不支持的函数',
'php_version_too_low'=>'PHP版本过低，最低版本要求5.0或以上版本',
'confirm_set_remark'=>'我已经仔细阅读了以上说明，可以进入前台了'
);
//-----------------------语言包end

//-----------------------变量参数
$func_items = array(
'mysql_connect',
'fsockopen',
'gethostbyname',
'file_get_contents',
'mb_convert_encoding',
'file_get_contents',
'curl_init',
'fopen',
);

$env_items = array(
'php' => array('c' => 'PHP_VERSION', 'r' => '5.0', 'b' => '5.2'),
'gdversion' => array('r' => '1.0', 'b' => '2.0'),
'diskspace' => array('r' => '2G', 'b' => 'notset'),
);
$dirfile_items = array(
    'conf' => array('type' => 'file', 'path' => './data/conf/db.php'),
);

$form_app_reg_items = array(
	'siteinfo' => array(
	'sitename' => array('type' => 'text', 'required' => 1, 'reg' => '/^.*$/', 'value' => array('type' => 'constant', 'var' => 'SOFT_NAME')),
	)
);

$form_db_init_items = array(
	'dbinfo' => array(
		'dbhost' => array('type' => 'text', 'required' => 1, 'reg' => '/^.+$/', 'value' => array('type' => 'var', 'var' => 'dbhost')),
		'dbname' => array('type' => 'text', 'required' => 1, 'reg' => '/^.+$/', 'value' => array('type' => 'var', 'var' => 'dbname')),
		'dbuser' => array('type' => 'text', 'required' => 0, 'reg' => '/^.*$/', 'value' => array('type' => 'var', 'var' => 'dbuser')),
		'dbpw' => array('type' => 'text', 'required' => 0, 'reg' => '/^.*$/', 'value' => array('type' => 'var', 'var' => 'dbpw')),
		'tablepre' => array('type' => 'text', 'required' => 0, 'reg' => '/^.*+/', 'value' => array('type' => 'var', 'var' => 'tablepre')),
		'dbport' => array('type' => 'text', 'required' => 1, 'reg' => '/^.*+/', 'value' => array('type' => 'var', 'var' => 'dbport')),
	),
	'admininfo' => array(
		'username' => array('type' => 'text', 'required' => 1, 'reg' => '/^.*$/'),
		'password' => array('type' => 'password', 'required' => 1, 'reg' => '/^.*$/'),
		'password2' => array('type' => 'password', 'required' => 1, 'reg' => '/^.*$/'),
	)
);

//---------------------------------安装部分

//步骤
$allow_method = array('show_license', 'env_check', 'db_init');
$step = intval(getgpc('step', 'R')) ? intval(getgpc('step', 'R')) : 0;
$method = isset($allow_method[$step]) ? $allow_method[$step] : '';

//检测标识文件是否存在，如果存在，那么停止安装
if (file_exists('lock')){
	@header("Content-type: text/html; charset=UTF-8");
	echo "系统已经安装过了，如果要重新安装，那么请删除install目录下的lock文件";
	exit;
}

if(empty($method)) {
	show_msg('method_undefined', $method, 0);
}
if(!class_exists('dbstuff')) {
	show_msg('database_nonexistence', '', 0);
}

if($method == 'show_license') {//声明
	show_license();
} elseif($method == 'env_check') {//检测环境
	$php_version = intval(substr(str_replace('.','',phpversion()),0,2));
	if($php_version < 50) {
		show_msg('php_check','',0);
	}

	function_check($func_items);

	env_check($env_items);

	dirfile_check($dirfile_items);

	show_env_result($env_items, $dirfile_items);

} elseif($method == 'db_init') {//数据库信息
	$submit = true;
	$error_msg = array();

	if(isset($form_db_init_items) && is_array($form_db_init_items)) {
		foreach($form_db_init_items as $key => $items) {
			$$key = getgpc($key, 'p');
			if(!isset($$key) || !is_array($$key)) {
				$submit = false;
				break;
			}
			foreach($items as $k => $v) {
				$tmp = $$key;
				$$k = $tmp[$k];
				if(empty($$k) || !preg_match($v['reg'], $$k)) {
					if(empty($$k) && !$v['required']) {
						continue;
					}
					$submit = false;
					$error_msg[$key][$k] = 1;
				}
			}
		}
	} else {
		$submit = false;
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if($password != $password2) {
			$error_msg['admininfo']['password2'] = 1;
			$submit = false;
		}
		$forceinstall = isset($_POST['dbinfo']['forceinstall']) ? $_POST['dbinfo']['forceinstall'] : '';
		$dbname_not_exists = true;
		if(!empty($dbhost) && empty($forceinstall)) {
			$dbname_not_exists = check_db($dbhost, $dbuser, $dbpw, $dbname, $tablepre,$dbport);
			if(!$dbname_not_exists) {
				$form_db_init_items['dbinfo']['forceinstall'] = array('type' => 'checkbox', 'required' => 0, 'reg' => '/^.*+/');
				$error_msg['dbinfo']['forceinstall'] = 1;
				$submit = false;
				$dbname_not_exists = false;
			}
		}
	}

	if($submit) {
		$step = $step + 1;
		if(empty($dbname)) {
			show_msg('dbname_invalid', $dbname, 0);
		} else {
			if(!@mysql_connect($dbhost.":".$dbport, $dbuser, $dbpw)) {
				$errno = mysql_errno();
				$error = mysql_error();
				if($errno == 1045) {
					show_msg('database_errno_1045', $error, 0);
				} elseif($errno == 2003) {
					show_msg('database_errno_2003', $error, 0);
				} else {
					show_msg('database_connect_error', $error, 0);
				}
			}

			if(mysql_get_server_info() > '4.1') {
				mysql_query("CREATE DATABASE IF NOT EXISTS `$dbname` DEFAULT CHARACTER SET ".DBCHARSET);
			} else {
				show_msg('database_version_old', $error, 0);
			}

			if(mysql_errno()) {
				show_msg('database_errno_1044', mysql_error(), 0);
			}
			//mysql_close();
		}

		if(strpos($tablepre, '.') !== false) {
			show_msg('tablepre_invalid', $tablepre, 0);
		}

		if($username && $password) {
			if(strlen($username) > 15 || preg_match("/^$|^c:\\con\\con$|　|[,\"\s\t\<\>&]|^游客|^Guest/is", $username)) {
				show_msg('admin_username_invalid', $username, 0);
			}
		} else {
			show_msg('admininfo_invalid', '', 0);
		}
		show_header();
		$confstatus=config_edit();
		if($confstatus['status']==1){
			//入库
			$db = new dbstuff;
			$db->connect($dbhost.":".$dbport, $dbuser, $dbpw, $dbname, DBCHARSET);

			$sqlfile = 'sql/data.sql';
			$sql = file_get_contents($sqlfile);
			$sql = str_replace("\r\n", "\n", $sql);
			show_install();
			runquery($sql);

			$sqlfile = 'sql/other.sql';
			$sql = file_get_contents($sqlfile);
			$sql = str_replace("\r\n", "\n", $sql);
			runquery($sql);

			//系统设置中网站名称的修改
			/**
			 * 转码
			 */
			if (strtoupper(DBCHARSET) == 'GBK'){
				$username = iconv('UTF-8','GBK',$username);
				$password = iconv('UTF-8','GBK',$password);
			}

			//管理员帐号密码
            $password = md5($password);
			$db->query("INSERT INTO `{$tablepre}user` (`id`, `username`, `password`, `role`, `status`, `remark`, `last_login_time`, `last_login_ip`, `last_location`) VALUES
(1, '".$username."', '".$password."', 5, 1, '', 1383453875, '127.0.0.1', '')");
			//新增一个标识文件，用来屏蔽重新安装
			$fp = @fopen(ROOT_PATH.'install/lock','wb+');
			@fclose($fp);
		}else{
			echo '</div><div class="main"><div class="licenseblock">'.$confstatus['msg']."</div>";
		}
		show_footer(0);exit();
	}
	$dbhost = 'localhost';
	$dbname = 'pigcms';
	$dbuser = 'root';
	$dbpw = '123456';
	$tablepre = 'tp_';
	$dbport = '3306';
	$fanli_name = 'VFAn微信公共平台演示站';
	show_form($form_db_init_items, $error_msg);
}

//输出声明
function show_license() {
	global $step;
	$next = $step + 1;
	show_header();
	$license = str_replace('  ', '&nbsp; ', lang('license'));
	$lang_agreement_yes = lang('agreement_yes');
	$lang_agreement_no = lang('agreement_no');
	echo <<<EOT
		</div>
		<div class="main">
			<div class="licenseblock">$license</div>
			<div class="btnbox marginbot">
				<form method="post" action="index.php">
				<input type="hidden" name="step" value="$next">
				<input type="submit" name="submit" value="{$lang_agreement_yes}" style="padding: 2px">&nbsp;
				<input type="button" name="exit" value="{$lang_agreement_no}" style="padding: 2px" onclick="javascript: window.close(); return false;">
				</form>
			</div>
EOT;
	show_footer();
}
//输出页头
function show_header() {
	global $step;
	$version = SOFT_VERSION;
	$release = SOFT_RELEASE;
	$title = lang('title_install');
	echo <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>$title</title>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<meta content="VFAn微信公共平台" name="Copyright" />
<script type="text/javascript">
	function $(id) {
		return document.getElementById(id);
	}
	function showmessage(message) {
		$('notice').value += message + "\\r\\n";
	}
</script>

</head>
<div class="container">
	<div class="header">
		<h1>$title</h1>
		<span>V$version $release</span>
EOT;

	$step > 0 && show_step($step);
}
//输出页脚
function show_footer($quit = true) {
?>
			<div class="footer">
			    <p>Powered by 同盟科技微信公共平台© v1.01 2012-2013</p>
				<p>版权所有</p>
			</div>
		</div>
		</div>
		</body>
		</html>
<?php
	$quit && exit();
}
//安装内容
function show_install() {
?>
		<script type="text/javascript">
		var message_t = 0;
		function showmessage(message) {
			document.getElementById('notice').value += message + "\r\n";
			message_t = message_t + 1;
			if(message_t > 85){
				document.getElementById("message1").style.display = 'block';
				document.getElementById("message2").style.display = 'block';
				document.getElementById("message3").style.display = 'block';
			}
		}
		function initinput() {
			window.open('../');
		}
		function change_input(){
			if(document.getElementById("checkbox_install_succ").checked == true){
				document.getElementById("laststep").className = 'las-2';
				document.getElementById("laststep").disabled = false;
			}else{
				document.getElementById("laststep").className = 'las-1';
				document.getElementById("laststep").disabled = true;
			}
		}
		</script>
	<div class="main">
		<div class="btnbox"><textarea name="notice" class="shop-tex"  readonly="readonly" id="notice"></textarea></div>
		<div class="btnbox marginbot" id="message1">
			<?php echo lang('install_succ_remark');?>
		</div>
		<div class="btnbox marginbot" style="display: none;" id="message2">
			<input type="checkbox" id="checkbox_install_succ" onclick="change_input();"><label class="ziti-c" for="checkbox_install_succ"><?php echo lang('confirm_set_remark');?></label>
		</div>
		<div class="btnbox marginbot" style="display: none;" id="message3">
	<input type="button" class="las-1" name="submit"  disabled style="height: 25" id="laststep" onclick="initinput()">
	</div>
<?php
}
//----------------------方法集
function getgpc($k, $t='GP') {
	$t = strtoupper($t);
	switch($t) {
		case 'GP' : isset($_POST[$k]) ? $var = &$_POST : $var = &$_GET; break;
		case 'G': $var = &$_GET; break;
		case 'P': $var = &$_POST; break;
		case 'C': $var = &$_COOKIE; break;
		case 'R': $var = &$_REQUEST; break;
	}
	return isset($var[$k]) ? $var[$k] : '';
}
//产生随机字符
function random($length, $numeric = 0) {
	$seed = base_convert(md5(print_r($_SERVER, 1).microtime()), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $seed[mt_rand(0, $max)];
	}
	return $hash;
}
//语言包
function lang($lang_key, $force = true) {
	return isset($GLOBALS['lang'][$lang_key]) ? $GLOBALS['lang'][$lang_key] : ($force ? $lang_key : '');
}

//检测函数是否存在
function function_check(&$func_items) {
	$func = array();
	foreach($func_items as $item) {
		if(!function_exists($item)) $func[] = $item;
	}
	if(!empty($func)) show_msg('undefine_func', $func);
}
//抛出信息
function show_msg($error_no, $error_msg = 'ok', $success = 1, $quit = TRUE) {
	show_header();
	global $step;

	$title = lang($error_no);
	$comment = '';

	if($error_msg) {
		if(!empty($error_msg)) {
			foreach ((array)$error_msg as $k => $v) {
				if(is_numeric($k)) {
					$comment .= "<li><em class=\"red\">".lang($v)."</em></li>".lang($v.'_comment', false);
				}
			}
		}
	}

	if($step > 0) {
		echo "<div class=\"desc\"><b>$title</b><ul>$comment</ul>";
	} else {
		echo "</div><div class=\"main\" style=\"margin-top: -123px;\"><b>$title</b><ul style=\"line-height: 200%; margin-left: 30px;\">$comment</ul>";
	}

	if($quit) {
		echo '<br /><span class="red">'.lang('error_quit_msg').'</span><br /><br /><br />';
	}

	echo '<input type="button" onclick="history.back()" value="'.lang('click_to_back').'" /><br /><br /><br />';

	echo '</div>';

	$quit && show_footer();
}
//系统环境检查
function env_check(&$env_items) {
	foreach($env_items as $key => $item) {
		if($key == 'php') {
			$env_items[$key]['current'] = PHP_VERSION;
		} elseif($key == 'gdversion') {
			$tmp = function_exists('gd_info') ? gd_info() : array();
			$env_items[$key]['current'] = empty($tmp['GD Version']) ? 'noext' : $tmp['GD Version'];
			unset($tmp);
		} elseif($key == 'diskspace') {
			if(function_exists('disk_free_space')) {
				$env_items[$key]['current'] = floor(disk_free_space(ROOT_PATH) / (1024*1024)).'M';
			} else {
				$env_items[$key]['current'] = 'unknow';
			}
		} elseif(isset($item['c'])) {
			$env_items[$key]['current'] = constant($item['c']);
		}

		$env_items[$key]['status'] = 1;
		if($item['r'] != 'notset' && strcmp($env_items[$key]['current'], $item['r']) < 0) {
			$env_items[$key]['status'] = 0;
		}
	}
}
//文件权限检查
function dirfile_check(&$dirfile_items) {
	foreach($dirfile_items as $key => $item) {
		$item_path = $item['path'];
		if($item['type'] == 'dir') {
			if(!dir_writeable(ROOT_PATH.$item_path)) {
				if(is_dir(ROOT_PATH.$item_path)) {
					$dirfile_items[$key]['status'] = 0;
					$dirfile_items[$key]['current'] = '+r';
				} else {
					$dirfile_items[$key]['status'] = -1;
					$dirfile_items[$key]['current'] = 'nodir';
				}
			} else {
				$dirfile_items[$key]['status'] = 1;
				$dirfile_items[$key]['current'] = '+r+w';
			}
		} else {
			if(file_exists(ROOT_PATH.$item_path)) {
				if(is_writable(ROOT_PATH.$item_path)) {
					$dirfile_items[$key]['status'] = 1;
					$dirfile_items[$key]['current'] = '+r+w';
				} else {
					$dirfile_items[$key]['status'] = 0;
					$dirfile_items[$key]['current'] = '+r';
				}
			} else {
				if ($fp = @fopen(ROOT_PATH.$item_path,'wb+')){
					$dirfile_items[$key]['status'] = 1;
					$dirfile_items[$key]['current'] = '+r+w';
				}else {
					$dirfile_items[$key]['status'] = -2;
					$dirfile_items[$key]['current'] = 'nofile';
				}
			}
		}
	}
}
function dir_writeable($dir) {
	$writeable = 0;
	if(!is_dir($dir)) {
		@mkdir($dir, 0755);
	}else {
		@chmod($dir,0755);
	}
	if(is_dir($dir)) {
		if($fp = @fopen("$dir/test.txt", 'w')) {
			@fclose($fp);
			@unlink("$dir/test.txt");
			$writeable = 1;
		} else {
			$writeable = 0;
		}
	}
	return $writeable;
}

//环境检查输出
function show_env_result(&$env_items, &$dirfile_items) {

	$env_str = $file_str = $dir_str ='';

	foreach($env_items as $key => $item) {
		if($key == 'php' && strcmp($item['current'], $item['r']) < 0) {
			show_msg('php_version_too_low', $item['current'], 0);
		}
		$status = 1;
		if($item['r'] != 'notset') {
			if(intval($item['current']) && intval($item['r'])) {
				if(intval($item['current']) < intval($item['r'])) {
					$status = 0;
					$env_wrong_sign = true;//是否进行下一步，这里为报错
				}
			} else {
				if(strcmp($item['current'], $item['r']) < 0) {
					$status = 0;
					$env_wrong_sign = true;//是否进行下一步，这里为报错
				}
			}
		}
		$env_str .= "<tr>\n";
		$env_str .= "<td>".lang($key)."</td>\n";
		$env_str .= "<td class=\"padleft\">".lang($item['r'])."</td>\n";
		$env_str .= "<td class=\"padleft\">".lang($item['b'])."</td>\n";
		$env_str .= ($status ? "<td class=\"pdleft1\">" : "<td class=\"red pdleft1\">").$item['current']."</td>\n";
		$env_str .= "</tr>\n";
	}

	foreach($dirfile_items as $key => $item) {
		$tagname = $item['type'] == 'file' ? 'File' : 'Dir';
		if ($item['status'] !== 1){
			$variable = $item['type'].'_str';
			$$variable .= "<tr>\n";
			$$variable .= "<td>$item[path]</td><td class=\"pdleft1\">".lang('writeable')."</td>\n";
			if($item['status'] == 1) {
				$$variable .= "<td class=\"pdleft1\">".lang('writeable')."</td>\n";
			} elseif($item['status'] == -1) {
				$dir_wrong_sign = true;//是否进行下一步，这里为报错
				$$variable .= "<td class=\"red pdleft1\">".lang('nodir')."</td>\n";
			}  elseif($item['status'] == -2) {
				$dir_wrong_sign = true;//是否进行下一步，这里为报错
				$$variable .= "<td class=\"red pdleft1\">".lang('nofile')."</td>\n";
			} else {
				$dir_wrong_sign = true;//是否进行下一步，这里为报错
				$$variable .= "<td class=\"red pdleft1\">".lang('unwriteable')."</td>\n";
			}
			$$variable .= "</tr>\n";
		}
	}
	//通过检测
	if (empty($$variable)){
		$file_str .= "<tr>\n";
		$file_str .= "<td colspan='3' align='center'>".lang('file_all_pass')."</td>\n";
		$file_str .= "</tr>\n";
	}

	show_header();

	echo "<h2 class=\"title\">".lang('env_check')."</h2>\n";
	echo "<table class=\"tb\" style=\"margin:20px 0 20px 55px;\">\n";
	echo "<tr>\n";
	echo "\t<th>".lang('project')."</th>\n";
	echo "\t<th class=\"padleft\">".lang('install_required')."</th>\n";
	echo "\t<th class=\"padleft\">".lang('install_best')."</th>\n";
	echo "\t<th class=\"padleft\">".lang('curr_server')."</th>\n";
	echo "</tr>\n";
	echo $env_str;
	echo "</table>\n";

	echo "<h2 class=\"title\">".lang('priv_check')."</h2>\n";
	echo "<table class=\"tb\" style=\"margin:20px 0 20px 55px;width:90%;\">\n";
	echo "\t<tr>\n";
	echo "\t<th>".lang('step1_file')."</th>\n";
	echo "\t<th class=\"padleft\">".lang('step1_need_status')."</th>\n";
	echo "\t<th class=\"padleft\">".lang('step1_status')."</th>\n";
	echo "</tr>\n";
	echo $file_str;
	echo $dir_str;
	echo "</table>\n";
	if ($env_wrong_sign == true || $dir_wrong_sign == true || $fun_wrong_sign == true){
		show_next_step(1);
	}else {
		show_next_step(2);
	}
	show_footer();
}
//显示下一步
function show_next_step($step) {
	echo "<form action=\"index.php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"step\" value=\"$step\" />";
	$nextstep = "<input type=\"button\" onclick=\"history.back();\" value=\"".lang('old_step')."\"><input type=\"submit\" value=\"".lang('new_step')."\">\n";
	echo "<div class=\"btnbox marginbot\">".$nextstep."</div>\n";
	echo "</form>\n";
}
//当前步骤
function show_step($step) {

	global $method;

	$laststep = 4;
	$title = lang('step_'.$method.'_title');
	$comment = lang('step_'.$method.'_desc');

	$stepclass = array();
	for($i = 1; $i <= $laststep; $i++) {
		$stepclass[$i] = $i == $step ? 'current' : ($i < $step ? '' : 'unactivated');
	}
	$stepclass[$laststep] .= ' last';

	echo <<<EOT
	<div class='dress dress$step'><h3>$title</h3><p>$comment</p></div>
</div>
<div class="main">
EOT;
}
//输出表单
function show_form(&$form_items, $error_msg) {
	global $step;
	if(empty($form_items) || !is_array($form_items)) {
		return;
	}
	show_header();
	show_setting('start');
	show_setting('hidden', 'step', $step);
	$is_first = 1;

	foreach($form_items as $key => $items) {
		global ${'error_'.$key};
		if($is_first == 0) {
			echo '</table>';
		}

		if(!${'error_'.$key}) {
			show_tips('tips_'.$key);
		} else {
			show_error('tips_admin_config', ${'error_'.$key});
		}

		echo '<table class="tb2">';

		foreach($items as $k => $v) {
			global $$k;
			if(!empty($error_msg)) {
				$value = isset($_POST[$key][$k]) ? $_POST[$key][$k] : '';
			} else {
				if(isset($v['value']) && is_array($v['value'])) {
					if($v['value']['type'] == 'constant') {
						$value = defined($v['value']['var']) ? constant($v['value']['var']) : '';
					} else {
						$value = $GLOBALS[$v['value']['var']];
					}
				} else {
					$value = '';
				}
			}
			if($v['type'] == 'checkbox') {
				$value = '1';
			}

			show_setting($k, $key.'['.$k.']', $value, $v['type'], isset($error_msg[$key][$k]) ? $key.'_'.$k.'_invalid' : '');
		}

		//当为环境配置的步骤时，单独输出是否增加演示数据
		if ($step == 2 && $key == 'dbinfo'){
			if ($_POST['demo_date'] == '1'){
				$demo_check = "checked='checked'";
			}
			echo "&nbsp;</td>\n<td>&nbsp;";
			if($error) {
				$comment = '<span class="red">'.(is_string($error) ? lang($error) : lang($setname.'_error')).'</span>';
			} else {
				$comment = lang($setname.'_comment', false);
			}
			echo "$comment</td>\n</tr>\n";
		}

		if($is_first) {
			$is_first = 0;
		}
	}
	show_setting('', 'submitname', 'new_step', 'submit');
	show_setting('end');
	show_footer();
}
//设置html内容样式
function show_setting($setname, $varname = '', $value = '', $type = 'text|password|checkbox', $error = '') {
	if($setname == 'start') {
		echo "<form method=\"post\" action=\"index.php\">\n";
		return;
	} elseif($setname == 'end') {
		echo "\n</table>\n</form>\n";
		return;
	} elseif($setname == 'hidden') {
		echo "<input type=\"hidden\" name=\"$varname\" value=\"$value\">\n";
		return;
	}

	echo "\n".'<tr><th class="tbopt'.($error ? ' red' : '').'">&nbsp;'.(empty($setname) ? '' : lang($setname).':')."</th>\n<td>";
	if($type == 'text' || $type == 'password') {
		$value = htmlspecialchars($value);
		echo "<input type=\"$type\" name=\"$varname\" value=\"$value\" size=\"35\" class=\"txt\">";
	} elseif($type == 'submit') {
		$value = empty($value) ? 'next_step' : $value;
		echo "<input type=\"submit\" name=\"$varname\" value=\"".lang($value)."\" class=\"btn\">\n";
	} elseif($type == 'checkbox') {
		if(!is_array($varname) && !is_array($value)) {
			echo'<label><input type="checkbox" name="'.$varname.'" value="'.$value."\" style=\"border: 0\">".lang($setname.'_check_label')."</label>\n";
		}
	} else {
		echo $value;
	}

	echo "</td>\n<td>&nbsp;";
	if($error) {
		$comment = '<span class="red">'.(is_string($error) ? lang($error) : lang($setname.'_error')).'</span>';
	} else {
		$comment = lang($setname.'_comment', false);
	}
	echo "$comment</td>\n</tr>\n";
	return true;
}

function show_tips($tip, $title = '', $comment = '', $style = 1) {
	global $lang;
	$title = empty($title) ? lang($tip) : $title;
	$comment = empty($comment) ? lang($tip.'_comment', FALSE) : $comment;
	if($style) {
		echo "<div class=\"desc\"><b>$title</b>";
	} else {
		echo "</div><div class=\"main\">$title<div class=\"desc1 marginbot\"><ul>";
	}
	$comment && print('<br>'.$comment);
	echo "</div>";
}
//检查数据库
function check_db($dbhost, $dbuser, $dbpw, $dbname, $tablepre, $dbport) {
	if(!function_exists('mysql_connect')) {
		show_msg('undefine_func', 'mysql_connect', 0);
	}
	if(!@mysql_connect($dbhost.":".$dbport, $dbuser, $dbpw)) {
		$errno = mysql_errno();
		$error = mysql_error();
		if($errno == 1045) {
			show_msg('database_errno_1045', $error, 0);
		} elseif($errno == 2003) {
			show_msg('database_errno_2003', $error, 0);
		} else {
			show_msg('database_connect_error', $error, 0);
		}
	} else {
		if($query = mysql_query("SHOW TABLES FROM $dbname")) {
			while($row = mysql_fetch_row($query)) {
				if(preg_match("/^$tablepre/", $row[0])) {
					return false;
				}
			}
		}
	}
	return true;
}
//写入config文件
function config_edit() {
	extract($GLOBALS, EXTR_SKIP);
	$config = '../data/conf/db.php';
	$configfile = include($config);
	$configfile['DB_TYPE']='mysql';
	$configfile['DB_HOST']=$dbhost;
	$configfile['DB_NAME']=$dbname;
	$configfile['DB_USER']=$dbuser;
	$configfile['DB_PWD' ]=$dbpw;
	$configfile['DB_PORT']=$dbport;
	$configfile['DB_PREFIX']=$tablepre;
				
	if (phpversion() > 5.0){
		@file_put_contents($config, "<?php\nreturn ".var_export($configfile,true).";\n?>");
	}
	$status=1;$msg='';
	return array('status'=>$status,'msg'=>$msg);
}
//执行sql
function runquery($sql) {
	global $lang, $tablepre, $db;

	if(!isset($sql) || empty($sql)) return;

	$sql = str_replace("\r", "\n", str_replace('tp_', $tablepre, $sql));
	$ret = array();
	$num = 0;
	foreach(explode(";\n", trim($sql)) as $query) {
		$ret[$num] = '';
		$queries = explode("\n", trim($query));
		foreach($queries as $query) {
			$ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
		}
		$num++;
	}
	unset($sql);

	foreach($ret as $query) {
		$query = trim($query);
		if($query) {
			if(substr($query, 0, 12) == 'CREATE TABLE') {
				$line = explode('`',$query);
				$data_name = $line[1];
				showjsmessage(lang('create_table').' '.$data_name.' ... '.lang('succeed'));
				$db->query(droptable($data_name));
				/**
				 * 转码
				 */
				if (strtoupper(DBCHARSET) == 'GBK'){
					$query = iconv('GBK','UTF-8',$query);
				}
				$db->query(createtable($query));
				unset($line,$data_name);
			} else {
				$db->query($query);
			}
		}
	}
}
//抛出JS信息
function showjsmessage($message) {
	echo '<script type="text/javascript">showmessage(\''.addslashes($message).' \');</script>'."\r\n";
	flush();
	ob_flush();
}

function droptable($table_name){
	return "DROP TABLE IF EXISTS `". $table_name ."`;";
}

function createtable($sql) {
	preg_match("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*COMMENT=(.*)$/isU", $sql,$match);
	list(,,$type,$comment) = $match;
	$type = in_array($type, array('MYISAM', 'HEAP')) ? $type : 'MYISAM';
	return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $sql).
	(mysql_get_server_info() > '4.1' ? " ENGINE=$type DEFAULT CHARSET=".DBCHARSET : " TYPE=$type");
}

//---------------------方法集 end
//---------------------数据库操作类
class dbstuff {
	var $querynum = 0;
	var $link;
	var $histories;
	var $time;
	var $tablepre;

	function connect($dbhost, $dbuser, $dbpw, $dbname = '', $dbcharset, $pconnect = 0, $tablepre='', $time = 0) {
		$this->time = $time;
		$this->tablepre = $tablepre;
		if($pconnect) {
			if(!$this->link = mysql_pconnect($dbhost, $dbuser, $dbpw)) {
				$this->halt('Can not connect to MySQL server');
			}
		} else {
			if(!$this->link = mysql_connect($dbhost, $dbuser, $dbpw, 1)) {
				$this->halt('Can not connect to MySQL server');
			}
		}

		if($this->version() > '4.1') {
			if($dbcharset) {
				mysql_query("SET character_set_connection=".$dbcharset.", character_set_results=".$dbcharset.", character_set_client=binary", $this->link);
			}

			if($this->version() > '5.0.1') {
				mysql_query("SET sql_mode=''", $this->link);
			}
		}

		if($dbname) {
			mysql_select_db($dbname, $this->link);
		}

	}

	function fetch_array($query, $result_type = MYSQL_ASSOC) {
		return mysql_fetch_array($query, $result_type);
	}

	function result_first($sql, &$data) {
		$query = $this->query($sql);
		$data = $this->result($query, 0);
	}

	function fetch_first($sql, &$arr) {
		$query = $this->query($sql);
		$arr = $this->fetch_array($query);
	}

	function fetch_all($sql, &$arr) {
		$query = $this->query($sql);
		while($data = $this->fetch_array($query)) {
			$arr[] = $data;
		}
	}

	function query($sql, $type = '', $cachetime = FALSE) {
		$func = $type == 'UNBUFFERED' && @function_exists('mysql_unbuffered_query') ? 'mysql_unbuffered_query' : 'mysql_query';
		if(!($query = $func($sql, $this->link)) && $type != 'SILENT') {
			$this->halt('MySQL Query Error', $sql);
		}
		$this->querynum++;
		$this->histories[] = $sql;
		return $query;
	}

	function affected_rows() {
		return mysql_affected_rows($this->link);
	}

	function error() {
		return (($this->link) ? mysql_error($this->link) : mysql_error());
	}

	function errno() {
		return intval(($this->link) ? mysql_errno($this->link) : mysql_errno());
	}

	function result($query, $row) {
		$query = @mysql_result($query, $row);
		return $query;
	}

	function num_rows($query) {
		$query = mysql_num_rows($query);
		return $query;
	}

	function num_fields($query) {
		return mysql_num_fields($query);
	}

	function free_result($query) {
		return mysql_free_result($query);
	}

	function insert_id() {
		return ($id = mysql_insert_id($this->link)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}

	function fetch_row($query) {
		$query = mysql_fetch_row($query);
		return $query;
	}

	function fetch_fields($query) {
		return mysql_fetch_field($query);
	}

	function version() {
		return mysql_get_server_info($this->link);
	}

	function close() {
		return mysql_close($this->link);
	}

	function halt($message = '', $sql = '') {
		//		echo mysql_error();echo "<br />";
	}
}
//----------------------数据库操作类 end
?>