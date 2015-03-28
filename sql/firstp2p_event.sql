/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : test3

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2014-11-05 18:04:55
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `event_activity`
-- ----------------------------
DROP TABLE IF EXISTS `event_activity`;
CREATE TABLE `event_activity` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(200) NOT NULL COMMENT '文件或目录名称',
  `content` longtext,
  `create_user_id` int(10) NOT NULL,
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '修改时间',
  `publish_type` tinyint(1) DEFAULT '1' COMMENT '3为删除,1为草稿,2为发布',
  `publish_domain` varchar(255) DEFAULT NULL COMMENT '发布到的域名',
  `category_id` int(11) NOT NULL DEFAULT '1' COMMENT '文章分类',
  `group` varchar(200) NOT NULL DEFAULT '1' COMMENT '所属分组',
  `alias` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_activity
-- ----------------------------
INSERT INTO event_activity VALUES ('1', '邀请好友', '&lt;style&gt;*{margin:0; padding:0;}\r\nbody{background:#34424f;}\r\n.wrap{width:1100px; margin:0 auto;}\r\nimg{display:block; border:0;}\r\n.line{height:89px; overflow:hidden;}\r\n.share_box{background:url(//assets6.ncfstatic.com/v1/images/topic/invite-money/img_10.jpg?v=201410232021) no-repeat; height:328px; overflow:hidden;}\r\n.share_content{width:230px; height:134px; margin:66px auto 0; position:relative;}\r\n#share_text{width:825px; margin:0 auto; font:17px/24px &quot;Microsoft YaHei&quot;; color:#58554e;}\r\n#share_text span{color:#fc0000;}\r\n.share_box .cover{position:absolute; left:-36px; top:0px; width:302px; height:55px; background:url(//assets6.ncfstatic.com/v1/images/topic/invite-money/anniu.png?v=201410232021) no-repeat;}\r\n#jiathis_weixin_share img{display:inline-block;}\r\n.jiathis_modal_footer{display:none;}\r\n#jiathis_weixin_modal{height:310px !important;}&lt;/style&gt;&lt;div class=&quot;wrap&quot;&gt;&lt;div&gt;&lt;img src=&quot;//assets9.ncfstatic.com/v1/images/topic/invite-money/img_01_wx.jpg?v=201410232021&quot;/&gt;&lt;/div&gt;&lt;div&gt;&lt;img src=&quot;//assets3.ncfstatic.com/v1/images/topic/invite-money/img_02.jpg?v=201410232021&quot;/&gt;&lt;/div&gt;&lt;div class=&quot;line&quot;&gt;&lt;div style=&quot;float:left; width:434px;&quot;&gt;&lt;img src=&quot;//assets9.ncfstatic.com/v1/images/topic/invite-money/img_03.jpg?v=201410232021&quot;/&gt;&lt;/div&gt;&lt;div style=&quot;float:left; width:281px;&quot;&gt;&lt;a href=&quot;http://www.firstp2p.com/user/login?backurl=account/coupon&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;//assets9.ncfstatic.com/v1/images/topic/invite-money/img_04.jpg?v=201410232021&quot;/&gt;&lt;/a&gt;&lt;/div&gt;&lt;div style=&quot;float:left; width:385px;&quot;&gt;&lt;img src=&quot;//assets6.ncfstatic.com/v1/images/topic/invite-money/img_05.jpg?v=201410232021&quot;/&gt;&lt;/div&gt;&lt;/div&gt;&lt;div&gt;&lt;img src=&quot;//assets7.ncfstatic.com/v1/images/topic/invite-money/img_06_2_wx.jpg?v=201410232021&quot;/&gt;&lt;/div&gt;&lt;div&gt;&lt;img src=&quot;//assets3.ncfstatic.com/v1/images/topic/invite-money/img_07_wx.jpg?v=201410232021&quot;/&gt;&lt;/div&gt;&lt;div&gt;&lt;img src=&quot;//assets1.ncfstatic.com/v1/images/topic/invite-money/img_08.jpg?v=201410232021&quot;/&gt;&lt;/div&gt;&lt;div&gt;&lt;img src=&quot;//assets7.ncfstatic.com/v1/images/topic/invite-money/img_09_wx.jpg?v=201410232021&quot;/&gt;&lt;/div&gt;&lt;div class=&quot;share_box&quot;&gt;&lt;user_login_hide&gt;&lt;div class=&quot;share_content&quot;&gt;&lt;a class=&quot;cover&quot; href=&quot;http://www.firstp2p.com/user/login?backurl=http://lc.event.firstp2p.com/html/30&quot; target=&quot;_blank&quot;&gt;&lt;/a&gt;&lt;/div&gt;&lt;/user_login_hide&gt;&lt;user_login_show&gt;&lt;div class=&quot;share_content&quot;&gt;{{username}}你的优惠码是{{coupon}}\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;!-- JiaThis Button BEGIN --&gt;&lt;div class=&quot;jiathis_style_32x32&quot;&gt;&lt;a class=&quot;jiathis_button_qzone&quot;&gt;&lt;/a&gt;&lt;a class=&quot;jiathis_button_tsina&quot;&gt;&lt;/a&gt;&lt;a class=&quot;jiathis_button_tqq&quot;&gt;&lt;/a&gt;&lt;a class=&quot;jiathis_button_renren&quot;&gt;&lt;/a&gt;&lt;a class=&quot;jiathis_button_weixin&quot;&gt;&lt;/a&gt;&lt;a href=&quot;http://www.jiathis.com/share&quot; class=&quot;jiathis jiathis_txt jiathis_separator jtico jtico_jiathis&quot; target=&quot;_blank&quot;&gt;&lt;/a&gt;&lt;/div&gt;&lt;/div&gt;&lt;/user_login_show&gt;&lt;div id=&quot;share_text&quot;&gt;【亲，有钱一起赚吧】我在网信理财（www.firstp2p.com）投资啦，他们是央行互联网金融专业委员会首批成员。产品收益高、期限短、本息担保。现在用我的“邀请码” &amp;nbsp;，注册后投资“新立赢”，四天后，你我各赚20元。咱们关系这么铁，当然有钱一起赚啦！&lt;/div&gt;&lt;/div&gt;&lt;div&gt;&lt;img src=&quot;//assets9.ncfstatic.com/v1/images/topic/invite-money/img_11_wx.jpg?v=201410232021&quot;/&gt;&lt;/div&gt;&lt;div&gt;&lt;img src=&quot;//assets1.ncfstatic.com/v1/images/topic/invite-money/img_12_wx.jpg?v=201410232021&quot;/&gt;&lt;/div&gt;&lt;div&gt;&lt;img src=&quot;//assets9.ncfstatic.com/v1/images/topic/invite-money/img_14_wx.jpg?v=201410232021&quot;/&gt;&lt;/div&gt;&lt;div&gt;&lt;img src=&quot;//assets4.ncfstatic.com/v1/images/topic/invite-money/img_15_wx.jpg?v=201410232021&quot;/&gt;&lt;/div&gt;&lt;/div&gt;&lt;script&gt;function jsonpHandler(){\r\n	var head = document.getElementsByTagName(\'head\')[0];\r\n	var script = document.createElement(\'script\');\r\n    script.src = &quot;http://v3.jiathis.com/code/jia.js&quot;;\r\n    script.type = &quot;text/javascript&quot;;\r\n    head.appendChild(script);	\r\n	var jiathis_config = {\r\n	    boldNum:0,\r\n	    showClose:false,\r\n	    url:&quot;http://&quot; + location.host + &quot;/?cn=F0001F&quot;,\r\n	    summary: document.getElementById(\'share_text\').innerHTML.replace(\'&lt;span&gt;\',\'\').replace(\'&lt;/span&gt;\',\'\')\r\n	}\r\n}&lt;/script&gt;&lt;script type=&quot;text/javascript&quot;&gt;var _ncf={&quot;prd&quot;:&quot;firstp2p&quot;,&quot;pstr&quot;:&quot;&quot;,&quot;pfunc&quot;:null,&quot;pcon&quot;:&quot;&quot;,&quot;pck&quot;:{&quot;channel&quot;:&quot;channel&quot;,&quot;fpid&quot;:&quot;fpid&quot;},&quot;trid&quot;:&quot;&quot;,&quot;channel&quot;:[\'pubid\',\'mediumid\',\'adid\',\'adsize\'],&quot;rfuniq&quot;:[],&quot;rfmuti&quot;:[]};\r\n(function(p,h,s){var o=document.createElement(h);o.src=s;p.appendChild(o)})(document.getElementsByTagName(&quot;HEAD&quot;)[0],&quot;script&quot;,&quot;//assets1.ncfstatic.com/default/js/ncfpb.1.5.min.js?v=201410301859&quot;);&lt;/script&gt;&lt;!--!doctype--&gt;', '7', '1414041645', '1415169806', '2', '', '1', '1', '邀请好友');

alter table event_activity add weixintitle varchar(500) NOT NULL COMMENT '微信分享标题';
alter table event_activity add weixinimg varchar(500) NOT NULL COMMENT '分享的图片链接';
alter table event_activity add weixindes varchar(500) NOT NULL COMMENT '分享的内容';



-- ----------------------------
-- Table structure for `event_activity_category`
-- ----------------------------
DROP TABLE IF EXISTS `event_activity_category`;
CREATE TABLE `event_activity_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `create_user_id` varchar(255) NOT NULL COMMENT '创建者ID',
  `is_activity` tinyint(2) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '数据更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `site_url` varchar(500) DEFAULT NULL COMMENT '分类所属网站的URL',
  `group` varchar(200) DEFAULT NULL COMMENT '分类所属的分组',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_activity_category
-- ----------------------------
INSERT INTO event_activity_category VALUES ('1', 'firstp2p', '0', '7', '0', '1414037907', '0', '', '1');

-- ----------------------------
-- Table structure for `event_group`
-- ----------------------------
DROP TABLE IF EXISTS `event_group`;
CREATE TABLE `event_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_group
-- ----------------------------
INSERT INTO event_group VALUES ('1', 'Firstp2p组');

-- ----------------------------
-- Table structure for `event_user`
-- ----------------------------
DROP TABLE IF EXISTS `event_user`;
CREATE TABLE `event_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login_num` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `group` varchar(200) NOT NULL DEFAULT '1' COMMENT '用户所属组的记录',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_user
-- ----------------------------
INSERT INTO event_user VALUES ('1', '宋文超', 'songwenchao@ucfgroup.com', '1', '0', '1413960536', '1', '1');


-- ----------------------------
-- Table structure for `event_session`
-- ----------------------------
CREATE TABLE `event_session` (
	`session_id`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
	`session_expire`  int(11) NOT NULL ,
	`session_data`  blob NULL DEFAULT NULL ,
	UNIQUE INDEX `session_id` (`session_id`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
ROW_FORMAT=COMPACT;

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
  `publish_time` int(10) NOT NULL,
  `img_url` varchar(255) NOT NULL COMMENT '封面地址',
  `content` text NOT NULL COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
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







