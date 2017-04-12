<?php
$body_script = "add_system_user";

$page_code = "system_user_creator";

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
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-6">
            <div class="portlet">
                <div class="portlet-heading dark">
                    <div class="portlet-title">
                        <h4>шинэ зохиол нэмэх</h4>
                    </div>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion" href="#ft-2"><i class="fa fa-chevron-down"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="ft-2" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        <form action="" class="form-horizontal" role="form" method="POST">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">username:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" maxlength="20" name="newUsername" id="newUsername" placeholder="системд нэвтрэх нэр бичнэ">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">password:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" maxlength="15" name="newUserPassword" id="newUserPassword" placeholder="нууц үг бичнэ">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Овог Нэр:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" maxlength="100" name="newRealName" id="newRealName" placeholder="зохиолчийн овог нэрийг бичнэ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">сэтгүүлчийн тухай товч:</label>
                                <div class="col-sm-8">
                                    <textarea id="previewNoteAuthor" name="previewNoteAuthor" class="form-control" placeholder="250 тэмдэгт дотор бичнэ үү." rows="6" maxlength="250"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Email хаяг:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" maxlength="100" name="newUserEmail" id="newUserEmail" placeholder="зохиолчийн EMail хаяг бичнэ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Website URL:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" maxlength="100" name="newUserWebsiteURL" id="newUserWebsiteURL" placeholder="зохиолчийн Website хаяг бичнэ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Facebook URL:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" maxlength="100" name="newUserFacebookURL" id="newUserFacebookURL" placeholder="зохиолчийн Facebook хаяг бичнэ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Twitter URL:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" maxlength="100" name="newUserTwitterURL" id="newUserTwitterURL" placeholder="зохиолчийн Twitter хаяг бичнэ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Youtube URL:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" maxlength="100" name="newUserYoutubeURL" id="newUserYoutubeURL" placeholder="зохиолчийн Youtube хаяг бичнэ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Google+ URL:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" maxlength="100" name="newUserGoogleURL" id="newUserGoogleURL" placeholder="зохиолчийн Google+ хаяг бичнэ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">байдал:</label>
                                <div class="col-sm-8">
                                    <select class="form-control selectpicker" name="newUserStatus" id="newUserStatus">
                                        <option value="none">- сонгох -</option>
                                        <option value="0">Идэвхгүй</option>
                                        <option value="1">Идэвхтэй</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">түвшин:</label>
                                <div class="col-sm-8">
                                    <select class="form-control selectpicker" name="newUserLevel" id="newUserLevel">
                                        <option value="none">- сонгох -</option>
                                        <option value="1">зохиолч</option>
                                        <option value="2">админ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">хуудас дээр гаргах:</label>
                                <div class="col-sm-8">
                                    <select class="form-control selectpicker" name="newUserOnPage" id="newUserOnPage">
                                        <option value="none">- сонгох -</option>
                                        <option value="0">Үгүй</option>
                                        <option value="1">Тийм</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" name="btn_InsertNewAuthorUser" class="btn btn-primary" >Хадгалах</button>
                                        <button type="submit" class="btn">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['btn_InsertNewAuthorUser'])) {
                            //echo("<pre>");
                            //print_r($_POST);
                            //echo("</pre>");
                            echo($cpSecret->insertNewAuthorUser($_POST));
                        }
                        ?>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>