/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : test3

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2014-11-10 11:38:55
*/

CREATE TABLE `event_session` (
	`session_id`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
	`session_expire`  int(11) NOT NULL ,
	`session_data`  blob NULL DEFAULT NULL ,
	UNIQUE INDEX `session_id` (`session_id`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
ROW_FORMAT=COMPACT
;

