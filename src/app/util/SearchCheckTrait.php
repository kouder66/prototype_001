<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/23
 * Time: 0:03
 */
use App\Entity\UserInfoEntity;
use App\Entity\SearchDateEntity;

require_once('../entity/UserInfoEntity.php');
require_once('../entity/SearchDateEntity.php');
require_once('../config/MessageConfig.php');


/**
 * Trait SearchCheckTrait
 */
trait SearchCheckTrait
{
    /**
     * 検索入力項目のバリデーションを行う関数
     * @param UserInfoEntity $UserInfoEntity ユーザ情報のエンティティ
     * @param SearchDateEntity $SearchDateEntity 検索日時のエンティティ
     * @return bool $result_validation バリデーション判定結果
     */
    public function searchCheck(UserInfoEntity $UserInfoEntity, SearchDateEntity $SearchDateEntity)
    {
        $result_validation = false;
        // チェックカウント
        $check_count = 0;

        // ユーザIDの半角英数字8桁チェック
        if (!is_null($UserInfoEntity->getUserId()))
        {
            if (mb_strlen($UserInfoEntity->getUserId()) != 8
                || !(preg_match("/^[a-zA-Z0-9]+$/", $UserInfoEntity->getUserId())))
            {
                $_SESSION['check_error_message1'] = CHECK_ERROR_MESSAGE2;
                $check_count++;
            }
        }
        // ユーザ名(姓)の桁数チェック
        if (!is_null($UserInfoEntity->getFirstName()))
        {
            if (mb_strlen($UserInfoEntity->getFirstName()) > 16)
            {
                $_SESSION['check_error_message2'] = CHECK_ERROR_MESSAGE4;
                $check_count++;
            }
        }
        // ユーザ名(名)の桁数チェック
        if (!is_null($UserInfoEntity->getLastName()))
        {
            if (mb_strlen($UserInfoEntity->getLastName()) > 16)
            {
                $_SESSION['check_error_message3'] = CHECK_ERROR_MESSAGE6;
                $check_count++;
            }
        }
        // フリガナ(姓)のカタカナ16桁チェック
        if (!is_null($UserInfoEntity->getFirstNameKana()))
        {
            if (mb_strlen($UserInfoEntity->getFirstNameKana()) > 16
                || !(preg_match("/^[ァ-ヶー]+$/u", $UserInfoEntity->getFirstNameKana())))
            {
                $_SESSION['check_error_message4'] = CHECK_ERROR_MESSAGE8;
                $check_count++;
            }
        }
        // フリガナ(姓)のカタカナ16桁チェック
        if (!is_null($UserInfoEntity->getLastNameKana()))
        {
            if (mb_strlen($UserInfoEntity->getLastNameKana()) > 16
                || !(preg_match("/^[ァ-ヶー]+$/u", $UserInfoEntity->getLastNameKana())))
            {
                $_SESSION['check_error_message5'] = CHECK_ERROR_MESSAGE10;
                $check_count++;
            }
        }

        // toが入力されて、fromが未入力の場合、toだけチェックする
        // fromが入力されて、toが未入力の場合、エラー扱いにする
        // toもfromも両方入力されている場合、toとfromをチェックする
        if ((!is_null($SearchDateEntity->getRegistDateTo()))
            && is_null($SearchDateEntity->getRegistDateFrom())) {
            // 日付のフォーマット変換
            $date_to = date('Y-m-d', strtotime($SearchDateEntity->getRegistDateTo()));

            // 日付の型チェック
            if (!(preg_match('/^([1-9][0-9]{3})\-(0[1-9]{1}|1[0-2]{1})\-(0[1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1})$/', $date_to)))
            {
                $_SESSION['check_error_message6'] = SEARCH_ERROR_MESSAGE1;
                $check_count++;
            }
        }
        else if (is_null($SearchDateEntity->getRegistDateTo())
            && !(is_null($SearchDateEntity->getRegistDateFrom())))
        {
            $_SESSION['check_error_message8'] = SEARCH_ERROR_MESSAGE3;
            $check_count++;
        }
        else if ((!is_null($SearchDateEntity->getRegistDateTo()))
            && (!is_null($SearchDateEntity->getRegistDateFrom())))
        {
            // 日付のフォーマット変換
            $date_to = date('Y-m-d', strtotime($SearchDateEntity->getRegistDateTo()));
            $date_from = date('Y-m-d', strtotime($SearchDateEntity->getRegistDateFrom()));

            // 登録日[to, from]
            $date_list = [$date_to, $date_from];

            foreach ($date_list as $value)
            {
                // 日付の型チェック
                if (!preg_match('/^([1-9][0-9]{3})\-(0[1-9]{1}|1[0-2]{1})\-(0[1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1})$/', $value))
                {
                    $_SESSION['check_error_message6'] = SEARCH_ERROR_MESSAGE1;
                    $check_count++;
                }
                // 未来日チェック
                if ($value > date("Y/m/d"))
                {
                    $_SESSION['check_error_message7'] = SEARCH_ERROR_MESSAGE2;
                    $check_count++;
                }
            }

            // 期間チェック
            if (!(isset($_SESSION['check_error_message6']) && $_SESSION['check_error_message7']))
            {
                // TOとFROM比較
                if ($date_list[1] <= $date_list[0])
                {
                    $_SESSION['check_error_message8'] = SEARCH_ERROR_MESSAGE3;
                    $check_count++;
                }
                // 期間チェック
                if ((strtotime($date_list[1]) - strtotime($date_list[0])) / ((60 * 60 * 24)) > 90) {
                    $_SESSION['check_error_message9'] = SEARCH_ERROR_MESSAGE4;
                    $check_count++;
                }
            }
        }

        // チェックカウントが0ではない場合、何かしらのバリエーションで引っかかっている為、falseを返す
        if (!$check_count)
        {
            $result_validation = true;
        }

        return $result_validation;
    }
}
