<?php require_once('../../../app/config/PathConfig.php'); ?>
<?php if (!isset($_SESSION)) { session_start(); } ?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta http-equiv="content-type" charset="utf-8">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/completion.css">
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
        <title>エラー</title>
    </head>
    <body>
        <div id="completion_userInfo">
            <div class="title">
                <h4>エラー</h4>
            </div>
            <div class="completion_message">
                <h6>エラーが発生しました。管理者に問い合わせてください。</h6>
            </div>
            <div class="completion_form">
                <label class="completion_title">エラーコード : </label>
                <p class="completion_value"><?php echo $_SESSION['error_code'] ?></p>
            </div>
            <div class="text-center button_area">
                <a href="../../../app/controller/LogoutController.php" class="btn btn-primary">ログアウト</a>
            </div>
        </div>
    </body>
</html>
