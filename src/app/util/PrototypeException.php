<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/24
 * Time: 1:00
 */
namespace App\Util;

use Exception;
use Throwable;


/**
 * Class PrototypeException
 * @package App\Util
 */
class PrototypeException extends Exception
{
    /**
     * PrototypeException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        // セッションスタート
        if (!isset($_SESSION))
        {
            session_start();
        }

        // セッションに登録
        $_SESSION['error_code'] = $code;

        header('Location: '.BASE_VIEW_PATH.'errorView.php');
        exit();
    }
}
