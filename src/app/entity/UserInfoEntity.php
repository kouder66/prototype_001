<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/14
 * Time: 21:21
 */
namespace App\Entity;


/**
 * Class UserInfoEntity
 * @package App\Entity
 */
class UserInfoEntity
{
    /** フィールド情報 */
    // id
    private $id;
    // ユーザID
    private $user_id;
    // パスワード
    private $password;
    // 確認用パスワード
    private $check_password;
    // 名前(姓)
    private $first_name;
    // 名前(名)
    private $last_name;
    // フリガナ(姓)
    private $first_name_kana;
    // フリガナ(名)
    private $last_name_kana;
    // ユーザ登録日
    private $regist_date;
    // ユーザ更新日
    private $update_date;

    /** getter・setter */
    /**
     * Idのgetter
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Idのsetter
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * ユーザIDのgetter
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * ユーザIDのsetter
     * @param string $user_id
     */
    public function setUserId(string $user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * パスワードのgetter
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * パスワードのsetter
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * 確認用パスワードのgetter
     */
    public function getCheckPassword()
    {
        return $this->check_password;
    }

    /**
     * 確認用パスワードのsetter
     * @param string $check_password
     */
    public function setCheckPassword(string $check_password)
    {
        $this->check_password = $check_password;
    }

    /**
     * 名前(姓)のgetter
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * 名前(姓)のsetter
     * @param string $first_name
     */
    public function setFirstName(string $first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * 名前(名)のgetter
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * 名前(名)のsetter
     * @param string $last_name
     */
    public function setLastName(string $last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * フリガナ(姓)のgetter
     */
    public function getFirstNameKana()
    {
        return $this->first_name_kana;
    }

    /**
     * フリガナ(姓)のsetter
     * @param string $first_name_kana
     */
    public function setFirstNameKana(string $first_name_kana)
    {
        $this->first_name_kana = $first_name_kana;
    }

    /**
     * フリガナ(名)のgetter
     */
    public function getLastNameKana()
    {
        return $this->last_name_kana;
    }

    /**
     * フリガナ(名)のsetter
     * @param string $last_name_kana
     */
    public function setLastNameKana(string $last_name_kana)
    {
        $this->last_name_kana = $last_name_kana;
    }

    /**
     * ユーザ登録日のgetter
     */
    public function getRegistDate()
    {
        return $this->regist_date;
    }

    /**
     * ユーザ登録日のsetter
     * @param $regist_date
     */
    public function setRegistDate($regist_date)
    {
        $this->regist_date = $regist_date;
    }

    /**
     * ユーザ更新日のgetter
     */
    public function getUpdateDate()
    {
        return $this->update_date;
    }

    /**
     * ユーザ更新日のsetter
     * @param $update_date
     */
    public function setUpdateDate($update_date)
    {
        $this->update_date = $update_date;
    }
}
