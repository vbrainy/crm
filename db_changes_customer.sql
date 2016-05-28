-- DB Changes Customer Module

ALTER TABLE customer MODIFY COLUMN id INT auto_increment PRIMARY KEY;

ALTER TABLE  `customer` CHANGE  `company`  `company` INT( 11 ) NULL;
