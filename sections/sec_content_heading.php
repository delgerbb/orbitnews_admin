<!-- BEGIN PAGE HEADING ROW -->
<div class="row">
    <div class="col-lg-12">
        <!-- BEGIN BREADCRUMB -->
        <div class="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li class="active">Dashboard</li>
            </ul>

            <div class="b-right hidden-xs">
                <ul>
                    <li><a href="#" title=""><i class="fa fa-signal"></i></a></li>
                    <li><a href="#" title=""><i class="fa fa-comments"></i></a></li>
                    <!--
                    <li class="dropdown"><a href="#" title="" data-toggle="dropdown"><i class="fa fa-plus"></i><span> Tasks</span></a>
                        <ul class="dropdown-menu dropdown-primary dropdown-menu-right">
                            <li><a href="#">Add new task</a></li>
                            <li><a href="#">Statement</a></li>
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </li>
                    -->
                </ul>
            </div>
        </div>
        <!-- END BREADCRUMB -->	

        <div class="page-header title">
            <!-- PAGE TITLE ROW -->
            <h1>Dashboard <span class="sub-title">Content Overview</span></h1>									
        </div>

        <!-- /#ek-layout-button -->	
        <div class="qs-layout-menu">
            <div class="btn btn-gray qs-setting-btn" id="qs-setting-btn">
                <i class="fa fa-cog bigger-150 icon-only"></i>
            </div>
            <div class="qs-setting-box" id="qs-setting-box">
                <div class="hidden-xs hidden-sm">
                    <span class="bigger-120">Системийн тохиргоо</span>
                    <!--
                    <div class="hr hr-dotted hr-8"></div>
                    <label>
                        <input type="checkbox" class="tc" id="fixed-navbar" />
                        <span id="#fixed-navbar" class="labels"> Fixed NavBar</span>
                    </label>
                    <label>
                        <input type="checkbox" class="tc" id="fixed-sidebar" />
                        <span id="#fixed-sidebar" class="labels"> Fixed NavBar+SideBar</span>
                    </label>
                    <label>
                        <input type="checkbox" class="tc" id="sidebar-toggle" />
                        <span id="#sidebar-toggle" class="labels"> Sidebar Toggle</span>
                    </label>
                    <label>
                        <input type="checkbox" class="tc" id="in-container" />
                        <span id="#in-container" class="labels"> Inside<strong>.container</strong></span>
                    </label>
                    <div class="space-4"></div>
                </div>
                <span class="bigger-120">Color Options</span>
                <div class="hr hr-dotted hr-8"></div>
                <label>
                    <input type="checkbox" class="tc" id="side-bar-color" />
                    <span id="#side-bar-color" class="labels"> SideBar (Light)</span>
                </label>
                <ul>									
                    <li><button class="btn" style="background-color:#d15050;" onclick="swapStyle('assets/css/themes/style.css')"></button></li>
                    <li><button class="btn" style="background-color:#86618f;" onclick="swapStyle('assets/css/themes/style-1.css')"></button></li> 
                    <li><button class="btn" style="background-color:#ba5d32;" onclick="swapStyle('assets/css/themes/style-2.css')"></button></li>
                    <li><button class="btn" style="background-color:#488075;" onclick="swapStyle('assets/css/themes/style-3.css')"></button></li>
                    <li><button class="btn" style="background-color:#4e72c2;" onclick="swapStyle('assets/css/themes/style-4.css')"></button></li>
                </ul>
                    -->
                    <?php
                    $cpSystemLang = "";
                    if (!isset($_COOKIE[$app_config['cookie_system_lang']])) {
                        $cpSystemLang = WEBROOT . $app_config['server_images_path'] . "flags/flag_32_" . $app_config['system_default_lang'] . ".png";
                    } else {
                        $cpSystemLang = WEBROOT . $app_config['server_images_path'] . "flags/flag_32_" . $_COOKIE[$app_config['cookie_system_lang']] . ".png";
                    }
                    ?>
                    <div class="hr hr-dotted hr-8"></div>
                    <label>
                        <span id="#side-bar-color" class="labels">системийн хэл: <img src="<?= $cpSystemLang; ?>"/></span>
                    </label>
                    <ul>	
                        <?php
                        foreach ($live_lang as $value) {
                            $cpSystemLang = WEBROOT . $app_config['server_images_path'] . "flags/flag_32_" . $value . ".png";
                            echo("<li><img id='changeSystemLanguage' class='changeSystemLangStyle' data-syslang='" . $value . "' src='" . $cpSystemLang . "'/></li>");
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="daad"></div>
    </div>