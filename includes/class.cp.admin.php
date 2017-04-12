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

namespace mongoliax\includes\cp_admin;

class cp_admin {

    //put your code here
    private $dbMan;
    public $reg_lang;
    public $App_Config;
    public $tls;

    //private $myDateTime;

    public function __construct() {
        $this->dbMan = new \mongoliax\includes\MysqliDb\MysqliDb();
        $this->tls = new \mongoliax\includes\tools\tools();
    }

    public function deleteSelectedNewsByCodeAJAX($editorChoosenNewsCode, $userOfficerCode) {
        //$this->dbMan->where("lang_iso_code", $this->App_Config['current_web_app_lang']);
        $this->dbMan->where("code_officer", $userOfficerCode);
        $this->dbMan->where("code_post", $editorChoosenNewsCode);
        $mglx_post = $this->dbMan->getOne('mglx_post', 'post_images');
        //$countRecords = $this->dbMan->count;
        $mglx_post_images = explode(";", $mglx_post['post_images'], -1);

        foreach ($mglx_post_images as $key => $value) {

            $mglxPostImg = $value;
            //PIC_NEWS_2016_01_1452606272_737817.jpg;
            $imageUploadDate = substr($mglxPostImg, 9, 7);
            $tempProductImage = explode(".", $mglxPostImg);
            $filePathInfo = DOCROOT . $this->App_Config['mglx_post_img_upload_path'] . $imageUploadDate . "/";
            //$imageOrginalSize = $filePathInfo . $mglxPostImg;

            $imageOrginalSize_X70 = $filePathInfo . $tempProductImage[0] . "_X70" . "." . $tempProductImage[1];
            $imageOrginalSize_X200 = $filePathInfo . $tempProductImage[0] . "_X200" . "." . $tempProductImage[1];
            $imageOrginalSize_X300 = $filePathInfo . $tempProductImage[0] . "_X300" . "." . $tempProductImage[1];
            $imageOrginalSize_X390 = $filePathInfo . $tempProductImage[0] . "_X390" . "." . $tempProductImage[1];
            $imageOrginalSize_X480 = $filePathInfo . $tempProductImage[0] . "_X480" . "." . $tempProductImage[1];
            $imageOrginalSize_X520 = $filePathInfo . $tempProductImage[0] . "_X520" . "." . $tempProductImage[1];
            $imageOrginalSize_X720 = $filePathInfo . $tempProductImage[0] . "_X720" . "." . $tempProductImage[1];

            if (is_file($imageOrginalSize_X70) == TRUE) {
                chmod($imageOrginalSize_X70, 0666);
                unlink($imageOrginalSize_X70);
            }
            if (is_file($imageOrginalSize_X200) == TRUE) {
                chmod($imageOrginalSize_X200, 0666);
                unlink($imageOrginalSize_X200);
            }
            if (is_file($imageOrginalSize_X300) == TRUE) {
                chmod($imageOrginalSize_X300, 0666);
                unlink($imageOrginalSize_X300);
            }
            if (is_file($imageOrginalSize_X390) == TRUE) {
                chmod($imageOrginalSize_X390, 0666);
                unlink($imageOrginalSize_X390);
            }
            if (is_file($imageOrginalSize_X480) == TRUE) {
                chmod($imageOrginalSize_X480, 0666);
                unlink($imageOrginalSize_X480);
            }
            if (is_file($imageOrginalSize_X520) == TRUE) {
                chmod($imageOrginalSize_X520, 0666);
                unlink($imageOrginalSize_X520);
            }
            if (is_file($imageOrginalSize_X720) == TRUE) {
                chmod($imageOrginalSize_X720, 0666);
                unlink($imageOrginalSize_X720);
            }
        }

        /* if ($countRecords > 0 && !empty($mglx_post)) {} */

        $this->dbMan->where("code_officer", $userOfficerCode);
        $this->dbMan->where("code_post", $editorChoosenNewsCode);
        if ($this->dbMan->delete('mglx_post')) {
            return "мэдээ устгагдсан.";
        } else {
            return "мэдээ устгах үед алдаа гарсан.";
        }
    }

    public function insertPostReaderComment($postData, $postReaderIP) {
        $backdata = "";
        $maxCodeNumber = $this->getMaxColumnValue("mglx_comments", "code_comment", $this->App_Config['mglx_min_comm_code']);
        $maxCodeNumber++;

        if (empty($postData['commAuthor'])) {
            $postData['commAuthor'] = "зочин";
        }

        //$i = 0;
        //foreach ($this->reg_lang as $lang) {
        $data = Array(
            'code_comment' => $maxCodeNumber,
            'code_post' => $postData['commPostID'],
            'comment_author' => $postData['commAuthor'],
            'comment_content' => $this->tls->cn_htmltrans($postData['commContent'], "text"),
            'comment_ip' => $postReaderIP,
            'comment_parent' => 10000000,
            'comment_approved' => 1,
            'comment_registered' => $this->dbMan->now()
        );

        $new_mglx_news_id = $this->dbMan->insert('mglx_comments', $data);
        if ($new_mglx_news_id) {
            //$backdata .= $new_mglx_news_id . ' id data inserted. <br/>';
            $backdata = "yes";
            //$i++;
        } else {
            //$backdata .= 'Data no insert.....' . $this->dbMan->getLastError() . "<br/>";
            $backdata = "no";
        }
        //}
        return $backdata;
    }

    public function keepOldNewsSiteMenus($postData) {
        $backdata = "";
        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'cat_name' => $postData['lang_news_menu_' . $lang],
                'cat_updated' => $this->dbMan->now()
            );

            $this->dbMan->where('code_cat', $postData['selectedEditMenuCode']);
            $this->dbMan->where('lang_iso_code', $lang);
            if ($this->dbMan->update('mglx_category', $data)) {
                $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
            } else {
                $backdata .= 'news categories are update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        return $backdata;
    }

    public function keepOldNewsOfDaily($postData, $filesData) {
        $backdata = "";
        $isSwapNews = false;
        $isUpdateChanged = false;
        $isTranslatedNews = 0;
        $isActivatedNews = 0;
        $isPostWillFeatured = 0;
        $willOldImgReplaced = false;
        $isTranslateAllLangs = false;
        $filesData = $this->multiple($filesData);
        $oldPostImagesString = null;

        if (isset($postData['isOldImgReplaced']) && $postData['isOldImgReplaced'] == "on") {
            $willOldImgReplaced = true;
        }

        if (isset($postData['isTranslateAllLangs']) && $postData['isTranslateAllLangs'] == "on") {
            $isTranslateAllLangs = true;
        }

        if ($willOldImgReplaced) {
            $this->dbMan->where('lang_iso_code', $this->App_Config['current_web_app_lang']);
            $this->dbMan->where('code_post', $postData['selected_daily_news_code']);
            $cols = array("post_images");
            $mglx_post_one = $this->dbMan->getOne('mglx_post', $cols);
            /*
              Array
              (
              [post_images] => PIC_NEWS_2016_01_1451923993_852254.jpg;
              )
             */
            if (!empty($mglx_post_one)) {
                $oldPostImagesString = $mglx_post_one['post_images'];
            }
        }
        /*
          if (!empty($oldPostImagesString)) {
          $deletePostImages = explode(";", $oldPostImagesString, -1);
          foreach ($deletePostImages as $key => $value) {
          //PIC_NEWS_2016_01_1451924137_635450.jpg
          $imgUploadedDate = substr($value, 9, 7);
          $tempProductImage = explode(".", $value);
          $filePathInfo = DOCROOT . $this->App_Config['mglx_post_img_upload_path'] . $this->App_Config['upload_path_year_month'] . "/";
          foreach ($this->App_Config['mglx_seven_image_sizes'] as $key1 => $value1) {
          $imageOrginalSize = $filePathInfo . $tempProductImage[0] . "_X" . $this->App_Config['mglx_seven_image_sizes'][$key1]['width'] . "." . $tempProductImage[1];
          if (is_file($imageOrginalSize) == TRUE) {
          chmod($imageOrginalSize, 0666);
          unlink($imageOrginalSize);
          }
          }
          }
          }
         */
        if (isset($postData['is_swap_news']) && $postData['is_swap_news'] == "on") {
            $isSwapNews = true;
        }

        if (isset($postData['isFeaturedPost']) && $postData['isFeaturedPost'] == "on") {
            $isPostWillFeatured = 1;
        }

        if (isset($postData['is_newsdate_changed']) && $postData['is_newsdate_changed'] == "on") {
            $isUpdateChanged = true;
        }

        if (isset($postData['is_translated_news']) && $postData['is_translated_news'] == "on") {
            $isTranslatedNews = 1;
        }

        if (isset($postData['is_active_news']) && $postData['is_active_news'] == "on") {
            $isActivatedNews = 1;
        }

        $data = Array(
            'code_cat' => $postData['selected_daily_news_menu'],
            'post_title' => $postData['daily_news_name'],
            'post_slug' => $postData['daily_news_slug'],
            'post_preview' => $postData['daily_news_preview'],
            'post_content' => $this->tls->cn_htmltrans($postData['daily_news_content'], "text"),
            'post_translated' => $isTranslatedNews,
            'post_active' => $isActivatedNews,
            'post_featured' => $isPostWillFeatured,
            'post_updated' => $postData['dailyNewsPublishDateTime']
        );

        if (!$isTranslateAllLangs) {
            $this->dbMan->where('lang_iso_code', $this->App_Config['current_web_app_lang']);
        }

        $this->dbMan->where('code_post', $postData['selected_daily_news_code']);

        if ($this->dbMan->update('mglx_post', $data)) {
            $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
        } else {
            $backdata .= 'daily news updating is failed: error is ' . $this->dbMan->getLastError() . "<br/>";
        }

        if ($isUpdateChanged) {
            $data = Array(
                'post_updated' => $postData['dailyNewsPublishDateTime']
            );

            $this->dbMan->where('code_post', $postData['selected_daily_news_code']);

            if ($this->dbMan->update('mglx_post', $data)) {
                $backdata .= $this->dbMan->count . ' record(s) are updated. News date is updated.<br/>';
            } else {
                $backdata .= 'News date: error is ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        if ($isSwapNews) {
            $data = Array(
                'code_cat' => $postData['selected_daily_news_menu']
            );

            $this->dbMan->where('code_post', $postData['selected_daily_news_code']);

            if ($this->dbMan->update('mglx_post', $data)) {
                $backdata .= $this->dbMan->count . ' record(s) are updated. News is swapped.<br/>';
            } else {
                $backdata .= 'News swapped: error is ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        if (!empty($filesData) && $willOldImgReplaced) {
            $new_news_images = "";
            foreach ($filesData['daily_news_img'] as $key => $value) {
                $upload_path_parts = pathinfo($filesData['daily_news_img'][$key]['name']);
                $uploadFile_extension = $upload_path_parts['extension'];
                $newNewsFileName = $this->getNewFileName("daily_news", $uploadFile_extension);
                $new_news_images .= $newNewsFileName['with_extension'] . ";";
                if (isset($filesData['daily_news_img'][$key])) {
                    $message = $this->fileUploader($filesData['daily_news_img'][$key], $newNewsFileName['no_extension'], $this->App_Config['mglx_post_img_upload_path'], $this->App_Config['upload_path_year_month'], TRUE, FALSE);
                    $backdata .= $message;
                }
            }

            $data = Array(
                'post_images' => $new_news_images,
                'post_updated' => $this->dbMan->now()
            );

            $this->dbMan->where('code_post', $postData['selected_daily_news_code']);

            if ($this->dbMan->update('mglx_post', $data)) {
                $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
            } else {
                $backdata .= 'daily news records are update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
            }

            if (!empty($oldPostImagesString)) {
                $deletePostImages = explode(";", $oldPostImagesString, -1);
                foreach ($deletePostImages as $key => $value) {
                    //PIC_NEWS_2016_01_1451924137_635450.jpg
                    $imgUploadedDate = substr($value, 9, 7);
                    $tempProductImage = explode(".", $value);
                    $filePathInfo = DOCROOT . $this->App_Config['mglx_post_img_upload_path'] . $this->App_Config['upload_path_year_month'] . "/";
                    foreach ($this->App_Config['mglx_seven_image_sizes'] as $key => $value) {
                        $imageOrginalSize = $filePathInfo . $tempProductImage[0] . "_X" . $this->App_Config['mglx_seven_image_sizes'][$key]['width'] . "." . $tempProductImage[1];
                        if (is_file($imageOrginalSize) == TRUE) {
                            chmod($imageOrginalSize, 0666);
                            unlink($imageOrginalSize);
                        }
                    }
                }
            }
        }

        return $backdata;
    }

    public function saveNewPostOfMongoliaX($postData, $filesData, $userOffCode) {
        $backdata = "";
        $thisPostActive = 0;
        $thisPostHasComment = 0;
        $filesData = $this->multiple($filesData);
        $maxCodeNumber = $this->getMaxColumnValue("mglx_post", "code_post", $this->App_Config['mglx_min_news_code']);
        $maxCodeNumber++;

        if (isset($postData['is_active_news']) && $postData['is_active_news'] == "on") {
            $thisPostActive = 1;
        }

        if (isset($postData['is_comment_active']) && $postData['is_comment_active'] == "on") {
            $thisPostHasComment = 1;
        }

        $i = 0;
        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'code_cat' => $postData['selected_daily_news_menu'],
                'code_post' => $maxCodeNumber,
                'code_officer' => $userOffCode,
                'post_title' => $postData['daily_news_name'],
                'post_slug' => $postData['daily_news_slug'],
                'post_preview' => $postData['daily_news_preview'],
                'post_content' => $this->tls->cn_htmltrans($postData['daily_news_content'], "text"),
                'post_images' => "",
                'post_tags' => $postData['post_tags'],
                'post_active' => $thisPostActive,
                'post_with_comment' => $thisPostHasComment,
                'lang_iso_code' => $lang,
                'post_registered' => $this->dbMan->now(),
                'post_updated' => $this->dbMan->now()
            );


            if ($lang == "mn") {
                $data['post_translated'] = 1;
            }

            $new_mglx_news_id = $this->dbMan->insert('mglx_post', $data);
            if ($new_mglx_news_id) {
                $backdata .= $new_mglx_news_id . ' id data inserted. <br/>';
                $i++;
            } else {
                $backdata .= 'Data no insert.....' . $this->dbMan->getLastError() . "<br/>";
            }
        }
        $i = 2;
        if ($i > 0) {

            $new_news_images = "";
            foreach ($filesData['daily_news_img'] as $key => $value) {
                $upload_path_parts = pathinfo($filesData['daily_news_img'][$key]['name']);
                $uploadFile_extension = $upload_path_parts['extension'];
                $newNewsFileName = $this->getNewFileName("daily_news", $uploadFile_extension);
                $new_news_images .= $newNewsFileName['with_extension'] . ";";
                if (isset($filesData['daily_news_img'][$key])) {
                    $message = $this->fileUploader($filesData['daily_news_img'][$key], $newNewsFileName['no_extension'], $this->App_Config['mglx_post_img_upload_path'], $this->App_Config['upload_path_year_month'], TRUE, FALSE);
                    $backdata .= $message;
                }
            }

            $data = Array(
                'post_images' => $new_news_images
            );

            $this->dbMan->where('code_post', $maxCodeNumber);

            if ($this->dbMan->update('mglx_post', $data)) {
                $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
            } else {
                $backdata .= 'daily news records are update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
            }
        }

        return $backdata;
    }

    private function getCurrentTimeStamp() {
        $myDate = new \DateTime();
        $currentTimeStamp = $myDate->getTimestamp();
        return $currentTimeStamp;
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
		//$message = $this->fileUploader($filesData['daily_news_img'][$key], $newNewsFileName['no_extension'], $this->App_Config['mglx_post_img_upload_path'], $this->App_Config['upload_path_year_month'], TRUE, FALSE);
        $dir_dest = DOCROOT . $upload_path . $year_month . "/";

        //$uploader_big = new upload_big();
        echo("dooom: ".$dir_dest);

        $handle = new \Upload($uploadObject);

        if ($handle->uploaded) {
            $orginImage_X_pixels = $handle->image_src_x;
            $orginImage_Y_pixels = $handle->image_src_y;
            // yes, the file is on the server
            // now, we start the upload 'process'. That is, to copy the uploaded file
            // from its temporary location to the wanted location
            // It could be something like $handle->Process('/home/www/my_uploads/');


            foreach ($this->App_Config['mglx_seven_image_sizes'] as $key) {
                $newWidth = $key['width'];
                $newHeight = $key['height'];

                $handle->image_resize = true;
                //$handle->image_ratio_y = true;
                $handle->image_ratio_crop = true;

                if ($key['fontSize'] != 0) {
                    $handle->image_text = 'MongoliaX.MN';
                    $handle->image_text_opacity = 40;
                    $handle->image_text_x = 3;
                    $handle->image_text_y = 3;
                    $handle->image_text_font = $key['fontSize'];
                }

                //$handle->image_x                 = $smallest_X;
                $handle->file_new_name_body = $newFileName;

                $handle->file_name_body_add = "_X" . $newWidth;

                if ($orginImage_X_pixels > $newWidth) {
                    $handle->image_x = $newWidth;
                } else {
                    $handle->image_x = $orginImage_X_pixels;
                }

                if ($orginImage_Y_pixels > $newHeight) {
                    $handle->image_y = $newHeight;
                } else {
                    $handle->image_y = $orginImage_Y_pixels;
                }

                $handle->Process($dir_dest);
                if ($handle->processed) {
                    echo '  <br/><b>File resized success with ' . "_X" . $newWidth . '</b><br />';
                } else {
                    echo '  <br/><b>File not resized to the wanted location</b><br />';
                }
            }

            //we delete the temporary files
            $handle->Clean();
        } else {
            $backdata = '  <b>File not uploaded on the server</b>' . '  Error: ' . $handle->error . '<br/>';
        }

        unset($handle);
        return $backdata;
    }

    public function saveNewNewsCategory($postData) {
        $backdata = "";
        $maxCode = $this->getMaxColumnValue("mglx_category", "code_cat", $this->App_Config['mglx_category_min_code']);
        $maxCode++;
        foreach ($this->reg_lang as $lang) {
            $data = Array(
                'code_cat' => $maxCode,
                'cat_name' => $postData['news_category_name'],
                'cat_slug' => $postData['news_category_slug'],
                'cat_order' => 0,
                'cat_parent' => $postData['select_parent_category'],
                'lang_iso_code' => $lang,
                'cat_updated' => $this->dbMan->now(),
                'cat_registered' => $this->dbMan->now()
            );
            $new_category_id = $this->dbMan->insert('mglx_category', $data);
            if ($new_category_id) {
                $backdata .= "ID:" . $new_category_id . ' data is inserted.<br/>';
            } else {
                $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
            }
        }
        return $backdata;
    }

    // -------------------------------------------- private function area --------------------------------------------------------------------------------

    private function getMaxColumnValue($dbTable, $dbColumn, $relationMinNumber = NULL) {
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

}
