<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define("DOCROOT", $_SERVER['DOCUMENT_ROOT'], true);
define("APP_ROOT", DOCROOT . "/mongoliax_admin/", true);
define("WEBROOT", "http://localhost:9090/mongoliax_admin/", true);
define("CLIENTWEBROOT", "//mongoliax.mn/", true);
define("SEC_ROOT", APP_ROOT . "sections/", true);
define("INC_ROOT", APP_ROOT . "includes/", true);
define("PGS_ROOT", APP_ROOT . "pages/", true);

include(INC_ROOT . "class.MySQLDB.php");
include(INC_ROOT . "class.cp.admin.php");
include(INC_ROOT . "class.cp.html.php");
include(INC_ROOT . "class.cp.tools.php");
include(INC_ROOT . "class.upload.big.php");
include(INC_ROOT . "class.bcrypt.php");
include(INC_ROOT . "class.cp.security.php");
include(INC_ROOT . "htmlpurifier/HTMLPurifier.standalone.php");

$cpAdmin = new mongoliax\includes\cp_admin\cp_admin();
$cpHTML = new mongoliax\includes\cp_HTML\cp_HTML();
$cpSecret = new mongoliax\includes\cp_Security\cpSecurity();
//$uploadBIG = new upload_big();
$tls = new mongoliax\includes\tools\tools();
$purifier = new HTMLPurifier();

//$reg_countries = array("mn" => "Монгол", "en" => "English");
$reg_countries = array("mn" => "Монгол", "en" => "English");
//$reg_lang = array("mn", "en");
$reg_lang = array("mn", "en");

$live_lang = $reg_lang;
/*
  720 x 320
  520 x 400
  390 x 300
  480 x 285
  300 x 150
 */
$smallest_S = 300;
$smallest_X = 390;
$smaller_X = 480;
$small_X = 520;
$large_X = 720;

$app_config = array();

$app_config['menus_for_permissions'] = array(
    'news_menu_manager' => 'news|?page=news_menus|мэдээний цэсүүд',
    'new_news_creator' => 'news|?page=new_news|шинэ мэдээ нэмэх',
    'daily_news_manager' => 'news|?page=manager_news|мэдээнүүдийн хяналт',
    'old_news_editor' => 'news|?page=list_news|өмнөх мэдээнүүд',
    'system_user_creator' => 'system|?page=add_system_user|хэрэглэгч нэмэх',
    'system_users_viewer' => 'system|?page=view_system_user_profile|хэрэглэгчид',
    'sys_ESM_856942' => 'system|?page=edit_side_menu|цэс засах'
);

$app_config['upload_year_month_day'] = date("Y_m_d");
$app_config['upload_path_year_month'] = date("Y_m");
$app_config['system_default_lang'] = "mn";
$app_config['current_web_app_lang'] = $app_config['system_default_lang'];
$app_config['web_active_langues'] = array("mn", "en", "ru");

$app_config['media_root_path'] = "http://mongoliax.mn/";
$app_config['server_media_root_path'] = DOCROOT;

$app_config['default_resizes_image'] = array($smallest_S, $smallest_X, $smaller_X, $small_X, $large_X);
$app_config['homepage_image_resizes'] = array(320, 480, 768, 1024);
$app_config['model_resizes_image'] = array($large_X);
$app_config['mglx_seven_image_sizes'] = array(
    array('width' => 720, 'height' => 320, 'fontSize' => 0), //3
    array('width' => 520, 'height' => 400, 'fontSize' => 0), //3
    array('width' => 480, 'height' => 285, 'fontSize' => 0), //3
    array('width' => 390, 'height' => 300, 'fontSize' => 0), //2
    array('width' => 300, 'height' => 150, 'fontSize' => 0),
    array('width' => 200, 'height' => 150, 'fontSize' => 0),
    array('width' => 70, 'height' => 70, 'fontSize' => 0)
);
/*
  720px----320px
  520px----400px
  480px----285px
  390px----300px
  300px----150px
  200px----150px
  70px ----70px
 */

/* * ----------- MongoliaX Config -----------* */
$app_config['mglx_min_news_code'] = 10030;
$app_config['mglx_min_comm_code'] = 10000000;
$app_config['mglx_post_img_upload_path'] = "mongoliax.mn/uploads/news/pictures/";
$app_config['mglx_post_img_url_path'] = "uploads/news/pictures/";


$app_config['collection_cover_resizes_image'] = array("large" => 700, "medium" => 300, "small" => 200, "xlarge" => 1000, "xsmall" => 140, "xxlarge" => 1300, "xxxlarge" => 1800);

$app_config['server_css_path'] = "assets/css/";
$app_config['server_js_path'] = "assets/js/";
$app_config['server_images_path'] = "assets/images/";

$app_config['splitter_access_codes'] = "|"; //unable to change when records are saved in database. 

/* * *** Admin cookies configs **** */
$app_config['admin_cookie_expire_time'] = 1800;
$app_config['user_cookie_expire_time'] = 1800;
$app_config['user_cookie_name'] = "oucn_745936";
$app_config['user_cookie_details'] = "oucd_263154";
$app_config['user_cookie_access_codes'] = "ouac_649562";
$app_config['user_cookie_access_menus'] = "ouam_845962";
$app_config['user_cookie_officer_code'] = "ouam_895674";
$app_config['user_cookie_details_array'] = NULL;

$app_config['cookie_system_lang'] = "csl_456978";


/* * *** Product configs **** */
//PIC_PRO_2015_04_30_1430365105_910695.jpg
$app_config['product_image_prefix'] = "PIC_PRO";
$app_config['product_min_code_num'] = 10000000;
$app_config['product_img_upload_path'] = "uploads/product/pictures/";
$app_config['product_image_min_code_num'] = 20000000;
$app_config['product_link_slug_ext'] = "ps";
$app_config['product_collection_cover_upload_path'] = "uploads/product/pictures/";


/* * *** Model configs **** */
//PIC_MOD_2015_04_30_1430365105_910695.jpg
$app_config['model_image_prefix'] = "PIC_MOD";
$app_config['model_min_code_num'] = 101000;
$app_config['model_img_upload_path'] = "uploads/model/pictures/";

/* * ----------- Product configs -----------* */
$app_config['product_menu_min_code_num'] = 5000;


/* * ----------- Catalogs configs -----------* */
//catalog code starts from 20000
//PIC_CATA_2015_04_30_1430365105_910695.jpg
$app_config['catalog_min_code_num'] = 20000;
$app_config['catalog_image_prefix'] = "PIC_CATA";
$app_config['catalog_cover_image_prefix'] = "PIC_CVR_CATA";
$app_config['catalog_img_upload_path'] = "uploads/lookbook_catalog_tv_journal/catalog/pictures/";


/* * ----------- Lookbooks configs -----------* */
//lookbook code starts from 40000
//PIC_LOBO_2015_04_30_1430365105_910695.jpg
$app_config['lookbook_min_code_num'] = 40000;
$app_config['lookbook_image_prefix'] = "PIC_LOBO";
$app_config['lookbook_cover_image_prefix'] = "PIC_CVR_LOBO";
$app_config['lookbook_img_upload_path'] = "uploads/lookbook_catalog_tv_journal/lookbook/pictures/";

/* * ----------- Magazines configs -----------* */
//lookbook code starts from 40000
//PIC_MAZI_2015_04_30_1430365105_910695.jpg
$app_config['magazine_min_code_num'] = 3100;
$app_config['magazine_image_prefix'] = "PIC_MAZI";
$app_config['magazine_cover_image_prefix'] = "PIC_CVR_MAZI";
$app_config['magazine_img_upload_path'] = "uploads/lookbook_catalog_tv_journal/magazine/pictures/";

/* * ----------- Homepage configs -----------* */
$app_config['homepage_img_upload_path'] = "uploads/homepage/pictures/";

/* * ----------- Company configs -----------* */
//Company code starts from 7000
//PIC_COMP_2015_04_30_1430365105_910695.jpg
$app_config['company_min_code_num'] = 7000;
$app_config['company_min_news_code'] = 13000;
$app_config['company_image_prefix'] = "PIC_COMP";
$app_config['company_cover_image_prefix'] = "PIC_CVR_COMP";
$app_config['company_img_upload_path'] = "uploads/company/pictures/";


/* * ----------- News configs -----------* */
//News menu code starts from 500
//PIC_NEWS_2015_04_30_1430365105_910695.jpg
$app_config['news_menu_min_code'] = 500;
$app_config['news_min_news_code'] = 1000;
$app_config['news_image_prefix'] = "PIC_NEWS";
$app_config['news_cover_image_prefix'] = "PIC_CVR_NEWS";
$app_config['news_img_upload_path'] = "uploads/news/pictures/";



/* * ----------- Collection -----------* */
$app_config['min_news_coll_code'] = 600;


/* * ----------- Human Resources configs -----------* */
$app_config['reg_job_min_code'] = 3000;

/* * ----------- Product notify configs -----------* */
$app_config['pro_notify_min_code'] = 4100;

/* * ----------- Model size configs -----------* */
$app_config['model_size_min_code'] = 3500;


/* * ----------- Store configs -----------* */
$app_config['store_min_code'] = 2200;


/* * ----------- Foreign manager configs -----------* */
$app_config['forman_min_code'] = 4000;

/* * ----------- Foreign manager configs -----------* */
$app_config['mglx_category_min_code'] = 8000;


if (!isset($_COOKIE[$app_config['cookie_system_lang']])) {
    //$cpSecret->checkControlPanelLanguage($app_config['system_default_lang']);
    //$app_config['current_web_app_lang'] = $_COOKIE[$app_config['cookie_system_lang']];
    $app_config['current_web_app_lang'] = $app_config['system_default_lang'];
} else {
    $app_config['current_web_app_lang'] = $_COOKIE[$app_config['cookie_system_lang']];
}

//if (!isset($_COOKIE[$app_config['cookie_system_lang']])) {
//$app_config['current_web_app_lang'] = "mn";
//}

$include_lang_path = APP_ROOT . "lang/sys_lang_" . $app_config['current_web_app_lang'] . ".php";

if (file_exists($include_lang_path)) {
    include($include_lang_path);
} else {
    $app_config['current_web_app_lang'] = $app_config['system_default_lang'];
    $include_lang_path = APP_ROOT . "lang/sys_lang_" . $app_config['system_default_lang'] . ".php";
    include($include_lang_path);
}

$cpAdmin->reg_lang = $reg_lang;
$cpAdmin->reg_countries = $reg_countries;

$cpAdmin->App_Config = $app_config;
$cpSecret->App_Config = $app_config;
$cpHTML->App_Config = $app_config;
$cpHTML->reg_countries = $reg_countries;
$cpHTML->sys_trans_lang = $sys_trans_lang;

/* ----page acccess codes
  old_news_editor -
  new_news_creator -
  news_menu_manager -
 */
?>