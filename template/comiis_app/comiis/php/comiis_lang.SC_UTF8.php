<?PHP

/**
 * 
 * 克米出品 必属精品
 * 克米设计工作室 版权所有 http://www.Comiis.com
 * 专业论坛首页及风格制作, 页面设计美化, 数据搬家/升级, 程序二次开发, 网站效果图设计, 页面标准DIV+CSS生成, 各类大中小型企业网站设计...
 * 我们致力于为企业提供优质网站建设、网站推广、网站优化、程序开发、域名注册、虚拟主机等服务，
 * 一流设计和解决方案为企业量身打造适合自己需求的网站运营平台，最大限度地使企业在信息时代稳握无限商机。
 *
 *   电话: 0668-8810200
 *   手机: 13450110120  15813025137
 *    Q Q: 21400445  8821775  11012081  327460889
 * E-mail: ceo@comiis.com
 *
 * 工作时间: 周一到周五早上09:00-11:30, 下午03:00-05:30, 晚上09:00-11:00(周六、日休息)
 * 克米设计用户交流群: ①群83667771 ②群83667772 ③群83667773 ④群110900020 ⑤群110900021 ⑥群70068388 ⑦群110899987
 * 
 */
 
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
global $comiis_system_key, $comiis_system_config, $comiis_md5file, $comiis_info, $comiis_lang, $comiis_app_switch, $comiis_app_nav;


$comiis_lang = array(
	'list1' => '此版块',
	'reg1' => '返回登录',
	'reg2' => '忘记密码',
	'reg3' => '注册新帐号',
	'reg4' => '使用第三方帐号登录',
	'reg5' => '返回注册',
	'reg6' => '已有帐号? 马上登录',
	'reg7' => '已阅读并同意',
	'reg8' => '保密',
	'reg9' => '性别',
	'reg10' => '恭喜, 邮箱已激活验证',
	'reg11' => '重新验证',
	'reg12' => '等待验证中',
	'reg13' => '请输入密码',
	'reg14' => '完善信息',
	'reg15' => '欢迎使用QQ帐号登录',
	'reg16' => '绑定已有帐号',
	'reg17' => '完成注册',
	'reg18' => '答案',
	'reg19' => '请输入问题答案',
	'reg20' => '绑定帐号',
	'reg21' => '点击完善帐号信息',
    'reg22' => '创建新帐号',
    'reg23' => '请先完善帐号信息, 再进行后续操作',
    'reg24' => '邮箱',
    'reg25' => '请输入邮箱地址',
    'reg26' => '验证',
    'reg27' => '找回密码',
    'reg28' => '确认',
    'reg29' => '请再次输入密码',
    'reg30' => '请输入',
	'all0' => '社区',
	'all1' => '分享',
	'all2' => '举报',
	'all3' => '关注',
	'all4' => '已关注',
	'all5' => '全部评论',
	'all6' => '暂无评论',
	'all7' => '快来抢沙发',
	'all8' => '确定',
	'all9' => '取消',
	'all10' => '是否确定取消关注',
	'all11' => '收藏',
	'all12' => '主题',
	'all13' => '删除',
	'all14' => '提示',
	'all15' => '日',
	'all16' => '暂无图片',
	'all17' => '上一页',
	'all18' => '下一页',
	'all19' => '查看详细',
	'all20' => '留言',
	'all21' => '亲，已经到底了！',
	'all22' => '暂无数据',
	'all23' => '数据错误',
	'all24' => '成功',
	'all25' => '高级筛选',
	'all26' => '高级模式',
	'all27' => '说说你的看法',
	'all28' => '取 消',
	'all29' => '返回列表',
	'all30' => '最近来访',
	'all31' => '我看过谁',
	'all32' => '黑名单',
	'all33' => '我的关注',
	'all34' => '我的粉丝',
	'all35' => '资讯',
	'all36' => '详情',
	'all37' => '关注ta',
	'all38' => '好友请求',
	'all39' => '附言',
	'all40' => '添加签名, 展示你的个性...',
	'all41' => '文章',
	'all42' => '添加',
	'all43' => '热',
	'all44' => '的',
	'all45' => '公共消息',
	'all46' => '系统消息',
	'all47' => '暂无',
	'all48' => '积分',
	'all49' => '上午',
	'all50' => '下午',
	'all51' => '消息',
	'all52' => '为好友',
	'all53' => '评论',
	'all54' => '创建于',
	'all55' => '特殊',
	'all56' => '心情',
	'all57' => '墙',
	'all58' => '我的',
	'all59' => '好友',
	'all60' => '二维码',
	'all61' => '签到',
	'all62' => '热门推荐',
	'all63' => '这里空空的<br>快去关注版块吧',
	'all64' => '帖数',
	'all65' => '这里空空的<br>快去设置推荐版块吧',
	'all66' => '好棒哦!<br>推荐版块都在你的关注中了',
	'all67' => '今日发帖',
	'all68' => '总帖数',
	'all69' => '会员数',
	'all70' => '我关注的',
	'all71' => '暂无版块简介，请到后台添加.',
	'all72' => '今日',
	'all73' => '粉丝',
	'all74' => '人气',
	'view1' => '精',
	'view2' => '顶',
	'view3' => '查看全部',
	'view4' => '楼主',
	'view5' => '帖子',
	'view6' => '点赞这个帖子',
	'view7' => '赞',
	'view8' => '查看全部点赞用户',
	'view9' => '回复成功',
	'view10' => '提交的资料不完整，请完善资料后重新提交!',
	'view11' => '活动人数已满',
	'view12' => '活动已结束',
	'view13' => '填写报名信息:',
	'view14' => '确定报名',
	'view15' => '我要参加',
	'view16' => '暂不参加',
	'view17' => '活动介绍',
	'view18' => '加入',
	'view19' => '支持',
	'view20' => '正方',
	'view21' => '反方',
	'view22' => '话题介绍',
	'view23' => '本期话题已有',
	'view24' => '人参与投票',
	'view25' => '票',
	'view26' => '最多可选',
	'view27' => '项',
	'view28' => '您的回答被采纳后将获得',
	'view29' => '本悬赏已解决并结束',
	'view30' => '选择会员，点击底部按钮进行操作',
	'view31' => '花销',
	'view32' => '方',
	'view33' => '选择',
	'view34' => '还能选择',
	'view35' => '个',
	'view36' => '已选',
	'view37' => '未选',
	'view38' => '每次最多邀请20个好友',
	'view39' => '如果不在上面列表中，可在下方填写',
	'view40' => '条评论',
	'view41' => '置顶',
	'view42' => '精华',
	'view43' => '图片',
	'view44' => '赞该帖子的人',
	'view45' => '查看',
	'view46' => '付费记录',
	'view47' => '阅读',
	'view48' => '来自',
	'view49' => '查看全部打赏',
	'view50' => '打赏',
	'view51' => '说两句鼓励一下吧...',
	'view52' => '搬砖不容易，打赏一下楼主吧',
	'view53' => '赏',
	'view54' => '标签',
	'view55' => '点击',
	'view56' => '热门',
	'view57' => '资料',
	'view58' => '个人中心',
	'view59' => '公告',
	'view60' => '热',
	'view61' => '交易详情',
	'view62' => '确认购买信息',
	'view63' => '本版',
	'view64' => '有时候打赏也是一种鼓励 ^_^',
	'post1' => '设置标签',
	'post2' => '如果活动有时间范围的可选择此项',
	'post3' => '参与性别',
	'post4' => '必填资料',
	'post5' => '扩展资料',
	'post6' => '指定',
	'post7' => '选项',
	'post8' => '填写投票选项',
	'post9' => '已达到最大投票数',
	'post10' => '设置购买需要附加的积分',
	'post11' => '可不填',
	'post12' => '费用',
	'post13' => '一个好的商品图片会更吸引买家哦',
	'post14' => '样式设置',
	'post15' => '输入',
	'post16' => '资料设置',
	'post17' => '发新文章',
	'post18' => '发布文章',
	'post19' => '编辑文章',
	'post20' => '添加到相关文章列表',
	'post21' => '颜色',
	'post22' => '样式',
	'post23' => '请输入颜色代码, 如#ee3b3b',
	'post24' => '发布',
	'post25' => '编辑',
	'post26' => '截取',
	'post27' => '给相册想一个好名字吧',
	'post28' => '图片描述',
	'post29' => '上传到',
	'post30' => '现有相册',
	'post31' => '请选择',
	'post32' => '添加后可以继续添加图片',
	'post33' => '多楼层用英文逗号隔开, 如:8,88,*88',
	'post34' => '大于此设置才能参与, 可不填',
	'post35' => '开启',
	'post36' => '选择发帖版块',
	'post37' => '设置',
	'post38' => '打招呼',
	'post39' => '对你',
	'post40' => '加好友',
	'post41' => '聊聊天',
	'post42' => '提交后将删除该帖子!',
	'post43' => '高级',
    'post44' => '是否确定',
    'post45' => '抱歉，您尚未输入标题或内容',
    'post46' => '群主',	
    'post47' => '群组',	
    'post48' => '需要消耗',	
	'post49' => '您已有 '.$groupnum.' 个',
	'post50' => '还能创建 '.$allowbuildgroup.' 个',
    'post51' => '发主题',
    'post52' => '发活动',
    'post53' => '发商品',
    'post54' => '您的标题超过 80 个字符的限制',
    'post55' => '请选择主题对应的分类',
    'post56' => '请选择主题对应的分类信息',
    'post57' => '上传',
    'post58' => '文件',
    'post59' => '大小限制:',
    'post60' => '视频',
    'post61' => '插入',
    'post62' => '网络图片网址',
    'post63' => '网络音乐文件网址',
    'post64' => '网络视频网址',
    'post65' => 'FLASH文件网址',
    'post66' => '需要插入的引用',
    'post67' => '需要插入的代码',
    'post68' => '如果您设置了帖子售价，请输入购买前免费可见的信息内容',
    'post69' => '要隐藏的信息内容',
    'post70' => '支持 wma mp3 ra rm 等音乐格式网址',
    'post71' => '支持优酷、土豆、56、酷6等视频站的视频网址',
    'post72' => '支持 swf flv 等 Flash 网址',
    'post73' => '积分大于',
    'post74' => '可见，隐藏天数',
    'post75' => '天',
    'post76' => '不设置积分和天数，默认为回复可见',
    'post77' => '网络图片',
    'post78' => '音乐',
    'post79' => '网络视频',
    'post80' => '引用',
    'post81' => '代码',
    'post82' => '免费信息',
    'post83' => '隐藏内容',
    'post84' => '请输入需要插入的内容',
    'post85' => '文字链接',
    'post86' => '链接文字',
    'post87' => '链接网址',    
	'tip1' => '关注成功',
	'tip2' => '已取消关注',
	'tip3' => '设置成功',
	'tip4' => '亲，已经到底了！',
	'tip5' => '点击加载更多',
	'tip6' => '正在加载...',
	'tip7' => '暂不支持高级操作',
	'tip8' => '登陆后可看大图, 立即登录?',
	'tip9' => '此时此刻',
	'tip10' => '想和大家分享点什么...',
	'tip11' => '扫扫二维码，查看Ta的主页',
	'tip12' => '朋友账号，就能提醒他来看帖子',
	'tip13' => '注意: 恶意举报将会受到相应处罚',
	'tip14' => '说点什么吧...',
	'tip15' => '这家伙很懒, 什么也没留下...',
	'tip16' => '您还未登录，立即登录?',
	'tip17' => '分享我的心情...',	
	'tip18' => '查看图片',	
	'tip19' => '上传完成!',
	'tip20' => '已通过',
	'tip21' => '待审核',
	'tip22' => '人数',
	'tip23' => '元',
	'tip24' => '自费',
	'tip25' => '说点什么吧...',
	'tip26' => '日',
	'tip27' => '操作成功',
	'tip28' => '回复成功',
	'tip29' => '添加相关文章',
	'tip30' => '请先选择',
	'tip31' => '亲，已经到底了！',
	'tip32' => '重新加载',
	'tip33' => '指定好友已删除',
	'tip34' => '成功收听',
	'tip35' => '取消成功',
	'tip36' => '发送成功',
	'tip37' => '刚刚',
	'tip38' => '消息读取出错',
	'tip39' => '您确定要执行本操作吗？',
	'tip40' => '请选择要操作的对象',
	'tip41' => '选择分类',
	'tip42' => '分类创建成功！',
	'tip43' => '分类名不能为空！',
	'tip44' => '已忽略指定的好友申请',
	'tip45' => '您已通过',
	'tip46' => '的好友申请',
	'tip47' => '收藏成功',
	'tip48' => '不存在',
	'tip49' => '您还没有关注此版块',
	'tip50' => '重复收藏',
	'tip51' => '版块已关注',
	'tip52' => '暂无简介, 请在后台版块管理中添加',
	'tip53' => '更多',
	'tip54' => '收起',
	'tip55' => '在',
	'tip56' => '发帖',
	'tip57' => '更新?',
	'tip58' => '必填项目没有填写',
	'tip59' => '请选择下一级',
	'tip60' => '请选择一个选项',
	'tip61' => '邮件地址不正确',
	'tip62' => '填写项目长度过长',
	'tip63' => '数字填写不正确',
	'tip64' => '大于设置最大值',
	'tip65' => '小于设置最小值',
	'tip66' => '请正确填写以http://开头的URL地址',
	'tip67' => '高级筛选',
	'tip68' => '修改成功',
	'tip69' => '暂无商品图片',
	'tip70' => '联系',
	'tip71' => '快递费用',
	'tip72' => '立即',
	'tip73' => '卖家信息',
	'tip74' => '商品详情',
	'tip75' => '收货人',
	'tip76' => '状态变更',
	'tip77' => '交易信息',
	'tip78' => '您已评价过本主题',
	'tip79' => '已取消点赞',
	'tip80' => '您不能评价自己的帖子',
	'tip81' => '不能点赞自己的帖子',
	'tip82' => '今日评价机会已用完',
	'tip83' => '您今日的点赞机会已用完',
	'tip84' => '点赞成功',
	'tip85' => '您今天还能点赞',
	'tip86' => '次',
	'tip87' => '没有点赞权限或帖子不存在',
	'tip88' => '早上好!',
	'tip89' => '中午好!',
	'tip90' => '下午好!',
	'tip91' => '晚上好!',
	'tip92' => '请登录',
	'tip93' => '或注册',
	'tip94' => '登录后更精彩...',
	'tip95' => '待审核',
	'tip96' => '发表',
	'tip97' => '最新评论',
	'tip98' => '相关阅读',
	'tip105' => '标题',
	'tip106' => '必填',
	'tip112' => '自动获取',
	'tip113' => '日志',
	'tip121' => '内容',
	'tip129' => '搜索',
	'tip130' => '文章 ID',
	'tip131' => '待选',
	'tip132' => '最多显示50条',
	'tip133' => '全选',
	'tip134' => '管理相关文章',
	'tip135' => '该文章已经添加过了',
	'tip136' => '没有找到指定的文章',
	'tip137' => '没有相关内容',
	'tip138' => '游客',
	'tip139' => '审核未通过',
	'tip140' => '生成文章',
	'tip141' => '热度',
	'tip142' => '作者其他日志',
	'tip143' => '热门日志',
	'tip144' => '默认相册',
	'tip145' => '本页有',
	'tip145s' => '张图片因作者的隐私设置或未通过而隐藏',
	'tip146' => '该相册下还没有图片',
	'tip147' => '的其它相册',
	'tip148' => '同步到个人签名',
	'tip149' => '相册名称',
	'tip150' => '相册描述',
	'tip151' => '站点分类',
	'tip152' => '隐私设置',
	'tip153' => '全站用户可见',
	'tip154' => '仅好友可见',
	'tip155' => '指定好友可见',
	'tip156' => '仅自己可见',
	'tip157' => '密码相册',
	'tip158' => '从好友组选择好友',
	'tip159' => '可以填写多个好友名，请用空格进行分割',
	'tip160' => '设为封面',
	'tip161' => '个人分类',
	'tip162' => '新建分类',
	'tip163' => '创建',
	'tip164' => '还可输入',
	'tip165' => '个字符',
	'tip166' => '收藏备注',
	'tip167' => '手机收藏',
	'tip168' => '分组',
	'tip169' => '加为好友',
	'tip170' => '创建新相册',
	'tip171' => '密码',
	'tip172' => '公开',
	'tip173' => '好友可见',
	'tip174' => '保密',
	'tip175' => '自定义头衔',
	'tip176' => '个人签名',
	'tip177' => '修改',
	'tip178' => '保存',
	'tip179' => '请检查该资料项',
	'tip180' => '资料更新成功',
	'tip181' => '旧密码',
	'tip182' => '新密码',
	'tip183' => '确认新密码',
	'tip184' => '添加特别关注',
	'tip185' => '取消特别关注',
	'tip186' => '互相关注',
	'tip187' => '未关注你',
	'tip188' => '成功',
	'tip189' => '修改备注',
	'tip190' => '添加备注',
	'tip191' => '匿名',
	'tip192' => '解除黑名单',
	'tip193' => '备注',
	'tip194' => '月',
	'tip195' => '悬赏',
	'tip196' => '我来回答',
	'tip197' => '辩手',
	'tip198' => '已有',
	'tip199' => '人购买',
	'tip200' => '本主题需向作者支付 <strong>',
	'tip201' => '</strong> 才能浏览',
	'tip202' => '购买主题',
	'tip203' => '本主题购买截止日期为 ',
	'tip204' => '，到期后将免费',
	'tip205' => '全新',
	'tip206' => '二手',
	'tip207' => '附加',
	'tip208' => '您还不是本 '.$_G[setting][navs][3][navname].' 的成员不能参与此活动',
	'tip209' => '点此处马上加入 '.$_G[setting][navs][3][navname],
	'tip210' => '关闭',
	'tip211' => '注意：参加此活动将扣除您',
	'tip212' => '支付方式',
	'tip213' => '承担自己应付的花销',
	'tip214' => '支付',
	'tip215' => '不足',
	'tip216' => '选填',
	'tip217' => '分类名称',
	'tip218' => '您有',
	'tip219' => '条新消息',	
	'tip220' => '插入',	
	'tip221' => '报名管理',	
	'tip222' => '门户调试中，请稍后访问...',
	'tip223' => '"日", "一", "二", "三", "四", "五", "六"',
	'tip224' => '一二三四五六七八九十',
	'tip225' => '正二三四五六七八九十冬腊',
	'tip226' => '(闰)',
	'tip227' => '月',
	'tip228' => '初',
	'tip229' => '十',
	'tip230' => '廿',	
	'tip231' => '星期',
	'tip232' => '年',
	'tip233' => '月',
	'tip234' => '三十',
	'tip235' => '活动列表',	
	'tip236' => '聊天',	
	'tip237' => '记录',	
	'tip238' => '发了那么多图片表情, 就多写点内容吧!',	
	'tip239' => '内容过少, 再多写点什么吧!',		
	'tip240' => '在本版发帖',	
    'tip241' => '手机号不能为空',	
    'tip242' => '手机号不正确',	
    'tip243' => '短信验证码发送成功',	
    'tip244' => '秒后重新发送',	
    'tip245' => '发送验证码',	
    'tip246' => '手机号',	
    'tip247' => '验证码',	
    'tip248' => '获取验证码',	
	'tip249' => '请填写正确的邮箱，提交后请及时查收邮件。<br />您可能需要等待几分钟才能收到邮件，如果收件箱没有，请检查一下垃圾邮件箱。',
	'tip250' => '管理',
	'tip251' => '本',
	'tip252' => '只限加入成员查看<br />马上加入查看更多精彩',
	'tip253' => '点击看更多',
	'tip254' => '链接到外部地址',
	'tip255' => '本主题为付费主题',
	'tip256' => '本主题需要阅读权限浏览',
	'tip257' => '辛苦啦！打赏奖励',
	'tip258' => '已有',
	'tip259' => '人参与了打赏',
	'tip260' => '表情',
	'tip261' => '@朋友',
	'tip262' => '等级',	
	'tip263' => '到期',	
	'tip264' => '可购买',	
	'tip265' => '还差',
	'tip266' => '升级为',
	'tip267' => '介绍',
	'tip268' => '进行中',
	'tip269' => '已完成',
	'tip270' => '已失败',
	'tip271' => '任务中心',
	'tip272' => '领取奖励',
	'tip273' => '奖励',
	'tip274' => '申请任务',
	'tip275' => '预览',
	'tip276' => '点击或长按手机复制分享',
	'tip277' => '通过分享帖子也可以获得积分奖励哦 ^_^',
	'tip278' => '马上去分享推广帖子>>',	
	'tip279' => '内容已复制，快分享给朋友吧！',
	'tip280' => '访问推广',
	'tip281' => '您的手机不支持本功能<br>请长按手机选择内容复制分享',
	'tip282' => '荐',
	'tip283' => '本帖子中包含更多精彩资源',
	'tip284' => '您需要',
	'tip285' => '登录',
	'tip286' => '才可以查看, 没帐号?',
	'tip287' => '<span class="f_c">您需要</span> <a href="member.php?mod=connect" class="f_wb">完善帐号</a> <span class="f_c">或</span> <a href="member.php?mod=connect&ac=bind" class="f_wb">绑定已有帐号</a> <span class="f_c">后才可查看</span>',
	'tip288' => '您现在的等级暂无权限下载或查看资源',
	'tip289' => '拥有认证',
	'tip290' => '每个邀请码需花费: ',	
	'tip291' => '请输入需要获取的数量',
	'tip292' => '邀请码有效期为 '.$_G[group][maxinviteday].' 天，过期自动失效',
	'tip293' => '邀请注册赚积分',
	'tip294' => '点击或长按复制邀请码',
	'tip295' => '帐号',
	'tip296' => '问题',
	'tip297' => '正在连接 [腾讯安全中心] 检测外链',
	'tip298' => '如需继续访问请点击确定',	
	'tip299' => '非必填',
	'tip300' => '暂无认证',
	'tip301' => '我要认证',
	'tip302' => '邀请您的朋友扫描二维码加入吧！',
	'tip303' => '推广赚积分',
	'tip304' => '后台',
	'tip305' => '(仅管理员可见)',
    'post_promotion' => '如果您的朋友通过二维码访问网站并注册会员，您将获得奖励 <span class="f_a">'.$regstr.'</span>',
    'post_promotion_reg' => '如果您的朋友注册成为会员，您将再获得奖励 <span class="f_a">'.$regstr.'</span>',
    'post_promotion_url' => '如果您的朋友通过二维码访问网站，您将获得奖励 <span class="f_a">'.$visitstr.'</span>',  
	'doing_maxlimit_char' => '还可输入 <strong class="maxlimit">200</strong> 个字符',	
	'thread_stick' => '置顶',
	'cancel' => '取消',
	'collection_commentnum' => '评论',
	'forum_nothreads' => '本版块或指定的范围内尚无主题',
	'postreplyneedmod' => '本版回帖需要审核，您的帖子将在通过审核后显示',
	'reply' => '回复',
	'poston' => '发表于',
	'from' => '来自',
	'unlimited' => '不限', 
	'forum_password_require' => '本版块需要密码才可以访问<br>请在下方输入密码',
	'submit' => '提交', 
	'post_trade_name' => '商品名称',
	'post_trade_number' => '商品数量',
	'trade_type_viewthread' => '商品类型',
	'trade_new' => '全新',
	'trade_old' => '二手',
	'post_trade_locus' => '所在地点',
	'post_trade_price' => '商品价格',
	'trade_price' => '现价',
	'payment_unit' => '元',
	'trade_costprice' => '原价', 
	'post_trade_picture' => '商品图片',
	'update' => '更新',
	'forum_recommend_image' => '图片',
	'add' => '添加', 
	'uploadpicfailed' => '上传失败，请稍后再试',
	'uploadpicatttypeban' => '(附件类型被禁止)',
	'donotcross' => '(不能超过',
	'please_select' => '请选择',
	'maxnum' => '最大值',
	'minnum' => '最小值',
	'maxlength' => '最大长度',
	'unchangeable' => '不可修改', 
	'reward_price' => '悬赏价格',
	'reward_tax_after' => '税后支付',
	'reward_price_min' => '价格不能低于',
	'reward_price_max' => '不能高于',
	'you_have' => '您有', 
	'reward_tax_add' => '税后追加',
	'post_reward_resolved' => '已解决的悬赏', 
	'post_single_frame_mode' => '单框模式',
	'post_poll_comment' => '最多可填写 '.$_G[setting][maxpolloptions].' 个选项',
	'post_poll_add' => '增加一项',
	'post_poll_comment_s' => '每行填写 1 个选项', 
	'debate_square_point' => '正方观点',
	'debate_opponent_point' => '反方观点',
	'endtime' => '结束时间',
	'debate_umpire' => '裁判',
	'username' => '用户名', 
	'activity_starttime_endtime' => '时间范围',
	'post_event_time' => '活动时间',
	'activity_starttime' => '开始时间',
	'activity_space' => '活动地点',
	'activity_city' => '所在城市',
	'activiy_sort' => '活动类别',
	'activity_need_member' => '需要人数',
	'male' => '男',
	'female' => '女',
	'post_activity_message' => '每行代表一个项目，最多',
	'post_option' => '项',
	'consumption_credit' => '消耗积分',
	'activity_payment' => '每人花销',
	'post_closing' => '报名截止', 
	'post_topic_image' => '活动图片', 
	'post_additional_options' => '附加选项',
	'readperm' => '阅读权限',
	'highest_right' => '最高权限',
	'replypassword' => '帖子密码',
	'confirms' => '确定',
	'modcp_posts_thread' => '主题',
	'price' => '售价',
	'post_price_comment' => '最高 '.$_G[group][maxprice].$_G[setting][extcredits][$_G[setting][creditstransextra][1]][unit],
	'post_timer' => '定时发布',
	'time' => '时间',
	'replycredit' => '回帖奖励',
	'replycredit_once' => '每次回帖奖励:',
	'replycredit_empty' => '(留空或填 0 为不奖励)',
	'replycredit_reward' => '奖励',
	'replycredit_time' => '次',
	'replycredit_member' => '每人最多可获得',
	'replycredit_rate' => '中奖率',
	'replycredit_total' => '回帖奖励总额:',
	'replycredit_however' => '本帖尚有',
	'replycredit_revenue' => '税后支付',
	'basic_attr' => '基本属性',
	'post_anonymous' => '使用匿名发帖',
	'hiddenreplies' => '回帖仅作者可见',
	'post_descviewdefault' => '回帖倒序排列',
	'post_noticeauthor' => '接收回复通知',
	'addfeed' => '发送动态',
	'post_show_sig' => '使用个人签名',
	'manage_operation' => '管理操作',
	'post_stick_thread' => '主题置顶',
	'post_digest_thread' => '精华帖子',
	'auditstatuson' => '通过审核', 
	'rushreply_thread' => '抢楼主题',
	'rushreply_time' => '抢楼时间:',
	'rushreply_rewardfloor' => '奖励楼层:',
	'stopfloor' => '回帖限制',
	'replylimit' => '每个用户回帖次数上限',
	'rushreply_end' => '截止楼层:',
	'credits' => '积分',
	'min_limit' => '下限',
	'total_credits' => '总积分',
	'auto_keyword' => '自动获取',
	'posttag_comment' => '用逗号或空格隔开多个标签，最多可填写 5 个', 
	'inputyourname' => '请输入用户名',
	'post_delpost' => '删除本帖',
	'reward_price_back' => '，返还悬赏费用，不退还手续费',
	'del_thread_warning' => '删除后无法撤销',
	'thread_subject' => '标题',
	'required' => '必填',
	'types' => '分类',
	'debate_viewpoint' => '选择观点',
	'debate_neutral' => '中立',
	'debate_square' => '正方',
	'debate_opponent' => '反方',
	'thread_content' => '内容', 
	'enter_content' => '请输入搜索内容', 
	'search' => '搜索', 
	'none' => '无',
	'no' => '否',
	'yes' => '是',
	'expire' => '有效期', 
	'admin_digest_add' => '精华',
	'admin_digest_remove' => '解除',
	'thread_digest' => '精',
	'thread_highlight' => '高亮',
	'backgroundcolor' => '背景色', 
	'modmenu_move' => '移动',
	'admin_target' => '目标版块',
	'admin_targettype' => '目标分类',
	'admin_move' => '移动主题',
	'admin_move_hold' => '保留转向',
	'select_thread_catgory' => '选择主题分类',
	'admin_type_msg' => '当前版块无分类设置，请联系管理员到后台设置主题分类',
	'close' => '关闭',   
	'admin_delpost_confirm' => '您确定要删除此回复？',
	'modmenu_banthread' => '屏蔽',
	'admin_banpost' => '屏蔽',
	'admin_unbanpost' => '解除',
	'modmenu_warn' => '警告',
	'topicadmin_warn_add' => '警告',
	'topicadmin_warn_delete' => '解除',
	'modmenu_removereward' => '移除悬赏',
	'modmenu_copy' => '复制',
	'admin_merge' => '合并',
	'admin_merge_tid' => '填写要合并的主题 ID (tid)',
	'modmenu_restore' => '撤销付费',
	'pay_buyers' => '已购买人数',
	'pay_author_income' => '作者所得',
	'modmenu_split' => '分割',
	'admin_split_newsubject' => '新标题',
	'admin_split_comment' => '分割 &rarr;填写楼号 (用 "," 间隔)',
	'modmenu_live' => '直播',
	'admin_live' => '直播',
	'admin_live_cancle' => '取消直播',
	'admin_live_tips' => '同一版块内只能设置一个直播帖<br>设置直播后会覆盖原有直播帖<br>建议超过5条回复后设置',
	'modmenu_stamp' => '图章',
	'admin_stamp_select' => '选择主题图章',
	'admin_stamp_none' => '无图章',
	'modmenu_icon' => '图标',
	'admin_stamplist_select' => '选择主题图标',
	'admin_stamplist_current' => '当前图标',
	'admin_stamplist_none' => '无图标',
	'admin_select_piece' => '选择了',
	'admin_select_piece1' => '篇帖子',
	'admin_stickreply' => '置顶到主题帖',
	'admin_unstickreply' => '解除置顶', 
	'announcements' => '公告', 
	'networkerror' => '网络出现问题，请稍后再试', 
	'nologin_tip' => '您还未登录，立即登录?',
	'nopostreply' => '您暂时没有权限发表', 
	'have' => '已有',
	'activity_member_unit' => '人',
	'author' => '作者',
	'rate_view' => '查看全部评分', 
	'has_expired' => '该信息已经过期', 
	'replystick' => '置顶回复',
	'recommend_post' => '推荐',
	'guest' => '游客',
	'anonymous' => '匿名',
	'member_deleted' => '该用户已被删除', 
	'warn_get' => '受到警告',
	'prosit' => '恭喜',
	'rushreply_hit' => '抢中本楼',
	'thread_author' => '楼主', 
	'join_thread' => '回复',
	'moderating' => '审核中',
	'have_ignored' => '已忽略',
	'draft' => '草稿', 
	'trade_type_buy' => '商品',
	'trade_additional' => '附加',
	'trade_seller' => '卖家',
	'trade_confirm_buy' => '确认购买信息',
	'trade_credits_total' => '支付总额',
	'trade_units' => '元',
	'trade_nums' => '购买数量',
	'post_trade_transport' => '物流方式',
	'post_trade_transport_seller' => '卖家承担运费',
	'post_trade_transport_buyer' => '买家承担运费',
	'post_trade_transport_virtual' => '虚拟物品',
	'post_trade_transport_physical' => '买家收到货物后直接支付给物流公司',
	'post_trade_transport_mail' => '平邮',
	'post_trade_transport_express' => '快递',
	'trade_paymethod' => '交易方式',
	'trade_pay_alipay' => '在线交易',
	'trade_pay_offline' => '担保交易',
	'trade_buyername' => '收货人姓名',
	'trade_buyercontact' => '收货地址',
	'trade_buyerzip' => '收货人邮编',
	'trade_buyerphone' => '收货人电话',
	'trade_buyermobile' => '收货人手机',
	'trade_seller_remark' => '备注信息',
	'trade_buy_confirm' => '确认购买',
	'trade_guest_alarm' => '您目前为游客，购买后您无法在本版块查看交易状态，请到支付网站查询', 
	'trade_recommended_goods' => '推荐的商品', 
	'trade_payment_comment' => '点击底部的“更新交易单”按钮重新计算交易金额',
	'trade_online_tenpay' => '使用财付通在线支付',
	'trade_order_status' => '查看并确认支付宝交易单状态',
	'tenpay_trade_order_status' => '查看并确认财付通交易单状态',
	'trade_buyer' => '买家',
	'trade_baseprice' => '商品价格',
	'trade_order_no' => '交易单号',
	'post_trade_transport_offline' => '线下交易',
	'trade_transportfee' => '运费',
	'trade_submit_order' => '更新交易单', 
	'trade_message' => '留言', 
	'attachment_buy' => '购买',
	'sold_out' => '已售完',
	'comments' => '点评',
	'post_trade_sticklist' => '推荐商品',
	'delete' => '删除',
	'set_cover' => '设为封面',
	'edit_trade' => '编辑商品', 
	'post_trade_support_tenpay' => '此商品支持财付通，您可以先验货后付款',
	'post_trade_buynumber' => '累计售出',
	'trade_locus' => '地点',
	'trade_transport' => '运费',
	'post_trade_transport_none' => '无运费',
	'trade_remaindays' => '剩余时间',
	'trade_timeout' => '成交结束',
	'days' => '天',
	'trade_hour' => '小时', 
	'trade_seller_real_name' => '卖家实名',
	'taobao' => '阿里旺旺',
	'eccredit_sellerinfo' => '卖家信用',
	'eccredit_buyerinfo' => '买家信用',
	'attachment' => '附件',
	'attach_nopermission' => '您所在的用户组无法下载或查看附件', 
	'trade_other_goods' => '柜台其它商品',
	'trade_seller_other_goods' => '的其它商品', 
	'password' => '密码',
	'password_confirm' => '确认密码',
	'invite_code' => '邀请码',
	'register_message' => '注册原因',
	'email' => 'Email', 
	'report_reason_message' => "['广告垃圾','违规内容','恶意灌水','重复发帖','其他']",
	'article_delete' => '删除文章',
	'article_delete_direct' => '直接删除',
	'article_delete_recyclebin' => '放入回收站',
	'article_send_succeed' => '发布文章成功',
	'view_article' => '查看文章',
	'article_edit' => '编辑文章',
	'page_title' => '分页标题',
	'article_category' => '频道栏目',
	'article_source' => '文章来源',
	'choose_please' => '请选择',
	'article_source_url' => '来源地址',
	'article_dateline' => '发布时间',
	'article_auto_grab' => '自动获取',
	'thread' => '帖子',
	'portal' => '门户',
	'blog' => '日志',
	'album' => '相册', 
	'article_getauthorall' => '获取楼主所有帖子',
	'grab' => '获取',
	'article_url' => '跳转URL',
	'article_author' => '原作者',
	'article_forbidcomment_description' => '禁止评论',
	'article_tag' => '聚合标签',
	'article_description' => '摘要',
	'article_related' => '添加相关文章',
	'select' => '选择',
	'e_bold' => '文字加粗',
	'e_italic' => '文字斜体',
	'e_underline' => '文字加下划线',
	'select_color' => '点击选择颜色', 
	'thread_poll' => '投票',
	'thread_trade' => '商品',
	'thread_reward' => '悬赏',
	'thread_activity' => '活动',
	'thread_debate' => '辩论',
	'rushreply' => '抢楼',   
	'activity_allow_join' => '允许参加',
	'activity_do_replenish' => '等待完善',
	'activity_cant_audit' => '尚未审核',
	'activity_self' => '自付',
	'no_informations' => '无任何信息', 
	'uploadstatusmsgnag1' => '内部服务器错误',
	'uploadstatusmsg0' => '上传成功',
	'uploadstatusmsg1' => '不支持此类扩展名',
	'uploadstatusmsg2' => '服务器限制无法上传那么大的附件',
	'uploadstatusmsg3' => '用户组限制无法上传那么大的附件',
	'uploadstatusmsg4' => '不支持此类扩展名',
	'uploadstatusmsg5' => '文件类型限制无法上传那么大的附件',
	'uploadstatusmsg6' => '今日您已无法上传更多的附件',
	'uploadstatusmsg7' => '请选择图片文件',
	'uploadstatusmsg8' => '附件文件无法保存',
	'uploadstatusmsg9' => '没有合法的文件被上传',
	'uploadstatusmsg10' => '非法操作',
	'uploadstatusmsg11' => '今日您已无法上传那么大的附件', 
	'edit' => '编辑',
	'send_threads' => '发帖',
	'all' => '全部',
	'mythread' => '我的主题',
	'pm_center' => '消息',
	'viewmypm' => '查看消息',
	'send_pm' => '发消息',
	'notice' => '提醒',
	'invite_friend' => '邀请好友', 
	'home_openall' => '查看所有留言',
	'online' => '在线',
	'offline' => '离线',
    'group_perm_visit' => '浏览权限',
    'group_perm_all_user' => '所有人',
    'group_perm_member_only' => '仅成员',
    'group_join_type' => '加入方式',
    'group_join_type_free' => '自由加入',
    'group_join_type_moderate' => '审核加入',
    'group_join_type_invite' => '邀请加入',
    'close' => '关闭',
    'subdomain' => '二级域名', 
    'ignore_all' => '忽略全部',
    'pass_all' => '全部通过',
    'pass' => '通过',
    'ignore' => '忽略',
    'group_no_member_moderated' => '暂无需要审核成员。',
    'group_admin_member' => '管理成员',
    'login_normal_mode' => '在线',
    'group_star_member_title' => '明星成员',
    'group_threadtype_limit_1' => '最多只能有',
    'group_threadtype_limit_2' => '个主题分类。',
    'threadtype_name' => '分类名称',
    'threadtype_turn_on_comment' => '设置是否启用主题分类功能，您需要同时设定相应的分类选项，才能启用本功能',
    'threadtype_turn_on' => '启用主题分类',
    'threadtype_required' => '发帖必须归类',
    'threadtype_prefix' => '类别前缀',
    'threadtype' => '主题分类',
    'delete' => '删除',
    'enable' => '启用',
    'displayorder' => '顺序',
    'threadtype_add' => '添加分类',
    'submit' => '提交', 
    'group_category' => '所属分类',
    'choose_please' => '请选择', 
    'group_wait_mod' => '待审核', 
    'deletefile' => '删除',
    'loader'=> '数据加载中',
    'topicadmin_delet_comment' => '删除当前信息?',
);
require_once DISCUZ_ROOT.'./source/plugin/comiis_app/function/function_comiis.php';
?>