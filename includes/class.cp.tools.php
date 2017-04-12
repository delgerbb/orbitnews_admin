<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class
 *
 * @author delgerbayar
 */

namespace mongoliax\includes\tools;

class tools {

    public function __construct() {
        
    }

    //put your code here
    public function hello() {
        return "i am from tools";
    }

    public function getLocationPhotoName($uploadFile_extension) {
        $PictureRandom = substr(md5(RAND(1000, 9999900)), 0, 15) . substr(md5(RAND(100, 1000000)), 0, 5);
        $newLocalImgName = "LP_" . $PictureRandom . "." . $uploadFile_extension;
        return $newLocalImgName;
    }

    public function getProductPhotoName($uploadFile_extension) {
        $PictureRandom = substr(md5(RAND(1000, 9999900)), 0, 15) . substr(md5(RAND(100, 1000000)), 0, 5);
        $newProImgName = "IP_" . $PictureRandom . "." . $uploadFile_extension;
        return $newProImgName;
    }

    public function getProductCode($leng3Times) {
        $genCode = substr(md5(RAND(101, 1000000)), 0, $leng3Times) . substr(md5(RAND(101, 1000000)), 0, $leng3Times) . substr(md5(RAND(101, 1000000)), 0, $leng3Times);
        return $genCode;
    }

    public function cn_htmltrans($string, $type = "text") {
        $trans = get_html_translation_table(HTML_ENTITIES);

        if ($type == "text") {
            $string = addslashes($string);
            return strtr($string, $trans);
        } else {
            $trans = array_flip($trans);
            $string = stripslashes($string);
            return strtr($string, $trans);
        }
    }

    public function date_formatter($unFormattedDate, $formatPattern) {
        $formatedData = (new DateTime($unFormattedDate))->format('Y.m.d');
        return $formatedData;
    }

}
