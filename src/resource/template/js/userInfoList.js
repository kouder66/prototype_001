$(function() {
    // アコーディオンパネル
    $('.accordion_title').click(function() {
        $('.accordion_contents').slideToggle();
    });

    // カレンダーを生成
    $('#calendar_to').datepicker({language: 'ja'});
    $('#calendar_from').datepicker({language: 'ja'});
});