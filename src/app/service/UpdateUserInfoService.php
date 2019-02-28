<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/18
 * Time: 15:36
 */
namespace App\Service;

use App\Model\UpdateUserInfoModel;
use App\Entity\UserInfoEntity;
use Exception;
use App\Util\PrototypeException;

require_once('../util/DataCheckTrait.php');
require_once('../util/InputCheckTrait.php');
require_once('../model/UpdateUserInfoModel.php');
require_once('../entity/UserInfoEntity.php');
require_once('../config/MessageConfig.php');
require_once('../util/PrototypeException.php');


/**
 * Class UpdateUserInfoService
 * @package App\Service
 */
class UpdateUserInfoService
{
    use \DataCheckTrait;
    use \InputCheckTrait;

    // 入力されたユーザ情報
    private $input_user_info = array();

    /**
     * UpdateUserInfoService constructor.
     * @param array $input_user_info 入力されたユーザ情報
     */
    public function __construct($input_user_info)
    {
        $this->input_user_info = $input_user_info;
    }

    /**
     *　ユーザ情報取得を判定する関数
     * @param string $id id
     * @return void
     * @throws PrototypeException
     */
    public static function getUserInfo(string $id): void
    {
        try
        {
            // セッションスタート
            if (!isset($_SESSION))
            {
                session_start();
            }

            // idチェック
            if (!isset($id))
            {
                throw new PrototypeException('', 9999999);
            }

            $UpdateUserInfoModel = new UpdateUserInfoModel();
            $UserInfoEntity = $UpdateUserInfoModel->selectUserInfoById($id);

            if ($UserInfoEntity)
            {
                $_SESSION['user_info_entity'] = $UserInfoEntity;
            }
        }
        catch (Exception $e)
        {
            throw new PrototypeException($e->getMessage(), $e->getCode());
        }

        return;
    }

    /**
     * ユーザ情報更新を判定する関数
     * @return bool $result_update_user_info ユーザ情報更新結果
     * @throws PrototypeException
     */
    public function checkUpdateUserInfo(): bool
    {
        $result_update_user_info = false;

        try
        {
            // セッションスタート
            if (!isset($_SESSION))
            {
                session_start();
            }

            // エラーメッセージ関連のセッション削除
            unset($_SESSION['check_error_message1']);
            unset($_SESSION['check_error_message2']);
            unset($_SESSION['check_error_message3']);
            unset($_SESSION['check_error_message4']);
            unset($_SESSION['check_error_message5']);
            unset($_SESSION['check_error_message6']);
            unset($_SESSION['check_error_message7']);
            unset($_SESSION['check_error_message8']);
            unset($_SESSION['check_error_message9']);
            unset($_SESSION['check_error_message10']);
            unset($_SESSION['check_error_message11']);
            unset($_SESSION['check_error_message12']);
            unset($_SESSION['check_error_message13']);
            unset($_SESSION['check_error_message14']);
            unset($_SESSION['check_error_message15']);

            // idチェック
            if (!isset($this->input_user_info['id']))
            {
                throw new PrototypeException('', 9999999);
            }

            // HTMLエスケープ
            $this->checkXSS($this->input_user_info);

            // entityに各値を格納
            $UserInfoEntity = new UserInfoEntity();
            $UserInfoEntity->setId($this->input_user_info['id']);
            $UserInfoEntity->setPassword($this->input_user_info['password']);
            $UserInfoEntity->setCheckPassword($this->input_user_info['check_password']);
            $UserInfoEntity->setFirstName($this->input_user_info['first_name']);
            $UserInfoEntity->setLastName($this->input_user_info['last_name']);
            $UserInfoEntity->setFirstNameKana($this->input_user_info['first_name_kana']);
            $UserInfoEntity->setLastNameKana($this->input_user_info['last_name_kana']);
            $UserInfoEntity->setUserId($this->input_user_info['user_id']);

            // validation
            if ($this->InputCheck('update', $UserInfoEntity))
            {
                // パスワードhash化
                $UserInfoEntity->setPassword(hash('sha256', $UserInfoEntity->getPassword()));
                $UserInfoEntity->setUpdateDate(date('Y-m-d H:i:s'));
            }
            else
            {
                return $result_update_user_info;
            }

            $UpdateUserInfoModel = new UpdateUserInfoModel();

            // ユーザ情報更新判定
            if ($UpdateUserInfoModel->updateUserInfo($UserInfoEntity)) {
                // セッションに登録
                $_SESSION['title'] = TITLE2;
                $_SESSION['completion_message'] = COMPLETION_MESSAGE2;
                $_SESSION['completion_id'] = $UserInfoEntity->getId();
                $_SESSION['completion_user_id'] = $UserInfoEntity->getUserId();

                // ログインユーザの場合、セッションを更新する
                if ($_SESSION['id'] === $UserInfoEntity->getId()) {
                    $_SESSION['user_name'] = $UserInfoEntity->getFirstName() . $UserInfoEntity->getLastName();
                }

                $result_update_user_info = true;
            }
        }
        catch (Exception $e)
        {
            throw new PrototypeException($e->getMessage(), $e->getCode());
        }

        return $result_update_user_info;
    }
}
