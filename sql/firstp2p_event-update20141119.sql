/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : test3

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2014-11-19 11:38:55
*/

-- ----------------------------
-- Records of event_authority
-- ----------------------------

CREATE TABLE `event_authority` (
  `id` int(10) NOT NULL COMMENT '主键',
  `role` int(10) NOT NULL COMMENT '角色',
  `right` varchar(200) NOT NULL COMMENT '权限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户权限设置表';

-- ----------------------------
-- Records of event_news
-- ----------------------------

CREATE TABLE `event_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `title` varchar(500) NOT NULL COMMENT '标题',
  `video_url` varchar(200) NOT NULL COMMENT '视频地址',
  `create_user` int(10) unsigned NOT NULL COMMENT '创建者ID',
  `create_date` int(10) NOT NULL COMMENT '增加时间',
  `update_date` int(10) NOT NULL COMMENT '修改时间',
  `alias` varchar(200) DEFAULT NULL COMMENT '别名',
  `category_id` int(10) NOT NULL COMMENT '所属分类',
  `publish_type` int(10) NOT NULL DEFAULT '1' COMMENT '1为草稿,2为发布',
  `page_view` int(10) NOT NULL DEFAULT '0' COMMENT '页面浏览量',
  `show_home_page` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示在首页1为不显示，2为显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_news_category
-- ----------------------------

CREATE TABLE `event_news_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `lft` int(10) unsigned NOT NULL COMMENT '左边结点',
  `rgt` int(10) unsigned NOT NULL COMMENT '右边结点',
  `lvl` int(10) unsigned NOT NULL COMMENT '分类级别',
  `pid` int(10) unsigned NOT NULL COMMENT '父级ID',
  `pos` int(10) unsigned NOT NULL COMMENT '在同级分类中所属位置',
  `category_name` varchar(200) NOT NULL COMMENT '分类名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='News分类表';

INSERT INTO event_news_category VALUES ('1', '1', '2', '0', '0', '0', '编辑分类');
-- ----------------------------
-- Records of event_news_content
-- ----------------------------

CREATE TABLE `event_news_content` (
  `id` int(10) NOT NULL COMMENT 'ID',
  `content` text NOT NULL COMMENT '新闻内容',
  `excerpt` text COMMENT '摘要'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='News内容';





