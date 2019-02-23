<?php if (!isset($_SESSION)) { session_start(); } ?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <a class="navbar-brand text-light" href="../../../app/controller/SelectUserInfoListController.php">PHPCRUDプロトタイプ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light header_menu" href="../../../app/controller/CreateUserInfoController.php">ユーザ登録</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light header_menu" href="../../../app/controller/LogoutController.php">ログアウト</a>
                </li>
            </ul>
            <div class="navbar-nav">
                <?php if(isset($_SESSION['id'])): ?>
                    <a class="nav-link text-light mr-sm-2" href="../../../app/controller/UpdateUserInfoController.php?id=<?php echo $_SESSION['id'] ?>"><?php echo "ようこそ！！ ".$_SESSION["user_name"]."様！！" ?></a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>
