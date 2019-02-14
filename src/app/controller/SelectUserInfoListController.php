<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/14
 * Time: 22:01
 */
namespace App\Controller;

use App\Service\SelectUserInfoListService;

require_once('../service/SelectUserInfoListService.php');
require_once('../config/PathConfig.php');


/** コントローラ呼び出し */
if($_SERVER['REQUEST_METHOD'] === 'GET')
{
    $SelectUserInfoListController = new SelectUserInfoListController();
    $SelectUserInfoListController->executeSelectUserInfoList();
}

/**
 * Class SelectUserInfoListController
 * @package App\Controller
 */
class SelectUserInfoListController
{
    /**
     * ユーザ一覧取得を判定する関数
     * @return void
     */
    public function executeSelectUserInfoList(): void
    {
        $SelectUserInfoListService = new SelectUserInfoListService();

        if ($SelectUserInfoListService->getUserInfoList())
        {
            // トップ画面へ遷移
            header('Location: '.BASE_VIEW_PATH.'userInfoListView.php');
            exit();
        }
    }
}
