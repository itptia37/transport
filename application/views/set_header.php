<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="theme-color" content="#317EFB"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $this->session->userdata('set_web'); ?></title>
		
	<link type="image/png" href="<?php echo 'assets/images/fav.png'; ?>" rel="icon"/>
	<link type="text/css" rel="stylesheet" href="<?php echo 'assets/bootstrap/css/bootstrap.min.css'; ?>"  />
	<script type="text/javascript" src="<?php echo 'assets/external-js/jquery-3.1.1.min.js'; ?>"  ></script>
	<script type="text/javascript" src="<?php echo 'assets/bootstrap/js/bootstrap.min.js'; ?>"  ></script>

	<script type="text/javascript" src="<?php echo 'assets/js/tr_global180904-4.js?v=20260927'; ?>" ></script>
	<script type="text/javascript" src="<?php echo 'assets/js/tr_login.js'; ?>" ></script>
	<script type="text/javascript" src="<?php echo 'assets/js/tr_petty_cash.js'; ?>" ></script>
	
	<script type="text/javascript" src="<?php echo 'assets/js/tr_user.js'; ?>" ></script>
	<script type="text/javascript" src="<?php echo 'assets/js/tr_car.js'; ?>" ></script>
	<script type="text/javascript" src="<?php echo 'assets/js/tr_driver.js'; ?>" ></script>
	<script type="text/javascript" src="<?php echo 'assets/js/tr_courier.js'; ?>" ></script>
	<script type="text/javascript" src="<?php echo 'assets/js/tr_external.js'; ?>" ></script>
	<script type="text/javascript" src="<?php echo 'assets/js/tr_request_driver181019.js'; ?>" ></script>
	<script type="text/javascript" src="<?php echo 'assets/js/tr_request_courier181019.js'; ?>" ></script>
	<script type="text/javascript" src="<?php echo 'assets/js/tr_expense.js'; ?>" ></script>
	<script type="text/javascript" src="<?php echo 'assets/js/tr_cash181026.js'; ?>" ></script>
	
	<link type="text/css" rel="stylesheet" href="<?php echo 'assets/jquery-ui/jquery-ui.min.css'; ?>"  />
	<script type="text/javascript" src="<?php echo 'assets/jquery-ui/jquery-ui.min.js'; ?>"  ></script>
	
</head>
<style type="text/css">
.my-break {margin-bottom:2px;}
.my-clear-text {
	float: right; 
	position: relative; 
	margin-top:-22px;
	margin-right:15px;
	font-weight:bold;
	}
.my-row-active {background-color: #bee3f6;}

.blue {color: blue;}
.imp {color: #d9534f;}
.my-left {float: left;}
.my-right {float: right;}
.my-table-body td {font-size:12px;}
.my-login-label {font-size: 23px; font-weight: bold;}
.my-export-active {background-color: #bee3f6;}
.my-petty-active {background-color: #bee3f6;}

.my-menu-li-active {background-color: #eeeeee;}

.my-subreport-item {padding:5px;color:#fff;}

.my-subreport-item:hover {color:#fff; background-color: #337ab7;}

.my-subreport-item-active {background-color: #337ab7;}

.my-require {color: #d9534f;}
.breadcrumb {margin-bottom: 0px; box-shadow: 0px 0px 5px 1px #444444;}
.my-company-active {background-color: #bee3f6;}

.my-glyphicon {font-size: 9px;}
.my-row-bootstrap {padding: 0px;}
.my-col-bootstrap {padding: 0px;}
.my-title {font-weight: bold; font-size:14px;}
.my-fild {font-style: italic; color:blue;}
.my-search-box {float: right; margin-right: 5px; margin-top: -32px;}
.my-back-box {float: right; margin-right: 5px; margin-top: -32px;}
.my-tools-box {margin-bottom: 5px;}
.my-tools-box-col {padding: 0px;margin:0px;}
.my-tools-box-bottom {
	position: fixed; 
	width: 100%; 
	bottom: 0%; 
	left: 0%; 
	padding: 5px; 
	background-color: #f5f5f5;
	box-shadow: 0px 0px 5px 1px #444444;
	}

	
.my-box-filter {top: 110px;	position: fixed; z-index: 3;}
.my-box-filter-item {padding:5px;background-color: #fff;margin-bottom:5px;}
.my-box-filter-item li {list-style: none;}
.my-box-filter-item li a {display: block;padding: 3px;}
.my-box-filter-item li a:hover {background-color: #cce9f8;}
.my-box-filter-item-active {background-color: #cce9f8;}

.my-th-label {color: #fff; text-align: center; cursor: pointer;}
.my-table-body {font-size: 12px; background-color: #fff;}
.my-tr {width: 100%; overflow: hidden;}
.my-tr:hover {background-color: #cce9f8;}
.my-tr-selected {background-color: #bee3f6;}
.my-td-title {display: none;}	
.my-btn-active-status {cursor: pointer;}
.my-btn-right {float: right;}
.my-blocked {background-color: #fb4242;}	
.my-hr{margin:2px 0px;}
.my-gradation {
	background: linear-gradient(#6dbad4, #098dba); /* Standard syntax */
	background: -webkit-linear-gradient(#6dbad4, #098dba); /* For Safari 5.1 to 6.0 */
	background: -o-linear-gradient(#6dbad4, #098dba); /* For Opera 11.1 to 12.0 */
	background: -moz-linear-gradient(#6dbad4, #098dba); /* For Firefox 3.6 to 15 */
	}

.my-summary-active {background-color: #bee3f6;}


.my-list-file-item {padding: 3px;}
.my-list-file-item:hover {background-color: #cce9f8;}
.my-list-file-delete {padding: 3px; color: #d9534f;}

.my-panel-list-box {margin: 0px;padding: 0px;}
.my-panel-body-list-box {margin: 0px;padding: 3px; color: #444444; }
.my-list-box {z-index: 2;background-color: #fff;position: absolute;	}
.my-list-box li {list-style: none; padding: 3px;}
.my-list-box li a {display: block;}
.my-list-box li:hover {background-color: #cce9f8;}
.my-list-active {background-color: #bee3f6;}

.my-panel {margin-bottom: 0px;}

.my-panel-form {margin-bottom: 5px;}

.my-label {
	font-size:9px;
	color:#a5a5a5;
	}
	
.my-note-text {
	display:none;
	color:red;
	}
	
.my-alert-box {
	top: 110px;
	width: 30%;
	left: 35%;
	position: fixed;
	z-index: 4;
	}

.my-item-sugges {
	display:block;
	padding:5px;
	}
	
.my-item-sugges:hover {
	background-color:#cce9f8;
	}
	
.my-tag-footer{margin:0 auto;}

.my-box-confirm {
	display: none;
	z-index: 3;
	position: fixed;
	background-color: #fff;
}

.my-box-form-float {
	z-index: 3;
	position: absolute;
	background-color: #fff;
	border-radius:10px;
}

#my-wrapper a {text-decoration: none;}

#my-wrapper{
	width: 100%;
	overflow: hidden;
	font-family:"Arial","Calibri";
	font-size: 12px;
	}
	
		
#my-container-content{ color: #444444;}


#my-login-box {
	margin: 0 auto;
	padding: 10px;	
	background-color: #fff;
	box-shadow: 0px 0px 5px 1px #dddddd;
	border: 1px solid #dddddd;
}

#my-menu { 
	position: fixed; 
	width: 100%; 
	top: 0%;
	z-index:6;
}

#my-menu-logo-img {height:35px;}


#my-subreport {padding:7px;}
	
#my-row-box {
	display: none;
	z-index: 2;
	background-color: #fff;
	position: absolute;
	width: 40px;
	border:1px solid #a5a5a5;
	}
#my-row-box li {list-style: none;padding: 3px;}
#my-row-box li a {display: block;}
#my-row-box li:hover {background-color: #cce9f8;}


#my-company-box {
	display: none;
	z-index: 2;
	background-color: #fff;
	position: absolute;
	border:1px solid #a5a5a5;
	}
#my-company-box li {list-style: none; padding: 3px;}
#my-company-box li a {display: block;}
#my-company-box li:hover {background-color: #cce9f8;}

#my-petty-box {
	display: none;
	z-index: 2;
	background-color: #fff;
	position: absolute;
	border:1px solid #a5a5a5;
	}
#my-petty-box li {list-style: none; padding: 3px;}
#my-petty-box li a {display: block;}
#my-petty-box li:hover {background-color: #cce9f8;}


#my-export-box {
	display: none;
	z-index: 2;
	background-color: #fff;
	position: absolute;
	width: 80px;
	border:1px solid #a5a5a5;
	}
#my-export-box li {list-style: none; padding: 3px;}
#my-export-box li a {display: block;}
#my-export-box li:hover {background-color: #cce9f8;}

#my-summary-box {
	display: none;
	z-index: 2;
	background-color: #fff;
	position: absolute;
	width: 80px;
	border:1px solid #a5a5a5;
	}
#my-summary-box li {list-style: none; padding: 3px;}
#my-summary-box li a {display: block;}
#my-summary-box li:hover {background-color: #cce9f8;}


#my-page-active {background-color: #bee3f6;}
#my-page-bottom {margin: 0px;}
#my-page-bottom ul {margin: 0px;}


#my-loading{
	z-index:3;	
	position:fixed;
	top:40%; 
	right:47%;
	}
	
#my-loader {-webkit-transform: rotate(360deh); transform: rotate(360deh);}

#my-loading img {width:50px;}

#my-data-table {
	width: 100%;
	margin-top:90px;
	margin-bottom:90px;
	overflow: auto;
	padding: 5px;
	
}
	

#my-footer {
	background-color:#444444;
	color: #fff;
	}
#my-footer a { color: #fff; }


@media screen and (min-width: 768px) {
		
	#my-container-content{
		margin-top:110px;
	}
	
	#my-breadcrumb { 
		position: fixed; 
		width: 100%; 
		top: 72px;
		z-index:5;
	}
	
	#my-login-box {width: 50%; left: 25%;}
	
	#my-single-form {width: 50%;}
	
	#my-page-top {text-align: right; margin: 0px;}
	#my-page-top ul {margin: 0px 0px -5px 0px;}
	#my-page-top ul li {margin: 0px;}
	#my-page-top ul li a {margin: 0px;}
	
	.my-action-bottom {float: right; padding-right:10px;}
	
	.my-box-filter {
		width: 30%;
		left: 35%;
	}
	
	.my-box-confirm {
		width: 50%;
		left: 25%;
	}
	
	.my-box-form-float {
		width: 80%;
		left: 10%;
	}
	
}

@media screen and (max-width: 767px) {
	
	
	#my-menu-box-logo {margin-top:-8px;}

	#my-breadcrumb { 
		position: fixed; 
		width: 100%; 
		top: 52px;
		z-index:5;
	}
	#my-page-top {text-align: left; margin-top: 5px;}
	#my-page-top ul {margin: 0px 0px -5px 0px;}
	#my-page-top ul li {margin: 0px;}
	#my-page-top ul li a {margin: 0px;}
	
	.my-action-bottom {padding-bottom: 5px;}
	
	.my-box-filter {
		width: 50%;
		left: 25%;
	}
	
	.my-box-confirm {
		width: 90%;
		left: 5%;
	}
	

	.my-box-form-float {
		width: 90%;
		left: 5%;
	}

}	

#request-notification {z-index:4; position:fixed; bottom: 2%;}

</style>

<body id="my-body" onclick="AlertHide()" style="background-image: url('<?php echo base_url(); ?>assets/images/my-bg.jpg')">

<div id="my-wrapper">

<audio id="tone-new-request">
  <source src="<?php echo base_url() ?>assets/tones/to-the-point.mp3" type="audio/mpeg">
</audio>

<audio id="tone-send-request">
  <source src="<?php echo base_url() ?>assets/tones/filling-your-inbox.mp3" type="audio/mpeg">
</audio>

<span id="request-notification"></span>

<div class="my-alert-box" id="my-alert-box" style="display:none;"></div>
<?php require_once 'set_menu.php'; ?>