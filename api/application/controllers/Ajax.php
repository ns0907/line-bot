<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
{

	public function post()
	{
		header("Content-Type: application/json; charset=UTF-8"); //ヘッダー情報の明記。必須。
		$ary_sel_obj = []; //配列宣言
		$opt = filter_input(INPUT_POST, "opt"); //変数の出力。jQueryで指定したキー値optを用いる。
		//リスト情報(今回は配列にしているが、オブジェクトでも同様のJSON形式で受け取ることができる)
		$ary_lists = [
			"kyoto" => [
				"position" => "四条河原町駅",
				"ap_time" => "8:30",
			],
			"osaka" => [
				"position" => "梅田駅",
				"ap_time" => "9:00",
			],
			"kobe" => [
				"position" => "三宮駅",
				"ap_time" => "9:30",
			],
		];
		if (isset($ary_lists)) $ary_sel_obj = $ary_lists[$opt]; //連想配列のプロパティから値を取得
		echo json_encode($ary_sel_obj); //jsonオブジェクト化。必須。配列でない場合は、敢えてjson化する必要はない
		exit; //処理の終了
	}

	public function post2()
	{
		$name = $_POST['name'];
		$email = $_POST['email'];

		$array = [$name, $email];

		echo json_encode($array);
	}
}
