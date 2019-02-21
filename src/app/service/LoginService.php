<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/14
 * Time: 21:20
 */
namespace App\Service;

use App\Entity\UserInfoEntity;
use App\Model\LoginModel;

require_once('../util/InputCheckTrait.php');
require_once('../entity/UserInfoEntity.php');
require_once('../model/LoginModel.php');
require_once('../config/MessageConfig.php');


/** セッションが存在してない場合、セッションスタート */
if (!isset($_SESSION))
{
    session_start();
}

/** エラーメッセージ関連のセッションの初期化 */
unset($_SESSION['check_error_message1']);
unset($_SESSION['check_error_message2']);
unset($_SESSION['check_error_message11']);
unset($_SESSION['check_error_message12']);

/**
 * Class LoginService
 * @package App\Service
 */
class LoginService
{
    use \InputCheckTrait;

    /** フィールド情報 */
    private $user_id;
    private $password;

    /**
     * loginController constructor.
     * @param string $user_id ユーザID
     * @param string $password パスワード
     */
    public function __construct(string $user_id, string $password)
    {
        $this->user_id = $user_id;
        $this->password = $password;
    }

    /**
     * ログイン認証を判定する関数
     * @throws
     * @return bool $result_login ログイン認証結果
     */
    public function checkLogin(): bool
    {
        $result_login = false;

        // entityに各値を格納する
        $UserInfoEntity = new UserInfoEntity();
        $UserInfoEntity->setUserId($this->user_id);
        $UserInfoEntity->setPassword($this->password);

        // バリデーション結果がfalseの場合、ログイン認証結果はfalseを返す
        if (!$this->InputCheck('login', $UserInfoEntity))
        {
            return $result_login;
        }

        // パスワードhash化
        $UserInfoEntity->setPassword(hash('sha256', $UserInfoEntity->getPassword()));

        $LoginModel = new LoginModel($UserInfoEntity->getUserId(), $UserInfoEntity->getPassword());

        // ユーザID存在チェック
        if ($LoginModel->selectUserId() !== 1)
        {
            // エラーメッセージを設定
            $_SESSION['login_error_message'] = LOGIN_ERROR_MESSAGE1;

            return $result_login;
        }

        // ユーザ情報取得
        $user_info = $LoginModel->selectUserInfo();

        if ($user_info)
        {
            // idをセッションに設定
            $_SESSION['id'] = $user_info['id'];
            // ユーザ名を設定
            $_SESSION['user_name'] = $user_info['first_name'].$user_info['last_name'];

            $result_login = true;
        }
        else
        {
            $_SESSION['login_error_message'] = LOGIN_ERROR_MESSAGE2;

            return $result_login;
        }

        return $result_login;
    }
}
