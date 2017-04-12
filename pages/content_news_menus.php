<?php
$body_script = "news_menus";
$page_code = "news_menu_manager";

$accessCodes = $_COOKIE[$app_config['user_cookie_access_codes']];
$accessCodes = explode($app_config['splitter_access_codes'], $accessCodes, -1);

if (!in_array($page_code, $accessCodes)) {
    echo($sys_trans_lang['your_access_denied_on_this_page']);
    return "";
}
?>

<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-6">
            <div class="portlet">
                <div class="portlet-heading dark">
                    <div class="portlet-title">
                        <h4>Шинэ бүлэг нэмэх</h4>
                    </div>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion" href="#ft-1"><i class="fa fa-chevron-down"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="ft-2" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        <form class="form-horizontal" role="form" method="post">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">ахлах бүлгийн сонгох:</label>
                                <div class="col-sm-8">
                                    <select class="form-control selectpicker" name="select_parent_category" id="select_parent_category">
                                        <option value="none"> - сонгох - </option>
                                        <option value="8000">үндсэн бүлэг</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">бүлэг нэр:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" maxlength="100" name="news_category_name" id="news_category_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">бүлэг интернет хаяг:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" maxlength="100" name="news_category_slug" id="news_category_slug" placeholder="бүлэг интернет хаяг бичнэ үү">
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary" name="btn_SaveNewNewsCategory">хадгалах</button>
                                        <button type="submit" class="btn">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['btn_SaveNewNewsCategory'])) {
                            echo($cpAdmin->saveNewNewsCategory($_POST));
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">

            <div class="portlet">
                <div class="portlet-heading dark">
                    <div class="portlet-title">
                        <h4>мэдээний сайтын цэс засах</h4>
                    </div>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion" href="#ft-1"><i class="fa fa-chevron-down"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="ft-2" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        <form class="form-horizontal" role="form" method="post">

                            <div class="form-group">
                                <label class="col-sm-4 control-label">цэс сонгох:</label>
                                <div class="col-sm-8">
                                    <?php
                                    echo($cpHTML->printNewsSiteMenusForEdit());
                                    ?>
                                </div>
                            </div> 

                            <?php
                            echo($cpHTML->printNewsSiteMenuForEdit());
                            ?>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">цэсний код:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" maxlength="10" name="selectedEditMenuCode" id="selectedEditMenuCode" readonly="">
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary" name="btn_keepOldNewsSiteMenus">хадгалах</button>
                                        <button type="submit" class="btn">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['btn_keepOldNewsSiteMenus'])) {
                            echo($cpAdmin->keepOldNewsSiteMenus($_POST));
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>