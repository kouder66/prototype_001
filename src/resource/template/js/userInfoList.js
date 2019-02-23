$(function () {
    // アコーディオンパネル
    $('.accordion_title').click(function () {
        $('.accordion_contents').slideToggle();
    });

    // 検索フォームにてエラーメッセージが表示されている場合、
    // アコーディオンパネルは開いている状態にする
    if ($('p').hasClass('error_message'))
    {
        $('.accordion_contents').show();
    }

    // カレンダーを生成
    $('#calendar_to').datepicker({language: 'ja'});
    $('#calendar_from').datepicker({language: 'ja'});
});
