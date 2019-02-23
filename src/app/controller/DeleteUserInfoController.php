<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/19
 * Time: 23:43
 */
namespace App\Controller;

use App\Service\UpdateUserInfoService;
use App\Service\DeleteUserInfoService;

require_once('../service/UpdateUserInfoService.php');
require_once('../service/DeleteUserInfoService.php');
require_once('../config/PathConfig.php');


/** コントローラ呼び出し */
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    DeleteUserInfoController::transitionDeleteUserInfo($_GET['id']);
}
else
{
    DeleteUserInfoController::executeDeleteUserInfo($_POST['id'], $_POST['user_id']);
}

/**
 * Class DeleteUserInfoController
 * @package App\Controller
 */
class DeleteUserInfoController
{
    /**
     * ユーザ情報削除画面へ遷移する関数
     * @param string $id id
     * @return void
     */
    public static function transitionDeleteUserInfo(string $id): void
    {
        // ユーザ情報取得
        if (UpdateUserInfoService::getUserInfo($id))
        {
            // ユーザ情報削除画面へ遷移
            header('Location: '.BASE_VIEW_PATH.'deleteUserInfoView.php');
            exit();
        }
        else
        {
            header('Location: '.BASE_VIEW_PATH.'userInfoListView.php');
            exit();
        }
    }

    /**
     * ユーザ情報削除を実行する関数
     * @param string $id id
     * @param string $user_id ユーザID
     * @return void
     */
    public static function executeDeleteUserInfo(string $id, $user_id): void
    {
        // ユーザ情報削除
        $DeleteUserInfoService = new DeleteUserInfoService($id, $user_id);
        $DeleteUserInfoService->checkDeleteUserInfo();

        // 削除完了画面へ遷移
        header('Location: '.BASE_VIEW_PATH.'completionView.php');
        exit();
    }
}
