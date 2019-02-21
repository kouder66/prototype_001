<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/22
 * Time: 1:06
 */
namespace App\Service;

use App\Model\DeleteUserInfoModel;

require_once('../entity/UserInfoEntity.php');
require_once('../model/DeleteUserInfoModel.php');
require_once('../config/MessageConfig.php');


/**
 * Class DeleteUserInfoService
 * @package App\Service
 */
class DeleteUserInfoService
{
    // id
    private $id;
    // ユーザID
    private $user_id;

    /**
     * DeleteUserInfoService constructor.
     * @param string $id id
     * @param string $user_id ユーザID
     */
    public function __construct(string $id, string $user_id)
    {
        $this->id = $id;
        $this->user_id = $user_id;
    }

    /**
     * ユーザ情報削除を判定する関数
     * @return bool $result_delete_user_info ユーザ情報削除結果
     */
    public function checkDeleteUserInfo(): bool
    {
        $result_delete_user_info = false;

        // id&ユーザIDチェック
        if (!(isset($this->id) || isset($this->user_id)))
        {
            return $result_delete_user_info;
        }

        // ユーザ情報削除判定
        $DeleteUserInfoModel = new DeleteUserInfoModel();

        if ($DeleteUserInfoModel->deleteUserInfo($this->id))
        {
            // セッションに登録
            $_SESSION['title'] = TITLE3;
            $_SESSION['completion_message'] = COMPLETION_MESSAGE3;
            $_SESSION['completion_id'] = $this->user_id;

            $result_delete_user_info = true;
        }

        return $result_delete_user_info;
    }
}
