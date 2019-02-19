<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/19
 * Time: 23:43
 */
namespace App\Controller;

use App\Service\UpdateUserInfoService;

require_once('../service/UpdateUserInfoService.php');
require_once('../config/PathConfig.php');


/** コントローラ呼び出し */
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    var_dump($_GET['id']);
    DeleteUserInfoController::transitionDeleteUserInfo($_GET['id']);
}
else
{
    DeleteUserInfoController::executeDeleteUserInfo($_POST['id']);
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
        if (UpdateUserInfoService::getUserInfo($id))
        {
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
     * @return void
     */
    public static function executeDeleteUserInfo(string $id): void
    {

    }
}
