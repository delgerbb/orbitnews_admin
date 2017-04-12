<meta charset="utf-8">
<title>Mongoliax Admin</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/fonts.css">
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/mydefined.css">
<style>    .changeSystemLangStyle{cursor: pointer;}    .daad{width: 50px;height: 50px;color: red;}    #waiting-for-process{position: fixed;top:calc(50% - 32px);left: calc(50% - 32px);width: 64px;height: 64px;}</style>
<?php if ($page_type == "form_tools"): ?>
    <!-- PAGE LEVEL PLUGINS STYLES -->
    <!-- REQUIRE FOR SPEECH COMMANDS -->
    <link rel="stylesheet" type="text/css" href="assets/css/plugins/gritter/jquery.gritter.css" />	

    <!-- Tc core CSS -->
    <link id="qstyle" rel="stylesheet" href="assets/css/themes/style.css">	
    <!--[if lte IE 8]>
            <link rel="stylesheet" href="assets/css/ie-fix.css" />
    <![endif]-->


    <!-- Add custom CSS here -->

    <!-- End custom CSS here -->

    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
<?php endif; ?>

<?php if ($page_type == "form_tools"): ?>

    <!-- PAGE LEVEL PLUGINS STYLES -->
    <link href="assets/css/plugins/select2/select2.css" rel="stylesheet">
    <link href="assets/css/plugins/select2/select2.custom.min.css" rel="stylesheet">
    <link href="assets/css/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/plugins/bootstrap-wysihtml/bootstrap-wysihtml5.css">
    <link rel="stylesheet" href="assets/css/plugins/datetime/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="assets/css/plugins/bootstrap-datepicker/datepicker.css">

    <!-- REQUIRE FOR SPEECH COMMANDS -->

    <!-- REQUIRE FOR SPEECH COMMANDS -->
    <link rel="stylesheet" type="text/css" href="assets/css/plugins/gritter/jquery.gritter.css" />

    <!-- Tc core CSS -->
    <link id="qstyle" rel="stylesheet" href="assets/css/themes/style.css">	
    <!--[if lte IE 8]>
            <link rel="stylesheet" href="assets/css/ie-fix.css" />
    <![endif]-->


    <!-- Add custom CSS here -->

    <!-- End custom CSS here -->

    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->


<?php else: ?>
    <!-- PAGE LEVEL PLUGINS STYLES -->	
    <link href="assets/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="assets/css/plugins/morris/morris.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/plugins/bootstrap-datepicker/datepicker.css">
    <!-- REQUIRE FOR SPEECH COMMANDS -->
    <link rel="stylesheet" type="text/css" href="assets/css/plugins/gritter/jquery.gritter.css" />

    <!-- Tc core CSS -->
    <link id="qstyle" rel="stylesheet" href="assets/css/themes/style.css">	
    <!--[if lte IE 8]>
            <link rel="stylesheet" href="assets/css/ie-fix.css" />
    <![endif]-->


    <!-- Add custom CSS here -->
    <link rel="stylesheet" href="assets/css/only-for-demos.css">

    <!-- End custom CSS here -->

    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <!--[if lte IE 8]>
    <script src="assets/js/plugins/easypiechart/easypiechart.ie-fix.js"></script>
    <![endif]-->
<?php endif; ?>
<script type="text/javascript">

    function scrollToAnchor(aid) {
        var aTag = $("a[name='" + aid + "']");
        $('html,body').animate({scrollTop: aTag.offset().top}, 'slow');
    }

    /*
     $("#link").click(function () {
     scrollToAnchor('id3');
     });
     */

</script>