<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/18
 * Time: 15:37
 */
namespace App\Model;

use UpdateUserInfoInterface;
use App\Entity\UserInfoEntity;
use PDO;
use PDOException;
use TypeError;
use Exception;
use App\Util\PrototypeException;

require_once('../interface/UpdateUserInfoInterface.php');
require_once('../util/DbConnectTrait.php');
require_once('../entity/UserInfoEntity.php');
require_once('../util/PrototypeException.php');


/**
 * Class UpdateUserInfoModel
 * @package App\Model
 */
class UpdateUserInfoModel implements UpdateUserInfoInterface
{
    use \DbConnectTrait;

    /**
     *　選択されたユーザ情報を取得する関数
     * @param string $id id
     * @return UserInfoEntity $UserInfoEntity ユーザ情報
     * @throws PrototypeException
     */
    public function selectUserInfoById(string $id): UserInfoEntity
    {
        $db = $this->dbConnectInfo();

        $UserInfoEntity = new UserInfoEntity();

        try
        {
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $sql = 'SELECT * FROM user_info WHERE id=:id';

            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);

            $stmt->execute();
            $user_info = $stmt->fetch(PDO::FETCH_ASSOC);

            // クエリ結果をエンティティに格納する
            $UserInfoEntity ->setId($user_info['id']);
            $UserInfoEntity ->setUserId($user_info['user_id']);
            $UserInfoEntity ->setFirstName($user_info['first_name']);
            $UserInfoEntity ->setLastName($user_info['last_name']);
            $UserInfoEntity ->setFirstNameKana($user_info['first_name_kana']);
            $UserInfoEntity ->setLastNameKana($user_info['last_name_kana']);
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

        return $UserInfoEntity;
    }

    /**
     * ユーザ情報を更新する関数
     * @param UserInfoEntity $UserInfoEntity
     * @return bool $result_update_user_info 更新判定結果
     * @throws PrototypeException
     */
    public function updateUserInfo(UserInfoEntity $UserInfoEntity): bool
    {
        $db = $this->dbConnectInfo();

        try
        {
            $db->beginTransaction();

            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $sql = 'UPDATE user_info SET password=:password, first_name=:first_name, last_name=:last_name, first_name_kana=:first_name_kana, last_name_kana=:last_name_kana, update_date=:update_date WHERE id=:id';

            $stm = $db->prepare($sql);

            // set句の設定
            $stm->bindValue(
                ':password',
                $UserInfoEntity->getPassword(),
                PDO::PARAM_STR
            );
            $stm->bindValue(
                ':first_name',
                $UserInfoEntity->getFirstName(),
                PDO::PARAM_STR
            );
            $stm->bindValue(
                ':last_name',
                $UserInfoEntity->getLastName(),
                PDO::PARAM_STR
            );
            $stm->bindValue(
                ':first_name_kana',
                $UserInfoEntity->getFirstNameKana(),
                PDO::PARAM_STR
            );
            $stm->bindValue(
                ':last_name_kana',
                $UserInfoEntity->getLastNameKana(),
                PDO::PARAM_STR
            );
            $stm->bindValue(
                ':update_date',
                $UserInfoEntity->getUpdateDate(),
                PDO::PARAM_STR
            );
            // where句の設定
            $stm->bindValue(
                ':id',
                $UserInfoEntity->getId(),
                PDO::PARAM_STR
            );

            $stm->execute();

            if ($stm->rowCount() === 1)
            {
                $db->commit();
                $result_update_user_info = true;
            }
            else
            {
                throw new PrototypeException('', 9999);
            }
        }
        catch (PDOException $e)
        {
            $db->rollback();

            throw new PrototypeException($e->getMessage(), $e->getCode());
        }
        catch (TypeError $e)
        {
            $db->rollback();

            throw new PrototypeException($e->getMessage(), $e->getCode());
        }
        catch (Exception $e)
        {
            $db->rollback();

            throw new PrototypeException($e->getMessage(), $e->getCode());
        }

        return $result_update_user_info;
    }
}
