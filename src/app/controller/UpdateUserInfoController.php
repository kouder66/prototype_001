<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/18
 * Time: 15:35
 */
namespace App\Controller;

use App\Service\UpdateUserInfoService;
use App\Util\PrototypeException;
use Exception;

require_once('../service/UpdateUserInfoService.php');
require_once('../config/PathConfig.php');
require_once('../util/PrototypeException.php');


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
     * @throws PrototypeException
     */
    public static function transitionUpdateUserInfo(string $id): void
    {
        try
        {
            // ユーザ情報一覧取得
            UpdateUserInfoService::getUserInfo($id);

            // ユーザ登録画面へ遷移
            header('Location: '.BASE_VIEW_PATH.'createUserInfoView.php');
            exit();
        }
        catch (Exception $e)
        {
            throw new PrototypeException($e->getMessage(), $e->getCode());
        }
    }

    /**
     *　ユーザ情報更新を実行する関数
     * @param array $input_user_info 入力されたユーザ情報
     * @return void
     * @throws PrototypeException
     */
    public static function executeUpdateUserInfo(array $input_user_info): void
    {
        try
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
        catch (Exception $e)
        {
            throw new PrototypeException($e->getMessage(), $e->getCode());
        }
    }
}
