<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/14
 * Time: 22:37
 */
require_once('../config/DbConfig.php');


/**
 * Trait DbConnectTrait
 */
trait DbConnectTrait
{
    /**
     * DBの接続情報を取得する関数
     * @return PDO $db DB接続情報
     */
    public function dbConnectInfo()
    {
        try
        {
            // DB接続情報取得
            $db = new PDO(
                'mysql:dbname='.DB_DATABASE.';host='.DB_HOST.';charset=utf8',
                DB_USER_NAME,
                DB_PASSWORD
            );

            return $db;
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
    }
}
