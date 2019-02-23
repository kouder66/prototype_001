<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/15
 * Time: 18:12
 */
namespace App\Service;

use App\Entity\UserInfoEntity;
use App\Model\CreateUserInfoModel;
use App\Model\LoginModel;
use Exception;
use App\Util\PrototypeException;

require_once('../util/DataCheckTrait.php');
require_once('../util/InputCheckTrait.php');
require_once('../entity/UserInfoEntity.php');
require_once('../model/LoginModel.php');
require_once('../config/MessageConfig.php');
require_once('../model/CreateUserInfoModel.php');
require_once('../util/PrototypeException.php');


/**
 * Class CreateUserInfoService
 * @package App\Service
 */
class CreateUserInfoService
{
    use \DataCheckTrait;
    use \InputCheckTrait;

    // 入力されたユーザ情報
    private $input_user_info;

    /**
     * CreateUserInfoService constructor.
     * @param array $input_user_info 入力されたユーザ情報
     */
    public function __construct(array $input_user_info)
    {
        $this->input_user_info = $input_user_info;
    }

    /**
     * ユーザ情報登録を判定する関数
     * @return bool $result_create_user_info ユーザ情報登録結果
     * @throws PrototypeException
     */
    public function checkCreatUserInfo(): bool
    {
        $result_create_user_info = false;

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

            // HTMLエスケープ
            $this->checkXSS($this->input_user_info);

            // entityに各値を格納
            $UserInfoEntity = new UserInfoEntity();
            $UserInfoEntity->setUserId($this->input_user_info['user_id']);
            $UserInfoEntity->setPassword($this->input_user_info['password']);
            $UserInfoEntity->setCheckPassword($this->input_user_info['check_password']);
            $UserInfoEntity->setFirstName($this->input_user_info['first_name']);
            $UserInfoEntity->setLastName($this->input_user_info['last_name']);
            $UserInfoEntity->setFirstNameKana($this->input_user_info['first_name_kana']);
            $UserInfoEntity->setLastNameKana($this->input_user_info['last_name_kana']);

            // validation
            if ($this->InputCheck('create', $UserInfoEntity))
            {
                $now = date('Y-m-d H:i:s');

                // idはUUIDを設定
                $UserInfoEntity->setId(uniqid('',true));
                // パスワードhash化
                $UserInfoEntity->setPassword(hash('sha256', $UserInfoEntity->getPassword()));
                $UserInfoEntity->setRegistDate($now);
                $UserInfoEntity->setUpdateDate($now);
            }
            else
            {
                return $result_create_user_info;
            }

            $LoginModel = new LoginModel($UserInfoEntity->getUserId(), $UserInfoEntity->getPassword());

            // ユーザID存在チェック
            if ($LoginModel->selectUserId())
            {
                $_SESSION["check_error_message16"] = CHECK_ERROR_MESSAGE16;

                return $result_create_user_info;
            }

            $CreateUserInfoModel = new CreateUserInfoModel($UserInfoEntity);

            // ユーザ情報登録判定
            if ($CreateUserInfoModel->insertUserInfo())
            {
                // セッションに登録
                $_SESSION['title'] = TITLE1;
                $_SESSION['completion_message'] = COMPLETION_MESSAGE1;
                $_SESSION['completion_id'] = $UserInfoEntity->getId();
                $_SESSION['completion_user_id'] = $UserInfoEntity->getUserId();

                $result_create_user_info = true;
            }
        }
        catch (Exception $e)
        {
            throw new PrototypeException($e->getMessage(), $e->getCode());
        }

        return $result_create_user_info;
    }
}
