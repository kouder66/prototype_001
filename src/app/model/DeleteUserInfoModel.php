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

require_once('../interface/DeleteUserInfoInterface.php');
require_once('../util/DbConnectTrait.php');


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
     */
    public function deleteUserInfo(string $id): bool
    {
        $result_delete_user_info = false;

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
                throw new Exception();
            }
        }
        catch (PDOException $e)
        {
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

        return $result_delete_user_info;
    }
}
