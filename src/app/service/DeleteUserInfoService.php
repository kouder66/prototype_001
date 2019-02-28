<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/22
 * Time: 1:06
 */
namespace App\Service;

use App\Model\DeleteUserInfoModel;
use Exception;
use App\Util\PrototypeException;

require_once('../entity/UserInfoEntity.php');
require_once('../model/DeleteUserInfoModel.php');
require_once('../config/MessageConfig.php');
require_once('../util/PrototypeException.php');
require_once('../util/PrototypeException.php');


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
     * @return void
     * @throws PrototypeException
     */
    public function checkDeleteUserInfo(): void
    {
        try
        {
            // セッションスタート
            if (!isset($_SESSION))
            {
                session_start();
            }

            // id&ユーザIDチェック
            if (!(isset($this->id) || isset($this->user_id)))
            {
                throw new PrototypeException('', 999999);
            }

            $DeleteUserInfoModel = new DeleteUserInfoModel();

            // ユーザ情報削除判定
            if ($DeleteUserInfoModel->deleteUserInfo($this->id))
            {
                // セッションに登録
                $_SESSION['title'] = TITLE3;
                $_SESSION['completion_message'] = COMPLETION_MESSAGE3;
                $_SESSION['completion_id'] = $this->id;
                $_SESSION['completion_user_id'] = $this->user_id;
            }
        }
        catch (Exception $e)
        {
            throw new PrototypeException($e->getMessage(), $e->getCode());
        }

        return;
    }
}
