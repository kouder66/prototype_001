<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/18
 * Time: 15:35
 */
namespace App\Controller;

use App\Service\UpdateUserInfoService;

require_once('../service/UpdateUserInfoService.php');
require_once('../config/PathConfig.php');


/** コントローラ呼び出し */
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    UpdateUserInfoController::transitionUpdateUserInfo($_GET['id']);
}
else
{
    UpdateUserInfoController::executeUpdateUserInfo($_POST);
}

/**
 * Class UpdateUserInfoController
 * @package App\Controller
 */
class UpdateUserInfoController
{
    /**
     * ユーザ更新画面へ遷移する関数
     * @param string $id id
     * @return void
     */
    public static function transitionUpdateUserInfo(string $id): void
    {
        // ユーザ情報一覧取得
        if (UpdateUserInfoService::getUserInfo($id))
        {
            // ユーザ登録画面へ遷移
            header('Location: '.BASE_VIEW_PATH.'createUserInfoView.php');
            exit();
        }
        else
        {
            // ユーザ情報一覧画面へ遷移
            header('Location: '.BASE_VIEW_PATH.'userInfoListView.php.php');
            exit();
        }
    }

    /**
     *　ユーザ情報更新を実行する関数
     * @param array $input_user_info 入力されたユーザ情報
     * @return void
     */
    public static function executeUpdateUserInfo(array $input_user_info): void
    {
        $UpdateUserInfoService = new UpdateUserInfoService($input_user_info);

        // ユーザ情報更新
        if ($UpdateUserInfoService->checkUpdateUserInfo())
        {
            // 更新完了画面へ遷移
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
