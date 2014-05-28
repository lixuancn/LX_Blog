<?php
/**
 * 处理一下杂事，需要URL来访问的
 *
 * Created by Lane.
 * @Class Extend
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * Blog http://www.lanecn.com
 */
class Extend {
    /**
     * @descrpition 验证码
     */
    public function captcha(){
        $width = 90;
        $height = 30;
        $total = 4;
        $font = 5;
        $str = '0123456789qazwsxedcrfvtgbyhnujmkpAZWSXEDCRFVTGBHNUJMKP';
        $im = imagecreatetruecolor($width, $height);
        //背景
        $white = imagecolorallocate($im, 255, 255, 255);
        imagefill($im, 0, 0, $white);
        //边框
        $brodeColor = imagecolorallocate($im, 95, 158, 160);
        imagerectangle($im, 0, 0, $width-1, $height-1, $brodeColor);
        //字体
        $text = '';
        $fontColor = array();
        $fontColor[] = imagecolorallocate($im, 199, 21, 133); //mediumvioletred（适中的紫罗兰红）
        $fontColor[] = imagecolorallocate($im, 128, 0, 128); //RGB(128,0,128)purple（紫）
        $fontColor[] = imagecolorallocate($im, 75, 0, 130); //RGB(75,0,130)indigo（靓青）
        $fontColor[] = imagecolorallocate($im, 65, 105, 225); //RGB(65,105,225)royalblue（皇家蓝）
        $fontColor[] = imagecolorallocate($im, 220, 20, 60); //RGB(220,20,60) crimson（腥红）
        for ($i=0; $i<$total; $i++){
            $w = 10 + ($i * 20);
            $h = rand(5, 15);
            $latter = substr($str, rand(0, strlen($str)), 1);
            $text .= $latter;
            imagestring($im, $font, $w, $h, $latter, $fontColor[array_rand($fontColor)]);
        }
        //干扰点
        $red = imagecolorallocate($im, 255, 0, 0);
        $blue = imagecolorallocate($im, 0, 0, 255);
        $black = imagecolorallocate($im, 0, 0, 0);
        for($i=0; $i<50; $i++){
            imagesetpixel($im, rand(0, $width), rand(0, $height), $blue);
            imagesetpixel($im, rand(0, $width), rand(0, $height), $black);
            imagesetpixel($im, rand(0, $width), rand(0, $height), $red);
        }
        Response::setSession('captcha', strtolower($text));
        header('Content-type: image/png');
        imagepng($im);
        imagedestroy($im);
    }
}