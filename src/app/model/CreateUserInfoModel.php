<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/15
 * Time: 18:12
 */
namespace App\Model;

use CreateUserInfoInterface;
use App\Entity\UserInfoEntity;
use PDO;
use PDOException;
use TypeError;
use Exception;

require_once('../interface/CreateUserInfoInterface.php');
require_once('../util/DbConnectTrait.php');
require_once('../entity/UserInfoEntity.php');


/**
 * Class CreateUserInfoModel
 * @package App\Model
 */
class CreateUserInfoModel implements CreateUserInfoInterface
{
    use \DbConnectTrait;

    // 入力されたユーザ情報
    private $UserInfoEntity;

    /**
     * CreateUserInfoModel constructor.
     * @param UserInfoEntity $UserInfoEntity
     */
    public function __construct(UserInfoEntity $UserInfoEntity)
    {
        $this->UserInfoEntity = $UserInfoEntity;
    }

    /**
     * ユーザ情報を登録する関数
     * @return bool $result_insert_user_info 登録判定結果
     */
    public function insertUserInfo(): bool
    {
        $result_insert_user_info = false;

        $db = $this->dbConnectInfo();

        try {
            // トランザクション開始
            $db->beginTransaction();

            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $sql = 'INSERT INTO user_info (id, user_id, password, first_name, last_name, first_name_kana, last_name_kana, regist_date, update_date ) values (:id, :user_id, :password, :first_name, :last_name, :first_name_kana, :last_name_kana, :regist_date, :update_date )';

            $stm = $db->prepare($sql);

            // valuesの設定
            $stm->bindValue(
                ':id',
                $this->UserInfoEntity->getId(),
                PDO::PARAM_STR
            );
            $stm->bindValue(
                ':user_id',
                $this->UserInfoEntity->getUserId(),
                PDO::PARAM_STR
            );
            $stm->bindValue(
                ':password',
                $this->UserInfoEntity->getPassword(),
                PDO::PARAM_STR
            );
            $stm->bindValue(
                ':first_name',
                $this->UserInfoEntity->getFirstName(),
                PDO::PARAM_STR
            );
            $stm->bindValue(
                ':last_name',
                $this->UserInfoEntity->getLastName(),
                PDO::PARAM_STR
            );
            $stm->bindValue(
                ':first_name_kana',
                $this->UserInfoEntity->getFirstNameKana(),
                PDO::PARAM_STR
            );
            $stm->bindValue(
                ':last_name_kana',
                $this->UserInfoEntity->getLastNameKana(),
                PDO::PARAM_STR
            );
            $stm->bindValue(
                ':regist_date',
                $this->UserInfoEntity->getRegistDate(),
                PDO::PARAM_STR
            );
            $stm->bindValue(
                ':update_date',
                $this->UserInfoEntity->getUpdateDate(),
                PDO::PARAM_STR
            );

            $stm->execute();

            // 実行結果の確認
            if ($stm->rowCount() === 1)
            {
                // コミット
                $db->commit();
                $result_insert_user_info = true;
            }
            else
            {
                throw new Exception();
            }
        }
        catch (PDOException $e)
        {
            // ロールバック
            $db->rollback();

            echo $e->getCode().PHP_EOL;
            echo $e->getMessage().PHP_EOL;
        }
        catch (TypeError $e)
        {
            $db->rollback();

            echo $e->getCode().PHP_EOL;
            echo $e->getMessage().PHP_EOL;
        }
        catch (Exception $e)
        {
            $db->rollback();

            echo $e->getCode().PHP_EOL;
            echo $e->getMessage().PHP_EOL;
        }

        return $result_insert_user_info;
    }
}
