<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/14
 * Time: 22:10
 */
namespace App\Model;

use SelectUserInfoListInterface;
use PDO;
use App\Entity\UserInfoEntity;
use PDOException;
use TypeError;
use Exception;

require_once('../interface/SelectUserInfoListInterface.php');
require_once('../util/DbConnectTrait.php');
require_once('../entity/UserInfoEntity.php');


/**
 * Class SelectUserInfoListModel
 * @package App\Model
 */
class SelectUserInfoListModel implements SelectUserInfoListInterface
{
    use \DbConnectTrait;

    /**
     * ユーザ情報一覧を取得する関数
     * @return mixed $user_info_list ユーザ情報一覧
     */
    public function selectUserInfoList()
    {
        $user_info_list= array();

        $db = $this->dbConnectInfo();

        try
        {
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $sql = 'SELECT * FROM user_info ORDER BY update_date DESC';

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $get_user_info_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // クエリ結果から各カラムをエンティティに格納
            foreach ($get_user_info_list as $get_user_info)
            {
                $UserInfoEntity = new UserInfoEntity();
                // id
                $UserInfoEntity->setId($get_user_info['id']);
                // ユーザID
                $UserInfoEntity->setUserId($get_user_info['user_id']);
                // パスワード
                $UserInfoEntity->setPassword($get_user_info['password']);
                // ユーザ名(姓)
                $UserInfoEntity->setFirstName($get_user_info['first_name']);
                // ユーザ名(名)
                $UserInfoEntity->setLastName($get_user_info['last_name']);
                // フリガナ(姓)
                $UserInfoEntity->setFirstNameKana($get_user_info['first_name_kana']);
                // フリガナ(名)
                $UserInfoEntity->setLastNameKana($get_user_info['last_name_kana']);
                // ユーザ登録日
                $UserInfoEntity->setRegistDate($get_user_info['regist_date']);
                // ユーザ更新日
                $UserInfoEntity->setUpdateDate($get_user_info['update_date']);

                // ユーザ情報を格納
                $user_info_list[] = $UserInfoEntity;
            }
        }
        catch (PDOException $e)
        {
            echo $e->getCode().PHP_EOL;
            echo $e->getMessage().PHP_EOL;
        }
        catch (TypeError $e)
        {
            echo $e->getCode().PHP_EOL;
            echo $e->getMessage().PHP_EOL;
        }
        catch (Exception $e)
        {
            echo $e->getCode().PHP_EOL;
            echo $e->getMessage().PHP_EOL;
        }

        return $user_info_list;
    }
}
