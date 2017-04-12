<?php
$body_script = "edit_news_news";

$page_code = "old_news_editor";

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
                        <h4><a name="goto_news_details"></a>хуучин мэдээнүүдийн жагсаалт</h4>
                    </div>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion" href="#ft-1"><i class="fa fa-chevron-down"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="ft-2" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" onsubmit="return validateThisForm(this)">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">мэдээг агуулах цэс:</label>
                                <div class="col-sm-10">
                                    <?php
                                    echo($cpHTML->printNewsMenusCategories());
                                    ?>
                                    <span class="labels" id="daily_news_menu_status"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">мэдээний нэр:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" maxlength="200" name="daily_news_name" id="daily_news_name" placeholder="энд мэдээний гарчиг бичнэ үү">
                                    <span class="labels" id="daily_news_name_status"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">цэсний интернет хаяг:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" maxlength="200" name="daily_news_slug" id="daily_news_slug" placeholder="this-is-news-title гэх мэт зайгүй Англи үсэг тоо оруулан бичнэ.">
                                    <span class="labels" id="daily_news_slug_status"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="daily_news_preview">мэдээний товч:</label>
                                <div class="col-sm-10">
                                    <textarea id="daily_news_preview" class="daily_news_preview" name="daily_news_preview" cols="80" rows="10"> </textarea><br/>
                                    <span class="labels" id="daily_news_preview_status"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="daily_news_content">мэдээний агуулга:</label>
                                <div class="col-sm-10">
                                    <textarea id="daily_news_content" class="daily_news_content" name="daily_news_content"> </textarea>
                                    <span class="labels" id="daily_news_content_status"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">хуучин зургууд:</label>
                                <div class="col-sm-4">
                                    <div class="newsOldImagesContainer" id="newsOldImagesContainer"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">зургууд:</label>
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-primary" name="btn_add_daily_news_picture" id="btn_add_daily_news_picture">нэмэх</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">зургууд:</label>
                                <div class="col-sm-4">
                                    <div class="containerDailyNewsPictures">

                                    </div>
                                    <span class="labels" id="dailyNewsPictures_status"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">хуучин зургийг дарах:</label>
                                <div class="col-sm-4">
                                    <label>
                                        <input class="tc tc-switch tc-switch-5" type="checkbox" name="isOldImgReplaced" data-target="oldImageWillReplaced" id="isOldImgReplaced"/>
                                        <span class="labels"></span>
                                    </label>														
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Онцлох мэдээ эсэх:</label>
                                <div class="col-sm-4">
                                    <label>
                                        <input class="tc tc-switch tc-switch-5" type="checkbox" name="isFeaturedPost" data-target="thisPostWillFeatured" id="isFeaturedPost"/>
                                        <span class="labels"></span>
                                    </label>														
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">идэвхтэй:</label>
                                <div class="col-sm-4">
                                    <label>
                                        <input class="tc tc-switch tc-switch-5" type="checkbox" name="is_active_news" data-target="thisNewsWillActive" id="is_active_news"/>
                                        <span class="labels"></span>
                                    </label>														
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">мэдээг шилжүүлэх:</label>
                                <div class="col-sm-4">
                                    <label>
                                        <input class="tc tc-switch tc-switch-5" type="checkbox" name="is_swap_news" data-target="thisNewsWillSwap" id="is_swap_news"/>
                                        <span class="labels"></span>
                                    </label>														
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">орчуулга хийгдсэн:</label>
                                <div class="col-sm-4">
                                    <label>
                                        <input class="tc tc-switch tc-switch-5" type="checkbox" name="is_translated_news" data-target="thisNewsWillTranslate" id="is_translated_news"/>
                                        <span class="labels"></span>
                                    </label>														
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">бүх хэлд засах:</label>
                                <div class="col-sm-4">
                                    <label>
                                        <input class="tc tc-switch tc-switch-5" type="checkbox" name="isTranslateAllLangs" id="isTranslateAllLangs" data-target="thisNewsWillTranslateAllLangs"/>
                                        <span class="labels"></span>
                                    </label>														
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">хэвлэгдсэн онгоо:</label>
                                <div class="col-sm-4">
                                    <div class="input-group date form_datetime">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-time"></i>
                                        </span>														
                                        <input class="form-control" id="dailyNewsPublishDateTime" value="" name="dailyNewsPublishDateTime" readonly=""/>
                                    </div>
                                    <span class="labels" id="dailyNewsPublishDateTime_status"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">огноо засагдсан:</label>
                                <div class="col-sm-4">
                                    <label>
                                        <input class="tc tc-switch tc-switch-5" type="checkbox" name="is_newsdate_changed" data-target="thisNewsWillUpdated" id="is_newsdate_changed"/>
                                        <span class="labels"></span>
                                    </label>														
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">hidden areas:</label>
                                <div class="col-sm-4">
                                    <label>
                                        <input type="text" name="selected_daily_news_menu" id="selected_daily_news_menu" readonly/><br/>
                                        <input type="text" name="selected_daily_news_code" id="selected_daily_news_code" readonly/><br/>
                                    </label>														
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary" name="btn_updateOldDailyNewsDetails">хадгалах</button>
                                        <button type="submit" class="btn">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['btn_updateOldDailyNewsDetails'])) {
                            echo($cpAdmin->keepOldNewsOfDaily($_POST, $_FILES));
                        }
                        ?>
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
                        <div id="dailyNewsPreviewTableContainer"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>