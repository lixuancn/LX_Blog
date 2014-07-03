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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台菜单分类' AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=1 ;

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
  `recommend_type` TINYINT(4) NOT NULL COMMENT '推荐类型，1是全站推荐，2是首页推荐',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `content` (`content`),
  INDEX (`recommend_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='文章表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `info_comment`
--

CREATE TABLE IF NOT EXISTS `info_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `cid` int(11) NOT NULL COMMENT '所属的上级评论，顶级评论为0',
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='友情链接' AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='菜单分类' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `info_tag`
--

CREATE TABLE IF NOT EXISTS `info_tag` (
  `tag` varchar(50) NOT NULL COMMENT 'TAG内容',
  `num` int(11) NOT NULL COMMENT '出现次数',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='TAG' AUTO_INCREMENT=1 ;
