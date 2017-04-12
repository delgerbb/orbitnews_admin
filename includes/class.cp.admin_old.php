<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class
 *
 * @author delgerbayar
 */
class cp_admin {

    //put your code here
    private $dbMan;
    public $reg_lang;
    public $App_Config;
    public $tls;

    //private $myDateTime;

    public function __construct() {
        $this->dbMan = new MysqliDb();
        $this->tls = new tools();
    }

    public function updateModelDetails($postData) {
        $backdata = "";
        $data = Array(
            'code_coll' => $postData['model_collection']
        );

        $this->dbMan->where('code_model', $postData['selectedModelCode']);
        //$this->dbMan->where('lang_iso_code', $postData['selectedModelLang']);
        if ($this->dbMan->update('gobi_models', $data)) {
            $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
        } else {
            $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
        }
        return $backdata;
    }

    public function insertNewForeignManagerDetails($postData) {
        $backdata = "";
        $managerRegions = "";
        $maxCode = $this->getMaxColumnValue("gobi_managers", "code_manager", $this->App_Config['forman_min_code']);
        $maxCode++;

        if (!empty($postData['new_manager_reqions'])) {
            $tempRegions = explode(",", $postData['new_manager_reqions']);
            foreach ($tempRegions as $value) {
                $managerRegions .= $value . ";";
            }
        }

        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'code_manager' => $maxCode,
                'manager_name' => $postData['new_manager_name'],
                'manager_job' => $postData['new_manager_job'],
                'manager_email' => $postData['new_manager_email'],
                'manager_photo' => $postData['new_manager_photo'],
                'manager_region' => $managerRegions,
                'lang_iso_code' => $lang,
                'manager_updated' => $this->dbMan->now(),
                'manager_registered' => $this->dbMan->now()
            );

            $new_manager_id = $this->dbMan->insert('gobi_managers', $data);
            if ($new_manager_id) {
                $backdata .= "ID:" . $new_manager_id . ' data is inserted.<br/>';
            } else {
                $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
            }
        }
        return $backdata;
    }

    public function insertNewCollectionDetails($postData) {
        $backdata = "";

        $maxCode = $this->getMaxColumnValue("gobi_collections", "code_coll", $this->App_Config['min_news_coll_code']);
        $maxCode++;

        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'code_coll' => $maxCode,
                'coll_name' => $postData['new_collection_name'],
                'coll_slug' => $postData['new_collection_slug'],
                'lang_iso_code' => $lang,
                'coll_updated' => $this->dbMan->now(),
                'coll_registered' => $this->dbMan->now()
            );

            $new_collection_id = $this->dbMan->insert('gobi_collections', $data);
            if ($new_collection_id) {
                $backdata .= "ID:" . $new_collection_id . ' data is inserted.<br/>';
            } else {
                $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
            }
        }
        return $backdata;
    }

    public function ajaxUpdateProductPriceByCode($CodeProduct) {

        $backdata = "";
        /*
          $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
          $this->dbMan->where("code_product", $CodeProduct);
          $gobi_products = $this->dbMan->getOne('gobi_products');
          $countRecords = $this->dbMan->count;

          $backdata .= $this->removeProductImageDetails($gobi_products['code_image'], NULL);
         * 
         * <b>Notice</b>:  Undefined variable: givenModelNumber in <b>C:\xampp\htdocs\gobi-admin\dataAction.php</b> on line <b>133</b><br />
          855 record(s) are updated. <br/>
         * 
         */

        $data = Array(
            'productprice_shows' => 1
        );

        $this->dbMan->where('code_product', $CodeProduct);
        //$this->dbMan->where('lang_iso_code', $postData['old_store_lang']);
        if ($this->dbMan->update('gobi_products', $data)) {
            $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
        } else {
            $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
        }

        return $backdata;
    }

    public function uploadHomePageImage($postData, $FilesValues) {
        $backMessage = "";
        foreach ($FilesValues as $value) {
            $message = $this->homepageFileUploader($value, $postData["newHomePageName"], $this->App_Config['homepage_img_upload_path'], TRUE, TRUE, "homepage_image_resizes");
            $backMessage .= $message;
        }
        return $backMessage;
    }

    /**
     * wild use file upload function.
     *
     * @param array  $uploadObject The name of the database table to work with.
     * @param string $newFileName   The number of rows total to return.
     * @param string $upload_path   The path where you want to upload images.
     * @param string $year_month   The value of current month and year conbination that used for saves in separate folders.
     * @param boolean $isResizeApproved   If its value is true then images resize specific sizes otherwise resizing will skip.
     * @param boolean $retainOrginalImage   If its value is true then orginal image will remain otherwise it will removed.
     *
     * @return string Contains the message of status that is result.
     */
    private function homepageFileUploader($uploadObject, $newFileName, $upload_path, $isResizeApproved = FALSE, $retainOrginalImage = TRUE, $resizes_images = "default_resizes_image") {
        $backdata = "";
        $dir_dest = DOCROOT . $upload_path;
        //$uploader_big = new upload_big();
        $handle = new Upload($uploadObject);
        if ($handle->uploaded) {
            // yes, the file is on the server
            // now, we start the upload 'process'. That is, to copy the uploaded file
            // from its temporary location to the wanted location
            // It could be something like $handle->Process('/home/www/my_uploads/');
            if ($retainOrginalImage) {
                $handle->file_new_name_body = $newFileName;
                $handle->Process($dir_dest);

                // we check if everything went OK
                if ($handle->processed) {
                    // everything was fine !
                    $backdata = '  <b>File uploaded with success</b><br/>';
                    //echo '  File: <a href="' . $dir_pics . '/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a>';
                    //echo '   (' . round(filesize($handle->file_dst_pathname) / 256) / 4 . 'KB)';
                } else {
                    // one error occured
                    $backdata = '  <b>File not uploaded to the wanted location.' . '  Error: ' . $handle->error . '<br/>';
                }
            }

            if ($isResizeApproved) {
                $orginImage_X_pixels = $handle->image_src_x;
                $orginImage_Y_pixels = $handle->image_src_y;

                //$currentTimeStamp = $this->getCurrentTimeStamp();
                //$newImageFileName = "PIC_" . $currentTimeStamp . "_" . rand(100, 999);
                //$smallest_X = 150;
                //$smaller_X = 450;
                //$small_X = 750;
                //$large_X = 1050;

                $imageResizes = $this->App_Config[$resizes_images]; // array(150, 450, 750, 1050);

                if ("collection_cover_resizes_image" == $resizes_images) {

                    foreach ($imageResizes as $key => $value) {
                        $handle->image_resize = true;
                        $handle->image_ratio_y = true;
                        //$handle->image_x                 = $smallest_X;
                        $handle->file_new_name_body = $newFileName;

                        if ($orginImage_X_pixels > $value) {
                            $handle->image_x = $value;
                        } else {
                            $handle->image_x = $orginImage_X_pixels;
                        }

                        //$dir_dest = $dir_dest . $key . "/";
                        $handle->Process($dir_dest . $key . "/");

                        if ($handle->processed) {
                            // everything was fine !
                            //echo '<p class="result">';
                            echo '  <br/><b>File resized success with ' . "_X" . $value . '</b><br />';
                            //echo '  <img src="' . $dir_pics . '/' . $handle->file_dst_name . '" />';
                            //$info = getimagesize($handle->file_dst_pathname);
                            //echo '  File: <a href="' . $dir_pics . '/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a><br/>';
                            //echo '   (' . $info['mime'] . ' - ' . $info[0] . ' x ' . $info[1] . ' -  ' . round(filesize($handle->file_dst_pathname) / 256) / 4 . 'KB)';
                            //echo '</p>';
                        } else {
                            // one error occured
                            //echo '<p class="result">';
                            echo '  <br/><b>File not resized to the wanted location</b><br />';
                            //echo '  Error: ' . $handle->error . '';
                            //echo '</p>';
                        }
                    }
                } else {

                    foreach ($imageResizes as $value) {
                        $handle->image_resize = true;
                        $handle->image_ratio_y = true;
                        //$handle->image_x                 = $smallest_X;
                        $handle->file_new_name_body = $newFileName;

                        if ($resizes_images != "model_resizes_image") {
                            $handle->file_name_body_add = "_X" . $value;
                        }


                        if ($orginImage_X_pixels > $value) {
                            $handle->image_x = $value;
                        } else {
                            $handle->image_x = $orginImage_X_pixels;
                        }

                        $handle->Process($dir_dest);

                        if ($handle->processed) {
                            // everything was fine !
                            //echo '<p class="result">';
                            echo '  <br/><b>File resized success with ' . "_X" . $value . '</b><br />';
                            //echo '  <img src="' . $dir_pics . '/' . $handle->file_dst_name . '" />';
                            //$info = getimagesize($handle->file_dst_pathname);
                            //echo '  File: <a href="' . $dir_pics . '/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a><br/>';
                            //echo '   (' . $info['mime'] . ' - ' . $info[0] . ' x ' . $info[1] . ' -  ' . round(filesize($handle->file_dst_pathname) / 256) / 4 . 'KB)';
                            //echo '</p>';
                        } else {
                            // one error occured
                            //echo '<p class="result">';
                            echo '  <br/><b>File not resized to the wanted location</b><br />';
                            //echo '  Error: ' . $handle->error . '';
                            //echo '</p>';
                        }
                    }
                }
            }

            $handle->Clean();
        } else {
            $backdata = '  <b>File not uploaded on the server</b>' . '  Error: ' . $handle->error . '<br/>';
        }

        unset($handle);
        return $backdata;
    }

    public function insertNewMagazine($postData, $FilesValues) {
        $backMessage = "";

        $uploadMultiFiles = $this->multiple($_FILES, TRUE);

        $magazine_images = NULL;

        $magazine_name = $postData['journal_name'];
        $magazine_active = 0;
        if (isset($postData['journal_is_active'])) {
            $magazine_active = 1;
        }

        $magazine_open_start = $postData['journal_open_start'];
        $magazine_open_finish = $postData['journal_open_end'];

        $codeNameType = $this->getMaxColumnValue("gobi_magazines", "code_magazine", $this->App_Config['magazine_min_code_num']);
        $codeNameType++;

        foreach ($uploadMultiFiles['prod_img'] as $key => $value) {
            $upload_path_parts = pathinfo($uploadMultiFiles['prod_img'][$key]['name']);
            $uploadFile_extension = $upload_path_parts['extension'];
            $newMagazineFileName = $this->getNewFileName("magazine", $uploadFile_extension);

            $magazine_images .= $newMagazineFileName['with_extension'] . ";";

            if (isset($uploadMultiFiles['prod_img'][$key])) {
                $message = $this->fileUploader($uploadMultiFiles['prod_img'][$key], $newMagazineFileName['no_extension'], $this->App_Config['magazine_img_upload_path'], $this->App_Config['upload_path_year_month'], FALSE, TRUE);

                $backMessage .= $message;
            }
        }

        $isDataInserted = FALSE;
        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'code_magazine' => $codeNameType,
                'magazine_name' => $magazine_name,
                'magazine_slug' => $postData['journal_net_slug'],
                'magazine_pdf' => $postData['journal_download_link'],
                'magazine_images' => $magazine_images,
                'magazine_order' => 0,
                'magazine_open_from' => $magazine_open_start,
                'magazine_open_to' => $magazine_open_finish,
                'magazine_active' => $magazine_active,
                'lang_iso_code' => $lang,
                'magazine_update' => $this->dbMan->now(),
                'magazine_registered' => $this->dbMan->now()
            );

            $new_magazine_id = $this->dbMan->insert('gobi_magazines', $data);
            if ($new_magazine_id) {
                $backMessage .= "ID:" . $new_magazine_id . ' data is inserted.<br/>';
                $isDataInserted = TRUE;
            } else {
                $backMessage .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        return $backMessage;
    }

    public function updateOldStoreDataDetails($postData) {
        $backdata = "";

        $data = Array(
            'store_name' => $postData['storeName'],
            'store_phones' => $postData['storeTelephone'],
            'store_fax' => $postData['storeFax'],
            'store_email' => $postData['storeEmail'],
            'store_website' => $postData['storeWeb'],
            'store_address' => $postData['storeAddress'],
            'store_updated' => $this->dbMan->now()
        );

        $this->dbMan->where('code_store', $postData['old_code_store']);
        $this->dbMan->where('lang_iso_code', $postData['old_store_lang']);
        if ($this->dbMan->update('gobi_stores', $data)) {
            $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
        } else {
            $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
        }
        return $backdata;
    }

    public function insertNewStoreDetail($postData) {
        $backdata = "";

        $storeLocation = $postData['storeLocationLatitude'] . ":" . $postData['storeLocationLongitude'];

        $maxCodeNumber = $this->getMaxColumnValue("gobi_stores", "code_store", $this->App_Config['store_min_code']);
        $maxCodeNumber++;

        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'code_store' => $maxCodeNumber,
                'code_area' => '',
                'store_name' => $postData['storeName'],
                'store_location' => $storeLocation,
                'store_pictures' => 'default_location.jpg',
                'store_description' => '',
                'store_address' => $this->tls->cn_htmltrans($postData['storeAddress'], "text"),
                'store_phones' => $postData['storeTelephone'],
                'store_fax' => $postData['storeFax'],
                'store_website' => $postData['storeWeb'],
                'store_email' => $postData['storeEmail'],
                'store_working_days' => '',
                'store_open_hours' => '',
                'has_chemical_service' => 0,
                'store_laundry_man' => '',
                'store_country_code' => strtolower($postData['selected_store_country']),
                'store_area' => $postData['selected_store_area'],
                'lang_iso_code' => $lang,
                'store_updated' => $this->dbMan->now(),
                'store_registered' => $this->dbMan->now()
            );

            $new_store_id = $this->dbMan->insert('gobi_stores', $data);
            if ($new_store_id) {
                $backdata .= $new_store_id . ' id data inserted. <br/>';
            } else {
                $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        return $backdata;
    }

    public function insertNewPhotosToCatalog($PostValues, $FilesValues) {
        $backMessage = "";
        //chooseOldCatalog
        $uploadMultiFiles = $this->multiple($FilesValues, TRUE);

        /*
          echo("<pre>");
          print_r($uploadMultiFiles);
          echo("</pre>");
          echo("<br/>");
          echo("<pre>");
          print_r($PostValues);
          echo("</pre>");
         */

        $catalog_images = "";

        foreach ($uploadMultiFiles['cata_img'] as $key => $value) {
            $upload_path_parts = pathinfo($uploadMultiFiles['cata_img'][$key]['name']);
            $uploadFile_extension = $upload_path_parts['extension'];
            $newCatalogFileName = $this->getNewFileName("catalog", $uploadFile_extension);

            $catalog_images .= $newCatalogFileName['with_extension'] . ";";

            if (isset($uploadMultiFiles['cata_img'][$key])) {
                $message = $this->fileUploader($uploadMultiFiles['cata_img'][$key], $newCatalogFileName['no_extension'], $this->App_Config['catalog_img_upload_path'], $this->App_Config['upload_path_year_month'], FALSE, TRUE);
                $backMessage .= $message;
            }
        }

        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("code_camp_cat", $PostValues['chooseOldCatalog']);
        $gobi_catalogs = $this->dbMan->getOne('gobi_catalogs');
        $countRecords = $this->dbMan->count;

        $catalog_images = $gobi_catalogs['camp_cat_images'] . $catalog_images;

        if (!empty($catalog_images)) {
            $data = Array(
                'camp_cat_images' => $catalog_images
            );
            $this->dbMan->where('code_camp_cat', $PostValues['chooseOldCatalog']);
            if ($this->dbMan->update('gobi_catalogs', $data))
                $backMessage .= $this->dbMan->count . ' record(s) are updated. <br/>';
            else
                $backMessage .= 'Catalog images are update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
        }


        return $backMessage;
    }

    public function insertNewPhotosToLookbook($PostValues, $FilesValues) {
        $backMessage = "";
        $lookbookUploadYearMonth = "";
        //chooseOldCatalog
        $uploadMultiFiles = $this->multiple($FilesValues, TRUE);

        if (!empty($PostValues['oldLookBookUploadMonth'])) {
            $lookbookUploadYearMonth = $PostValues['oldLookBookUploadMonth'];
        } else {
            $lookbookUploadYearMonth = $this->App_Config['upload_path_year_month'];
        }
        /*
          echo("<pre>");
          print_r($uploadMultiFiles);
          echo("</pre>");
          echo("<br/>");
          echo("<pre>");
          print_r($PostValues);
          echo("</pre>");

          return "";
         */
        $lookbook_images = "";

        foreach ($uploadMultiFiles['lobo_img'] as $key => $value) {
            $upload_path_parts = pathinfo($uploadMultiFiles['lobo_img'][$key]['name']);
            $uploadFile_extension = $upload_path_parts['extension'];
            $newCatalogFileName = $this->getNewFileName("lookbook", $uploadFile_extension);

            $lookbook_images .= $newCatalogFileName['with_extension'] . ";";

            if (isset($uploadMultiFiles['lobo_img'][$key])) {
                $message = $this->fileUploader($uploadMultiFiles['lobo_img'][$key], $newCatalogFileName['no_extension'], $this->App_Config['lookbook_img_upload_path'], $lookbookUploadYearMonth, FALSE, TRUE);
                $backMessage .= $message;
            }
        }

        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("code_lookbook", $PostValues['chooseOldCatalog']);
        $gobi_lookbooks = $this->dbMan->getOne('gobi_lookbooks');
        $countRecords = $this->dbMan->count;

        $lookbook_images = $gobi_lookbooks['lookbook_images'] . $lookbook_images;

        if (!empty($lookbook_images)) {
            $data = Array(
                'lookbook_images' => $lookbook_images
            );
            $this->dbMan->where('code_lookbook', $PostValues['chooseOldCatalog']);
            if ($this->dbMan->update('gobi_lookbooks', $data))
                $backMessage .= $this->dbMan->count . ' record(s) are updated. <br/>';
            else
                $backMessage .= 'Catalog images are update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
        }


        return $backMessage;
    }

    public function insertNewModelSizesGuide($postData) {
        $backdata = "";
        $modelSizeSex = 0;

        if ($postData['model_size_sex'] == "male") {
            $modelSizeSex = 1;
        } else if ($postData['model_size_sex'] == "female") {
            $modelSizeSex = 0;
        } else if ($postData['model_size_sex'] == "both") {
            $modelSizeSex = 2;
        }

        $maxCodeNumber = $this->getMaxColumnValue("gobi_model_sizes", "code_size_guide", $this->App_Config['model_size_min_code']);
        $maxCodeNumber++;

        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'code_size_guide' => $maxCodeNumber,
                'size_guide_title' => $postData['model_size_title'],
                'size_guide_content' => $this->tls->cn_htmltrans($postData['model_size_content'], "text"),
                'size_guide_sex' => $modelSizeSex,
                'lang_iso_code' => $lang,
                'size_guide_updated' => $this->dbMan->now(),
                'size_guide_registered' => $this->dbMan->now()
            );

            $new_model_size_id = $this->dbMan->insert('gobi_model_sizes', $data);
            if ($new_model_size_id) {
                $backdata .= $new_model_size_id . ' id data inserted. <br/>';
            } else {
                $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
            }
        }


        return $backdata;
    }

    public function saveOldModelSizesGuide($postData) {
        $backdata = "";
        /*
          Array
          (
          [selected_model_size] => 3507
          [old_model_size_title] => МАЛГАЙ
          [old_model_size_content] =>

          ИТАЛИ
          55
          56

          [old_model_size_sex] => both
          [old_model_size_code] => 3507
          [old_model_size_lang] => mn
          [btn_saveOldModelSizesGuide] =>
          )
         */

        /*
          gobi_model_sizes

          code_size_guide 	smallint(4)	No
          size_guide_title 	varchar(250)	No
          size_guide_content 	text	No
          size_guide_sex 	tinyint(1)	No
          lang_iso_code 	char(2)	No
          size_guide_updated 	datetime	No
          size_guide_registered
         */


        $data = Array(
            'size_guide_title' => $postData['old_model_size_title'],
            'size_guide_content' => $this->tls->cn_htmltrans($postData['old_model_size_content'], "text"),
            'size_guide_updated' => $this->dbMan->now()
        );

        $this->dbMan->where('code_size_guide', $postData['old_model_size_code']);
        $this->dbMan->where('lang_iso_code', $postData['old_model_size_lang']);
        if ($this->dbMan->update('gobi_model_sizes', $data)) {
            $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
        } else {
            $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
        }
    }

    public function uploadCollectionCoverOnProducts($postData, $filesData) {
        //$upload_path_parts = pathinfo($filesData['imageCoverCollection']['name']);
        //$uploadFile_extension = $upload_path_parts['extension'];
        $uploadFile_name = $postData['nameCoverCollection'];

        //print_r($filesData);

        $message = $this->fileUploader($filesData['imageCoverCollection'], $uploadFile_name, $this->App_Config['product_collection_cover_upload_path'], "covers", TRUE, FALSE, "collection_cover_resizes_image");

        return $message;
    }

    public function keepOldNewsOfDaily($postData, $filesData) {
        $backdata = "";
        $isSwapNews = FALSE;
        $isUpdateChanged = FALSE;
        $isTranslatedNews = 0;
        $isActivatedNews = 0;
        $filesData = $this->multiple($filesData);
        
        if (isset($postData['is_swap_news']) && $postData['is_swap_news'] == "on") {
            $isSwapNews = TRUE;
        }

        if (isset($postData['is_newsdate_changed']) && $postData['is_newsdate_changed'] == "on") {
            $isUpdateChanged = TRUE;
        }

        if (isset($postData['is_translated_news']) && $postData['is_translated_news'] == "on") {
            $isTranslatedNews = 1;
        }

        if (isset($postData['is_active_news']) && $postData['is_active_news'] == "on") {
            $isActivatedNews = 1;
        }

        $data = Array(
            'code_cat' => $postData['selected_daily_news_menu'],
            'dnews_name' => $postData['daily_news_name'],
            'dnews_slug' => $postData['daily_news_slug'],
            'dnews_preview' => $postData['daily_news_preview'],
            'dnews_content' => $this->tls->cn_htmltrans($postData['daily_news_content'], "text"),
            'is_trans_approved' => $isTranslatedNews,
            'dnews_active' => $isActivatedNews,
            'dnews_updated' => $postData['dailyNewsPublishDateTime']
        );

        $this->dbMan->where('lang_iso_code', $this->App_Config['current_web_app_lang']);
        $this->dbMan->where('code_news', $postData['selected_daily_news_code']);

        if ($this->dbMan->update('news_daily', $data)) {
            $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
        } else {
            $backdata .= 'daily news updating is failed: error is ' . $this->dbMan->getLastError() . "<br/>";
        }

        if ($isUpdateChanged) {
            $data = Array(
                'dnews_updated' => $postData['dailyNewsPublishDateTime']
            );

            $this->dbMan->where('code_news', $postData['selected_daily_news_code']);

            if ($this->dbMan->update('news_daily', $data)) {
                $backdata .= $this->dbMan->count . ' record(s) are updated. News date is updated.<br/>';
            } else {
                $backdata .= 'News date: error is ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        if ($isSwapNews) {
            $data = Array(
                'code_cat' => $postData['selected_daily_news_menu']
            );

            $this->dbMan->where('code_news', $postData['selected_daily_news_code']);

            if ($this->dbMan->update('news_daily', $data)) {
                $backdata .= $this->dbMan->count . ' record(s) are updated. News is swapped.<br/>';
            } else {
                $backdata .= 'News swapped: error is ' . $this->dbMan->getLastError() . "<br/>";
            }
        }


        if (!empty($filesData)) {

            $new_news_images = "";
            foreach ($filesData['daily_news_img'] as $key => $value) {
                $upload_path_parts = pathinfo($filesData['daily_news_img'][$key]['name']);
                $uploadFile_extension = $upload_path_parts['extension'];
                $newNewsFileName = $this->getNewFileName("daily_news", $uploadFile_extension);
                $new_news_images .= $newNewsFileName['with_extension'] . ";";
                if (isset($filesData['daily_news_img'][$key])) {
                    $message = $this->fileUploader($filesData['daily_news_img'][$key], $newNewsFileName['no_extension'], $this->App_Config['news_img_upload_path'], $this->App_Config['upload_path_year_month'], TRUE, FALSE);
                    $backdata .= $message;
                }
            }

            $data = Array(
                'dnews_images' => $new_news_images,
                'dnews_updated' => $this->dbMan->now()
            );

            $this->dbMan->where('code_news', $postData['selected_daily_news_code']);

            if ($this->dbMan->update('news_daily', $data)) {
                $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
            } else {
                $backdata .= 'daily news records are update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
            }
        }
        
        return $backdata;
    }

    public function insertNewModelReference() {
        /*
          gobi_model_reference
          code_model_ref 	smallint(4)	No
          model_ref_title 	varchar(500)	No
          model_ref_content 	text	No
          lang_iso_code 	char(2)	No
          model_ref_registered 	datetime	No
          model_ref_updated
         */

        $i = 0;
        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'code_model_ref' => 1601,
                'model_ref_title' => "ерөнхий тайлбар",
                'model_ref_content' => $this->tls->cn_htmltrans("Description: <br />Composition: <br />Gauge: <br />Yarn count: <br />Average: weight/gr: <br />Pattern:", "text"),
                'lang_iso_code' => $lang,
                'model_ref_registered' => $this->dbMan->now(),
                'model_ref_updated' => $this->dbMan->now()
            );

            $new_model_ref_id = $this->dbMan->insert('gobi_model_reference', $data);
            if ($new_model_ref_id) {
                $backdata .= $new_model_ref_id . ' id data inserted. <br/>';
                $i++;
            } else {
                $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
            }
        }
    }

    public function saveOldModelCareGuide($postData) {
        $backdata = "";
        /*
          Array
          (
          [model_care_title] => Сүлжмэл ноолуур
          [model_care_content] =>
          [model_care_lang] => mn
          [model_care_code] => 1001
          [btn_save_model_care] =>
          )
         */


        /*
          gobi_model_cares
          Column	Type	Null	Default 	Comments 	MIME
          id_care_guide 	smallint(6)	No
          code_care_guide 	smallint(4)	No
          code_comp_type 	char(1)	No
          care_guide_title 	varchar(500)	No
          care_content_content 	text	No
          lang_iso_code 	char(2)	No
          care_guide_registered 	datetime	No
          care_guide_updated
         */

        $data = Array(
            'care_guide_title' => $postData['model_care_title'],
            'care_guide_content' => $this->tls->cn_htmltrans($postData['model_care_content'], "text"),
            'care_guide_updated' => $this->dbMan->now()
        );

        $this->dbMan->where('code_care_guide', $postData['model_care_code']);
        $this->dbMan->where('lang_iso_code', $postData['model_care_lang']);
        if ($this->dbMan->update('gobi_model_cares', $data)) {
            $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
        } else {
            $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
        }


        return $backdata;
    }

    public function insertNewProductNotify($postData) {
        $backdata = "";

        $maxCodeNumber = $this->getMaxColumnValue("gobi_products_notifies", "code_notify_guide", $this->App_Config['pro_notify_min_code']);
        $maxCodeNumber++;

        $i = 0;
        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'code_notify_guide' => $maxCodeNumber,
                'notify_guide_title' => $postData['product_notify_title'],
                'notify_guide_content' => $this->tls->cn_htmltrans($postData['product_notify_content'], "text"),
                'lang_iso_code' => $lang,
                'notify_guide_updated' => $this->dbMan->now(),
                'notify_guide_registered' => $this->dbMan->now()
            );

            $new_pro_notify_id = $this->dbMan->insert('gobi_products_notifies', $data);
            if ($new_pro_notify_id) {
                $backdata .= $new_pro_notify_id . ' id data inserted. <br/>';
                $i++;
            } else {
                $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        return $backdata;
    }

    public function saveOldEditedJobData($postData) {
        $backdata = "";
        $isJobActive = 0;

        if (isset($postData['is_active_job']) && ($postData['is_active_job'] == "on")) {
            $isJobActive = 1;
        }

        $data = Array(
            'job_name' => $postData['openJobName'],
            'job_intro' => $postData['newJobIntroduction'],
            'job_requirement' => $this->tls->cn_htmltrans($postData['newJobRequirements'], "text"),
            'job_sex' => $postData['openJobSex'],
            'job_open' => $isJobActive,
            'job_openfrom' => $postData['jobOnBoardOpenFrom'],
            'job_opento' => $postData['jobOnBoardOpenTo'],
            'job_updated' => $this->dbMan->now()
        );

        $this->dbMan->where('code_job', $postData['openJobSlug']);
        $this->dbMan->where('lang_iso_code', $this->App_Config['current_web_app_lang']);
        if ($this->dbMan->update('hr_jobs', $data)) {
            $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
        } else {
            $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
        }

        return $backdata;
    }

    public function insertModelCareGuide($selectedCareCode) {
        /*
          gobi_model_cares
          Column	Type	Null	Default 	Comments 	MIME
          id_care_guide 	smallint(6)	No
          code_care_guide 	smallint(4)	No
          code_comp_type 	char(1)	No
          care_guide_title 	varchar(500)	No
          care_content_content 	text	No
          lang_iso_code 	char(2)	No
          care_guide_registered 	datetime	No
          care_guide_updated
         */

        $i = 0;
        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'code_care_guide' => $selectedCareCode,
                'code_comp_type' => "A",
                'care_guide_title' => "Принттэй болон өнгө хосолсон сүлжээстэй бүтээгдэхүүн",
                'care_content_content' => $this->tls->cn_htmltrans($postData['newJobRequirements'], "text"),
                'lang_iso_code' => $lang,
                'care_guide_updated' => $this->dbMan->now(),
                'care_guide_registered' => $this->dbMan->now()
            );

            $new_open_job_id = $this->dbMan->insert('gobi_model_cares', $data);
            if ($new_open_job_id) {
                $backdata .= $new_open_job_id . ' id data inserted. <br/>';
                $i++;
            } else {
                $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
            }
        }
    }

    public function saveNewOpenJobData($postData) {
        $backdata = "";

        $maxCodeNumber = $this->getMaxColumnValue("hr_jobs", "code_job", $this->App_Config['reg_job_min_code']);
        $maxCodeNumber++;

        $i = 0;
        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'code_job' => $maxCodeNumber,
                'job_name' => $postData['openJobName'],
                'job_intro' => $postData['newJobIntroduction'],
                'job_requirement' => $this->tls->cn_htmltrans($postData['newJobRequirements'], "text"),
                'job_sex' => $postData['openJobSex'],
                'job_company' => $postData['openJobCompany'],
                'job_open' => 1,
                'job_openfrom' => $postData['jobOnBoardOpenFrom'],
                'job_opento' => $postData['jobOnBoardOpenTo'],
                'lang_iso_code' => $lang,
                'job_updated' => $this->dbMan->now(),
                'job_registered' => $this->dbMan->now()
            );

            $new_open_job_id = $this->dbMan->insert('hr_jobs', $data);
            if ($new_open_job_id) {
                $backdata .= $new_open_job_id . ' id data inserted. <br/>';
                $i++;
            } else {
                $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        return $backdata;
    }

    public function saveEditedCompanyOldNews($postData) {
        $backdata = "";
        $isNewsActive = 0;

        if (isset($postData['is_active_news']) && ($postData['is_active_news'] == "on")) {
            $isNewsActive = 1;
        }

        $data = Array(
            'news_title' => $postData['company_news_name'],
            'news_slug' => $postData['company_news_slug'],
            'news_preview' => $postData['company_news_preview'],
            'news_content' => $this->tls->cn_htmltrans($postData['company_news_content'], "text"),
            'news_active' => $isNewsActive,
            'news_updated' => $postData['companyNewsPublishDateTime']
                //'code_cat' => $postData['selected_company_news_menu']
        );

        $this->dbMan->where('code_news', $postData['selectedToEditComNewsCode']);
        $this->dbMan->where('lang_iso_code', $this->App_Config['current_web_app_lang']);
        if ($this->dbMan->update('company_news', $data)) {
            $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
        } else {
            $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
        }


        if (isset($postData['is_menu_shifted'])) {
            $data = Array(
                'code_cat' => $postData['selected_company_news_menu']
            );

            $this->dbMan->where('code_news', $postData['selectedToEditComNewsCode']);
            if ($this->dbMan->update('company_news', $data)) {
                $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
            } else {
                $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        return $backdata;
    }

    public function keepOldNewsSiteMenus($postData) {
        $backdata = "";
        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'cat_name' => $postData['lang_news_menu_' . $lang],
                'cat_updated' => $this->dbMan->now()
            );

            $this->dbMan->where('code_cat', $postData['select_NewsSite_Menu']);
            $this->dbMan->where('lang_iso_code', $lang);
            if ($this->dbMan->update('news_categories', $data)) {
                $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
            } else {
                $backdata .= 'news categories are update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        return $backdata;
    }

    public function approveDailyNewsTranslation($dailyNewsCode) {
        $data = Array(
            'is_trans_approved' => 1
        );

        $this->dbMan->where('lang_iso_code', $this->App_Config['current_web_app_lang']);
        $this->dbMan->where('code_news', $dailyNewsCode);

        if ($this->dbMan->update('news_daily', $data)) {
            return "ok";
        } else {
            return "no";
        }
    }

    public function disApproveDailyNewsTranslation($dailyNewsCode) {
        $data = Array(
            'is_trans_approved' => 0
        );

        $this->dbMan->where('lang_iso_code', $this->App_Config['current_web_app_lang']);
        $this->dbMan->where('code_news', $dailyNewsCode);

        if ($this->dbMan->update('news_daily', $data)) {
            return "ok";
        } else {
            return "no";
        }
    }

    public function saveNewNewsOfDaily($postData, $filesData) {
        $backdata = "";
        $filesData = $this->multiple($filesData);
        $maxCodeNumber = $this->getMaxColumnValue("news_daily", "code_news", $this->App_Config['news_min_news_code']);
        $maxCodeNumber++;

        $i = 0;
        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'code_cat' => $postData['selected_daily_news_menu'],
                'code_news' => $maxCodeNumber,
                'dnews_name' => $postData['daily_news_name'],
                'dnews_slug' => $postData['daily_news_slug'],
                'dnews_preview' => $postData['daily_news_preview'],
                'dnews_content' => $this->tls->cn_htmltrans($postData['daily_news_content'], "text"),
                'dnews_images' => "",
                'lang_iso_code' => $lang,
                'dnews_active' => 1,
                'dnews_registered' => $this->dbMan->now(),
                'dnews_updated' => $this->dbMan->now()
            );

            $new_daily_news_id = $this->dbMan->insert('news_daily', $data);
            if ($new_daily_news_id) {
                $backdata .= $new_daily_news_id . ' id data inserted. <br/>';
                $i++;
            } else {
                $backdata .= 'Data no insert.....' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        if ($i > 0) {

            $new_news_images = "";
            foreach ($filesData['daily_news_img'] as $key => $value) {
                $upload_path_parts = pathinfo($filesData['daily_news_img'][$key]['name']);
                $uploadFile_extension = $upload_path_parts['extension'];
                $newNewsFileName = $this->getNewFileName("daily_news", $uploadFile_extension);
                $new_news_images .= $newNewsFileName['with_extension'] . ";";
                if (isset($filesData['daily_news_img'][$key])) {
                    $message = $this->fileUploader($filesData['daily_news_img'][$key], $newNewsFileName['no_extension'], $this->App_Config['news_img_upload_path'], $this->App_Config['upload_path_year_month'], TRUE, FALSE);
                    $backdata .= $message;
                }
            }

            $data = Array(
                'dnews_images' => $new_news_images,
                'dnews_updated' => $this->dbMan->now()
            );

            $this->dbMan->where('code_news', $maxCodeNumber);

            if ($this->dbMan->update('news_daily', $data)) {
                $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
            } else {
                $backdata .= 'daily news records are update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        return $backdata;
    }

    public function saveOldCompanyMenus($postData) {
        $backdata = "";
        foreach ($this->reg_lang as $value) {
            $data = Array(
                'cat_slug' => $postData['editCompanyMenuSlug'],
                'cat_name' => $postData['lang_menu_' . $value],
                'cat_updated' => $this->dbMan->now()
            );

            $this->dbMan->where('code_cat', $postData['selectedCompanyMenuCodeValue']);
            $this->dbMan->where('lang_iso_code', $value);
            if ($this->dbMan->update('company_categories', $data))
                $backdata .= $this->dbMan->count . ' records were updated.<br/>';
            else
                $backdata .= 'Error: ' . $this->dbMan->getLastError();
        }
        return $backdata;
    }

    public function hello() {
        return "hello, I am from prices.";
    }

    public function loadProductMenuData($editMenuCode) {
        //SELECT * FROM product_menus WHERE code_product_menu = 5010
        $this->dbMan->where("code_product_menu", $editMenuCode);
        $product_menus = $this->dbMan->get('product_menus');
        $countRecords = $this->dbMan->count;

        return json_encode($product_menus);
    }

    private function getCurrentTimeStamp() {
        $myDate = new DateTime();
        $currentTimeStamp = $myDate->getTimestamp();
        return $currentTimeStamp;
    }

    public function saveNewNewsMenu($postData) {
        $backdata = "";
        /*
          Array
          (
          [select_parent_menu] => 500
          [news_menu_name] => sport
          [news_menu_slug] => sport-nws
          [btn_SaveNewNewsMenu] =>
          )


          news_categories
          Column	Type	Null	Default 	Comments 	MIME
          id_cat 	int(4)	No
          code_cat 	smallint(3)	No
          lang_iso_code 	char(2)	No
          cat_name 	varchar(500)	No
          cat_slug 	varchar(500)	No
          cat_order 	tinyint(2)	No
          cat_updated 	datetime	No
          cat_registered
         */

        $newNewsCatCode = $this->getMaxColumnValue("news_categories", "code_cat", $this->App_Config['news_menu_min_code']);
        $newNewsCatCode++;

        foreach ($this->reg_lang as $lang) {

            $data = Array(
                'code_cat' => $newNewsCatCode,
                'lang_iso_code' => $lang,
                'cat_name' => $postData['news_menu_name'],
                'cat_slug' => $postData['news_menu_slug'],
                'cat_order' => 0,
                'cat_parent' => $postData['select_parent_menu'],
                'cat_updated' => $this->dbMan->now(),
                'cat_registered' => $this->dbMan->now()
            );

            $new_news_menu_id = $this->dbMan->insert('news_categories', $data);
            if ($new_news_menu_id) {
                $backdata .= $new_news_menu_id . ' id data inserted. <br/>';
            } else {
                $backdata .= 'Data no insert.....' . $this->dbMan->getLastError() . "<br/>";
            }
        }




        return $backdata;
    }

    public function keepProductMenuData($postMenuData) {



        if (isset($postMenuData['isThisNewMenu']) && ($postMenuData['isThisNewMenu'] == "on")) {
            //insertNewProductMenu($product_menu_parent, $product_menu_name) {

            $this->insertNewProductMenu($postMenuData['selected_name_type_value'], $postMenuData['lang_menu_mn']);
        } else {

            foreach ($this->reg_lang as $value) {
                $data = Array(
                    'product_menu_name' => $postMenuData['lang_menu_' . $value],
                    'product_menu_updated' => $this->dbMan->now()
                );

                $this->dbMan->where('code_product_menu', $postMenuData['selected_name_type_value']);
                $this->dbMan->where('lang_iso_code', $value);
                if ($this->dbMan->update('product_menus', $data))
                    echo $this->dbMan->count . ' records were updated<br/>';
                else
                    echo 'update failed: ' . $this->dbMan->getLastError();
            }
        }
    }

    public function saveNewCompanyMenu($postMenuData) {
        $backdata = "";
        //echo("<pre>");
        //print_r($postMenuData);
        //echo("</pre>");

        /*
          Array
          (
          [new_company_menu] => 7000
          [company_menu_name] => menu 1
          [company_menu_slug] => menu-1
          [is_ontop] => on
          [is_single_menu] => on
          [btn_SaveNewCompanyMenu] =>
          )
         * 
         * 
          company_categories
          Column	Type	Null	Default 	Comments 	MIME
          id_cat 	int(6)	No
          code_cat 	int(4)	No
          lang_iso_code 	char(2)	No
          cat_name 	varchar(500)	No
          cat_slug 	varchar(500)	No
          on_top 	tinyint(1)	No
          has_child 	tinyint(1)	No
          cat_parent 	int(4)	No
          cat_updated 	datetime	No
          cat_registered
         * 
         */

        $isOnTop = 0;
        if (isset($postMenuData['is_ontop']) && $postMenuData['is_ontop'] == "on") {
            $isOnTop = 1;
        }

        $isSingleMenu = 0;
        if (isset($postMenuData['is_single_menu']) && $postMenuData['is_single_menu'] == "on") {
            $isSingleMenu = 1;
        }

        $newCatCodeCompany = $this->getMaxColumnValue("company_categories", "code_cat", $this->App_Config['company_min_code_num']);
        $newCatCodeCompany++;

        foreach ($this->reg_lang as $lang) {

            $data = Array(
                'code_cat' => $newCatCodeCompany,
                'lang_iso_code' => $lang,
                'cat_name' => $postMenuData['company_menu_name'],
                'cat_slug' => $postMenuData['company_menu_slug'],
                'on_top' => $isOnTop,
                'has_child' => $isSingleMenu,
                'cat_parent' => $postMenuData['new_company_menu'],
                'cat_updated' => $this->dbMan->now(),
                'cat_registered' => $this->dbMan->now()
            );

            $new_company_menu_id = $this->dbMan->insert('company_categories', $data);
            if ($new_company_menu_id) {
                $backdata .= $new_company_menu_id . ' id data inserted. <br/>';
            } else {
                $backdata .= 'Data no insert.....' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        return $backdata;
    }

    public function saveNewNewsOfCompany($postProductData, $filesNewsComData) {
        $backdata = "";
        $filesNewsComData = $this->multiple($filesNewsComData);

        $maxCodeNumber = $this->getMaxColumnValue("company_news", "code_news", $this->App_Config['company_min_news_code']);
        $maxCodeNumber++;

        $i = 0;
        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'code_cat' => $postProductData['selected_company_news_menu'],
                'code_news' => $maxCodeNumber,
                'news_title' => $postProductData['company_news_name'],
                'news_slug' => $postProductData['company_news_slug'],
                'news_preview' => $postProductData['company_news_preview'],
                'news_content' => $this->tls->cn_htmltrans($postProductData['company_news_content'], "text"),
                'news_images' => "images",
                'lang_iso_code' => $lang,
                'news_active' => 1,
                'news_registered' => $this->dbMan->now(),
                'news_updated' => $this->dbMan->now()
            );

            $new_company_news_id = $this->dbMan->insert('company_news', $data);
            if ($new_company_news_id) {
                $backdata .= $new_company_news_id . ' id data inserted. <br/>';
                $i++;
            } else {
                $backdata .= 'Data no insert.....' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        if (($i > 0) && (isset($filesNewsComData['com_news_img']))) {
            $new_news_images = "";
            foreach ($filesNewsComData['com_news_img'] as $key => $value) {
                $upload_path_parts = pathinfo($filesNewsComData['com_news_img'][$key]['name']);
                $uploadFile_extension = $upload_path_parts['extension'];
                $newNewsFileName = $this->getNewFileName("company", $uploadFile_extension);
                $new_news_images .= $newNewsFileName['with_extension'] . ";";
                if (isset($filesNewsComData['com_news_img'][$key])) {
                    $message = $this->fileUploader($filesNewsComData['com_news_img'][$key], $newNewsFileName['no_extension'], $this->App_Config['company_img_upload_path'], $this->App_Config['upload_path_year_month'], TRUE, FALSE);
                    $backdata .= $message;
                }
            }

            $data = Array(
                'news_images' => $new_news_images,
                'news_updated' => $this->dbMan->now()
            );

            //$this->dbMan->where('lang_iso_code', $this->App_Config['current_web_app_lang']);
            $this->dbMan->where('code_news', $maxCodeNumber);

            if ($this->dbMan->update('company_news', $data)) {
                $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
            } else {
                $backdata .= 'news records are update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        return $backdata;
    }

    public function saveOldProductDetails($postProductData, $filesProductData) {
        $backdata = "";

        $isProductActive = 0;

        if (isset($postProductData['willBeActiveProduct']) && $postProductData['willBeActiveProduct'] == "on") {
            $isProductActive = 1;
        }

        $filesProductData = $this->multiple($filesProductData);

        $data = Array(
            'code_model' => $postProductData['product_code_model'],
            'code_product_menu' => $postProductData['selected_name_type_value'],
            'product_title' => $postProductData['newProductName'],
            'product_slug' => $postProductData['newProductSlug'],
            'product_desc' => $postProductData['loadedProductDesc'],
            'product_is_active' => $isProductActive,
            'product_updated' => $this->dbMan->now()
        );

        $this->dbMan->where('lang_iso_code', $this->App_Config['current_web_app_lang']);
        $this->dbMan->where('code_product', $postProductData['product_code']);

        if ($this->dbMan->update('gobi_products', $data)) {
            $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
        } else {
            $backdata .= 'color is update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
        }

        $new_product_images = array();

        $i = 0;
        foreach ($filesProductData['prod_img'] as $key => $value) {
            $upload_path_parts = pathinfo($filesProductData['prod_img'][$key]['name']);
            $uploadFile_extension = $upload_path_parts['extension'];
            $newProductFileName = $this->getNewFileName("product", $uploadFile_extension);
            $new_product_images[$i] = $newProductFileName['with_extension'];
            if (isset($filesProductData['prod_img'][$key])) {
                $message = $this->fileUploader($filesProductData['prod_img'][$key], $newProductFileName['no_extension'], $this->App_Config['product_img_upload_path'], $this->App_Config['upload_path_year_month'], TRUE, TRUE);
                $backdata .= $message;
            }
            $i++;
        }

        foreach ($new_product_images as $value) {
            $data = Array(
                'code_image' => $postProductData['product_code_image'],
                'image_order' => 99,
                'image_path' => $value,
                'image_updated' => $this->dbMan->now(),
                'image_registered' => $this->dbMan->now()
            );

            $new_product_image_id = $this->dbMan->insert('products_images', $data);
            if ($new_product_image_id) {
                //$isDataInserted = TRUE;
                echo $new_product_image_id . 'Data insert.....';
            } else {
                echo 'Data no insert.....' . $this->dbMan->getLastError();
            }
        }

        return $backdata;
    }

    public function saveProductImagesOrdering($orderedImagesHTML, $productCodeImage) {
        $backdata = "";
        $orderedIMGs = explode("|", $orderedImagesHTML, -1);
        $i = 0;
        while (count($orderedIMGs) > $i) {
            $orderedIMG = explode("/", $orderedIMGs[$i]);
            $imageFileName = $orderedIMG[count($orderedIMG) - 1];
            $imageFileName1 = str_replace("_X150", "", $imageFileName);

            $data = Array(
                'image_order' => $i,
                'image_updated' => $this->dbMan->now()
            );

            $this->dbMan->where('code_image', $productCodeImage);
            $this->dbMan->where('image_path', $imageFileName1);
            if ($this->dbMan->update('products_images', $data))
                $backdata .= $this->dbMan->count . " record(s) are ordered. <br/>";
            else
                $backdata .= "error: " . $this->dbMan->getLastError() . "<br/>";
            $i++;
        }
        return $backdata;
    }

    public function removeProductSingleImage($removeProductID_Image, $removeProductCode_Image) {
        //$isRecordRemoved = FALSE;

        /*
          $this->dbMan->where('id_image', $removeProductID_Image);
          if ($this->dbMan->delete('products_images')) {
          //return "product images and records were deleted.";
          $isRecordRemoved = TRUE;
          } else {
          //return "failed when deleting images and records.";
          $isRecordRemoved = FALSE;
          }

          if ($isRecordRemoved) {
          return "the image is removed.";
          } else {
          return "the image is not removed because having problem.";
          }
         */




        return $this->removeProductImageDetails($removeProductCode_Image, $removeProductID_Image);
    }

    private function isColorExists($fashionColor) {
        $backdata = "#FFFFFF";
        $this->dbMan->where("color_fashion", $fashionColor);
        $gobi_colors = $this->dbMan->get('gobi_colors', 1);
        $countRecords = $this->dbMan->count;


        if ($countRecords > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function removeProductImageDetails($code_image, $removeSingleFileID = NULL) {



        if (!empty($removeSingleFileID)) {
            $this->dbMan->where("id_image", $removeSingleFileID);
        }

        //$this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("code_image", $code_image);
        $products_images = $this->dbMan->get('products_images');

        print_r($products_images);

        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($countRecords > $i) {
            $tempProductImage = explode(".", $products_images[$i]['image_path']);

            $filePathInfo = $this->App_Config['server_media_root_path'] . $this->App_Config['product_img_upload_path'] . $this->App_Config['upload_path_year_month'] . "/";

            $imageOrginalSize = $filePathInfo . $products_images[$i]['image_path'];
            $imageOrginalSize_X150 = $filePathInfo . $tempProductImage[0] . "_X150" . "." . $tempProductImage[1];
            $imageOrginalSize_X450 = $filePathInfo . $tempProductImage[0] . "_X450" . "." . $tempProductImage[1];
            $imageOrginalSize_X750 = $filePathInfo . $tempProductImage[0] . "_X750" . "." . $tempProductImage[1];
            $imageOrginalSize_X1050 = $filePathInfo . $tempProductImage[0] . "_X1050" . "." . $tempProductImage[1];

            if (is_file($imageOrginalSize) == TRUE) {
                chmod($imageOrginalSize, 0666);
                unlink($imageOrginalSize);
            }
            if (is_file($imageOrginalSize_X150) == TRUE) {
                chmod($imageOrginalSize_X150, 0666);
                unlink($imageOrginalSize_X150);
            }
            if (is_file($imageOrginalSize_X450) == TRUE) {
                chmod($imageOrginalSize_X450, 0666);
                unlink($imageOrginalSize_X450);
            }
            if (is_file($imageOrginalSize_X750) == TRUE) {
                chmod($imageOrginalSize_X750, 0666);
                unlink($imageOrginalSize_X750);
            }
            if (is_file($imageOrginalSize_X1050) == TRUE) {
                chmod($imageOrginalSize_X1050, 0666);
                unlink($imageOrginalSize_X1050);
            }

            $i++;
        }

        if (!empty($removeSingleFileID)) {
            $this->dbMan->where("id_image", $removeSingleFileID);
        }

        $this->dbMan->where('code_image', $code_image);
        if ($this->dbMan->delete('products_images')) {
            return "product images and records were deleted.";
        } else {
            return "failed when deleting images and records.";
        }
    }

    public function removeProductAllInfo($CodeProduct) {
        $backdata = "";
        $this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("code_product", $CodeProduct);
        $gobi_products = $this->dbMan->getOne('gobi_products');
        $countRecords = $this->dbMan->count;

        $backdata .= $this->removeProductImageDetails($gobi_products['code_image'], NULL);


        $this->dbMan->where('code_product', $CodeProduct);
        if ($this->dbMan->delete('gobi_products')) {
            return "product records were deleted.";
        } else {
            return "failed when deleting records.";
        }

        return $backdata;
    }

    public function insertColors($fashionColor, $ComputerColor) {

        if (!$this->isColorExists($fashionColor)) {

            $data = Array(
                'color_fashion' => $fashionColor,
                'color_computer' => $ComputerColor,
                'color_registered' => $this->dbMan->now(),
                'color_updated' => $this->dbMan->now()
            );

            $new_color_id = $this->dbMan->insert('gobi_colors', $data);
            if ($new_color_id) {
                echo $new_color_id . 'Data insert.....<br/>';
            } else {
                echo 'Data no insert.....' . $this->dbMan->getLastError() . "<br/>";
            }
        } else {

            $data = Array(
                'color_computer' => "#" . $ComputerColor
            );
            $this->dbMan->where('color_fashion', $fashionColor);
            if ($this->dbMan->update('gobi_colors', $data))
                echo $this->dbMan->count . ' record(s) are updated. <br/>';
            else
                echo 'color is update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
        }
    }

    public function getWeeklyPriceCode() {
        $weekcode = substr(md5(rand(1000, 9999999)), 0, 10) . substr(md5(rand(1000, 9999999)), 0, 10);
        return $weekcode;
    }

    public function insertNewProductMenu($product_menu_parent, $product_menu_name) {
        /*
          product_menus
          Column	Type	Null	Default 	Comments 	MIME
          id_product_menu 	int(8)	No
          code_product_menu 	int(4)	No
          product_menu_name 	varchar(500)	No
          lang_iso_code 	char(2)	No
          product_menu_parent 	int(4)	No
          product_menu_registered 	datetime	No
          product_menu_updated
         */

//$codeNameType = $this->getNewNameCode();
//$codeCompType = $this->getNewCompCode($parentGroupID);

        $codeProductMenu = $this->getMaxColumnValue("product_menus", "code_product_menu", $this->App_Config['product_menu_min_code_num']);
        $codeProductMenu++;

        foreach ($this->reg_lang as $lang) {

            $data = Array(
                'code_product_menu' => $codeProductMenu,
                'product_menu_name' => $product_menu_name,
                'lang_iso_code' => $lang,
                'product_menu_parent' => $product_menu_parent,
                'product_menu_registered' => $this->dbMan->now(),
                'product_menu_updated' => $this->dbMan->now()
            );

            $new_product_menu_id = $this->dbMan->insert('product_menus', $data);
            if ($new_product_menu_id) {
                echo $new_product_menu_id . 'Data insert.....';
            } else {
                echo 'Data no insert.....' . $this->dbMan->getLastError();
            }
        }
    }

    private function getFilePathInfo($theFile, $lookingItem) {
        $upload_path_parts = pathinfo($theFile);
        $uploadFile_extension = $upload_path_parts[$lookingItem];
        return $uploadFile_extension;
    }

    public function insertNewLookbook($PostValues, $FilesValues) {
        $backMessage = "";
        $isLookBookActive = FALSE;
        $lookbook_images = NULL;

        /*
          Array
          (
          [lookbook_name] => spring summer 2015
          [lookbook_cover_image] => DSCN2075.jpg
          [prod_img] => Array
          (
          [file1] => DSCN2075.jpg
          [file2] => DSCN2060.jpg
          )

          [lookbook_open_start] => 2015-05-07 04:10
          [lookbook_open_finish] => 2015-05-15 09:30
          [lookbook_is_active] => on
          [btn_NewLookbook] =>
          )
         */

        $lookbook_name = $PostValues['lookbook_name'];
//$lookbook_cover_image = $PostValues['lookbook_cover_image'];
        $lookbook_open_start = $PostValues['lookbook_open_start'];
        $lookbook_open_finish = $PostValues['lookbook_open_finish'];

        $lookbook_is_active = $PostValues['lookbook_is_active'];

        if (isset($PostValues['lookbook_is_active'])) {
            $isLookBookActive = TRUE;
        }

//$app_config['lookbook_min_code_num'] = 40000;
//$app_config['lookbook_image_prefix'] = "PIC_LOBO";
//$app_config['lookbook_cover_image_prefix'] = "PIC_CVR_LOBO";
//$app_config['lookbook_img_upload_path'] = "/uploads/lookbook_catalog_tv_journal/lookbook/pictures/";

        $codeNameType = $this->getMaxColumnValue("gobi_lookbooks", "code_lookbook", $this->App_Config['lookbook_min_code_num']);
        $codeNameType++;

        $coverNewFileName = "";
        if (strlen($FilesValues['lookbook_cover_image']['name']) > 0) {
            $upload_path_parts = pathinfo($FilesValues['lookbook_cover_image']['name']);
            $uploadFile_extension = $upload_path_parts['extension'];

            $newCoverFileName = $this->getNewFileName("lookbook_cover", $uploadFile_extension);
            $coverNewFileName = $newCoverFileName['with_extension'];
        }

        $isDataInserted = FALSE;
        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'code_lookbook' => $codeNameType,
                'lookbook_name' => $lookbook_name,
                'lookbook_title' => "",
                'lookbook_content' => "",
                'lang_iso_code' => $lang,
                'lookbook_cover' => $coverNewFileName,
                'lookbook_images' => "",
                'lookbook_order' => 0,
                'lookbook_open_from' => $lookbook_open_start,
                'lookbook_open_to' => $lookbook_open_finish,
                'lookbook_active' => $isLookBookActive,
                'lookbook_registered' => $this->dbMan->now(),
                'lookbook_updated' => $this->dbMan->now()
            );

            $new_lookbook_id = $this->dbMan->insert('gobi_lookbooks', $data);
            if ($new_lookbook_id) {
                $backMessage .= "ID:" . $new_lookbook_id . ' data is inserted.<br/>';
                $isDataInserted = TRUE;
            } else {
                $backMessage .= 'No data inserted. It was error: ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        if ($isDataInserted) {
            if (strlen($FilesValues['lookbook_cover_image']['name']) > 0) {
                $message = $this->fileUploader($FilesValues['lookbook_cover_image'], $newCoverFileName['no_extension'], $this->App_Config['lookbook_img_upload_path'], $this->App_Config['upload_path_year_month'], FALSE, TRUE);
                $backMessage .= $message;
            }
        }

        $uploadMultiFiles = $this->multiple($_FILES, TRUE);

        foreach ($uploadMultiFiles['lobo_img'] as $key => $value) {
            $upload_path_parts = pathinfo($uploadMultiFiles['lobo_img'][$key]['name']);
            $uploadFile_extension = $upload_path_parts['extension'];
            $newCatalogFileName = $this->getNewFileName("lookbook", $uploadFile_extension);

            $lookbook_images .= $newCatalogFileName['with_extension'] . ";";

            if (isset($uploadMultiFiles['lobo_img'][$key])) {
                $message = $this->fileUploader($uploadMultiFiles['lobo_img'][$key], $newCatalogFileName['no_extension'], $this->App_Config['lookbook_img_upload_path'], $this->App_Config['upload_path_year_month'], FALSE, TRUE);
                $backMessage .= $message;
            }
        }

        if (!empty($lookbook_images)) {
            $data = Array(
                'lookbook_images' => $lookbook_images
            );
            $this->dbMan->where('code_lookbook', $codeNameType);
            if ($this->dbMan->update('gobi_lookbooks', $data))
                $backMessage .= $this->dbMan->count . ' record(s) are updated. <br/>';
            else
                $backMessage .= 'Catalog images are update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
        }



        return $backMessage;
    }

    public function insertNewCatalog($PostValues, $FilesValues) {
        $backMessage = "";

        $catalog_images = NULL;

        $catalog_name = $PostValues['catalog_name'];
//$catalog_cover_image = $FilesValues['catalog_cover_image'];

        $catalog_open_start = $PostValues['catalog_open_start'];
        $catalog_open_finish = $PostValues['catalog_open_finish'];
//$catalog_is_active = $PostValues['catalog_is_active'];

        $codeNameType = $this->getMaxColumnValue("gobi_catalogs", "code_camp_cat", $this->App_Config['catalog_min_code_num']);
        $codeNameType++;

        $coverNewFileName = "";
        if (strlen($FilesValues['catalog_cover_image']['name']) > 0) {
            $upload_path_parts = pathinfo($FilesValues['catalog_cover_image']['name']);
            $uploadFile_extension = $upload_path_parts['extension'];

            $newCoverFileName = $this->getNewFileName("catalog_cover", $uploadFile_extension);
            $coverNewFileName = $newCoverFileName['with_extension'];
        }

        $isDataInserted = FALSE;
        foreach ($this->reg_lang as $lang) {

            $data = Array(
                'code_camp_cat' => $codeNameType,
                'camp_cat_name' => $catalog_name,
                'camp_cat_title' => "",
                'camp_cat_content' => "",
                'lang_iso_code' => $lang,
                'camp_cat_cover' => $coverNewFileName,
                'camp_cat_images' => "",
                'camp_cat_order' => 0,
                'camp_open_from' => $catalog_open_start,
                'camp_open_to' => $catalog_open_finish,
                'camp_cat_active' => 1,
                'camp_cat_registered' => $this->dbMan->now(),
                'camp_cat_updated' => $this->dbMan->now()
            );

            $new_catalog_id = $this->dbMan->insert('gobi_catalogs', $data);
            if ($new_catalog_id) {
                $backMessage .= "ID:" . $new_catalog_id . ' data is inserted.<br/>';
                $isDataInserted = TRUE;
            } else {
                $backMessage .= 'No data inserted. It was error: ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        if ($isDataInserted) {
            if (strlen($FilesValues['catalog_cover_image']['name']) > 0) {
                $message = $this->fileUploader($FilesValues['catalog_cover_image'], $newCoverFileName['no_extension'], $this->App_Config['catalog_img_upload_path'], $this->App_Config['upload_path_year_month'], FALSE, TRUE);
                $backMessage .= $message;
            }
        }

        $uploadMultiFiles = $this->multiple($_FILES, TRUE);

        foreach ($uploadMultiFiles['cata_img'] as $key => $value) {
            $upload_path_parts = pathinfo($uploadMultiFiles['cata_img'][$key]['name']);
            $uploadFile_extension = $upload_path_parts['extension'];
            $newCatalogFileName = $this->getNewFileName("catalog", $uploadFile_extension);

            $catalog_images .= $newCatalogFileName['with_extension'] . ";";

            if (isset($uploadMultiFiles['cata_img'][$key])) {
                $message = $this->fileUploader($uploadMultiFiles['cata_img'][$key], $newCatalogFileName['no_extension'], $this->App_Config['catalog_img_upload_path'], $this->App_Config['upload_path_year_month'], FALSE, TRUE);
                $backMessage .= $message;
            }
        }

        if (!empty($catalog_images)) {
            $data = Array(
                'camp_cat_images' => $catalog_images
            );
            $this->dbMan->where('code_camp_cat', $codeNameType);
            if ($this->dbMan->update('gobi_catalogs', $data))
                $backMessage .= $this->dbMan->count . ' record(s) are updated. <br/>';
            else
                $backMessage .= 'Catalog images are update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
        }

        return $backMessage;
    }

    private function multiple(array $_files, $top = TRUE) {
        $files = array();
        foreach ($_files as $name => $file) {
            if ($top)
                $sub_name = $file['name'];
            else
                $sub_name = $name;

            if (is_array($sub_name)) {
                foreach (array_keys($sub_name) as $key) {
                    $files[$name][$key] = array(
                        'name' => $file['name'][$key],
                        'type' => $file['type'][$key],
                        'tmp_name' => $file['tmp_name'][$key],
                        'error' => $file['error'][$key],
                        'size' => $file['size'][$key],
                    );
                    $files[$name] = $this->multiple($files[$name], FALSE);
                }
            } else {
                $files[$name] = $file;
            }
        }
        return $files;
    }

    private function getNewNameCode() {
//$newNameCode = rand(1500, 9999);
//$cols = Array("code_name_type");
//$this->dbMan->where("code_name_type ", $newNameCode);
//$gobi_name_types = $this->dbMan->get('gobi_name_types', NULL, $cols);
//$countRecords = $this->dbMan->count;
//Array ( [0] => Array ( [MAX(code_name_type)] => 5086 ) ) 
//$params = Array(1, 'admin');
        $gobi_name_types = $this->dbMan->rawQuery("SELECT MAX(code_name_type) FROM gobi_name_types", NULL);
        $countRecords = $this->dbMan->count;
//print_r($users); // contains Array of returned rows
//SELECT MAX(code_name_type) FROM gobi_name_types 
//if ($countRecords > 9950) {
//echo("take attention on this message. name type code will over soon 1000.");
//}
//while (in_array($newNameCode, $gobi_name_types)) {
//$newNameCode = rand(1500, 9999);
//}
//echo("count:".$countRecords."<br/>");
//echo("value:".$gobi_name_types[0]['MAX(code_name_type)']."<br/>");




        $newNameCode = $gobi_name_types[0]['MAX(code_name_type)'];
        $newNameCode++;

        return $newNameCode;
    }

    private function getMaxColumnValue($dbTable, $dbColumn, $relationMinNumber = NULL) {
//$params = Array($parentGroupID);
        $instanceTable = $this->dbMan->rawQuery("SELECT MAX(" . $dbColumn . ") FROM " . $dbTable . "", NULL);
        $countRecords = $this->dbMan->count;

        $newCode = $instanceTable[0]['MAX(' . $dbColumn . ')'];

        if (!empty($relationMinNumber)) {
            if ($newCode < $relationMinNumber) {
                return $relationMinNumber;
            } else {
                return $newCode;
            }
        }

        return $newCode;
    }

    private function getNewCompCode($parentGroupID) {

        $params = Array($parentGroupID);
        $gobi_name_types = $this->dbMan->rawQuery("SELECT MAX(code_comp_type) FROM gobi_name_types WHERE parent_name_type = ?", $params);
        $countRecords = $this->dbMan->count;
//print_r($users); // contains Array of returned rows
//SELECT MAX(code_name_type) FROM gobi_name_types 
//if ($countRecords > 9950) {
//echo("take attention on this message. name type code will over soon 1000.");
//}
//while (in_array($newNameCode, $gobi_name_types)) {
//$newNameCode = rand(1500, 9999);
//}
//echo("count:".$countRecords."<br/>");
//echo("value:".$gobi_name_types[0]['MAX(code_name_type)']."<br/>");




        $newNameCode = $gobi_name_types[0]['MAX(code_comp_type)'];
        $newNameCode++;

        return $newNameCode;


        /* $newCompCode = "";

          $cols = Array("code_comp_type");
          $this->dbMan->where("parent_name_type", $parentGroupID);
          $gobi_name_types = $this->dbMan->get("gobi_name_types", NULL, $cols);
          $countRecords = $this->dbMan->count;

          $i = 0;
          $higherCode = 0;
          while ($i < $countRecords) {
          if ($higherCode <= intval($gobi_name_types[$i]['code_comp_type'])) {
          $higherCode = intval($gobi_name_types[$i]['code_comp_type']);
          }
          $i++;
          }

          if ($i == 0) {
          $newCompCode = "01";
          } else {
          $higherCode++;

          if ($higherCode < 10) {
          $newCompCode = "0" . $higherCode;
          } else {
          $newCompCode = $higherCode;
          }
          }

          return $newCompCode; */
    }

    public function insertNewNameType($parentGroupID, $nameTypeName) {
        /*
         * 
          gobi_name_types
          Column	Type	Null	Default 	Comments 	MIME
          id_name_type 	int(11)	No
          code_name_type 	char(3)	No
          code_comp_type 	char(2)	No
          parent_name_type 	char(2)	No
          name_type_name 	varchar(500)	No
          lang_iso_code 	char(2)	No
          name_type_registered 	datetime	No
          name_type_updated
         * 
         */

        $codeNameType = $this->getNewNameCode();
        $codeCompType = $this->getNewCompCode($parentGroupID);

        foreach ($this->reg_lang as $lang) {

            $data = Array(
                'code_name_type' => $codeNameType,
                'code_comp_type' => $codeCompType,
                'parent_name_type' => $parentGroupID,
                'name_type_name' => $nameTypeName,
                'lang_iso_code' => $lang,
                'name_type_registered' => $this->dbMan->now(),
                'name_type_updated' => $this->dbMan->now()
            );

            $new_weekitem_id = $this->dbMan->insert('gobi_name_types', $data);
            if ($new_weekitem_id) {
                echo $new_weekitem_id . 'Data insert.....';
            } else {
                echo 'Data no insert.....' . $this->dbMan->getLastError();
            }
        }
    }

    public function insertNewProduct($PostValues, $FilesValues) {
        $backMessage = "";
        $catalog_images = array();

        /*
          gobi_products
          Column	Type	Null	Default 	Comments 	MIME
          id_product 	int(10)	No
          code_officer_author 	char(20)	No
          code_officer_approver 	char(20)	No
          code_product 	int(8)	No
          code_model 	int(6)	No
          code_product_status 	int(4)	No
          code_image 	int(8)	No
          code_notify_guide 	int(4)	No
          product_title 	tinytext	No
          product_desc 	mediumtext	No
          product_quantity 	int(11)	No
          product_price 	decimal(10,2)	No
          product_wholesale_price 	decimal(10,2)	Yes 	NULL
          product_wholesale_quantity 	int(11)	Yes 	NULL
          product_is_reduced 	tinyint(1)	Yes 	NULL
          product_reduction_price 	decimal(10,2)	Yes 	NULL
          product_reduction_percent 	float	Yes 	NULL
          product_reduction_from 	date	Yes 	NULL
          product_reduction_to 	date	Yes 	NULL
          product_shop_codes 	varchar(250)	No
          lang_iso_code 	char(2)	No
          product_updated 	datetime	No
          product_registered
         */


        /*
          Array
          (
          [loadByModelNum] => 2-15-083
          [newProductName] => this is product name
          [loadedModelNumber] => 2-15-083
          [loadedModelColors] => 438,02,497,1467,46,01
          [loadedProductDesc] => this is description
          [loadedModelQuantities] => 78
          [newProductPerPrice] => 245000.00
          [WholeSaleQuantities] => 10
          [product_menu_name] => 50
          [isReducedProduct] => on
          [willBeActiveProduct] => on
          [selected_plus_attention] => 1001
          [selected_name_type_value] => 5041
          [btn_insertNewProduct] =>
          )
         */


        $uploadMultiFiles = $this->multiple($FilesValues, TRUE);

//echo("<pre>");
//print_r($uploadMultiFiles);
//echo("</pre>");
//$codeNameType = $this->getNewNameCode();
//$codeCompType = $this->getNewCompCode($parentGroupID);


        $newCodeProduct = $this->getMaxColumnValue("gobi_products", "code_product", $this->App_Config['product_min_code_num']);
        $newCodeProduct++;


        $newCodeProductImage = $this->getMaxColumnValue("products_images", "code_image ", $this->App_Config['product_image_min_code_num']);
        $newCodeProductImage++;

//products_images
//product_image_min_code_num


        $isDataInserted = FALSE;

        foreach ($this->reg_lang as $lang) {

            $data = Array(
                'code_officer_author' => "user000001",
                'code_officer_approver' => "user000002",
                'code_product' => $newCodeProduct,
                'code_model' => $PostValues['product_code_model'],
                'code_product_status' => 1000,
                'code_image' => $newCodeProductImage,
                'code_notify_guide' => 4101,
                'code_product_menu' => $PostValues['selected_name_type_value'],
                'product_title' => $PostValues['newProductName'],
                'product_slug' => $PostValues['newProductSlug'],
                'product_desc' => $PostValues['loadedProductDesc'],
                'product_quantity' => $PostValues['loadedModelQuantities'],
                'product_price' => $PostValues['newProductPerPrice'],
                'product_wholesale_price' => 50000,
                'product_wholesale_quantity' => $PostValues['WholeSaleQuantities'],
                'product_is_reduced' => 0,
                'product_reduction_price' => 100,
                'product_reduction_percent' => 10,
                'product_reduction_from' => $this->dbMan->now(),
                'product_reduction_to' => $this->dbMan->now(),
                'product_shop_codes' => "shop",
                'lang_iso_code' => $lang,
                'product_is_active' => 1,
                'product_updated' => $this->dbMan->now(),
                'product_registered' => $this->dbMan->now()
            );

            $new_product_id = $this->dbMan->insert('gobi_products', $data);
            if ($new_product_id) {
                $isDataInserted = TRUE;
                echo $new_product_id . 'Data insert.....';
            } else {
                echo 'Data no insert.....' . $this->dbMan->getLastError();
            }
        }

        if ($isDataInserted) {
//$uploadMultiFiles

            $i = 0;
            foreach ($uploadMultiFiles['prod_img'] as $key => $value) {
                $upload_path_parts = pathinfo($uploadMultiFiles['prod_img'][$key]['name']);
                $uploadFile_extension = $upload_path_parts['extension'];

                $newProductFileName = $this->getNewFileName("product", $uploadFile_extension);

                $catalog_images[$i] = $newProductFileName['with_extension'];

                if (isset($uploadMultiFiles['prod_img'][$key])) {
                    $message = $this->fileUploader($uploadMultiFiles['prod_img'][$key], $newProductFileName['no_extension'], $this->App_Config['product_img_upload_path'], $this->App_Config['upload_path_year_month'], TRUE, TRUE);
                    $backMessage .= $message;
                }
                $i++;
            }
        }


        foreach ($catalog_images as $value) {
            /*
              products_images
              Column	Type	Null	Default 	Comments 	MIME
              id_image 	int(10)	No
              code_image 	int(8)	No
              image_order 	tinyint(2)	No
              image_path 	char(100)	No
              image_updated 	datetime	No
              image_registered
             */

            $data = Array(
                'code_image' => $newCodeProductImage,
                'image_order' => 0,
                'image_path' => $value,
                'image_updated' => $this->dbMan->now(),
                'image_registered' => $this->dbMan->now()
            );

            $new_product_image_id = $this->dbMan->insert('products_images', $data);
            if ($new_product_image_id) {
                $isDataInserted = TRUE;
                echo $new_product_image_id . 'Data insert.....';
            } else {
                echo 'Data no insert.....' . $this->dbMan->getLastError();
            }
        }


        /*
          if (!empty($catalog_images)) {



          $data = Array(
          'camp_cat_images' => $catalog_images
          );
          $this->dbMan->where('code_camp_cat', $codeNameType);
          if ($this->dbMan->update('gobi_catalogs', $data)) {
          $backMessage .= $this->dbMan->count . ' record(s) are updated. <br/>';
          } else {
          $backMessage .= 'Catalog images are update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
          }
          } */
    }

    public function insertNewModelDetails($postData, $ModelImage) {
        $message = "";

        $upload_path_parts = pathinfo($ModelImage['model_image']['name']);
        $uploadFile_extension = $upload_path_parts['extension'];
        //$newLocalImgName = $this->tool->getLocationPhotoName($uploadFile_extension);

        $newFileName = $this->getNewFileName("model", $uploadFile_extension);

        $modelSizes = "4XL:" . $postData['model_size_4xl'] . ";";
        $modelSizes .= "3XL:" . $postData['model_size_3xl'] . ";" . "2XL:" . $postData['model_size_2xl'] . ";" . "XL:" . $postData['model_size_xl'] . ";";
        $modelSizes .= "L:" . $postData['model_size_l'] . ";" . "S:" . $postData['model_size_s'] . ";" . "M:" . $postData['model_size_m'] . ";";
        $modelSizes .= "XS:" . $postData['model_size_xs'] . ";";
        $modelSizes .= "square:" . $postData['model_size_square'] . ";";
        $modelSizes .= "other:" . $postData['model_size_other'] . ";";

        $codeNameType = $this->getMaxColumnValue("gobi_models", "code_model", $this->App_Config['model_min_code_num']);
        $codeNameType++;

        $modelSex = 0;

        if ($postData['model_sex'] == "male") {
            $modelSex = 1;
        } elseif ($postData['model_sex'] == "female") {
            $modelSex = 0;
        } elseif ($postData['model_sex'] == "trans") {
            $modelSex = 2;
        } else {
            $modelSex = 2;
        }

        /*
          [selectedModelCareCode] => 1001
          [selectedModelSizeCode] => 3504
          [selectedModelRefCode] => 1601
          [newModelReferenceContent] => Description:
          Composition:
          Gauge:
          Yarn count:
          Average: weight/gr:
          Pattern:
         */

        $i = 0;
        foreach ($this->reg_lang as $lang) {

            $data = Array(
                'code_model' => $codeNameType,
                'code_comp_type' => $postData['select_name_catalog'],
                'code_care_guide' => $postData['selectedModelCareCode'],
                'code_size_guide' => $postData['selectedModelSizeCode'],
                'code_product_reference' => $postData['selectedModelRefCode'],
                'model_name' => $postData['model_name'],
                'lang_iso_code' => $lang,
                'model_image' => $newFileName['with_extension'],
                'model_number1' => $postData['model_number'],
                'model_number2' => $postData['model_number'],
                'model_number_customer' => $postData['model_number_customer'],
                'model_weight' => $postData['model_weight'],
                'model_weight' => $postData['model_weight'],
                'model_sex' => $modelSex,
                'model_sizes' => $modelSizes,
                'model_quantity' => $postData['model_quantity'],
                'model_colors' => $postData['model_colors'],
                'model_price' => $postData['model_per_item_price'],
                'model_description' => $this->tls->cn_htmltrans($postData['newModelReferenceContent'], "text"),
                'model_weave_type' => $postData['model_grid_type'],
                'model_knmagy' => $postData['model_braid_car_gyeich'],
                'model_component_percent' => $postData['model_component_percent'],
                'model_string_number' => $postData['model_string_number'],
                'model_string_requirement' => $postData['model_string_needs'],
                'model_sort' => $postData['model_classification'],
                'model_auxiliarym_material' => $postData['model_support_materials'],
                'code_officer_designer' => $postData['model_designer'],
                'model_registered' => $this->dbMan->now(),
                'model_updated' => $this->dbMan->now()
            );

            $new_model_id = $this->dbMan->insert('gobi_models', $data);

            if ($new_model_id) {
                $message .= "<br/>" . $new_model_id . 'Data insert.....';
                $i++;
            } else {
                $message .= '<br/>Data no insert.....' . $this->dbMan->getLastError();
            }
        }

        if ($i > 0) {
            $backdata = "";
            //upload_year_month
            //$message .=$this->fileUploader($ModelImage, $newFileName);
            //$ModelImage['model_image']['name']
            $message .= $this->fileUploader($ModelImage['model_image'], $newFileName['no_extension'], $this->App_Config['model_img_upload_path'], $this->App_Config['upload_path_year_month'], TRUE, FALSE, "model_resizes_image");


            //private function fileUploader($uploadObject, $newFileName, $upload_path, $year_month, $isResizeApproved = FALSE) {

            /*
              $dir_dest = DOCROOT . "/gobi-admin" . $this->App_Config['model_img_upload_path'];

              //$uploader_big = new upload_big();
              //echo($dir_dest);

              $handle = new Upload($ModelImage['model_image']);

              if ($handle->uploaded) {

              // yes, the file is on the server
              // now, we start the upload 'process'. That is, to copy the uploaded file
              // from its temporary location to the wanted location
              // It could be something like $handle->Process('/home/www/my_uploads/');
              $handle->Process($dir_dest);

              // we check if everything went OK
              if ($handle->processed) {
              // everything was fine !
              $backdata .= '  <b>File uploaded with success</b>';
              //echo '  File: <a href="' . $dir_pics . '/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a>';
              //echo '   (' . round(filesize($handle->file_dst_pathname) / 256) / 4 . 'KB)';
              } else {
              // one error occured
              $backdata .= '  <b>File not uploaded to the wanted location</b>' . '  Error: ' . $handle->error . '';
              }

              // we delete the temporary files
              $handle->Clean();
              } else {
              $backdata .= '  <b>File not uploaded on the server</b>' . '  Error: ' . $handle->error . '';
              }


              echo("<br/>" . $backdata . "<br/>"); */
        }

        return $message;
    }

    private function getNewFileName($fileNameSwitcher, $fileExtension = NULL) {
        $newFileName = array();
        $namePrefix = NULL;

        switch ($fileNameSwitcher) {
            case "model":
                $namePrefix = $this->App_Config['model_image_prefix'];
                $currentTimeStamp = $this->getCurrentTimeStamp();
                $randNumber = rand(100100, 990800);
//$newFileName = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber . (!empty($fileExtension) ? "." . $fileExtension : "");

                $newFileName['with_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber . "." . $fileExtension;
                $newFileName['no_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber;

                break;
            case "catalog":
                $namePrefix = $this->App_Config['catalog_image_prefix'];
                $currentTimeStamp = $this->getCurrentTimeStamp();
                $randNumber = rand(100100, 990800);
                $newFileName['with_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber . "." . $fileExtension;
                $newFileName['no_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber;

                break;
            case "catalog_cover":
                $namePrefix = $this->App_Config['catalog_cover_image_prefix'];
                $currentTimeStamp = $this->getCurrentTimeStamp();
                $randNumber = rand(100100, 990800);
                $newFileName['with_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber . "." . $fileExtension;
                $newFileName['no_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber;

                break;
            case "lookbook_cover":
                $namePrefix = $this->App_Config['lookbook_cover_image_prefix'];
                $currentTimeStamp = $this->getCurrentTimeStamp();
                $randNumber = rand(100100, 990800);
                $newFileName['with_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber . "." . $fileExtension;
                $newFileName['no_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber;

                break;
            case "lookbook":
                $namePrefix = $this->App_Config['lookbook_image_prefix'];
                $currentTimeStamp = $this->getCurrentTimeStamp();
                $randNumber = rand(100100, 990800);
                $newFileName['with_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber . "." . $fileExtension;
                $newFileName['no_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber;

                break;
            case "product":
                $namePrefix = $this->App_Config['product_image_prefix'];
                $currentTimeStamp = $this->getCurrentTimeStamp();
                $randNumber = rand(100100, 990800);
                $newFileName['with_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber . "." . $fileExtension;
                $newFileName['no_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber;

                break;
            case "company":
                $namePrefix = $this->App_Config['company_image_prefix'];
                $currentTimeStamp = $this->getCurrentTimeStamp();
                $randNumber = rand(100100, 990800);
                $newFileName['with_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber . "." . $fileExtension;
                $newFileName['no_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber;

                break;
            case "daily_news":
                $namePrefix = $this->App_Config['news_image_prefix'];
                $currentTimeStamp = $this->getCurrentTimeStamp();
                $randNumber = rand(100100, 990800);
                $newFileName['with_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber . "." . $fileExtension;
                $newFileName['no_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber;

                break;
            case "magazine":
                $namePrefix = $this->App_Config['magazine_image_prefix'];
                $currentTimeStamp = $this->getCurrentTimeStamp();
                $randNumber = rand(100100, 990800);
                $newFileName['with_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber . "." . $fileExtension;
                $newFileName['no_extension'] = $namePrefix . "_" . $this->App_Config['upload_path_year_month'] . "_" . $currentTimeStamp . "_" . $randNumber;

                break;
            default :

                break;
        }


        return $newFileName;
    }

    /**
     * wild use file upload function.
     *
     * @param array  $uploadObject The name of the database table to work with.
     * @param string $newFileName   The number of rows total to return.
     * @param string $upload_path   The path where you want to upload images.
     * @param string $year_month   The value of current month and year conbination that used for saves in separate folders.
     * @param boolean $isResizeApproved   If its value is true then images resize specific sizes otherwise resizing will skip.
     * @param boolean $retainOrginalImage   If its value is true then orginal image will remain otherwise it will removed.
     *
     * @return string Contains the message of status that is result.
     */
    private function fileUploader($uploadObject, $newFileName, $upload_path, $year_month, $isResizeApproved = FALSE, $retainOrginalImage = TRUE, $resizes_images = "default_resizes_image") {
        $backdata = "";

        $dir_dest = DOCROOT . $upload_path . $year_month . "/";

        //$uploader_big = new upload_big();
        //echo($dir_dest);

        $handle = new Upload($uploadObject);

        if ($handle->uploaded) {

            // yes, the file is on the server
            // now, we start the upload 'process'. That is, to copy the uploaded file
            // from its temporary location to the wanted location
            // It could be something like $handle->Process('/home/www/my_uploads/');

            if ($retainOrginalImage) {
                $handle->file_new_name_body = $newFileName;
                $handle->Process($dir_dest);

                // we check if everything went OK
                if ($handle->processed) {
                    // everything was fine !
                    $backdata = '  <b>File uploaded with success</b><br/>';
                    //echo '  File: <a href="' . $dir_pics . '/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a>';
                    //echo '   (' . round(filesize($handle->file_dst_pathname) / 256) / 4 . 'KB)';
                } else {
                    // one error occured
                    $backdata = '  <b>File not uploaded to the wanted location.' . '  Error: ' . $handle->error . '<br/>';
                }
            }

            if ($isResizeApproved) {
                $orginImage_X_pixels = $handle->image_src_x;
                $orginImage_Y_pixels = $handle->image_src_y;

                //$currentTimeStamp = $this->getCurrentTimeStamp();
                //$newImageFileName = "PIC_" . $currentTimeStamp . "_" . rand(100, 999);
                //$smallest_X = 150;
                //$smaller_X = 450;
                //$small_X = 750;
                //$large_X = 1050;

                $imageResizes = $this->App_Config[$resizes_images]; // array(150, 450, 750, 1050);

                if ("collection_cover_resizes_image" == $resizes_images) {

                    foreach ($imageResizes as $key => $value) {
                        $handle->image_resize = true;
                        $handle->image_ratio_y = true;
                        //$handle->image_x                 = $smallest_X;
                        $handle->file_new_name_body = $newFileName;

                        if ($orginImage_X_pixels > $value) {
                            $handle->image_x = $value;
                        } else {
                            $handle->image_x = $orginImage_X_pixels;
                        }

                        //$dir_dest = $dir_dest . $key . "/";
                        $handle->Process($dir_dest . $key . "/");

                        if ($handle->processed) {
                            // everything was fine !
                            //echo '<p class="result">';
                            echo '  <br/><b>File resized success with ' . "_X" . $value . '</b><br />';
                            //echo '  <img src="' . $dir_pics . '/' . $handle->file_dst_name . '" />';
                            //$info = getimagesize($handle->file_dst_pathname);
                            //echo '  File: <a href="' . $dir_pics . '/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a><br/>';
                            //echo '   (' . $info['mime'] . ' - ' . $info[0] . ' x ' . $info[1] . ' -  ' . round(filesize($handle->file_dst_pathname) / 256) / 4 . 'KB)';
                            //echo '</p>';
                        } else {
                            // one error occured
                            //echo '<p class="result">';
                            echo '  <br/><b>File not resized to the wanted location</b><br />';
                            //echo '  Error: ' . $handle->error . '';
                            //echo '</p>';
                        }
                    }
                } else {

                    foreach ($imageResizes as $value) {
                        $handle->image_resize = true;
                        $handle->image_ratio_y = true;
                        //$handle->image_x                 = $smallest_X;
                        $handle->file_new_name_body = $newFileName;

                        if ($resizes_images != "model_resizes_image") {
                            $handle->file_name_body_add = "_X" . $value;
                        }


                        if ($orginImage_X_pixels > $value) {
                            $handle->image_x = $value;
                        } else {
                            $handle->image_x = $orginImage_X_pixels;
                        }

                        $handle->Process($dir_dest);

                        if ($handle->processed) {
                            // everything was fine !
                            //echo '<p class="result">';
                            echo '  <br/><b>File resized success with ' . "_X" . $value . '</b><br />';
                            //echo '  <img src="' . $dir_pics . '/' . $handle->file_dst_name . '" />';
                            //$info = getimagesize($handle->file_dst_pathname);
                            //echo '  File: <a href="' . $dir_pics . '/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a><br/>';
                            //echo '   (' . $info['mime'] . ' - ' . $info[0] . ' x ' . $info[1] . ' -  ' . round(filesize($handle->file_dst_pathname) / 256) / 4 . 'KB)';
                            //echo '</p>';
                        } else {
                            // one error occured
                            //echo '<p class="result">';
                            echo '  <br/><b>File not resized to the wanted location</b><br />';
                            //echo '  Error: ' . $handle->error . '';
                            //echo '</p>';
                        }
                    }
                }
            }




// we delete the temporary files
            $handle->Clean();
        } else {
            $backdata = '  <b>File not uploaded on the server</b>' . '  Error: ' . $handle->error . '<br/>';
        }

        unset($handle);
        return $backdata;
    }

    public function insertWeekItemInfo($selectWeekMarket, $week_good_name, $week_good_price, $selectType, $chart_id) {

        $data = Array(
            'wepi_code' => $this->getWeeklyPriceCode(),
            'market_code' => $selectWeekMarket,
            'wepi_type' => $selectType,
            'wepi_name' => $week_good_name,
            'wepi_price' => $week_good_price,
            'chart_id' => $chart_id,
            'wepi_registered' => $this->dbMan->now(),
            'wepi_deadline' => $this->dbMan->now('+7d')
        );

        $new_weekitem_id = $this->dbMan->insert('weekly_prices', $data);
        if ($new_weekitem_id) {
            return $new_weekitem_id . 'Data insert.....';
        } else {
            return 'Data no insert.....' . $this->dbMan->getLastError();
        }
    }

    public function insertWeekDate($week_date) {

//'wede_deadline' => date('Y-m-d H:i:s', strtotime($week_date . ' + 7 days'))

        $data = Array(
            'wede_registered' => date('Y-m-d', strtotime($week_date)),
            'wede_deadline' => date('Y-m-d', strtotime($week_date . ' + 7 days'))
        );

        $new_weekdate_id = $this->dbMan->insert('weekly_dates', $data);
        if ($new_weekdate_id) {
            return $new_weekdate_id . 'Date inserted';
        } else {
            return 'Data no insert.....' . $this->dbMan->getLastError();
        }
    }

    public function printSelectMarketHTML($marketID) {
        $backdata = "";
//$this->dbMan->where("parentmenu_code", $parentmenuid);
        $supermarkets = $this->dbMan->get('supermarkets');
        $countRecords = $this->dbMan->count;
        $backdata .= "<select name='selectWeekMarket' id='selectWeekMarket'><option value='none'>- Сонгох--</option>";
        $i = 0;
        while ($i < $countRecords) {

            if ($marketID == $supermarkets[$i]['market_code']) {
                $backdata .= "<option value='" . $supermarkets[$i]['market_code'] . "' selected>" . $supermarkets[$i]['market_name'] . "</option>";
            } else {
                $backdata .= "<option value='" . $supermarkets[$i]['market_code'] . "'>" . $supermarkets[$i]['market_name'] . "</option>";
            }
            $i++;
        }
        $backdata .= "</select>";
        return $backdata;
    }

    public function printSelectTypeHTML($wety_code) {
        $backdata = "";
//$this->dbMan->where("parentmenu_code", $parentmenuid);
        $supermarkets = $this->dbMan->get('wepi_types');
        $countRecords = $this->dbMan->count;
        $backdata .= "<select name='selectTabType' id='selectTabType'><option value='none'>--Сонгох--</option>";
        $i = 0;
        while ($i < $countRecords) {
            if ($wety_code == $supermarkets[$i]['wety_code']) {
                $backdata .= "<option value='" . $supermarkets[$i]['wety_code'] . "' selected>" . $supermarkets[$i]['wety_type'] . "</option>";
            } else {
                $backdata .= "<option value='" . $supermarkets[$i]['wety_code'] . "'>" . $supermarkets[$i]['wety_type'] . "</option>";
            }
            $i++;
        }
        $backdata .= "</select>";
        return $backdata;
    }

    public function check_user($username, $password) {
//echo(Bcrypt::hashPassword("weekPricerMan4875", 4));
        $users = array(
            "username1" => 'user',
            'password1' => '$2y$04$4Bo4zKLinxAQI8aHtzoihOZZOeipy.g1R8bd43L8ISl8ius7hnGcW'
        );


        if ($users['username1'] == $username && (Bcrypt::checkPassword($password, $users['password1']))) {
            $_SESSION['weekly_user_sess'] = $username;
            return true;
        } else {
            return false;
        }
    }

}
