<?php
$body_script = "view_system_user";

$page_code = "system_users_viewer";

$accessCodes = $_COOKIE[$app_config['user_cookie_access_codes']];
$accessCodes = explode($app_config['splitter_access_codes'], $accessCodes, -1);

if (!in_array($page_code, $accessCodes)) {
    echo($sys_trans_lang['your_access_denied_on_this_page']);
    return "";
}
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
                <li><a href="#">Additional Pages</a></li>
                <li class="active">User Profile</li>
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
            <h1>John's Profile <span class="sub-title">sub tile</span></h1>									
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
            <div class="col-lg-3 col-md-3">
                <div class="well well-sm white">
                    <div class="profile-pic">
                        <a href="#">
                            <img alt="" class="img-responsive" src="assets/images/user-1.jpg">
                        </a>
                    </div>
                    <p class="text-center">
                        <button role="button" title="" data-rel="tooltip" data-placement="top" class="btn btn-facebook btn-xs" type="button" data-original-title="Visit My Facebook"><i class="fa fa-facebook icon-only"></i></button>
                        <button role="button" title="" data-rel="tooltip" data-placement="top" class="btn btn-twitter btn-xs" type="button" data-original-title="Visit My Twitter"><i class="fa fa-twitter icon-only"></i></button>
                        <button title="" data-rel="tooltip" data-placement="top" role="button" class="btn btn-googleplus btn-xs" type="button" data-original-title="Google +"><i class="fa fa-google-plus icon-only"></i></button>
                    </p>
                </div>
                <div class="alert bg-primary">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin nunc lorem, rutrum non porta.</p>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="tc-tabs"><!-- Nav tabs style 1 -->
                    <ul class="nav nav-tabs tab-lg-button tab-color-dark background-dark white">
                        <li class=""><a data-toggle="tab" href="#p1"><i class="fa fa-desktop bigger-130"></i>Overview</a></li>
                        <li class="active"><a data-toggle="tab" href="#p2"><i class="fa fa-edit bigger-130"></i>Edit Account</a></li>
                        <li class=""><a data-toggle="tab" href="#p3"><i class="fa fa-building-o bigger-130"></i>Projects</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="p1" class="tab-pane fade">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                    <div class="portlet no-border">
                                        <div class="portlet-heading">
                                            <div class="portlet-title">
                                                <h2>John Smith</h2>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="portlet-body">
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. sed diam nonummy nibh euismod tincidunt laoreet dolore magna aliquam tincidunt erat volutpat laoreet dolore magna aliquam tincidunt erat volutpat.</p>
                                            <address>
                                                <a data-type="text" id="email" href="mailto:#" class="editable editable-click">john.smith@example.com</a>
                                            </address>
                                            <ul class="list-inline well well-sm">
                                                <li><i class="fa fa-flag bigger-110"></i> Uinited State</li>
                                                <li><i class="fa fa-calendar bigger-110"></i> <a class="editable editable-click" id="dob" href="#">28th March, 2014</a></li>
                                                <li><i class="glyphicon glyphicon-certificate bigger-110"></i> RedHat Certification</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="portlet no-border">
                                        <div class="portlet-heading dark">
                                            <div class="portlet-title">
                                                <h4>Skills</h4>
                                            </div>
                                            <div class="portlet-widgets">
                                                <i class="fa fa-sort-alpha-desc bigger-110"></i>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="portlet-body skills light">
                                            <div data-percent="75%" class="progress">
                                                <div style="width: 75%" role="progressbar" class="progress-bar progress-bar-success">
                                                    <span class="sr-only">75% Complete</span>
                                                </div>
                                                <span class="progress-type">HTML / HTML5</span>
                                                <span class="progress-completed">75%</span>
                                            </div>
                                            <div data-percent="40%" class="progress">
                                                <div style="width: 40%" role="progressbar" class="progress-bar progress-bar-warning">
                                                    <span class="sr-only">40% Complete</span>
                                                </div>
                                                <span class="progress-type">ASP.Net</span>
                                                <span class="progress-completed">40%</span>
                                            </div>
                                            <div data-percent="26%" class="progress">
                                                <div style="width: 26%" role="progressbar" class="progress-bar progress-bar-danger">
                                                    <span class="sr-only">26% Complete</span>
                                                </div>
                                                <span class="progress-type">Java</span>
                                                <span class="progress-completed">26%</span>
                                            </div>
                                            <div data-percent="80%" class="progress">
                                                <div style="width: 80%" role="progressbar" class="progress-bar">
                                                    <span class="sr-only">80% Complete</span>
                                                </div>
                                                <span class="progress-type">jQuery / JavaScript</span>
                                                <span class="progress-completed">80%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet no-border-bottom">
                                        <div class="portlet-heading dark">
                                            <div class="portlet-title">
                                                <h4><i class="fa fa-rss"></i> Recent Activities</h4>
                                            </div>
                                            <div class="portlet-widgets">
                                                <a href="javascript:;"><i class="fa fa-refresh"></i></a>
                                                <span class="divider"></span>
                                                <a title="" data-rel="tooltip" data-placement="left" class="tooltip-danger" href="#" data-original-title="Clear"><i class="fa fa-trash-o bigger-110"></i></a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="portlet-body no-padding">
                                            <ul class="lists">
                                                <li>
                                                    <span class="date">17/7/2014</span>
                                                    <span class="icons"><i class="fa fa-warning"></i></span>
                                                    Server rdp32 is overloaded
                                                </li>
                                                <li>
                                                    <span class="date">17/7/2014</span>
                                                    <span class="icons"><i class="fa fa-warning"></i></span>
                                                    Email Sent to Sameer Matalia <a href="#">[Ticket ID: 332335]</a>
                                                </li>
                                                <li>
                                                    <span class="date">17/7/2014</span>
                                                    <span class="icons"><i class="fa fa-warning"></i></span>
                                                    Module Suspend Successful - Reason: <a href="#">#827101</a>
                                                </li>
                                                <li>
                                                    <span class="date">17/7/2014</span>
                                                    <span class="icons"><i class="fa fa-warning"></i></span>
                                                    Cron Job: Starting Processing Overdue Suspensions
                                                </li>
                                                <li>
                                                    <span class="date">17/7/2014</span>
                                                    <span class="icons"><i class="fa fa-warning"></i></span>
                                                    Email Sent to <a href="#">Sunil Gupta</a> (Add new domain)
                                                </li>
                                                <li>
                                                    <span class="date">17/7/2014</span>
                                                    <span class="icons"><i class="fa fa-warning"></i></span>
                                                    <a href="#">New order</a> received. Please take care of it.
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="hr hr-12 hr-double"></div>
                                    <div class="action-buttons">
                                        <a href="#"><i class="fa fa-search-plus"></i> View all</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div id="p2" class="tab-pane fade active in">
                            <h2>Account details</h2>
                            <div class="hr hr-12 hr-double"></div>
                            <form method="post" role="form" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">First Name:</label>
                                    <div class="col-sm-3">
                                        <input type="text" placeholder="john" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Last Name:</label>
                                    <div class="col-sm-3">
                                        <input type="text" placeholder="Smith" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Company:</label>
                                    <div class="col-sm-5">
                                        <input type="text" placeholder="eKoders, Ltd." class="form-control">
                                    </div>
                                </div>													
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="email" disabled="" placeholder="john.smith@example.com" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <hr class="separator">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9">
                                        <div class="tcb">
                                            <label>
                                                <input type="checkbox" class="tc tc-red">
                                                <span class="labels"> Tick to Pasword Modifaction</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: none;" class="myPassword">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Existing Password:</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="password" id="form-field-1" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">New Password:</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="password" id="form-field-2" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Confirm New Password:</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="password" id="form-field-3" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="separator">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">About Me:</label>
                                    <div class="col-sm-9">
                                        <ul class="wysihtml5-toolbar" style="">
                                            <li class="dropdown"><a href="#" data-toggle="dropdown" class="btn btn-sm dropdown-toggle"><i class="fa fa-font"></i><span class="current-font">Normal text</span>&nbsp;<b class="caret"></b></a>
                                                <ul class="dropdown-menu dropdown-default">
                                                    <li><a tabindex="-1" data-wysihtml5-command-value="div" data-wysihtml5-command="formatBlock" href="javascript:;" unselectable="on">Normal text</a></li>
                                                    <li><a tabindex="-1" data-wysihtml5-command-value="h1" data-wysihtml5-command="formatBlock" href="javascript:;" unselectable="on">Heading 1</a></li>
                                                    <li><a tabindex="-1" data-wysihtml5-command-value="h2" data-wysihtml5-command="formatBlock" href="javascript:;" unselectable="on">Heading 2</a></li>
                                                    <li><a tabindex="-1" data-wysihtml5-command-value="h3" data-wysihtml5-command="formatBlock" href="javascript:;" unselectable="on">Heading 3</a></li>
                                                    <li><a data-wysihtml5-command-value="h4" data-wysihtml5-command="formatBlock" href="javascript:;" unselectable="on">Heading 4</a></li>
                                                    <li><a data-wysihtml5-command-value="h5" data-wysihtml5-command="formatBlock" href="javascript:;" unselectable="on">Heading 5</a></li>
                                                    <li><a data-wysihtml5-command-value="h6" data-wysihtml5-command="formatBlock" href="javascript:;" unselectable="on">Heading 6</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <div class="btn-group"><a tabindex="-1" title="CTRL+B" data-wysihtml5-command="bold" class="btn btn-sm" href="javascript:;" unselectable="on">Bold</a><a tabindex="-1" title="CTRL+I" data-wysihtml5-command="italic" class="btn btn-sm" href="javascript:;" unselectable="on">Italic</a><a tabindex="-1" title="CTRL+U" data-wysihtml5-command="underline" class="btn btn-sm" href="javascript:;" unselectable="on">Underline</a></div></li>
                                            <li><div class="btn-group"><a tabindex="-1" title="Unordered list" data-wysihtml5-command="insertUnorderedList" class="btn btn-sm" href="javascript:;" unselectable="on"><i class="fa fa-list icon-only"></i></a><a tabindex="-1" title="Ordered list" data-wysihtml5-command="insertOrderedList" class="btn btn-sm" href="javascript:;" unselectable="on"><i class="fa fa-th-list icon-only"></i></a><a tabindex="-1" title="Outdent" data-wysihtml5-command="Outdent" class="btn btn-sm" href="javascript:;" unselectable="on"><i class="fa fa-outdent icon-only"></i></a><a tabindex="-1" title="Indent" data-wysihtml5-command="Indent" class="btn btn-sm" href="javascript:;" unselectable="on"><i class="fa fa-indent icon-only"></i></a></div></li>
                                            <li><div class="btn-group"><a tabindex="-1" title="Edit HTML" data-wysihtml5-action="change_view" class="btn btn-sm" href="javascript:;" unselectable="on"><i class="fa fa-pencil icon-only"></i></a></div></li>
                                            <li><div class="bootstrap-wysihtml5-insert-link-modal modal fade"><div class="modal-dialog"> <div class="modal-content"><div class="modal-header"><a data-dismiss="modal" class="close">×</a><h4>Insert link</h4></div><div class="modal-body"><input class="bootstrap-wysihtml5-insert-link-url form-control input-xlarge" value="http://"><div class="tcb"><label style="margin-top: 10px;"><input type="checkbox" checked="" class="bootstrap-wysihtml5-insert-link-target tc"><span class="labels"> Open link in new window</span></label></div></div><div class="modal-footer"><a data-dismiss="modal" class="btn btn-default" href="#">Cancel</a><a data-dismiss="modal" class="btn btn-primary" href="#">Insert link</a></div></div></div></div><a tabindex="-1" title="Insert link" data-wysihtml5-command="createLink" class="btn btn-sm" href="javascript:;" unselectable="on"><i class="fa fa-share icon-only"></i></a></li>
                                            <li><div class="bootstrap-wysihtml5-insert-image-modal modal fade"><div class="modal-dialog"> <div class="modal-content"><div class="modal-header"><a data-dismiss="modal" class="close">×</a><h4>Insert image</h4></div><div class="modal-body"><input class="bootstrap-wysihtml5-insert-image-url form-control input-xlarge" value="http://"></div><div class="modal-footer"><a data-dismiss="modal" class="btn btn-default" href="#">Cancel</a><a data-dismiss="modal" class="btn btn-primary" href="#">Insert image</a></div></div></div></div><a tabindex="-1" title="Insert image" data-wysihtml5-command="insertImage" class="btn btn-sm" href="javascript:;" unselectable="on"><i class="fa fa-picture-o icon-only"></i></a></li>
                                        </ul>
                                        <textarea class="form-control" id="about-editor" style="display: none;"></textarea>
                                        <input type="hidden" name="_wysihtml5_mode" value="1">
                                        <iframe width="0" height="0" frameborder="0" class="wysihtml5-sandbox" security="restricted" allowtransparency="true" marginwidth="0" marginheight="0" style="display: block; background-color: rgb(255, 255, 255); border-collapse: separate; border-color: rgb(229, 229, 229); border-style: solid; border-width: 1px; clear: none; float: none; margin: 0px; outline: 0px none rgb(0, 0, 0); outline-offset: 0px; padding: 6px 12px; position: static; z-index: auto; vertical-align: text-bottom; text-align: start; box-sizing: border-box; box-shadow: none; border-radius: 0px; width: 912.367px; height: 54px; top: auto; left: auto; right: auto; bottom: auto;"></iframe>
                                    </div>
                                </div>													
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Address:</label>
                                    <div class="col-sm-7">
                                        <input type="text" placeholder="795 Folsom Ave, Suite 600" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">City:</label>
                                    <div class="col-sm-3">
                                        <input type="text" placeholder="San Francisco" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">State/Region:</label>
                                    <div class="col-sm-4">
                                        <input type="text" placeholder="Florida" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Zip code:</label>
                                    <div class="col-sm-3">
                                        <input type="text" placeholder="94107" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Country:</label>
                                    <div class="col-sm-4">
                                        <input type="text" placeholder="United State" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Phone Number:</label>
                                    <div class="col-sm-3">
                                        <input type="text" placeholder="+1 5643234765" class="form-control">
                                    </div>
                                </div>												
                                <div class="form-actions">
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                            <button class="btn btn-inverse" type="submit">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="p3" class="tab-pane fade">
                            Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica.
                        </div>
                    </div>
                </div><!--nav-tabs style 1-->
            </div>
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
<button class="btn btn-primary btn-sm back-to-top" id="back-to-top" type="button" style="display: none;">
    <i class="fa fa-angle-double-up icon-only bigger-110"></i>
</button>
<!-- END FOOTER CONTENT -->