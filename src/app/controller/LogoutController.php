<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/14
 * Time: 23:05
 */
namespace App\Controller;

require_once('../config/PathConfig.php');


/** セッション開始 */
session_start();
/** セッション変数を全て削除 */
$_SESSION = array();
/** セッションの登録データを削除 */
session_destroy();

/** コントローラ呼び出し */
if($_SERVER['REQUEST_METHOD'] === 'GET')
{
    $LogoutController = new LogoutController();
    $LogoutController->transitionLogout();
}

/**
 * Class LogoutController
 * @package App\Controller
 */
class LogoutController
{
    /**
     * ログアウトを行う関数
     * @return void
     */
    public function transitionLogout(): void
    {
        // トップ画面へ遷移
        header('Location: '.BASE_VIEW_PATH.'index.php');
        exit();
    }
}
