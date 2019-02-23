<?php require_once('../../../app/config/MessageConfig.php'); ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta http-equiv="content-type" charset="utf-8">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/completion.css">
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
        <title>完了画面</title>
    </head>
    <body>
        <?php if(!($_SESSION['title'] === TITLE3 && $_SESSION['id'] === $_SESSION['completion_id'])): ?>
            <?php require_once('headerView.php'); ?>
        <?php endif; ?>
        <div id="completion_userInfo">
            <div class="title">
                <h4><?php echo $_SESSION['title'] ?>完了</h4>
            </div>
            <div class="completion_message">
                <h5><?php echo $_SESSION['completion_message'] ?></h5>
            </div>
            <div class="completion_form">
                <label class="completion_title">ユーザID : </label>
                <p class="completion_value"><?php echo $_SESSION['completion_user_id'] ?></p>
            </div>
            <div class="text-center button_area">
                <?php if($_SESSION['title'] === TITLE3 && $_SESSION['id'] === $_SESSION['completion_id']): ?>
                    <a href="../../../app/controller/LogoutController.php" class="btn btn-primary">ログアウト</a>
                <?php else: ?>
                    <a href="../../../app/controller/SelectUserInfoListController.php" class="btn btn-primary">ユーザ情報一覧戻る</a>
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>
