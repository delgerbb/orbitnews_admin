<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . "/mongoliax_admin/cfg_mglx_admin.php");

$page_type = "form_tools";
$request_page = "";
if (isset($_REQUEST['page'])) {
    $request_page = $_REQUEST['page'];
}

if ($request_page == "user_logout") {
    if (isset($_COOKIE[$app_config['user_cookie_name']])) {
        //unset($_COOKIE[$app_config['user_cookie_name']]);
        setcookie($app_config['user_cookie_name'], '', time() - 3600, "/", "", FALSE, TRUE); // empty value and old timestamp
        //setcookie($app_config['user_cookie_name'], '', time() - 3600); // empty value and old timestamp
    }

    if (isset($_COOKIE[$app_config['user_cookie_details']])) {
        //unset($_COOKIE[$app_config['user_cookie_details']]);
        setcookie($app_config['user_cookie_details'], '', time() - 3600, "/", "", FALSE, TRUE); // empty value and old timestamp
        //setcookie($app_config['user_cookie_details'], '', time() - 3600); // empty value and old timestamp
    }

    if (isset($_COOKIE[$app_config['user_cookie_access_codes']])) {
        //unset($_COOKIE[$app_config['user_cookie_details']]);
        setcookie($app_config['user_cookie_access_codes'], '', time() - 3600, "/", "", FALSE, TRUE); // empty value and old timestamp
        //setcookie($app_config['user_cookie_details'], '', time() - 3600); // empty value and old timestamp
    }

    if (isset($_COOKIE[$app_config['user_cookie_access_menus']])) {
        //unset($_COOKIE[$app_config['user_cookie_details']]);
        setcookie($app_config['user_cookie_access_menus'], '', time() - 3600, "/", "", FALSE, TRUE); // empty value and old timestamp
        //setcookie($app_config['user_cookie_details'], '', time() - 3600); // empty value and old timestamp
    }

    if (isset($_COOKIE[$app_config['cookie_system_lang']])) {
        //unset($_COOKIE[$app_config['user_cookie_details']]);
        setcookie($app_config['cookie_system_lang'], '', time() - 3600, "/", "", FALSE, TRUE); // empty value and old timestamp
        //setcookie($app_config['user_cookie_details'], '', time() - 3600); // empty value and old timestamp
    }

    $page = WEBROOT;
    header("Refresh: 0; url=$page");
} else {
    if (isset($_COOKIE[$app_config['user_cookie_details']])) {
        $app_config['user_cookie_details_array'] = explode($app_config['splitter_access_codes'], $_COOKIE[$app_config['user_cookie_details']], -1);
    }
}

//$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
//echo("domain: " . $domain);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include (SEC_ROOT . 'sec_header.php');
        ?>
    </head>

    <body>

        <div id="wrapper">
            <div id="main-container">
                <?php
                if (isset($_COOKIE[$app_config['user_cookie_name']])):
                    ?>
                    <?php
                    include (SEC_ROOT . 'sec_top_menu.php');
                    ?>

                    <?php
                    include (SEC_ROOT . 'sec_side_menu.php');
                    ?>

                    <!-- BEGIN MAIN PAGE CONTENT -->
                    <div id="page-wrapper">

                        <?php
                        include (SEC_ROOT . 'sec_content_heading.php');
                        ?>

                        <?php
                        switch ($request_page) {
                            case "news_menus":
                                include (PGS_ROOT . 'content_news_menus.php');
                                break;
                            case "new_news":
                                include (PGS_ROOT . 'content_news_new_add.php');
                                break;
                            case "list_news":
                                include (PGS_ROOT . 'content_news_view_list.php');
                                break;
                            case "view_system_user_profile":
                                include (PGS_ROOT . 'user_view_system_user_profile.php');
                                break;
                            case "add_system_user":
                                include (PGS_ROOT . 'user_add_system_user.php');
                                break;
                            case "manager_news":
                                include (PGS_ROOT . 'content_news_status_view.php');
                                break;
                            case "manager_company":
                                include (PGS_ROOT . 'content_company_news_status.php');
                                break;
                            case "new_collection":
                                include (PGS_ROOT . 'content_model_new_collection.php');
                                break;
                            case "new_manager":
                                include (PGS_ROOT . 'content_foreign_new_manager.php');
                                break;
                            case "user_logout":
                                include (PGS_ROOT . 'user_logout.php');
                                break;								
                            default:
                                //include (PGS_ROOT . 'pages/content.body.php');
                                include (PGS_ROOT . 'home_page.php');
                                break;
                        }
                        ?>

                        <?php
                        include (SEC_ROOT . 'sec_footer_section.php');
                        ?>

                        <?php
                    else:
                        ?>

                        <?php
                        include (PGS_ROOT . 'user_login.php');
                        ?>

                    <?php
                    endif;
                    ?>

                </div><!-- /#page-wrapper -->	  
                <!-- END MAIN PAGE CONTENT -->
            </div>  
        </div>

        <?php
        if (isset($_COOKIE[$app_config['user_cookie_name']])) {
            include (SEC_ROOT . 'sec_footer_chat.php');
        }
        include (SEC_ROOT . 'sec_footer_script.php');
        ?>
    </body>
</html>