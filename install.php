<?php
    require_once(__DIR__."/config.php");
    require_once(__DIR__."/functions/function.php");


	$CMSNT->query("CREATE TABLE `settings` (
		`id` INT(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(255) UNIQUE,
		`value` TEXT NULL,
		PRIMARY KEY (`id`)
	)");
	

	insert_options('status_demo', 0);		
	insert_options('logo_light', 'assets/img/cmsnt_light.png');
	insert_options('logo_dark', 'assets/img/cmsnt_dark.png');
	insert_options('image', 'assets/storage/images/imageLHX.png');
	insert_options('favicon', 'assets/storage/images/faviconJS8.png');
	insert_options('bg_login', 'template/DeskApp/vendors/images/login-page-img.png');
	insert_options('bg_register', 'template/DeskApp/vendors/images/register-page-img.png');
	insert_options('title', 'CMSNT.CO');
	insert_options('description', '');
	insert_options('keywords', '');
	insert_options('author', '');
	insert_options('status', 1);
	insert_options('status_bank', 1);
	insert_options('type_bank', '');
	insert_options('token_bank', '');
	insert_options('stk_bank', '');
	insert_options('name_bank', '');
	insert_options('mk_bank', '');
	insert_options('status_momo', 1);
	insert_options('token_momo', '');
	insert_options('sdt_momo', '');
	insert_options('name_momo', '');
	insert_options('timeUpdate', '');
	insert_options('recharge_content', 'naptien ');
	insert_options('recharge_notice', 'Ghi chú nạp tiền');
	insert_options('javascript', '');
	insert_options('boclink_notice', '');
	insert_options('fakelink_notice', '');
	insert_options('shortenlink_notice', '');
	insert_options('email_smtp', '');
	insert_options('pass_email_smtp', '');
	insert_options('time_cron_24h', 0);
	insert_options('url_fake', 'i');
	insert_options('license_key', '');





	$CMSNT->query("CREATE TABLE `users` (
		`id` INT NOT NULL AUTO_INCREMENT,
		`username` varchar(255) NOT NULL UNIQUE,
		`email` varchar(255) NULL,
		`email_verified` varchar(255) NULL,
		`time_verified` TEXT NULL, 
		`phone` varchar(255) NULL,
		`full_name` TEXT NULL,
		`birthday` TEXT NULL, 
		`gender` TEXT NULL, 
		`password` varchar(255) NULL,
		`money` INT(11) NOT NULL DEFAULT '0',
		`total_money` INT(11) NOT NULL DEFAULT '0',
		`used_money` INT(11) NOT NULL DEFAULT '0',
		`createdate` DATETIME,
		`updatedate` DATETIME,
		`device` varchar(255) NULL,
		`ip` varchar(255) NULL,
		`otp` varchar(255) NULL,
		`time_otp` varchar(255) NULL,
		`time_session` varchar(255) NULL,
		`expired` INT(11) NOT NULL DEFAULT '0',
		`admin` INT(11) NOT NULL DEFAULT '0',
		`banned` INT(11) NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`)
	)");
	$CMSNT->query("CREATE TABLE `links` ( 
		`id` INT(11) NOT NULL AUTO_INCREMENT , 
		`title` VARCHAR(255) NULL , 
		`description` TEXT NULL , 
		`url_img` TEXT NULL , 
		`url_href` TEXT NULL , 
		`url_fake` TEXT NULL , 
		`createdate` DATETIME NOT NULL , 
		`updatedate` DATETIME NOT NULL , 
		`status` VARCHAR(255) NULL , 
		`views` INT(11) NOT NULL DEFAULT '0' , 
		`user_id` INT(11) NOT NULL DEFAULT '0' , 
		PRIMARY KEY (`id`)
	)");
	$CMSNT->query("CREATE TABLE `link_views` ( `id` INT(11) NOT NULL AUTO_INCREMENT , 
		`link_id` INT(11) NOT NULL DEFAULT '0' , 
		`country` VARCHAR(255) NULL , 
		`ip` VARCHAR(255) NULL , 
		`UserAgent` TEXT NULL , 
		`device` TEXT NULL , 
		`browser` TEXT NULL , 
		`redirect` TEXT NULL , 
		`createdate` DATETIME NOT NULL , 
		PRIMARY KEY (`id`)
	)");
	$CMSNT->query("CREATE TABLE `campaigns` ( `id` INT(11) NOT NULL AUTO_INCREMENT , 
		`trans_id` VARCHAR(255) NULL , 
		`user_id` INT(11) NOT NULL DEFAULT '0' ,
		`name` TEXT NULL ,
		`url_1` TEXT NULL ,
		`url_2` TEXT NULL ,
		`status` VARCHAR(255) NULL , 
		`views` INT(11) NOT NULL DEFAULT '0' , 
		`createdate` DATETIME NOT NULL , 
		`updatedate` DATETIME NOT NULL , 
		PRIMARY KEY (`id`)
	)");
	$CMSNT->query("ALTER TABLE `campaigns` ADD UNIQUE(`trans_id`) ");
	$CMSNT->query("CREATE TABLE `campaign_views` ( `id` INT(11) NOT NULL AUTO_INCREMENT , 
		`campaign_id` INT(11) NOT NULL DEFAULT '0' , 
		`country` VARCHAR(255) NULL , 
		`ip` VARCHAR(255) NULL , 
		`UserAgent` TEXT NULL , 
		`device` TEXT NULL , 
		`browser` TEXT NULL , 
		`redirect` TEXT NULL , 
		`createdate` DATETIME NOT NULL , 
		PRIMARY KEY (`id`)
	)");
	$CMSNT->query("CREATE TABLE `dongtien` ( `id` INT(11) NOT NULL AUTO_INCREMENT , 
		`user_id` INT(11) NOT NULL DEFAULT '0' ,
		`sotientruoc` INT(11) NOT NULL DEFAULT '0' , 
		`sotienthaydoi` INT(11) NOT NULL DEFAULT '0' , 
		`sotiensau` INT(11) NOT NULL DEFAULT '0' , 
		`thoigian` DATETIME NOT NULL , 
		`noidung` TEXT NULL , 
		PRIMARY KEY (`id`)
	)");
	$CMSNT->query("CREATE TABLE `bank_logs` ( `id` INT(11) NOT NULL AUTO_INCREMENT , 
		`user_id` INT(11) NOT NULL DEFAULT '0' , 
		`tid` TEXT NULL , 
		`amount` INT(11) NOT NULL DEFAULT '0' , 
		`description` TEXT NULL , 
		`time` DATETIME NOT NULL , 
		`bank_name` TEXT NULL , 
		PRIMARY KEY (`id`)
	)");
	$CMSNT->query("CREATE TABLE `momo_logs` ( `id` INT(11) NOT NULL AUTO_INCREMENT , 
		`user_id` INT(11) NOT NULL DEFAULT '0' , 
		`tranId` VARCHAR(255) NULL DEFAULT NULL , 
		`partnerId` VARCHAR(255) NULL DEFAULT NULL , 
		`partnerName` VARCHAR(255) NULL DEFAULT NULL , 
		`amount` INT(11) NOT NULL DEFAULT '0' ,
		`comment` VARCHAR(255) NULL DEFAULT NULL , 
		`time` DATETIME NOT NULL , 
		PRIMARY KEY (`id`)
	)");
	$CMSNT->query("CREATE TABLE `banks` ( `id` INT(11) NOT NULL AUTO_INCREMENT , 
		`bank_name` TEXT NULL , 
		`account_name` TEXT NULL , 
		`account_number` TEXT NULL , 
		`branch` TEXT NULL , 
		`image` TEXT NULL , 
		PRIMARY KEY (`id`)
	)");
	$CMSNT->query("CREATE TABLE `packages` ( `id` INT(11) NOT NULL AUTO_INCREMENT , 
		`name` TEXT NULL , 
		`expired` INT(11) NOT NULL DEFAULT '0' , 
		`price` INT(11) NOT NULL DEFAULT '0' , 
		PRIMARY KEY (`id`)
	)");
	$CMSNT->query("CREATE TABLE `package_logs` ( `id` INT(11) NOT NULL AUTO_INCREMENT , 
		`user_id` INT(11) NOT NULL , 
		`name` TEXT NULL , 
		`expired` INT(11) NOT NULL DEFAULT '0' , 
		`price` INT(11) NOT NULL DEFAULT '0' , 
		`createdate` DATETIME NOT NULL , 
		PRIMARY KEY (`id`)
	)");
	$CMSNT->query("CREATE TABLE `menus` ( `id` INT(11) NOT NULL AUTO_INCREMENT , 
		`name` TEXT NULL , 
		`menu_id` INT(11) NOT NULL DEFAULT '0' , 
		`href` TEXT NULL , 
		`createdate` DATETIME NOT NULL , 
		`updatedate` DATETIME NOT NULL , 
		`icon` TEXT NULL , 
		`target` TEXT NULL , 
		PRIMARY KEY (`id`)
	)");
	$CMSNT->query("CREATE TABLE `domains` ( `id` INT(11) NOT NULL AUTO_INCREMENT , 
	`user_id` INT(11) NOT NULL , 
	`domain` TEXT NULL , 
	`status` INT(11) NOT NULL DEFAULT '0' , 
	`share` INT(11) NOT NULL DEFAULT '0' , 
	`createdate` DATETIME NOT NULL , 
	`updatedate` DATETIME NOT NULL ,
	PRIMARY KEY (`id`)
	)");
	$CMSNT->query("ALTER TABLE `links` ADD `domain` VARCHAR(255) NULL AFTER `url_href` ");
	$CMSNT->query("ALTER TABLE `campaigns` ADD `block_desktop` INT(11) NOT NULL DEFAULT '0' AFTER `updatedate`	");
	$CMSNT->query("ALTER TABLE `link_views` ADD `online` INT(11) NOT NULL DEFAULT '0' AFTER `createdate`");