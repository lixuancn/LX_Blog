<?php
/**
 * 邮件发送类
 * Created by PhpStorm.
 * User: lane
 * Date: 14-9-30
 * Time: 上午10:32
 * E-mail: lixuan868686@163.com
 * WebSite: http://www.lanecn.com
 */
class Mail{
    /**
     * 获取发送邮件的对象
     * @return PhpMailerLib|SaeMailLib
     */
    public static function getObject(){
        if(strtolower(CLOUD_PLATFORM) == 'sae'){
            $mailObj = new SaeMailLib();
        }else{
            $mailObj = new PhpMailerLib();
        }
        return $mailObj;
    }



    /**
     * 发送邮件 最大可发送1MB大小的邮件（含附件）
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
    public static function quickSent($to, $title, $content, $from, $fromPassword, $fromHost='', $fromPort='', $fromTls='false'){
        return self::getObject()->quickSend($to, $title, $content, $from, $fromPassword, $fromHost, $fromPort, $fromTls);
    }
}