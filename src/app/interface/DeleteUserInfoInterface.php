<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/22
 * Time: 1:08
 */

/**
 * Interface DeleteUserInfoInterface
 */
interface DeleteUserInfoInterface
{
    /**
     * ユーザ情報を削除する関数
     * @param string $id id
     * @return bool
     */
    public function deleteUserInfo(string $id): bool;
}
