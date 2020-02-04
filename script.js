$(function() {
$('.top-text').hide().slideDown(2000);



$(function() {
 
  //マウスを乗せたら発動
  $('p').hover(function() {
 
    //マウスを乗せたら色が変わる
    $(this).css('background', 'fff');
 
  //ここにはマウスを離したときの動作を記述
  }, function() {
 
    //色指定を空欄にすれば元の色に戻る
    $(this).css('background', '');
 
  });
});
});
