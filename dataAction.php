<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . "/cfg_mglx_admin.php");

$dataSwitch = $_POST['dataSwitch'];

switch ($dataSwitch) {
    case "CNSD267":
        if (isset($_POST['newNewsRawSlug'])) {
            echo($cpHTML->checkNewNewsSlugExistanceAjax($_POST['newNewsRawSlug']));
        }
        break;
    case "DTNBC986":
        if (isset($_POST['editorChoosenNewsCode']) && !empty($_POST['editorChoosenNewsCode']) && isset($_COOKIE[$app_config['user_cookie_name']]) && isset($_COOKIE[$app_config['user_cookie_officer_code']])) {
            $editorChoosenNewsCode = $_POST['editorChoosenNewsCode'];
            echo($cpAdmin->deleteSelectedNewsByCodeAJAX($editorChoosenNewsCode, $_COOKIE[$app_config['user_cookie_officer_code']]));
        } else {
            echo("got_error");
        }
        break;
    case "LNSM952":
        $newsSiteMenuCode = $_REQUEST['newsSiteMenuCode'];
        echo($cpHTML->loadJSON_siteNewsMenus($newsSiteMenuCode));
        break;
    //-------- old --------------------old old old
    case "LSDC631":
        $selectedStoreCode = $_POST['selectedStoreCode'];
        echo($cpHTML->loadAjaxStoreDataByCode($selectedStoreCode));
        break;
    case "LOSD309":
        $selectedCountryCode = $_POST['selectedCountryCode'];
        //echo($selectedCountryCode);
        echo($cpHTML->printStoreTableByCountry($selectedCountryCode));
        break;
    case "LMD001":
        $modelNumber = $_POST['modelNumber'];
        //echo("okay, your reach this. " . $modelNumber);
        echo($cpHTML->fillNewProductForm($modelNumber));
        break;
    case "CHPS001":
        $newProductSlug = $_POST['newProductSlug'];
        $newProductSlugGen = $cpHTML->isSlugExists($newProductSlug);
        echo($newProductSlugGen);
        break;
    case "RPI265":
        //removeCodeProduct
        if (isset($_POST['removeCodeProduct']) && !empty($_POST['removeCodeProduct'])) {
            echo($cpAdmin->removeProductAllInfo($_POST['removeCodeProduct']));
        } else {
            echo("мэдээлэл устгах үед алдаа гарсан.");
        }
        break;
    case "LEMD415":
        $editMenuCode = $_POST['editMenuCode'];

        echo($cpAdmin->loadProductMenuData($editMenuCode));

        break;
    case "SOI541":
        $orderedImagesHTML = $_POST['orderedImagesHTML'];
        $productCodeImage = $_POST['productCodeImage'];
        echo($cpAdmin->saveProductImagesOrdering($orderedImagesHTML, $productCodeImage));
        break;
    case "RPI785":
        $removeProductID_Image = $_POST['removeProductID_Image'];
        $removeProductCode_Image = $_POST['removeProductCode_Image'];
        //removeProductCode_Image: codeImage
        //data: {removeProductID_Image: idImage, dataSwitch: "RPI785"}

        echo($cpAdmin->removeProductSingleImage($removeProductID_Image, $removeProductCode_Image));

        break;
    case "ECNC245":
        $editComNewsCode = $_POST['editComNewsCode'];
        echo($cpHTML->getEditCompanyNewsDetails($editComNewsCode));
        break;
    case "VDNL846":
        if (isset($_POST['checkedNewsMenuCode']) && isset($_COOKIE[$app_config['user_cookie_officer_code']])) {
            $checkedNewsMenuCode = $_POST['checkedNewsMenuCode'];
            $officerCodeValue = $_COOKIE[$app_config['user_cookie_officer_code']];
            echo($cpHTML->printAllDailyNewsByMenu($checkedNewsMenuCode, $officerCodeValue));
            //echo("this is text news. " . $checkedNewsMenuCode);
        } else {
            echo("got_error");
        }
        break;
    case "LFDN440":
        $tobeLoadCode = $_REQUEST['tobeLoadCode'];
        echo($cpHTML->loadDailyNewsDataByAjaxData($tobeLoadCode));
        break;
    case "UWCL256":
        $tobeChangeLang = $_REQUEST['tobeChangeLang'];
        echo($cpSecret->checkControlPanelLanguage($tobeChangeLang));
        break;
    case "CUDV895":
        $pass_user_name = $_REQUEST["pass_user_name"];
        $pass_user_password = $_REQUEST["pass_user_password"];
        echo($cpSecret->checkThisUserHasValidAccess($pass_user_name, $pass_user_password));
        break;
    case "LCNE895":
        $clickedMenuCode = $_POST['clickedMenuCode'];
        echo($cpHTML->printAjaxLoadedCompanyNewsByCategory($clickedMenuCode));
        break;
    case "SDNLF983":
        $dailyNewsCode = $_POST['dailyNewsCode'];
        echo($cpAdmin->approveDailyNewsTranslation($dailyNewsCode));
        break;
    case "SDNEF230":
        $dailyNewsCode = $_POST['dailyNewsCode'];
        echo($cpAdmin->disApproveDailyNewsTranslation($dailyNewsCode));
        break;
    case "UWRHA365":
        $recoveryEmail = $_POST['recoveryEmail'];
        echo($cpSecret->checkAvialableToRecoverByEmail($recoveryEmail));
        break;
    case "LECMC388":
        $editCompanyMenuCode = $_POST['editCompanyMenuCode'];
        echo($cpHTML->loadCompanyMenuData($editCompanyMenuCode));
        break;
    case "LJDBC623":
        $loadJobCode = $_POST['loadJobCode'];
        echo($cpHTML->loadAjaxJobDataByCode($loadJobCode));
        break;
    case "LDNTD226":
        $dailyNewsMenuCode = $_POST['dailyNewsMenuCode'];
        //echo($cpHTML->loadAjaxJDailyNewsTableByCode($dailyNewsMenuCode));
        echo($cpHTML->printAllDailyNewsByMenu($dailyNewsMenuCode));
        break;
    case "LCNTD661":
        $companyNewsMenuCode = $_POST['companyNewsMenuCode'];
        echo($cpHTML->printAjaxLoadedCompanyNewsByCategory($companyNewsMenuCode));
        break;
    case "LMCG693":
        $selectedCareCode = $_POST['selectedCareCode'];
        echo($cpHTML->ajaxLoadModelCareGuide($selectedCareCode));
        break;
    case "LMRD228":
        $selectedReferCode = $_POST['selectedReferCode'];
        echo($cpHTML->ajaxLoadModelReferenceData($selectedReferCode));
        break;
    case "LMSGE105":
        $selectedSizeCode = $_POST['selectedSizeCode'];
        echo($cpHTML->ajaxLoadModelSizeGuideByCode($selectedSizeCode));
        break;
    case "CHME025":
        $givenModelNumber = $_POST['givenModelNumber'];
        echo($cpHTML->ajaxLoadCheckModelExistenceByCode($givenModelNumber));
        break;
    case "UPP895":
        $updateCodeProduct = $_POST['updateCodeProduct'];
        echo($cpAdmin->ajaxUpdateProductPriceByCode($updateCodeProduct));
        break;
    case "CGCC635":
        $givenColorCode = $_POST['givenColorCode'];
        echo($cpHTML->ajaxLoadCheckWhatColorCode($givenColorCode));
        break;
    case "LKMD968":
        $givenModelNumber = $_POST['givenModelNumber'];
        echo($cpHTML->ajaxLoadKeptModelData($givenModelNumber));
        break;
    default:
        break;
}
?>