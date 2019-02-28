<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/15
 * Time: 1:34
 */
namespace App\Controller;

use App\Service\CreateUserInfoService;
use App\Util\PrototypeException;
use Exception;

require_once('../config/PathConfig.php');
require_once('../service/CreateUserInfoService.php');
require_once('../util/PrototypeException.php');


/** コントローラ呼び出し */
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    CreateUserInfoController::transitionCreateUserInfo();
}
else
{
    CreateUserInfoController::executeCreateUserInfo($_POST);
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
    public static function transitionCreateUserInfo(): void
    {
        // セッションスタート
        if (!isset($_SESSION))
        {
            session_start();
        }

        // エンティティのセッション削除
        unset($_SESSION['user_info_entity']);

        // ユーザ登録画面へ遷移
        header('Location: '.BASE_VIEW_PATH.'createUserInfoView.php');
        exit();
    }

    /**
     * ユーザ情報登録を実行する関数
     * @param array $input_user_info 入力されたユーザ情報
     * @return void
     * @throws PrototypeException
     */
    public static function executeCreateUserInfo(array $input_user_info): void
    {
        try
        {
            $CreateUserInfoService = new CreateUserInfoService($input_user_info);

            // ユーザ情報登録
            if ($CreateUserInfoService->checkCreatUserInfo())
            {
                // 登録完了画面へ遷移
                header('Location: '.BASE_VIEW_PATH.'completionView.php');
                exit();
            }
            else
            {
                // エラーメッセージを表示
                header('Location: '.BASE_VIEW_PATH.'createUserInfoView.php');
                exit();
            }
        }
        catch (Exception $e)
        {
            throw new PrototypeException($e->getMessage(), $e->getCode());
        }
    }
}
