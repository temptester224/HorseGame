<?php
# ����� ������
@session_start();
# ��������� ��� Include
define("CONST_RUFUS", true);

# ������������� �������
function __autoload($name){ include("classes/_class.".$name.".php");}

# ����� ������� 
$config = new config;

# �������
$func = new func;

# ���� ������
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);


$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");

$prof_data = $db->FetchArray();
	
?>



<div style="font-size:24px;font-weight: bold;margin: 10px 0px 0px 0px;"><font color="#328426">�� ������� <?=sprintf("%.2f",$prof_data["money_b"]); ?> �������.</font></div>

