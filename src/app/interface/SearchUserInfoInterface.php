<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/22
 * Time: 23:46
 */

/**
 * Interface SearchUserInfoInterface
 */
interface SearchUserInfoInterface
{
    /**
     * 検索情報をもとにユーザ情報を取得する関数
     * @return mixed
     */
    public function selectSearchUserInfo();
}
