<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/15
 * Time: 1:34
 */
namespace App\Controller;

use App\Service\CreateUserInfoService;

require_once('../config/PathConfig.php');
require_once('../service/CreateUserInfoService.php');


/** コントローラ呼び出し */
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    CreateUserInfoController::transitionCreateUserInfo();
}
else
{
    $CreateUserInfoController = new CreateUserInfoController();
    $CreateUserInfoController->executeCreateUserInfo($_POST);
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
        // ユーザ登録画面へ遷移
        header('Location: '.BASE_VIEW_PATH.'createUserInfoView.php');
        exit();
    }

    /**
     * ユーザ情報登録を実行する関数
     * @param array $input_user_info
     * @return void
     */
    public function executeCreateUserInfo(array $input_user_info): void
    {
        $CreateUserInfoService = new CreateUserInfoService($input_user_info);

        if ($CreateUserInfoService->checkCreatUserInfo())
        {
            // 登録完了画面を表示
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
}
