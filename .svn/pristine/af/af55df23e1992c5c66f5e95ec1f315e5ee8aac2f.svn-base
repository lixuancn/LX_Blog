<?php
/**
 * 利用基于sae上的storage存储非代码类文件
 * 
 * @author: 李满玲 <manling@staff.sina.com.cn>
 * @date: 2011-01-24 
 * @copyright: sina
 * @version $Id: upload.lib.php 1 2013-05-30 06:40:35Z manling $
 *
 * 例子：
 * 1)
 * $upload = new Upload();
 * $srcFileName = $_FILES['file']['tmp_name'];
 * $destFileName = '/test/20110126.'.$upload->getFileExt($_FILES['file']['type']);
 * $res = $upload->upfile('all', $destFileName, $srcFileName);
 * 
 * 2)
 * $upload = new Upload();
 * $res = $upload->getList( 'all', 'test' );
 * 
 * 参考类：http://sae.sina.com.cn/?m=devcenter&catId=13
 * 其它函数可以直接通过$storage来调用
 */

class Upload {
	public $storage;
	
	public $domain = 'all';
		
	public function __construct()
	{
		$this->storage = new SaeStorage();
				   
	}
	
	public function setDomain($domain)
	{
		$this->domain = $domain;
		return $this;
	}
	
	public function upfile($domain, $destFileName, $srcFileName, $attr = array(), $compress = false)
	{
		return $this->storage->upload($domain, $destFileName, $srcFileName, $attr, $compress);
	}
	
	
 	public function getList( $domain, $prefix='*', $limit=10, $offset = 0 )
    {
    	return $this->storage->getList( $domain, $prefix, $limit, $offset );
    }
    
 	public function getListByPath( $domain, $path='*', $limit=100, $offset = 0 )
    {
    	return $this->storage->getListByPath( $domain, $path, $limit, $offset );
    }
    
 	public function getAttr( $domain, $file)
    {
    	return $this->storage->getAttr( $domain, $file);
    }
    
 	public function delete( $domain, $file)
    {
    	return $this->storage->delete( $domain, $file);
    }
	
	public function getFileExt($file_type)
	{
		$file_ext_name = '';
		switch($file_type){
			case "image/jpeg": 
				$file_ext_name = "jpg"; 
				break; 
			case "image/gif": 
				$file_ext_name = "gif"; 
				break; 
			case "image/x-png": 
			case "image/png": 
				$file_ext_name = "png"; 
				break; 
			case "application/x-shockwave-flash ": 
				$file_ext_name = "swf "; 
				break; 
			case "text/plain": 
				$file_ext_name = "txt"; 
				break; 
			case "application/msword": 
				$file_ext_name = "doc"; 
				break; 
			case "application/x-zip-compressed": 
				$file_ext_name = "zip"; 
				break; 
			case "audio/mpeg": 
				$file_ext_name = "mp3"; 
				break;
			case "application/x-shockwave-flash": 
				$file_ext_name = "swf"; 
				break;
			default:
				$file_ext_name = "";
		}
		return $file_ext_name;	
	}
	
	
	public function errmsg() {
		return $this->storage->errmsg();
	}
	
	public function errno(){
		return $this->storage->errno();
	}
	
	public function __destruct()
	{
	}

}


?>