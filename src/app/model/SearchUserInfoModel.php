<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/22
 * Time: 23:45
 */
namespace App\Model;

use SearchUserInfoInterface;
use App\Entity\UserInfoEntity;
use App\Entity\SearchDateEntity;
use PDO;
use PDOException;
use TypeError;
use Exception;
use App\Util\PrototypeException;

require_once('../interface/SearchUserInfoInterface.php');
require_once('../util/DbConnectTrait.php');
require_once('../entity/UserInfoEntity.php');
require_once('../entity/SearchDateEntity.php');
require_once('../util/PrototypeException.php');


/**
 * Class SearchUserInfoModel
 * @package App\Model
 */
class SearchUserInfoModel implements SearchUserInfoInterface
{
    use \DbConnectTrait;

    private $UserInfoEntity;
    private $SearchDateEntity;

    /**
     * SearchUserInfoModel constructor.
     * @param UserInfoEntity $UserInfoEntity ユーザ情報のエンティティ
     * @param SearchDateEntity $SearchDateEntity 検索日時のエンティティ
     */
    public function __construct(UserInfoEntity $UserInfoEntity, SearchDateEntity $SearchDateEntity)
    {
        $this->UserInfoEntity = $UserInfoEntity;
        $this->SearchDateEntity = $SearchDateEntity;
    }

    /**
     * 検索情報をもとにユーザ情報を取得する関数
     * @return mixed $user_info_list ユーザ情報一覧
     * @throws PrototypeException
     */
    public function selectSearchUserInfo()
    {
        $user_info_list = array();

        $db = $this->dbConnectInfo();

        try
        {
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            // 検索情報用連想配列を生成
            $search_world_list = array(
                'user_id'=>$this->UserInfoEntity->getUserId(),
                'first_name'=>$this->UserInfoEntity->getFirstName(),
                'last_name'=>$this->UserInfoEntity->getLastName(),
                'first_name_kana'=>$this->UserInfoEntity->getFirstNameKana(),
                'last_name_kana'=>$this->UserInfoEntity->getLastNameKana(),
                'regist_date'=>[
                    $this->SearchDateEntity->getRegistDateTo(),
                    $this->SearchDateEntity->getRegistDateFrom()
                ]
            );

            // where句クエリ生成用配列
            $query_set_where = array();

            // where句の生成
            foreach ($search_world_list as $key => $value)
            {
                // null以外はwhere句を生成する
                if (!is_null($value))
                {
                    // 登録日以外はカラム名=値の形を生成する
                    if (is_string($value))
                    {
                        // Where句を生成する
                        $set_where = $key .' = :' .$key;
                        // クエリ生成用配列に設定
                        $query_set_where[] = $set_where;
                    }
                    else if (count($value) == 2)
                    {
                        if (!(is_null($value[0])) && is_null($value[1]))
                        {
                            // toのみ入力されている場合はDATE_FORMATの形を生成する
                            $set_where = '(DATE_FORMAT(regist_date, "%Y-%m-%d") = :regist_date)';
                            $query_set_where[] = $set_where;
                        }
                        if (!(is_null($value[0])) && !(is_null($value[1])))
                        {
                            // toとfromが入っているとき、範囲を設定する
                            $set_where = 'regist_date BETWEEN :regist_date_to AND :regist_date_from';
                            $query_set_where[] = $set_where;
                        }
                    }
                }
            }

            // 検索フォームに何も入力されていない場合は、where句なしのクエリを設定する
            if (empty($query_set_where))
            {
                $sql = 'SELECT * FROM user_info';

                $stmt = $db->prepare($sql);
            }
            else
            {
                // where句部分のクエリを生成する
                $where = implode(' AND ', $query_set_where);

                $sql = 'SELECT * FROM user_info WHERE ' .$where;

                $stmt = $db->prepare($sql);

                // where句の設定
                foreach ($search_world_list as $key => $value)
                {
                    // null以外はwhere句を設定する
                    if(!is_null($value))
                    {
                        if(is_string($value))
                        {
                            // where句に値をセットする
                            $stmt->bindValue(':' .$key, $value, PDO::PARAM_STR);
                        }
                        else if (count($value) == 2)
                        {
                            // toのみ入力されている場合はwhere句に値をセットするだけ
                            if (!(is_null($value[0])) && is_null($value[1]))
                            {
                                $stmt->bindValue(':regist_date', date('Y-m-d', strtotime($value[0])), PDO::PARAM_STR);
                            }
                            // toとfromが入っている場合は範囲を設定する
                            if ((!is_null($value[0])) && !(is_null($value[1])))
                            {
                                $stmt->bindValue(':regist_date_to', date('Y-m-d H:i:s', strtotime($value[0])), PDO::PARAM_STR);
                                $stmt->bindValue(':regist_date_from', date('Y-m-d H:i:s', strtotime($value[1])), PDO::PARAM_STR);
                            }
                        }
                    }
                }
            }

            $stmt->execute();

            $search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // クエリ結果から各カラムをエンティティに格納
            foreach ($search_result as $row)
            {
                $UserInfoEntity = new UserInfoEntity();

                $UserInfoEntity->setId($row['id']);
                $UserInfoEntity->setUserId($row['user_id']);
                $UserInfoEntity->setFirstName($row['first_name']);
                $UserInfoEntity->setLastName($row['last_name']);
                $UserInfoEntity->setRegistDate($row['regist_date']);
                $UserInfoEntity->setUpdateDate($row['update_date']);

                $user_info_list[] = $UserInfoEntity;
            }
        }
        catch (PDOException $e)
        {
            throw new PrototypeException($e->getMessage(), $e->getCode());
        }
        catch (TypeError $e)
        {
            throw new PrototypeException($e->getMessage(), $e->getCode());
        }
        catch (Exception $e)
        {
            throw new PrototypeException($e->getMessage(), $e->getCode());
        }

        return $user_info_list;
    }
}
