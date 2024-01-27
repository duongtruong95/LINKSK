<!--
  Đơn vị thiết kế web CMSNT
  Website: CMSNT.CO
  Zalo: 0947838128
-->
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title><?=$title;?></title>
	<meta name="description" content="<?=$CMSNT->site('description');?>">
    <meta name="keywords" content="<?=$CMSNT->site('keywords');?>">
	<!-- Open Graph data -->
	<meta property="og:description" content="<?=$CMSNT->site('description');?>" />
    <meta property="og:site_name" content="<?=$CMSNT->site('title');?>" />
    <meta property="og:title" content="<?=$title;?>" />
    <meta property="og:url" content="<?=BASE_URL('');?>" />
    <meta property="og:image" content="<?=BASE_URL($CMSNT->site('image'));?>" />
	<!-- Twitter Card data -->
    <meta name="twitter:card" content="<?=BASE_URL($CMSNT->site('image'));?>">
    <meta name="twitter:site" content="<?=$CMSNT->site('title');?>">
    <meta name="twitter:title" content="<?=$title;?>">
    <meta name="twitter:description" content="<?=$CMSNT->site('description');?>">
    <meta name="twitter:creator" content="CMSNT.CO">
    <meta name="twitter:image:src" content="<?=BASE_URL($CMSNT->site('image'));?>">
	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?=BASE_URL('template/DeskApp/');?>vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?=BASE_URL('template/DeskApp/');?>vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?=BASE_URL('template/DeskApp/');?>vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="<?=BASE_URL('template/DeskApp/');?>src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?=BASE_URL('template/DeskApp/');?>src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<!-- switchery css -->
	<link rel="stylesheet" type="text/css" href="<?=BASE_URL('template/DeskApp/');?>src/plugins/switchery/switchery.min.css">
	<!-- sweetalert2 -->
	<link rel="stylesheet" type="text/css" href="<?=BASE_URL('template/DeskApp/');?>src/plugins/sweetalert2/sweetalert2.css">
	<script src="<?=BASE_URL('template/DeskApp/');?>src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<!-- cute-alert -->
	<script src="<?=BASE_URL('template/');?>cute-alert/cute-alert.js" type="text/javascript"></script>
    <link class="main-stylesheet" href="<?=BASE_URL('template/');?>cute-alert/style.css" rel="stylesheet"
        type="text/css">
	<!-- jQuery -->
    <script src="<?=BASE_URL('template/js/');?>jquery-3.6.0.js"></script>
    <!-- CSS Option -->
    <?=$header;?>
	<?=$CMSNT->site('javascript');?>
</head>