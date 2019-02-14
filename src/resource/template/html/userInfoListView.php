<?php require_once('../../../app/entity/UserInfoEntity.php'); ?>
<?php if(!isset($_SESSION)){ session_start(); } ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
        <title>ユーザ一覧</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/userInfoList.css">
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bootstrap-datepicker.js"></script>
        <script src="../js/bootstrap-datepicker.ja.min.js"></script>
        <script src="../js/userInfoList.js"></script>
    </head>
    <body>
        <div id="header">
            <!-- ヘッダー読み込み -->
            <?php require_once('headerView.php'); ?>
        </div>
        <div class="container-fluid user_info_list_area">
            <h4>ユーザ一覧</h4>
            <!-- 検索フォーム -->
            <div id="search_user_info">
                <div class="accordion_title">
                    <h4>検索</h4>
                </div>
                <div class="accordion_contents">
                    <form action="#" method="POST">
                        <div class="search_form search_user_id_form">
                            <p class="search_user_id">
                                <input type="text" class="form-control search_input" name="user_id" placeholder="ユーザID" maxlength="8" />
                            </p>
                        </div>
                        <?php if(isset($_SESSION['check_error_message1'])): ?>
                            <p class="error_message"><?php echo $_SESSION['check_error_message1'] ?></p>
                        <?php endif; ?>
                        <div class="search_form">
                            <p class="search_name">
                                <input type="text" class="form-control search_input" name="first_name" placeholder="ユーザ名(姓)" maxlength="16" />
                            </p>
                            <p class="search_name">
                                <input type="text" class="form-control search_input" name="last_name" placeholder="ユーザ名(名)" maxlength="16" />
                            </p>
                        </div>
                        <?php if(isset($_SESSION['check_error_message2'])): ?>
                            <p class="error_message"><?php echo $_SESSION['check_error_message2'] ?></p>
                        <?php elseif(isset($_SESSION['check_error_message3'])): ?>
                            <p class="error_message"><?php echo $_SESSION['check_error_message3'] ?></p>
                        <?php endif; ?>
                        <div class="search_form">
                            <p class="search_name">
                                <input type="text" class="form-control search_input" name="first_name_kana" placeholder="フリガナ(姓)" maxlength="16" />
                            </p>
                            <p class="search_name">
                                <input type="text" class="form-control search_input" name="last_name_kana" placeholder="フリガナ(名)" maxlength="16" />
                            </p>
                        </div>
                        <?php if(isset($_SESSION['check_error_message4'])): ?>
                            <p class="error_message"><?php echo $_SESSION['check_error_message4'] ?></p>
                        <?php elseif(isset($_SESSION['check_error_message5'])): ?>
                            <p class="error_message"><?php echo $_SESSION['check_error_message5'] ?></p>
                        <?php endif; ?>
                        <div class="search_form">
                            <div class="input-group">
                                <input type="text" id="calendar_to" class="form-control search_input search_date" name="to" placeholder="登録日(TO)"/>
                                <span class="input-group-addon"> ~ </span>
                                <input type="text" id="calendar_from" class="form-control search_input search_date" name="from" placeholder="登録日(FROM)"/>
                            </div>
                        </div>
                        <?php if(isset($_SESSION['check_error_message6'])): ?>
                            <p class="error_message"><?php echo $_SESSION['check_error_message6'] ?></p>
                        <?php elseif(isset($_SESSION['check_error_message7'])): ?>
                            <p class="error_message"><?php echo $_SESSION['check_error_message7'] ?></p>
                        <?php elseif(isset($_SESSION['check_error_message8'])): ?>
                            <p class="error_message"><?php echo $_SESSION['check_error_message8'] ?></p>
                        <?php elseif(isset($_SESSION['check_error_message9'])): ?>
                            <p class="error_message"><?php echo $_SESSION['check_error_message9'] ?></p>
                        <?php endif; ?>
                        <div class="form-group search_form button">
                            <input type="submit" class="btn btn-primary form-control" value="検索" />
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <?php if(isset($_SESSION['result_message'])): ?>
                    <div class="no_search_result_area">
                        <p class="no_search_result"><?php echo $_SESSION['result_message'] ?></p>
                    </div>
                <?php elseif(isset($_SESSION['user_info_list'])):?>
                    <!-- ユーザ情報一覧 -->
                    <table class="table table-striped sp_table">
                        <thead>
                            <tr>
                                <th>ユーザID</th>
                                <th>ユーザ名(姓)</th>
                                <th>ユーザ名(名)</th>
                                <th>ユーザ登録日</th>
                                <th>ユーザ更新日</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($_SESSION['user_info_list'] as $key => $value): ?>
                                <tr>
                                    <td data-label="ユーザID"><?php echo $value->getUserId(); ?></td>
                                    <td data-label="ユーザ名(姓)"><?php echo $value->getFirstName(); ?></td>
                                    <td data-label="ユーザ名(名)"><?php echo $value->getLastName(); ?></td>
                                    <td data-label="ユーザ登録日"><?php echo $value->getRegistDate(); ?></td>
                                    <td data-label="ユーザ更新日"><?php echo $value->getUpdateDate(); ?></td>
                                    <td>
                                        <form action="#" method="POST">
                                            <input type="hidden" name="id" value=<?php echo $value->getId(); ?> />
                                            <input type="hidden" name="mode" value="transition" />
                                            <input type="submit" class="btn btn-primary sp_button" name="update" value="編集" />
                                        </form>
                                    </td>
                                    <td>
                                        <form action="#" method="POST">
                                            <input type="hidden" name="id" value=<?php echo $value->getId(); ?> />
                                            <input type="hidden" name="mode" value="transition" />
                                            <input type="submit" class="btn btn-primary sp_button" name="deleate" value="削除" />
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
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
<?php unset($_SESSION["result_message"]); ?>
