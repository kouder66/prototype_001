<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/22
 * Time: 1:07
 */
namespace App\Model;

use DeleteUserInfoInterface;
use PDO;
use PDOException;
use TypeError;
use Exception;
use App\Util\PrototypeException;

require_once('../interface/DeleteUserInfoInterface.php');
require_once('../util/DbConnectTrait.php');
require_once('../util/PrototypeException.php');


/**
 * Class DeleteUserInfoModel
 * @package App\Model
 */
class DeleteUserInfoModel implements DeleteUserInfoInterface
{
    use \DbConnectTrait;

    /**
     * ユーザ情報を削除する関数
     * @param string $id id
     * @return bool $result_delete_user_info 削除判定結果
     * @throws PrototypeException
     */
    public function deleteUserInfo(string $id): bool
    {
        $db = $this->dbConnectInfo();

        try
        {
            $db->beginTransaction();

            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $sql = 'DELETE FROM user_info WHERE id=:id';

            $stm = $db->prepare($sql);

            // where句の設定
            $stm->bindValue(
                ':id',
                $id,
                PDO::PARAM_STR
            );

            $stm->execute();

            if ($stm->rowCount() === 1)
            {
                $db->commit();
                $result_delete_user_info = true;
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

        return $result_delete_user_info;
    }
}
