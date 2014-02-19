<?php
/**
 * A Simple Example.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-11-17 
 * @version $Id: curl.lib.php 2 2013-06-05 10:21:56Z manling $
 */

class Curl {
	private $_ch;
	private $_header;
	private $_body;
	
	private $_cookie = array();  
    private $_options = array();  
    private $_url = array ();  
    private $_referer = array ();
	
	public function __construct() {
		$this->_ch = curl_init();
		
		curl_setopt($this->_ch, CURLOPT_HEADER, true);  
        curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, true);  
        //curl_setopt($this->_ch, CURLOPT_FRESH_CONNECT, true); 
	}
	
	public function setOption($optArray=array()) {
		foreach($optArray as $opt) {
			curl_setopt($this->_ch, $opt['key'], $opt['value']);
		} 
	}
	
	public function close() {
		if (is_resource($this->_ch)) {  
            curl_close($this->_ch);  
        }
        
        return true;
	}
	
	public function httpGet($url, $referer, $query=array()) {
          
        if (!empty($query)) {  
            $url .= (strpos($url, '?') === false) ? '?' : '&';  
            $url .= is_array($query) ? http_build_query($query) : $query;  
        }  
          
        curl_setopt($this->_ch, CURLOPT_URL, $url);
        curl_setopt($this->_ch, CURLOPT_REFERER, $referer);
        curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->_ch, CURLOPT_HEADER, 0);

        $ret = $this->_execute();
        $this->close();
        return $ret;  
	}
	
	public function httpPost($url, $referer, $query=array()) {
  		if (is_array($query)) {
            foreach ($query as $key => $val) {  
				$encode_key = urlencode($key);  
				if ($encode_key != $key) {  
					unset($query[$key]);  
				}  
				
				$query[$encode_key] = urlencode($val);  
            }  
        }

        curl_setopt($this->_ch, CURLOPT_URL, $url);
        curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->_ch, CURLOPT_HEADER, 0);
        curl_setopt($this->_ch, CURLOPT_POST, true );
        curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $query);
        curl_setopt($this->_ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($this->_ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($this->_ch, CURLOPT_REFERER, $referer);

          
        $ret = $this->_execute();echo $ret;
        $this->close();
        return $ret;  
	}
	
	public function put($url, $referer, $query = array()) {  
		curl_setopt($this->_ch, CURLOPT_CUSTOMREQUEST, 'PUT');  
	
		return $this->httpPost($url, $referer, $query);  
	}  

	public function delete($url, $referer, $query = array()) {  
		curl_setopt($this->_ch, CURLOPT_CUSTOMREQUEST, 'DELETE');  
	
		return $this->httpPost($url, $referer, $query); 
	}  

	public function head($url, $referer, $query = array()) {  
		curl_setopt($this->_ch, CURLOPT_CUSTOMREQUEST, 'HEAD');
		
		return $this->httpPost($url, $referer, $query);   
	}  
	
	public function _execute() {
		$response = curl_exec($this->_ch);  

		$errno = curl_errno($this->_ch);  
		  
		if ($errno > 0) {
			throw new Exception(curl_error($this->_ch), $errno);  
		}

//		$header_size = curl_getinfo($this->_ch, CURLINFO_HEADER_SIZE);
//      $this->_body = $this->_header = substr ( $response, 0, $header_size );
//		$this->_body = substr ( $response, $header_size );

		return  $response;
	}
}

?>