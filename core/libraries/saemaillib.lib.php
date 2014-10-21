<?php
/**
 * Sae的邮件发送类
 * Created by PhpStorm.
 * User: lane
 * Date: 14-9-30
 * Time: 上午10:09
 * E-mail: lixuan868686@163.com
 * WebSite: http://www.lanecn.com
 */
class SaeMailLib{
    private $saeMail;
    public function __construct(){
        $this->saeMail = new SaeMail();
    }
    /**
     * 快速发送邮件 最大可发送1MB大小的邮件（含附件）
     * 由于采用邮件队列发送,本函数返回成功时,只意味着邮件成功送到发送队列,并不等效于邮件已经成功发送. 邮件编码默认为UTF-8,如需发送其他编码的邮件,请使用setOpt()方法设置charset,否则收到的邮件标题和内容都将是空的.
     *
     * @param $to 要发送到的邮件地址,多个邮件地址之间用英文逗号","隔开，如“to@sina.cn”
     * @param $title 邮件标题，如“邮件标题”
     * @param $content 邮件内容 如“邮件内容”
     * @param $from smtp用户名，必须为邮箱地址。注：和setOpt()中的smtp_user不同。如“smtpaccount@gmail.com”
     * @param $fromPassword smtp用户密码 如“password”
     * @param string $fromHost smtp服务host,使用sina,gmail,163,265,netease,qq,sohu,yahoo的smtp时可不填
     * @param string $fromPort smtp服务端口,使用sina,gmail,163,265,netease,qq,sohu,yahoo的smtp时可不填
     * @param string $fromTls smtp服务是否开启tls(如gmail),使用sina,gmail,163,265,netease,qq,sohu,yahoo的smtp时可不填
     */
    public function quickSend($to, $title, $content, $from, $fromPassword, $fromHost='', $fromPort='', $fromTls='false'){
        return $this->saeMail->quickSend($to, $title, $content, $from, $fromPassword, $fromHost, $fromPort, $fromTls);
    }

    /**
     * 添加附件
     * 附件和邮件正文的总大小不可超过1MB。
     * @param $attachmentList 附件列表 Array key为文件名称,附件类型由文件名后缀决定,value为文件内容;文件内容支持二进制
    支持的文件后缀:bmp,css,csv,gif,htm,html,jpeg,jpg,jpe,pdf,png,rss,text,txt,asc,diff,pot,tiff,tif,wbmp,ics,vcf
     * 如：array("my_photo.jpg" => "照片的二进制数据" )
     */
    public function setAttach($attachmentList){
        $this->saeMail->setAttach($attachmentList);
    }

    /**
     * 清空$this->mail的数据，重置
     */
    public function clean(){
        $this->saeMail->clean();
    }

    /**
     * 设置发送参数,此处设置的参数只有使用send()方法发送才有效;quickSend()时将忽略此设置.
        array $options: 支持的Key如下:
        from              string (only one)
        -----------------------------------------
        to                string (多个用,分开)
        -----------------------------------------
        cc                string (多个用,分开)
        -----------------------------------------
        smtp_host         string
        -----------------------------------------
        smtp_port         port,default 25
        -----------------------------------------
        smtp_username     string
        -----------------------------------------
        smtp_password     string
        -----------------------------------------
        subject           string,最大长度256字节
        -----------------------------------------
        content           text
        -----------------------------------------
        content_type      "TEXT"|"HTML",default TEXT
        -----------------------------------------
        charset           default utf8
        -----------------------------------------
        tls               default false
        -----------------------------------------
        compress          string 设置此参数后，SaeMail会将所有附件压缩成一个zip文件，此参数用来指定压缩后的文件名。
        -----------------------------------------
        callback_url      string SMTP发送失败时的回调地址，回调方式为post，postdata格式：timestamp=时间戳&from=from地址&to=to地址（如有多个to，则以,分割）
        -----------------------------------------
     */
    public function setOpt($options){
        $this->saeMail->setOpt($options);
    }

    /**
     * 发送邮件
     */
    public function sent(){
        $this->saeMail->sent();
    }

}