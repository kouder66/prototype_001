<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/14
 * Time: 22:26
 */
namespace App\Model;

use LoginInterface;
use PDO;
use PDOException;
use TypeError;
use Exception;

require_once('../interface/LoginInterface.php');
require_once('../util/DbConnectTrait.php');


/**
 * Class LoginModel
 * @package app\model
 */
class LoginModel implements LoginInterface
{
    use \DbConnectTrait;

    /** フィールド情報 */
    private $user_id;
    private $password;

    /**
     * LoginModel constructor.
     * @param string $user_id ユーザID
     * @param string $password パスワード
     */
    public function __construct(string $user_id, string $password)
    {
        $this->user_id = $user_id;
        $this->password = $password;
    }

    /**
     * ユーザIDの件数取得する関数
     * @return int $user_id_count ユーザID件数
     */
    public function selectUserId(): int
    {
        $user_id_count = 0;

        // DBの接続情報を取得
        $db = $this->dbConnectInfo();

        try
        {
            // 静的プレースホルダを指定
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            // クエリを発行
            $sql = 'SELECT count(*) FROM user_info WHERE user_id=:user_id';
            // プリペアドステートメント作成
            $stmt = $db->prepare($sql);
            // where句の設定
            $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_STR);
            // クエリを実行
            $stmt->execute();

            $user_id_count = $stmt->fetchColumn();
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

        return $user_id_count;
    }

    /**
     * ログイン情報を取得する関数
     * @return mixed $user_info ユーザ情報
     */
    public function selectUserInfo()
    {
        $user_info = array();

        $db = $this->dbConnectInfo();

        try
        {
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $sql = 'SELECT * FROM user_info WHERE user_id=:user_id AND password=:password';

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_STR);
            $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);

            $stmt->execute();

            // 取得できない場合はfalseが返却される
            $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
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

        return $user_info;
    }
}
