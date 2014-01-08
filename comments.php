
<?php
if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

$id = get_the_ID();
//$id = 2380;
$args = array(
			'post_id' => $id,
			'type' => 'comment'
			);
$comments = get_comments($args);
//var_dump($comments);

?>

<?php
	foreach($comments as $comment) :
?>
<div class="comment-box">
	<img class="comment-avatar"	src="<?php bloginfo('template_directory'); ?>/images/avatar.png">
	<div class="comment">
		<p style="float:right;"><a href="#">分享</a> | <a href="#">回复</a></p>
		<p><a href="#"><?php echo $comment->comment_author; ?></a> | 
		<span style="color:#b9b9b9;"><?php echo substr($comment->comment_date, 0, strpos($comment->comment_date," "))?><span></p>
		<p>
		<?php 
			if ($comment->comment_approved == '0') {
				echo "你的评论正在审核，稍后会显示出来！";
			}
			else {
				echo $comment->comment_content;
			}		
		?>
		</p>
	</div>
</div>
<?php
	endforeach;
if ( !comments_open() ) {
    echo 
	    '<div class="comment-box">
        	<p><a href="#addcomment">评论功能已经关闭!</a></p>
    	</div>';
}
else {
?>
<div class="comment-box">
	<form style="display:inline">
		<input type="text" value="写下你的真知灼见" onblur="if (this.value==''){this.value='写下你的真知灼见'}" onfocus="if (this.value=='写下你的真知灼见') {this.value=''}" class="comment-input"/>
	</form>
</div>
<?php
}
?>
