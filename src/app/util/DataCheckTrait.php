<?php
/**
 * Created by PhpStorm.
 * User: Kou
 * Date: 2019/02/15
 * Time: 18:21
 */


/**
 * Trait DataCheckTrait
 */
trait DataCheckTrait
{
    /**
     * 受け取った入力内容をHTMLエスケープを行う関数
     * @param array $input_user_info 入力されたユーザ情報
     * @return array $input_user_info 入力されたユーザ情報
     */
    public function checkXSS(array $input_user_info): array
    {
        // 各項目のエスケープ実行
        foreach ($input_user_info as $key => $value)
        {
            // URLデコード
            $value = rawurldecode($value);
            // XSS対応
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            // 上書き
            $input_user_info[$key] = $value;
        }

        return $input_user_info;
    }
}