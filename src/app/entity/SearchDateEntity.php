<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/22
 * Time: 23:47
 */
namespace App\Entity;


/**
 * Class SearchDateEntity
 * @package App\Entity
 */
class SearchDateEntity
{
    /** フィールド情報 */
    // ユーザ登録日(to)
    private $regist_date_to;
    // ユーザ登録日(from)
    private $regist_date_from;

    /** getter・setter */
    /**
     * ユーザ登録日(from)のgetter
     */
    public function getRegistDateTo() {
        return $this->regist_date_to;
    }

    /**
     * ユーザ登録日(from)のsetter
     * @param string $regist_date_to
     */
    public function setRegistDateTo(string $regist_date_to) {
        $this->regist_date_to = $regist_date_to;
    }

    /**
     * ユーザ登録日(from)のgetter
     */
    public function getRegistDateFrom() {
        return $this->regist_date_from;
    }

    /**
     * ユーザ登録日(from)のsetter
     * @param string $regist_date_from
     */
    public function setRegistDateFrom(string $regist_date_from) {
        $this->regist_date_from = $regist_date_from;
    }
}
