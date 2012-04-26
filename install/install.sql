CREATE TABLE IF NOT EXISTS `simplesample_contents`(
    `idx` INT(10) NOT NULL AUTO_INCREMENT,
    `seq` INT(10) NOT NULL,
    `subject` VARCHAR(250) NOT NULL,
    `contents` VARCHAR(250),
    `date_created` INT(10) NOT NULL,
    PRIMARY KEY  (`idx`)
);
