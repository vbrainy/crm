-- DB Changes Customer Module


-- ADD PRIMARY KEY TO CUSTOMER TABLE 

ALTER TABLE customer MODIFY COLUMN id INT auto_increment PRIMARY KEY;

-- ADD PRIMARY KEY AUTO INCRIMENT TO COMPANY TABLE 

ALTER TABLE `company` MODIFY COLUMN id INT auto_increment PRIMARY KEY;

-- ADD FORIGN KEY RELATION TO FOR COMPANY TO CUSTOMER TABLE
ALTER TABLE  `customer` ADD INDEX (  `company` );

-- ADD NEW FIELD CITY FOR COMPANY TABLE 
ALTER TABLE  `company` ADD  `city` VARCHAR( 255 ) NOT NULL AFTER  `address`;

ALTER TABLE `regions` MODIFY COLUMN id INT auto_increment PRIMARY KEY;

INSERT INTO  `airtelcrm`.`regions` (
`id` ,
`region` ,
`region_leader` ,
`sales_target` ,
`sales_forecast` ,
`actual_sales` ,
`status` ,
`region_members` ,
`notes` ,
`register_time` ,
`ip_address`
)
VALUES (
NULL ,  'North',  '1',  '3394948',  '399483',  '9389',  '1',  '2',  '',  '1456098480',  '41.76.80.169'
);

INSERT INTO  `airtelcrm`.`regions` (
`id` ,
`region` ,
`region_leader` ,
`sales_target` ,
`sales_forecast` ,
`actual_sales` ,
`status` ,
`region_members` ,
`notes` ,
`register_time` ,
`ip_address`
)
VALUES (
NULL ,  'South',  '1',  '3394948',  '399483',  '9389',  '1',  '2',  '',  '1456098480',  '41.76.80.169'
);


INSERT INTO  `airtelcrm`.`regions` (
`id` ,
`region` ,
`region_leader` ,
`sales_target` ,
`sales_forecast` ,
`actual_sales` ,
`status` ,
`region_members` ,
`notes` ,
`register_time` ,
`ip_address`
)
VALUES (
NULL ,  'West',  '1',  '3394948',  '399483',  '9389',  '1',  '2',  '',  '1456098480',  '41.76.80.169'
);

ALTER TABLE `vertical` MODIFY COLUMN id INT auto_increment PRIMARY KEY;

TRUNCATE TABLE `vertical`;

INSERT INTO  `airtelcrm`.`vertical` (`id` ,`vertical_name`)
VALUES (NULL ,  'Carrier'), (NULL ,  'Financial'), (NULL ,  'Manufacturing'), (NULL ,  'Oil & Gas'), (
NULL ,  'Public Sector'), (NULL ,  'Services');



CREATE TABLE IF NOT EXISTS `reports_errors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `module_title` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0-Pending,1-Resolved',
  `created_datetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
