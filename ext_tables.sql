#
# Table structure for table 'tx_devnullrobots_crawlercfg'
#
CREATE TABLE tx_devnullrobots_crawlercfg (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	useragent varchar(30) DEFAULT '' NOT NULL,
	crawlercfg text,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'sys_domain'
#
CREATE TABLE sys_domain (
	tx_devnullrobots_crawler text,
	tx_devnullrobots_default text,
    tx_devnullrobots_sitemap tinyint(3) DEFAULT '0' NOT NULL
);

#
# Table structure for table 'pages'
#
CREATE TABLE pages (
    tx_devnullrobots_flags int(11) DEFAULT '0' NOT NULL
);