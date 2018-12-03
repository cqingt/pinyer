/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50721
Source Host           : 127.0.0.1:3306
Source Database       : pinyer

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2018-11-22 17:48:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sys_admin
-- ----------------------------
DROP TABLE IF EXISTS `sys_admin`;
CREATE TABLE `sys_admin` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(100) NOT NULL,
  `password` char(32) NOT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `reg_ip` char(15) DEFAULT NULL,
  `reg_time` datetime DEFAULT NULL,
  `last_login_ip` char(15) DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `encrypt` varchar(50) DEFAULT NULL,
  `is_lock` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`(15))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of sys_admin
-- ----------------------------
INSERT INTO `sys_admin` VALUES ('1', 'admin', '4384ab3fa908e96270d85f54bc488d79', null, null, null, '127.0.0.1', '2018-11-22 06:03:23', 'P@N&Y$', '0', '2018-11-20 16:20:17');

-- ----------------------------
-- Table structure for sys_articles
-- ----------------------------
DROP TABLE IF EXISTS `sys_articles`;
CREATE TABLE `sys_articles` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT '标题',
  `description` varchar(1024) NOT NULL DEFAULT '' COMMENT '描述',
  `image` varchar(1024) NOT NULL DEFAULT '' COMMENT '封面图片',
  `likes` int(11) NOT NULL DEFAULT '0' COMMENT '点赞',
  `content` text NOT NULL,
  `set_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否置顶：1是',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of sys_articles
-- ----------------------------
INSERT INTO `sys_articles` VALUES ('1', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '1', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('2', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('3', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('4', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('5', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('6', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('7', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('8', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('9', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('10', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('11', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('12', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('13', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('14', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('15', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('16', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('17', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('18', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('19', '文字标题内容', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('20', '文字标题内容ddd', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('21', '文字标题内容abc', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('22', '文字标题内容789', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('23', '文字标题内容456', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
INSERT INTO `sys_articles` VALUES ('24', '文字标题内容123', '这只是传说中的面熟，描述', 'https://cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg', '0', '内容没什么好说的了', '0', '2018-11-22 14:38:36', '2018-11-22 14:38:40');
