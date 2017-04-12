<?php
$body_script = "monitor_news_news";

$page_code = "daily_news_manager";

$accessCodes = $_COOKIE[$app_config['user_cookie_access_codes']];
$accessCodes = explode($app_config['splitter_access_codes'], $accessCodes, -1);

if (!in_array($page_code, $accessCodes)) {
    echo($sys_trans_lang['your_access_denied_on_this_page']);
    return "";
}
?>
<style>
    .ulliCPProductMenu{list-style: none;margin-right: 5px;}
    .ulliCPProductMenu a::after{content: " - ";}
    .ulliCPProductMenu a{color:#686868;text-decoration: none;}
    .ulliCPProductMenu a:hover{color:#d15050;}
    .perProPicContainer{background: #466baf;margin: 10px 0;padding: 5px;border-radius: 3px;color: #FFF;}
    .perCatalogPicContainer{background: #466baf;margin: 10px 0;padding: 5px;border-radius: 3px;color: #FFF;}
    .perLookbookPicContainer{background: #466baf;margin: 10px 0;padding: 5px;border-radius: 3px;color: #FFF;}
    .perDailyNewsPicContainer{background: #466baf;margin: 10px 0;padding: 5px;border-radius: 3px;color: #FFF;}
</style>

<div class="row">
    <div class="col-lg-12">

        <div class="col-lg-12">
            <div class="portlet">
                <div class="portlet-heading dark">
                    <div class="portlet-title">
                        <h4><a name="goto_news_details"></a>өдөр тутамын мэдээнүүдийн жагсаалт</h4>
                    </div>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion" href="#ft-1"><i class="fa fa-chevron-down"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="ft-2" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">мэдээг агуулах цэс:</label>
                                <div class="col-sm-10">
                                    <?php
                                    echo($cpHTML->printNewsMenusCategories());
                                    ?>
                                    <span class="labels" id="daily_news_menu_status"></span>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <!--
                                        <button type="submit" class="btn btn-primary" name="sd45465">хадгалах</button>
                                        <button type="submit" class="btn">Cancel</button>
                                        -->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="portlet">
                <div class="portlet-heading dark">
                    <div class="portlet-title">
                        <h4><a name="goto_news_list"></a>сонгосон цэсний мэдээнүүд</h4>
                    </div>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion" href="#ft-1"><i class="fa fa-chevron-down"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="basic" class="panel-collapse collapse in">
                    <div class="portlet-body no-padding">
                        <table>
                            <tr><td>орчуулагдсан мэдээлэл: </td><td><div style="background: #72af46; width:32px;height:32px;margin:2px 0;"></div></td></tr>
                            <tr><td>орчуулагдаагүй мэдээлэл: </td><td><div style="background: #03a9f4; width:32px;height:32px;margin:2px 0;"></div></td></tr>
                        </table>
                    </div>
                </div>

                <div id="basic" class="panel-collapse collapse in">
                    <div class="portlet-body no-padding">
                        <div id="dailyNewsPreviewTableContainer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>