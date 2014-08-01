
-- Table structure for table `tblaccounts`
-- 

CREATE TABLE `tblaccounts` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `userid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `gateway` text NOT NULL,
  `date` datetime default NULL,
  `description` text NOT NULL,
  `amountin` decimal(10,2) NOT NULL default '0.00',
  `fees` decimal(10,2) NOT NULL default '0.00',
  `amountout` decimal(10,2) NOT NULL default '0.00',
  `transid` text NOT NULL,
  `invoiceid` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblactivitylog`
--

CREATE TABLE `tblactivitylog` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `description` text NOT NULL,
  `user` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tbladdons`
-- 

CREATE TABLE `tbladdons` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `packages` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `recurring` decimal(10,2) NOT NULL default '0.00',
  `setupfee` decimal(10,2) NOT NULL default '0.00',
  `billingcycle` text NOT NULL,
  `showorder` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tbladminlog`
-- 

CREATE TABLE `tbladminlog` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `adminusername` text NOT NULL,
  `logintime` datetime NOT NULL default '0000-00-00 00:00:00',
  `logouttime` datetime NOT NULL default '0000-00-00 00:00:00',
  `ipaddress` text NOT NULL,
  `sessionid` text NOT NULL,
  `lastvisit` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tbladmins`
-- 

CREATE TABLE `tbladmins` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `username` text NOT NULL,
  `password` varchar(32) NOT NULL default '',
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `userlevel` text NOT NULL,
  `signature` text NOT NULL,
  `notes` text NOT NULL,
  `loginattempts` int(1) NOT NULL,
  `supportdepts` text NOT NULL,
  `ticketnotifications` varchar(2) NOT NULL,
  `ordernotifications` varchar(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblaffiliates`
-- 

CREATE TABLE `tblaffiliates` (
  `id` int(3) unsigned zerofill NOT NULL auto_increment,
  `date` date default NULL,
  `clientid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `visitors` int(1) NOT NULL,
  `paytype` text NOT NULL,
  `payamount` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL default '0.00',
  `withdrawn` decimal(10,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblaffiliatesaccounts`
-- 

CREATE TABLE `tblaffiliatesaccounts` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `affiliateid` text NOT NULL,
  `domain` text NOT NULL,
  `package` text NOT NULL,
  `billingcycle` text NOT NULL,
  `regdate` date default NULL,
  `amount` decimal(10,2) NOT NULL default '0.00',
  `commission` decimal(10,2) NOT NULL,
  `lastpaid` date NOT NULL default '0000-00-00',
  `relid` int(10) unsigned zerofill NOT NULL default '0000000000',
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblaffiliateshistory`
-- 

CREATE TABLE `tblaffiliateshistory` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `affiliateid` int(3) unsigned zerofill NOT NULL,
  `date` date NOT NULL,
  `affaccid` int(1) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblannouncements`
-- 

CREATE TABLE `tblannouncements` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `date` date default NULL,
  `title` text NOT NULL,
  `announcement` text NOT NULL,
  `published` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblbannedemails`
-- 

CREATE TABLE `tblbannedemails` (
  `id` int(1) NOT NULL auto_increment,
  `domain` text NOT NULL,
  `count` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblbannedips`
-- 

CREATE TABLE `tblbannedips` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `ip` text NOT NULL,
  `reason` text NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblbrowserlinks`
-- 

CREATE TABLE `tblbrowserlinks` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `name` text NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblcalendar`
-- 

CREATE TABLE `tblcalendar` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `title` text NOT NULL,
  `desc` text NOT NULL,
  `day` text NOT NULL,
  `month` text NOT NULL,
  `year` text NOT NULL,
  `startt1` text NOT NULL,
  `startt2` text NOT NULL,
  `endt1` text NOT NULL,
  `endt2` text NOT NULL,
  `adminid` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblcancelrequests`
-- 

CREATE TABLE `tblcancelrequests` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `relid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `reason` text NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblclients`
-- 

CREATE TABLE `tblclients` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `companyname` text NOT NULL,
  `email` text NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `postcode` text NOT NULL,
  `country` text NOT NULL,
  `phonenumber` text NOT NULL,
  `password` text NOT NULL,
  `credit` decimal(10,2) NOT NULL,
  `taxexempt` text NOT NULL,
  `datecreated` date NOT NULL,
  `notes` text NOT NULL,
  `cardtype` varchar(255) NOT NULL default '',
  `cardnum` blob NOT NULL,
  `startdate` blob NOT NULL,
  `expdate` blob NOT NULL,
  `issuenumber` blob NOT NULL,
  `lastlogin` datetime default NULL,
  `ip` text NOT NULL,
  `host` text NOT NULL,
  `status` text NOT NULL,
  `language` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblconfiguration`
-- 

CREATE TABLE `tblconfiguration` (
  `setting` text NOT NULL,
  `value` text NOT NULL
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblcredit`
-- 

CREATE TABLE `tblcredit` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `clientid` int(10) unsigned zerofill NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblcustomfields`
-- 

CREATE TABLE `tblcustomfields` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `type` text NOT NULL,
  `relid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `num` text NOT NULL,
  `fieldname` text NOT NULL,
  `fieldtype` text NOT NULL,
  `fieldoptions` text NOT NULL,
  `adminonly` text NOT NULL,
  `required` text NOT NULL,
  `showorder` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblcustomfieldsvalues`
-- 

CREATE TABLE `tblcustomfieldsvalues` (
  `fieldid` int(1) NOT NULL,
  `relid` int(10) unsigned zerofill NOT NULL,
  `value` text NOT NULL
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tbldomainpricing`
-- 

CREATE TABLE `tbldomainpricing` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `extension` text NOT NULL,
  `registrationperiod` int(1) NOT NULL default '0',
  `register` decimal(10,2) NOT NULL default '0.00',
  `transfer` decimal(10,2) NOT NULL,
  `renew` decimal(10,2) NOT NULL,
  `autoreg` text NOT NULL,
  `order` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tbldomains`
-- 

CREATE TABLE `tbldomains` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `userid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `orderid` int(1) NOT NULL,
  `registrationdate` date NOT NULL,
  `domain` text NOT NULL,
  `firstpaymentamount` decimal(10,2) NOT NULL default '0.00',
  `recurringamount` decimal(10,2) NOT NULL,
  `registrar` text NOT NULL,
  `registrationperiod` int(1) NOT NULL default '1',
  `expirydate` date default NULL,
  `subscriptionid` text NOT NULL,
  `status` text NOT NULL,
  `nextduedate` date NOT NULL default '0000-00-00',
  `nextinvoicedate` date NOT NULL,
  `additionalnotes` text NOT NULL,
  `paymentmethod` text NOT NULL,
  `urlforwarding` text NOT NULL,
  `emailforwarding` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tbldomainsadditionalfields`
-- 

CREATE TABLE `tbldomainsadditionalfields` (
  `id` int(1) NOT NULL auto_increment,
  `domainid` int(10) unsigned zerofill NOT NULL,
  `name` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tbldownloadcats`
-- 

CREATE TABLE `tbldownloadcats` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `parentid` int(1) NOT NULL default '0',
  `name` text NOT NULL,
  `description` text NOT NULL,
  `hidden` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tbldownloads`
-- 

CREATE TABLE `tbldownloads` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `type` text NOT NULL,
  `category` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `downloads` int(1) NOT NULL default '0',
  `location` text NOT NULL,
  `clientsonly` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblemails`
-- 

CREATE TABLE `tblemails` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `userid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblemailtemplates`
-- 

CREATE TABLE `tblemailtemplates` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `type` text NOT NULL,
  `name` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `fromname` text NOT NULL,
  `fromemail` text NOT NULL,
  `disabled` text NOT NULL,
  `custom` text NOT NULL,
  `language` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblfraud`
-- 

CREATE TABLE `tblfraud` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `fraud` text NOT NULL,
  `setting` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblgatewaylog`
-- 

CREATE TABLE `tblgatewaylog` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `gateway` text NOT NULL,
  `data` text NOT NULL,
  `result` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblhosting`
-- 

CREATE TABLE `tblhosting` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `userid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `orderid` int(1) NOT NULL,
  `regdate` date NOT NULL,
  `domain` text NOT NULL,
  `server` text NOT NULL,
  `paymentmethod` text NOT NULL,
  `firstpaymentamount` decimal(10,2) NOT NULL default '0.00',
  `amount` decimal(10,2) NOT NULL default '0.00',
  `billingcycle` text NOT NULL,
  `nextduedate` date default NULL,
  `nextinvoicedate` date NOT NULL,
  `domainstatus` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `notes` text NOT NULL,
  `subscriptionid` text NOT NULL,
  `packageid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `overideautosuspend` text NOT NULL,
  `dedicatedip` text NOT NULL,
  `assignedips` text NOT NULL,
  `rootpassword` text NOT NULL,
  `ns1` text NOT NULL,
  `ns2` text NOT NULL,
  `diskusage` int(10) NOT NULL default '0',
  `disklimit` int(10) NOT NULL default '0',
  `bwusage` int(10) NOT NULL default '0',
  `bwlimit` int(10) NOT NULL default '0',
  `lastupdate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblhostingaddons`
-- 

CREATE TABLE `tblhostingaddons` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `orderid` int(1) NOT NULL,
  `hostingid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `name` text NOT NULL,
  `setupfee` decimal(10,2) NOT NULL default '0.00',
  `recurring` decimal(10,2) NOT NULL default '0.00',
  `billingcycle` text NOT NULL,
  `status` text NOT NULL,
  `regdate` date NOT NULL default '0000-00-00',
  `nextduedate` date default NULL,
  `nextinvoicedate` date NOT NULL,
  `paymentmethod` text NOT NULL,
  `subscriptionid` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblhostingconfigoptions`
-- 

CREATE TABLE `tblhostingconfigoptions` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `relid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `configid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `optionid` int(10) unsigned zerofill NOT NULL default '0000000000',
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblinvoiceitems`
-- 

CREATE TABLE `tblinvoiceitems` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `invoiceid` text NOT NULL,
  `userid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `type` text NOT NULL,
  `relid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `description` text NOT NULL,
  `amount` decimal(10,2) NOT NULL default '0.00',
  `taxed` int(1) NOT NULL,
  `duedate` date default NULL,
  `paymentmethod` text NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblinvoices`
-- 

CREATE TABLE `tblinvoices` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `date` date default NULL,
  `duedate` date default NULL,
  `datepaid` datetime NOT NULL default '0000-00-00 00:00:00',
  `userid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `subtotal` decimal(10,2) NOT NULL,
  `credit` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL default '0.00',
  `taxrate` decimal(10,2) NOT NULL,
  `status` text NOT NULL,
  `randomstring` text NOT NULL,
  `paymentmethod` text NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblknowledgebase`
-- 

CREATE TABLE `tblknowledgebase` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `category` text NOT NULL,
  `title` text NOT NULL,
  `article` text NOT NULL,
  `views` int(1) NOT NULL default '0',
  `useful` int(1) NOT NULL default '0',
  `votes` int(1) NOT NULL default '0',
  `private` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblknowledgebasecats`
-- 

CREATE TABLE `tblknowledgebasecats` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `parentid` int(1) NOT NULL default '0',
  `name` text NOT NULL,
  `description` text NOT NULL,
  `hidden` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblorders`
-- 

CREATE TABLE `tblorders` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `ordernum` bigint(10) NOT NULL,
  `userid` int(10) unsigned zerofill NOT NULL,
  `date` datetime NOT NULL,
  `hostingid` int(1) NOT NULL,
  `domainids` text NOT NULL,
  `addonids` text NOT NULL,
  `upgradeids` text NOT NULL,
  `domaintype` text NOT NULL,
  `nameservers` text NOT NULL,
  `transfersecret` text NOT NULL,
  `promocode` text NOT NULL,
  `promotype` text NOT NULL,
  `promovalue` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paymentmethod` text NOT NULL,
  `invoiceid` int(1) NOT NULL,
  `status` text NOT NULL,
  `ipaddress` text NOT NULL,
  `fraudmodule` text NOT NULL,
  `fraudoutput` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblpaymentgateways`
-- 

CREATE TABLE `tblpaymentgateways` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `gateway` text NOT NULL,
  `type` text NOT NULL,
  `setting` text NOT NULL,
  `value` text NOT NULL,
  `name` text NOT NULL,
  `size` int(1) NOT NULL default '0',
  `notes` text NOT NULL,
  `description` text NOT NULL,
  `order` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblproductconfigoptions`
-- 

CREATE TABLE `tblproductconfigoptions` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `productid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `optionname` text NOT NULL,
  `optiontype` text NOT NULL,
  `order` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblproductconfigoptionssub`
-- 

CREATE TABLE `tblproductconfigoptionssub` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `configid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `optionname` text NOT NULL,
  `price` decimal(10,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblproductgroups`
-- 

CREATE TABLE `tblproductgroups` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `name` text NOT NULL,
  `disabledgateways` text NOT NULL,
  `hidden` text NOT NULL,
  `order` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblproducts`
-- 

CREATE TABLE `tblproducts` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `type` text NOT NULL,
  `gid` int(10) NOT NULL default '0',
  `name` text NOT NULL,
  `description` text NOT NULL,
  `hidden` text NOT NULL,
  `showdomainoptions` text NOT NULL,
  `welcomeemail` int(1) NOT NULL default '0',
  `stockcontrol` text NOT NULL,
  `qty` int(1) NOT NULL,
  `proratabilling` text NOT NULL,
  `proratadate` int(2) NOT NULL,
  `proratachargenextmonth` int(2) NOT NULL,
  `paytype` text NOT NULL,
  `msetupfee` decimal(10,2) NOT NULL default '0.00',
  `qsetupfee` decimal(10,2) NOT NULL default '0.00',
  `ssetupfee` decimal(10,2) NOT NULL default '0.00',
  `asetupfee` decimal(10,2) NOT NULL default '0.00',
  `bsetupfee` decimal(10,2) NOT NULL,
  `monthly` decimal(10,2) NOT NULL default '0.00',
  `quarterly` decimal(10,2) NOT NULL default '0.00',
  `semiannual` decimal(10,2) NOT NULL default '0.00',
  `annual` decimal(10,2) NOT NULL default '0.00',
  `biennial` decimal(10,2) NOT NULL,
  `subdomain` text NOT NULL,
  `autosetup` text NOT NULL,
  `servertype` text NOT NULL,
  `defaultserver` int(1) NOT NULL default '0',
  `configoption1` text NOT NULL,
  `configoption2` text NOT NULL,
  `configoption3` text NOT NULL,
  `configoption4` text NOT NULL,
  `configoption5` text NOT NULL,
  `configoption6` text NOT NULL,
  `configoption7` text NOT NULL,
  `configoption8` text NOT NULL,
  `configoption9` text NOT NULL,
  `configoption10` text NOT NULL,
  `configoption11` text NOT NULL,
  `configoption12` text NOT NULL,
  `configoption13` text NOT NULL,
  `configoption14` text NOT NULL,
  `configoption15` text NOT NULL,
  `configoption16` text NOT NULL,
  `configoption17` text NOT NULL,
  `configoption18` text NOT NULL,
  `configoption19` text NOT NULL,
  `configoption20` text NOT NULL,
  `configoption21` text NOT NULL,
  `configoption22` text NOT NULL,
  `configoption23` text NOT NULL,
  `configoption24` text NOT NULL,
  `freedomain` text NOT NULL,
  `freedomainpaymentterms` text NOT NULL,
  `freedomaintlds` text NOT NULL,
  `upgradepackages` text NOT NULL,
  `configoptionsupgrade` text NOT NULL,
  `billingcycleupgrade` text NOT NULL,
  `tax` int(1) NOT NULL,
  `affiliateonetime` text NOT NULL,
  `affiliatepaytype` text NOT NULL,
  `affiliatepayamount` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblpromotions`
-- 

CREATE TABLE `tblpromotions` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `item` text NOT NULL,
  `type` text NOT NULL,
  `code` text NOT NULL,
  `discount` text NOT NULL,
  `value` decimal(10,2) NOT NULL default '0.00',
  `expirationdate` date default NULL,
  `packages` text NOT NULL,
  `addons` text NOT NULL,
  `maxuses` int(1) NOT NULL default '0',
  `uses` int(1) NOT NULL default '0',
  `appliesto` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblregistrars`
-- 

CREATE TABLE `tblregistrars` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `registrar` text NOT NULL,
  `setting` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblreselleraccountsetup`
-- 

CREATE TABLE `tblreselleraccountsetup` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `packageid` text NOT NULL,
  `resnumlimit` text NOT NULL,
  `resnumlimitamt` text NOT NULL,
  `rsnumlimitenabled` text NOT NULL,
  `reslimit` text NOT NULL,
  `resreslimit` text NOT NULL,
  `rslimit-disk` text NOT NULL,
  `rsolimit-disk` text NOT NULL,
  `rslimit-bw` text NOT NULL,
  `rsolimit-bw` text NOT NULL,
  `acl-list-accts` text NOT NULL,
  `acl-show-bandwidth` text NOT NULL,
  `acl-create-acct` text NOT NULL,
  `acl-edit-account` text NOT NULL,
  `acl-suspend-acct` text NOT NULL,
  `acl-kill-acct` text NOT NULL,
  `acl-upgrade-account` text NOT NULL,
  `acl-limit-bandwidth` text NOT NULL,
  `acl-edit-mx` text NOT NULL,
  `acl-frontpage` text NOT NULL,
  `acl-mod-subdomains` text NOT NULL,
  `acl-passwd` text NOT NULL,
  `acl-quota` text NOT NULL,
  `acl-res-cart` text NOT NULL,
  `acl-ssl-gencrt` text NOT NULL,
  `acl-ssl` text NOT NULL,
  `acl-demo-setup` text NOT NULL,
  `acl-rearrange-accts` text NOT NULL,
  `acl-clustering` text NOT NULL,
  `acl-create-dns` text NOT NULL,
  `acl-edit-dns` text NOT NULL,
  `acl-park-dns` text NOT NULL,
  `acl-kill-dns` text NOT NULL,
  `acl-add-pkg` text NOT NULL,
  `acl-edit-pkg` text NOT NULL,
  `acl-add-pkg-shell` text NOT NULL,
  `acl-allow-unlimited-disk-pkgs` text NOT NULL,
  `acl-allow-unlimited-pkgs` text NOT NULL,
  `acl-add-pkg-ip` text NOT NULL,
  `acl-allow-addoncreate` text NOT NULL,
  `acl-allow-parkedcreate` text NOT NULL,
  `acl-onlyselfandglobalpkgs` text NOT NULL,
  `acl-disallow-shell` text NOT NULL,
  `acl-all` text NOT NULL,
  `acl-stats` text NOT NULL,
  `acl-status` text NOT NULL,
  `acl-restart` text NOT NULL,
  `acl-mailcheck` text NOT NULL,
  `acl-resftp` text NOT NULL,
  `acl-news` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblservers`
-- 

CREATE TABLE `tblservers` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `name` text NOT NULL,
  `ipaddress` text NOT NULL,
  `monthlycost` decimal(10,2) NOT NULL default '0.00',
  `noc` text NOT NULL,
  `statusaddress` text NOT NULL,
  `primarynameserver` text NOT NULL,
  `primarynameserverip` text NOT NULL,
  `secondarynameserver` text NOT NULL,
  `secondarynameserverip` text NOT NULL,
  `maxaccounts` int(1) NOT NULL default '0',
  `type` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `secure` text NOT NULL,
  `active` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tbltax`
-- 

CREATE TABLE `tbltax` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `name` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `taxrate` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblticketbreaklines`
-- 

CREATE TABLE `tblticketbreaklines` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `breakline` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblticketdepartments`
-- 

CREATE TABLE `tblticketdepartments` (
  `id` int(3) unsigned zerofill NOT NULL auto_increment,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `email` text NOT NULL,
  `hidden` text NOT NULL,
  `order` int(1) NOT NULL,
  `host` text NOT NULL,
  `port` text NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblticketlog`
-- 

CREATE TABLE `tblticketlog` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `date` datetime NOT NULL,
  `tid` int(10) unsigned zerofill NOT NULL,
  `action` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblticketmaillog`
-- 

CREATE TABLE `tblticketmaillog` (
  `id` int(1) NOT NULL auto_increment,
  `date` datetime NOT NULL,
  `to` text NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblticketnotes`
-- 

CREATE TABLE `tblticketnotes` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `admin` text NOT NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `message` text NOT NULL,
  `ticketid` int(10) unsigned zerofill NOT NULL default '0000000000',
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblticketpredefinedcats`
-- 

CREATE TABLE `tblticketpredefinedcats` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `parentid` int(1) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblticketpredefinedreplies`
-- 

CREATE TABLE `tblticketpredefinedreplies` (
  `id` int(1) unsigned zerofill NOT NULL auto_increment,
  `catid` text NOT NULL,
  `name` text NOT NULL,
  `reply` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblticketreplies`
-- 

CREATE TABLE `tblticketreplies` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `tid` int(10) unsigned zerofill NOT NULL,
  `userid` int(10) unsigned zerofill NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `date` datetime NOT NULL,
  `message` text NOT NULL,
  `admin` text NOT NULL,
  `attachment` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tbltickets`
-- 

CREATE TABLE `tbltickets` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `tid` int(6) NOT NULL default '0',
  `did` int(3) unsigned zerofill NOT NULL default '000',
  `userid` int(10) unsigned zerofill NOT NULL default '0000000000',
  `name` text NOT NULL,
  `email` text NOT NULL,
  `c` text NOT NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `title` text NOT NULL,
  `message` text NOT NULL,
  `status` text NOT NULL,
  `urgency` text NOT NULL,
  `admin` text NOT NULL,
  `attachment` text NOT NULL,
  `lastreply` datetime NOT NULL,
  `flag` int(1) NOT NULL,
  `clientunread` int(1) NOT NULL,
  `adminunread` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblticketspamfilters`
-- 

CREATE TABLE `tblticketspamfilters` (
  `id` int(1) NOT NULL auto_increment,
  `type` enum('sender','subject','phrase') NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tbltodolist`
-- 

CREATE TABLE `tbltodolist` (
  `id` int(1) NOT NULL auto_increment,
  `date` date NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `admin` int(1) NOT NULL,
  `status` text NOT NULL,
  `duedate` date NOT NULL,
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblupgrades`
-- 

CREATE TABLE `tblupgrades` (
  `id` int(1) NOT NULL auto_increment,
  `type` text NOT NULL,
  `date` date NOT NULL,
  `relid` int(10) NOT NULL,
  `originalvalue` text NOT NULL,
  `newvalue` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `recurringchange` decimal(10,2) NOT NULL,
  `status` enum('Pending','Completed') NOT NULL default 'Pending',
  `paid` enum('Y','N') NOT NULL default 'N',
  PRIMARY KEY  (`id`)
) ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tblwhoislog`
-- 

CREATE TABLE `tblwhoislog` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment,
  `date` datetime NOT NULL,
  `domain` text NOT NULL,
  `ip` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;
INSERT INTO `tblconfiguration` VALUES ('Language', 'English');
INSERT INTO `tblconfiguration` VALUES ('CompanyName', 'Company Name');
INSERT INTO `tblconfiguration` VALUES ('Email', 'changeme@changeme.com');
INSERT INTO `tblconfiguration` VALUES ('Domain', 'http://www.yourdomain.com/');
INSERT INTO `tblconfiguration` VALUES ('LogoURL', '');
INSERT INTO `tblconfiguration` VALUES ('SystemURL', 'http://www.yourdomain.com/whmcs/');
INSERT INTO `tblconfiguration` VALUES ('SystemSSLURL', '');
INSERT INTO `tblconfiguration` VALUES ('Currency', 'USD');
INSERT INTO `tblconfiguration` VALUES ('CurrencySymbol', '$');
INSERT INTO `tblconfiguration` VALUES ('AutoSuspension', 'on');
INSERT INTO `tblconfiguration` VALUES ('AutoSuspensionDays', '5');
INSERT INTO `tblconfiguration` VALUES ('CreateInvoiceDaysBefore', '14');
INSERT INTO `tblconfiguration` VALUES ('AffiliateEnabled', '');
INSERT INTO `tblconfiguration` VALUES ('AffiliateEarningPercent', '0');
INSERT INTO `tblconfiguration` VALUES ('AffiliateBonusDeposit', '0.00');
INSERT INTO `tblconfiguration` VALUES ('AffiliatePayout', '0.00');
INSERT INTO `tblconfiguration` VALUES ('AffiliateLinks', '');
INSERT INTO `tblconfiguration` VALUES ('ActivityLimit', '1000');
INSERT INTO `tblconfiguration` VALUES ('DateFormat', 'DD/MM/YYYY');
INSERT INTO `tblconfiguration` VALUES ('PreSalesQuestions', 'on');
INSERT INTO `tblconfiguration` VALUES ('Template', 'portal');
INSERT INTO `tblconfiguration` VALUES ('AllowRegister', 'on');
INSERT INTO `tblconfiguration` VALUES ('AllowTransfer', 'on');
INSERT INTO `tblconfiguration` VALUES ('AllowOwnDomain', 'on');
INSERT INTO `tblconfiguration` VALUES ('EnableTOSAccept', '');
INSERT INTO `tblconfiguration` VALUES ('TermsOfService', '');
INSERT INTO `tblconfiguration` VALUES ('AllowLanguageChange', 'on');
INSERT INTO `tblconfiguration` VALUES ('Version', '');
INSERT INTO `tblconfiguration` VALUES ('AllowCustomerChangeInvoiceGateway', 'on');
INSERT INTO `tblconfiguration` VALUES ('DefaultNameserver1', 'ns1.yourdomain.com');
INSERT INTO `tblconfiguration` VALUES ('DefaultNameserver2', 'ns2.yourdomain.com');
INSERT INTO `tblconfiguration` VALUES ('SendInvoiceReminderDays', '7');
INSERT INTO `tblconfiguration` VALUES ('SendReminder', 'on');
INSERT INTO `tblconfiguration` VALUES ('NumRecordstoDisplay', '50');
INSERT INTO `tblconfiguration` VALUES ('BCCMessages', '');
INSERT INTO `tblconfiguration` VALUES ('MailType', 'mail');
INSERT INTO `tblconfiguration` VALUES ('SMTPHost', '');
INSERT INTO `tblconfiguration` VALUES ('SMTPUsername', '');
INSERT INTO `tblconfiguration` VALUES ('SMTPPassword', '');
INSERT INTO `tblconfiguration` VALUES ('SMTPPort', '25');
INSERT INTO `tblconfiguration` VALUES ('ShowCancellationButton', 'on');
INSERT INTO `tblconfiguration` VALUES ('UpdateStatsAuto', 'on');
INSERT INTO `tblconfiguration` VALUES ('InvoicePayTo', 'Address goes here...');
INSERT INTO `tblconfiguration` VALUES ('SendAffiliateReportMonthly', 'on');
INSERT INTO `tblconfiguration` VALUES ('InvalidLoginBanLength', '15');
INSERT INTO `tblconfiguration` VALUES ('Signature', 'Signature goes here...');
INSERT INTO `tblconfiguration` VALUES ('DomainOnlyOrderEnabled', 'on');
INSERT INTO `tblconfiguration` VALUES ('TicketBannedAddresses', '');
INSERT INTO `tblconfiguration` VALUES ('SendEmailNotificationonUserDetailsChange', 'on');
INSERT INTO `tblconfiguration` VALUES ('TicketAllowedFileTypes', '.jpg,.gif,.jpeg,.png');
INSERT INTO `tblconfiguration` VALUES ('CloseInactiveTickets', '0');
INSERT INTO `tblconfiguration` VALUES ('InvoiceLateFeeAmount', '10.00');
INSERT INTO `tblconfiguration` VALUES ('AutoTermination', '');
INSERT INTO `tblconfiguration` VALUES ('AutoTerminationDays', '30');
INSERT INTO `tblconfiguration` VALUES ('RegistrarAdminFirstName', '');
INSERT INTO `tblconfiguration` VALUES ('RegistrarAdminLastName', '');
INSERT INTO `tblconfiguration` VALUES ('RegistrarAdminCompanyName', '');
INSERT INTO `tblconfiguration` VALUES ('RegistrarAdminAddress1', '');
INSERT INTO `tblconfiguration` VALUES ('RegistrarAdminAddress2', '');
INSERT INTO `tblconfiguration` VALUES ('RegistrarAdminCity', '');
INSERT INTO `tblconfiguration` VALUES ('RegistrarAdminStateProvince', '');
INSERT INTO `tblconfiguration` VALUES ('RegistrarAdminCountry', 'US');
INSERT INTO `tblconfiguration` VALUES ('RegistrarAdminPostalCode', '');
INSERT INTO `tblconfiguration` VALUES ('RegistrarAdminPhone', '');
INSERT INTO `tblconfiguration` VALUES ('RegistrarAdminFax', '');
INSERT INTO `tblconfiguration` VALUES ('RegistrarAdminEmailAddress', '');
INSERT INTO `tblconfiguration` VALUES ('RegistrarAdminUseClientDetails', 'on');
INSERT INTO `tblconfiguration` VALUES ('Charset', 'utf-8');
INSERT INTO `tblconfiguration` VALUES ('AutoUnsuspend', 'on');
INSERT INTO `tblconfiguration` VALUES ('RunScriptonCheckOut', '');
INSERT INTO `tblconfiguration` VALUES ('License', '');
INSERT INTO `tblconfiguration` VALUES ('OrderFormTemplate', 'web20cart');
INSERT INTO `tblconfiguration` VALUES ('AllowDomainsTwice', 'on');
INSERT INTO `tblconfiguration` VALUES ('AddLateFeeDays', '5');
INSERT INTO `tblconfiguration` VALUES ('TaxEnabled', '');
INSERT INTO `tblconfiguration` VALUES ('DefaultCountry', 'US');
INSERT INTO `tblconfiguration` VALUES ('AllowTicketsRegisteredClientsOnly', '');
INSERT INTO `tblconfiguration` VALUES ('AutoRedirectoInvoice', 'on');
INSERT INTO `tblconfiguration` VALUES ('EnablePDFInvoices', 'on');
INSERT INTO `tblconfiguration` VALUES ('DisableCapatcha', '');
INSERT INTO `tblconfiguration` VALUES ('SupportTicketOrder', 'ASC');
INSERT INTO `tblconfiguration` VALUES ('SendOverdueInvoiceReminders', '1');
INSERT INTO `tblconfiguration` VALUES ('TaxType', 'Exclusive');
INSERT INTO `tblconfiguration` VALUES ('InvoiceSubscriptionPayments', 'on');
INSERT INTO `tblconfiguration` VALUES ('DomainURLForwarding', '5.00');
INSERT INTO `tblconfiguration` VALUES ('DomainEmailForwarding', '5.00');
INSERT INTO `tblconfiguration` VALUES ('InvoiceIncrement', '1');
INSERT INTO `tblconfiguration` VALUES ('ContinuousInvoiceGeneration', '');
INSERT INTO `tblconfiguration` VALUES ('AutoCancellationRequests', 'on');
INSERT INTO `tblconfiguration` VALUES ('SystemEmailsFromName', 'WHMCompleteSolution');
INSERT INTO `tblconfiguration` VALUES ('SystemEmailsFromEmail', 'noreply@yourdomain.com');
INSERT INTO `tblconfiguration` VALUES ('AllowClientRegister', 'on');
INSERT INTO `tblconfiguration` VALUES ('BulkCheckTLDs', '.com,.net');
INSERT INTO `tblconfiguration` VALUES ('OrderDaysGrace', '0');
INSERT INTO `tblconfiguration` VALUES ('CreditOnDowngrade', 'on');
INSERT INTO `tblconfiguration` VALUES ('AcceptedCardTypes', 'Visa,MasterCard,Discover,American Express,JCB,EnRoute,Diners Club');
INSERT INTO `tblconfiguration` VALUES ('TaxDomains', 'on');
INSERT INTO `tblconfiguration` VALUES ('TaxLateFee', 'on');

INSERT INTO `tblticketbreaklines` VALUES (1, '> -----Original Message-----');
INSERT INTO `tblticketbreaklines` VALUES (2, '----- Original Message -----');
INSERT INTO `tblticketbreaklines` VALUES (3, '-----Original Message-----');
INSERT INTO `tblticketbreaklines` VALUES (4, '<!-- Break Line -->');
INSERT INTO `tblticketbreaklines` VALUES (5, '====== Please reply above this line ======');
INSERT INTO `tblticketbreaklines` VALUES (6, '_____');
UPDATE `tblconfiguration` SET `value` = '3.2.0' WHERE `setting`= 'Version';