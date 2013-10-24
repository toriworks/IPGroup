<?
	if (!isset($gnb)) $gnb = '';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<!-- Google Fonts : Early Access [Nanum Gothic Coding (Korean)] http://www.google.com/fonts/earlyaccess -->
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css">
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>/default.css">
	<script type="text/javascript" src="<?=JS_URL?>/jquery-1.8.1.min.js"></script>
	<title><?=$page_title?></title>
</head>
<body>

<div id="wrap">

	<header>
		<div class="container">
			<h1><a href="<?=BASE_URL?>/"><img src="<?=IMG_URL?>/logo_pt.png" alt="아이피그룹 퍼블리싱팀"></a></h1>
			<nav class="lnb" role="navigation">
				<ul>
					<li<?=if_add_class(($gnb=='convention'),'on')?>><a href="<?=BASE_URL?>/convention/">Convention</a></li>
					<li<?=if_add_class(($gnb=='components'),'on')?>><a href="<?=BASE_URL?>/components/">Components</a></li>
					<li<?=if_add_class(($gnb=='js_plugin'),'on')?>><a href="<?=BASE_URL?>/js_plugin/">JS plug-in</a></li>
					<li<?=if_add_class(($gnb=='tools'),'on')?>><a href="<?=BASE_URL?>/tools/">Tools</a></li>
				</ul>
			</nav>
		</div>
	</header>

	<div id="content">
		<div class="container" role="main">

