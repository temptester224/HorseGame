<?PHP
$_OPTIMIZATION["title"] = "������� ";
$usid = $_SESSION["user_id"];
$refid = $_SESSION["referer_id"];
$usname = $_SESSION["user"];
?>


<?php 
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

# ������� ������ ������
if(isset($_POST["item"])){

$array_items = array(1 => "a_t", 2 => "b_t", 3 => "c_t", 4 => "d_t", 5 => "e_t");
$array_name = array(1 => "Radeon HD 7950", 2 => "nVidia GeForce GTX960", 3 => "Asus geforce gtx 1060", 4 => "MSI GeForce GTX 1080", 5 => "nVidia GeForce GTX960");
$item = intval($_POST["item"]);
$citem = $array_items[$item];

	if(strlen($citem) >= 3){
		
		# ��������� �������� ������������
		$need_money = $sonfig_site["amount_".$citem];
		if($need_money <= $user_data["money_b"]){
		
			if($user_data["last_sbor"] == 0 OR $user_data["last_sbor"] > ( time() - 60*20) ){
				
				$to_referer = $need_money * 0.1;
				# ��������� ������ � ��������� ������
				$db->Query("UPDATE db_users_b SET money_b = money_b - $need_money, $citem = $citem + 1,  
				last_sbor = IF(last_sbor > 0, last_sbor, '".time()."') WHERE id = '$usid'");
				
				# ������ ������ � �������
				$db->Query("INSERT INTO db_stats_btree (user_id, user, tree_name, amount, date_add, date_del) 
				VALUES ('$usid','$usname','".$array_name[$item]."','$need_money','".time()."','".(time()+60*60*24*15)."')");
				
				echo "<div class='ok'>�� ������� ������ ����������: '".$array_name[$item]."'!</div>";
				
				$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
				$user_data = $db->FetchArray();
				
			}else echo "<div class='ok'>����� ��� ��� �������� �������� �������� ��������� �� �����!</div>";
		
		}else echo "<div class='err'>�� ����� ����� �� ���������� ������� ��� ������� ����������: '".$array_name[$item]."'!</div>";
	
	}else echo 222;

}

?>
<section id="normalsec"></section><section id="content-1" class="account-page"><div class="row"><div class="twelve columns"><div class="un-row"><div class="un-col-3 account-nav-holder"><div class="account-nav">
	<?PHP include("inc/_user_menu.php"); ?>
	
</div></div>

        <div class="un-col-9 acc-main-content cashin-container operFormHolder"><h3 class="text-dark"><i class="acc-title-image" style="background-image:url('/img/cashin.png');"></i>������� ����</h3><div class="errors_text"></div><div class="un-row acc-section"><div class="un-col-12">

<div class="content">

    <table class="acc-summary-table black_table" width="100%" style="text-align:center">
<font color="0fff83">
� ���� �������� �� ������ ���������� ��������� ����������.<br>
������ ���������� �������� ������ ���������� ����, ������� ����� �����  ������� � �������� �� �������� ������. <br>
��� ������  � ������ ���������, ��� ������  ������ ��� ���  ��������.<br><br>

<h3>������ �������  ��������� �� �������:</h3>

<p>���� �� �� ������ �������� �����, �� �� ���������� ��� ���������� ���������� ���������:<br>

<a href="/">����������� ���������</a> - ����������� � ������ ����� ������ � �������� � ��������� �����������.<br><br>

���������� �����, ����� � ������, ��������, �������, ������� 777, ���������, ����� - ��������� ����� � ������ �� ���� ���������� �� �������!</p></font>
<div class="hintsmall">

</div>
</div><br><br>
		<div style="margin-top: -5px;" class="block_list"><ul class="block_ul">
		<li>����������: Radeon HD 7950</li>
		<li>��������: <b><?=$sonfig_site["a_in_h"]; ?></b> ��� � ���</li>
		<li>����������: <b>32% / ���.</b></li>
		<li>�������: <b><?=$user_data["a_t"]; ?></b> ��.</li>
		<li>
			<div class="block_img"><img src="/images/animals/1.png" alt="Radeon HD 7950" title="Radeon HD 7950">
		<form method="post" action="/account/shop.html">
		<input type="hidden" value="1" name="item">
		<input type="submit" class="subm_button" style="float: center;margin-top: 10px;" value="������">
		</form>
		����: <span style="font-size: 22px;"><b><?=$sonfig_site["amount_a_t"]; ?></b></span> �����
		</li>
		</ul>
		</div>
		</div>
	</div>
</div>
<br><br>
<div class="shop">
	<div class="block">
		<div style="margin-top: -5px;" class="block_list"><ul class="block_ul">
		<li>����������: nVidia GeForce GTX960</li>
		<li>��������: <b><?=$sonfig_site["b_in_h"]; ?></b> ��� � ���</li>
		<li>����������: <b>35% / ���.</b></li>
		<li>�������: <b><?=$user_data["b_t"]; ?></b> ��.</li>
		<li>
		<div class="block_img"><img src="/images/animals/2.png" alt="nVidia GeForce GTX960" title="nVidia GeForce GTX960">
		<form method="post" action="/account/shop.html">
		<input type="hidden" value="2" name="item">
		<input type="submit" class="subm_button" style="float: center;margin-top: 10px;" value="������">
		</form>
		����: <span style="font-size: 22px;"><b><?=$sonfig_site["amount_b_t"]; ?></b></span> �����</li></ul>
		</div>
		</div>
	</div>
</div>
<br><br>
<div class="shop">
	<div class="block">
		<div style="margin-top: -5px;" class="block_list"><ul class="block_ul">
		<li>����������: Asus geforce gtx 1060</li>
		<li>��������: <b><?=$sonfig_site["c_in_h"]; ?></b> ��� � ���</li>
		<li>����������: <b>37% / ���.</b></li>
		<li>�������: <b><?=$user_data["c_t"]; ?></b> ��.</li>
		<li>
		<div class="block_img"><img src="/images/animals/3.png" alt="Asus geforce gtx 1060" title="Asus geforce gtx 1060">
		<form method="post" action="/account/shop.html">
		<input type="hidden" value="3" name="item">
		<input type="submit" class="subm_button" style="float: center;margin-top: 10px;" value="������">
		</form>
		����: <span style="font-size: 22px;"><b><?=$sonfig_site["amount_c_t"]; ?></b></span> �����</li></ul>
		</div>
		</div>
	</div>
</div>
<br><br>
<div class="shop">
	<div class="block">
		<div style="margin-top: -5px;" class="block_list"><ul class="block_ul">
		<li>����������: MSI GeForce GTX 1080</li>
		<li>��������: <b><?=$sonfig_site["d_in_h"]; ?></b> ��� � ���</li>
		<li>����������: <b>38% / ���.</b></li>
		<li>�������: <b><?=$user_data["d_t"]; ?></b> ��.</li>
		<li>
			<div class="block_img"><img src="/images/animals/4.png" alt="MSI GeForce GTX 1080" title="MSI GeForce GTX 1080">
		<form method="post" action="/account/shop.html">
		<input type="hidden" value="4" name="item">
		<input type="submit" class="subm_button" style="float: center;margin-top: 10px;" value="������">
		</form>
		����: <span style="font-size: 22px;"><b><?=$sonfig_site["amount_d_t"]; ?></b></span> �����</li></ul>
		</div>
		</div>
	</div>
</div>
<br><br>
<div class="shop">
	<div class="block">
		<div style="margin-top: -5px;" class="block_list"><ul class="block_ul">
		<li>����������: nVidia GeForce 1080 ti<li>
		<li>��������: <b><?=$sonfig_site["e_in_h"]; ?></b> ��� � ���</li>
		<li>����������: <b>42% / ���.</b></li>
		<li>�������: <b><?=$user_data["e_t"]; ?></b> ��.</li>
		<li>
		<div class="block_img"><img src="/images/animals/5.png" alt="nVidia GeForce 1080 ti" title="nVidia GeForce 1080 ti">
		<form method="post" action="/account/shop.html">
		<input type="hidden" value="5" name="item">
		<input type="submit" class="subm_button" style="float: center;margin-top: 10px;" value="������">
		</form>
		����: <span style="font-size: 22px;"><b><?=$sonfig_site["amount_e_t"]; ?></b></span> �����</li></ul>
		</div>
		</div>
	</div>
</div>
 </h3>       



</div>
</div>


