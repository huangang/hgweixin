--
-- 表的结构 `wx_users`
--
CREATE TABLE IF NOT EXISTS `wx_users` (
    `openid` varchar(100) NOT NULL comment '用户opneid',
    `lock` varchar(100) DEFAULT 'unlock' comment '锁机制',
    PRIMARY KEY (`openid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- 表的结构 `uc_rooms`
--
CREATE TABLE IF NOT EXISTS `uc_rooms` (
    `userid` varchar(100) NOT NULL comment '用户openid',
    `createdtime` datetime DEFAULT NULL comment '房间创建时间',
    `roomid` int(4) NOT NULL comment '房间号' AUTO_INCREMENT,
    `allcount` int(2) NOT NULL comment '游戏总人数',
    `nowcount` int(2) DEFAULT 0 comment '现在已经加入游戏人数',
    `undercoverid1` int(2) NOT NULL comment '卧底号1',
    `undercoverid2` int(2) DEFAULT NULL comment '卧底号2',
    `whiteboardid` int(2) DEFAULT NULL comment '白板号',
    `word1` varchar(20) NOT NULL comment '平民词',
    `word2` varchar(20) NOT NULL comment '卧底词',
    PRIMARY KEY (`roomid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000;
--
-- 表的结构 `uc_words`
--

CREATE TABLE IF NOT EXISTS `uc_words` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word1` varchar(20) NOT NULL comment '平民词',
  `word2` varchar(20) NOT NULL comment '卧底词',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54;

--
-- 转存表中的数据 `uc_words`
--

INSERT INTO `uc_words` (`id`, `word1`, `word2`) VALUES
(1, '王菲', '那英'),
(2, '老佛爷', '老天爷'),
(3, '元芳', '展昭'),
(4, '麻雀', '乌鸦'),
(5, '胖子', '肥肉'),
(6, '高跟鞋', '增高鞋'),
(7, '台式电脑', '手提电脑'),
(8,'玫瑰','月季'), 
(9,'董永','许仙'),  
(10,'若曦','晴川'),  
(11,'谢娜','李湘'),  
(12,'孟非','乐嘉'),  
(13,'牛奶','豆浆'),
(14,'保安','保镖'),  
(15,'白菜','生菜'),  
(16,'辣椒','芥末'),  
(17,'金庸','古龙'),  
(18,'赵敏','黄蓉'),  
(19,'海豚','海狮'),
(20,'水盆','水桶'),  
(21,'唇膏','口红'),  
(22,'森马','以纯'),  
(23,'烤肉','涮肉'),  
(24,'气泡','水泡'),  
(25,'纸巾','手帕'), 
(26,'杭州','苏州'),  
(27,'香港','台湾'),  
(28,'首尔','东京'),  
(29,'橙子','橘子'),  
(30,'葡萄','提子'),  
(31,'太监','人妖'),
(32,'蝴蝶','蜜蜂'),  
(33,'小品','话剧'),  
(34,'裸婚','闪婚'),  
(35,'新年','跨年'),  
(36,'吉他','琵琶'),  
(37,'公交','地铁'),
(38, '剩女', '御姐'),  
(39, '童话', '神话'),  
(40, '作家', '编剧'),  
(41, '警察', '捕快'),  
(42, '结婚', '订婚'),  
(43, '奖牌', '金牌'),
(44, '孟飞', '乐嘉'),  
(45, '那英', '韩红'),  
(46, '面包', '蛋糕'),  
(47, '作文', '论文'),  
(48, '油条', '麻花'),  
(49, '壁纸', '贴画'),
(50, '枕头', '抱枕'),  
(51, '手机', '座机'),  
(52, '同学', '同桌'),  
(53, '婚纱', '喜服');

--
-- 表的结构 `uc_punish`
--

CREATE TABLE IF NOT EXISTS `uc_punish`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `uc_punish`
--

INSERT INTO `uc_punish` (`id`, `item`) VALUES
(1, '唱一首儿歌，不得少于3句'),
(2, '恭喜你直接通过！'),
(3, '语音说自己最丢人的事'),
(4, '唱一首周杰伦的歌，不得少于3句'),
(5, '发微博截图：今天下雨.打算去同性恋聚会的...去不成了..唉....'),
(6, '扮演如花招牌动作抠鼻屎'),
(7, '在朋友圈发：凤姐是我最爱的人，截图发群里'),
(8, '在朋友圈发：喜欢我，就赶快对我表白吧！然后截图发到群里'),
(9, '跟群里一位异性说：亲爱的，今晚我们来一下下啦。'),
(10, '照张大腿照'),
(11,'站到凳子上表演大猩猩捶胸呐喊动作'),  
(12,'学超级名模走秀，绕桌子或教室一圈'),  
(13,'与本桌或本教室离你最近的一位异性同学拥抱十秒钟。'),  
(14,'找在场的一位异性情歌对唱。（邀请，三次失败罚表演）'),  
(15,'和坐你右边的同学深情对视并对她或他唱《老鼠爱大米》中的高潮部分。'),  
(16,'和离你最近的一位同性同学十指相扣10秒，并看着对方说眼睛含情脉脉地说：我爱你。'),  
(17,'对在场的一位异性说一分钟情话，不要冷场哦。（邀请）'),  
(18,'给大家唱一首对于你来说有特殊意义的歌（与你心中的人有关），并说出原因。'),  
(19,'右手捏住左耳垂，弯下腰，顺时针转10圈，再金鸡独立15秒不许倒。'),  
(20,'蹲凳子上上做便秘状10秒钟 '), 
(21,'冲到门外撕心裂肺的喊“台湾回归啦！台湾回归啦！大家快看中央一台……”（跟真有那么回事似的）');  

-- --------------------------------------------------------