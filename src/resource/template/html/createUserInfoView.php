<?php require_once('../../../app/entity/userInfoEntity.php'); ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
        <?php if(isset($_SESSION['user_info_entity'])): ?>
            <title>ユーザ情報更新</title>
        <?php else: ?>
            <title>ユーザ情報登録</title>
        <?php endif; ?>
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
            <?php if(isset($_SESSION['user_info_entity'])): ?>
                <form action="../../../app/controller/UpdateUserInfoController.php" method="POST">
            <?php else: ?>
                <form action="../../../app/controller/CreateUserInfoController.php" method="POST">
            <?php endif; ?>
                <div class="title">
                    <?php if(isset($_SESSION['user_info_entity'])): ?>
                        <h4>ユーザ情報更新</h4>
                    <?php else: ?>
                        <h4>ユーザ情報登録</h4>
                    <?php endif; ?>
                </div>
                <div class="form-group create_form">
                    <?php if(isset($_SESSION['check_error_message16'])): ?>
                        <div class="text-center">
                            <p class="error_message"><?php echo $_SESSION['check_error_message16'] ?></p>
                        </div>
                    <?php endif; ?>
                    <div>
                        <label>ユーザID</label>
                    </div>
                    <div>
                        <?php if(isset($_SESSION['user_info_entity'])): ?>
                            <input type="text" class="form-control" name="user_id" value=<?php echo $_SESSION['user_info_entity']->getUserId(); ?> disabled/>
                        <?php else: ?>
                            <input type="text" class="form-control" name="user_id" maxlength="8" />
                        <?php endif; ?>
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
                        <?php if(isset($_SESSION['user_info_entity'])): ?>
                            <input type="text" class="form-control" name="first_name" value=<?php echo $_SESSION['user_info_entity']->getFirstName() ?> maxlength="16" />
                        <?php else: ?>
                            <input type="text" class="form-control" name="first_name" maxlength="16" />
                        <?php endif; ?>
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
                        <?php if(isset($_SESSION['user_info_entity'])): ?>
                            <input type="text" class="form-control" name="last_name" value=<?php echo $_SESSION['user_info_entity']->getLastName()?> maxlength="16" />
                        <?php else: ?>
                            <input type="text" class="form-control" name="last_name" maxlength="16" />
                        <?php endif; ?>
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
                        <?php if(isset($_SESSION['user_info_entity'])): ?>
                            <input type="text" class="form-control" name="first_name_kana" value=<?php echo $_SESSION['user_info_entity']->getFirstNameKana() ?> maxlength="16" />
                        <?php else: ?>
                            <input type="text" class="form-control" name="first_name_kana" maxlength="16" />
                        <?php endif; ?>
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
                        <?php if(isset($_SESSION['user_info_entity'])): ?>
                            <input type="text" class="form-control" name="last_name_kana" value=<?php echo $_SESSION['user_info_entity']->getLastNameKana() ?> maxlength="16" />
                        <?php else: ?>
                            <input type="text" class="form-control" name="last_name_kana" maxlength="16" />
                        <?php endif; ?>
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
                    <?php if(isset($_SESSION['user_info_entity'])): ?>
                        <input type="hidden" name="id" value=<?php echo $_SESSION['user_info_entity']->getId() ?> />
                        <input type="hidden" name="user_id" value=<?php echo $_SESSION['user_info_entity']->getUserId() ?> />
                        <input type="submit" class="btn btn-primary form-control" value="更新" />
                    <?php else: ?>
                        <input type="submit" class="btn btn-primary form-control" value="登録" />
                    <?php endif; ?>
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
<?php unset($_SESSION["check_error_message16"]); ?>
