/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : minicms

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-04-27 16:50:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `syan_option`
-- ----------------------------
DROP TABLE IF EXISTS `syan_option`;
CREATE TABLE `syan_option` (
  `name` varchar(32) NOT NULL,
  `value` text,
  `description` varchar(255) DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syan_option
-- ----------------------------

-- ----------------------------
-- Table structure for `syan_user`
-- ----------------------------
DROP TABLE IF EXISTS `syan_user`;
CREATE TABLE `syan_user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nickname` varchar(32) NOT NULL,
  `role` varchar(32) NOT NULL DEFAULT 'user',
  `description` varchar(255) DEFAULT NULL,
  `regtime` int(10) NOT NULL,
  `logintime` int(10) NOT NULL,
  `status` int(1) unsigned DEFAULT '1',
  `authcode` varchar(100) DEFAULT '',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syan_user
-- ----------------------------
INSERT INTO `syan_user` VALUES ('1', 'syan', '$2y$10$O4IWHBKTi8cSCqntAN2YZeqp0sMJK0THoOIdGLvawp0cFxsttAw5O', 'mzsongyan@gmail.com', 'syan', 'admin', null, '1460519608', '1461635908', '1', 'efe71867797ef7204917773a9bfbca32');
INSERT INTO `syan_user` VALUES ('2', '测试一下', '$2y$10$SJXM8/GUk4RqMICaqiYsxetkul0lTSSWT6Y29IUVebw55XCsyHhKu', '317359303@qq.com', '测试一下', 'user', null, '1460519663', '1460519870', '1', '83e288bdee2a56e7fd16cc824c19f939');
INSERT INTO `syan_user` VALUES ('3', 'ssss', '$2y$10$ZsLs2f8soVQ9sIogP6ce1uKgQuLnwAKpmhC9PZMLx5UAc9ZiEepX2', '97583405@qq.com', 'ssss', 'user', null, '1460519707', '1460519746', '1', 'a4b625cbb61912c1072b046c370eeffc');
