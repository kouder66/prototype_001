<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/23
 * Time: 3:03
 */
namespace App\Service;


/**
 * Class LogoutService
 * @package App\Service
 */
class LogoutService
{
    /**
     * セッションを削除する関数
     * @return void
     */
    public static function destroySession(): void
    {
        // セッション開始
        session_start();
        // セッション変数を全て削除
        $_SESSION = array();
        // セッションの登録データを削除
        session_destroy();
    }
}
