<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/18
 * Time: 15:37
 */
use App\Entity\UserInfoEntity;

require_once('../entity/UserInfoEntity.php');


/**
 * Interface UpdateUserInfoInterface
 */
interface UpdateUserInfoInterface
{
    /**
     * 選択されたユーザ情報を取得する関数
     * @param string id id
     * @return UserInfoEntity ユーザ情報
     */
    public function selectUserInfoById(string $id): UserInfoEntity;

    /**
     * ユーザ情報を更新する関数
     * @param UserInfoEntity $UserInfoEntity 入力されたユーザ情報
     * @return bool
     */
    public function updateUserInfo(UserInfoEntity $UserInfoEntity): bool;
}
