<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/15
 * Time: 18:12
 */

/**
 * Interface CreateUserInfoInterface
 */
interface CreateUserInfoInterface
{
    /**
     * ユーザ情報を登録する関数
     * @return bool
     */
    public function insertUserInfo(): bool ;
}
