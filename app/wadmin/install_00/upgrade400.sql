ALTER TABLE `tblpromotions` ADD `existingclient` INT NOT NULL , ADD `onceperclient` INT NOT NULL ;

ALTER TABLE `tblcredit` ADD `relid` INT( 10 ) NOT NULL DEFAULT '0' ;

ALTER TABLE `tblclients` ADD `currency` INT( 10 ) NOT NULL AFTER `password` ;
UPDATE tblclients SET currency=1;

CREATE TABLE `tblcurrencies` (
`id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`code` TEXT NOT NULL ,
`prefix` TEXT NOT NULL ,
`suffix` TEXT NOT NULL ,
`format` INT( 1 ) NOT NULL ,
`rate` DECIMAL( 10, 5 ) NOT NULL DEFAULT '1',
`default` INT( 1 ) NOT NULL 
) ;
INSERT INTO `tblcurrencies` (`id`, `code`, `prefix`, `suffix`, `format`, `rate`, `default`) VALUES
(1, 'USD', '$', ' USD', 1, 1.00000, 1);

CREATE TABLE `tblpricing` (
`id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`type` ENUM( "product", "addon", "configoptions", "domainregister", "domaintransfer", "domainrenew", "domainaddons" ) NOT NULL ,
`currency` INT( 10 ) NOT NULL ,
`relid` INT( 10 ) NOT NULL ,
`msetupfee` DECIMAL( 10, 2 ) NOT NULL ,
`qsetupfee` DECIMAL( 10, 2 ) NOT NULL ,
`ssetupfee` DECIMAL( 10, 2 ) NOT NULL ,
`asetupfee` DECIMAL( 10, 2 ) NOT NULL ,
`bsetupfee` DECIMAL( 10, 2 ) NOT NULL ,
`monthly` DECIMAL( 10, 2 ) NOT NULL ,
`quarterly` DECIMAL( 10, 2 ) NOT NULL ,
`semiannually` DECIMAL( 10, 2 ) NOT NULL ,
`annually` DECIMAL( 10, 2 ) NOT NULL ,
`biennially` DECIMAL( 10, 2 ) NOT NULL 
) ;

INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('CurrencyAutoUpdateExchangeRates', 'on');
INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('CurrencyAutoUpdateProductPrices', '');

ALTER TABLE `tblaccounts` ADD `currency` INT( 10 ) NOT NULL AFTER `userid` ;

ALTER TABLE `tblquotes` ADD `currency` INT( 10 ) NOT NULL AFTER `phonenumber` ;

ALTER TABLE `tblpaymentgateways`  DROP `id`,  DROP `type`,  DROP `name`,  DROP `size`,  DROP `notes`,  DROP `description`;

CREATE TABLE `tbladminsecurityquestions` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `question` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

ALTER TABLE `tblclients` ADD `securityqid` INT( 10 ) NOT NULL AFTER `billingcid` , ADD `securityqans` TEXT NOT NULL AFTER `securityqid` ;

ALTER TABLE `tblemails` ADD `to` TEXT NULL, ADD `cc` TEXT NULL, ADD `bcc` TEXT NULL;

ALTER TABLE `tbladmins` ADD `template` TEXT NOT NULL AFTER `notes` ;
UPDATE tbladmins SET template='v4';

ALTER TABLE `tblaccounts` ADD `refundid` INT( 10 ) NOT NULL DEFAULT '0' ;

INSERT INTO `tblconfiguration` (`setting` ,`value`) VALUES ('RequiredPWStrength', '50');

INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('MaintenanceMode', '');
INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('MaintenanceModeMessage', 'We are currently performing maintenance and will be back shortly.');

ALTER TABLE `tblaccounts` ADD `rate` DECIMAL( 10, 5 ) NOT NULL DEFAULT '1' AFTER `amountout` ;

UPDATE tblaccounts SET rate='1';
UPDATE tblaccounts SET currency='1' WHERE userid='0';

ALTER TABLE `tblcustomfields` ADD `regexpr` TEXT NOT NULL AFTER `fieldoptions` ;

CREATE TABLE `tblknowledgebaselinks` (
`categoryid` INT( 10 ) NOT NULL ,
`articleid` INT( 10 ) NOT NULL 
) ;

CREATE TABLE `tblbillableitems` (
  `id` int(10) NOT NULL auto_increment,
  `userid` int(10) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `recur` int(5) NOT NULL default '0',
  `recurcycle` text NOT NULL,
  `recurfor` int(5) NOT NULL default '0',
  `invoiceaction` int(1) NOT NULL,
  `duedate` date NOT NULL,
  `invoicecount` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ;

INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('SkipFraudForExisting', '');
INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('SMTPSSL', '');
INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('ContactFormDept', '');
INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('ContactFormTo', '');

CREATE TABLE  `tblclientgroups` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `groupname` varchar(45) NOT NULL,
  `groupcolour` varchar(45) default NULL,
  `discountpercent` decimal(10,2) unsigned default '0.00',
  `susptermexempt` text,
  PRIMARY KEY  (`id`)
) ;

ALTER TABLE `tblclients` ADD `groupid` INT( 10 ) NOT NULL AFTER `securityqans` ;

CREATE TABLE `tblticketescalations` (
`id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` TEXT NOT NULL ,
`departments` TEXT NOT NULL ,
`statuses` TEXT NOT NULL ,
`priorities` TEXT NOT NULL ,
`timeelapsed` INT( 5 ) NOT NULL ,
`newdepartment` TEXT NOT NULL ,
`newpriority` TEXT NOT NULL ,
`newstatus` TEXT NOT NULL ,
`flagto` TEXT NOT NULL ,
`notify` TEXT NOT NULL ,
`addreply` TEXT NOT NULL 
) ;

ALTER TABLE `tblhosting` ADD `overidesuspenduntil` DATE NOT NULL AFTER `overideautosuspend` ;

INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('TicketEscalationLastRun', '2009-01-01 00:00:00');

INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('APIAllowedIPs', '');

ALTER TABLE `tblclients` ADD `gatewayid` TEXT NOT NULL AFTER `issuenumber` ;

INSERT INTO `tbladminperms` (`roleid` ,`permid` )VALUES ('1', '86'),('1', '87'),('1', '88'),('1', '89'),('1', '90'),('1', '91'),('1', '92'),('1', '93'),('1', '94');

UPDATE tblconfiguration SET value='4.0.0' WHERE setting='Version';