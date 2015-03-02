<?php

class UTIL
{
}

function get_param_error_msg($msg)
{
	$msg .= ': ' . __CLASS__;
	$msg .= '::' . __METHOD__;
	return $msg;
}


function redirect($url)
{
	header('Location: ' . $url);
	exit();
}


function get_file($filename)
{
	return $_FILES[$filename];
}

function sphinx($keyword)
{
	$sph = new SphinxClient();
	$sph->SetServer('localhost',9312);    //连接9312端口
	$sph->SetMatchMode(SPH_MATCH_ANY);    //设置匹配方式
	$sph->SetSortMode(SPH_SORT_RELEVANCE);    //查询结果根据相似度排序
	$sph->SetArrayResult(true);                //设置结果返回格式,true以数组,false以PHP hash格式返回，默认为false
	$result = $sph->query($keyword, 'mysql');//执行搜索操作,参数(关键词，索引名)
	
	return $result;
}


function get_data($folder, $file, $data)
{
	$host = get_server('HTTP_HOST');
	$ctrl = $folder;
	$action = $file . '_ctrl.php';

	$url = $host . '/ctrl/' . $ctrl . '/' . $action;
	$ret = curl_post($url, $data);
	$opt_data = json_decode($ret,'true');
	
	return $opt_data;
}


function get_folder_file(&$URI, &$folder, &$file)
{
	$filename = substr(get_server('PHP_SELF'), 1);
	$tmp = explode('/', $filename);
	$folder = $tmp[1];
	$tmp2 = explode('.', $tmp[2]);
	$file = $tmp2[0];
	$URI = '/' . $folder . '/' . $file;
}



function include_icon()
{
	echo '<link rel="shortcut icon" href="../../img/favicon.ico" />';
}

function include_header_js($folder, $file)
{
	$header_js = header_js();
	$count = count($header_js);
	for($i=0;$i<$count;$i++)
	{
		echo '<script src="../../js/com/' . $header_js[$i] .'"></script>';
	}
	echo '<script src="../../js/mdl/js_model.js"></script>';
	$js_file = '../../js/' . $folder . '/' . $file . '.js';
	if(file_exists($js_file))
	{
		echo '<script src="' . $js_file . '"></script>';
	}
}

function include_footer_js($folder, $file)
{
	$footer_js = footer_js();
	$count = count($footer_js);
	for($i=0;$i<$count;$i++)
	{
		echo '<script src="../../js/com/' . $footer_js[$i] .'"></script>';
	}
}



function include_header_css($folder, $file)
{
	$header_css = header_css();
	$count = count($header_css);
	for($i=0;$i<$count;$i++)
	{
		echo '<link rel="stylesheet" type="text/css" href="../../css/com/'. $header_css[$i] . '">';
	}
	$css_file = '../../css/' . $folder . '/' . $file . '.css';
	if(file_exists($css_file))
	{
		echo '<link rel="stylesheet" type="text/css" href="'.$css_file .'">';
	}
}



function check_img_format($format)
{
	$img_format = img_format();
	if(empty($img_format[$format]))
	{
		return false;
	}
	return true;
}

function hosts_config($database)
{
	$host_ip = get_server('SERVER_ADDR');
	if($host_ip == '127.0.0.1')
	{
		return array(
				'host'=>'localhost',
				'database'=>$database,
				'user'=>'rao',
				'password'=>'raoyg980',
					
		);
	}
	else
	{
		$database = 'A970321_' . $database;
		$user_name = 'A970321_' . 'rao';
		$password = $user_name;
		return array(
				'host'=>'mysql1215.ixwebhosting.com',
				'database'=>$database,
				'user'=>$user_name,
				'password'=>$password,
					
		);
	}
}


function manage_page_is_login($is_login, $URI)
{
	$login_page = login_page();
	if(!empty($login_page[$URI]) && empty($is_login))
	{
		return false;
	}
	return true;
}


function logout()
{
	session_destroy();
}

function is_login()
{
	$user_id = get_session('user_id');
	if(empty($user_id))
	{
		return false;
	}
	return true;
}


function unique_id()
{
	$ip = get_server('REMOTE_ADDR');
	return md5(uniqid() . $ip);
}

function curl_post($url,$data)
{
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	//curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	$ret = curl_exec ( $ch );
	curl_close ( $ch );
	
	return $ret;
}

// 还原文本中的空格、tab和换行符
function show_blank_enter($s)
{
	$s=str_replace(" ","&nbsp;",$s);
	$s=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",$s);
	$s=str_replace("\n","<br/>",$s);
	return $s;
}


function set_login($user_id, $email, $user_name)
{
	set_session('user_id', $user_id);
	set_session('email', $email);
	set_session('user_name', $user_name);
}

function get_session($param='')
{
	//$param = CONSTVAR::DOMAIN . ':' . $param;
	return $_SESSION[$param];
}
function set_session($key, $value)
{
	//$key = CONSTVAR::DOMAIN . ':' . $key;
	$_SESSION[$key ] = $value;
}

function del_session($param)
{
	//$key = CONSTVAR::DOMAIN . ':' . $key;
	unset($_SESSION[$param]);
}
function get_server($param='')
{
	return $_SERVER[$param];
}


function get_response($param='',$method='POST')
{
	if($method=='POST')
	{
		return $_POST[$param];
	}
	else
	{
		return $_GET[$param];
	}
}

function get_time($time)
{
	return date('Y-m-d H:i', $time);
}
?>