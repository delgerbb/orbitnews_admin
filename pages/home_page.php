<?php
$body_script = "home_page_script";
echo("your home page goes here");
return "";
?>
<!-- BEGIN PAGE HEADING ROW -->
<div class="row">
    <div class="col-lg-12">
        <!-- BEGIN BREADCRUMB -->
        <div class="breadcrumbs fixed">
            <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li class="active">Dashboard</li>
            </ul>

            <div class="b-right hidden-xs">
                <ul>
                    <li><a title="" href="#"><i class="fa fa-signal"></i></a></li>
                    <li><a title="" href="#"><i class="fa fa-comments"></i></a></li>
                    <li class="dropdown show-on-hover"><a data-toggle="dropdown" title="" href="#"><i class="fa fa-plus"></i><span> Tasks</span></a>
                        <ul class="dropdown-menu dropdown-primary dropdown-menu-right">
                            <li><a href="#">Add new task</a></li>
                            <li><a href="#">Statement</a></li>
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </li>
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
            <div id="qs-setting-btn" class="btn btn-gray qs-setting-btn">
                <i class="fa fa-cog bigger-150 icon-only"></i>
            </div>
            <div id="qs-setting-box" class="qs-setting-box">

                <div class="hidden-xs hidden-sm">
                    <span class="bigger-120">Layout Options</span>

                    <div class="hr hr-dotted hr-8"></div>
                    <label>
                        <input type="checkbox" id="fixed-navbar" class="tc">
                        <span class="labels" id="#fixed-navbar"> Fixed NavBar</span>
                    </label>
                    <label>
                        <input type="checkbox" id="fixed-sidebar" class="tc">
                        <span class="labels" id="#fixed-sidebar"> Fixed NavBar+SideBar</span>
                    </label>
                    <label>
                        <input type="checkbox" id="sidebar-toggle" class="tc">
                        <span class="labels" id="#sidebar-toggle"> Sidebar Toggle</span>
                    </label>
                    <label>
                        <input type="checkbox" id="in-container" class="tc">
                        <span class="labels" id="#in-container"> Inside<strong>.container</strong></span>
                    </label>

                    <div class="space-4"></div>
                </div>

                <span class="bigger-120">Color Options</span>

                <div class="hr hr-dotted hr-8"></div>

                <label>
                    <input type="checkbox" id="side-bar-color" class="tc">
                    <span class="labels" id="#side-bar-color"> SideBar (Light)</span>
                </label>

                <ul>									
                    <li><button onclick="swapStyle('assets/css/themes/style.css')" style="background-color:#d15050;" class="btn"></button></li>
                    <li><button onclick="swapStyle('assets/css/themes/style-1.css')" style="background-color:#86618f;" class="btn"></button></li> 
                    <li><button onclick="swapStyle('assets/css/themes/style-2.css')" style="background-color:#ba5d32;" class="btn"></button></li>
                    <li><button onclick="swapStyle('assets/css/themes/style-3.css')" style="background-color:#488075;" class="btn"></button></li>
                    <li><button onclick="swapStyle('assets/css/themes/style-4.css')" style="background-color:#4e72c2;" class="btn"></button></li>
                </ul>

            </div>
        </div>
        <!-- /#ek-layout-button -->		

    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<!-- END PAGE HEADING ROW -->					
<div class="row">
    <div class="col-lg-12">

        <!-- START YOUR CONTENT HERE -->
        <div class="row">
            <div class="col-lg-9 col-sm-12">

                <div class="row">

                    <div class="col-lg-4 col-sm-4">
                        <a class="tile-button btn btn-primary" href="#">
                            <div class="tile-content-wrapper">
                                <i class="fa fa-users"></i>
                                <div class="tile-content">
                                    475
                                </div>
                                <small>
                                    New Signup
                                </small>
                            </div>
                        </a>												
                    </div>

                    <div class="col-lg-4 col-sm-4">
                        <a class="tile-button btn btn-inverse" href="#">
                            <div class="tile-content-wrapper">
                                <i class="glyphicon glyphicon-gift"></i>
                                <div class="tile-content">
                                    70
                                </div>
                                <small>
                                    My Domains
                                </small>												
                            </div>
                        </a>												
                    </div>


                    <div class="col-lg-4 col-sm-4">
                        <a class="tile-button btn btn-white" href="#">
                            <div class="tile-content-wrapper">
                                <i class="fa fa-warning text-primary"></i>
                                <div class="tile-content text-primary">
                                    <span>$</span>270
                                </div>
                                <small>
                                    Due Invoices
                                </small>
                            </div>
                        </a>												
                    </div>


                </div>

                <!-- Server Info Charts .morris -->
                <div class="portlet">
                    <div class="portlet-heading inverse">
                        <div class="portlet-title">
                            <h4><i class="fa fa-line-chart"></i> Server Statics</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a title="" data-rel="tooltip" data-placement="top" class="tooltip-primary" href="javascript:;" id="daterange" data-original-title="DateRangePicker"><i class="fa fa-calendar"></i></a>
                            <span class="divider"></span>
                            <a href="#m-charts" data-parent="#accordion" data-toggle="collapse"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-collapse collapse in" id="m-charts">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h4>CPU percentage today</h4>
                                    <div style="height: 220px!important; min-height:220px;" id="morris-chart-1" class="chart-holder"><svg height="220" version="1.1" width="916" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; top: -0.25px;"><desc>Created with Raphaël 2.1.2</desc><defs/><text style="text-anchor: end; font: 12px sans-serif;" x="53.5" y="181" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#686868" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4">0 %</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M66,181H891" stroke-width="0.5"/><text style="text-anchor: end; font: 12px sans-serif;" x="53.5" y="142" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#686868" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4">7.5 %</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M66,142H891" stroke-width="0.5"/><text style="text-anchor: end; font: 12px sans-serif;" x="53.5" y="103" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#686868" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4">15 %</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M66,103H891" stroke-width="0.5"/><text style="text-anchor: end; font: 12px sans-serif;" x="53.5" y="64" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#686868" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4">22.5 %</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M66,64H891" stroke-width="0.5"/><text style="text-anchor: end; font: 12px sans-serif;" x="53.5" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#686868" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4">30 %</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M66,25H891" stroke-width="0.5"/><text style="text-anchor: middle; font: 12px sans-serif;" x="891" y="193.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#686868" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4">9PM</tspan></text><text style="text-anchor: middle; font: 12px sans-serif;" x="753.5" y="193.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#686868" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4">12AM</tspan></text><text style="text-anchor: middle; font: 12px sans-serif;" x="616" y="193.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#686868" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4">11AM</tspan></text><text style="text-anchor: middle; font: 12px sans-serif;" x="478.5" y="193.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#686868" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4">9AM</tspan></text><text style="text-anchor: middle; font: 12px sans-serif;" x="341" y="193.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#686868" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4">7AM</tspan></text><text style="text-anchor: middle; font: 12px sans-serif;" x="203.5" y="193.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#686868" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4">2AM</tspan></text><text style="text-anchor: middle; font: 12px sans-serif;" x="66" y="193.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#686868" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4">1AM</tspan></text><path style="" fill="none" stroke="#466baf" d="M66,165.4C100.375,135.5,169.125,47.09999999999998,203.5,45.79999999999998C237.875,44.499999999999986,306.625,143.3,341,155C375.375,166.7,444.125,147.20000000000002,478.5,139.4C512.875,131.6,581.625,103.64999999999999,616,92.6C650.375,81.55,719.125,44.5,753.5,51C787.875,57.5,856.625,121.19999999999999,891,144.6" stroke-width="2px"/><path style="" fill="none" stroke="#72af46" d="M66,181C100.375,149.8,169.125,58.14999999999999,203.5,56.19999999999999C237.875,54.249999999999986,306.625,157.6,341,165.4C375.375,173.20000000000002,444.125,125.1,478.5,118.6C512.875,112.1,581.625,119.89999999999999,616,113.39999999999999C650.375,106.89999999999999,719.125,61.39999999999999,753.5,66.6C787.875,71.8,856.625,132.9,891,155" stroke-width="2px"/><circle cx="66" cy="165.4" r="4" fill="#466baf" stroke="#ffffff" style="" stroke-width="1"/><circle cx="203.5" cy="45.79999999999998" r="4" fill="#466baf" stroke="#ffffff" style="" stroke-width="1"/><circle cx="341" cy="155" r="4" fill="#466baf" stroke="#ffffff" style="" stroke-width="1"/><circle cx="478.5" cy="139.4" r="4" fill="#466baf" stroke="#ffffff" style="" stroke-width="1"/><circle cx="616" cy="92.6" r="4" fill="#466baf" stroke="#ffffff" style="" stroke-width="1"/><circle cx="753.5" cy="51" r="4" fill="#466baf" stroke="#ffffff" style="" stroke-width="1"/><circle cx="891" cy="144.6" r="4" fill="#466baf" stroke="#ffffff" style="" stroke-width="1"/><circle cx="66" cy="181" r="4" fill="#72af46" stroke="#ffffff" style="" stroke-width="1"/><circle cx="203.5" cy="56.19999999999999" r="4" fill="#72af46" stroke="#ffffff" style="" stroke-width="1"/><circle cx="341" cy="165.4" r="4" fill="#72af46" stroke="#ffffff" style="" stroke-width="1"/><circle cx="478.5" cy="118.6" r="4" fill="#72af46" stroke="#ffffff" style="" stroke-width="1"/><circle cx="616" cy="113.39999999999999" r="4" fill="#72af46" stroke="#ffffff" style="" stroke-width="1"/><circle cx="753.5" cy="66.6" r="4" fill="#72af46" stroke="#ffffff" style="" stroke-width="1"/><circle cx="891" cy="155" r="4" fill="#72af46" stroke="#ffffff" style="" stroke-width="1"/></svg><div class="morris-hover morris-default-style" style="left: 22.5px; top: 90px; display: none;"><div class="morris-hover-row-label">1AM</div><div style="color: #72af46" class="morris-hover-point">
                                                Node 1:
                                                0 %
                                            </div><div style="color: #466baf" class="morris-hover-point">
                                                Node 2:
                                                3 %
                                            </div></div></div>
                                </div>
                                <div class="col-sm-3">
                                    <h4>Resources</h4>
                                    <hr class="separator">

                                    <!-- Progress bars 1-->
                                    <div class="clearfix">
                                        <span class="pull-left">Memory</span>
                                        <small class="pull-right">307.5/1024 GB</small>
                                    </div>
                                    <div class="progress progress-mini">
                                        <div style="width: 30%;" class="progress-bar progress-bar-success"></div>
                                    </div>

                                    <!-- Progress bars 2-->
                                    <div class="clearfix">
                                        <span class="pull-left">IP Address</span>
                                        <small class="pull-right">900/1000</small>
                                    </div>
                                    <div class="progress progress-mini">
                                        <div style="width: 90%;" class="progress-bar progress-bar-danger"></div>
                                    </div>

                                    <!-- Progress bars 3-->
                                    <div class="clearfix">
                                        <span class="pull-left">Storage</span>
                                        <small class="pull-right">3.5/5 TB</small>
                                    </div>
                                    <div class="progress progress-mini">
                                        <div style="width: 70%;" class="progress-bar progress-bar-warning"></div>
                                    </div>

                                    <!-- Progress bars 4-->
                                    <div class="clearfix">
                                        <span class="pull-left">Bandwidth</span>
                                        <small class="pull-right">3/30 TB</small>
                                    </div>
                                    <div class="progress progress-mini">
                                        <div style="width: 10%;" class="progress-bar progress-bar-info"></div>
                                    </div>

                                    <!-- Buttons -->
                                    <button class="btn btn-sm btn-primary"><i class="fa fa-file-pdf-o"></i>Generate PDF</button>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <!-- End Server Info Charts .morris -->

                <div class="portlet">
                    <div class="portlet-heading inverse">
                        <div class="portlet-title">
                            <h4><i class="glyphicon glyphicon-sort-by-attributes"></i> Statics</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a href="#jq-spark" data-parent="#accordion" data-toggle="collapse"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-collapse collapse in" id="jq-spark">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-sm-3 col-xs-6 text-center">
                                    <div class="sparkline-chart">
                                        <span class="sparkline-bar"><canvas style="display: inline-block; width: 113px; height: 55px; vertical-align: top;" width="113" height="55"></canvas></span>
                                        <a class="title" href="#">CPU</a>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-6 text-center">
                                    <div class="sparkline-chart">
                                        <span class="sparkline-line"><canvas style="display: inline-block; width: 110px; height: 55px; vertical-align: top;" width="110" height="55"></canvas></span>
                                        <a class="title" href="#">Bandwith Uses</a>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-6 text-center">
                                    <div data-percent="76" id="easyPieChart-visit" class="easy-pie-chart" style="width: 67px; height: 67px;">
                                        <span class="number" style="line-height: 67px; font-size: 14px;">7,397</span>
                                        <a class="title" href="#">Visits</a>
                                        <canvas height="67" width="67"></canvas></div>									
                                </div>
                                <div class="col-sm-3 col-xs-6 text-center">
                                    <div data-percent="80" id="easyPieChart-bounce" class="easy-pie-chart" style="width: 67px; height: 67px;">
                                        <span class="percent" style="line-height: 67px; font-size: 14px;">80</span>
                                        <a class="title" href="#">Bounce</a>																
                                        <canvas height="67" width="67"></canvas></div>
                                </div>
                            </div>										
                        </div>
                    </div>
                </div>
                <!-- End Statics Charts -->

                <!-- Recent Activities -->
                <div class="portlet no-border-bottom">
                    <div class="portlet-heading dark">
                        <div class="portlet-title">
                            <h4><i class="fa fa-list-ul"></i> Recent Activities</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a href="#recent" data-parent="#accordion" data-toggle="collapse"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-collapse collapse in" id="recent">
                        <div class="portlet-body no-padding">
                            <div class="tc-tabs no-margin">
                                <ul class="nav nav-tabs tab-small-button no-padding">
                                    <li class="active"><a data-toggle="tab" href="#tab14"><i class="fa fa-bell-o bigger-130"></i></a></li>
                                    <li><a data-toggle="tab" href="#tab15"><i class="fa fa-ticket bigger-130"></i></a></li>
                                    <li><a data-toggle="tab" href="#tab16"><i class="fa fa-users bigger-130"></i><span class="badge badge-primary">5</span></a></li>
                                </ul>

                                <div class="tab-content no-padding no-border-left no-border-right no-border-bottom">
                                    <div id="tab14" class="tab-pane active">
                                        <ul class="lists">
                                            <li>
                                                <span class="date">17/7/2014 07:43</span>
                                                Cron Job: Starting Updating Product Pricing for Current Exchange Rates
                                            </li>
                                            <li>
                                                <span class="date">17/7/2014 05:45</span>
                                                Email Sent to <a href="#">Maris Bradley</a>, answered <a href="#">[Ticket ID: 332335]</a>
                                            </li>
                                            <li>
                                                <span class="date">17/7/2014 02:43</span>
                                                Module Suspend Successful - Reason: <a href="#">#827101</a>
                                            </li>
                                            <li>
                                                <span class="date">17/7/2014 23:36</span>
                                                Cron Job: Starting Performing Automated Fixed Term Service Terminations
                                            </li>
                                            <li>
                                                <span class="date">18/7/2014 07:39</span>
                                                Email Sent to <a href="#">Jack Sparrow</a> (Invoice Payment Confirmation).
                                            </li>
                                        </ul>
                                    </div>

                                    <div id="tab15" class="tab-pane">
                                        <ul class="lists">
                                            <li>
                                                <span class="icons"><i class="fa fa-envelope"></i></span>
                                                <a href="#">#808936</a> - Invoice has been paid please active my server
                                            </li>
                                            <li>
                                                <span class="icons"><i class="fa fa-envelope"></i></span>
                                                <a href="#">#857517</a> - New Server's Name Server IPs
                                            </li>
                                            <li>
                                                <span class="icons"><i class="fa fa-envelope"></i></span>
                                                <a href="#">#225310</a> - unsuspended reseller dineshrv all account urgent
                                            </li>
                                            <li>
                                                <span class="icons"><i class="fa fa-envelope"></i></span>
                                                <a href="#">#597608</a> - Mail Not Received
                                            </li>
                                            <li>
                                                <span class="icons"><i class="fa fa-envelope"></i></span>
                                                <a href="#">#597607</a> - Plase update my new mail address
                                            </li>
                                        </ul>
                                    </div>

                                    <div id="tab16" class="tab-pane">
                                        <ul class="lists">
                                            <li>
                                                <span class="date">17/7/2014</span>
                                                <span class="icons"><i class="fa fa-user"></i></span>
                                                <a href="#">Elly Martel</a> afiliated by <a href="#">Johan Smith</a>.
                                            </li>
                                            <li>
                                                <span class="date">17/7/2014</span>
                                                <span class="icons"><i class="fa fa-user"></i></span>
                                                <a href="#">Jack Sparrow</a> afiliated by <a href="#">Johan Smith</a>.
                                            </li>
                                            <li>
                                                <span class="date">17/7/2014</span>
                                                <span class="icons"><i class="fa fa-user"></i></span>
                                                <a href="#">Maris Bradley</a> afiliated by <a href="#">Johan Smith</a>.
                                            </li>
                                            <li>
                                                <span class="date">17/7/2014</span>
                                                <span class="icons"><i class="fa fa-user"></i></span>
                                                <a href="#">Roby Roy</a> afiliated by <a href="#">Johan Smith</a>.
                                            </li>
                                            <li>
                                                <span class="date">17/7/2014</span>
                                                <span class="icons"><i class="fa fa-user"></i></span>
                                                <a href="#">Rohan Jha</a> afiliated by <a href="#">Johan Smith</a>.
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Recent Activities -->

            </div><!-- //col-lg-9 -->

            <div class="col-lg-3 col-sm-12">

                <!-- Users List -->
                <div class="portlet">
                    <div class="portlet-heading inverse">
                        <div class="portlet-title">
                            <h4><i class="fa fa-list-alt"></i> Clients</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a href="#qclients" data-parent="#accordion" data-toggle="collapse"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-collapse collapse in" id="qclients">
                        <div class="portlet-body">
                            <input type="search" placeholder="Search User..." id="input-quicklist" class="form-control input-sm">
                            <div class="space-4"></div>

                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 120px;"><div class="quick-list" style="overflow: hidden; width: auto; height: 120px;">														
                                    <a href="profile.html">
                                        <div class="media items no-margin-top">
                                            <span class="pull-left">
                                                <img alt="#" style="width: 37px;height:37px;" src="assets/images/user-1.jpg">
                                            </span>
                                            <div class="media-body">
                                                John Smith<br><small>Software Developer</small>
                                            </div>
                                            <div class="tools">
                                                <i class="fa fa-share icon-only"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="media items">
                                            <span class="pull-left">
                                                <img alt="#" style="width: 37px;height:37px;" src="assets/images/user-4.jpg">
                                            </span>
                                            <div class="media-body">
                                                Elly Martel<br><small>Software Developer</small>
                                            </div>
                                            <div class="tools">
                                                <i class="fa fa-share icon-only"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="media items">
                                            <span class="pull-left">
                                                <img alt="#" style="width: 37px;height:37px;" src="assets/images/user-3.jpg">
                                            </span>
                                            <div class="media-body">
                                                Jack Sparrow<br><small>Software Developer</small>
                                            </div>
                                            <div class="tools">
                                                <i class="fa fa-share icon-only"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="media items">
                                            <span class="pull-left">
                                                <img alt="#" style="width: 37px;height:37px;" src="assets/images/user-5.jpg">
                                            </span>
                                            <div class="media-body">
                                                Maris Bradley<br><small>Software Developer</small>
                                            </div>
                                            <div class="tools">
                                                <i class="fa fa-share icon-only"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div><div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 60.251px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                        </div>
                    </div>
                </div>
                <!-- End Users List -->

                <!-- Todo List -->
                <div class="portlet">
                    <div class="portlet-heading inverse">
                        <div class="portlet-title">
                            <h4><i class="fa fa-edit"></i> To Do</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a href="javascript:;"><span class="badge badge-primary">6</span></a>
                            <span class="divider"></span>
                            <a title="" data-rel="tooltip" data-placement="left" class="tooltip-primary" href="#" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="portlet-body">
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 95px;"><ul class="task-widget list-group task-lists ui-sortable" id="todo-sortlist" style="overflow: hidden; width: auto; height: 95px;">
                                <li class="list-group-item">
                                    <div class="tcb">
                                        <label>
                                            <input type="checkbox" id="checkbox" class="tc">
                                            <span class="labels" id="#checkbox">
                                                Updating server software <i class="fa fa-warning text-danger"></i>
                                            </span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="tcb">
                                        <label>
                                            <input type="checkbox" id="checkbox1" class="tc">
                                            <span class="labels" id="#checkbox1">
                                                Fixing bugs
                                            </span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="tcb">
                                        <label>
                                            <input type="checkbox" id="checkbox2" class="tc">
                                            <span class="labels" id="#checkbox2">
                                                Upgrading scripts in template
                                            </span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="tcb">
                                        <label>
                                            <input type="checkbox" id="checkbox3" class="tc">
                                            <span class="labels" id="#checkbox3">
                                                Reporting to manager
                                            </span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="tcb">
                                        <label>
                                            <input type="checkbox" id="checkbox4" class="tc">
                                            <span class="labels" id="#checkbox4">
                                                Pending Orders <span class="badge badge-success">3</span>
                                            </span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="tcb">
                                        <label>
                                            <input type="checkbox" id="checkbox5" class="tc">
                                            <span class="labels" id="#checkbox5">
                                                Call to John Smith
                                            </span>
                                        </label>
                                    </div>
                                </li>
                            </ul><div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 51.5714px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                    </div>

                    <div class="portlet-footer">
                        <div class="input-group">
                            <input type="text" placeholder="Add new Task..." class="form-control input-sm">
                            <span class="input-group-btn">
                                <button class="btn btn-success btn-sm"><i class="fa fa-plus icon-only"></i></button>
                            </span>
                        </div>
                    </div>

                </div>										
                <!-- End Todo List -->


                <!-- Mini Calendar -->
                <div class="portlet hidden-widgets">
                    <div class="portlet-heading inverse">
                        <div class="portlet-title">
                            <h4><i class="fa fa-calendar"></i> Calendar</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a href="#mini-calendar" data-parent="#accordion" data-toggle="collapse"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-collapse collapse in" id="mini-calendar">
                        <div class="portlet-body">
                            <div id="minicalendar"><div class="datepicker datepicker-inline"><div class="datepicker-days" style="display: block;"><table class=" table-condensed"><thead><tr><th class="prev" style="visibility: visible;"><i class="fa fa-angle-double-left"></i></th><th class="datepicker-switch" colspan="5">June 2015</th><th class="next" style="visibility: visible;"><i class="fa fa-angle-double-right"></i></th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td class="old day">31</td><td class="day">1</td><td class="active day">2</td><td class="day">3</td><td class="day">4</td><td class="day">5</td><td class="day">6</td></tr><tr><td class="day">7</td><td class="day">8</td><td class="day">9</td><td class="day">10</td><td class="day">11</td><td class="day">12</td><td class="day">13</td></tr><tr><td class="day">14</td><td class="day">15</td><td class="day">16</td><td class="day">17</td><td class="day">18</td><td class="day">19</td><td class="day">20</td></tr><tr><td class="day">21</td><td class="day">22</td><td class="day">23</td><td class="day">24</td><td class="day">25</td><td class="day">26</td><td class="day">27</td></tr><tr><td class="day">28</td><td class="day">29</td><td class="day">30</td><td class="new day">1</td><td class="new day">2</td><td class="new day">3</td><td class="new day">4</td></tr><tr><td class="new day">5</td><td class="new day">6</td><td class="new day">7</td><td class="new day">8</td><td class="new day">9</td><td class="new day">10</td><td class="new day">11</td></tr></tbody><tfoot><tr><th class="today" colspan="7" style="display: none;">Today</th></tr></tfoot></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" style="visibility: visible;"><i class="fa fa-angle-double-left"></i></th><th class="datepicker-switch" colspan="5">2015</th><th class="next" style="visibility: visible;"><i class="fa fa-angle-double-right"></i></th></tr></thead><tbody><tr><td colspan="7"><span class="month">Jan</span><span class="month">Feb</span><span class="month">Mar</span><span class="month">Apr</span><span class="month">May</span><span class="month active">Jun</span><span class="month">Jul</span><span class="month">Aug</span><span class="month">Sep</span><span class="month">Oct</span><span class="month">Nov</span><span class="month">Dec</span></td></tr></tbody><tfoot><tr><th class="today" colspan="7" style="display: none;">Today</th></tr></tfoot></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" style="visibility: visible;"><i class="fa fa-angle-double-left"></i></th><th class="datepicker-switch" colspan="5">2010-2019</th><th class="next" style="visibility: visible;"><i class="fa fa-angle-double-right"></i></th></tr></thead><tbody><tr><td colspan="7"><span class="year old">2009</span><span class="year">2010</span><span class="year">2011</span><span class="year">2012</span><span class="year">2013</span><span class="year">2014</span><span class="year active">2015</span><span class="year">2016</span><span class="year">2017</span><span class="year">2018</span><span class="year">2019</span><span class="year old">2020</span></td></tr></tbody><tfoot><tr><th class="today" colspan="7" style="display: none;">Today</th></tr></tfoot></table></div></div></div>

                            <div class="space-8"></div>

                            <div class="notice bg-primary marker-on-top no-margin-bottom">
                                <h4>Today's Event</h4>
                                <ul class="list-unstyled smaller-90">
                                    <li>10 Addons Due to Renew</li>
                                    <li>2 Products/Services Due to Renew</li>
                                    <li>6 Domains Due to Renew</li>
                                </ul>

                                <a href="#"><i class="fa fa-plus"></i> Add New Event</a>
                            </div>
                        </div>
                    </div>
                </div>										
                <!-- End Mini Calendar -->

            </div><!-- //col-lg-3 -->
        </div>			
        <!-- END YOUR CONTENT HERE -->

    </div>
</div>

<!-- BEGIN FOOTER CONTENT -->		
<div class="footer">
    <div class="footer-inner">
        <!-- basics/footer -->
        <div class="footer-content">
            &copy; 2014 <a href="#">eKoders</a>, All Rights Reserved.
        </div>
        <!-- /basics/footer -->
    </div>
</div>
<button class="btn btn-primary btn-sm back-to-top" id="back-to-top" type="button" style="display: block;">
    <i class="fa fa-angle-double-up icon-only bigger-110"></i>
</button>
<!-- END FOOTER CONTENT -->