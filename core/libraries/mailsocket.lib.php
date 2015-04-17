<?php
/**
 * 使用PHPMailer开源插件发送邮件，必须支持Socket
 * Created by PhpStorm.
 * User: lane
 * Date: 14-9-30
 * Time: 上午10:10
 * E-mail: lixuan868686@163.com
 * WebSite: http://www.lanecn.com
 */
/**
 * 邮件发送类
 * 支持发送纯文本邮件和HTML格式的邮件
 * @example
 * $config = array(
 *       "from" => "*****",
 *       "to" => "***",
 *       "subject" => "test",
 *       "body" => "<b>test</b>",
 *       "username" => "***",
 *       "password" => "****",
 *       "isHTML" => true
 *   );
 *
 * $mail = new MySendMail();
 *
 * $mail->setServer("smtp.126.com");
 *
 * $mail->setMailInfo($config);
 * if(!$mail->sendMail()) {
 *   echo $mail->error();
 *   return 1;
 * }
 */
class MailSocket {
    /**
     * @var 邮件传输代理用户名
     * @access private
     */
    private $_userName;

    /**
     * @var 邮件传输代理密码
     * @access private
     */
    private $_password;

    /**
     * @var 邮件传输代理服务器地址
     * @access protected
     */
    protected $_sendServer;

    /**
     * @var 邮件传输代理服务器端口
     * @access protected
     */
    protected $_port=25;

    /**
     * @var 发件人
     * @access protected
     */
    protected $_from;

    /**
     * @var 收件人
     * @access protected
     */
    protected $_to;

    /**
     * @var 主题
     * @access protected
     */
    protected $_subject;

    /**
     * @var 邮件正文
     * @access protected
     */
    protected $_body;

    /**
     * @var 是否是HTML格式的邮件
     * @access protected
     */
    protected $_isHTML=false;

    /**
     * @var socket资源
     * @access protected
     */
    protected $_socket;

    /**
     * @var 错误信息
     * @access protected
     */
    protected $_errorMessage;

    public function __construct($from="", $to="", $subject="", $body="", $server="", $username="", $password="",$isHTML="", $port="") {
        if(!empty($from)){
            $this->_from = $from;
        }
        if(!empty($to)){
            $this->_to = $to;
        }
        if(!empty($subject)){
            $this->_subject = $subject;
        }
        if(!empty($body)){
            $this->_body = $body;
        }
        if(!empty($isHTML)){
            $this->_isHTML = $isHTML;
        }
        if(!empty($server)){
            $this->_sendServer = $server;
        }
        if(!empty($port)){
            $this->_port = $port;
        }
        if(!empty($username)){
            $this->_userName = $username;
        }
        if(!empty($password)){
            $this->_password = $password;
        }
    }

    /**
     * 设置邮件传输代理
     * @param string $server 代理服务器的ip或者域名
     * @param int $port 代理服务器的端口，smtp默认25号端口
     * @param int $localPort 本地端口
     * @return boolean
     */
    public function setServer($server, $port=25) {
        if(!isset($server) || empty($server) || !is_string($server)) {
            $this->_errorMessage = "first one is an invalid parameter";
            return false;
        }
        if(!is_numeric($port)){
            $this->_errorMessage = "first two is an invalid parameter";
            return false;
        }
        $this->_sendServer = $server;
        $this->_port = $port;
        return true;
    }

    /**
     * 设置邮件
     * @access public
     * @param array $config 邮件配置信息
     * 包含邮件发送人、接收人、主题、内容、邮件传输代理的验证信息
     * @return boolean
     */
    public function setMailInfo($config) {
        if(!is_array($config) || count($config) < 6){
            $this->_errorMessage = "parameters are required";
            return false;
        }

        $this->_from = $config['from'];
        $this->_to = $config['to'];
        $this->_subject = $config['subject'];
        $this->_body = $config['body'];
        $this->_userName = $config['username'];
        $this->_password = $config['password'];
        if(isset($config['isHTML'])){
            $this->_isHTML = $config['isHTML'];
        }

        return true;
    }

    /**
     * 发送邮件
     * @access public
     * @return boolean
     */
    public function sendMail() {
        $command = $this->getCommand();
        $this->socket();

        foreach ($command as $value) {
            if($this->sendCommand($value[0], $value[1])) {
                continue;
            }
            else{
                return false;
            }
        }

        $this->close(); //其实这里也没必要关闭，smtp命令：QUIT发出之后，服务器就关闭了连接，本地的socket资源会自动释放
        echo 'Mail OK!';
        return true;
    }

    /**
     * 返回错误信息
     * @return string
     */
    public function error(){
        if(!isset($this->_errorMessage)) {
            $this->_errorMessage = "";
        }
        return $this->_errorMessage;
    }

    /**
     * 返回mail命令
     * @access protected
     * @return array
     */
    protected function getCommand() {
        if($this->_isHTML) {
            $mail = "MIME-Version:1.0\r\n";
            $mail .= "Content-type:text/html;charset=utf-8\r\n";
            $mail .= "FROM:test<" . $this->_from . ">\r\n";
            $mail .= "TO:<" . $this->_to . ">\r\n";
            $mail .= "Subject:" . $this->_subject ."\r\n\r\n";
            $mail .= $this->_body . "\r\n.\r\n";
        }
        else{
            $mail = "FROM:test<" . $this->_from . ">\r\n";
            $mail .= "TO:<" . $this->_to . ">\r\n";
            $mail .= "Subject:" . $this->_subject ."\r\n\r\n";
            $mail .= $this->_body . "\r\n.\r\n";
        }
        $command = array(
            array("HELO sendmail\r\n", 250),
            array("AUTH LOGIN\r\n", 334),
            array(base64_encode($this->_userName) . "\r\n", 334),
            array(base64_encode($this->_password) . "\r\n", 235),
            array("MAIL FROM:<" . $this->_from . ">\r\n", 250),
            array("RCPT TO:<" . $this->_to . ">\r\n", 250),
            array("DATA\r\n", 354),
            array($mail, 250),
            array("QUIT\r\n", 221)
        );
        return $command;
    }

    /**
     * @access protected
     * @param string $command 发送到服务器的smtp命令
     * @param int $code 期望服务器返回的响应吗
     * @param boolean
     */
    protected function sendCommand($command, $code) {
        echo 'Send command:' . $command . ',expected code:' . $code . '<br />';
        //发送命令给服务器
        try{
            if(socket_write($this->_socket, $command, strlen($command))){
                //读取服务器返回
                $data = trim(socket_read($this->_socket, 1024));
                echo 'response:' . $data . '<br /><br />';
                if($data) {
                    $pattern = "/^".$code."/";
                    if(preg_match($pattern, $data)) {
                        return true;
                    }
                    else{
                        $this->_errorMessage = "Error:" . $data . "|**| command:";
                        return false;
                    }
                }
                else{
                    $this->_errorMessage = "Error:" . socket_strerror(socket_last_error());
                    return false;
                }
            }
            else{
                $this->_errorMessage = "Error:" . socket_strerror(socket_last_error());
                return false;
            }
        }catch(Exception $e) {
            $this->_errorMessage = "Error:" . $e->getMessage();
        }
    }

    /**
     * 建立到服务器的网络连接
     * @access private
     * @return boolean
     */
    private function socket() {
        if(!function_exists("socket_create")) {
            $this->_errorMessage = "extension php-sockets must be enabled";
            return false;
        }
        //创建socket资源
        $this->_socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));

        if(!$this->_socket) {
            $this->_errorMessage = socket_strerror(socket_last_error());
            return false;
        }

        //连接服务器
        if(!socket_connect($this->_socket, $this->_sendServer, $this->_port)) {
            $this->_errorMessage = socket_strerror(socket_last_error());
            return false;
        }
        socket_read($this->_socket, 1024);

        return true;
    }

    /**
     * 关闭socket
     * @access private
     * @return boolean
     */
    private function close() {
        if(isset($this->_socket) && is_object($this->_socket)) {
            $this->_socket->close();
            return true;
        }
        $this->_errorMessage = "no resource can to be close";
        return false;
    }
}