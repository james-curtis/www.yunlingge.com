<?php
//Discuz! cache file, DO NOT modify me!
//Created: by ymg6.com {ymg6_time}
//Identify:  {ymg6_md5}

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
?>
<script>
Comiis_Touch_on = 0;
var comiis_notap = 1;
var comiis_initialScale = 1;
var comiis_currentScale;
var comiis_Swiper_li;
var comiis_Move_start_X = 0;
var comiis_Move_start_Y = 0;
var comiis_Move_X = 0;
var comiis_Move_Y = 0;
var comiis_on_move = 0;
var comiis_touche_num = 0;
var comiis_move_lr = 0;
var comiis_move_um = 0;
var origin;
var origin_start_X = 0;
var origin_start_Y = 0;
var comiis_show_img_obj;
var comiis_sMove_X = 0;
var comiis_sMove_Y = 0;
var comiis_lrtype;
var mySwiper = new Swiper('.comiis_picshowbox', {
<?php if($comiis_img_no) { ?>
initialSlide : '<?php echo $comiis_img_no;?>',
<?php } ?>
lazyLoading: true,
lazyLoadingOnTransitionStart : true,
onSlideChangeStart: function(swiper){
comiis_init(swiper);
},
onInit: function(swiper){
comiis_init(swiper);
},
onSetTranslate: function(swiper){
comiis_on_move = 1;
comiis_notap = 0;
},
onTransitionEnd: function(swiper){
comiis_on_move = 0;
comiis_notap = 1;
},
onTouchStart: function(swiper, e){
comiis_on_move = 0;
comiis_notap = 1;
comiis_touche_num = e.touches.length;
if(comiis_touche_num == 1){
comiis_Move_start_X = e.changedTouches[0].pageX.toFixed(2);
comiis_Move_start_Y = e.changedTouches[0].pageY.toFixed(2);
if(comiis_initialScale == 1){
comiis_show_img_obj = $(comiis_Swiper_li).find('img');
if(comiis_show_img_obj.width() >= $(window).width()){
origin_start_X = e.changedTouches[0].pageX.toFixed(2);
}else{
origin_start_X = comiis_show_img_obj.width() / 2;
}
if(comiis_show_img_obj.height() >= $(window).height()){
origin_start_Y = e.changedTouches[0].pageY.toFixed(2);
}else{
origin_start_Y = comiis_show_img_obj.height() / 2;
}
origin = origin_start_X + 'px ' + origin_start_Y + 'px ';
}else if(comiis_initialScale > 1){
comiis_sMove_X = origin_start_X;
comiis_sMove_Y = origin_start_Y;
}
}
},
onTouchMove: function(swiper, e){
if(comiis_initialScale > 1 && comiis_touche_num == 1){
comiis_Move_X = e.changedTouches[0].pageX - comiis_Move_start_X;
comiis_Move_Y = e.changedTouches[0].pageY - comiis_Move_start_Y;
var img_x = comiis_sMove_X - comiis_Move_X;
var img_y = comiis_sMove_Y - comiis_Move_Y;
var img_l = $(window).width() > comiis_show_img_obj.width() ? ($(window).width() - comiis_show_img_obj.width()) / 2 : 0;
var img_u = $(window).height() > comiis_show_img_obj.height() ? ($(window).height() - comiis_show_img_obj.height()) / 2 : 0;
if(comiis_show_img_obj.width() * comiis_initialScale > $(window).width()){
if(img_x <= img_l || img_x > img_l + (comiis_show_img_obj.width() * comiis_initialScale - $(window).width())){
if(img_x <= img_l){
origin_start_X = img_l;
}else{
origin_start_X = img_l + comiis_show_img_obj.width() * comiis_initialScale - $(window).width();
}
}else{
origin_start_X = comiis_sMove_X - comiis_Move_X;
}
}
if(comiis_show_img_obj.height() * comiis_initialScale > $(window).height()){
if(img_y <= img_u || img_y > img_u + (comiis_show_img_obj.height() * comiis_initialScale - $(window).height())){
if(img_y <= img_u){
origin_start_Y = img_u;
}else{
origin_start_Y = img_u + comiis_show_img_obj.height() * comiis_initialScale - $(window).height();
}
}else{
origin_start_Y = comiis_sMove_Y - comiis_Move_Y;
}
}
origin = origin_start_X + 'px ' + origin_start_Y + 'px ';
$(comiis_Swiper_li).find('.comiis_pic_zoom').css({
"transform-origin" : origin + " 0px",
"-webkit-transform-origin" : origin + " 0px",
});
}
},
});
touch.on('#comiis_picshowbox', 'touchstart tap doubletap pinch pinchend', function(e){
if(e.type == 'touchstart'){
if(comiis_touche_num > 1){
e.preventDefault();
}
<?php if($comiis_is_first) { ?>
}else if(e.type == 'tap' && comiis_notap == 1){
$('.comiis_picshow').toggleClass("comiis_title_hide");
<?php } ?>
}else if(e.type == 'doubletap' && comiis_notap == 1){
if(comiis_swiper_is_Scale()){
comiis_initialScale = comiis_initialScale == 1 ? 2 : 1;
comiis_swiper_Scale(comiis_initialScale, 1);
}else{
$(comiis_Swiper_li).addClass('comiis_img_nozoom').on('webkitAnimationEnd animationend', function(){
$(this).off('webkitAnimationEnd animationend').removeClass('comiis_img_nozoom');

});
}
}else if(e.type == 'pinch' && !comiis_on_move){
comiis_currentScale = e.scale - 1;
comiis_currentScale = comiis_initialScale + comiis_currentScale;
comiis_swiper_Scale(comiis_currentScale, 0);
}else if(e.type == 'pinchend' && !comiis_on_move){		
if((comiis_currentScale > 2 || comiis_currentScale < 1) && (comiis_show_img_obj.width() >= $(window).width() || comiis_show_img_obj.height() >= $(window).height())){
comiis_currentScale = comiis_currentScale > 2 ? 2 : comiis_currentScale;
comiis_currentScale = comiis_currentScale < 1 ? 1 : comiis_currentScale;
comiis_swiper_Scale(comiis_currentScale, 1);
}			
comiis_initialScale = comiis_currentScale;
if((comiis_show_img_obj.width() < $(window).width() && comiis_show_img_obj.height() < $(window).height())){
comiis_swiper_Scale(1, 1);
comiis_initialScale = comiis_currentScale = 1;
}				
}
});
function comiis_init(swiper){
$('.comiis_show_num').text(swiper.activeIndex + 1);
comiis_Swiper_li = swiper.slides[swiper.activeIndex];
var aid = comiis_Swiper_li.getAttribute("aid");		
$('#comiis_reurl').attr('href','home.php?mod=space&uid=<?php echo $pic['uid'];?>&do=album&picid='+aid+'&pic=yes'); 		
$('#picshow_txt').text($('#comiis_message_' + aid).length > 0 ? $('#comiis_message_' + aid).html() : ' ');
$('.picshow_txt').css('height', $('#picshow_txt').height() + 'px');
}
function comiis_swiper_Scale(scale, t){
var obj = $(comiis_Swiper_li).find('.comiis_pic_zoom');
if(scale == 1){
mySwiper.unlockSwipes();
comiis_Move_X = 0;
comiis_Move_Y = 0;
}else{
mySwiper.lockSwipes();
}
if(t == 1){
obj.css({
"-webkit-transition" : "transform 200ms ease-out",
"transition" : "transform 200ms ease-out",	
}).on('webkitTransitionEnd transitionend', function() {
$(this).off('webkitTransitionEnd transitionend').css({
"-webkit-transition" : "none",
"transition" : "none",	
});
});
}else{
obj.css({
"-webkit-transition" : "none",
"transition" : "none",	
});
}
obj.css({
"-webkit-transform" : "scale3d(" + scale + ", " + scale + ", 1);",
"transform" : "scale3d(" + scale + ", " + scale + ", 1)",

"transform-origin" : origin + " 0px",
"-webkit-transform-origin" : origin + " 0px",
});		
}
function comiis_swiper_is_Scale(){
if((comiis_show_img_obj.width() >= $(window).width() || comiis_show_img_obj.height() >= $(window).height()) && !comiis_on_move){
return true;
}else{
return false;
}
}
var share_obj = new nativeShare('comiis_share', {
img: mySwiper.slides[0].getAttribute("aid-src"),
url:'<?php echo $_G['siteurl'];?>home.php?mod=space&uid=<?php echo $pic['uid'];?>&do=album&id=<?php echo $pic['albumid'];?>',
title:'<?php echo $album['albumname'];?>',
desc:'<?php echo str_replace(array("\r\n", "\r", "\n"), "", $album['depict']);; ?>',
from:'<?php echo $_G['setting']['bbname'];?>'
});
$('.comiis_piclistbox ul li').on('click', function() {
$('.comiis_piclistbox').removeClass('comiis_show_piclist');
mySwiper.slideTo($(this).index(), 500, true);
$('.comiis_open_piclistbox').removeClass('comiis_show_piclist_key');
});
function succeedhandle_favorite_thread(a, b, c){
popup.open(b, 'alert');
}
function errorhandle_favorite_thread(a, b){
popup.open(a, 'alert');
}	
$('.comiis_open_piclistbox').on('click', function() {
$('.comiis_piclistbox_masonry').css({
'height' : $(window).height() - 68,
'width' : $(window).width() - 40,
}).toggleClass('comiis_show_piclist');
$(this).toggleClass('comiis_show_piclist_key');
comiis_pic_masonry();
});	
$(window).resize(function(){
comiis_pic_masonry();
});
function comiis_pic_masonry(){
$('.comiis_piclistbox_masonry').css({
'height' : $(window).height() - 68,
'width' : $(window).width() - 40,
});
var comiis_pic_width = ($(window).width() - 52) / 2;
$('.comiis_piclistbox_masonry li').css('width', (comiis_pic_width) + 'px');
imagesLoaded($('.comiis_piclistbox_masonry ul'),function(){
$('.comiis_piclistbox_masonry ul').masonry({
itemSelector:'li',
columnWidth:comiis_pic_width,
gutterWidth : 12
});
});
}	
</script>
<div id="comiis_bgbox" style="display:none;"></div>
<div id="mask" style="display:none;"></div>
<div id="comiis_menu_bg" style="display:none;"></div>
<div id="comiis_alert" style="display:none;"></div>