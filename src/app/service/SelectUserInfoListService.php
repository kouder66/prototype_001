<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/14
 * Time: 22:05
 */
namespace App\Service;

use App\Model\SelectUserInfoListModel;

require_once('../model/SelectUserInfoListModel.php');


/**
 * Class SelectUserInfoListService
 * @package App\Service
 */
class SelectUserInfoListService
{
    /**
     * ユーザ情報一覧取得を判定する関数
     * @return bool $result_user_info_list ユーザ情報一覧取得結果
     */
    public static function getUserInfoList(): bool
    {
        $result_user_info_list = false;

        // セッションスタート
        if (!isset($_SESSION))
        {
            session_start();
        }

        // エラーメッセージ関連のセッション削除
        unset($_SESSION['result_search_message']);

        // ユーザ情報一覧取得
        $SelectUserInfoListModel = new SelectUserInfoListModel();
        $user_info_list = $SelectUserInfoListModel->selectUserInfoList();

        if ($user_info_list)
        {
            // セッションに登録
            $_SESSION['user_info_list'] = $user_info_list;

            $result_user_info_list = true;
        }

        return $result_user_info_list;
    }
}
