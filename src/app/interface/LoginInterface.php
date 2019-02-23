<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/14
 * Time: 21:27
 */

/**
 * Interface LoginInterface
 */
interface LoginInterface
{
    /**
     * ユーザIDの件数取得する関数
     * @return int
     */
    public function selectUserId(): int;

    /**
     * ログイン情報を取得する関数
     * @return mixed
     */
    public function selectUserInfo();
}
