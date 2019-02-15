<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" charset="utf-8">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/reset.css">
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <title>完了画面</title>
    </head>
    <body>
        <!-- ヘッダー読み込み -->
        <?php require_once('headerView.php'); ?>
        <div class="container-fluid">
            <h2>完了画面</h2>
            <div class="text-right">
                <a href="../../../app/controller/SelectUserInfoListController.php" class="btn btn-primary">管理ユーザ一覧に戻る</a>
            </div>
            <div class="text-center">
                <p><?php echo $_SESSION['completion_message'] ?></p>
            </div>
        </div>
    </body>
</html>
