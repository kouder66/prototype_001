<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
        <title>ユーザ登録</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/createUserInfo.css">
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div>
            <!-- ヘッダー読み込み -->
            <?php require_once('headerView.php'); ?>
        </div>
        <div id="create_userInfo">
            <form action="../../../app/controller/CreateUserInfoController.php" method="POST">
                <div class="title">
                    <h4>ユーザ登録</h4>
                </div>
                <div class="form-group create_form">
                    <div>
                        <label>ユーザID</label>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="user_id" maxlength="8" />
                    </div>
                    <!-- ユーザIDエラーメッセージ -->
                    <?php if(isset($_SESSION["check_error_message1"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message1"] ?></p>                            
                    <?php elseif(isset($_SESSION["check_error_message2"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message2"] ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group create_form">
                    <div>
                        <label>ユーザ名(姓)</label>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="first_name" maxlength="16" />
                    </div>
                    <!-- ユーザ名(姓)エラーメッセージ -->
                    <?php if(isset($_SESSION["check_error_message3"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message3"] ?></p>                            
                    <?php elseif(isset($_SESSION["check_error_message4"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message4"] ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group create_form">
                    <div>
                        <label>ユーザ名(名)</label>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="last_name" maxlength="16" />
                    </div>
                    <!-- ユーザ名(名)エラーメッセージ -->
                    <?php if(isset($_SESSION["check_error_message5"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message5"] ?></p>                            
                    <?php elseif(isset($_SESSION["check_error_message6"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message6"] ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group create_form">
                    <div>
                        <label>フリガナ(姓)</label>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="first_name_kana" maxlength="16" />
                    </div>
                    <!-- フリガナ(姓)エラーメッセージ -->
                    <?php if(isset($_SESSION["check_error_message7"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message7"] ?></p>                            
                    <?php elseif(isset($_SESSION["check_error_message8"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message8"] ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group create_form">
                    <div>
                        <label>フリガナ(名)</label>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="last_name_kana" maxlength="16" />
                    </div>
                    <!-- フリガナ(名)エラーメッセージ -->
                    <?php if(isset($_SESSION["check_error_message9"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message9"] ?></p>                            
                    <?php elseif(isset($_SESSION["check_error_message10"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message10"] ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group create_form">
                    <div>
                        <label>パスワード</label>
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" maxlength="8" />
                    </div>
                    <!-- パスワードエラーメッセージ -->
                    <?php if(isset($_SESSION["check_error_message11"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message11"] ?></p>                            
                    <?php elseif(isset($_SESSION["check_error_message12"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message12"] ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group create_form">
                    <div>
                        <label>パスワード(確認用)</label>
                    </div>
                    <div>
                        <input type="password" class="form-control" name="check_password" maxlength="8" />
                    </div>
                    <!-- パスワード(確認用)エラーメッセージ -->
                    <?php if(isset($_SESSION["check_error_message13"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message13"] ?></p>                            
                    <?php elseif(isset($_SESSION["check_error_message14"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message14"] ?></p>
                    <?php elseif(isset($_SESSION["check_error_message15"])): ?>
                        <p class="error_message"><?php echo $_SESSION["check_error_message15"] ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group buttun create_form">
                    <input type="hidden" name="mode" value="execute" />
                    <input type="submit" class="btn btn-primary form-control" value="登録" />
                </div>
            </form>
        </div>
    </body>
</html>

<?php unset($_SESSION["check_error_message1"]); ?>
<?php unset($_SESSION["check_error_message2"]); ?>
<?php unset($_SESSION["check_error_message3"]); ?>
<?php unset($_SESSION["check_error_message4"]); ?>
<?php unset($_SESSION["check_error_message5"]); ?>
<?php unset($_SESSION["check_error_message6"]); ?>
<?php unset($_SESSION["check_error_message7"]); ?>
<?php unset($_SESSION["check_error_message8"]); ?>
<?php unset($_SESSION["check_error_message9"]); ?>
<?php unset($_SESSION["check_error_message10"]); ?>
<?php unset($_SESSION["check_error_message11"]); ?>
<?php unset($_SESSION["check_error_message12"]); ?>
<?php unset($_SESSION["check_error_message13"]); ?>
<?php unset($_SESSION["check_error_message14"]); ?>
<?php unset($_SESSION["check_error_message15"]); ?>
