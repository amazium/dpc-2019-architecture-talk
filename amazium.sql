SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `address`
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` varchar(36) NOT NULL,
  `identity_id` varchar(36) DEFAULT NULL,
  `address_type` enum('PRIMARY_ADDRESS','ADDITIONAL_ADDRESS','POSTBOX','FORWARDING_ADDRESS') DEFAULT 'PRIMARY_ADDRESS',
  `building` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `number` varchar(25) DEFAULT NULL,
  `box` varchar(25) DEFAULT NULL,
  `zipcode` varchar(25) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `country` varchar(2) DEFAULT NULL,
  `active_from` date DEFAULT NULL,
  `active_until` date DEFAULT NULL,
  `extra_info` varchar(4000) NOT NULL DEFAULT '{}',
  `state` enum('PENDING','ACTIVE','ABANDONED') NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`),
  KEY `identity_id` (`identity_id`),
  CONSTRAINT `address_identity_fk` FOREIGN KEY (`identity_id`) REFERENCES `identity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `address_audit`
-- ----------------------------
DROP TABLE IF EXISTS `address_audit`;
CREATE TABLE `address_audit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address_id` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `action` enum('INSERT','UPDATE','DELETE') DEFAULT NULL,
  `identity_id` varchar(36) DEFAULT NULL,
  `address_type` enum('PRIMARY_ADDRESS','ADDITIONAL_ADDRESS','POSTBOX','FORWARDING_ADDRESS') DEFAULT NULL,
  `building` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `number` varchar(25) DEFAULT NULL,
  `box` varchar(25) DEFAULT NULL,
  `zipcode` varchar(25) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `country` varchar(2) DEFAULT NULL,
  `active_from` date DEFAULT NULL,
  `active_until` date DEFAULT NULL,
  `extra_info` varchar(4000) DEFAULT NULL,
  `state` enum('PENDING','ACTIVE','ABANDONED') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `bank_account`
-- ----------------------------
DROP TABLE IF EXISTS `bank_account`;
CREATE TABLE `bank_account` (
  `id` varchar(36) NOT NULL,
  `identity_id` varchar(36) NOT NULL,
  `card_address_id` varchar(36) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `name_on_account` varchar(255) NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_address_line_1` varchar(255) DEFAULT NULL,
  `bank_address_line_2` varchar(255) DEFAULT NULL,
  `bank_address_line_3` varchar(255) DEFAULT NULL,
  `extra_info` varchar(4000) NOT NULL DEFAULT '{}',
  `state` enum('REQUESTED','ACTIVE','ABANDONED') NOT NULL DEFAULT 'REQUESTED',
  PRIMARY KEY (`id`),
  KEY `identity_id` (`identity_id`),
  KEY `address_id` (`card_address_id`),
  CONSTRAINT `bank_account_address_fk` FOREIGN KEY (`card_address_id`) REFERENCES `address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bank_account_identity_fk` FOREIGN KEY (`identity_id`) REFERENCES `identity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `bank_account_audit`
-- ----------------------------
DROP TABLE IF EXISTS `bank_account_audit`;
CREATE TABLE `bank_account_audit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bank_account_id` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `action` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `identity_id` varchar(36) DEFAULT NULL,
  `card_address_id` varchar(36) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `name_on_account` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_address_line_1` varchar(255) DEFAULT NULL,
  `bank_address_line_2` varchar(255) DEFAULT NULL,
  `bank_address_line_3` varchar(255) DEFAULT NULL,
  `extra_info` varchar(4000) DEFAULT NULL,
  `state` enum('REQUESTED','ACTIVE','ABANDONED') NOT NULL DEFAULT 'REQUESTED',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `card`
-- ----------------------------
DROP TABLE IF EXISTS `card`;
CREATE TABLE `card` (
  `id` varchar(36) NOT NULL,
  `identity_id` varchar(36) NOT NULL,
  `issuer` varchar(255) NOT NULL,
  `card_type` varchar(25) NOT NULL,
  `card_number` varchar(50) DEFAULT NULL,
  `name_on_card` varchar(255) DEFAULT NULL,
  `valid_from` date DEFAULT NULL,
  `valid_thru` date DEFAULT NULL,
  `cvv_code` varchar(10) DEFAULT NULL,
  `front_document_id` varchar(36) DEFAULT NULL,
  `back_document_id` varchar(36) DEFAULT NULL,
  `bank_account_id` varchar(36) DEFAULT NULL,
  `extra_info` varchar(4000) DEFAULT NULL,
  `state` enum('REQUESTED','ACTIVE','ABANDONED') DEFAULT 'REQUESTED',
  PRIMARY KEY (`id`),
  KEY `identity_id` (`identity_id`),
  KEY `front_document_id` (`front_document_id`),
  KEY `back_document_id` (`back_document_id`),
  KEY `bank_account_id` (`bank_account_id`),
  CONSTRAINT `card_ibfk_1` FOREIGN KEY (`front_document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `card_ibfk_2` FOREIGN KEY (`back_document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `card_ibfk_3` FOREIGN KEY (`bank_account_id`) REFERENCES `bank_account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `card_identity_fk` FOREIGN KEY (`identity_id`) REFERENCES `identity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `card_audit`
-- ----------------------------
DROP TABLE IF EXISTS `card_audit`;
CREATE TABLE `card_audit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `card_id` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `action` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `identity_id` varchar(36) DEFAULT NULL,
  `issuer` varchar(255) DEFAULT NULL,
  `card_type` varchar(25) NOT NULL,
  `card_number` varchar(50) DEFAULT NULL,
  `name_on_card` varchar(255) DEFAULT NULL,
  `valid_from` date DEFAULT NULL,
  `valid_thru` date DEFAULT NULL,
  `cvv_code` varchar(10) DEFAULT NULL,
  `front_document_id` varchar(36) DEFAULT NULL,
  `back_document_id` varchar(36) DEFAULT NULL,
  `bank_account_id` varchar(36) DEFAULT NULL,
  `extra_info` varchar(4000) DEFAULT NULL,
  `state` enum('REQUESTED','ACTIVE','ABANDONED') DEFAULT 'REQUESTED',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `document`
-- ----------------------------
DROP TABLE IF EXISTS `document`;
CREATE TABLE `document` (
  `id` varchar(36) NOT NULL,
  `identity_id` varchar(36) NOT NULL,
  `document_type` enum('IDCARD_FRONT','IDCARD_BACK','PASSPORT','DRIVER_LICENSE_FRONT','DRIVER_LICENSE_BACK','TAX_RETURN','SALARY_SLIP','BANK_CARD_FRONT','BANK_CARD_BACK','BANK_STATEMENT','CARD_STATEMENT','UTILITY_BILL') NOT NULL,
  `document_identifier` varchar(255) NOT NULL,
  `file_type` enum('JPG','PNG','PDF','WORD','XLS','XLSX','TIFF') NOT NULL DEFAULT 'PDF',
  `document` longblob NOT NULL,
  `valid_from` date DEFAULT NULL,
  `valid_until` date DEFAULT NULL,
  `extra_info` varchar(4000) NOT NULL DEFAULT '{}',
  PRIMARY KEY (`id`),
  KEY `identity_id` (`identity_id`),
  CONSTRAINT `document_identity_fk` FOREIGN KEY (`identity_id`) REFERENCES `identity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `document_audit`
-- ----------------------------
DROP TABLE IF EXISTS `document_audit`;
CREATE TABLE `document_audit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `document_id` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `action` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `identity_id` varchar(36) DEFAULT NULL,
  `document_type` enum('IDCARD_FRONT','IDCARD_BACK','PASSPORT','DRIVER_LICENSE_FRONT','DRIVER_LICENSE_BACK','TAX_RETURN','SALARY_SLIP','BANK_CARD_FRONT','BANK_CARD_BACK','BANK_STATEMENT','CARD_STATEMENT','UTILITY_BILL') DEFAULT NULL,
  `document_identifier` varchar(255) DEFAULT NULL,
  `file_type` enum('JPG','PNG','PDF','WORD','XLS','XLSX','TIFF') DEFAULT NULL,
  `document` longblob DEFAULT NULL,
  `valid_from` date DEFAULT NULL,
  `valid_until` date DEFAULT NULL,
  `extra_info` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `identity`
-- ----------------------------
DROP TABLE IF EXISTS `identity`;
CREATE TABLE `identity` (
  `id` varchar(36) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `birth_country` varchar(2) DEFAULT NULL,
  `nationality` varchar(2) DEFAULT NULL,
  `language` varchar(2) DEFAULT NULL,
  `extra_info` varchar(4000) NOT NULL DEFAULT '{}',
  `state` enum('COLLECTING_INFORMATION','ACTIVE','ABANDONED') DEFAULT 'COLLECTING_INFORMATION',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `identity_audit`
-- ----------------------------
DROP TABLE IF EXISTS `identity_audit`;
CREATE TABLE `identity_audit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identity_id` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `action` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `birth_country` varchar(2) DEFAULT NULL,
  `nationality` varchar(2) DEFAULT NULL,
  `language` varchar(2) DEFAULT NULL,
  `extra_info` varchar(4000) NOT NULL,
  `state` enum('COLLECTING_INFORMATION','ACTIVE','ABANDONED') DEFAULT 'COLLECTING_INFORMATION',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `phone`
-- ----------------------------
DROP TABLE IF EXISTS `phone`;
CREATE TABLE `phone` (
  `id` varchar(36) NOT NULL,
  `identity_id` varchar(36) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `phone_number` varchar(32) NOT NULL,
  `pin_code` varchar(20) NOT NULL,
  `puk_code` varchar(20) NOT NULL,
  `puk2_code` varchar(20) NOT NULL,
  `extra_info` varchar(4000) NOT NULL DEFAULT '{}',
  `state` enum('PENDING_ACTIVATION','ACTIVE','ABANDONED') NOT NULL DEFAULT 'PENDING_ACTIVATION',
  PRIMARY KEY (`id`),
  KEY `identity_id` (`identity_id`),
  CONSTRAINT `phone_identity_FK` FOREIGN KEY (`identity_id`) REFERENCES `identity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `phone_audit`
-- ----------------------------
DROP TABLE IF EXISTS `phone_audit`;
CREATE TABLE `phone_audit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone_id` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `action` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `identity_id` varchar(36) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `phone_number` varchar(32) DEFAULT NULL,
  `pin_code` varchar(20) DEFAULT NULL,
  `puk_code` varchar(20) DEFAULT NULL,
  `puk2_code` varchar(20) DEFAULT NULL,
  `extra_info` varchar(4000) DEFAULT NULL,
  `state` enum('PENDING_ACTIVATION','ACTIVE','ABANDONED') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  View structure for `v_address_detail`
-- ----------------------------
DROP VIEW IF EXISTS `v_address_detail`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_address_detail` AS select `address`.`id` AS `address_id`,`address`.`identity_id` AS `identity_id`,trim(concat(`identity`.`first_name`,' ',`identity`.`middle_name`)) AS `identity_name`,`address`.`address_type` AS `address_type`,`address`.`building` AS `building`,`address`.`street` AS `street`,`address`.`number` AS `number`,`address`.`box` AS `box`,`address`.`zipcode` AS `zipcode`,`address`.`region` AS `region`,`address`.`city` AS `city`,`address`.`country` AS `country`,`address`.`active_from` AS `active_from`,`address`.`active_until` AS `active_until`,`address`.`extra_info` AS `extra_info`,`address`.`state` AS `state` from (`address` join `identity` on(`address`.`identity_id` = `identity`.`id`));

-- ----------------------------
--  View structure for `v_address_overview`
-- ----------------------------
DROP VIEW IF EXISTS `v_address_overview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_address_overview` AS select `address`.`id` AS `address_id`,`address`.`identity_id` AS `identity_id`,trim(concat(`identity`.`first_name`,' ',`identity`.`middle_name`)) AS `identity_name`,`address`.`address_type` AS `address_type`,trim(trim(both ' box ' from concat(`address`.`street`,' ',`address`.`number`,' box ',`address`.`box`))) AS `street`,trim(concat(`address`.`zipcode`,' ',`address`.`city`)) AS `city`,`address`.`country` AS `country`,`address`.`active_from` AS `active_from`,`address`.`active_until` AS `active_until`,`address`.`state` AS `state` from (`address` left join `identity` on(`address`.`identity_id` = `identity`.`id`));

-- ----------------------------
--  View structure for `v_bank_account_detail`
-- ----------------------------
DROP VIEW IF EXISTS `v_bank_account_detail`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bank_account_detail` AS select `bank_account`.`id` AS `bank_account_id`,`bank_account`.`identity_id` AS `identity_id`,trim(concat(`identity`.`first_name`,' ',`identity`.`last_name`)) AS `identity_name`,`bank_account`.`card_address_id` AS `card_address_id`,trim(both ',' from trim(concat(trim(trim(both ' box ' from concat(`address`.`street`,' ',`address`.`number`,' box ',`address`.`box`))),', ',concat(`address`.`zipcode`,' ',`address`.`city`)))) AS `card_address`,`bank_account`.`account_number` AS `account_number`,`bank_account`.`name_on_account` AS `name_on_account`,`bank_account`.`bank_name` AS `bank_name`,`bank_account`.`bank_address_line_1` AS `bank_address_line_1`,`bank_account`.`bank_address_line_2` AS `bank_address_line_2`,`bank_account`.`bank_address_line_3` AS `bank_address_line_3`,`bank_account`.`extra_info` AS `extra_info`,`bank_account`.`state` AS `state` from ((`bank_account` left join `identity` on(`bank_account`.`identity_id` = `identity`.`id`)) left join `address` on(`bank_account`.`card_address_id` = `address`.`id`));

-- ----------------------------
--  View structure for `v_bank_account_overview`
-- ----------------------------
DROP VIEW IF EXISTS `v_bank_account_overview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bank_account_overview` AS select `bank_account`.`id` AS `bank_account_id`,`bank_account`.`identity_id` AS `identity_id`,trim(concat(`identity`.`first_name`,' ',`identity`.`last_name`)) AS `identity_name`,`bank_account`.`account_number` AS `account_number`,`bank_account`.`name_on_account` AS `name_on_account`,`bank_account`.`bank_name` AS `bank_name`,`bank_account`.`state` AS `state` from (`bank_account` left join `identity` on(`bank_account`.`identity_id` = `identity`.`id`));

-- ----------------------------
--  View structure for `v_card_detail`
-- ----------------------------
DROP VIEW IF EXISTS `v_card_detail`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_card_detail` AS select `card`.`id` AS `id`,`card`.`identity_id` AS `identity_id`,trim(concat(`identity`.`first_name`,' ',`identity`.`last_name`)) AS `identity_name`,`card`.`issuer` AS `issuer`,`card`.`card_type` AS `card_type`,`card`.`card_number` AS `card_number`,`card`.`name_on_card` AS `name_on_card`,`card`.`valid_from` AS `valid_from`,`card`.`valid_thru` AS `valid_thru`,`card`.`cvv_code` AS `cvv_code`,`card`.`front_document_id` AS `front_document_id`,`card`.`back_document_id` AS `back_document_id`,`card`.`bank_account_id` AS `bank_account_id`,`bank_account`.`account_number` AS `bank_account_number`,`card`.`extra_info` AS `extra_info`,`card`.`state` AS `state` from ((`card` left join `bank_account` on(`card`.`bank_account_id` = `bank_account`.`id`)) left join `identity` on(`card`.`identity_id` = `identity`.`id`));

-- ----------------------------
--  View structure for `v_card_overview`
-- ----------------------------
DROP VIEW IF EXISTS `v_card_overview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_card_overview` AS select `card`.`id` AS `id`,`card`.`identity_id` AS `identity_id`,trim(concat(`identity`.`first_name`,' ',`identity`.`last_name`)) AS `identity_name`,`card`.`issuer` AS `issuer`,`card`.`card_type` AS `card_type`,`card`.`card_number` AS `card_number`,`card`.`name_on_card` AS `name_on_card`,`card`.`bank_account_id` AS `bank_account_id`,`bank_account`.`account_number` AS `bank_account_number`,`card`.`state` AS `state` from ((`card` left join `identity` on(`card`.`identity_id` = `identity`.`id`)) left join `bank_account` on(`card`.`bank_account_id` = `bank_account`.`id`));

-- ----------------------------
--  View structure for `v_document_detail`
-- ----------------------------
DROP VIEW IF EXISTS `v_document_detail`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_document_detail` AS select `document`.`id` AS `id`,trim(concat(`document`.`identity_id`,' ',`identity`.`first_name`,`identity`.`last_name`)) AS `identity_name`,`document`.`document_type` AS `document_type`,`document`.`document_identifier` AS `document_identifier`,`document`.`file_type` AS `file_type`,`document`.`valid_from` AS `valid_from`,`document`.`valid_until` AS `valid_until`,`document`.`extra_info` AS `extra_info` from (`document` left join `identity` on(`document`.`identity_id` = `identity`.`id`));

-- ----------------------------
--  View structure for `v_document_overview`
-- ----------------------------
DROP VIEW IF EXISTS `v_document_overview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_document_overview` AS select `document`.`id` AS `id`,trim(concat(`document`.`identity_id`,' ',`identity`.`first_name`,`identity`.`last_name`)) AS `identity_name`,`document`.`document_type` AS `document_type`,`document`.`document_identifier` AS `document_identifier`,`document`.`file_type` AS `file_type` from (`document` left join `identity` on(`document`.`identity_id` = `identity`.`id`));

-- ----------------------------
--  View structure for `v_identity_detail`
-- ----------------------------
DROP VIEW IF EXISTS `v_identity_detail`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_identity_detail` AS select `identity`.`id` AS `identity_id`,`identity`.`first_name` AS `first_name`,`identity`.`middle_name` AS `middle_name`,`identity`.`last_name` AS `last_name`,`identity`.`birth_date` AS `birth_date`,`identity`.`birth_place` AS `birth_place`,`identity`.`birth_country` AS `birth_country`,`identity`.`nationality` AS `nationality`,`identity`.`language` AS `language`,`identity`.`extra_info` AS `extra_info`,`identity`.`state` AS `state` from `identity`;

-- ----------------------------
--  View structure for `v_identity_overview`
-- ----------------------------
DROP VIEW IF EXISTS `v_identity_overview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_identity_overview` AS select `identity`.`id` AS `identity_id`,`identity`.`first_name` AS `first_name`,`identity`.`last_name` AS `last_name`,`identity`.`state` AS `state` from `identity`;

-- ----------------------------
--  View structure for `v_phone_detail`
-- ----------------------------
DROP VIEW IF EXISTS `v_phone_detail`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_phone_detail` AS select `phone`.`id` AS `phone_id`,`phone`.`identity_id` AS `identity_id`,trim(concat(`identity`.`first_name`,' ',`identity`.`last_name`)) AS `identity_name`,`phone`.`provider` AS `provider`,`phone`.`phone_number` AS `phone_number`,`phone`.`pin_code` AS `pin_code`,`phone`.`puk_code` AS `puk_code`,`phone`.`puk2_code` AS `puk2_code`,`phone`.`extra_info` AS `extra_info`,`phone`.`state` AS `state` from (`phone` left join `identity` on(`phone`.`identity_id` = `identity`.`id`));

-- ----------------------------
--  View structure for `v_phone_overview`
-- ----------------------------
DROP VIEW IF EXISTS `v_phone_overview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_phone_overview` AS select `phone`.`id` AS `phone_id`,`phone`.`identity_id` AS `identity_id`,trim(concat(`identity`.`first_name`,' ',`identity`.`last_name`)) AS `identity_name`,`phone`.`provider` AS `provider`,`phone`.`phone_number` AS `phone_number`,`phone`.`state` AS `state` from (`phone` left join `identity` on(`phone`.`identity_id` = `identity`.`id`));

-- ----------------------------
--  Triggers structure for table address
-- ----------------------------
DROP TRIGGER IF EXISTS `address_ai_trg`;
delimiter ;;
CREATE TRIGGER `address_ai_trg` AFTER INSERT ON `address` FOR EACH ROW BEGIN
    INSERT INTO address_audit VALUES (
        NULL, NEW.id, NOW(), 'INSERT', NEW.identity_id,
        NEW.address_type, NEW.building, NEW.street, NEW.number,
        NEW.box, NEW.zipcode, NEW.city, NEW.region, NEW.country,
        NEW.active_from, NEW.active_until, NEW.extra_info, NEW.state
    );
END
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `address_au_trg`;
delimiter ;;
CREATE TRIGGER `address_au_trg` AFTER UPDATE ON `address` FOR EACH ROW BEGIN
    INSERT INTO address_audit VALUES (
        NULL, NEW.id, NOW(), 'UPDATE', NEW.identity_id,
        NEW.address_type, NEW.building, NEW.street, NEW.number,
        NEW.box, NEW.zipcode, NEW.city, NEW.region, NEW.country,
        NEW.active_from, NEW.active_until, NEW.extra_info, NEW.state
    );
END
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `address_bd_trg`;
delimiter ;;
CREATE TRIGGER `address_bd_trg` BEFORE DELETE ON `address` FOR EACH ROW BEGIN
    INSERT INTO address_audit VALUES (
        NULL, OLD.id, NOW(), 'DELETE', OLD.identity_id,
        OLD.address_type, OLD.building, OLD.street, OLD.number,
        OLD.box, OLD.zipcode, OLD.city, OLD.region, OLD.country,
        OLD.active_from, OLD.active_until, OLD.extra_info, OLD.state
    );
END
 ;;
delimiter ;

delimiter ;;
-- ----------------------------
--  Triggers structure for table bank_account
-- ----------------------------
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `bank_account_ai_trg`;
delimiter ;;
CREATE TRIGGER `bank_account_ai_trg` AFTER INSERT ON `bank_account` FOR EACH ROW BEGIN
    INSERT INTO bank_account_audit VALUES (
        NULL, NEW.id, NOW(), 'INSERT', NEW.identity_id, NEW.card_address_id,
        NEW.account_number, NEW.name_on_account, NEW.bank_name, NEW.bank_address_line_1,
        NEW.bank_address_line_2, NEW.bank_address_line_3, NEW.extra_info, NEW.state
    );
END
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `bank_account_au_trg`;
delimiter ;;
CREATE TRIGGER `bank_account_au_trg` AFTER UPDATE ON `bank_account` FOR EACH ROW BEGIN
    INSERT INTO bank_account_audit VALUES (
        NULL, NEW.id, NOW(), 'UPDATE', NEW.identity_id, NEW.card_address_id,
        NEW.account_number, NEW.name_on_account, NEW.bank_name, NEW.bank_address_line_1,
        NEW.bank_address_line_2, NEW.bank_address_line_3, NEW.extra_info, NEW.state
    );
END
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `bank_account_bd_trg`;
delimiter ;;
CREATE TRIGGER `bank_account_bd_trg` BEFORE DELETE ON `bank_account` FOR EACH ROW BEGIN
    INSERT INTO bank_account_audit VALUES (
        NULL, OLD.id, NOW(), 'DELETE', OLD.identity_id, OLD.card_address_id,
        OLD.account_number, OLD.name_on_account, OLD.bank_name, OLD.bank_address_line_1,
        OLD.bank_address_line_2, OLD.bank_address_line_3, OLD.extra_info, OLD.state
    );
END
 ;;
delimiter ;

delimiter ;;
-- ----------------------------
--  Triggers structure for table card
-- ----------------------------
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `card_ai_trg`;
delimiter ;;
CREATE TRIGGER `card_ai_trg` AFTER INSERT ON `card` FOR EACH ROW BEGIN
    INSERT INTO card_audit VALUES (
        NULL, NEW.id, NOW(), 'INSERT', NEW.identity_id, NEW.issuer,
        NEW.card_type, NEW.card_number, NEW.name_on_card, NEW.valid_from, NEW.valid_thru,
        NEW.cvv_code, NEW.front_document_id, NEW.back_document_id, NEW.bank_account_id,
        NEW.extra_info, NEW.state
    );
END
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `card_au_trg`;
delimiter ;;
CREATE TRIGGER `card_au_trg` AFTER UPDATE ON `card` FOR EACH ROW BEGIN
    INSERT INTO card_audit VALUES (
        NULL, NEW.id, NOW(), 'UPDATE', NEW.identity_id, NEW.issuer,
        NEW.card_type, NEW.card_number, NEW.name_on_card, NEW.valid_from, NEW.valid_thru,
        NEW.cvv_code, NEW.front_document_id, NEW.back_document_id, NEW.bank_account_id,
        NEW.extra_info, NEW.state
    );
END
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `card_bd_trg`;
delimiter ;;
CREATE TRIGGER `card_bd_trg` BEFORE DELETE ON `card` FOR EACH ROW BEGIN
    INSERT INTO card_audit VALUES (
        NULL, OLD.id, NOW(), 'DELETE', OLD.identity_id, OLD.issuer,
        OLD.card_type, OLD.card_number, OLD.name_on_card, OLD.valid_from, OLD.valid_thru,
        OLD.cvv_code, OLD.front_document_id, OLD.back_document_id, OLD.bank_account_id,
        OLD.extra_info, OLD.state
    );
END
 ;;
delimiter ;

delimiter ;;
-- ----------------------------
--  Triggers structure for table document
-- ----------------------------
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `document_ai_trg`;
delimiter ;;
CREATE TRIGGER `document_ai_trg` AFTER INSERT ON `document` FOR EACH ROW BEGIN
    INSERT INTO document_audit VALUES (
        NULL, NEW.id, NOW(), 'INSERT', NEW.identity_id, NEW.document_type, NEW.document_identifier,
        NEW.file_type, NEW.document, NEW.valid_from, NEW.valid_until, NEW.extra_info
    );
END
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `document_au_trg`;
delimiter ;;
CREATE TRIGGER `document_au_trg` AFTER UPDATE ON `document` FOR EACH ROW BEGIN
    INSERT INTO document_audit VALUES (
        NULL, NEW.id, NOW(), 'UPDATE', NEW.identity_id, NEW.document_type, NEW.document_identifier,
        NEW.file_type, NEW.document, NEW.valid_from, NEW.valid_until, NEW.extra_info
    );
END
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `document_bd_trg`;
delimiter ;;
CREATE TRIGGER `document_bd_trg` BEFORE DELETE ON `document` FOR EACH ROW BEGIN
    INSERT INTO document_audit VALUES (
        NULL, OLD.id, NOW(), 'DELETE', OLD.identity_id, OLD.document_type, OLD.document_identifier,
        OLD.file_type, OLD.document, OLD.valid_from, OLD.valid_until, OLD.extra_info
    );
END
 ;;
delimiter ;

delimiter ;;
-- ----------------------------
--  Triggers structure for table identity
-- ----------------------------
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `identity_ai_trg`;
delimiter ;;
CREATE TRIGGER `identity_ai_trg` AFTER INSERT ON `identity` FOR EACH ROW BEGIN
    INSERT INTO identity_audit VALUES (
        NULL, NEW.id, NOW(), 'INSERT', NEW.first_name,
        NEW.middle_name, NEW.last_name, NEW.birth_date, NEW.birth_place,
        NEW.birth_country, NEW.nationality, NEW.language, NEW.extra_info, NEW.state
    );
END
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `identity_au_trg`;
delimiter ;;
CREATE TRIGGER `identity_au_trg` AFTER UPDATE ON `identity` FOR EACH ROW BEGIN
    INSERT INTO identity_audit VALUES (
        NULL, NEW.id, NOW(), 'UPDATE', NEW.first_name,
        NEW.middle_name, NEW.last_name, NEW.birth_date, NEW.birth_place,
        NEW.birth_country, NEW.nationality, NEW.language, NEW.extra_info, NEW.state
    );
END
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `identity_bd_trg`;
delimiter ;;
CREATE TRIGGER `identity_bd_trg` BEFORE DELETE ON `identity` FOR EACH ROW BEGIN
    INSERT INTO identity_audit VALUES (
        NULL, OLD.id, NOW(), 'DELETE', OLD.first_name,
        OLD.middle_name, OLD.last_name, OLD.birth_date, OLD.birth_place,
        OLD.birth_country, OLD.nationality, OLD.language, OLD.extra_info, OLD.state
    );
END
 ;;
delimiter ;

delimiter ;;
-- ----------------------------
--  Triggers structure for table phone
-- ----------------------------
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `phone_ai_trg`;
delimiter ;;
CREATE TRIGGER `phone_ai_trg` AFTER INSERT ON `phone` FOR EACH ROW BEGIN
    INSERT INTO phone_audit VALUES (
        NULL, NEW.id, NOW(), 'INSERT', NEW.identity_id, NEW.provider,
        NEW.phone_number, NEW.pin_code, NEW.puk_code, NEW.puk2_code, NEW.extra_info, NEW.state
    );
END
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `phone_au_trg`;
delimiter ;;
CREATE TRIGGER `phone_au_trg` AFTER UPDATE ON `phone` FOR EACH ROW BEGIN
    INSERT INTO phone_audit VALUES (
        NULL, NEW.id, NOW(), 'UPDATE', NEW.identity_id, NEW.provider,
        NEW.phone_number, NEW.pin_code, NEW.puk_code, NEW.puk2_code, NEW.extra_info, NEW.state
    );
END
 ;;
delimiter ;
DROP TRIGGER IF EXISTS `phone_bd_trg`;
delimiter ;;
CREATE TRIGGER `phone_bd_trg` BEFORE DELETE ON `phone` FOR EACH ROW BEGIN
    INSERT INTO phone_audit VALUES (
        NULL, OLD.id, NOW(), 'INSERT', OLD.identity_id, OLD.provider,
        OLD.phone_number, OLD.pin_code, OLD.puk_code, OLD.puk2_code, OLD.extra_info, OLD.state
    );
END
 ;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
