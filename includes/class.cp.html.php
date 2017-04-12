<?php

namespace mongoliax\includes\cp_HTML;

class cp_HTML {

    private $options = "";
    private $salt = ".ecd8ea1E3F745eC329f";
    public $loggedUserDetails = "";
    private $space2 = "&nbsp&nbsp";
    private $space5 = "&nbsp&nbsp&nbsp&nbsp&nbsp";
    private $space10 = "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
    private $itemOnPerPage = "10";
    private $dbMan;
    private $tool;
    public $site_params;
    public $App_Config;
    public $reg_countries;
    public $sys_trans_lang;

    public function __construct() {
        $this->dbMan = new \mongoliax\includes\MysqliDb\MysqliDb();
        $this->tool = new \mongoliax\includes\tools\tools();
    }

    public function hello() {
        return "<b>hi delger</b>";
    }

    public function checkNewNewsSlugExistanceAjax($newNewsRawSlug) {
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("post_slug", $newNewsRawSlug);
        $mglx_post = $this->dbMan->getOne('mglx_post', 'post_slug');
        $countRecords = $this->dbMan->count;
        if ($countRecords > 0 && !empty($mglx_post)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function printNewsSiteMenusForEdit() {
        $backdata = "<select class='form-control selectpicker' name='select_NewsSite_Category' id='select_NewsSite_Category'>";
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        //$this->dbMan->where("code_news", $editComNewsCode);
        $news_categories = $this->dbMan->get('mglx_category');
        $countRecords = $this->dbMan->count;
        $backdata .= "<option value='none'> - сонгох - </option>";
        $i = 0;
        while ($countRecords > $i) {
            $backdata .= "<option value='{$news_categories[$i]['code_cat']}'>" . $news_categories[$i]['cat_name'] . "</option>";
            $i++;
        }
        $backdata .= "</select>";
        return $backdata;
    }

    public function loadJSON_siteNewsMenus($newsSiteMenuCode) {
        //$this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("code_cat", $newsSiteMenuCode);
        $mglx_category = $this->dbMan->get('mglx_category');
        $countRecords = $this->dbMan->count;
        return json_encode($mglx_category);
    }

    private function nn_has_children($rows, $id) {
        foreach ($rows as $row) {
            if ($row['cat_parent'] == $id)
                return true;
        }
        return false;
    }

    private function nn_build_menu($rows, $parent = 0) {
        $result = "<ul>";
        foreach ($rows as $row) {
            if ($row['cat_parent'] == $parent) {
                if ($this->nn_has_children($rows, $row['code_cat'])) {
                    $result .= "<li class='ulliCPProductMenu'><a href='#'>{$row['cat_name']}</a><label><input type='checkbox' class='tc tc-success' name='name_type[1][]' value='" . $row['code_cat'] . "'><span class='labels'></span></label>";
                    //$result .= "<li class='ulliCPProductMenu'><a>{$row['cat_name']}</a>";
                    //$result.= "<li>{$row['cat_name']}";
                    $result.= $this->nn_build_menu($rows, $row['code_cat']);
                } else {
                    $result .= "<li class='ulliCPProductMenu'><a href='#'>{$row['cat_name']}</a><label><input type='checkbox' class='tc tc-success' data-newsm02='{$row['code_cat']}' name='name_type[1][]' value='" . $row['code_cat'] . "'><span class='labels'></span></label>";
                }
                $result.= "</li>";
            }
        }
        $result.= "</ul>";

        return $result;
    }

    public function printNewsMenusCategories() {
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        //$this->dbMan->where("cat_parent", 8000);
        $mglx_category = $this->dbMan->get('mglx_category');
        $countRecords = $this->dbMan->count;

        return $this->nn_build_menu($mglx_category, 8000);
    }

    // ---- old --- old --- old --- old --- ---- old --- old --- old --- old --- ---- old --- old --- old --- old --- ---- old --- old --- old --- old --- ---- old --- old --- old --- old --- 
    public function loadAjaxStoreDataByCode($selectedStoreCode) {
        $this->dbMan->where("code_store", $selectedStoreCode);
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $gobi_stores = $this->dbMan->getOne('gobi_stores');

        if (empty($gobi_stores)) {
            return "no";
        } else {
            return json_encode($gobi_stores);
        }
    }

    public function ajaxLoadKeptModelData($givenModelNumber) {
        $params = Array($givenModelNumber, $this->App_Config['current_web_app_lang']);
        $queryString = "SELECT * FROM gobi_models WHERE model_number1 = ? AND lang_iso_code = ?";
        $gobi_models = $this->dbMan->rawQuery($queryString, $params);
        $countRecords = $this->dbMan->count;
        $i = 0;
        while ($i < $countRecords) {
            //$backdata[$i]['value'] = $gobi_models[$i]['model_number1'];
            //$backdata[$i]['label'] = $gobi_models[$i]['model_number1'];
            $i++;
        }

        return json_encode($gobi_models);
    }

    public function loadAllModelNumbersIntoAutoComplete() {
        $backdata = array();
        $params = Array($this->App_Config['current_web_app_lang']);
        $queryString = "SELECT code_model, model_number1 FROM gobi_models WHERE lang_iso_code = ?";
        $gobi_models = $this->dbMan->rawQuery($queryString, $params);
        $countRecords = $this->dbMan->count;
        $i = 0;
        while ($i < $countRecords) {
            $backdata[$i]['value'] = $gobi_models[$i]['model_number1'];
            $backdata[$i]['label'] = $gobi_models[$i]['model_number1'];
            $i++;
        }
        return json_encode($backdata);
    }

    public function printStoreTableByCountry($selectedCountryCode) {
        $backdata = "<table class='table table-bordered table-hover tc-table'>
        <thead>
            <tr>
                <th>Shop name</th>
                <th class='hidden-xs'>Country</th>
                <th class='hidden-xs'>Clicks</th>
                <th class='hidden-xs'><i class='fa fa-dollar'></i> Earned</th>
                <th class='hidden-xs'>Translate</th>
                <th class='col-medium center'>Action</th>
            </tr>
        </thead>
        <tbody>";

        $selectedCountryCode = strtolower($selectedCountryCode);
        $this->dbMan->where("store_country_code", $selectedCountryCode);
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $gobi_stores = $this->dbMan->get('gobi_stores');
        $countRecords = $this->dbMan->count;

        $i = 0;

        while ($i < $countRecords) {
            $backdata .= "        <tr>
            <td>{$gobi_stores[$i]['store_name']}</td>
            <td class='hidden-xs'>{$gobi_stores[$i]['store_country_code']}</td>
            <td class='hidden-xs'>387</td>
            <td class='hidden-xs'>$70</td>
            <td class='hidden-xs'><span class='label label-paid arrowed-in-right arrowed-in'>Yes</span></td>
            <td class='col-medium center'>
                <div class='btn-group btn-group-xs '>
                    <a href='#' onclick='loadCountryDataByCodeJS(\"" . $gobi_stores[$i]['code_store'] . "\")' class='btn btn-inverse'><i class='fa fa-pencil icon-only'></i></a>
                    <a href='#' class='btn btn-danger'><i class='fa fa-times icon-only'></i></a>
                </div>	
            </td>
        </tr>";
            $i++;
        }

        $backdata .= "</tbody>
</table>";

        return $backdata;
    }

    public function printOptionsModolCollection() {
        $backdata = "<select class='form-control selectpicker' name='model_collection' id='model_collection'>";
        $backdata .= "<option value='none'> - сонгох - </option>";

        //$this->dbMan->where("color_fashion", $givenColorCode);
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $gobi_collections = $this->dbMan->get('gobi_collections');
        $countRecords = $this->dbMan->count;
        $i = 0;
        while ($i < $countRecords) {
            $backdata .= "<option value='" . $gobi_collections[$i]['code_coll'] . "'>" . $gobi_collections[$i]['coll_name'] . "</option>";
            $i++;
        }

        $backdata .= "</select>";
        return $backdata;
    }

    public function ajaxLoadCheckModelExistenceByCode($givenModelNumber) {
        $this->dbMan->where("model_number1", $givenModelNumber);
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $gobi_models = $this->dbMan->getOne('gobi_models');

        if (empty($gobi_models)) {
            return "no";
        } else {
            return "yes";
        }
    }

    public function ajaxLoadCheckWhatColorCode($givenColorCode) {
        $backdata = "";

        $this->dbMan->where("color_fashion", $givenColorCode);
        //$this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $gobi_models = $this->dbMan->get('gobi_colors');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($i < $countRecords) {
            $backdata .= "<div style='width:40px; height:40px; margin:10px; background:" . $gobi_models[$i]['color_computer'] . ";'></div>";
            $i++;
        }

        if ($i == 0) {
            $backdata .= "<b>no color found.</b>";
        }

        return $backdata;
    }

    public function printOldCatalogHTML() {
        $backdata = "<select class='form-control selectpicker' name='chooseOldCatalog' id='chooseOldCatalog'>";
        $backdata .= "<option value='none'> - сонгох - </option>";

        //$this->dbMan->orderBy("size_guide_updated", "DESC");
        //$this->dbMan->where("code_model_ref", $selectedReferCode);
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $gobi_catalogs = $this->dbMan->get('gobi_catalogs');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($i < $countRecords) {
            $backdata .= "<option value='{$gobi_catalogs[$i]['code_camp_cat']}'>{$gobi_catalogs[$i]['camp_cat_name']}</option>";
            //$backdata .= "<option value='{$gobi_model_sizes[$i]['code_size_guide']}'>{$gobi_model_sizes[$i]['size_guide_title']}</option>";
            $i++;
        }

        $backdata .= "</select>";

        return $backdata;
    }

    public function printOldLookbookHTML() {
        $backdata = "<select class='form-control selectpicker' name='chooseOldCatalog' id='chooseOldCatalog'>";
        $backdata .= "<option value='none'> - сонгох - </option>";

        //$this->dbMan->orderBy("size_guide_updated", "DESC");
        //$this->dbMan->where("code_model_ref", $selectedReferCode);
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $gobi_lookbooks = $this->dbMan->get('gobi_lookbooks');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($i < $countRecords) {
            $backdata .= "<option value='{$gobi_lookbooks[$i]['code_lookbook']}'>{$gobi_lookbooks[$i]['lookbook_name']}</option>";
            //$backdata .= "<option value='{$gobi_model_sizes[$i]['code_size_guide']}'>{$gobi_model_sizes[$i]['size_guide_title']}</option>";
            $i++;
        }

        $backdata .= "</select>";

        return $backdata;
    }

    public function ajaxLoadModelSizeGuideByCode($selectedSizeCode) {
        //$this->dbMan->orderBy("size_guide_updated", "DESC");
        $this->dbMan->where("code_size_guide", $selectedSizeCode);
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $gobi_model_sizes = $this->dbMan->getOne('gobi_model_sizes');
        //$countRecords = $this->dbMan->count;

        $gobi_model_sizes['size_guide_content'] = $this->tool->cn_htmltrans($gobi_model_sizes['size_guide_content'], "html");

        return json_encode($gobi_model_sizes);
    }

    public function printAllModelSizeGuidesHTML() {
        $backdata = "<select class='form-control selectpicker' name='selected_model_size' id='selected_model_size'>
    <option value='none'> - select - </option>";

        $this->dbMan->orderBy("size_guide_updated", "DESC");
        //$this->dbMan->where("code_model_ref", $selectedReferCode);
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $gobi_model_sizes = $this->dbMan->get('gobi_model_sizes');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($i < $countRecords) {
            $backdata .= "<option value='{$gobi_model_sizes[$i]['code_size_guide']}'>{$gobi_model_sizes[$i]['size_guide_title']}</option>";
            $i++;
        }

        $backdata .= "</select>";

        return $backdata;
    }

    public function printNewModelCareGuides() {
        $backdata = "<select class='form-control selectpicker' name='selectedCareGuideCode' id='selectedCareGuideCode'>
    <option value='none'>- хоосон -</option>";

        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        //$this->dbMan->where("color_fashion", $model_color);
        $gobi_model_cares = $this->dbMan->get('gobi_model_cares');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($i < $countRecords) {
            $backdata .= "<option value='{$gobi_model_cares[$i]['code_care_guide']}'>" . $gobi_model_cares[$i]['care_guide_title'] . "</option>";
            $i++;
        }

        $backdata .="</select>";

        return $backdata;
    }

    public function printNewModelSizeGuides() {
        $backdata = "<select class='form-control selectpicker' name='selectedSizeGuideCode' id='selectedSizeGuideCode'>
    <option value='none'>- хоосон -</option>";

        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        //$this->dbMan->where("color_fashion", $model_color);
        $gobi_model_sizes = $this->dbMan->get('gobi_model_sizes');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($i < $countRecords) {
            $backdata .= "<option value='{$gobi_model_sizes[$i]['code_size_guide']}'>" . $gobi_model_sizes[$i]['size_guide_title'] . "</option>";
            $i++;
        }

        $backdata .="</select>";

        return $backdata;
    }

    public function ajaxLoadModelReferenceData($selectedReferCode) {
        $backdata = "";

        /*
          gobi_model_reference

          code_model_ref 	smallint(4)	No
          model_ref_title 	varchar(500)	No
          model_ref_content 	text	No
          lang_iso_code 	char(2)	No
          model_ref_registered 	datetime	No
          model_ref_updated
         */

        //$this->dbMan->orderBy("job_opento", "DESC");
        $this->dbMan->where("code_model_ref", $selectedReferCode);
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $gobi_model_reference = $this->dbMan->getOne('gobi_model_reference');
        $countRecords = $this->dbMan->count;

        if (!empty($gobi_model_reference)) {
            $gobi_model_reference['model_ref_content'] = $this->tool->cn_htmltrans($gobi_model_reference['model_ref_content'], "html");
            return json_encode($gobi_model_reference);
        } else {
            return $backdata;
        }
    }

    public function ajaxLoadModelCareGuide($selectedCareCode) {
        $backdata = "";


        //$this->dbMan->orderBy("job_opento", "DESC");
        $this->dbMan->where("code_care_guide", $selectedCareCode);
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $gobi_model_cares = $this->dbMan->getOne('gobi_model_cares');
        $countRecords = $this->dbMan->count;

        if (!empty($gobi_model_cares)) {
            $gobi_model_cares['care_guide_content'] = $this->tool->cn_htmltrans($gobi_model_cares['care_guide_content'], "html");
            return json_encode($gobi_model_cares);
        } else {
            return $backdata;
        }
    }

    private function getComputerColor($model_color) {
        $backdata = "#FFFFFF";
        $this->dbMan->where("color_fashion", $model_color);
        $gobi_colors = $this->dbMan->get('gobi_colors', 1);
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($countRecords > $i) {
            $backdata = $gobi_colors[$i]['color_computer'];
            $i++;
        }

        return $backdata;
    }

    private function cn_has_children($rows, $id) {
        foreach ($rows as $row) {
            if ($row['cat_parent'] == $id)
                return true;
        }
        return false;
    }

    public function loadAjaxJDailyNewsTableByCode($dailyNewsMenuCode) {

        return $dailyNewsMenuCode . " in func";
    }

    public function printNewsSiteMenuForEdit() {
        $backdata = "";
        foreach ($this->reg_countries as $key => $value) {
            $backdata .= "<div class='form-group'>
                        <label class='col-sm-4 control-label'>{$value}</label>
                        <div class='col-sm-8'>
                            <input type='text' class='form-control' name='lang_news_menu_{$key}' id='lang_news_menu_{$key}' placeholder='{$value} хэлээр бичнэ үү'>
                        </div>
                    </div>";
        }

        return $backdata;
    }

    public function printOldJobsHTML() {
        $backdata = "<table id='SampleDT' class='datatable table table-hover table-striped table-bordered tc-table'>
                        <thead>
                            <tr>
                                <th>код</th>
                                <th>нэр</th>
                                <th>тайлбар</th>
                                <th>нээх огноо</th>
                                <th>хаах огноо</th>
                                <th>үйлдэл</th>
                            </tr>
                        </thead>
                        <tbody>";

        //$this->dbMan->where("code_cat", $newsSiteMenuCode);
        $this->dbMan->orderBy("job_opento", "DESC");
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $hr_jobs = $this->dbMan->get('hr_jobs');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($countRecords > $i) {
            $backdata .= "<tr>
                            <td>{$hr_jobs[$i]['code_job']}</td>
                            <td>{$hr_jobs[$i]['job_name']}</td>
                            <td>{$hr_jobs[$i]['job_intro']}</td>
                            <td>" . $this->tool->date_formatter($hr_jobs[$i]['job_openfrom'], "Y.m.d") . "</td>
                            <td>" . $this->tool->date_formatter($hr_jobs[$i]['job_opento'], "Y.m.d") . "</td>
                            <td>
                                <div class='btn-group btn-group-xs '>
                                    <a class='btn btn-inverse' onclick='loadAjaxJobData(\"" . $hr_jobs[$i]['code_job'] . "\")'><i class='fa fa-pencil icon-only'></i></a>
                                    <a class='btn btn-danger'><i class='fa fa-times icon-only'></i></a>
                                </div>
                            </td>
                        </tr>";
            $i++;
        }

        $backdata .= "</tbody>
                    </table>";
        return $backdata;
    }

    public function loadAjaxJobDataByCode($loadJobCode) {
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("code_job", $loadJobCode);
        $hr_jobs = $this->dbMan->getOne('hr_jobs');
        //$countRecords = $this->dbMan->count;
        $hr_jobs['job_requirement'] = $this->tool->cn_htmltrans($hr_jobs['job_requirement'], "html");
        return json_encode($hr_jobs);
    }

    private function cn_build_menu($rows, $parent = 0) {
        $result = "<ul>";
        foreach ($rows as $row) {
            if ($row['cat_parent'] == $parent) {
                if ($this->cn_has_children($rows, $row['code_cat'])) {
                    $result .= "<li class='ulliCPProductMenu'><a href='#'>{$row['cat_name']}</a><label><input type='checkbox' class='tc tc-success' name='name_type[1][]' value='" . $row['code_cat'] . "'><span class='labels'></span></label>";
                    //$result .= "<li class='ulliCPProductMenu'><a>{$row['cat_name']}</a>";
                    //$result.= "<li>{$row['cat_name']}";
                    $result.= $this->cn_build_menu($rows, $row['code_cat']);
                } else {
                    $result .= "<li class='ulliCPProductMenu'><a href='#'>{$row['cat_name']}</a><label><input type='checkbox' class='tc tc-success' name='name_type[1][]' value='" . $row['code_cat'] . "'><span class='labels'></span></label>";
                }
                $result.= "</li>";
            }
        }
        $result.= "</ul>";

        return $result;
    }

    public function getEditCompanyNewsDetails($editComNewsCode) {
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("code_news", $editComNewsCode);
        $company_news = $this->dbMan->getOne('company_news');
        $countRecords = $this->dbMan->count;
        $company_news['news_content'] = $this->tool->cn_htmltrans($company_news['news_content'], "html");
        return json_encode($company_news);
    }

    public function printAjaxLoadedCompanyNewsByCategory($codeCatNews) {
        $singleImageX150 = "<img src='" . WEBROOT . $this->App_Config['server_images_path'] . "no_image_275x275.jpg" . "' width='100' height='100'/>";
        $backdata = "<table id='SampleDT' class='datatable table table-hover table-striped table-bordered tc-table'>
                        <thead>
                            <tr>
                                <th>{$this->sys_trans_lang['code']}</th>
                                <th>{$this->sys_trans_lang['name']}</th>
                                <th>{$this->sys_trans_lang['net_slug']}</th>
                                <th>{$this->sys_trans_lang['picture']}</th>
                                <th>status</th>
                                <th>{$this->sys_trans_lang['action']}</th>
                            </tr>
                        </thead>
                        <tbody>";

        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("code_cat", $codeCatNews);
        $company_news = $this->dbMan->get('company_news');
        $countRecords = $this->dbMan->count;

        $i = 0;

        while ($countRecords > $i) {

            $arr_news_images = explode(";", $company_news[$i]['news_images'], -1);
            $hhh = "";
            if (isset($arr_news_images[0])) {
                $singleImage = $arr_news_images[0];
                $uploadedYearMonth = substr($singleImage, 9, 7);
                $singleImage = explode(".", $singleImage);
                //PIC_COMP_2015_05_1432603753_267269_X150.jpg
                $singleImageX150 = $singleImage[0] . "_X150" . "." . $singleImage[1];
                $singleImageX150 = $hhh = $this->App_Config['media_root_path'] . $this->App_Config['company_img_upload_path'] . $uploadedYearMonth . "/" . $singleImageX150;
                $singleImageX150 = "<img src='" . $singleImageX150 . "' width='100' height='100'/>";
            }

            $backdata .= "<tr>
                            <td>{$company_news[$i]['code_news']}</td>
                            <td>{$company_news[$i]['news_title']}</td>
                            <td>{$company_news[$i]['news_slug']}</td>
                            <td>{$singleImageX150}</td>
                            <td>" . $this->getCompanyNewsTranslationStatus($company_news[$i]['code_news']) . "</td>
                            <td class='col-medium center'>
                                <div class='btn-group btn-group-xs '>
                                    <a class='btn btn-inverse' onclick='editCompanyNewsByCode(\"" . $company_news[$i]['code_news'] . "\")'><i class='fa fa-pencil icon-only'></i></a>
                                    <a href='#' class='btn btn-danger'><i class='fa fa-times icon-only'></i></a>
                                </div>	
                            </td>
                        </tr>";
            $i++;
        }

        $backdata .= "</tbody>
                </table>";

        return $backdata;
    }

    private function getCompanyNewsTranslationStatus($companyNewsCode) {
        $backdata = "";
        //$this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("code_news", $companyNewsCode);
        $company_news = $this->dbMan->get('company_news');
        $countRecords = $this->dbMan->count;
        //$app_config['web_active_langues']
        $i = 0;
        while ($countRecords > $i) {
            if (in_array($company_news[$i]['lang_iso_code'], $this->App_Config['web_active_langues'])) {
                $flagPath = WEBROOT . $this->App_Config['server_images_path'] . "flags/flag_32_" . $company_news[$i]['lang_iso_code'] . ".png";
                if ($company_news[$i]['is_trans_approved'] == 1) {
                    $backdata .= "<span style='background: #72af46; padding:3px 3px 6px; margin:0 4px 0 0;'><img src='{$flagPath}'/></span>";
                } else {
                    $backdata .= "<span style='background: #03A9F4; padding:3px 3px 6px; margin:0 4px 0 0;'><img src='{$flagPath}'/></span>";
                }
            }

            $i++;
        }

        return $backdata;
    }

    private function getOfficerUserLevel($officerCodeValue) {
        //$officerCodeValue
        //$this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("code_officer", $officerCodeValue);
        $mglx_officers = $this->dbMan->getOne('mglx_officers');
        $countRecords = $this->dbMan->count;
        if ($countRecords > 0 && !empty($mglx_officers)) {
            return $mglx_officers['officer_level'];
        } else {
            return 0;
        }
    }

    public function printAllDailyNewsByMenu($checkedNewsMenuCode, $officerCodeValue) {
        $offUserLevel = $this->getOfficerUserLevel($officerCodeValue);
        $backdata = "<table class='table table-bordered table-hover tc-table'>
                        <thead>
                            <tr>
                                <th class='hidden-xs'>код</th>
                                <th class='hidden-xs'>гарчиг</th>
                                <th class='hidden-xs'>Нет хаяг</th>
                                <th class='hidden-xs'>зураг</th>
                                <th class='hidden-xs'>бүсад орчуулга</th>
                                <th class='hidden-xs'>байдал</th>
                                <th class='col-medium center'>үйлдэл</th>
                            </tr>
                        </thead>
                        <tbody>";

        $this->dbMan->orderBy("post_updated", "DESC");
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        if ($offUserLevel < 3) {
            $this->dbMan->where("code_officer", $officerCodeValue);
        }
        $this->dbMan->where("code_cat", $checkedNewsMenuCode);
        $news_daily = $this->dbMan->get('mglx_post');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($countRecords > $i) {
            $dnews_images = explode(";", $news_daily[$i]['post_images'], -1);
            $dnewsImage_src = "";
            if (isset($dnews_images[0])) {
                $dnews_first_image = $dnews_images[0];
                $tempDNewsImageParts = explode(".", $dnews_first_image);
                $dnewsFirstImageName = $tempDNewsImageParts[0] . "_X200" . "." . $tempDNewsImageParts[1];

                //PIC_NEWS_2015_05_1432701053_101948_X150.jpg
                $dnewsImageNameYearMonth = substr($dnewsFirstImageName, 9, 7);
                $dnewsImage_src = $this->App_Config['media_root_path'] . $this->App_Config['mglx_post_img_url_path'] . $dnewsImageNameYearMonth . "/" . $dnewsFirstImageName;
            }

            $newsTranslationStatus = "";
            $newsTranslationStatusText = "";

            if ($news_daily[$i]['post_translated'] == 1) {
                $newsTranslationStatus = "<a class='btn btn-success' onclick='shiftDailyNewsInEditForm(\"" . $news_daily[$i]['code_post'] . "\")' title='орчуулага баталлагдсан. хэрэв батлагдаагүй бол дарж засварт оруулан уу'><i class='fa fa-check'></i></a>";
                $newsTranslationStatusText = "<span class='label label-paid arrowed-in-right arrowed-in'>translated</span>";
            } else if ($news_daily[$i]['post_translated'] == 0) {
                $newsTranslationStatus = "<a class='btn btn-info' onclick='shiftDailyNewsInLiveForm(\"" . $news_daily[$i]['code_post'] . "\")' title='орчуулага дуусаагүй. хэрэв дууссан бол дарж батална уу'><i class='fa fa-pencil-square-o'></i></a>";
                $newsTranslationStatusText = "<span class='label label-pending arrowed-in-right arrowed-in'>not translated</span>";
            }

            $backdata .= "<tr>
                            <td class='hidden-xs'>{$news_daily[$i]['code_post']}</td>
                            <td class='hidden-xs'>{$news_daily[$i]['post_title']}</td>
                            <td class='hidden-xs'>{$news_daily[$i]['post_slug']}</td>
                            <td class='hidden-xs'><img src='{$dnewsImage_src}'/></td>
                            <td class='hidden-xs'>" . $this->getNewsTranslationStatus($news_daily[$i]['code_post']) . "</td>
                            <td class='hidden-xs'>{$newsTranslationStatusText}</td>
                            <td class='col-medium center'>
                                <div class='btn-group btn-group-xs '>
                                    <a class='btn btn-inverse' onclick='loadEditDailyNewsByCode(\"" . $news_daily[$i]['code_post'] . "\")'><i class='fa fa-pencil icon-only'></i></a>
                                    <a class='btn btn-danger' onclick='deleteThisDailyNewsByCode(\"" . $news_daily[$i]['code_post'] . "\")'><i class='fa fa-times icon-only'></i></a>
                                    {$newsTranslationStatus}
                                </div>	
                            </td> 
                        </tr>";
            $i++;
        }

        $backdata .= "</tbody>
                </table>";

        return $backdata;
    }

    private function getNewsTranslationStatus($dailyNewsCode) {
        $backdata = "";
        //$this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("code_post", $dailyNewsCode);
        $news_daily = $this->dbMan->get('mglx_post');
        $countRecords = $this->dbMan->count;
        //$app_config['web_active_langues']
        $i = 0;
        while ($countRecords > $i) {
            if (in_array($news_daily[$i]['lang_iso_code'], $this->App_Config['web_active_langues'])) {
                $flagPath = WEBROOT . $this->App_Config['server_images_path'] . "flags/flag_32_" . $news_daily[$i]['lang_iso_code'] . ".png";
                if ($news_daily[$i]['post_translated'] == 1) {
                    $backdata .= "<span style='background: #72af46; padding:3px 3px 6px; margin:0 4px 0 0;'><img src='{$flagPath}'/></span>";
                } else {
                    $backdata .= "<span style='background: #03A9F4; padding:3px 3px 6px; margin:0 4px 0 0;'><img src='{$flagPath}'/></span>";
                }
            }

            $i++;
        }

        return $backdata;
    }

    public function loadDailyNewsDataByAjaxData($tobeLoadCode) {
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("code_post", $tobeLoadCode);
        $news_daily = $this->dbMan->getOne('mglx_post');
        $countRecords = $this->dbMan->count;

        $news_daily['post_content'] = $this->tool->cn_htmltrans($news_daily['post_content'], "html");
        return json_encode($news_daily);
    }

    public function printCompanyNewNewsCategories() {
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        //$this->dbMan->where("cat_parent", 7000);
        $company_categories = $this->dbMan->get('company_categories');
        $countRecords = $this->dbMan->count;

        return $this->cn_build_menu($company_categories, 7000);
    }

    public function printCompanyMenuHTML() {
        $backdata = "";

        $backdata = "<select class='form-control selectpicker' name='new_company_menu' id='new_company_menu'>
            <option value='none'> - сонгох - </option>";

        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("has_child", 1);
        $company_categories = $this->dbMan->get('company_categories');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($i < $countRecords) {

            $backdata .= "<option value='" . $company_categories[$i]['code_cat'] . "'>" . $company_categories[$i]['cat_name'] . "</option>";

            $i++;
        }

        $backdata .= "</select>";
        return $backdata;
    }

    private function proView_has_children($rows, $id) {
        foreach ($rows as $row) {
            if ($row['product_menu_parent'] == $id)
                return true;
        }
        return false;
    }

    private function proView_build_menu($rows, $parent = 0) {
        $result = "<optgroup label='Picnic'>";
        foreach ($rows as $row) {
            if ($row['product_menu_parent'] == $parent) {
                //echo("---------{$row['product_menu_name']}<br/>");
                if ($this->proView_has_children($rows, $row['code_product_menu'])) {
                    //$result .= "<li class='ulliCPProductMenu'>{$row['product_menu_name']}";
                    //echo("---------{$row['product_menu_name']}<br/>");
                    //$result .= $this->proView_has_children($rows, $row['code_product_menu']);
                } else {
                    //$result .= "<li class='ulliCPProductMenu'>{$row['product_menu_name']}";
                    //echo("---------------------------<br/>");

                    $result .= "<option>{$row['product_menu_name']}</option>";
                }
                //$result .= "</li>";
                //$result .= "</optgroup>";
            }
        }
        $result .= "</optgroup>";

        //echo($result);
        return $result;
    }

    public function printViewProductsByCategory() {

        /*
          <select class='form-control selectpicker'>
          <optgroup label='Picnic'>
          <option>Mustard</option>
          <option>Ketchup</option>
          <option>Relish</option>
          </optgroup>
          <optgroup label='Camping'>
          <option>Tent</option>
          <option>Flashlight</option>
          <option>Toilet Paper</option>
          <option>Toilet Paper</option>
          <option>Toilet Paper</option>
          <option>Toilet Paper</option>
          <option>Toilet Paper</option>
          <option>Toilet Paper</option>
          <option>Toilet Paper</option>
          </optgroup>
          </select>
         */


        $backdata = "<select class='form-control selectpicker'>";
        //$this->dbMan->orderBy("code_comp_type ", "ASC");
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        //$this->dbMan->where("model_number1", $modelNumber);
        $product_menus = $this->dbMan->get('product_menus');
        $countRecords = $this->dbMan->count;

        //echo("<pre>");
        //print_r($product_menus);
        //echo("</pre>");

        $backdata .= $this->proView_build_menu($product_menus, 5000);


        $backdata .= "</select>";

        return $backdata;
    }

    private function getProductImage($productCodeImage) {
        $this->dbMan->where("code_image", $productCodeImage);
        $cols = array("image_path");
        $products_images = $this->dbMan->getOne('products_images', $cols);
        return $products_images;
    }

    public function printFilteredProducts() {
        $backdata = "";
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        //$this->dbMan->where("model_number1", $modelNumber);
        $gobi_products = $this->dbMan->get('gobi_products');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($countRecords > $i) {
            $productImagePath = $this->getProductImage($gobi_products[$i]['code_image'])['image_path'];

            $tempProductImage = explode(".", $productImagePath);

            if (count($tempProductImage) > 1) {
                //PIC_PRO_2015_07_1437981111_243349_X1050

                $imageUploadYearMonth = substr($tempProductImage[0], 8, 7);

                $productFirstImageName = $tempProductImage[0] . "_X150" . "." . $tempProductImage[1];
                $productImage_10 = $this->App_Config['media_root_path'] . $this->App_Config['product_img_upload_path'] . $imageUploadYearMonth . "/" . $productFirstImageName;
            } else {
                $productImage_10 = WEBROOT . $this->App_Config['server_images_path'] . "no_picture.jpg";
            }

            $backdata .= "
            <tr>
                <td>{$gobi_products[$i]['product_title']}</td>
                <td><img src='{$productImage_10}' width='150'></td>
                <td>{$gobi_products[$i]['product_slug']}</td>
                <td><span class='label label-paid arrowed-in-right arrowed-in'>идэвхтэй</span></td>
                <td class='col-medium center'>
                    <div class='btn-group btn-group-xs '>
                        <a href='?page=edit_product&proCode={$gobi_products[$i]['code_product']}' class='btn btn-inverse'><i class='fa fa-pencil icon-only'></i></a>
                        <a class='btn btn-danger' onclick='removeThisProduct({$gobi_products[$i]['code_product']})'><i class='fa fa-times icon-only'></i></a>
                        <a class='btn btn-info' onclick='updateThisProductPrice({$gobi_products[$i]['code_product']})'><i class='fa fa-usd icon-only'></i></a>    
                    </div>	
                </td>
            </tr>";

            $i++;
        }

        return $backdata;
    }

    public function printMenuForEdit() {
        $backdata = "";
        foreach ($this->reg_countries as $key => $value) {
            $backdata .= "<div class='form-group'>
                        <label class='col-sm-4 control-label'>{$value}</label>
                        <div class='col-sm-8'>
                            <input type='text' class='form-control' name='lang_menu_{$key}' id='lang_menu_{$key}' placeholder='{$value} хэлээр бичнэ үү'>
                        </div>
                    </div>";
        }
        return $backdata;
    }

    public function loadCompanyMenuData($editCompanyMenuCode) {
        //SELECT * FROM product_menus WHERE code_product_menu = 5010
        $this->dbMan->where("code_cat", $editCompanyMenuCode);
        $company_categories = $this->dbMan->get('company_categories');
        $countRecords = $this->dbMan->count;

        return json_encode($company_categories);
    }

    public function isSlugExists($newProductSlug) {
        /*
          //$this->dbMan->orderBy("code_comp_type ", "ASC");
          $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
          $this->dbMan->where("product_slug", $newProductSlug);
          $this->dbMan->where("product_slug LIKE '{$newProductSlug}%'");
          //$db->where ("id != companyId");

          $cols = Array ("product_slug");
          $gobi_products = $this->dbMan->getOne('gobi_products', $cols);
          $countRecords = $this->dbMan->count;
         */

//$newProductSlug .= "-" . $this->App_Config['product_link_slug_ext'] . rand(100, 999);
        $tempSlug = $newProductSlug . "-" . $this->App_Config['product_link_slug_ext'] . rand(100, 999);

        $params = Array($tempSlug);
        $gobi_products = $this->dbMan->rawQuery("SELECT product_slug FROM gobi_products WHERE product_slug LIKE '{$tempSlug}%' AND lang_iso_code = '{$this->App_Config['current_web_app_lang']}'", NULL);
        $countRecords = $this->dbMan->count;

//echo("<pre>");
//print_r($gobi_products);
//echo("</pre>");

        if ($countRecords > 0) {
            $newProductSlug = $this->isSlugExists($newProductSlug);
        } else {
            return $tempSlug;
        }
    }

    public function fillNewProductForm($modelNumber) {
        $backdata = "will be null";
        //$this->dbMan->orderBy("code_comp_type ", "ASC");
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("model_number1", $modelNumber);
        $gobi_models = $this->dbMan->get('gobi_models', 1);
        $countRecords = $this->dbMan->count;


        if (!empty($gobi_models)) {
            $modelImageName = $gobi_models[0]['model_image']; //PIC_MOD_2015_04
            $modelImageNameYearMonth = substr($modelImageName, 8, 7);

            //$gobi_models[0]['model_name'] = $modelImageNameYearMonth;

            $gobi_models[0]['model_image'] = $this->App_Config['media_root_path'] . $this->App_Config['model_img_upload_path'] . $modelImageNameYearMonth . "/" . $modelImageName;


            $model_colors = explode(",", $gobi_models[0]['model_colors']);


            $colorModel = "";

            foreach ($model_colors as $model_color) {
                $numSignModelColor = $this->getComputerColor($model_color);
                $noNumSignModelColor = substr($numSignModelColor, 1);
                $colorModel .= "<div data-color-type='" . $noNumSignModelColor . "' style='background:" . $numSignModelColor . ";' class='smallcolor'></div>";
            }

            $gobi_models[0]['computer_colors'] = $colorModel;

            //<div data-color-type='364698' style='background:#364698' class='smallcolor'></div>
            //$gobi_models[0]['model_name'] = $gobi_models[0]['model_image'];

            /*
              $i = 0;
              while ($i < $countRecords) {
              $optNameLabel = $gobi_models[$i]['name_type_name'];
              $optNameCode = $gobi_models[$i]['code_comp_type'];
              $backdata .= "<option value='" . $optNameCode . "'>" . $optNameLabel . "</option>";
              $i++;
              }
             */

            return json_encode($gobi_models);
        } else {
            return "null";
        }
    }

    public function loadProductImagesToSortPanel($codeImage) {
        $backdata = "";

        $this->dbMan->orderBy("image_order", "ASC");
        $this->dbMan->where("code_image", $codeImage);
        $products_images = $this->dbMan->get('products_images');
        $countRecords = $this->dbMan->count;

        $backdata .= "<ul id='image_boxes'>";

        $i = 0;
        while ($countRecords > $i) {
            $modelImageName = $products_images[$i]['image_path'];
            $productID_Image = $products_images[$i]['id_image'];
            $productCode_Image = $products_images[$i]['code_image'];

            $perProductImageParts = explode(".", $modelImageName);
            $perProductImage = $perProductImageParts[0] . "_X150" . "." . $perProductImageParts[1];

            $modelImageNameYearMonth = substr($modelImageName, 8, 7);
            $perProductImageLast = $this->App_Config['media_root_path'] . $this->App_Config['product_img_upload_path'] . $modelImageNameYearMonth . "/" . $perProductImage;


            //PIC_PRO_2015_05_1431590513_707129.jpg
            //PIC_PRO_2015_05_1431767249_316659_X150.jpg


            $backdata .= "<li class='image_box'><span onclick='removeProductSingleImage(\"" . $productID_Image . "\", \"" . $productCode_Image . "\")' title='" . $productID_Image . " дугаартай зургийг устгах үйлдэл' class='productImageRemover'>X</span> <img src='" . $perProductImageLast . "' class='sortable_boxes'/></li>";

            $i++;
        }

        $backdata .= "</ul>";

        return $backdata;
    }

    private function has_children($rows, $id) {
        foreach ($rows as $row) {
            if ($row['product_menu_parent'] == $id)
                return true;
        }
        return false;
    }

    private function build_menu($rows, $parent = 0, $isRootCheck, $proCodeMenu) {
        $result = "<ul class='ulCPProductMenu'>";
        foreach ($rows as $row) {
            //echo($ro w[' product_menu_parent']);
            if ($row['product_menu_parent'] == $parent) {
                //$result .= "<li class='   ulliCPProductMenu'><a href='?id = {$row['code_product_menu']}'>{$row['product_menu_name']}</a><label><input type='checkbox' class='tc tc-success'><span class='labels'></span></label>";
                if ($this->has_children($rows, $row['code_product_menu'])) {

                    if ($isRootCheck) {
                        $result .= "<li class='ulliCPProductMenu'><a href='#'>{$row['product_menu_name']}</a><label><input type='checkbox' class='tc tc-success' name='name_type[1][]' value='" . $row['code_product_menu'] . "'><span class='labels'></span></label>";
                    } else {
                        $result .= "<li class='ulliCPProductMenu'><a>{$row['product_menu_name']}</a>";
                    }

                    $result .= $this->build_menu($rows, $row['code_product_menu'], $isRootCheck, $proCodeMenu);
                } else {
                    if (!empty($proCodeMenu)) {
                        $result .= "<li class='ulliCPProductMenu'><a href='#'>{$row['product_menu_name']}</a><label><input type='checkbox' class='tc tc-success' name='name_type[1][]' value='" . $row['code_product_menu'] . "' " . ($proCodeMenu == $row['code_product_menu'] ? "checked" : "") . "><span class='labels'></span></label>";
                    } else {
                        $result .= "<li class='ulliCPProductMenu'><a href='#'>{$row['product_menu_name']}</a><label><input type='checkbox' class='tc tc-success' name='name_type[1][]' value='" . $row['code_product_menu'] . "'><span class='labels'></span></label>";
                    }
                }
                $result .= "</li>";
            }
        }
        $result .= "</ul>";

        return $result;
    }

    public function getSingleModelDetailsByLang($modelCode, $iso_lang) {
        $this->dbMan->where("lang_iso_code", $iso_lang);
        $this->dbMan->where("code_model", $modelCode);
        $gobi_models = $this->dbMan->getOne('gobi_models');
        $countRecords = $this->dbMan->count;
        return $gobi_models;
    }

    public function getSingleProductDetailsByLang($proCode, $iso_lang) {
        $this->dbMan->where("lang_iso_code", $iso_lang);
        $this->dbMan->where("code_product", $proCode);
        $gobi_products = $this->dbMan->getOne('gobi_products');
        $countRecords = $this->dbMan->count;
        return $gobi_products;
    }

    public function getProductMenus($isRootCheck = FALSE, $proCodeMenu = NULL) {
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        //$this->dbMan->where("product_menu_parent ", 5000);
        $product_menus = $this->dbMan->get('product_menus');
        $countRecords = $this->dbMan->count;

        //echo("<pre>");
        //echo($this->App_Config['current_web_app_lang']);
        //print_r($product_menus);
        //echo("</pre>");
        return $this->build_menu($product_menus, 5000, $isRootCheck, $proCodeMenu);
    }

    private function getCatalogOptions($parentCompCode) {
        $backdata1 = "";
        $this->dbMan->orderBy("code_comp_type ", "ASC");
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("parent_name_type", $parentCompCode);
        $gobi_name_types1 = $this->dbMan->get('gobi_name_types');
        $countRecords1 = $this->dbMan->count;

        $i1 = 0;
        while ($i1 < $countRecords1) {
            $optNameLabel = $gobi_name_types1[$i1]['name_type_name'];
            $optNameCode = $gobi_name_types1[$i1]['code_comp_type'];
            $backdata1 .= "<option value='" . $optNameCode . "'>" . $optNameLabel . "</option>";
            $i1++;
        }
        return $backdata1;
    }

    public function getCatalogForModelHTML() {
        $backdata = "";

        $this->dbMan->orderBy("code_comp_type ", "ASC");
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("parent_name_type", 1000);
        $gobi_name_types = $this->dbMan->get('gobi_name_types');
        $countRecords = $this->dbMan->count;

        $i = 0;

        $backdata .= "<select class='form-control selectpicker' name='select_name_catalog' id='select_name_catalog'>";
        while ($i < $countRecords) {
            $optGroupLabel = $gobi_name_types[$i]['name_type_name'];
            $backdata .= "<optgroup label='" . $optGroupLabel . "'>";

            $backdata .= $this->getCatalogOptions($gobi_name_types[$i]['code_comp_type']);

            $backdata .= "</optgroup>";
            $i++;
        }

        $backdata .= "</select>";
        return $backdata;
    }

    public function printLastItemsBox($gapaMenuID) {
        $backdata = "<ul class='lastestPriceList'>";

        $params = Array($gapaMenuID);
        $sellers_price = $this->dbMan->rawQuery("SELECT SEPR.*, USMA.market_name FROM sellers_price AS SEPR INNER JOIN son_menus AS SOMS INNER JOIN child_menus AS CHME INNER JOIN supermarkets AS USMA
        ON SOMS.parentmenu_code = ? AND SOMS.sonmenu_code = CHME.sonmenu_code AND CHME.childmenu_code = SEPR.childmenu_code AND SEPR.market_code = USMA.market_code
        ORDER BY item_updated DESC LIMIT 20", $params);
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($i < $countRecords) {
            $priceItemPhoto = "";
            if (empty($sellers_price[$i]['item_photo'])) {
                $priceItemPhoto = $this->site_params['site_web_url'] . "images/no_photo.png";
            } else {
                $priceItemPhoto = $this->site_params['product_image_path'] . $sellers_price[$i]['moba_code'] . "/" . "thumble_" . $sellers_price[$i]['item_photo'];
                if (!is_file($priceItemPhoto)) {
                    $priceItemPhoto = $this->site_params['site_web_url'] . "images/no_photo.png";
                } else {
                    $priceItemPhoto = $this->site_params['web_product_image_path'] . $sellers_price[$i]['moba_code'] . "/" . "thumble_" . $sellers_price[$i]['item_photo'];
                }
            }

            $span1 = "<a href='#'><span class='lastProductIMG'><img src='" . $priceItemPhoto . "' /></span></a>";

            $span2 = "<span class='lastProductName'>" . $sellers_price[$i]['item_name'] . "</span>";

            $span3 = "<span class='lastProductMarket'>" . $sellers_price[$i]['market_name'] . "</span>";

            //$span4 = "<span class='lastProductPrice'>" . $sellers_price[$i]['seller_price'] . "</span>";

            $span5 = "<span class='lastProductDate'>" . (new DateTime($sellers_price[$i]['item_updated']))->format('Y.m.d') . "</span>";

            $span6 = "<a href=''><span class='viewLastProductDate'>үзэх</span></a>";

            $backdata .= "<li> " . $span1 . $span2 . $span3 . $span5 . $span6 . "</li>";
            $i++;
        }

        $backdata .= "</ul>";
        return $backdata;
    }

    private function calculateAveragePrice($weekly_prices) {
//average
        $backPrice = 0;
        $dividerCount = 0;
        foreach ($weekly_prices as $perPrice) {
            $hasAverageValues = strpos($perPrice['wepi_price'], "-");

            if ($hasAverageValues === false) {
                $backPrice += intval($perPrice['wepi_price']);
                $dividerCount++;
            } else {
                $wepi_price_pieces = explode("-", $perPrice['wepi_price']);
//echo $wepi_price_pieces[0];
//echo $wepi_price_pieces[1];

                $backPrice += (intval($wepi_price_pieces[0]) + intval($wepi_price_pieces[1]));
                $dividerCount+=2;
            }

//echo $perPrice['wepi_p0rice'];
        }

        if ($dividerCount > 0) {
            $backPrice = round(($backPrice / $dividerCount));
        }

        return $backPrice; //round(($backPrice / $dividerCount));
    }

    private function getJsonChartPricesDates($dataPoints_code) {
        $backArray1 = array();
        $this->dbMan->orderBy("wede_registered", "ASC");
        $weekly_dates = $this->dbMan->get('weekly_dates');
        $countRecordsJ = $this->dbMan->count;

        $j = 0;
        while ($countRecordsJ > $j) {
            $this->dbMan->orderBy("wepi_registered", "DESC");
            $this->dbMan->where("chart_id", $dataPoints_code);

            $wedeDate1 = $weekly_dates[$j]['wede_registered'] . " 00:00:00";
            $wedeDate2 = $weekly_dates[$j]['wede_registered'] . " 23:59:59";

            $this->dbMan->where('wepi_registered', Array($wedeDate1, $wedeDate2), 'BETWEEN');
            $weekly_prices = $this->dbMan->get('weekly_prices');
            $countRecords5 = $this->dbMan->count;
            $tempArr2 = array();

            $d = new DateTime($weekly_dates[$j]['wede_registered']);

//$timestamp = $d->getTimestamp(); // Unix timestamp
            $formatted_date = $d->format('Y m d'); // 2003-10-16
//$tempArr2["x"] = strtotime($weekly_dates[$j]['wede_registered']);
            $tempArr2["x"] = $weekly_dates[$j]['wede_registered'];


            $tempArr2["y"] = $this->calculateAveragePrice($weekly_prices);

            $backArray1[$j] = $tempArr2;
            $j++;
        }

        return $backArray1;
    }

    public function printChartsJSON_vegetable() {
        $backArray = array();
        $this->dbMan->orderBy("wecha_registered", "DESC");
        $this->dbMan->where("wecha_isload", 1);
        $this->dbMan->where("wety_code", "vt");
        $weekly_charts = $this->dbMan->get('weekly_charts');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($countRecords > $i) {
            $temparr = array();
            $temparr['type'] = $weekly_charts[$i]['wecha_type'];
            $temparr['showInLegend'] = $weekly_charts[$i]['wecha_showInLegend'];
            $temparr['name'] = $weekly_charts[$i]['wecha_name'];
            $temparr['lineThickness'] = $weekly_charts[$i]['wecha_lineThickness'];
            $temparr['markerType'] = $weekly_charts[$i]['wecha_markerType'];
            $temparr['color'] = $weekly_charts[$i]['wecha_color'];
            $dataPoints_code = $weekly_charts[$i]['wecha_dataPoints'];
            $temparr['dataPoints'] = $this->getJsonChartPricesDates($dataPoints_code);

            $backArray[$i] = $temparr;

            $i++;
        }
        return json_encode($backArray);
    }

    public function printColor() {
        $backdata = "";
        /*
          gobi_colors
          Column	Type	Null	Default 	Comments 	MIME
          id_color 	int(11)	No
          color_fashion 	char(10)	Yes 	NULL
          color_computer 	char(10)	Yes 	NULL
          color_registered 	datetime	Yes 	NULL
          color_updated
         */

//$this->dbMan->orderBy("wede_registered", "DESC");
        $gobi_colors = $this->dbMan->get('gobi_colors');
        $countRecords = $this->dbMan->count;

        /*
          if ($countRecords > 0) {
          //$d = new DateTime($weekly_dates[0]['wede_registered']);
          //$timestamp = $d->getTimestamp(); // Unix timestamp
          //$formatted_date = $d->format('Y-m-d'); // 2003-10-16
          //$backdata = "<span class='priceListDays'>шинэчилсэн: " . $d->format("Y") . " он " . $d->format("m") . " сарын " . $d->format("d") . "</span>";

          echo("<div>" . $gobi_colors[][] . " - <span style='background:#000000;width:50px;height:50px;'></span></div>");
          }
         * 
         */

        $i = 0;
        while ($countRecords > $i) {

            $backdata .= "<div>" . $gobi_colors[$i]['color_fashion'] . " - <div style='background:" . $gobi_colors[$i]['color_computer'] . ";width:50px;height:50px;'></div></div>";
            $i++;
        }



        return $backdata;
    }

    public function printChartsJSON() {
        $backArray = array();
        $this->dbMan->orderBy("wecha_registered", "DESC");
        $this->dbMan->where("wecha_isload", 1);
        $this->dbMan->where("wety_code", "mt");
        $weekly_charts = $this->dbMan->get('weekly_charts');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($countRecords > $i) {
            $temparr = array();
            $temparr['type'] = $weekly_charts[$i]['wecha_type'];
            $temparr['showInLegend'] = $weekly_charts[$i]['wecha_showInLegend'];
            $temparr['name'] = $weekly_charts[$i]['wecha_name'];
            $temparr['lineThickness'] = $weekly_charts[$i]['wecha_lineThickness'];
            $temparr['markerType'] = $weekly_charts[$i]['wecha_markerType'];
            $temparr['color'] = $weekly_charts[$i]['wecha_color'];
            $dataPoints_code = $weekly_charts[$i]['wecha_dataPoints'];
            $temparr['dataPoints'] = $this->getJsonChartPricesDates($dataPoints_code);

            $backArray[$i] = $temparr;

            $i++;
        }
        return json_encode($backArray);
    }

    public function printPublishedDate() {
//<span class="priceListDays">шинэчилсэн: 2015 он 1 сарын 30</span>
        $this->dbMan->orderBy("wede_registered", "DESC");
        $weekly_dates = $this->dbMan->get('weekly_dates', 1);
        $countRecords = $this->dbMan->count;

        if ($countRecords > 0) {
            $d = new DateTime($weekly_dates[0]['wede_registered']);
//$timestamp = $d->getTimestamp(); // Unix timestamp
//$formatted_date = $d->format('Y-m-d'); // 2003-10-16
            $backdata = "<span class='priceListDays'>шинэчилсэн: " . $d->format("Y") . " он " . $d->format("m") . " сарын " . $d->format("d") . "</span>";
        }

        return $backdata;
    }

    public function printPublicPricesList($priceType, $tabColos, $scrollOrder) {
        $backdata = "<div id='" . $scrollOrder . "' class='scroll-text'><ul class='" . $tabColos . "'>";

        $this->dbMan->orderBy("wepi_registered", "DESC");
        $this->dbMan->where("wepi_type", $priceType);
        $nowDate = date("Y-m-d H:i:s");
        $this->dbMan->where("wepi_deadline", $nowDate, ">");

        $weekly_prices = $this->dbMan->get('weekly_prices');
        $countRecords = $this->dbMan->count;
//echo($countRecords."<br/>");
        $i = 0;
        if ($countRecords > 0) {
            while ($i < $countRecords) {
                $backdata .= "<li><span>" . $this->getMarketName($weekly_prices[$i]['market_code']) . "</span>-<span>" . $weekly_prices[$i]['wepi_name'] . "</span><span>" . $weekly_prices[$i]['wepi_price'] . "</span></li>";
                $i++;
            }
        } else {
            $backdata .= "<li><span>мэдээлэл алга байна</span></li>";
        }
        $backdata .= "</ul></div>";
        return $backdata;
    }

    private function getMarketName($marketCode) {
        $backdata = "none";
        $this->dbMan->where("market_code", $marketCode);
        $supermarkets = $this->dbMan->get('supermarkets', 1);
        $countRecords = $this->dbMan->count;
        $i = 0;
        while ($i < $countRecords) {
            $backdata = $supermarkets[$i]['market_name'];
            $i++;
        }
        return $backdata;
    }

    public function printOneMarketDetailHTML($market_code) {
//$this->where("market_code", $market_code);
//$supermarkets = $this->getOne("supermarkets");
        return "<div class='textOnGlass'>" . $this->printUserLinkMap() . "</div>";
    }

    public function getFrontNotificationMessage($messageType = "alert", $messageValue = NULL) {
        if ($messageType === "success") {
            return "<div class='frontAlert frontSuccess'>" . $messageValue . "</div>";
        } else if ($messageType === "warning") {
            return "<div class='frontAlert frontWarning'>" . $messageValue . "</div>";
        } else {
            return "<div class='frontAlert frontDanger'>" . $messageValue . "</div>";
        }
    }

    public function getNotificationMessage($messageType = "alert", $messageValue = NULL) {
        if ($messageType === "success") {
            return "<div class='alert alert-success fade in '>
                        <i class='glyphicon glyphicon-info-sign'></i>
                        <button data-dismiss='alert' class='close' type='button'>×</button>" . $messageValue . "</div>";
        } else if ($messageType === "warning") {
            return "<div class='alert alert-warning fade in '>
    <i class='fa fa-cloud-download alert-icon'></i>
    <button data-dismiss='alert' class='close' type='button'>×</button>" . $messageValue . "</div>";
        } else {
            return "<div class='alert alert-danger fade in '>
                        <i class='glyphicon glyphicon-info-sign'></i>
                        <button data-dismiss='alert' class='close' type='button'>×</button>" . $messageValue . "</div>";
        }
    }

    private function fillPriceTestData() {
        $i = 0;

        $markets = array("SM776", "SM120", "SM538", "SM803", "SM740", "SM217", "SM139");
        $childmenus = array("CMN2158", "CMN2282", "CMN2306", "CMN2577", "CMN4311");

        while ($i < 700) {
            $data = Array(
                "market_code" => $markets[RAND(0, 6)],
                "childmenu_code" => $childmenus[RAND(0, 4)],
                "seller_price" => RAND(500, 50000),
                "price_registered" => date("Y-m-d H:i:s")
            );
            $id = $this->dbMan->insert('sellers_price', $data);
            $i++;
        }
    }

    private function getMenuGroups($parentmenuid, $gapa_name_en, $marketID) {
        $backdata = "";

        $this->dbMan->where("parentmenu_code", $parentmenuid);
        $son_menus = $this->dbMan->get('son_menus');
        $countRecords1 = $this->dbMan->count;

        $sonHTML = "";
        $i = 0;
        while ($i < $countRecords1) {
            $sonHTML .= "<h2 class='title'>" . $son_menus[$i]['sonmenu_name'] . "</h2>";
            $sonHTML .= $this->getSonMenusHTML($son_menus[$i]['sonmenu_code'], $marketID, $gapa_name_en);
            $i++;
        }

        $backdata .= $sonHTML;
        return $backdata;
    }

    private function showInfinityLoadDataOneChild($market, $childmenu, $page, $limit) {
        $backdata = array();
        if ($page == 1) {
            $start = 0;
        } else {
            $start = ($page - 1) * $limit;
        }

        $params = Array($market, $childmenu, $start, $limit);
        $sellers_price = $this->dbMan->rawQuery("SELECT * FROM sellers_price WHERE market_code = ? AND childmenu_code = ? ORDER BY price_registered LIMIT ?,  ?", $params);
        $countRecords1 = $this->dbMan->count;


        if ($countRecords1 > 0) {
            $i = 0;
            while ($countRecords1 > $i) {
                $backdata["code_" . $i] = $sellers_price[$i]['item_code'];
                $backdata["usercode_" . $i] = $sellers_price[$i]['moba_code'];
                $backdata["price_" . $i] = $sellers_price[$i]['seller_price'];
                $backdata["name_" . $i] = $sellers_price[$i]['item_name'];
                $backdata["photo_" . $i] = $sellers_price[$i]['item_photo'];
                $item_content = $sellers_price[$i]['item_content'];

                /* if (strlen($item_content) > 200) {
                  $backdata["content_" . $i] = $this->tool->cn_htmltrans(substr($item_content, 0, 200), "html") . "...";
                  } else {
                  $backdata["content_" . $i] = $this->tool->cn_htmltrans($item_content, "html");
                  } */

                $backdata["content_" . $i] = $this->tool->cn_htmltrans($item_content, "html");

                $backdata["phone_" . $i] = $sellers_price[$i]['seller_phone'];

                $i++;
            }
            $backdata["nextpage"] = ($page + 1);
            $backdata["isload"] = "true";
            $backdata["status"] = "progress";
        } else {

            $backdata["isload"] = "false";
            $backdata["status"] = "finished";
        }

        return $backdata;
    }

    public function printOneChildContentByOneMarket($market, $childmenu, $page) {
        $backdata = array();

        $backdata[$market] = $this->showInfinityLoadDataOneChild($market, $childmenu, $page, $this->itemOnPerPage);

        return json_encode($backdata);
    }

    private function printMarketDetails($marketCode) {
        $backdata = "мэдээлэл алга байна";

        $this->dbMan->where("market_code", $marketCode);
        $market_details = $this->dbMan->get("market_details", 1);
        $recordsCount = $this->dbMan->count;

        $i = 0;
        while ($recordsCount > $i) {
            $backdata = "нэр: " . $market_details[$i]["mardel_name"];

            $marketPicture = ($market_details[$i]["mardel_pictures"] == "" ? "images/no_photo.jpg" : "markets/images/" . $market_details[$i]["mardel_pictures"] );
            $marketMap = ($market_details[$i]["mardel_pictures"] == "" ? "images/no_photo.jpg" : "markets/images/" . $market_details[$i]["mardel_mappic"] );

            $backdata .= "<img src='" . WEBURL . $marketPicture . "' >";
            $backdata .= "<img src='" . WEBURL . $marketMap . "' >";
            $i++;
        }
        return $backdata;
    }

    public function printOneChildContentByOneMarketHTML($marketCode) {
        $backdata = "<div class = 'home_content_table'>";
        $headerNames = array("барааны нэр", "энэ захын мэдээлэл", "зарын хэсэг", "зарын хэсэг");

        $i = 0;
        while ($i < 4) {
            $tableHead = "";
            if ($i === 0) {
                $tableHead = "<div class='oneitemonmarket'>";
                $tableHead .= "<div class='box_header'>" . $headerNames[$i] . " </div>";
                $tableHead .= "<div id='box_" . $i . "'></div>";
            }

            if ($i === 1) {
                $tableHead = "<div class='oneitemonmarket marketInfo fixedFloat'>";
                $tableHead .= "<div class='box_header'>" . $headerNames[$i] . " </div>";
                $tableHead .= $this->printMarketDetails($marketCode);
            }

            if ($i === 2) {
                $tableHead = "<div class='oneitemonmarket fixedFloat'>";
                $tableHead .= "<div class='box_header'>" . $headerNames[$i] . " </div>";
                $tableHead .= "<img src='" . WEBURL . "banners/images/banner_00001.jpg' /><br/>";
            }

            if ($i === 3) {
                $tableHead = "<div class='oneitemonmarket fixedFloat'>";
                $tableHead .= "<div class='box_header'>" . $headerNames[$i] . " </div>";
                $tableHead .= "<img src='" . WEBURL . "banners/images/banner_00002.jpg' />";
            }

            $tableHead .= "</div>";

            $backdata .= $tableHead;
            $i++;
        }
        $backdata .= "</div>";
        return $backdata;
    }

    private function showInfinityLoadData($page, $limit, $marketID, $childMenuID) {
        $backdata = array();
        if ($page == 1) {
            $start = 0;
        } else {
            $start = ($page - 1) * $limit;
        }

//$params = Array(1, 'admin');
        $sellers_price = $this->dbMan->rawQuery("SELECT * FROM sellers_price WHERE market_code = '" . $marketID . "' AND childmenu_code = '" . $childMenuID . "' ORDER BY price_registered LIMIT " . $start . ", " . $limit . "", "");
        $countRecords1 = $this->dbMan->count;

        $i = 0;
        if ($countRecords1 > 0) {
            while ($i < $countRecords1) {
                $backdata["price_" . $i] = $sellers_price[$i]['seller_price'];
                $backdata["code_" . $i] = $sellers_price[$i]['item_code'];
                $backdata["name_" . $i] = $sellers_price[$i]['item_name'];
                $backdata["photo_" . $i] = $sellers_price[$i]['item_photo'];
                $backdata["updated_" . $i] = date("Y-m-d", strtotime($sellers_price[$i]['item_updated']));
                if (strlen($sellers_price[$i]['item_content']) > 200) {
//$backdata["content_" . $i] = $this->tool->cn_htmltrans(substr($sellers_price[$i]['item_content'], 0, 200), "html");
                    $backdata["content_" . $i] = "200 aas ix бө абрөах бөахлыбөа быөа быө абөа бө аыбө абы";
                } else {
//$backdata["content_" . $i] = $this->tool->cn_htmltrans($sellers_price[$i]['item_content'], "html");
                    $backdata["content_" . $i] = "200 aas baga  өа ыөа ыбөаыбө аыбөа бөа бөа бы өабыө ";
                }

                $backdata["phone_" . $i] = $sellers_price[$i]['seller_phone'];

                $i++;
            }
            $backdata["nextpage"] = ($page + 1);
            $backdata["isload"] = "true";
            $backdata["status"] = "progress";
        } else {
            $backdata["isload"] = "false";
            $backdata["status"] = "finished";
        }

        return $backdata;
    }

    public function printOneChildContentByAllMarket($childMenuID, $page) {
        $backdata = array();
//$this->dbMan->where("parentmenu_code", $parentMenu);
        $supermarkets = $this->dbMan->get('supermarkets');
        $countRecords = $this->dbMan->count;
        $i = 0;
        $perMarket = array();
        while ($i < $countRecords) {
            $marketID = $supermarkets[$i]['market_code'];
            $market_name = $supermarkets[$i]['market_name'];

            $perMarket[$marketID] = $this->showInfinityLoadData($page, $this->itemOnPerPage, $marketID, $childMenuID);
            $i++;
        }

        $backdata["markets"] = $perMarket;

        return json_encode($backdata);
    }

    public function printUserLinkMap() {
//sdfsd sdf asf asdf sdf sdf asd
        $homeLink = "<a href='" . WEBROOT . "'>эхлэл</a>";
        if ((isset($_REQUEST['supermenu']) && $_REQUEST['supermenu'] != "home")) {
            $this->dbMan->where("gapa_name_en", $_REQUEST['supermenu']);
            $gapa_menus = $this->dbMan->get('gapa_menus', 1);
//$countRecords = $this->dbMan->count;

            $superMenu = " >> <a href='" . WEBROOT . "menu/" . $gapa_menus[0]['gapa_name_en'] . "/'>" . $gapa_menus[0]['gapa_name'] . "</a>";

            $superMenuLink = $homeLink . $superMenu;

            if (isset($_REQUEST['childmenu']) && !isset($_REQUEST['market'])) {
                $this->dbMan->where("childmenu_code", $_REQUEST['childmenu']);
                $child_menus = $this->dbMan->get('child_menus', 1);
//$countRecords = $this->dbMan->count;
                return ($superMenuLink . " >> " . $child_menus[0]['childmenu_name'] . "");
            } else if (isset($_REQUEST['childmenu']) && isset($_REQUEST['market'])) {
                $this->dbMan->where("market_code", $_REQUEST['market']);
                $supermarkets = $this->dbMan->get('supermarkets', 1);
//$countRecords = $this->dbMan->count;
                $marketMenu = " >> <a href='" . WEBROOT . "market/" . $supermarkets[0]['market_code'] . "/'>" . $supermarkets[0]['market_name'] . "</a>";

                $superMenuLink = $homeLink . $marketMenu . $superMenu;

                if (isset($_REQUEST['childmenu'])) {
                    $this->dbMan->where("childmenu_code", $_REQUEST['childmenu']);
                    $child_menus = $this->dbMan->get('child_menus', 1);
//$countRecords = $this->dbMan->count;
                    return ($superMenuLink . " >> " . $child_menus[0]['childmenu_name'] . "");
                } else {
                    return $superMenuLink;
                }
            } else {
                return $superMenuLink;
            }
        } else {

            if (isset($_REQUEST['market'])) {
                $this->dbMan->where("market_code", $_REQUEST['market']);
                $supermarkets = $this->dbMan->get('supermarkets', 1);
//$countRecords = $this->dbMan->count;
                $marketMenu = " >> " . $supermarkets[0]['market_name'] . "";

                return $homeLink . $marketMenu;
            }
//return "no map links";
        }
//print_r($_GET);
    }

    public function printOneChildContentByAllMarketHTML() {
        $backdata = "<div class='whiteBackground'><div class='pagespan container_Horizontal'>
                        <div class='wrap_Horizontal'>
                            <div class='textOnGlass'>" . $this->printUserLinkMap() . "</div>

                            

                            <div class='frame_Horizontal' id='centered'>
                                <ul class='container_listUL' class='clearfix'>";

//$this->dbMan->where("sonmenu_code", $sonmenuid);
//$this->dbMan->orderBy("gapa_order ", "asc");
        $supermarkets = $this->dbMan->get('supermarkets');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($i < $countRecords) {
            $tableHead = "<li>";
            $marketID = $supermarkets[$i]['market_code'];
            $market_name = $supermarkets[$i]['market_name'];
            $tableHead .= "<div class='box_header'>" . $market_name . "</div>";
            $tableHead .= "<div><div id='box_" . $marketID . "'></div></div>";
            $tableHead .= "</li>";
            $backdata .= $tableHead;
            $i++;
        }

        $backdata .= "</ul>
                    </div>

                    <div class='controls_Horizontal'>
                        <button disabled='disabled' class='btn prev disabled'><i class='icon-chevron-left'></i> зүүн</button>
                        <button class='btn next'>баруун <i class='icon-chevron-right'></i></button>
                    </div>
                </div>
            </div></div>";
        return $backdata;
    }

    /* public function printOneChildContentByAllMarketHTML() {
      $backdata = "<div class = 'home_content_table'>";

      //$this->dbMan->where("sonmenu_code", $sonmenuid);
      //$this->dbMan->orderBy("gapa_order ", "asc");
      $supermarkets = $this->dbMan->get('supermarkets');
      $countRecords = $this->dbMan->count;

      //$tableBody = "<tr>";
      $i = 0;
      while ($i < $countRecords) {
      $tableHead = "<div class='onebyallmarket'>";
      $marketID = $supermarkets[$i]['market_code'];
      $market_name = $supermarkets[$i]['market_name'];
      $tableHead .= "<div class='box_header'>" . $market_name . "</div>";
      $tableHead .= "<div><div id='box_" . $marketID . "'></div></div>";
      $tableHead .= "</div>";
      $backdata .= $tableHead; // . $tableBody;
      $i++;
      }

      //$tableBody .= "</tr>";

      $backdata .= "</div>";
      return $backdata;
      } */

    public function printOneMarketContent($market) {
        $backdata = "<div class='whiteBackground'><div class='textOnGlass'>" . $this->printUserLinkMap() . "</div><div class = 'home_content_table'>";

//$this->dbMan->where("sonmenu_code", $sonmenuid);
        $this->dbMan->orderBy("gapa_order ", "asc");
        $gapa_menus = $this->dbMan->get('gapa_menus');
        $countRecords0 = $this->dbMan->count;

        $i = 0;
        $perDIV = "";
        while ($i < $countRecords0) {
            $perDIV = "<div class='allmenuonemarket'>";
//$backdata .= $gapa_menus[$i]['gapa_name']."<br/>";
            $gapa_code = $gapa_menus[$i]['gapa_code'];
            $gapa_name_en = $gapa_menus[$i]['gapa_name_en'];

            $perDIV .= "<div>" . $this->getMenuGroups($gapa_code, $gapa_name_en, $market) . "</div>";


            $perDIV .= "</div>";
            $backdata .= $perDIV;
            $i++;
        }


        $backdata .= "</div></div>";
        return $backdata;
    }

    private function getSonMenusHTML($sonmenuid, $marketID, $gapa_name_en) {
        $backdata = "<ul class='onePackageBox'>";

        $this->dbMan->where("sonmenu_code", $sonmenuid);
        $child_menus = $this->dbMan->get('child_menus');
        $countRecords2 = $this->dbMan->count;

        $i = 0;
        while ($i < $countRecords2) {

            $backdata .= "<li><a href = '" . WEBURL . "menu/" . $gapa_name_en . "/market/" . $marketID . "/chmenu/" . $child_menus[$i]['childmenu_code'] . "/' > " . $child_menus[$i]['childmenu_name'] . "</a></li>";
            $i++;
        }
        $backdata .= "</ul>";
        return $backdata;
    }

    public function printNewItemHTML($htmlTitle = "зах сонгох") {
        $backdata = "<label for='selectMarkets'>" . $htmlTitle . "</label>
                    <select class='form-control' id='selectMarkets' name='selectMarkets'>
                        <option value='none'> - сонгох - </option>";

        $supermarkets = $this->dbMan->get('supermarkets');
        $countRecords = $this->dbMan->count;
        $i = 0;

        while ($i < $countRecords) {
            $market_name = $supermarkets[$i]['market_name'];
            $market_code = $supermarkets[$i]['market_code'];

            $backdata .= "<option value='" . $market_code . "'>" . $market_name . "</option>";
            $i++;
        }

        $backdata .= "</select><p class='group_status'>та өөрийн ажилладаг худалдааны төвийг сонгоогүй байна.</p>";
        return $backdata;
    }

    private function getChildMenuOptions($someID) {
        $backdata = "";
        $this->dbMan->where("sonmenu_code", $someID);
        $child_menus = $this->dbMan->get('child_menus');
        $countRecords2 = $this->dbMan->count;

        $i = 0;
        while ($i < $countRecords2) {
            $backdata .= "<option value='" . $child_menus[$i]['childmenu_code'] . "' >" . $this->space10 . $child_menus[$i]['childmenu_name'] . "</option>";
//$backdata .= $this->getChildMenuOptions($child_menus[$i]['sonmenu_code']);
            $i++;
        }

        return $backdata;
    }

    private function getSonMenuOptions($gapaID) {
        $backdata = "";
        $this->dbMan->where("parentmenu_code", $gapaID);
        $son_menus = $this->dbMan->get('son_menus');
        $countRecords1 = $this->dbMan->count;

        $i = 0;
        while ($i < $countRecords1) {
            $backdata .= "<option value='" . $son_menus[$i]['sonmenu_code'] . "' disabled>" . $this->space5 . $son_menus[$i]['sonmenu_name'] . "</option>";
            $backdata .= $this->getChildMenuOptions($son_menus[$i]['sonmenu_code']);
            $i++;
        }

        return $backdata;
    }

    public function printNewItemContainsMenuHTML() {
        $backdata = "<label for='selectGroupItem'>бүлэг сонгох</label>
                    <select class='form-control' id='selectGroupItem' name='selectGroupItem'>
                        <option value='none'> - сонгох - </option>";

        $gapa_menus = $this->dbMan->get('gapa_menus');
        $countRecords = $this->dbMan->count;

        $i = 0;

        while ($i < $countRecords) {
            $backdata .= "<option value='" . $gapa_menus[$i]['gapa_code'] . "' disabled>" . $this->space2 . $gapa_menus[$i]['gapa_name'] . "</option>";
            $backdata .= $this->getSonMenuOptions($gapa_menus[$i]['gapa_code']);
            $i++;
        }


        $backdata .= "</select>";
        return $backdata;
    }

    public function printHomeContent($menuTypeCode, $supermenu) {
        $backdata = "<div class='whiteBackground'><div class='pagespan container_Horizontal'>
    <div class='wrap_Horizontal'>
        <div class='textOnGlass'>" . $this->printUserLinkMap() . "</div>

        <div class='scrollbar'>
            <div style='transform: translateZ(0px) translateX(114px); width: 190px;' class='handle'>
                <div class='mousearea'></div>
            </div>
        </div>

        <div class='frame_Horizontal' id='centered'>
            <ul class='container_listUL' class='clearfix'>";

//$this->dbMan->where("parentmenu_code", $parentMenu);
        $supermarkets = $this->dbMan->get('supermarkets');
        $countRecords = $this->dbMan->count;
        $htmlBox = "";

        $i = 0;
        while ($i < $countRecords) {
            $marketID = $supermarkets[$i]['market_code'];
            if ($menuTypeCode == "all") {
                $htmlBox = "<div class='box_header'>" . $supermarkets[$i]['market_name'] . "</div>";
                $htmlBox .= $this->getMenuGroups("PMN1111", $supermenu, $marketID);
                $htmlBox .= $this->getMenuGroups("PMN2222", $supermenu, $marketID);
                $htmlBox .= $this->getMenuGroups("PMN3333", $supermenu, $marketID);

                $backdata .= "<li>" . $htmlBox . "</li>";
            } else {
                $htmlBox = "<div class='box_header'>" . $supermarkets[$i]['market_name'] . "</div>";
                $backdata .= "<li >" . $htmlBox . $this->getMenuGroups($menuTypeCode, $supermenu, $marketID) . "</li>";
            }
            $i++;
        }

        $backdata .= "</ul>
        </div>

        <div class='controls_Horizontal'>
            <button disabled='disabled' class='btn prev disabled'><i class='icon-chevron-left'></i> зүүн</button>
            <button class='btn next'>баруун <i class='icon-chevron-right'></i></button>
        </div>
    </div>
</div></div>";

        return $backdata;
    }

    public function printMenu() {
        $backdata = "<li class = 'parent'><a href = '" . WEBURL . "menu/home/' > эхлэл</a><ul class = 'sub'>";
        $supermarkets = $this->dbMan->get('supermarkets');
        $countRow = $this->dbMan->count;
        $i = 0;
        while ($i < $countRow) {
            $backdata .= "<li><a href = '" . WEBURL . "market/" . $supermarkets[$i]['market_code'] . "/' > " . $supermarkets[$i]['market_name'] . "</a></li>";
//$backdata .= "<li><a href = '" . WEBROOT . "?market=" . $supermarkets[$i]['market_code'] . "' > " . $supermarkets[$i]['market_name'] . "</a></li>";
            $i++;
        }
        $backdata .= "</ul></li>";
        return $backdata;
    }

    private function getChildMenusHTML($sonmenuid, $parentlink) {
        $backdata = "";

        $this->dbMan->where("sonmenu_code", $sonmenuid);
        $child_menus = $this->dbMan->get('child_menus');
        $countRecords = $this->dbMan->count;
        $i = 0;
        while ($i < $countRecords) {
            $childmenu_code = $child_menus[$i]['childmenu_code'];
            $childmenu_name = $child_menus[$i]['childmenu_name'];

            $backdata .= "<li><a href = '" . WEBURL . "menu/" . $parentlink . "/chmenu/" . $childmenu_code . "/' > " . $childmenu_name . "</a></li>";
            $i++;
        }//&supermenu=" + $parentlink + "

        return $backdata;
    }

    public function printWideMenu($parentMenu, $parentName, $parentlink) {
        $backdata = "<li class = 'parent megamenu promo'>
                <a href = '" . WEBURL . "menu/" . $parentlink . "/' > " . $parentName . " <!--<span class = 'item-new'>New(5)</span>--></a>
                <ul class = 'sub'>
                <li class = 'sub-wrapper'>
                <div class = 'sub-list'>";

        $this->dbMan->where("parentmenu_code", $parentMenu);
        $son_menus = $this->dbMan->get('son_menus');
        $countRow = $this->dbMan->count;

        $i = 0;
        while ($i < $countRow) {
            $backdata .= "<div class = 'box closed'>
                <h2 class = 'title'>" . $son_menus[$i]['sonmenu_name'] . "</h2>
                <ul>";

            $backdata .= $this->getChildMenusHTML($son_menus[$i]['sonmenu_code'], $parentlink);

            $backdata .= "</ul>
                </div>";
            $i++;
        }



        $backdata .= "</div>

                <div class = 'promo-block'>
                <a href = '#'>
                <img src = '" . WEBURL . "images/megamenu-big.png' alt = '' height = '457' width = '253'>
                </a>
                </div>
                </li>
                </ul>
                </li>";
        return $backdata;
    }

    public function printLiveMenu($parentMenu, $parentName, $parentlink) {
        $backdata = "<li class = 'parent'><a href = '?supermenu=" . $parentlink . "' > " . $parentName . "<!--<span class = 'item-new'>New</span>--></a><ul class = 'sub'>";

        $this->dbMan->where("parentmenu_code", $parentMenu);
        $son_menus = $this->dbMan->get('son_menus');
        $countRow = $this->dbMan->count;

        $i = 0;
        while ($i < $countRow) {

            $backdata .= "<li><a href = '#'>" . $son_menus[$i]['sonmenu_name'] . "</a></li>";
            $i++;
        }

        $backdata .= "</ul></li>";
        return $backdata;
    }

}

?>