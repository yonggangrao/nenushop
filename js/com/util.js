
function verify_desc($info, warn)
{
	if(!$info)
	{
		$confirm = confirm(warn);
		if($confirm)
		{
			return true;
		}
		return false;
	}
	return true;
}



function get_imgs()
{
	var imgs = '';
	for(var i in arr_img)
	{
		if(arr_img[i] != '')
		{
			imgs += arr_img[i] + ',';
		}
	}
	return imgs;
}


function get_max_upload_img_nu()
{
	var img_nu;
	var uri = get_uri();
	
	
	if(uri == '/goods/upload' || uri.indexOf('/goods/update') >= 0)
	{
		img_nu = 3;
	}
	else if(uri == '/shop/create' || uri.indexOf('/shop/update') >= 0)
	{
		img_nu = 1;
	}
	else
	{
		img_nu = 0;
	}

	
	return img_nu;
}



function redirect(url)
{
	window.location.href = url;
}



function get_uri()
{
	return window.location.pathname;
}


function trim(str)
{
	len = str.length;
	
	for(i=0;i<len;i++)
	{
		if(str.charAt(i)!=' ')
		{
			break;
		}
	}
	for(j=len-1;j>=0;j--)
	{
		if(str.charAt(j)!=' ')
		{
			break;
		}
	}
	if(i>j)
	{
		return '';
	}
	return str.substring(i,j+1);
}


function json_decode(data)
{
	return eval('(' + data + ')');
}


function verify_email(email)
{
	var regexp=/^[\w-]+@[\w-\.]+\.([\w-]+)$/gi;  
	
	if(!regexp.exec(email))
	{
		return false;
	}
	else
	{
		return true;
	}
}