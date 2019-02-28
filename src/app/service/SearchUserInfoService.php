<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/22
 * Time: 23:45
 */
namespace App\Service;

use App\Entity\SearchDateEntity;
use App\Entity\UserInfoEntity;
use App\Model\SearchUserInfoModel;
use Exception;
use App\Util\PrototypeException;

require_once('../util/DataCheckTrait.php');
require_once('../util/SearchCheckTrait.php');
require_once('../model/SearchUserInfoModel.php');
require_once('../config/MessageConfig.php');
require_once('../util/PrototypeException.php');


/**
 * Class SearchUserInfoService
 * @package App\Service
 */
class SearchUserInfoService
{
    use \DataCheckTrait;
    use \SearchCheckTrait;

    // 検索情報
    private $search_info;

    /**
     * SearchUserInfoService constructor.
     * @param array $search_info 検索情報
     */
    public function __construct(array $search_info)
    {
        $this->search_info = $search_info;
    }

    /**
     * ユーザ情報検索を判定する関数
     * @return void
     * @throws PrototypeException
     */
    public function checkSearchWold(): void
    {
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
            unset($_SESSION['result_search_message']);

            // HTMLエスケープ
            $this->search_info = $this->checkXSS($this->search_info);

            // entityに各値を格納する
            $UserInfoEntity = new UserInfoEntity();
            $SearchDateEntity = new SearchDateEntity();

            if (!empty($this->search_info['user_id']))
            {
                $UserInfoEntity->setUserId($this->search_info['user_id']);
            }
            if (!empty($this->search_info['first_name']))
            {
                $UserInfoEntity->setFirstName($this->search_info['first_name']);
            }
            if (!empty($this->search_info['last_name']))
            {
                $UserInfoEntity->setLastName($this->search_info['last_name']);
            }
            if (!empty($this->search_info['first_name_kana']))
            {
                $UserInfoEntity->setFirstNameKana($this->search_info['first_name_kana']);
            }
            if (!empty($this->search_info['last_name_kana']))
            {
                $UserInfoEntity->setLastNameKana($this->search_info['last_name_kana']);
            }
            // 登録日(to)
            if (!empty($this->search_info['to']))
            {
                $SearchDateEntity->setRegistDateTO($this->search_info['to']);
            }
            // 登録日(from)
            if (!empty($this->search_info['from']))
            {
                $SearchDateEntity->setRegistDateFrom($this->search_info['from']);
            }

            // validation
            if (!$this->searchCheck($UserInfoEntity, $SearchDateEntity))
            {
                return;
            }

            // ユーザ情報を検索
            $SearchUserInfoModel = new SearchUserInfoModel($UserInfoEntity, $SearchDateEntity);

            $user_info_list = $SearchUserInfoModel->selectSearchUserInfo();

            // セッションに登録
            if ($user_info_list)
            {
                $_SESSION['user_info_list'] = $user_info_list;
            }
            else
            {
                $_SESSION['result_search_message'] = RESULT_SEARCH_MESSAGE;
            }
        }
        catch (Exception $e)
        {
            throw new PrototypeException($e->getMessage(), $e->getCode());
        }

        return;
    }
}
