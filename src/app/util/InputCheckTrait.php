<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/14
 * Time: 21:58
 */
use App\Entity\UserInfoEntity;

require_once('../entity/UserInfoEntity.php');
require_once('../config/MessageConfig.php');


/**
 * Trait InputCheckTrait
 */
trait InputCheckTrait
{
    /**
     * 入力項目のバリデーションを行う関数
     *
     * @param string $validation_mode バリエーション対象
     * @param  UserInfoEntity $UserInfoEntity ユーザ情報のエンティティ
     * @return bool $result_validation バリデーション判定結果
     */
    public function InputCheck(string $validation_mode, UserInfoEntity $UserInfoEntity): bool
    {
        // バリデーション判定結果
        $result_validation = false;
        // チェックカウント
        $check_count = 0;

        // ログイン時と新規登録時にチェック
        if ($validation_mode === 'login' || $validation_mode === 'create')
        {
            // ユーザIDチェック
            // ユーザIDの空チェック
            if (empty($UserInfoEntity->getUserId()))
            {
                $_SESSION['check_error_message1'] = CHECK_ERROR_MESSAGE1;
                $check_count++;
            }

            // ユーザIDの半角英数字8桁チェック
            if (mb_strlen($UserInfoEntity->getUserId()) != 8
                || !(preg_match("/^[a-zA-Z0-9]+$/", $UserInfoEntity->getUserId())))
            {
                $_SESSION['check_error_message2'] = CHECK_ERROR_MESSAGE2;
                $check_count++;
            }
        }

        // 新規登録時と更新時にチェック
        if ($validation_mode == 'create' || $validation_mode == 'update')
        {
            // ユーザ名(姓)チェック
            // ユーザ名(姓)の空チェック
            if (empty($UserInfoEntity->getFirstName()))
            {
                $_SESSION['check_error_message3'] = CHECK_ERROR_MESSAGE3;
                $check_count++;

            }
            // ユーザ名(姓)の桁数チェック
            else if (mb_strlen($UserInfoEntity->getFirstName()) > 16)
            {
                $_SESSION['check_error_message4'] = CHECK_ERROR_MESSAGE4;
                $check_count++;
            }

            // ユーザ名(名)チェック
            // ユーザ名(名)の空チェック
            if (empty($UserInfoEntity->getLastName())) {
                $_SESSION['check_error_message5'] = CHECK_ERROR_MESSAGE5;
                $check_count++;

            }
            // ユーザ名(名)の桁数チェック
            else if (mb_strlen($UserInfoEntity->getLastName()) > 16)
            {
                $_SESSION['check_error_message6'] = CHECK_ERROR_MESSAGE6;
                $check_count++;
            }

            // フリガナ(姓)チェック
            // フリガナ(姓)の空チェック
            if (empty($UserInfoEntity->getFirstNameKana()))
            {
                $_SESSION['check_error_message7'] = CHECK_ERROR_MESSAGE7;
                $check_count++;

            }
            // フリガナ(姓)のカタカナ16桁チェック
            else if (mb_strlen($UserInfoEntity->getFirstNameKana()) > 16
                || !(preg_match("/^[ァ-ヶー]+$/u", $UserInfoEntity->getFirstNameKana())))
            {
                $_SESSION['check_error_message8'] = CHECK_ERROR_MESSAGE8;
                $check_count++;
            }

            // フリガナ(名)チェック
            // フリガナ(名)の空チェック
            if (empty($UserInfoEntity->getLastNameKana()))
            {
                $_SESSION['check_error_message9'] = CHECK_ERROR_MESSAGE9;
                $check_count++;

            }
            // フリガナ(姓)のカタカナ16桁チェック
            else if (mb_strlen($UserInfoEntity->getLastNameKana()) > 16
                || !(preg_match("/^[ァ-ヶー]+$/u", $UserInfoEntity->getLastNameKana())))
            {
                $_SESSION['check_error_message10'] = CHECK_ERROR_MESSAGE10;
                $check_count++;
            }
        }

        // パスワードチェック(全モード対象)
        // パスワードの空チェック
        if (empty($UserInfoEntity->getPassword()))
        {
            $_SESSION['check_error_message11'] = CHECK_ERROR_MESSAGE11;
            $check_count++;
        }
        // パスワードの半角英数字8桁チェック
        else if (mb_strlen($UserInfoEntity->getPassword()) != 8
            || !(preg_match("/^[a-zA-Z0-9]+$/", $UserInfoEntity->getPassword())))
        {
            $_SESSION['check_error_message12'] = CHECK_ERROR_MESSAGE12;
            $check_count++;
        }

        // 新規登録時と更新時にチェック
        if ($validation_mode == 'create' || $validation_mode == 'update')
        {
            // 確認用パスワードチェック
            // 確認用パスワードの空チェック
            if (empty($UserInfoEntity->getCheckPassword()))
            {
                $_SESSION['check_error_message13'] = CHECK_ERROR_MESSAGE13;
                $check_count++;
            }
            // 確認用パスワードの半角英数字8桁チェック
            else if (mb_strlen($UserInfoEntity->getCheckPassword()) != 8
                || !(preg_match("/^[a-zA-Z0-9]+$/", $UserInfoEntity->getCheckPassword())))
            {
                $_SESSION['check_error_message14'] = CHECK_ERROR_MESSAGE14;
                $check_count++;
            }

            // パスワードと確認用パスワードの一致チェック
            if ($UserInfoEntity->getPassword() != $UserInfoEntity->getCheckPassword())
            {
                $_SESSION['check_error_message15'] = CHECK_ERROR_MESSAGE15;
                $check_count++;
            }
        }

        // チェックカウントが0ではない場合、何かしらのバリエーションで引っかかっている為、falseを返す
        if ($check_count === 0)
        {
            $result_validation = true;
        }

        return $result_validation;
    }
}
