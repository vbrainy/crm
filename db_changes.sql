-- DB CHANGES
ALTER TABLE `account_permission`  ADD `segment_read` INT NOT NULL ,  ADD `segment_write` INT NOT NULL ,  ADD `segment_delete` INT NOT NULL ;
ALTER TABLE `account_permission` CHANGE `segment_read` `segment_read` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `account_permission` CHANGE `segment_write` `segment_write` INT(11) NOT NULL DEFAULT '0', CHANGE `segment_delete` `segment_delete` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `account_permission` CHANGE `region_team_write` `region_write` INT(1) NOT NULL DEFAULT '0';
ALTER TABLE `account_permission` CHANGE `region_team_delete` `region_delete` INT(1) NOT NULL DEFAULT '0';
ALTER TABLE `account_permission`  ADD `admin_read` INT NOT NULL DEFAULT '0' ,  ADD `admin_write` INT NOT NULL DEFAULT '0' ,  ADD `admin_delete` INT NOT NULL DEFAULT '0' ,  ADD `customers_read` INT NOT NULL DEFAULT '0' ,  ADD `customers_write` INT NOT NULL DEFAULT '0' ,  ADD `customers_delete` INT NOT NULL DEFAULT '0' ;




