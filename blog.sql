-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014-01-24 10:53:04
-- 服务器版本: 5.5.34-0ubuntu0.13.10.1
-- PHP 版本: 5.5.3-1ubuntu2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `blog`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_menu`
--

CREATE TABLE IF NOT EXISTS `admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '父类ID。0是顶级分类',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `in_out` tinyint(4) NOT NULL COMMENT '1是站内链接，2是出站链接',
  `url` varchar(100) NOT NULL COMMENT '出站链接地址，in_out为2是生效',
  `class` varchar(50) NOT NULL COMMENT '站内链接，类名',
  `action` varchar(50) NOT NULL COMMENT '站内链接，方法名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台菜单分类' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `pid`, `name`, `in_out`, `url`, `class`, `action`) VALUES
(1, 0, '后台分类', 1, '', '', ''),
(2, 1, '添加分类', 1, '', 'adminmenu', 'add'),
(3, 1, '分类列表', 1, '', 'adminmenu', 'lists'),
(4, 0, '文章管理', 1, '', '', ''),
(5, 4, '发表文章', 1, '', 'article', 'add'),
(6, 4, '文章列表', 1, '', 'article', 'lists'),
(7, 0, '管理员管理', 1, '', '', ''),
(11, 10, '添加分类', 1, '', 'menu', 'add'),
(8, 7, '添加管理员', 1, '', 'admin', 'add'),
(9, 7, '管理员列表', 1, '', 'admin', 'lists'),
(10, 0, '前台分类', 1, '', '', ''),
(12, 10, '分类列表', 1, '', 'menu', 'lists');

-- --------------------------------------------------------

--
-- 表的结构 `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `password`) VALUES
(1, 'lixuan', 'bc76daa40e91dbcfada67c7b02b77c08');

-- --------------------------------------------------------

--
-- 表的结构 `info_article`
--

CREATE TABLE IF NOT EXISTS `info_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `mid` int(11) NOT NULL COMMENT '所属分类ID',
  `author` varchar(50) NOT NULL COMMENT '作者',
  `title` varchar(100) NOT NULL COMMENT '文章标题',
  `description` varchar(500) NOT NULL COMMENT '文章描述摘要',
  `seo_title` varchar(100) NOT NULL COMMENT 'SEO - title',
  `seo_description` varchar(500) NOT NULL COMMENT 'SEO - description',
  `seo_keywords` varchar(200) NOT NULL COMMENT 'SEO - 关键词',
  `tag` varchar(100) NOT NULL COMMENT '标签',
  `clicks` int(11) NOT NULL COMMENT '点击次数',
  `content` text NOT NULL COMMENT '文章内容',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `good_num` int(11) NOT NULL COMMENT '被赞的次数',
  `bad_num` int(11) NOT NULL COMMENT '被拍砖的次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='文章表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `info_article`
--

INSERT INTO `info_article` (`id`, `mid`, `author`, `title`, `description`, `seo_title`, `seo_description`, `seo_keywords`, `tag`, `clicks`, `content`, `ctime`, `good_num`, `bad_num`) VALUES
(1, 1, '李轩', '测试文章1', '', '测试title_测试title', '测试description,测试description,测试description,', '测试title_测试title', '测试标签1|测试标签2|测试标签3', 10, '测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。', 1389594399, 10, 0),
(2, 1, '李轩', '测试文章1', '测试描述1', '测试title_测试title', '测试description,测试description,测试description,', '测试title_测试title', '测试标签1|测试标签2|测试标签3', 10, '测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。测试内容。', 1389594399, 10, 0);

-- --------------------------------------------------------

--
-- 表的结构 `info_comment`
--

CREATE TABLE IF NOT EXISTS `info_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `aid` int(11) NOT NULL COMMENT '所属文章ID',
  `mid` int(11) NOT NULL COMMENT '所属分类',
  `content` text NOT NULL COMMENT '评论内容',
  `nickname` varchar(50) NOT NULL COMMENT '用户的昵称',
  `email` varchar(100) NOT NULL COMMENT '邮箱地址',
  `website` varchar(200) NOT NULL COMMENT '个人主页地址',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `good_num` int(11) NOT NULL COMMENT '被赞的次数',
  `bad_num` int(11) NOT NULL COMMENT '被拍砖的次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `info_comment`
--

INSERT INTO `info_comment` (`id`, `aid`, `mid`, `content`, `nickname`, `email`, `website`, `ctime`, `good_num`, `bad_num`) VALUES
(1, 1, 1, '测试评论，测试评论，测试评论，测试评论，测试评论，测试评论，', '叫我大轩神', 'lixuan868686@163.com', 'http://www.lanecn.com', 1389597080, 21, 0),
(3, 1, 1, '啊啊啊', 'lixuan', 'lixuan868686@163.com', '', 1389842232, 0, 0),
(4, 1, 1, '啊啊啊', 'lixuan', 'lixuan868686@163.com', '', 1389842278, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `info_friend_link`
--

CREATE TABLE IF NOT EXISTS `info_friend_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '站名',
  `url` varchar(100) NOT NULL COMMENT '链接',
  `nofollow` tinyint(4) NOT NULL COMMENT '1是添加nofollow，0不添加',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='友情链接' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `info_friend_link`
--

INSERT INTO `info_friend_link` (`id`, `name`, `url`, `nofollow`) VALUES
(1, 'PHP', 'http://www.php.net', 1),
(2, 'Mysql', 'http://www.mysql.com', 1),
(3, 'github', 'http://www.github.com', 1),
(4, 'Apache', 'http://www.apache.org', 1);

-- --------------------------------------------------------

--
-- 表的结构 `info_menu`
--

CREATE TABLE IF NOT EXISTS `info_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '分类名',
  `seo_title` varchar(100) NOT NULL COMMENT 'SEO - title',
  `seo_description` varchar(500) NOT NULL COMMENT 'SEO - description',
  `seo_keywords` varchar(200) NOT NULL COMMENT 'SEO - 关键词',
  `in_out` tinyint(4) NOT NULL COMMENT '指向站内(1)或站外(2)',
  `pid` int(11) NOT NULL COMMENT '父类ID。0是顶级分类',
  `url` varchar(100) NOT NULL COMMENT '出站链接地址，in_out为2是生效',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='菜单分类' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `info_menu`
--

INSERT INTO `info_menu` (`id`, `name`, `seo_title`, `seo_description`, `seo_keywords`, `in_out`, `pid`, `url`) VALUES
(1, 'PHP', 'php_php博客_php研究', 'PHP的文章，资讯，和技术研究分享。', 'php,php博客,php研究', 1, 0, ''),
(4, 'Mysql', 'Mysql_Mysql博客_Mysql分享', 'MYSQL的文章，资讯，和技术研究分享。', 'Mysql,Mysql博客,Mysql分享', 1, 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
