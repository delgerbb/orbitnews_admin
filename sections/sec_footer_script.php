<!-- core JavaScript -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/js/plugins/pace/pace.min.js"></script>

<script type="text/javascript">
    var js_web_root = "http://office.mongoliax.mn/";
    var regexForNewsSlug = new RegExp("^([a-zA-Z0-9-_]{8,50})$");
    var errorTextColor = "#F34A51";

    $(document).ready(function () {
        $("img[id=changeSystemLanguage]").on("click", function () {
            var userWantedLang = $(this).data('syslang');
            $.ajax({
                method: "POST",
                url: js_web_root + "dataAction.php",
                data: {tobeChangeLang: userWantedLang, dataSwitch: "UWCL256"}
            }).done(function (msg) {
                alert("status: " + msg);
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            }).always(function () {
                //alert("complete");
                location.reload();
            });
        });
    });

    function createWaiting() {
        $('<div />', {id: 'waiting-for-process', 'html': '<img src="//office.mongoliax.mn/assets/images/loading.gif" />'}).appendTo('body');
    }
    function dismissWaiting() {
        if ($('#waiting-for-process').length) {
            $("#waiting-for-process").remove();
        }
    }

    function removeThisImageBox(thisBox) {
        var jqueryThisBox = $(thisBox);
        jqueryThisBox.parent().parent().remove().fadeOut("slow");
    }

    function validateEmail(email) {
        var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        var valid = emailReg.test(email);

        if (!valid) {
            return false;
        } else {
            return true;
        }
    }

</script>

<?php if ($body_script == "new_videos_pictures_galleries"): ?>
    <script type="text/javascript">
        $(document).on('change', '#newHomePageImage', function () {
            //loadFile1(event, 1);
        });
    </script>
<?php endif; ?>

<?php if ($body_script == "edit_old_videos_pictures_galleries"): ?>
    <script type="text/javascript">
        var loboPicturesCount = 1;
        var cataPicturesCount = 1;

        $(document).ready(function () {
            $("#js_btn_add_lookbook_picture").on("click", function () {
                if (loboPicturesCount <= 3) {
                    var containerCataPICs = $(".containerOldLookbookPictures");
                    containerCataPICs.append("<div class='perCatalogPicContainer'>\n\
                        <div class='row'><div class='col-sm-3'><label class='col-sm-4 control-label'>зураг-" + loboPicturesCount + ":</label></div><div class='col-sm-9'><input type='file' name='lobo_img[file" + loboPicturesCount + "]' onchange='loadFile1(event," + loboPicturesCount + ")'></div></div>\n\
                        <div class='row'><div class='col-sm-4'><input type='text' class='form-control' placeholder='зургийн гарчиг ...'><div class='space-4'></div><textarea class='form-control' id='maxL-3' maxlength='225' rows='2' placeholder='зургийн тайлбар ...'></textarea></div><div class='col-sm-8'><img id='output" + loboPicturesCount + "' style='width: 150px;border:1px solid #ddd;border-radius: 5px;padding: 2px;max-height: 200px;'/></div></div>\n\
                    </div>");
                }
                loboPicturesCount++;
            });

            $("#btn_add_catalog_picture").on("click", function () {
                if (cataPicturesCount <= 3) {
                    var containerCataPICs = $(".containerNewCatalogPictures");
                    containerCataPICs.append("<div class='perCatalogPicContainer'>\n\
                        <div class='row'><div class='col-sm-3'><label class='col-sm-4 control-label'>зураг-" + cataPicturesCount + ":</label></div><div class='col-sm-9'><input type='file' name='cata_img[file" + cataPicturesCount + "]' onchange='loadFile1(event," + cataPicturesCount + ")'></div></div>\n\
                        <div class='row'><div class='col-sm-4'><input type='text' class='form-control' placeholder='зургийн гарчиг ...'><div class='space-4'></div><textarea class='form-control' id='maxL-3' maxlength='225' rows='2' placeholder='зургийн тайлбар ...'></textarea></div><div class='col-sm-8'><img id='output" + cataPicturesCount + "' style='width: 150px;border:1px solid #ddd;border-radius: 5px;padding: 2px;max-height: 200px;'/></div></div>\n\
                    </div>");
                }
                cataPicturesCount++;
            });
        });
    </script>
<?php endif; ?>

<?php if ($body_script == "old_store"): ?>
    <script language="javaScript" type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea.store_news_content",
            theme: "modern",
            forced_root_block: '', // Needed for 3.x
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | responsivefilemanager | forecolor backcolor emoticons",
            image_advtab: true,
            external_filemanager_path: js_web_root + "assets/filemanager/",
            filemanager_title: "Сервер дээрхи файл удирдах хэсэг",
            external_plugins: {"filemanager": js_web_root + "assets/filemanager/plugin.min.js"}
            /*
             templates: [
             {title: 'Test template 1', content: '<b>Test 1</b>'},
             {title: 'Test template 2', content: '<em>Test 2</em>'}
             ]
             */
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            //alert("new store");
        });

        $(document).ready(function () {
            $('#selected_store_country').on('change', function (e) {
                //var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                $("#selected_country_code").val(valueSelected);
                if (valueSelected !== "none") {
                    $.ajax({
                        method: "POST",
                        url: js_web_root + "dataAction.php",
                        data: {selectedCountryCode: valueSelected, dataSwitch: "LOSD309"}
                    }).done(function (msg) {
                        //alert(msg);

                        $(".countryStoresHTML").html(msg);

                        /*
                         msg = JSON.parse(msg);
                         $.each(msg, function (key1, value1) {
                         switch (key1) {
                         case "size_guide_title":
                         $("#old_model_size_title").val(value1);
                         break;
                         case "size_guide_content":
                         //$("#model_care_content").val(value2);
                         tinyMCE.activeEditor.setContent(value1);
                         break;
                         case "code_size_guide":
                         $("#old_model_size_code").val(value1);
                         break;
                         case "size_guide_sex":
                         var modelSizeMaleText = "";
                         if (value1 === 0) {
                         modelSizeMaleText = "female";
                         } else if (value1 === 1) {
                         modelSizeMaleText = "male";
                         } else {
                         modelSizeMaleText = "both";
                         }
                         $('input:radio[name="old_model_size_sex"]').filter("[value=" + modelSizeMaleText + "]").attr('checked', true);
                         break;
                         case "lang_iso_code":
                         $("#old_model_size_lang").val(value1);
                         break;
                         default:
                         
                         break;
                         }
                         });
                         */
                    }).fail(function (jqXHR, textStatus) {
                        alert("Request failed: " + textStatus);
                    }).always(function () {
                        //alert("complete");
                    });

                }
            });
        });

        function loadCountryDataByCodeJS(editStoreCode) {
            //alert(editStoreCode);
            if (editStoreCode.length > 0) {
                $.ajax({
                    method: "POST",
                    url: js_web_root + "dataAction.php",
                    data: {selectedStoreCode: editStoreCode, dataSwitch: "LSDC631"}
                }).done(function (msg) {
                    //alert(msg);

                    //$(".countryStoresHTML").html(msg);

                    //storeName
                    msg = JSON.parse(msg);
                    $.each(msg, function (key1, value1) {
                        switch (key1) {
                            case "code_store":
                                $("#old_code_store").val(value1);
                                break;
                            case "store_name":
                                $("#storeName").val(value1);
                                break;
                            case "size_guide_content":
                                //$("#model_care_content").val(value2);
                                tinyMCE.activeEditor.setContent(value1);
                                break;
                            case "store_phones":
                                $("#storeTelephone").val(value1);
                                break;
                            case "store_fax":
                                $("#storeFax").val(value1);
                                break;
                            case "store_email":
                                $("#storeEmail").val(value1);
                                break;
                            case "store_website":
                                $("#storeWeb").val(value1);
                                break;
                            case "store_address":
                                $("#storeAddress").val(value1);
                                break;
                            case "lang_iso_code":
                                $("#old_store_lang").val(value1);
                                break;
                            default:

                                break;
                        }
                    });

                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                }).always(function () {
                    //alert("complete");
                });

            }
        }
    </script>
<?php endif; ?>

<?php if ($body_script == "new_store"): ?>
    <script language="javaScript" type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea.store_news_content",
            theme: "modern",
            forced_root_block: '', // Needed for 3.x
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | responsivefilemanager | forecolor backcolor emoticons",
            image_advtab: true,
            external_filemanager_path: js_web_root + "assets/filemanager/",
            filemanager_title: "Сервер дээрхи файл удирдах хэсэг",
            external_plugins: {"filemanager": js_web_root + "assets/filemanager/plugin.min.js"}
            /*
             templates: [
             {title: 'Test template 1', content: '<b>Test 1</b>'},
             {title: 'Test template 2', content: '<em>Test 2</em>'}
             ]
             */
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            //alert("new store");
        });
    </script>
<?php endif; ?>

<?php if ($body_script == "monitor_company_news"): ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $("input:checkbox").on('click', function () {
                // in the handler, 'this' refers to the box clicked on
                var $box = $(this);
                if ($box.is(":checked")) {
                    // the name of the box is retrieved using the .attr() method
                    // as it is assumed and expected to be immutable
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    // the checked state of the group/box on the other hand will change
                    // and the current value is retrieved using .prop() method
                    $(group).prop("checked", false);
                    $box.prop("checked", true);

                    if (typeof $box.data("target") === "undefined") {
                        $("#selected_name_type_value").val($box.val());
                        $.ajax({
                            method: "POST",
                            url: js_web_root + "dataAction.php",
                            data: {companyNewsMenuCode: $box.val(), dataSwitch: "LCNTD661"}
                        }).done(function (msg) {
                            //$("#dailyNewsPreviewTableContainer").html(msg);
                            $("#ajaxCompanyNewsTableData").html(msg);
                            //msg = JSON.parse(msg);

                            /*
                             $.each(msg, function (key1, value1) {
                             var lastMenuName = "";
                             $.each(value1, function (key2, value2) {
                             
                             if (key2 == "product_menu_name") {
                             lastMenuName = value2;
                             }
                             
                             if (key2 == "lang_iso_code") {
                             $("#lang_menu_" + value2).val(lastMenuName);
                             }
                             
                             });
                             });*/

                        }).fail(function (jqXHR, textStatus) {
                            alert("Request failed: " + textStatus);
                        }).always(function () {
                            //alert("complete");
                            scrollToAnchor("goto_manager_table");
                        });

                    }

                } else {
                    $box.prop("checked", false);
                }
            });
        });
    </script>
<?php endif; ?>

<?php if ($body_script == "monitor_news_news"): ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $("input:checkbox").on('click', function () {
                // in the handler, 'this' refers to the box clicked on
                var $box = $(this);
                if ($box.is(":checked")) {
                    // the name of the box is retrieved using the .attr() method
                    // as it is assumed and expected to be immutable
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    // the checked state of the group/box on the other hand will change
                    // and the current value is retrieved using .prop() method
                    $(group).prop("checked", false);
                    $box.prop("checked", true);

                    if (typeof $box.data("target") === "undefined") {
                        $("#selected_name_type_value").val($box.val());
                        $.ajax({
                            method: "POST",
                            url: js_web_root + "dataAction.php",
                            data: {dailyNewsMenuCode: $box.val(), dataSwitch: "LDNTD226"}
                        }).done(function (msg) {
                            $("#dailyNewsPreviewTableContainer").html(msg);
                            //msg = JSON.parse(msg);

                            /*
                             $.each(msg, function (key1, value1) {
                             var lastMenuName = "";
                             $.each(value1, function (key2, value2) {
                             
                             if (key2 == "product_menu_name") {
                             lastMenuName = value2;
                             }
                             
                             if (key2 == "lang_iso_code") {
                             $("#lang_menu_" + value2).val(lastMenuName);
                             }
                             
                             });
                             });*/

                        }).fail(function (jqXHR, textStatus) {
                            alert("Request failed: " + textStatus);
                        }).always(function () {
                            //alert("complete");
                        });

                    }

                } else {
                    $box.prop("checked", false);
                }
            });
        });
    </script>
<?php endif; ?>

<?php if ($body_script == "model_sizes"): ?>
    <script language="javaScript" type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea.model_size_content",
            theme: "modern",
            forced_root_block: '', // Needed for 3.x
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | responsivefilemanager | forecolor backcolor emoticons",
            image_advtab: true,
            external_filemanager_path: js_web_root + "assets/filemanager/",
            filemanager_title: "Сервер дээрхи файл удирдах хэсэг",
            external_plugins: {"filemanager": js_web_root + "assets/filemanager/plugin.min.js"}
            /*
             templates: [
             {title: 'Test template 1', content: '<b>Test 1</b>'},
             {title: 'Test template 2', content: '<em>Test 2</em>'}
             ]
             */
        });

        tinymce.init({
            selector: "textarea.old_model_size_content",
            theme: "modern",
            forced_root_block: '', // Needed for 3.x
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | responsivefilemanager | forecolor backcolor emoticons",
            image_advtab: true,
            external_filemanager_path: js_web_root + "assets/filemanager/",
            filemanager_title: "Сервер дээрхи файл удирдах хэсэг",
            external_plugins: {"filemanager": js_web_root + "assets/filemanager/plugin.min.js"}
            /*
             templates: [
             {title: 'Test template 1', content: '<b>Test 1</b>'},
             {title: 'Test template 2', content: '<em>Test 2</em>'}
             ]
             */
        });

        $(document).ready(function () {
            $('#selected_model_size').on('change', function (e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;

                if (valueSelected !== "none") {
                    $.ajax({
                        method: "POST",
                        url: js_web_root + "dataAction.php",
                        data: {selectedSizeCode: valueSelected, dataSwitch: "LMSGE105"}
                    }).done(function (msg) {
                        msg = JSON.parse(msg);
                        $.each(msg, function (key1, value1) {
                            switch (key1) {
                                case "size_guide_title":
                                    $("#old_model_size_title").val(value1);
                                    break;
                                case "size_guide_content":
                                    //$("#model_care_content").val(value2);
                                    tinyMCE.activeEditor.setContent(value1);
                                    break;
                                case "code_size_guide":
                                    $("#old_model_size_code").val(value1);
                                    break;
                                case "size_guide_sex":
                                    var modelSizeMaleText = "";
                                    if (value1 === 0) {
                                        modelSizeMaleText = "female";
                                    } else if (value1 === 1) {
                                        modelSizeMaleText = "male";
                                    } else {
                                        modelSizeMaleText = "both";
                                    }

                                    $('input:radio[name="old_model_size_sex"]').filter("[value=" + modelSizeMaleText + "]").attr('checked', true);

                                    //model_size_male


                                    break;
                                case "lang_iso_code":
                                    $("#old_model_size_lang").val(value1);
                                    break;
                                default:

                                    break;
                            }
                        });


                        /*
                         {
                         "id_size_guide": 31,
                         "code_size_guide": 3506,
                         "size_guide_title": "ХҮҮХЭД: ГАДУУР ХҮРЭМ, СҮЛЖМЭЛ ХУВЦАС, ЦАМЦ БОЛОН ӨМД",
                         "size_guide_content": "&lt;table style=\\&quot;height: 25px;\\&quot; width=\\&quot;777\\&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;НАС&lt;/td&gt;\r\n&lt;td&gt;2&lt;/td&gt;\r\n&lt;td&gt;4&lt;/td&gt;\r\n&lt;td&gt;6&lt;/td&gt;\r\n&lt;td&gt;8&lt;/td&gt;\r\n&lt;td&gt;10&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;ӨНДӨР - СМ&lt;/td&gt;\r\n&lt;td&gt;89&lt;/td&gt;\r\n&lt;td&gt;104&lt;/td&gt;\r\n&lt;td&gt;116&lt;/td&gt;\r\n&lt;td&gt;128&lt;/td&gt;\r\n&lt;td&gt;140&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;",
                         "size_guide_sex": 2,
                         "lang_iso_code": "mn",
                         "size_guide_updated": "2015-06-17 17:04:22",
                         "size_guide_registered": "2015-06-17 17:04:22"
                         }
                         */

                    }).fail(function (jqXHR, textStatus) {
                        alert("Request failed: " + textStatus);
                    }).always(function () {
                        //alert("complete");
                    });

                }
            });
        });






    </script>
<?php endif; ?> 

<?php if ($body_script == "hr_old_jobs"): ?>
    <script language="javaScript" type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea.newJobRequirements",
            theme: "modern",
            forced_root_block: '', // Needed for 3.x
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | responsivefilemanager | forecolor backcolor emoticons",
            image_advtab: true,
            external_filemanager_path: js_web_root + "assets/filemanager/",
            filemanager_title: "Сервер дээрхи файл удирдах хэсэг",
            external_plugins: {"filemanager": js_web_root + "assets/filemanager/plugin.min.js"}
            /*
             templates: [
             {title: 'Test template 1', content: '<b>Test 1</b>'},
             {title: 'Test template 2', content: '<em>Test 2</em>'}
             ]
             */
        });

        function loadAjaxJobData(jobCode) {
            $.ajax({
                method: "POST",
                url: js_web_root + "dataAction.php",
                data: {loadJobCode: jobCode, dataSwitch: "LJDBC623"}
            }).done(function (msg) {
                msg = JSON.parse(msg);
                $.each(msg, function (key1, value1) {
                    var lastMenuName = "";
                    switch (key1) {
                        case "code_job":
                            $("#openJobSlug").val(value1);
                            break;
                        case "job_name":
                            $("#openJobName").val(value1);
                            break;
                        case "job_intro":
                            $("#newJobIntroduction").val(value1);
                            break;
                        case "job_requirement":
                            tinyMCE.activeEditor.setContent(value1);
                            break;
                        case "job_openfrom":
                            $("#jobOnBoardOpenFrom").val(value1);
                            break;
                        case "job_opento":
                            $("#jobOnBoardOpenTo").val(value1);
                            break;
                        case "job_sex":
                            $("#openJobSex option").each(function (i) {
                                //alert($(this).text() + " : " + $(this).val());
                                if (value1 === $(this).val()) {
                                    //$(this).prop("selected", true);
                                    $(this).attr("selected", "selected");
                                }
                            });
                            break;
                        case "job_open":
                            $("#is_active_job").prop("checked", true);
                            break;
                        default:

                            break;
                    }
                });


                /*
                 {
                 "id_job": 1,
                 "code_job": 3001,
                 "job_name": "ХЯТАД ХЭЛТЭЙ ХАРИЛЦААНЫ МЕНЕЖЕР",
                 "job_intro": "Бизнесийн удирдлага, боруулалт болон худалдааны чиглэлээр бакалавр болон түүнээс дээш боловсролтой",
                 "job_requirement": "<ul>\r\n<li>Бизнесийн удирдлага, боруулалт болон худалдааны чиглэлээр бакалавр болон түүнээс дээш боловсролтой</li>\r\n<li>Хятад хэлний өндөр мэдлэгтэй</li>\r\n<li>Харилцааны менежерээр ажиллаж байсан ажлын туршлагатай</li>\r\n<li>Бусдад туслах, зөвөлгөө өгөх дуртай</li>\r\n<li>Бусдыг удирдан зохион байгуулах, манлайлах чадвартай</li>\r\n<li>Цагийн менежмент сайтай</li>\r\n</ul>",
                 "job_sex": "both",
                 "job_company": "",
                 "job_open": 1,
                 "job_openfrom": "2015-06-04 08:00:00",
                 "job_opento": "2015-06-10 23:55:00",
                 "lang_iso_code": "mn",
                 "job_updated": "2015-06-04 17:28:07",
                 "job_registered": "2015-06-04 17:28:07"
                 }
                 */
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            }).always(function () {
                //alert("complete");
            });
        }

        function validateThisForm(thisForm) {
            var formDataIsValid = true;
            if ($("#openJobName").val().length < 4) {
                $("#openJobName_status").html("мэргэжлийн нэрийг 4 тэмдэгтээс урт байх ёстой.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#openJobName_status").html("");
            }

            if ($("#newJobIntroduction").val().length < 5) {
                $("#newJobIntroduction_status").html("мэдээний товч агуулга 5 тэмдэгтээс урт байх ёстой.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#newJobIntroduction_status").html("");
            }

            if ($("#jobOnBoardOpenFrom").val().length < 5) {
                $("#jobOnBoardOpenFrom_status").html("зарлал нээсэн хугацаа буруу байна.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#jobOnBoardOpenFrom_status").html("");
            }

            if ($("#jobOnBoardOpenTo").val().length < 5) {
                $("#jobOnBoardOpenTo_status").html("зарлал хаах хугацаа буруу байна.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#jobOnBoardOpenTo_status").html("");
            }


            if (tinyMCE.activeEditor.getContent().length < 5) {
                $("#newJobRequirements_status").html("мэдээний бүрэн агуулга 5 тэмдэгтээс урт байх ёстой.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#newJobRequirements_status").html("");
            }

            if ($("#openJobSex option:selected").val() === "none") {
                $("#openJobSex_status").html("мэргэжилд хамаарах хүйсийг сонгон уу.").css({"color": "#F34A51"});
            } else {
                $("#openJobSex_status").html("");
            }

            return formDataIsValid;
        }


    </script>
<?php endif; ?>

<?php if ($body_script == "user_login"): ?>
    <!-- PAGE LEVEL PLUGINS JS -->

    <!-- Themes Core Scripts -->	
    <script src="assets/js/main.js"></script>

    <!-- REQUIRE FOR SPEECH COMMANDS -->
    <script src="assets/js/speech-commands.js"></script>
    <script src="assets/js/plugins/gritter/jquery.gritter.min.js"></script>	

    <!-- initial page level scripts for examples -->	
    <script type="text/javascript">
        function show_box(id) {
            jQuery('.login-box.visible').removeClass('visible');
            jQuery('#' + id).addClass('visible');
        }

        $("#btn_user_wants_loginning").on("click", function () {
            //alert("you want get in");
            $(".system_progress").html("<img src='//office.mongoliax.mn/assets/images/loading.gif' width='32' height='32'/> wait for checking...");
            var user_name_val = $("#user_name").val();
            var user_password_val = $("#user_password").val();
            $.ajax({
                method: "POST",
                url: js_web_root + "dataAction.php",
                data: {pass_user_name: user_name_val, pass_user_password: user_password_val, dataSwitch: "CUDV895"}
            }).done(function (msg) {
                if (msg === "user_is_valid") {
                    $(".system_progress").html("<i class='fa fa-check bigger-110 text-success'></i> success, wait for two seconds.");
                    location.reload(true);
                    //window.setTimeout(location.reload(true), 5000);
                } else {
                    $(".system_progress").html("<i class='fa fa-times bigger-110 text-danger'></i> error, incorrect details.");
                }
                //msg = JSON.parse(msg);
                /* 
                 <ul class="list-unstyled list-inline">
                 <li><i class="fa fa-check bigger-110 text-success"></i> List inline item #1</li>
                 <li><i class="fa fa-times bigger-110 text-danger"></i> inline item #2</li>
                 <li><i class="fa fa-angle-right bigger-110"></i> inline item #3</li>
                 </ul>
                 */
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            }).always(function () {
                //alert("complete");
            });
        });

        $("#btn_UserWantsRecoverPassword").on("click", function () {
            var recoveryEmail = $("#val_recovery_email").val();
            if (validateEmail(recoveryEmail)) {
                $.ajax({
                    method: "POST",
                    url: js_web_root + "dataAction.php",
                    data: {recoveryEmail: recoveryEmail, dataSwitch: "UWRHA365"}
                }).done(function (msg) {
                    //msg = JSON.parse(msg);
                    if (msg === "valid_email") {
                        alert("И-мэйл хаяг зөв мөн бүртгэлтэй байсан боловч и-мэйл илгээж чадсангүй, админтай холбоо барин уу!.");
                    } else if (msg === "wrong_email") {
                        alert("MongoliaX.MN сайт дээр бүртгэлгүй И-мэйл хаяг байна, Вебсайтын админтай холбоо барин уу!.");
                    } else if (msg === "valid_email_sent") {
                        alert("Нууц үг сэргээх кодыг таны и-мэйл лүү явуулсан тул Inbox эсвэл Spam хавтасыг давхар шалгана уу!.");
                    }
                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                }).always(function () {
                    //alert("complete");
                });
            } else {
                alert("Алдаа: та буруу хэлбэртэй и-мэйл хаяг оруулсан байна. Засаад дахин оролдоно уу!.");
            }
        });


    </script>
<?php endif; ?>

<?php if ($body_script == "edit_product_menu"): ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $("input:checkbox").on('click', function () {
                // in the handler, 'this' refers to the box clicked on
                var $box = $(this);
                if ($box.is(":checked")) {
                    // the name of the box is retrieved using the .attr() method
                    // as it is assumed and expected to be immutable
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    // the checked state of the group/box on the other hand will change
                    // and the current value is retrieved using .prop() method
                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                    if (typeof $box.data("target") === "undefined") {
                        $("#selected_name_type_value").val($box.val());

                        $.ajax({
                            method: "POST",
                            url: js_web_root + "dataAction.php",
                            data: {editMenuCode: $box.val(), dataSwitch: "LEMD415"}
                        }).done(function (msg) {
                            //alert("Data Saved: " + msg);
                            msg = JSON.parse(msg);
                            $.each(msg, function (key1, value1) {
                                var lastMenuName = "";
                                $.each(value1, function (key2, value2) {
                                    if (key2 == "product_menu_name") {
                                        lastMenuName = value2;
                                    }

                                    if (key2 == "lang_iso_code") {
                                        $("#lang_menu_" + value2).val(lastMenuName);
                                    }
                                });
                            });

                        }).fail(function (jqXHR, textStatus) {
                            alert("Request failed: " + textStatus);
                        }).always(function () {
                            //alert("complete");
                        });
                    }
                } else {
                    $box.prop("checked", false);
                }
            });
        });
    </script>

<?php endif; ?>

<?php if ($body_script == "hr_new_job"): ?>
    <script language="JavaScript" type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">

        tinymce.init({
            selector: "textarea.newJobRequirements",
            theme: "modern",
            forced_root_block: '', // Needed for 3.x
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | responsivefilemanager | forecolor backcolor emoticons",
            image_advtab: true,
            external_filemanager_path: js_web_root + "assets/filemanager/",
            filemanager_title: "Сервер дээрхи файл удирдах хэсэг",
            external_plugins: {"filemanager": js_web_root + "assets/filemanager/plugin.min.js"}
            /*
             templates: [
             {title: 'Test template 1', content: '<b>Test 1</b>'},
             {title: 'Test template 2', content: '<em>Test 2</em>'}
             ]
             */
        });

        function validateThisForm(thisForm) {
            var formDataIsValid = true;
            if ($("#openJobName").val().length < 4) {
                $("#openJobName_status").html("мэргэжлийн нэрийг 4 тэмдэгтээс урт байх ёстой.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#openJobName_status").html("");
            }

            /*
             if ($("#daily_news_slug").val().length < 4) {
             $("#daily_news_slug_status").html("интернет хаяг 4 тэмдэгтээс урт байх ёстой.").css({"color": "#F34A51"});
             formDataIsValid = false;
             } else {
             $("#daily_news_slug_status").html("");
             }*/

            if ($("#newJobIntroduction").val().length < 5) {
                $("#newJobIntroduction_status").html("мэдээний товч агуулга 5 тэмдэгтээс урт байх ёстой.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#newJobIntroduction_status").html("");
            }

            if ($("#jobOnBoardOpenFrom").val().length < 5) {
                $("#jobOnBoardOpenFrom_status").html("зарлал нээсэн хугацаа буруу байна.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#jobOnBoardOpenFrom_status").html("");
            }

            if ($("#jobOnBoardOpenTo").val().length < 5) {
                $("#jobOnBoardOpenTo_status").html("зарлал хаах хугацаа буруу байна.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#jobOnBoardOpenTo_status").html("");
            }


            if (tinyMCE.activeEditor.getContent().length < 5) {
                $("#newJobRequirements_status").html("мэдээний бүрэн агуулга 5 тэмдэгтээс урт байх ёстой.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#newJobRequirements_status").html("");
            }

            if ($("#openJobSex option:selected").val() === "none") {
                $("#openJobSex_status").html("мэргэжилд хамаарах хүйсийг сонгон уу.").css({"color": "#F34A51"});
            } else {
                $("#openJobSex_status").html("");
            }

            return formDataIsValid;
        }

    </script>
<?php endif; ?>

<?php if ($body_script == "edit_news_news"): ?>  
    <script language="javaScript" type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea.daily_news_content",
            theme: "modern",
            forced_root_block: '', // Needed for 3.x
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | responsivefilemanager | forecolor backcolor emoticons",
            image_advtab: true,
            external_filemanager_path: js_web_root + "assets/filemanager/",
            filemanager_title: "Сервер дээрхи файл удирдах хэсэг",
            external_plugins: {"filemanager": js_web_root + "assets/filemanager/plugin.min.js"}
            /*
             templates: [
             {title: 'Test template 1', content: '<b>Test 1</b>'},
             {title: 'Test template 2', content: '<em>Test 2</em>'}
             ]
             */
        });

        $(document).ready(function () {
            $("input:checkbox").on('click', function () {
                // in the handler, 'this' refers to the box clicked on
                var $box = $(this);
                if ($box.is(":checked")) {
                    // the name of the box is retrieved using the .attr() method
                    // as it is assumed and expected to be immutable
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    // the checked state of the group/box on the other hand will change
                    // and the current value is retrieved using .prop() method
                    $(group).prop("checked", false);
                    $box.prop("checked", true);

                    //var plant = document.getElementById('strawberry-plant');
                    //var fruitCount = plant.getAttribute('data-fruit'); // fruitCount = '12'

                    if (typeof $box.data("target") === "undefined") {
                        createWaiting();
                        var checkedMenuCode = $box.data('newsm02');
                        $.ajax({
                            method: "POST",
                            url: js_web_root + "dataAction.php",
                            data: {checkedNewsMenuCode: checkedMenuCode, dataSwitch: "VDNL846"}
                        }).done(function (msg) {
                            //msg = JSON.parse(msg);
                            $("#dailyNewsPreviewTableContainer").html(msg);
                        }).fail(function (jqXHR, textStatus) {
                            alert("Request failed: " + textStatus);
                        }).always(function () {
                            //alert("complete");
                            dismissWaiting();
                            scrollToAnchor('goto_news_list');
                        });
                        //$("#".$box.data("target")).val();
                        $("#selected_daily_news_menu").val($box.val());
                    }
                } else {
                    $box.prop("checked", false);
                }
            });
        });

        function loadEditDailyNewsByCode(tobeLoadCode) {
            createWaiting();
            $.ajax({
                method: "POST",
                url: js_web_root + "dataAction.php",
                data: {tobeLoadCode: tobeLoadCode, dataSwitch: "LFDN440"}
            }).done(function (msg) {
                msg = JSON.parse(msg);
                $.each(msg, function (key1, value1) {
                    switch (key1) {
                        case "post_title":
                            $("#daily_news_name").val(value1);
                            break;
                        case "post_slug":
                            $("#daily_news_slug").val(value1);
                            //$('#daily_news_slug').prop('readonly', true);
                            break;
                        case "post_preview":
                            $("#daily_news_preview").val(value1);
                            break;
                        case "post_content":
                            tinyMCE.activeEditor.setContent(value1);
                            break;
                        case "post_images":
                            var imagesSRC = "";
                            var postImages = value1.split(";", (value1.split(";").length) - 1);
                            var j = 0;
                            //alert(postImages.length);
                            for (j = 0; j < postImages.length; j++) {
                                if (j !== postImages.length) {
                                    //alert(postImages[j]);
                                    var singleImage = postImages[j];
                                    var varsingleImageParts = singleImage.split(".");
                                    var singleImage_X200 = varsingleImageParts[0] + "_X200." + varsingleImageParts[1];
                                    //PIC_NEWS_2016_01_1451924137_635450.jpg
                                    var uploadMonth = singleImage_X200.substring(9, 16);
                                    //alert(uploadMonth);
                                    var imgUploadRoot = "<?= $app_config['media_root_path']; ?>";
                                    var imgUploadPath = "<?= $app_config['mglx_post_img_url_path']; ?>";
                                    imagesSRC += "<img class='img-responsive img-thumbnail' src='" + imgUploadRoot + imgUploadPath + uploadMonth + "/" + singleImage_X200 + "' />";

                                }
                            }
                            $("#newsOldImagesContainer").html(imagesSRC);
                            break;
                        case "post_active":
                            if (value1 === 1) {
                                $('#is_active_news').attr('checked', true);
                            } else {
                                $('#is_active_news').attr('checked', false);
                            }
                            break;
                        case "post_translated":
                            if (value1 === 1) {
                                $('#is_translated_news').prop('checked', true);
                            } else {
                                $('#is_translated_news').prop('checked', false);
                            }
                            break;
                        case "post_featured":
                            if (value1 === 1) {
                                $('#isFeaturedPost').prop('checked', true);
                            } else {
                                $('#isFeaturedPost').prop('checked', false);
                            }
                            break;
                        case "post_updated":
                            $("#dailyNewsPublishDateTime").val(value1);
                            break;
                        default:
                            break;
                    }
                });
                //$("#dailyNewsPreviewTableContainer").html(msg);
                dismissWaiting();
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            }).always(function () {
                //alert("complete");
                $("#selected_daily_news_code").val(tobeLoadCode);
                //window.location.hash = "goto_news_details";
                scrollToAnchor('goto_news_details');
            });
        }

        function deleteThisDailyNewsByCode(choosenNewsCode) {
            //alert("delete new code: " + dailyNewsCode);

            if (confirm("Энэ үйлдэл энэ мэдээг утсгах болно !!!. (мэдээний код: " + choosenNewsCode + "), мэдээг устгах гэж байна уу?") === true) {
                $.ajax({
                    method: "POST",
                    url: js_web_root + "dataAction.php",
                    data: {editorChoosenNewsCode: choosenNewsCode, dataSwitch: "DTNBC986"}
                }).done(function (msg) {
                    alert("мэдээ устгагдсан: " + msg);
                    //msg = JSON.parse(msg);
                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                }).always(function () {
                    //alert("complete");
                    //$("#selected_daily_news_code").val(tobeLoadCode);
                    //window.location.hash = "goto_news_details";
                });
            }
        }

        function shiftDailyNewsInEditForm(dailyNewsCode) {
            //alert("edit: " + dailyNewsCode);
            if (confirm("This action will insert this news (code: " + dailyNewsCode + ") in edit form, are you do this?") === true) {
                $.ajax({
                    method: "POST",
                    url: js_web_root + "dataAction.php",
                    data: {dailyNewsCode: dailyNewsCode, dataSwitch: "SDNEF230"}
                }).done(function (msg) {
                    alert("Data Saved: " + msg);
                    //msg = JSON.parse(msg);
                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                }).always(function () {
                    //alert("complete");
                    //$("#selected_daily_news_code").val(tobeLoadCode);
                    //window.location.hash = "goto_news_details";
                });
            }
        }

        function shiftDailyNewsInLiveForm(dailyNewsCode) {
            //alert("live: " + dailyNewsCode);

            if (confirm("This action will print this news (code: " + dailyNewsCode + ") on webpage, are you do this?") === true) {
                $.ajax({
                    method: "POST",
                    url: js_web_root + "dataAction.php",
                    data: {dailyNewsCode: dailyNewsCode, dataSwitch: "SDNLF983"}
                }).done(function (msg) {
                    alert("Data Saved: " + msg);
                    //msg = JSON.parse(msg);
                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                }).always(function () {
                    //alert("complete");
                    //$("#selected_daily_news_code").val(tobeLoadCode);
                    //window.location.hash = "goto_news_details";
                });
            }
        }

        function validateThisForm(thisForm) {
            var formDataIsValid = true;
            if ($("#daily_news_name").val().length < 4) {
                $("#daily_news_name_status").html("мэдээний гарчиг 4 тэмдэгтээс урт байх ёстой.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#daily_news_name_status").html("");
            }

            if ($("#daily_news_slug").val().length < 4) {
                $("#daily_news_slug_status").html("интернет хаяг 4 тэмдэгтээс урт байх ёстой.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#daily_news_slug_status").html("");
            }

            if ($("#daily_news_preview").val().length < 5) {
                $("#daily_news_preview_status").html("мэдээний товч агуулга 5 тэмдэгтээс урт байх ёстой.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#daily_news_preview_status").html("");
            }

            if ($("#dailyNewsPublishDateTime").val().length < 5) {
                $("#dailyNewsPublishDateTime_status").html("мэдээ хэвлэгдэх огноог зөв сонгон уу.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#dailyNewsPublishDateTime_status").html("");
            }


            if (tinyMCE.activeEditor.getContent().length < 5) {
                $("#daily_news_content_status").html("мэдээний бүрэн агуулга 5 тэмдэгтээс урт байх ёстой.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#daily_news_content_status").html("");
            }

            if ($("#selected_daily_news_menu").val().length < 1) {
                $("#daily_news_menu_status").html("мэдээг оруулах цэсийг сонгон уу.").css({"color": "#F34A51"});
                formDataIsValid = false;
            } else {
                $("#daily_news_menu_status").html("");
            }

            $('.containerDailyNewsPictures').find("input").each(function (i, obj) {
                if ($(this).val().length > 4) {
                    var ext = $(this).val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) === -1) {
                        $("#dailyNewsPictures_status").html("буруу файл сонгосон байна.").css({"color": "#F58086"});
                        formDataIsValid = false;
                    } else {
                        $("#dailyNewsPictures_status").html("");
                    }
                } else {
                    formDataIsValid = false;
                    $("#dailyNewsPictures_status").html("мэдээний зураг сонгон уу.").css({"color": "#F58086"});
                }
            });

            return formDataIsValid;
        }

    </script>
<?php endif; ?>  


<?php if ($body_script == "new_news_news"): ?>
    <script language="JavaScript" type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea.daily_news_content",
            theme: "modern",
            forced_root_block: '', // Needed for 3.x
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | responsivefilemanager | forecolor backcolor emoticons",
            image_advtab: true,
            external_filemanager_path: js_web_root + "assets/filemanager/",
            filemanager_title: "Сервер дээрхи файл удирдах хэсэг",
            external_plugins: {"filemanager": js_web_root + "assets/filemanager/plugin.min.js"}
            /*
             templates: [
             {title: 'Test template 1', content: '<b>Test 1</b>'},
             {title: 'Test template 2', content: '<em>Test 2</em>'}
             ]
             */
        });

        $(document).ready(function () {
            $("input:checkbox").on('click', function () {
                // in the handler, 'this' refers to the box clicked on
                var $box = $(this);
                if ($box.is(":checked")) {
                    // the name of the box is retrieved using the .attr() method
                    // as it is assumed and expected to be immutable
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    // the checked state of the group/box on the other hand will change
                    // and the current value is retrieved using .prop() method
                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                    if (typeof $box.data("target") === "undefined") {
                        $("#selected_daily_news_menu").val($box.val());
                    }
                } else {
                    $box.prop("checked", false);
                }
            });
        });


        function validateThisForm(thisForm) {
            var formDataIsValid = true;
            var newNewsSlugText = $("#daily_news_slug").val();

            if ($("#daily_news_name").val().length < 4) {
                $("#daily_news_name_status").html("мэдээний гарчиг 4 тэмдэгтээс урт байх ёстой.").css({"color": errorTextColor});
                formDataIsValid = false;
            } else {
                $("#daily_news_name_status").html("");
            }

            if (!regexForNewsSlug.test(newNewsSlugText)) {
                $("#daily_news_slug_status").html("URL хаяг 8-с 50 тэмдэгт хооронд латин том, жижиг үсэг болон тоо - зураас мөн _ орсон байна. жишээ нь: hello-this-is-news-url").css({"color": errorTextColor});
                formDataIsValid = false;
            } else {
                $("#daily_news_slug_status").html("");
            }

            if ($("#daily_news_preview").val().length < 5) {
                $("#daily_news_preview_status").html("мэдээний товч агуулга 5 тэмдэгтээс урт байх ёстой.").css({"color": errorTextColor});
                formDataIsValid = false;
            } else {
                $("#daily_news_preview_status").html("");
            }

            if (tinyMCE.activeEditor.getContent().length < 5) {
                $("#daily_news_content_status").html("мэдээний бүрэн агуулга 5 тэмдэгтээс урт байх ёстой.").css({"color": errorTextColor});
                formDataIsValid = false;
            } else {
                $("#daily_news_content_status").html("");
            }

            if ($("#selected_daily_news_menu").val().length < 1) {
                $("#daily_news_menu_status").html("мэдээг оруулах цэсийг сонгон уу.").css({"color": errorTextColor});
                formDataIsValid = false;
            } else {
                $("#daily_news_menu_status").html("");
            }

            $('.containerDailyNewsPictures').find("input").each(function (i, obj) {
                if ($(this).val().length > 4) {
                    var ext = $(this).val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) === -1) {
                        $("#dailyNewsPictures_status").html("буруу файл сонгосон байна.").css({"color": errorTextColor});
                        formDataIsValid = false;
                    } else {
                        $("#dailyNewsPictures_status").html("");
                    }
                } else {
                    formDataIsValid = false;
                    $("#dailyNewsPictures_status").html("мэдээний толгой зургийг сонгон уу.").css({"color": errorTextColor});
                }
            });

            if ($('.containerDailyNewsPictures').html().length < 40) {
                formDataIsValid = false;
                $("#dailyNewsPictures_status").html("мэдээний толгой зургийг сонгон уу.").css({"color": errorTextColor});
            }
            return formDataIsValid;
        }

        $("#daily_news_slug").focusout(function () {
            $thisSlugInput = $(this);
            if (!regexForNewsSlug.test($thisSlugInput.val())) {
                $("#daily_news_slug_status").html("URL хаяг 8-с 50 тэмдэгт хооронд латин том, жижиг үсэг болон тоо - зураас мөн _ орсон байна. жишээ нь: hello-this-is-news-url").css({"color": errorTextColor});
                $thisSlugInput.val("");
            } else {
                $("#daily_news_slug_status").html("");
                createWaiting();
                $.ajax({
                    method: "POST",
                    url: js_web_root + "dataAction.php",
                    data: {newNewsRawSlug: $thisSlugInput.val(), dataSwitch: "CNSD267"}
                }).done(function (callBackData) {
                    //alert("Data Saved: " + callBackData);
                    if (callBackData == 1) {
                        $("#daily_news_slug_status").html("бичсэн <strong>" + $thisSlugInput.val() + "</strong> мэдээний URL хаяг өмнө орсон байгаа тул давхардаж байна.").css({"color": errorTextColor});
                        $thisSlugInput.val("");
                    } else {
                        $("#daily_news_slug_status").html("бичсэн мэдээний URL хаяг давхардахгүй байгаа тул авах боломжтой.").css({"color": "#62CF9A"});
                    }
                    //msg = JSON.parse(callBackData);
                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                }).always(function () {
                    //alert("complete");
                    dismissWaiting();
                });
            }
        });
    </script>
<?php endif; ?>

<?php if ($body_script == "new_company_news"): ?>
    <script language="javaScript" type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">

        tinymce.init({
            selector: "textarea.company_news_content",
            theme: "modern",
            forced_root_block: '', // Needed for 3.x
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | responsivefilemanager | forecolor backcolor emoticons",
            image_advtab: true,
            external_filemanager_path: js_web_root + "assets/filemanager/",
            filemanager_title: "Сервер дээрхи файл удирдах хэсэг",
            external_plugins: {"filemanager": js_web_root + "assets/filemanager/plugin.min.js"}
            /*
             templates: [
             {title: 'Test template 1', content: '<b>Test 1</b>'},
             {title: 'Test template 2', content: '<em>Test 2</em>'}
             ]
             */
        });

        $(document).ready(function () {
            $("input:checkbox").on('click', function () {
                // in the handler, 'this' refers to the box clicked on
                var $box = $(this);
                if ($box.is(":checked")) {
                    // the name of the box is retrieved using the .attr() method
                    // as it is assumed and expected to be immutable
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    // the checked state of the group/box on the other hand will change
                    // and the current value is retrieved using .prop() method
                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                    if (typeof $box.data("target") === "undefined") {
                        $("#selected_company_news_menu").val($box.val());
                    }
                } else {
                    $box.prop("checked", false);
                }
            });
        });

        function validateThisForm(thisForm) {
            var formDataValid = true;

            if ($("#selected_company_news_menu").val().length < 1) {
                $("#company_news_menu_status").html("мэдээнд хамаарах цэсийг сонгон уу.").css({"color": "#F58086"});
                formDataValid = false;
            } else {
                $("#company_news_menu_status").html("");
            }

            if ($("#company_news_name").val().length < 5) {
                $("#company_news_name_status").html("мэдээний гарчиг буруу байна. 5 тэмдэгтээс их байна.").css({"color": "#F58086"});
                formDataValid = false;
            } else {
                $("#company_news_name_status").html("");
            }

            if ($("#company_news_preview").val().length < 5) {
                $("#company_news_preview_status").html("мэдээний тойм буруу байна. 5 тэмдэгтээс их байна.").css({"color": "#F58086"});
                formDataValid = false;
            } else {
                $("#company_news_preview_status").html("");
            }

            if ($("#company_news_slug").val().length < 5) {
                $("#company_news_slug_status").html("мэдээний тойм буруу байна. 5 тэмдэгтээс их байна.").css({"color": "#F58086"});
                formDataValid = false;
            } else {
                $("#company_news_slug_status").html("");
            }

            if (tinyMCE.activeEditor.getContent().length < 5) {
                //$("#company_news_content").html("мэдээний бүрэн агуулга 5 тэмдэгтээс урт байх ёстой.").css({"color": "#F34A51"});
                $("#company_news_content_status").html("мэдээний бүрэн агуулга 5 тэмдэгтээс урт байх ёстой.").css({"color": "#F58086"});
                formDataValid = false;
            } else {
                $("#company_news_content_status").html("");
            }

            $('.containerCompanyNewsPictures').find("input").each(function (i, obj) {
                if ($(this).val().length > 4) {
                    var ext = $(this).val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) === -1) {
                        $("#companyNewsPictures_status").html("буруу файл сонгосон байна.").css({"color": "#F58086"});
                        formDataValid = false;
                    } else {
                        $("#companyNewsPictures_status").html("");
                    }
                } else {
                    formDataValid = false;
                    $("#companyNewsPictures_status").html("мэдээний зураг сонгон уу.").css({"color": "#F58086"});
                }
            });

            return formDataValid;
        }
    </script>
<?php endif; ?>

<?php if ($body_script == "edit_company_news"): ?>
    <script language="JavaScript" type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea.company_news_content",
            theme: "modern",
            forced_root_block: '', // Needed for 3.x
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | responsivefilemanager | forecolor backcolor emoticons",
            image_advtab: true,
            external_filemanager_path: js_web_root + "assets/filemanager/",
            filemanager_title: "Сервер дээрхи файл удирдах хэсэг",
            external_plugins: {"filemanager": js_web_root + "assets/filemanager/plugin.min.js"}
            /*
             templates: [
             {title: 'Test template 1', content: '<b>Test 1</b>'},
             {title: 'Test template 2', content: '<em>Test 2</em>'}
             ]
             */
        });

        function editCompanyNewsByCode(editComNewsCode) {
            if (editComNewsCode.length > 0) {
                $.ajax({
                    method: "POST",
                    url: js_web_root + "dataAction.php",
                    data: {editComNewsCode: editComNewsCode, dataSwitch: "ECNC245"}
                }).done(function (msg) {
                    //alert("Data Saved: " + msg);
                    msg = JSON.parse(msg);
                    $.each(msg, function (key1, value1) {
                        //var lastMenuName = "";
                        //alert(key1 + " - " + value1);
                        if (key1 === "news_title") {
                            $("#company_news_name").val(value1);

                        } else if (key1 === "news_slug") {
                            $("#company_news_slug").val(value1);

                        } else if (key1 === "news_preview") {
                            $("#company_news_preview").val(value1);

                        } else if (key1 === "news_content") {
                            //alert(value1);
                            tinyMCE.activeEditor.setContent(value1);
                            //$(".company_news_content").text(value1);
                        } else if (key1 === "code_cat") {
                            //alert(value1);
                            $("#selected_company_news_menu").val(value1);
                            //$(".company_news_content").text(value1);
                            //
                            //var sList = "";
                            $('input[type=checkbox]').each(function () {
                                //var sThisVal = (this.checked ? "1" : "0");
                                //sList += (sList == "" ? sThisVal : "," + sThisVal);
                                //alert(sList);

                                if (value1 == $(this).val()) {
                                    //alert($(this).val());
                                    //$(this).checked = 1;

                                    $(this).prop('checked', true);
                                }
                            });
                        } else if (key1 === "code_news") {
                            $("#selectedToEditComNewsCode").val(value1);
                        } else if (key1 === "news_active") {
                            //is_active_news
                            if (value1 == 1) {
                                $("#is_active_news").prop("checked", true);
                            } else {
                                $("#is_active_news").prop("checked", false);
                            }

                        } else if (key1 === "news_updated") {
                            $("#companyNewsPublishDateTime").val(value1);
                        }

                        /*
                         var sList = "";
                         $('input[type=checkbox]').each(function () {
                         var sThisVal = (this.checked ? "1" : "0");
                         sList += (sList=="" ? sThisVal : "," + sThisVal);
                         });
                         */

                        /*
                         $.each(value1, function (key2, value2) {
                         
                         if (key2 == "product_menu_name") {
                         lastMenuName = value2;
                         }
                         
                         if (key2 == "lang_iso_code") {
                         $("#lang_menu_" + value2).val(lastMenuName);
                         }
                         });
                         */
                    });

                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                }).always(function () {
                    //alert("complete");
                    scrollToAnchor('goto_com_news_edit_panel');
                    $("#company_news_slug").attr("readonly", true);
                });
            }
        }

        $(document).ready(function () {
            $("input:checkbox").on('click', function () {
                // in the handler, 'this' refers to the box clicked on
                var $box = $(this);
                if ($box.is(":checked")) {
                    // the name of the box is retrieved using the .attr() method
                    // as it is assumed and expected to be immutable
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    // the checked state of the group/box on the other hand will change
                    // and the current value is retrieved using .prop() method
                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                    if (typeof $box.data("target") === "undefined") {
                        $.ajax({
                            method: "POST",
                            url: js_web_root + "dataAction.php",
                            data: {clickedMenuCode: $box.val(), dataSwitch: "LCNE895"}
                        }).done(function (msg) {
                            //alert("Data Saved: " + msg);
                            //msg = JSON.parse(msg);
                            $("#ajaxCompanyNewsTableData").html(msg);

                        }).fail(function (jqXHR, textStatus) {
                            alert("Request failed: " + textStatus);
                        }).always(function () {
                            //alert("complete");
                            scrollToAnchor('goto_com_news_list');
                        });
                        $("#selected_company_news_menu").val($box.val());
                    }
                } else {
                    $box.prop("checked", false);
                }
            });
        });

        function validateThisForm(thisForm) {
            var formDataValid = true;

            if ($("#selected_company_news_menu").val().length < 1) {
                $("#company_news_menu_status").html("мэдээнд хамаарах цэсийг сонгон уу.").css({"color": "#F58086"});
                formDataValid = false;
            } else {
                $("#company_news_menu_status").html("");
            }

            if ($("#company_news_name").val().length < 5) {
                $("#company_news_name_status").html("мэдээний гарчиг буруу байна. 5 тэмдэгтээс их байна.").css({"color": "#F58086"});
                formDataValid = false;
            } else {
                $("#company_news_name_status").html("");
            }

            if ($("#company_news_preview").val().length < 5) {
                $("#company_news_preview_status").html("мэдээний тойм буруу байна. 5 тэмдэгтээс их байна.").css({"color": "#F58086"});
                formDataValid = false;
            } else {
                $("#company_news_preview_status").html("");
            }

            if ($("#companyNewsPublishDateTime").val().length < 5) {
                $("#companyNewsPublishDateTime_status").html("мэдээ хэвлэгдсэн онгоог сонгон уу.").css({"color": "#F58086"});
                formDataValid = false;
            } else {
                $("#companyNewsPublishDateTime_status").html("");
            }

            if (tinyMCE.activeEditor.getContent().length < 5) {
                //$("#company_news_content").html("мэдээний бүрэн агуулга 5 тэмдэгтээс урт байх ёстой.").css({"color": "#F34A51"});
                $("#company_news_content_status").html("мэдээний бүрэн агуулга 5 тэмдэгтээс урт байх ёстой.").css({"color": "#F58086"});
                formDataValid = false;
            } else {
                $("#company_news_content_status").html("");
            }

            return formDataValid;
        }
    </script>
<?php endif; ?>

<?php if ($body_script == "company_menus"): ?>
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function () {
            $("input:checkbox").on('click', function () {
                // in the handler, 'this' refers to the box clicked on
                var $box = $(this);
                if ($box.is(":checked")) {
                    // the name of the box is retrieved using the .attr() method
                    // as it is assumed and expected to be immutable
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    // the checked state of the group/box on the other hand will change
                    // and the current value is retrieved using .prop() method
                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                    $("#selectedCompanyMenuCodeValue").val($box.val());

                    $.ajax({
                        method: "POST",
                        url: js_web_root + "dataAction.php",
                        data: {editCompanyMenuCode: $box.val(), dataSwitch: "LECMC388"}
                    }).done(function (msg) {
                        msg = JSON.parse(msg);

                        $.each(msg, function (key1, value1) {
                            var lastMenuName = "";
                            $.each(value1, function (key2, value2) {
                                //alert(key2 + " - " + value2);
                                if (key2 == "cat_name") {
                                    lastMenuName = value2;
                                }

                                if (key2 == "cat_slug") {
                                    $("#editCompanyMenuSlug").val(value2);
                                }

                                if (key2 == "lang_iso_code") {
                                    $("#lang_menu_" + value2).val(lastMenuName);
                                }
                            });
                        });

                    }).fail(function (jqXHR, textStatus) {
                        alert("Request failed: " + textStatus);
                    }).always(function () {
                        //alert("complete");
                    });

                } else {
                    $box.prop("checked", false);
                }
            });
        });
    </script>
<?php endif; ?>

<?php if ($body_script == "new_notify"): ?>
    <script language="JavaScript" type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">

        tinymce.init({
            selector: "textarea.product_notify_content",
            theme: "modern",
            forced_root_block: '', // Needed for 3.x
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | responsivefilemanager | forecolor backcolor emoticons",
            image_advtab: true,
            external_filemanager_path: js_web_root + "assets/filemanager/",
            filemanager_title: "Сервер дээрхи файл удирдах хэсэг",
            external_plugins: {"filemanager": js_web_root + "assets/filemanager/plugin.min.js"}
            /*
             templates: [
             {title: 'Test template 1', content: '<b>Test 1</b>'},
             {title: 'Test template 2', content: '<em>Test 2</em>'}
             ]
             */
        });
    </script>
<?php endif; ?>

<?php if ($body_script == "edit_product"): ?>
    <script language="JavaScript" type="text/javascript" src="assets/js/sort/drag/core.js"></script>
    <script language="JavaScript" type="text/javascript" src="assets/js/sort/drag/events.js"></script>
    <script language="JavaScript" type="text/javascript" src="assets/js/sort/drag/css.js"></script>
    <script language="JavaScript" type="text/javascript" src="assets/js/sort/drag/coordinates.js"></script>
    <script language="JavaScript" type="text/javascript" src="assets/js/sort/drag/drag.js"></script>
    <script language="JavaScript" type="text/javascript" src="assets/js/sort/drag/dragsort.js"></script>
    <script language="JavaScript" type="text/javascript" src="assets/js/sort/drag/cookies.js"></script>

    <script language="JavaScript" type="text/javascript">

        var dragsort = ToolMan.dragsort();
        var junkdrawer = ToolMan.junkdrawer();

        window.onload = function () {
            junkdrawer.restoreListOrder("image_boxes");
            dragsort.makeListSortable(document.getElementById("image_boxes"), saveOrder);
        }

        function saveOrder(item) {
            var group = item.toolManDragGroup;
            var list = group.element.parentNode;
            var id = list.getAttribute("id");
            if (id == null)
                return;
            group.register('dragend', function () {
                ToolMan.cookies().set("list-" + id, junkdrawer.serializeList(list), 365);
            });
        }

        function transValue(sortedImgHTMLs) {
            //alert("text: " + sortedImgHTMLs);

            //var str = "How are you doing today?";
            var sortedImages = sortedImgHTMLs.split("|");

            //var div888 = $(sortedImages[0]);
            //alert(div888.prop('src'));

            var orderedImagePaths = "";

            $.each(sortedImages, function (index, value) {
                //alert(index + ": " + value);
                //var div888 = $(value);
                orderedImagePaths += $(value).prop('src') + "|";
            });

            var thisProductCodeImage = "<?= $productDetails['code_image']; ?>";

            $.ajax({
                method: "POST",
                url: js_web_root + "dataAction.php",
                data: {orderedImagesHTML: orderedImagePaths, productCodeImage: thisProductCodeImage, dataSwitch: "SOI541"}
            }).done(function (msg) {

                alert("Data Saved: " + msg);
                //$("#newProductSlug").val(msg);
                //$("#loadedProductDesc").html(msg);

                //mineType(msg);

                //$("#newProductName").val(msg);

            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            }).always(function () {
                //alert("complete");
            });
        }

        $(document).ready(function () {
            $("input:checkbox").on('click', function () {
                // in the handler, 'this' refers to the box clicked on
                var $box = $(this);
                if ($box.is(":checked")) {
                    // the name of the box is retrieved using the .attr() method
                    // as it is assumed and expected to be immutable
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    // the checked state of the group/box on the other hand will change
                    // and the current value is retrieved using .prop() method
                    $(group).prop("checked", false);
                    $box.prop("checked", true);

                    $("#selected_name_type_value").val($box.val());
                } else {
                    $box.prop("checked", false);
                }
            });
        });

        $(document).ready(function () {
            $('#new_product_plus_attention').change(function () {
                var option = $(this).find('option:selected');

                $("#selected_plus_attention").val(option.val());
            });
        });


        function removeProductSingleImage(idImage, codeImage) {
            var r = confirm("(" + idImage + ") энэ дугаартай зургийг устгах уу?!");
            if (r == true) {
                $.ajax({
                    method: "POST",
                    url: js_web_root + "dataAction.php",
                    data: {removeProductID_Image: idImage, removeProductCode_Image: codeImage, dataSwitch: "RPI785"}
                }).done(function (msg) {
                    alert("remove image status: " + msg);

                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                }).always(function () {
                    //alert("complete");
                });
            }
        }
    </script>
<?php endif; ?>


<?php if ($body_script == "new_product"): ?>

    <script type="text/javascript">

        $(document).ready(function () {
            $("input:checkbox").on('click', function () {
                // in the handler, 'this' refers to the box clicked on
                var $box = $(this);
                if ($box.is(":checked")) {
                    // the name of the box is retrieved using the .attr() method
                    // as it is assumed and expected to be immutable
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    // the checked state of the group/box on the other hand will change
                    // and the current value is retrieved using .prop() method
                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                    if (typeof $box.data("target") === "undefined") {
                        $("#selected_name_type_value").val($box.val());
                    }
                } else {
                    $box.prop("checked", false);
                }
            });
        });

        $(document).ready(function () {
            $('#new_product_plus_attention').change(function () {
                var option = $(this).find('option:selected');

                $("#selected_plus_attention").val(option.val());
            });
        });

        $(document).ready(function () {

            $("#newProductName")
                    .focusout(function () {
                        //$("#focus-count").text("focusout fired: " + focus + "x");

                        $.ajax({
                            method: "POST",
                            url: js_web_root + "dataAction.php",
                            data: {newProductSlug: $("#newProductSlug").val(), dataSwitch: "CHPS001"}
                        }).done(function (msg) {
                            //alert("Data Saved: " + msg);
                            $("#newProductSlug").val(msg);
                            //$("#loadedProductDesc").html(msg);
                            //mineType(msg);
                            //$("#newProductName").val(msg);
                        }).fail(function (jqXHR, textStatus) {
                            alert("Request failed: " + textStatus);
                        }).always(function () {
                            //alert("complete");
                        });
                    })
                    .blur(function () {
                        //$("#blur-count").text("blur fired: " + blur + "x");
                    });
        });

        $(document).ready(function () {
            $('#newProductName').keyup(function () {
                var modelName = $(this).val();

                var result = modelName.replace(/ /g, "-");
                var model_Number = $("#loadedModelNumber").val();

                result += "-" + model_Number;

                $("#newProductSlug").val(result);
                //alert(result);
            });
        });

        $(document).ready(function () {
            $("#btnLoadModelInfo").on("click", function () {
                if ($("#loadByModelNum").val().length > 3) {
                    //e.preventDefault();
                    $.ajax({
                        method: "POST",
                        url: js_web_root + "dataAction.php",
                        data: {modelNumber: $("#loadByModelNum").val(), dataSwitch: "LMD001"}
                    }).done(function (msg) {
                        //alert("Data Saved: " + msg);
                        //$("#loadedProductDesc").html(msg);

                        if (msg === "null") {
                            $("#model_existence_status").html("<p style='color:red;'>таны оруулсан загварын дугаараар мэдээлэл ороогүй байна.</p>");
                        } else {
                            $("#model_existence_status").html("");
                            mineType(msg);
                        }

                        //$("#newProductName").val(msg);
                    }).fail(function (jqXHR, textStatus) {
                        alert("Request failed: " + textStatus);
                    }).always(function () {
                        //alert("complete");
                    });
                }
            });
        });

        function mineType(data) {
            data = $.parseJSON(data);

            (function ($) {
                $.each(data, function () {
                    $.each(this, function (name, value) {
                        /// do stuff
                        if (name == "model_number1") {
                            $("#loadedModelNumber").val(value);
                        } else if (name == "model_price") {
                            $("#newProductPerPrice").val(value);
                        } else if (name == "model_name") {
                            $("#newProductName").val(value);
                        } else if (name == "model_colors") {
                            $("#loadedModelColors").val(value);
                        } else if (name == "model_image") {
                            $("#loadedModelMainImage").attr("src", value);
                        } else if (name == "model_description") {
                            //$("#loadedProductDesc").val("hello");
                        } else if (name == "model_quantity") {
                            $("#loadedModelQuantities").val(value);
                            //$("#loadedModelQuantities").spinner("value", value);
                        } else if (name == "computer_colors") {
                            $(".colors").html(value);
                        } else if (name == "code_model") {
                            $("#product_code_model").val(value);
                        }
                    });
                });
            })(jQuery);
        }
    </script>
<?php endif; ?>

<?php if ($body_script == "view_remove_products"): ?>
    <script type="text/javascript">
        function removeThisProduct(codeProduct) {
            var r = confirm(codeProduct + " энэ дугаартай мэдээллийг устгах уу?!");
            if (r == true) {
                $.ajax({
                    method: "POST",
                    url: js_web_root + "dataAction.php",
                    data: {removeCodeProduct: codeProduct, dataSwitch: "RPI265"}
                }).done(function (msg) {
                    alert("remove product detail status: " + msg);

                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                }).always(function () {
                    //alert("complete");
                });
            }
        }

        function updateThisProductPrice(codeProduct) {
            var r = confirm(codeProduct + " энэ дугаартай мэдээллийн үнийг засах уу?!");
            if (r == true) {
                $.ajax({
                    method: "POST",
                    url: js_web_root + "dataAction.php",
                    data: {updateCodeProduct: codeProduct, dataSwitch: "UPP895"}
                }).done(function (msg) {
                    alert("product price status: " + msg);
                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                }).always(function () {
                    //alert("complete");
                });
            }
        }
    </script>
<?php endif; ?>

<?php if ($body_script == "news_menus"): ?>
    <script type="text/javascript">
        $("[id=select_NewsSite_Category]").change(function () {
            var selectedNewsSiteMenuCode = $("#select_NewsSite_Category option:selected").val();
            $.ajax({
                method: "POST",
                url: js_web_root + "dataAction.php",
                data: {newsSiteMenuCode: selectedNewsSiteMenuCode, dataSwitch: "LNSM952"}
            }).done(function (msg) {
                //alert("menu load status: " + msg);
                msg = JSON.parse(msg);

                $.each(msg, function (key1, value1) {
                    var lastMenuLang = "";
                    $.each(value1, function (key2, value2) {
                        var firstMenuLang = value1['lang_iso_code'];
                        //alert(key2 + " - " + value2 + " - " + lastMenuLang);

                        switch (key2) {
                            case "code_cat":
                                $("#selectedEditMenuCode").val(value2);
                                break;
                            case "cat_name":
                                $("#lang_news_menu_" + firstMenuLang).val(value2);
                                break;
                            case "lang_iso_code":
                                lastMenuLang = value2;
                                break;
                            default:

                                break;
                        }
                    });
                });
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            }).always(function () {
                //alert("complete");
            });
        });
    </script>
<?php endif; ?>

<?php if ($body_script == "model_care"): ?>
    <script language="JavaScript" type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinyMCE.init({
            selector: "textarea.model_care_content",
            theme: "modern",
            forced_root_block: '', // Needed for 3.x
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | responsivefilemanager | forecolor backcolor emoticons",
            image_advtab: true,
            external_filemanager_path: js_web_root + "assets/filemanager/",
            filemanager_title: "Сервер дээрхи файл удирдах хэсэг",
            external_plugins: {"filemanager": js_web_root + "assets/filemanager/plugin.min.js"}
            /*
             templates: [
             {title: 'Test template 1', content: '<b>Test 1</b>'},
             {title: 'Test template 2', content: '<em>Test 2</em>'}
             ]
             */
        });

        //model_care_type

        $('#model_care_type').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            if (valueSelected !== "none") {
                $.ajax({
                    method: "POST",
                    url: js_web_root + "dataAction.php",
                    data: {selectedCareCode: valueSelected, dataSwitch: "LMCG693"}
                }).done(function (msg) {
                    msg = JSON.parse(msg);

                    $.each(msg, function (key2, value2) {

                        switch (key2) {
                            case "care_guide_title":
                                $("#model_care_title").val(value2);
                                break;
                            case "care_guide_content":
                                //$("#model_care_content").val(value2);
                                tinyMCE.activeEditor.setContent(value2);
                                break;
                            case "code_care_guide":
                                $("#model_care_code").val(value2);
                                break;
                            case "lang_iso_code":
                                $("#model_care_lang").val(value2);
                                break;
                            default:

                                break;
                        }
                    });

                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                }).always(function () {
                    //alert("complete");
                });
            }
        });
    </script>
<?php endif; ?>

<?php if ($body_script == "new_model_collection"): ?>
    <script type="text/javascript">
    </script>
<?php endif; ?>

<?php if ($body_script == "old_model"): ?>
    <script language="JavaScript" type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinyMCE.init({
            selector: "textarea.model_desc_content",
            theme: "modern",
            forced_root_block: '', // Needed for 3.x
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | responsivefilemanager | forecolor backcolor emoticons",
            image_advtab: true,
            external_filemanager_path: js_web_root + "assets/filemanager/",
            filemanager_title: "Сервер дээрхи файл удирдах хэсэг",
            external_plugins: {"filemanager": js_web_root + "assets/filemanager/plugin.min.js"}
            /*
             templates: [
             {title: 'Test template 1', content: '<b>Test 1</b>'},
             {title: 'Test template 2', content: '<em>Test 2</em>'}
             ]
             */
        });

        $("#btnLoadkeptModelData").on("click", function () {
            var model_number = $("#model_number").val();
            if (model_number.length > 2) {
                $.ajax({
                    method: "POST",
                    url: js_web_root + "dataAction.php",
                    data: {givenModelNumber: model_number, dataSwitch: "LKMD968"}
                }).done(function (msg) {
                    //alert(msg);
                    msg = JSON.parse(msg);

                    $.each(msg, function (key1, value1) {
                        $.each(value1, function (key2, value2) {

                            switch (key2) {
                                case "code_model":
                                    $("#selectedModelCode").val(value2);
                                    break;
                                case "code_comp_type":
                                    //$("#selectedModelReference").val(value2);
                                    break;
                                case "code_care_guide":
                                    // $("#selectedModelReference").val(value2);
                                    break;
                                case "code_size_guide":
                                    //$("#selectedModelReference").val(value2);
                                    break;
                                case "code_product_reference":
                                    //$("#selectedModelReference").val(value2);
                                    break;
                                case "model_name":
                                    $("#model_name").val(value2);
                                    break;
                                case "model_image":
                                    //$("#selectedModelReference").val(value2);
                                    var imageUploadMonth = value2.substring(8, 15);
                                    var imagePath = 'http://mongoliax.mn/uploads/model/pictures/' + imageUploadMonth + '/' + value2;
                                    $("#prevModelImage").attr('src', imagePath);
                                    break;
                                case "model_number1":
                                    //$("#selectedModelReference").val(value2);
                                    break;
                                case "model_number2":
                                    //$("#selectedModelReference").val(value2);
                                    break;
                                case "model_number_customer":
                                    break;
                                case "model_weight":
                                    break;
                                case "model_sex":
                                    //model_sex
                                    break;
                                case "model_sizes":
                                    //"4XL:;3XL:;2XL:;XL:;L:;S:S;M:M;XS:;square:;other:"
                                    var res = value2.split(";");
                                    for (var i = 0; i < res.length; i++) {
                                        var oneSizeElements = res[i].split(":");
                                        var firstElement = oneSizeElements[0].toLowerCase();
                                        var secondElement = oneSizeElements[1];
                                        $("#model_size_" + firstElement).val(secondElement);
                                    }
                                    break;
                                case "model_quantity":
                                    break;
                                case "model_colors":
                                    $("#model_colors").val("965,263,12");
                                    break;
                                case "model_price":
                                    break;
                                case "model_description":
                                    break;
                                case "model_weave_type":
                                    break;
                                case "model_knmagy":
                                    break;
                                case "model_component_percent":
                                    break;
                                case "model_string_number":
                                    break;
                                case "model_string_requirement":
                                    break;
                                case "model_sort":
                                    break;
                                case "model_auxiliarym_material":
                                    break;
                                case "code_officer_designer":
                                    break;
                                case "lang_iso_code":
                                    $("#selectedModelLang").val(value2);
                                    break;
                                case "model_registered":
                                    break;
                                case "model_updated":
                                    break;
                                default:
                                    break;
                            }

                        });
                    });
                    /*
                     if (msg === "no") {
                     $("#modelExistenceStatus").html("энэ загварын мэдээллийг оруулах боломжтой").css({"color": "green"});
                     } else if (msg === "yes") {
                     $("#modelExistenceStatus").html("энэ загварын дугаар өмнө орсон байна").css({"color": "red"});
                     }
                     */
                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                }).always(function () {
                    //alert("complete");
                });
            }
        });

    </script>
<?php endif; ?>

<?php if ($body_script == "new_model"): ?>
    <script language="JavaScript" type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <link href="http://salman-w.googlecode.com/svn/trunk/demoengine/demoengine.min.css" rel="stylesheet">
    <script src="http://salman-w.googlecode.com/svn/trunk/demoengine/demoengine.min.js" defer></script>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/ui-darkness/jquery-ui.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

    <script type="text/javascript">
        tinymce.init({
            selector: "textarea.model_desc_content",
            theme: "modern",
            forced_root_block: '', // Needed for 3.x
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | responsivefilemanager | forecolor backcolor emoticons",
            image_advtab: true,
            external_filemanager_path: js_web_root + "assets/filemanager/",
            filemanager_title: "Сервер дээрхи файл удирдах хэсэг",
            external_plugins: {"filemanager": js_web_root + "assets/filemanager/plugin.min.js"}

            /*
             templates: [
             {title: 'Test template 1', content: '<b>Test 1</b>'},
             {title: 'Test template 2', content: '<em>Test 2</em>'}
             ]
             */
        });

        function validateModelForm() {
            var isData = true;
            //alert(tinyMCE.activeEditor.getContent());
            //$("#newModelReferenceContent").val(tinyMCE.activeEditor.getContent());
            var model_number = $("#model_number");
            var model_number_value = model_number.val();

            if (model_number_value.length < 4) {
                alert("загварын дугаарыг 3 үсгээс их байхаар оруулан уу");
                model_number.css({"backgroundColor": "black", "color": "white"});
                isData = false;
            }

            var model_image = $("#model_image");
            var model_image_value = model_image.val();

            if (model_image_value.length < 4) {
                alert("загварын файлын зураг сонгон уу");
                isData = false;
            }

            var model_colors = $("#model_colors");
            var model_colors_value = model_colors.val();

            if (model_colors_value.length < 1) {
                alert("загварын өнгийг оруулан уу");
                isData = false;
            }
            return isData;
        }

        $(document).ready(function () {
            $('#selectedModelReference').on('change', function (e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                tinyMCE.activeEditor.setContent("");
                //alert(tinyMCE.activeEditor.getContent());
                //tinyMCE.activeEditor.setContent("Description: <br />Composition: <br />Gauge: <br />Yarn count: <br />Average: weight/gr: <br />Pattern:");
                if (valueSelected !== "none") {
                    $.ajax({
                        method: "POST",
                        url: js_web_root + "dataAction.php",
                        data: {selectedReferCode: valueSelected, dataSwitch: "LMRD228"}
                    }).done(function (msg) {
                        msg = JSON.parse(msg);
                        $.each(msg, function (key1, value1) {
                            switch (key1) {
                                case "model_ref_content":
                                    tinyMCE.activeEditor.setContent(value1);
                                    break;
                                default:
                                    break;
                            }
                        });
                    }).fail(function (jqXHR, textStatus) {
                        alert("Request failed: " + textStatus);
                    }).always(function () {
                        //alert("complete");
                    });
                }
            });

            $('#selectedCareGuideCode').on('change', function (e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                if (valueSelected !== "none") {
                    $("#selectedModelCareCode").val(valueSelected);
                }
            });

            $('#selectedSizeGuideCode').on('change', function (e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                if (valueSelected !== "none") {
                    $("#selectedModelSizeCode").val(valueSelected);
                }
            });

            $('#selectedModelReference').on('change', function (e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                if (valueSelected !== "none") {
                    $("#selectedModelRefCode").val(valueSelected);
                }
            });

            $("#btnCheckExistenceModel").on("click", function () {
                var model_number = $("#model_number").val();
                if (model_number.length > 2) {
                    $.ajax({
                        method: "POST",
                        url: js_web_root + "dataAction.php",
                        data: {givenModelNumber: model_number, dataSwitch: "CHME025"}
                    }).done(function (msg) {
                        if (msg === "no") {
                            $("#modelExistenceStatus").html("энэ загварын мэдээллийг оруулах боломжтой").css({"color": "green"});
                        } else if (msg === "yes") {
                            $("#modelExistenceStatus").html("энэ загварын дугаар өмнө орсон байна").css({"color": "red"});
                        }
                    }).fail(function (jqXHR, textStatus) {
                        alert("Request failed: " + textStatus);
                    }).always(function () {
                        //alert("complete");
                    });
                }
            });

            $("#btnCheckWhatColor").on("click", function () {
                var color_code = $("#ModelColorForCheck").val();
                if (color_code.length > 2) {
                    $.ajax({
                        method: "POST",
                        url: js_web_root + "dataAction.php",
                        data: {givenColorCode: color_code, dataSwitch: "CGCC635"}
                    }).done(function (msg) {
                        //alert(msg);
                        $("#containerWhatColorIsIt").html(msg);
                    }).fail(function (jqXHR, textStatus) {
                        alert("Request failed: " + textStatus);
                    }).always(function () {
                        //alert("complete");
                    });
                }
            });
        });
    </script>

    <script>
        /*
         * jQuery UI Autocomplete: Using Label-Value Pairs
         * http://salman-w.blogspot.com/2013/12/jquery-ui-autocomplete-examples.html
         */
        /*
         var data = [
         {value: "AL", label: "Alabama"},
         {value: "AK", label: "Alaska"},
         {value: "AZ", label: "Arizona"},
         {value: "AR", label: "Arkansas"},
         {value: "CA", label: "California"},
         {value: "CO", label: "Colorado"},
         {value: "CT", label: "Connecticut"},
         {value: "DE", label: "Delaware"},
         {value: "FL", label: "Florida"},
         {value: "GA", label: "Georgia"},
         {value: "HI", label: "Hawaii"},
         {value: "ID", label: "Idaho"},
         {value: "IL", label: "Illinois"},
         {value: "IN", label: "Indiana"},
         {value: "IA", label: "Iowa"},
         {value: "KS", label: "Kansas"},
         {value: "KY", label: "Kentucky"},
         {value: "LA", label: "Louisiana"},
         {value: "ME", label: "Maine"},
         {value: "MD", label: "Maryland"},
         {value: "MA", label: "Massachusetts"},
         {value: "MI", label: "Michigan"},
         {value: "MN", label: "Minnesota"},
         {value: "MS", label: "Mississippi"},
         {value: "MO", label: "Missouri"},
         {value: "MT", label: "Montana"},
         {value: "NE", label: "Nebraska"},
         {value: "NV", label: "Nevada"},
         {value: "NH", label: "New Hampshire"},
         {value: "NJ", label: "New Jersey"},
         {value: "NM", label: "New Mexico"},
         {value: "NY", label: "New York"},
         {value: "NC", label: "North Carolina"},
         {value: "ND", label: "North Dakota"},
         {value: "OH", label: "Ohio"},
         {value: "OK", label: "Oklahoma"},
         {value: "OR", label: "Oregon"},
         {value: "PA", label: "Pennsylvania"},
         {value: "RI", label: "Rhode Island"},
         {value: "SC", label: "South Carolina"},
         {value: "SD", label: "South Dakota"},
         {value: "TN", label: "Tennessee"},
         {value: "TX", label: "Texas"},
         {value: "UT", label: "Utah"},
         {value: "VT", label: "Vermont"},
         {value: "VA", label: "Virginia"},
         {value: "WA", label: "Washington"},
         {value: "WV", label: "West Virginia"},
         {value: "WI", label: "Wisconsin"},
         {value: "WY", label: "Wyoming"}
         ];*/

        var data = <?= $jsonModelNumbers; ?>;
        //alert(data);
        $(function () {
            $("#model_number").autocomplete({
                source: data
            });
        });
    </script>
<?php endif; ?>

<?php if ($page_type == "form_tools"): ?>

    <!-- PAGE LEVEL PLUGINS JS -->
    <script src="assets/js/plugins/select2/select2.min.js"></script>
    <script src="assets/js/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/js/plugins/masked-input/jquery.maskedinput.min.js"></script>
    <script src="assets/js/plugins/bootstrap-wysihtml/wysihtml.min.js"></script>
    <script src="assets/js/plugins/bootstrap-wysihtml/bootstrap-wysihtml.js"></script>
    <script src="assets/js/plugins/bootstrap-markdown/bootstrap-markdown.js"></script>
    <script src="assets/js/plugins/datetime/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="assets/js/plugins/fuelux/spinner.min.js"></script>
    <script src="assets/js/plugins/bootstrap-touchspin/bootstrap.touchspin.js"></script>
    <script src="assets/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

    <!-- I ADDED JS FILES -->

    <!-- Themes Core Scripts -->	
    <script src="assets/js/main.js"></script>

    <!-- REQUIRE FOR SPEECH COMMANDS -->
    <script src="assets/js/speech-commands.js"></script>
    <script src="assets/js/plugins/gritter/jquery.gritter.min.js"></script>		

    <!-- initial page level scripts for examples -->
    <script src="assets/js/plugins/slimscroll/jquery.slimscroll.init.js"></script>
    <script>

        var dailyNewsPicturesCount = 1;
        var comNewsPicturesCount = 1;
        var proPicturesCount = 1;
        var cataPicturesCount = 1;
        var lookbookCount = 1;
        var catalogImageName = "cat_img";

        var loadFile1 = function (event, muu) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('output' + muu);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };

        $(document).ready(function () {

            $("#btn_add_lookbook_picture").on("click", function () {
                if (lookbookCount <= 100) {
                    var containerLoboPICs = $(".containerLookbookPictures");
                    containerLoboPICs.append("<div class='perLookbookPicContainer'>\n\
                        <div class='row'><div class='col-sm-3'><label class='col-sm-4 control-label'>зураг-" + lookbookCount + ":</label></div><div class='col-sm-9'><input type='file' name='lobo_img[file" + lookbookCount + "]' onchange='loadFile1(event," + lookbookCount + ")'></div></div>\n\
                        <div class='row'><div class='col-sm-4'><input type='text' class='form-control' placeholder='зургийн гарчиг ...'><div class='space-4'></div><textarea class='form-control' id='maxL-3' maxlength='225' rows='2' placeholder='зургийн тайлбар ...'></textarea></div><div class='col-sm-8'><img id='output" + lookbookCount + "' style='width: 150px;border:1px solid #ddd;border-radius: 5px;padding: 2px;max-height: 200px;'/></div></div>\n\
                    </div>");
                }
                lookbookCount++;
            });
            $("#js_btn_add_catalog_picture").on("click", function () {
                if (cataPicturesCount <= 100) {
                    var containerCataPICs = $(".containerNewCatalogPictures");
                    containerCataPICs.append("<div class='perCatalogPicContainer'>\n\
                        <div class='row'><div class='col-sm-3'><label class='col-sm-4 control-label'>зураг-" + cataPicturesCount + ":</label></div><div class='col-sm-9'><input type='file' name='cata_img[file" + cataPicturesCount + "]' onchange='loadFile1(event," + cataPicturesCount + ")'></div></div>\n\
                        <div class='row'><div class='col-sm-4'><input type='text' class='form-control' placeholder='зургийн гарчиг ...'><div class='space-4'></div><textarea class='form-control' id='maxL-3' maxlength='225' rows='2' placeholder='зургийн тайлбар ...'></textarea></div><div class='col-sm-8'><img id='output" + cataPicturesCount + "' style='width: 150px;border:1px solid #ddd;border-radius: 5px;padding: 2px;max-height: 200px;'/></div></div>\n\
                    </div>");
                }
                cataPicturesCount++;
            });
            $("#btn_add_professional_picture").on("click", function () {
                if (proPicturesCount <= 100) {
                    var containerProPICs = $(".containerProfessionalPictures");
                    containerProPICs.append("<div class='perProPicContainer'>\n\
                        <div class='row'><div class='col-sm-3'><label class='col-sm-4 control-label'>зураг-" + proPicturesCount + ":</label></div><div class='col-sm-9'><input type='file' name='prod_img[file" + proPicturesCount + "]'  onchange='loadFile1(event," + proPicturesCount + ")'></div></div>\n\
                        <div class='row'><div class='col-sm-4'><input type='text' class='form-control' placeholder='зургийн гарчиг ...'><div class='space-4'></div><textarea class='form-control' id='maxL-3' maxlength='225' rows='2' placeholder='зургийн тайлбар ...'></textarea></div><div class='col-sm-8'><img id='output" + proPicturesCount + "' style='width: 150px;border:1px solid #ddd;border-radius: 5px;padding: 2px;max-height: 200px;'/></div></div>\n\
                    </div>");
                }
                proPicturesCount++;
            });
            $("#btn_add_company_news_picture").on("click", function () {
                if (comNewsPicturesCount <= 100) {
                    var containerComNewsPICs = $(".containerCompanyNewsPictures");
                    containerComNewsPICs.append("<div class='perComNewsPicContainer'>"
                            + "<div class='styleRemoveImageBox'><img onclick='removeThisImageBox(this)' id='removeBTN_" + comNewsPicturesCount + "' src='assets/images/remove_icon.png'/></div>"
                            + "<div class='row'>"
                            + "<div class='col-sm-3'>"
                            + "<label class='col-sm-4 control-label'>зураг-" + comNewsPicturesCount + ":</label>"
                            + "</div>"
                            + "<div class='col-sm-9'>"
                            + "<input type='file' name='com_news_img[file" + comNewsPicturesCount + "]'  onchange='loadFile1(event, " + comNewsPicturesCount + ")'>"
                            + "</div>"
                            + "</div>"
                            + "<div class='row'>"
                            + "<div class='col-sm-4'>"
                            + "</div>"
                            + "<div class='col-sm-8'>"
                            + "<img id='output" + comNewsPicturesCount + "' style='width: 150px;border:1px solid #ddd;border-radius: 5px;padding: 2px;max-height: 200px;'/>"
                            + "</div>"
                            + "</div>"
                            + "</div>");
                }
                comNewsPicturesCount++;
            });
            $("#btn_add_daily_news_picture").on("click", function () {
                if (dailyNewsPicturesCount <= 1) {
                    var containerComNewsPICs = $(".containerDailyNewsPictures");

                    containerComNewsPICs.append("<div class='perDailyNewsPicContainer'>"
                            + "<div class='styleRemoveImageBox'><img onclick='removeThisImageBox(this)' id='removeBTN_" + dailyNewsPicturesCount + "' src='assets/images/remove_icon.png'/></div>"
                            + "<div class='row'>"
                            + "<div class='col-sm-3'>"
                            + "<label class='col-sm-4 control-label'>зураг-" + dailyNewsPicturesCount + ":</label>"
                            + "</div>"
                            + "<div class='col-sm-9'>"
                            + "<input type='file' name='daily_news_img[file" + dailyNewsPicturesCount + "]'  onchange='loadFile1(event, " + dailyNewsPicturesCount + ")'>"
                            + "</div>"
                            + "</div>"
                            + "<div class='row'>"
                            + "<div class='col-sm-4'></div>"
                            + "<div class='col-sm-8'>"
                            + "<img id='output" + dailyNewsPicturesCount + "' style='width: 150px;border:1px solid #ddd;border-radius: 5px;padding: 2px;max-height: 200px;'/>"
                            + "</div>"
                            + "</div>"
                            + "</div>");
                }
                dailyNewsPicturesCount++;
            });
            //Select2 examples
            $("#e1, #e2, #e3").select2();
            $("#e4").select2({
                placeholder: "Select a Option",
                allowClear: true
            });
            $("#e5").select2({tags: ["Бүх дэлгүүр", "Үйлдвэрийн дэргэдэх төв дэлгүүр", "Говь-Монгол кашимер дэлгүүр", "Төв шуудан салбар", "СМАРТ ХУДАЛДААНЫ ТӨВ", "ӨРГӨӨ ЗОЧИД БУУДАЛ ДАХЬ САЛБАР"]});
            //Bootstrap Select enable

            $('.selectpicker').selectpicker('show');
            //Maxilength
            //$('input[maxlength]').maxlength();
            /*$('input.maxL-1').maxlength({
             threshold: 17
             });*/
            /*
             $('input.maxL-2').maxlength({
             alwaysShow: true,
             warningClass: "label label-primary",
             limitReachedClass: "label label-danger",
             separator: ' of ',
             preText: 'You have ',
             postText: ' chars remaining.',
             validate: true,
             threshold: 10
             });
             
             
             
             $('textarea#maxL-3').maxlength({
             alwaysShow: true
             });
             $('input#maxL-4').maxlength({
             alwaysShow: true,
             placement: 'top-left'
             });
             alert("hihiihihi");
             //Masked Input Uses http://digitalbush.com/projects/masked-input-plugin/			
             $.mask.definitions['~'] = '[+-]';
             $('.input-date').mask('99/99/9999');
             $('.input-phone').mask('(999) 999-9999');
             $(".input-key").mask("a*-999-a999", {placeholder: " ", completed: function () {
             alert("You typed the following: " + this.val());
             }});
             $('.input-eyescript').mask('~9.99 ~9.99 999');
             //Bootstrap Datetimepicker
             */

            $('.form_datetime').datetimepicker({
                //language:  'fr',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1
            });
            $('.form_date').datetimepicker({
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
            $('.form_time').datetimepicker({
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 1,
                minView: 0,
                maxView: 1,
                forceParse: 0
            });
            //Bootstrap Datepicker
            $('.datepicker').datepicker();
            //Wysihtml Editor
            $('#editor1').wysihtml5();
            // Spinners
            $('#MySpinner-1').spinner();
            $('#MySpinner-2').spinner({disabled: true});
            $('#MySpinner-3').spinner({value: 0, min: 0, max: 10});
            $('#MySpinner-4').spinner({value: 0, step: 5, min: 0, max: 200});
            // Touchspinners
            $("#touchspin-demo1").TouchSpin({
                min: 0,
                max: 100,
                step: 1,
                decimals: 0,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '$'
            });
            $("#touchspin-demo2").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                buttonup_class: 'btn btn-primary',
                buttondown_class: 'btn btn-primary',
                postfix: '%'
            });
            /*
             $("#file-3").fileinput({
             showUpload: false,
             showCaption: false,
             browseClass: "btn btn-primary btn-lg",
             fileType: "any",
             previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
             });
             */
        });
    </script>

<?php else: ?>

    <!-- PAGE LEVEL PLUGINS JS -->
    <script src="assets/js/plugins/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="assets/js/plugins/jqueryui/jquery.ui.touch-punch.min.js"></script>	
    <script src="assets/js/plugins/daterangepicker/moment.js"></script>
    <script src="assets/js/plugins/daterangepicker/daterangepicker.js"></script>	
    <script src="assets/js/plugins/morris/raphael-min.js"></script>
    <script src="assets/js/plugins/morris/morris.min.js"></script>
    <script src="assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="assets/js/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/js/plugins/easypiechart/jquery.easypiechart.min.js"></script>
    <script src="assets/js/plugins/easypiechart/excanvas.compiled.js"></script>	
    <script src="assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Themes Core Scripts -->	
    <script src="assets/js/main.js"></script>

    <!-- REQUIRE FOR SPEECH COMMANDS -->
    <script src="assets/js/speech-commands.js"></script>
    <script src="assets/js/plugins/gritter/jquery.gritter.min.js"></script>		

    <!-- initial page level scripts for examples -->
    <script src="assets/js/plugins/slimscroll/jquery.slimscroll.init.js"></script>
    <script src="assets/js/home-page.init.js"></script>
    <script src="assets/js/plugins/jquery-sparkline/jquery.sparkline.init.js"></script>
    <script src="assets/js/plugins/easypiechart/jquery.easypiechart.init.js"></script>
    <script type="text/javascript">
        //Live Chat
        jQuery(function ($) {
            $('#live-chat-ui header').on('click', function () {
                $('.chat').slideToggle(300, 'swing');
                $('.chat-message-counter').fadeToggle(300, 'swing');
            });
            $('.chat-close').on('click', function (e) {
                e.preventDefault();
                $('#live-chat-ui').fadeOut(300);
            });
        });
        $('#minicalendar').datepicker();
    </script>
<?php endif; ?>