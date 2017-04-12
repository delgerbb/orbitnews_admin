<?php
$body_script = "new_news_news";
$page_code = "new_news_creator";

$accessCodes = $_COOKIE[$app_config['user_cookie_access_codes']];
$accessCodes = explode($app_config['splitter_access_codes'], $accessCodes, -1);

if (!in_array($page_code, $accessCodes)) {
    echo($sys_trans_lang['your_access_denied_on_this_page']);
    return "";
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="portlet">
                <div class="portlet-heading dark">
                    <div class="portlet-title">
                        <h4>Шинэ мэдээ оруулах хэсэг</h4>
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
                                    <input type="text" class="form-control" maxlength="80" name="daily_news_name" id="daily_news_name" placeholder="энд мэдээний гарчиг бичнэ үү">
                                    <span class="labels" id="daily_news_name_status"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">мэдээний URL хаяг:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" maxlength="50" name="daily_news_slug" id="daily_news_slug" placeholder="мэдээний URL хаяг бичнэ. жишээ нь: hello-this-is-news-url гэх мэт">
                                    <span class="labels" id="daily_news_slug_status"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="daily_news_preview">мэдээний товч:</label>
                                <div class="col-sm-10">
                                    <textarea id="daily_news_preview" class="daily_news_preview" name="daily_news_preview" cols="60" rows="5"> </textarea><br/>
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
                                <label class="col-sm-2 control-label">мэдээ идэвхтэй:</label>
                                <div class="col-sm-4">
                                    <label>
                                        <input class="tc tc-switch tc-switch-5" type="checkbox" name="is_active_news" data-target="thisNewsWillActive" id="is_active_news"/>
                                        <span class="labels"></span>
                                    </label>														
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">коммент үзүүлэх:</label>
                                <div class="col-sm-4">
                                    <label>
                                        <input class="tc tc-switch tc-switch-5" type="checkbox" name="is_comment_active" data-target="thisNewsShowsComments" id="is_comment_active"/>
                                        <span class="labels"></span>
                                    </label>														
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">мэдээний tag-ууд</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" value="байгаль,технологи" data-role="tagsinput" name="post_tags" id="post_tags" />												
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">hidden areas:</label>
                                <div class="col-sm-4">
                                    <label>
                                        <input type="text" name="selected_daily_news_menu" id="selected_daily_news_menu" readonly/><br/>
                                    </label>														
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary" name="btn_SaveNewMongoliaxNews">хадгалах</button>
                                        <button type="submit" class="btn">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['btn_SaveNewMongoliaxNews']) && isset($_COOKIE[$app_config['user_cookie_officer_code']])) {
                            echo($cpAdmin->saveNewPostOfMongoliaX($_POST, $_FILES, $_COOKIE[$app_config['user_cookie_officer_code']]));
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>