<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/14
 * Time: 21:03
 */
namespace App\Controller;

use App\Service\LoginService;
use App\Service\SelectUserInfoListService;

require_once('../service/LoginService.php');
require_once('../config/PathConfig.php');
require_once('../service/SelectUserInfoListService.php');


/** コントローラ呼び出し */
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $loginController = new LoginController($_POST['user_id'], $_POST['password']);
    $loginController->executeLogin();
}

/**
 * Class loginController
 * @package App\Controller
 */
class LoginController
{
    /** フィールド情報 */
    private $user_id;
    private $password;

    /**
     * loginController constructor.
     * @param string $user_id ユーザID
     * @param string $password パスワード
     */
    public function __construct(string $user_id, string $password)
    {
        $this->user_id = $user_id;
        $this->password = $password;
    }

    /**
     * ログイン認証を実行する関数
     * @return void
     */
    public function executeLogin(): void
    {
        $LoginService = new LoginService($this->user_id, $this->password);

        // ログイン認証結果によって遷移する画面が異なる。
        if ($LoginService->checkLogin())
        {
            $SelectUserInfoListService = new SelectUserInfoListService();

            // ユーザ情報一覧を取得できているか確認
            if ($SelectUserInfoListService->getUserInfoList())
            {
                // トップ画面へ遷移
                header('Location: '.BASE_VIEW_PATH.'userInfoListView.php');
                exit();
            }
        }
        else
        {
            // エラーメッセージを表示
            header('Location: '.BASE_VIEW_PATH.'index.php');
            exit();
        }
    }
}
