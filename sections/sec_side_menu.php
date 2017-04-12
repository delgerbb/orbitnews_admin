<?php
$accessMenus = $_COOKIE[$app_config['user_cookie_access_menus']];
$accessMenus = explode($app_config['splitter_access_codes'], $accessMenus, -1);

//if (!in_array($page_code, $accessCodes)) {
//echo($sys_trans_lang['your_access_denied_on_this_page']);
//return "";
//}
?>
<nav class="navbar-side" role="navigation">							
    <div class="navbar-collapse sidebar-collapse collapse">
        <div class="media">							
            <ul class="sidebar-shortcuts">
                <li><a class="btn"><i class="fa fa-user icon-only"></i></a></li>
                <li><a class="btn"><i class="fa fa-envelope icon-only"></i></a></li>
                <li><a class="btn"><i class="fa fa-th icon-only"></i></a></li>
                <li><a class="btn"><i class="fa fa-gear icon-only"></i></a></li>
            </ul>	
        </div>
        <div class="media-search">	
            <input type="text" class="input-menu" id="input-items" placeholder="Find...">
        </div>
        <ul id="side" class="nav navbar-nav side-nav">
            <?php
            $isCookieSet = false;
            $userAccessCodes = array();
            if (isset($_COOKIE[$app_config['user_cookie_access_codes']])) {
                $userAccessCodes = explode("|", $_COOKIE[$app_config['user_cookie_access_codes']], -1);
                $isCookieSet = true;
            }
            ?>
            <li>
                <h4>Navigation</h4> 								
            </li>
            <li>
                <a class="active" href="<?= WEBROOT; ?>">
                    <i class="fa fa-dashboard"></i> <?= $sys_trans_lang['side_menu_dashboard_text']; ?>
                </a>
            </li>
            <?php if (in_array("system", $accessMenus)): ?>
                <li class="panel">
                    <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#systems">
                        <i class="fa fa-cogs"></i> <?= $sys_trans_lang['side_menu_system_text']; ?> <span class="fa arrow"></span>
                    </a>
                    <ul class="collapse nav" id="systems">
                        <?php
                        foreach ($userAccessCodes as $key1 => $value1) {
                            foreach ($app_config['menus_for_permissions'] as $key2 => $value2) {
                                $menuDetailParts = explode($app_config['splitter_access_codes'], $value2);
                                if ($value1 == $key2 && $menuDetailParts[0] == 'system') {
                                    echo("<li>
                                    <a href='" . $menuDetailParts[1] . "'>
                                        <i class='fa fa-angle-double-right'></i>" . $menuDetailParts[2] . "
                                    </a>
                                </li>");
                                }
                            }
                        }
                        ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (in_array("news", $accessMenus)): ?>
                <li class="panel">
                    <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#charts">
                        <i class="fa fa-bar-chart-o"></i> <?= $sys_trans_lang['side_menu_news_text']; ?> <span class="fa arrow"></span>
                    </a>
                    <ul class="collapse nav" id="charts">
                        <?php
                        foreach ($userAccessCodes as $key1 => $value1) {
                            foreach ($app_config['menus_for_permissions'] as $key2 => $value2) {
                                $menuDetailParts = explode($app_config['splitter_access_codes'], $value2);
                                if ($value1 == $key2 && $menuDetailParts[0] == 'news') {
                                    echo("<li>
                                    <a href='" . $menuDetailParts[1] . "'>
                                        <i class='fa fa-angle-double-right'></i>" . $menuDetailParts[2] . "
                                    </a>
                                </li>");
                                }
                            }
                        }
                        ?>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>