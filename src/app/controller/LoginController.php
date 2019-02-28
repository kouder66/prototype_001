<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/14
 * Time: 21:03
 */
namespace App\Controller;

use App\Service\LoginService;
use App\Service\SelectUserInfoListService;
use App\Util\PrototypeException;
use Exception;

require_once('../service/LoginService.php');
require_once('../config/PathConfig.php');
require_once('../service/SelectUserInfoListService.php');
require_once('../util/PrototypeException.php');


/** コントローラ呼び出し */
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    loginController::executeLogin($_POST['user_id'], $_POST['password']);
}

/**
 * Class loginController
 * @package App\Controller
 */
class LoginController
{
    /**
     * ログイン認証を実行する関数
     * @param string $user_id
     * @param string $password
     * @return void
     * @throws PrototypeException
     */
    public static function executeLogin(string $user_id, string $password): void
    {
        try
        {
            $LoginService = new LoginService($user_id, $password);

            // ログイン認証
            if ($LoginService->checkLogin())
            {
                // ユーザ情報一覧取得
                SelectUserInfoListService::getUserInfoList();

                // トップ画面へ遷移
                header('Location: '.BASE_VIEW_PATH.'userInfoListView.php');
                exit();
            }
            else
            {
                // エラーメッセージを表示
                header('Location: '.BASE_VIEW_PATH.'index.php');
                exit();
            }
        }
        catch (Exception $e)
        {
            throw new PrototypeException($e->getMessage(), $e->getCode());
        }
    }
}
