<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/22
 * Time: 23:44
 */
namespace App\Controller;

use App\Service\SearchUserInfoService;
use App\Util\PrototypeException;
use Exception;

require_once('../service/SearchUserInfoService.php');
require_once('../config/PathConfig.php');
require_once('../util/PrototypeException.php');


/** コントローラ呼び出し */
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    SearchUserInfoController::executeSearchUserInfo($_POST);
}

/**
 * Class SearchUserInfoController
 * @package App\Controller
 */
class SearchUserInfoController
{
    /**
     * ユーザ情報を検索を実行する関数
     * @param array $search_info 検索情報
     * @return void
     * @throws PrototypeException
     */
    public static function executeSearchUserInfo(array $search_info): void
    {
        try
        {
            // ユーザ情報一覧取得
            $SearchUserInfoService = new SearchUserInfoService($search_info);
            $SearchUserInfoService->checkSearchWold();

            // ユーザ情報一覧画面へ遷移
            header('Location: '.BASE_VIEW_PATH.'userInfoListView.php');
            exit();
        }
        catch (Exception $e)
        {
            throw new PrototypeException($e->getMessage(), $e->getCode());
        }
    }
}
