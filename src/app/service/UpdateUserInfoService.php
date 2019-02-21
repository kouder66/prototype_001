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

require_once('../util/DataCheckTrait.php');
require_once('../util/InputCheckTrait.php');
require_once('../model/UpdateUserInfoModel.php');
require_once('../entity/UserInfoEntity.php');
require_once('../config/MessageConfig.php');


/** session start */
if(!isset($_SESSION))
{
    session_start();
}

/** エラーメッセージ関連のセッション削除 */
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
     * @return bool $result_user_info 更新するユーザ情報取得結果
     */
    public static function getUserInfo(string $id): bool
    {
        $result_user_info = false;

        $UpdateUserInfoModel = new UpdateUserInfoModel();
        $UserInfoEntity = $UpdateUserInfoModel->selectUserInfoById($id);

        if ($UserInfoEntity)
        {
            $_SESSION['user_info_entity'] = $UserInfoEntity;
            $result_user_info = true;
        }

        return $result_user_info;
    }

    /**
     * ユーザ情報更新を判定する関数
     * @return bool $result_update_user_info ユーザ情報更新結果
     */
    public function checkUpdateUserInfo(): bool
    {
        $result_update_user_info = false;

        // idチェック
        if (!isset($this->input_user_info['id']))
        {
            return $result_update_user_info;
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

        // ユーザ情報更新判定
        $UpdateUserInfoModel = new UpdateUserInfoModel();

        if ($UpdateUserInfoModel->updateUserInfo($UserInfoEntity))
        {
            // セッションに登録
            $_SESSION['title'] = TITLE2;
            $_SESSION['completion_message'] = COMPLETION_MESSAGE2;
            $_SESSION['completion_id'] = $UserInfoEntity->getUserId();

            // ログインユーザの場合、セッションを更新する
            if ($_SESSION['user_name'] === $UserInfoEntity->getFirstName().$UserInfoEntity->getLastName())
            {
                $_SESSION['user_name'] = $UserInfoEntity->getFirstName().$UserInfoEntity->getLastName();
            }

            $result_update_user_info = true;
        }

        return $result_update_user_info;
    }
}
