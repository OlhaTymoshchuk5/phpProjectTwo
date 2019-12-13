/*DROP DATABASE if exists contacts;
CREATE DATABASE if not exists `contacts` CHARACTER SET utf8;

GRANT ALL PRIVILEGES ON `contacts`.* TO 'lamp1user'@'localhost';*/

USE contacts;

drop table if exists contact_note;
drop table if exists contact_web;
drop table if exists contact_email;
drop table if exists contact_phone;
drop table if exists contact_address;
drop table if exists contact;

CREATE TABLE if not exists contact (
  ct_id int(11) NOT NULL AUTO_INCREMENT,
  ct_type char(10) NOT NULL,
  ct_first_name varchar(100) DEFAULT NULL,
  ct_last_name varchar(100) DEFAULT NULL,
  ct_disp_name varchar(200) DEFAULT NULL,
  ct_created datetime default current_timestamp,
  ct_modified datetime default current_timestamp on update current_timestamp,
  ct_deleted char(1),
  PRIMARY KEY (`ct_id`),
  KEY `first_last` (`ct_first_name`,`ct_last_name`),
  KEY `last_first` (`ct_last_name`,`ct_first_name`),
  KEY `display_name` (`ct_disp_name`),
  KEY `type` (`ct_type`)
);

create table if not exists contact_address (
	ad_id int(11) not null auto_increment,
	ad_ct_id int(11) not null,
	ad_type char(10) not null,
	ad_line_1 varchar(100),
	ad_line_2 varchar(100),
	ad_line_3 varchar(100),
	ad_city	varchar(50),
	ad_province varchar(50),
	ad_post_code varchar(15),
	ad_country varchar(50),
	ad_active char(1),
	ad_created datetime default current_timestamp,
	ad_modified datetime default current_timestamp on update current_timestamp,
	primary key (ad_id),
	key `contact_id` (ad_ct_id),
	key `country_province_city` (`ad_country`, `ad_province`, `ad_city`),
	foreign key (ad_ct_id) references contact(ct_id)
);

create table if not exists contact_phone(
	ph_id int(11) not null auto_increment,
	ph_ct_id int(11) not null,
	ph_type char(10) not null,
	ph_number varchar(50),
	ph_active char(1),
	ph_created datetime default current_timestamp,
	ph_modified datetime default current_timestamp on update current_timestamp,
	primary key (ph_id),
	key `contact_id` (ph_ct_id),
	foreign key (ph_ct_id) references contact(ct_id)
);

create table if not exists contact_email(
	em_id int(11) not null auto_increment,
	em_ct_id int(11) not null,
	em_type char(10) not null,
	em_email varchar(255),
	em_active char(1),
	em_created datetime default current_timestamp,
	em_modified datetime default current_timestamp on update current_timestamp,
	primary key (em_id),
	key `contact_id` (em_ct_id),
	foreign key (em_ct_id) references contact(ct_id)
);

create table if not exists contact_web(
	we_id int(11) not null auto_increment,
	we_ct_id int(11) not null,
	we_type char(10) not null,
	we_url varchar(255),
	we_active char(1),
	we_created datetime default current_timestamp,
	we_modified datetime default current_timestamp on update current_timestamp,
	primary key (we_id),
	key `contact_id` (we_ct_id),
	foreign key (we_ct_id) references contact(ct_id)
);
	
create table if not exists contact_note(
	no_id int(11) not null auto_increment,
	no_ct_id int(11) not null,
	no_type char(10) not null,
	no_note text,
	no_created datetime default current_timestamp,
	no_modified datetime default current_timestamp on update current_timestamp,
	primary key (no_id),
	key `contact_id` (no_ct_id),
	foreign key (no_ct_id) references contact(ct_id)
);
