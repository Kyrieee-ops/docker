<?php
/*---------------------------------------------------------------
【機能】:氏名のバリデーションチェックを行う
        文字数チェックを行う(最大10文字)
【引数】:HTMLから送信されてくるname属性をキーにしたuser_name
【戻り値】:-1 空文字または10文字を超える場合=>エラー
　　　　　  0 日本語(半角英数(大小)、半角数字、全角数字、「、」「。」ひらがな、カタカナ、漢字)以外の場合はエラー
           1 正しい入力値=>入力値を返す
---------------------------------------------------------------*/
//プロパティ設定

//test.phpと同じ階層に見立てたnamespaceを記述
//非修飾形式
namespace vendor\php_message\class_name\validation;
class name_validation {
    //文字数制限：10文字まで
    const TEXT_COUNT_MAX = 10;
    //日本語(半角英数(大小)、半角数字、全角数字、「、」「。」ひらがな、カタカナ、漢字)のみ許可
    const TEXT_PATTERN = "/^[ぁ-んァ-ヶーa-zA-Z0-9一０-９、。]|[\p{Han}]+$/u";
    public function validation($name_array){
        //値の初期化
        //現状配列でデータを比較しているが、マスタで管理にする。
        /*
        $check_flg = "";
        //入力値と一致させる値を以下に入れてください
        $const_name = [
            "",
            "",
            ""
        ];
        
        $const_name_2 = [
            "",
            "",
            "",
            ""
        ];
        */
        //置き換えする検索文字列　半角空白、全角空白
        $search = [" ","　"];
        $replace = "";
        //str_replaceで空白が存在すれば空白削除
        //forで繰り返し配列の値の空白削除を行う
        //$name_arrayが配列であるかどうかを確認しないとwarningが発生
        if (is_array($name_array)) {
                $name_array = str_replace($search,$replace,$name_array);
        }
            /*---------------------------------------------
            ・空の場合または10文字を超える場合はエラー:-1
            ・日本語(半角英数(大小)、半角数字、全角数字、「、」「。」ひらがな、カタカナ、漢字)以外の場合はエラー:0
            ・上記以外画面遷移：1
            ---------------------------------------------*/
            //空文字の場合はエラー
            foreach (['user_name','partner_name'] as $i) {
                if (empty($name_array[$i])) {
                    $check_flg = "-1";
                    return $check_flg;
                }
            }
            //10文字以上の場合はエラー
            foreach (['user_name','partner_name'] as $i) {
                if (mb_strlen($name_array[$i]) > self::TEXT_COUNT_MAX) {
                    $check_flg = "-1";
                    return $check_flg;
                }
            }

            //日本語(半角英数(大小)、半角数字、全角数字、「、」「。」ひらがな、カタカナ、漢字)のみ許可
            foreach (['user_name','partner_name'] as $i) {
                if (!preg_match(self::TEXT_PATTERN, $name_array[$i])) {
                    $check_flg = "0";
                    return $check_flg;
                }
            }
         //上記以外であればTrue
         return $check_flg = "1";

        }
    }
?>