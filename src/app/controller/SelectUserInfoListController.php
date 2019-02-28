<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/14
 * Time: 22:01
 */
namespace App\Controller;

use App\Service\SelectUserInfoListService;
use App\Util\PrototypeException;
use Exception;

require_once('../service/SelectUserInfoListService.php');
require_once('../config/PathConfig.php');
require_once('../util/PrototypeException.php');


/** コントローラ呼び出し */
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    SelectUserInfoListController::executeSelectUserInfoList();
}

/**
 * Class SelectUserInfoListController
 * @package App\Controller
 */
class SelectUserInfoListController
{
    /**
     * ユーザ一覧取得を実行する関数
     * @return void
     * @throws PrototypeException
     */
    public static function executeSelectUserInfoList(): void
    {
        try
        {
            // ユーザ情報一覧取得
            SelectUserInfoListService::getUserInfoList();

            // トップ画面へ遷移
            header('Location: '.BASE_VIEW_PATH.'userInfoListView.php');
            exit();
        }
        catch (Exception $e)
        {
            throw new PrototypeException($e->getMessage(), $e->getCode());
        }
    }
}
