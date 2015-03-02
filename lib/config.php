<?php



class CONFIGURE
{
	const DOMAIN 				=		'nenushop.com';
	const SUCCESS 				= 		'success';
	const ERROR					= 		'error';
	const SHOP 					= 		'shop';
	const GOODS					= 		'goods';
	const LOGIN 				= 		'login';
	const HAS_SHOP 				= 		'has_shop';
	const PARAM_ILLEGAL 		= 		'Parameter illegal';

	const SQL_QUERY_ONE			=		'query_one';
	const SQL_QUERY_LIST		=		'query_list';
	const SQL_INSERT			=		'insert';
	const SQL_UPDATE			=		'update';
	const SQL_DELETE			=		'delete';
	
	const SUCCESS_ERRNO   		=        0;
	const PARAM_ILLEGAL_ERRNO   =        1;
	const DB_OPERATION_ERRNO   	=        2;
	const ACCIDENT_ERRNO   		=        -1;
	
	

	
	public static function HEADER_JS()
	{
		return array(
				'jquery-1.11.1.min.js',
				'config.js',
				'util.js',
				'com.js',
		);
	}
	public static function FOOTER_JS()
	{
		return array(
				'jquery.form.js',
				'jquery.md5.js',
		);
	}
	
	
	public static function HEADER_CSS()
	{
		return array(
	
				'com.css',
					
		);
	}
	
	public static function LOGIN_PAGE()
	{
		return array(
				'/goods/upload'=>'/goods/upload',
				'/goods/update'=>'/goods/update',
				'/goods/manage'=>'/goods/manage',
				'/goods/list'=>'/goods/list',
				'/shop/home'=>'/shop/home',
				'/shop/create'=>'/shop/create',
	
		);
	}
	
	
	public static function IMG_FORMAT()
	{
		return array(
				'image/jpeg'=>'image/jpeg',
				'image/jpg'=>'image/jpg',
				'image/pjpg'=>'image/pjpg',
				'image/gif'=>'image/gif',
				'image/png'=>'image/png',
				'image/x-png'=>'image/x-png',
	
		);
	}
	
}

class CONSTVAR
{
	const DOMAIN = 'nenushop.com';
	const SUCCESS = 'success';
	const ERROR = 'error';
	const SHOP = 'shop';
	const GOODS = 'goods';
	const LOGIN = 'login';
	const HAS_SHOP = 'has_shop';
	const PARAM_ILLEGAL = 'Parameter illegal';
}


function header_js()
{
	return array(

			'jquery-1.11.1.min.js',
			'config.js',
			'util.js',
			'com.js',
				
	);
}
function footer_js()
{
	return array(

			'jquery.form.js',
			'jquery.md5.js',

	);
}


function header_css()
{
	return array(
		
		'com.css',
			
	);
}

function login_page()
{
	return array(
		'/goods/upload'=>'/goods/upload',
		'/goods/update'=>'/goods/update',
		'/goods/manage'=>'/goods/manage',
		'/goods/list'=>'/goods/list',
		'/shop/home'=>'/shop/home',
		'/shop/create'=>'/shop/create',
		
	);
}

function img_format()
{
	return array(
			'image/jpeg'=>'image/jpeg',
			'image/jpg'=>'image/jpg',
			'image/pjpg'=>'image/pjpg',
			'image/gif'=>'image/gif',
			'image/png'=>'image/png',
			'image/x-png'=>'image/x-png',
	
	);
}