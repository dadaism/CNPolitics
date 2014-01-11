<?php
$toptopics = array(
	'1' => '制度',
	'2' => '政经',
	'3' => '社会',
	'4' => '外交',
	'5' => '史论'
	);

$regions = array(
	'1' => '北美',
	'2' => '欧洲',
	'3' => '大陆',
	'4' => '港澳台',
	'5' => '亚洲其他',
	'6' => '澳洲',
	'7' => '智库',
	'8' => '其他'
	);

$sexes = array(
	'0' => '未知',
	'1' =>	'男',
	'2' => '女'
	);

$cnpolitics_url = get_site_url();
//$cnpolitics_url = get_bloginfo('url');
$cnpolitics_dir =  get_template_directory();
$cnpolitics_theme_dir =  get_template_directory();
$cnpolitics_theme_uri = get_template_directory_uri();

$topic_image_dir = "/upload/topics/";
$rsch_image_dir = "/upload/researchers/";

$sns_favorate_url = "http://cnpolitics.org";
$sns_rss_url = 	"http://cnpolitics.org/feed/";
$sns_weibo_url = "http://weibo.com/cnpolitics";
$sns_tencent_url = "http://t.qq.com/chinapolitics";
$sns_163_url = "http://t.163.com/cnpolitics";

//$category_display = array( 0,1,1,1,0,1,1,1,0);
?>