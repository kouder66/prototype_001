<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" charset="utf-8">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/completion.css">
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <title>完了画面</title>
    </head>
    <body>
        <!-- ヘッダー読み込み -->
        <?php require_once('headerView.php'); ?>
        <div id="completion_userInfo">
            <div class="title">
                <h4><?php echo $_SESSION['title'] ?>完了</h4>
            </div>
            <div class="completion_message">
                <h5><?php echo $_SESSION['completion_message'] ?></h5>
            </div>
            <div class="completion_form">
                <label class="completion_title">ユーザID : </label>
                <p class="completion_value"><?php echo $_SESSION['completion_id'] ?></p>
            </div>
            <div class="text-center button_area">
                <a href="../../../app/controller/SelectUserInfoListController.php" class="btn btn-primary">戻る</a>
            </div>
        </div>
    </body>
</html>
