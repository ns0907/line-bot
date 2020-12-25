<?php

/*** データベースに接続するための宣言 ***/
$con = mysqli_connect('localhost', 'root', 'root') or die(mysqli_error());
mysqli_set_charset($con, "utf8");
mysqli_select_db($con,'liffdb');
mysqli_query($con,'SET NAMES UTF8');


function hsc($str){
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

//このページでechoしたものがhtmlに返されて出力される
header("Content-type: text/plain; charset=UTF-8");

//Ajaxによるリクエストかどうかの識別を行う
//strtolower()を付けるのは、XMLHttpRequestやxmlHttpRequestで返ってくる場合があるため
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){  

  if(isset($_POST['request'])){

    //member_id(int型)で検索するためint以外を弾く
    $request= (int)filter_input(INPUT_POST, 'request');

    $sql = sprintf("SELECT * FROM members WHERE member_id LIKE '%s'",
                   mysqli_real_escape_string($con,'%'.addcslashes(hsc($request), '\_%').'%')
    );
    $res = mysqli_query($con,$sql);
    if(mysqli_num_rows($res) != 0){
      while($row = mysqli_fetch_assoc($res)){
        $memberId   = $row['member_id'];
        $memberName = $row['member_name'];

        $String .= "<p>".$memberId."</p>";
        $String .= "<h3>".$memberName."</h3>";
      }
    }else{
      //デバッグ用 データがなかった時にSQLを出力する
      echo $sql;
    }
    echo $String;
  }else{
    echo 'The parameter of "request" is not found.';
  }

}else{
  echo 'This access is not valid.';  
}