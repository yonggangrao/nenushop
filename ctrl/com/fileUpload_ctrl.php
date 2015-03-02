<?php 
	require_once 'header_ctrl.php';
	require_once '../../lib/wideimage/WideImage.php';
?>

<?php
	switch ($action)
	{
		case 'upload':
			
			$img = get_file('file');
			$old_name=$img['name'];
			$tmp_name=$img['tmp_name'];
			$size=$img['size'];
			$type=$img['type'];
			$new_name=time() . substr($old_name, strpos($old_name, '.'));
			
			$user_id = get_session('user_id');
			$folder = '/user_img/' . $user_id . '/';
			$path = get_server('DOCUMENT_ROOT') . $folder;
			$filename = $folder . $new_name;
			
			$fullpath = $path . $new_name;
			chmod($fullpath, 0777);
			if(!is_dir($path))
			{
				mkdir($path);
				chmod($path, 0777);
			}
			
			$size = round($size/1024,2); //转换成kb
			
			if(!check_img_format($type))
			{
				$data['error'] = 'error_img_format';
			}
			else
			{
				$res = move_uploaded_file($tmp_name, iconv('utf-8', 'gb2312', $fullpath));
				//压缩图片
				if($size > 512)
				{
					//$data['error'] = 'error_img_size';
					WideImage::load($fullpath)->resize(512, 512)->saveToFile($fullpath);

				}
				if($res)
				{
					$ret = CONSTVAR::SUCCESS;
				}
				else
				{
					$ret = CONSTVAR::ERROR;
				}
				$data = array(
						//'old_name'=>$old_name,
						'fullname'=>$folder . $new_name,
						//'size'=>$size,
						//'newname'=>$new_name,
						'ret'=>$ret,
				);
			}
			
			break;
			
		case 'delete':
			
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				break;
			}
			
			$data['ctrl_action']= 'goods/create/create';
			$fullname = get_response('fullname');
			if(!empty($fullname))
			{
				$full_path =get_server('DOCUMENT_ROOT') . $fullname;
				$res = unlink($full_path);
				if($res)
				{
					$data['ret'] = CONSTVAR::SUCCESS;
				}
				else
				{
					$data['ret'] = CONSTVAR::ERROR;
				}
			}
			else
			{
				$data['ret'] = CONSTVAR::ERROR;
			}
			
			break;
			
		default:
			$data['ret'] = CONSTVAR::ERROR;
	}	
?>		
<?php
	require_once 'footer_ctrl.php';
?>