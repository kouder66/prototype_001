<?php if (!isset($_SESSION)) { session_start(); } ?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
        <title>ログイン</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/index.css">
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div id="login">
            <form action="../../../app/controller/LoginController.php" method="POST">
                <div class="title">
                    <h2>ログイン</h2>
                </div>
                <?php if(isset($_SESSION['login_error_message'])): ?>
                    <div class="text-center">
                        <p class="error_message"><?php echo $_SESSION['login_error_message'] ?></p>
                    </div>
                <?php endif; ?>
                <div class="login_form form-group">
                    <div class="login_id">
                        <label class="login_label">ユーザID</label>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="user_id" maxlength="8">
                    </div>
                    <div>
                        <!-- ユーザIDエラーメッセージ -->
                        <?php if(isset($_SESSION['check_error_message1'])): ?>
                            <p class="error_message"><?php echo $_SESSION['check_error_message1'] ?></p>
                        <?php elseif(isset($_SESSION['check_error_message2'])): ?>
                            <p class="error_message"><?php echo $_SESSION['check_error_message2'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="login_form form-group">
                    <div class="login_password">
                        <label class="login_label">パスワード</label>
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" maxlength="8">
                    </div>
                    <div>
                        <!-- パスワードエラーメッセージ -->
                        <?php if(isset($_SESSION['check_error_message11'])): ?>
                            <p class="error_message"><?php echo $_SESSION['check_error_message11'] ?></p>
                        <?php elseif(isset($_SESSION['check_error_message12'])): ?>
                            <p class="error_message"><?php echo $_SESSION['check_error_message12'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="login_form form-group">
                    <input type="submit" class="btn btn-primary form-control" value="ログイン" />
                </div>
            </form>
        </div>
    </body>
</html>

<?php unset($_SESSION['check_error_message1']); ?>
<?php unset($_SESSION['check_error_message2']); ?>
<?php unset($_SESSION['check_error_message11']); ?>
<?php unset($_SESSION['check_error_message12']); ?>
<?php unset($_SESSION['login_error_message']); ?>
