<?php require_once('../../../app/entity/UserInfoEntity.php'); ?>
<?php if (!isset($_SESSION)) { session_start(); } ?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
        <title>ユーザ情報削除</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/deleteUserInfo.css">
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php require_once('headerView.php'); ?>
        <div id="delete_userInfo">
            <div class="title">
                <h4>ユーザ情報削除</h4>
            </div>
            <div class="delete_message">
                <p>以下を削除しますがよろしいでしょうか？</p>
            </div>
            <form action="../../../app/controller/DeleteUserInfoController.php" method="POST">
                <div class="delete_form">
                    <label class="delete_title">ユーザID : </label>
                    <p class="delete_value"><?php echo $_SESSION['user_info_entity']->getUserId() ?></p>
                </div>
                <div class="delete_form">
                    <label class="delete_title">ユーザ名(姓) : </label>
                    <P class="delete_value"><?php echo $_SESSION['user_info_entity']->getFirstName() ?></p>
                </div>
                <div class="delete_form">
                    <label class="delete_title">ユーザ名(名) : </label>
                    <P class="delete_value"><?php echo $_SESSION['user_info_entity']->getLastName() ?></p>
                </div>
                <div class="delete_form">
                    <label class="delete_title">フリガナ(姓) : </label>
                    <P class="delete_value"><?php echo $_SESSION['user_info_entity']->getFirstNameKana() ?></p>
                </div>
                <div class="delete_form">
                    <label class="delete_title">フリガナ(名) : </label>
                    <P class="delete_value"><?php echo $_SESSION['user_info_entity']->getLastNameKana() ?></p>
                </div>
                <div class="text-center button_area">
                    <input type="hidden" name="id" value=<?php echo $_SESSION['user_info_entity']->getId() ?> />
                    <input type="hidden" name="user_id" value=<?php echo $_SESSION['user_info_entity']->getUserId() ?> />
                    <input type="submit" class="btn btn-primary" value="削除" />
                    <a href="../../../app/controller/SelectUserInfoListController.php" class="btn btn-primary">戻る</a>
                </div>
            </form>
        </div>
    </body>
</html>
