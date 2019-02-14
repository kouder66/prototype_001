<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/15
 * Time: 1:34
 */
namespace App\Controller;

require_once('../config/PathConfig.php');


/** コントローラ呼び出し */
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    $CreateUserInfoController = new CreateUserInfoController();
    $CreateUserInfoController->transitionUserInfo();
}
else
{

}

/**
 * Class CreateUserInfoController
 * @package App\Controller
 */
class CreateUserInfoController
{
    /**
     * ユーザ登録画面へ遷移する関数
     * @return void
     */
    public function transitionUserInfo(): void
    {
        // ユーザ登録画面へ遷移
        header('Location: '.BASE_VIEW_PATH.'createUserInfoView.php');
        exit();
    }
}
