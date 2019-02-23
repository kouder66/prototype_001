<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/14
 * Time: 23:05
 */
namespace App\Controller;

use App\Service\LogoutService;

require_once('../config/PathConfig.php');
require_once('../service/LogoutService.php');


/** コントローラ呼び出し */
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    LogoutController::executeLogout();
}

/**
 * Class LogoutController
 * @package App\Controller
 */
class LogoutController
{
    /**
     * ログインアウトを実行する関数
     * @return void
     */
    public static function executeLogout(): void
    {
        // セッション削除
        LogoutService::destroySession();

        // トップ画面へ遷移
        header('Location: '.BASE_VIEW_PATH.'index.php');
        exit();
    }
}
