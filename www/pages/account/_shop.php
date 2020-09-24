<?PHP
$_OPTIMIZATION["title"] = "Магазин ";
$usid = $_SESSION["user_id"];
$refid = $_SESSION["referer_id"];
$usname = $_SESSION["user"];
?>


<?php 
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

# Покупка нового дерева
if(isset($_POST["item"])){

$array_items = array(1 => "a_t", 2 => "b_t", 3 => "c_t", 4 => "d_t", 5 => "e_t");
$array_name = array(1 => "Radeon HD 7950", 2 => "nVidia GeForce GTX960", 3 => "Asus geforce gtx 1060", 4 => "MSI GeForce GTX 1080", 5 => "nVidia GeForce GTX960");
$item = intval($_POST["item"]);
$citem = $array_items[$item];

	if(strlen($citem) >= 3){
		
		# Проверяем средства пользователя
		$need_money = $sonfig_site["amount_".$citem];
		if($need_money <= $user_data["money_b"]){
		
			if($user_data["last_sbor"] == 0 OR $user_data["last_sbor"] > ( time() - 60*20) ){
				
				$to_referer = $need_money * 0.1;
				# Добавляем дерево и списываем деньги
				$db->Query("UPDATE db_users_b SET money_b = money_b - $need_money, $citem = $citem + 1,  
				last_sbor = IF(last_sbor > 0, last_sbor, '".time()."') WHERE id = '$usid'");
				
				# Вносим запись о покупке
				$db->Query("INSERT INTO db_stats_btree (user_id, user, tree_name, amount, date_add, date_del) 
				VALUES ('$usid','$usname','".$array_name[$item]."','$need_money','".time()."','".(time()+60*60*24*15)."')");
				
				echo "<div class='ok'>Вы успешно купили Видеокарта: '".$array_name[$item]."'!</div>";
				
				$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
				$user_data = $db->FetchArray();
				
			}else echo "<div class='ok'>Перед тем как докупить животных соберите продукцию на ферме!</div>";
		
		}else echo "<div class='err'>На вашем счете не достаточно средств для покупки Видеокарта: '".$array_name[$item]."'!</div>";
	
	}else echo 222;

}

?>
<section id="normalsec"></section><section id="content-1" class="account-page"><div class="row"><div class="twelve columns"><div class="un-row"><div class="un-col-3 account-nav-holder"><div class="account-nav">
	<?PHP include("inc/_user_menu.php"); ?>
	
</div></div>

        <div class="un-col-9 acc-main-content cashin-container operFormHolder"><h3 class="text-dark"><i class="acc-title-image" style="background-image:url('/img/cashin.png');"></i>Покупка карт</h3><div class="errors_text"></div><div class="un-row acc-section"><div class="un-col-12">

<div class="content">

    <table class="acc-summary-table black_table" width="100%" style="text-align:center">
<font color="0fff83">
В этом магазине вы можете приобрести различные видеокарты.<br>
Каждая Видеокарта приносит разное количество хеша, который потом можно  продать и обменять на реальные деньги. <br>
Чем дороже  и больше видеокарт, тем больше  дохода они Вам  приносят.<br><br>

<h3>Другие способы  заработка на проекте:</h3>

<p>Если вы не хотите покупать карты, то мы предлагаем Вам заработать следующими способами:<br>

<a href="/">Партнерская программа</a> - приглашайте в проект своих друзей и знакомых и получайте премиальные.<br><br>

Ежедневный бонус, Бонус с риском, Конкурсы, Серфинг, Автомат 777, Наперстки, Гонки - получайте призы и бонусы за свою активность на проекте!</p></font>
<div class="hintsmall">

</div>
</div><br><br>
		<div style="margin-top: -5px;" class="block_list"><ul class="block_ul">
		<li>Видеокарта: Radeon HD 7950</li>
		<li>Скорость: <b><?=$sonfig_site["a_in_h"]; ?></b> хеш в час</li>
		<li>Доходность: <b>32% / мес.</b></li>
		<li>Куплено: <b><?=$user_data["a_t"]; ?></b> шт.</li>
		<li>
			<div class="block_img"><img src="/images/animals/1.png" alt="Radeon HD 7950" title="Radeon HD 7950">
		<form method="post" action="/account/shop.html">
		<input type="hidden" value="1" name="item">
		<input type="submit" class="subm_button" style="float: center;margin-top: 10px;" value="Купить">
		</form>
		ЦЕНА: <span style="font-size: 22px;"><b><?=$sonfig_site["amount_a_t"]; ?></b></span> монет
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
		<li>Видеокарта: nVidia GeForce GTX960</li>
		<li>Скорость: <b><?=$sonfig_site["b_in_h"]; ?></b> хеш в час</li>
		<li>Доходность: <b>35% / мес.</b></li>
		<li>Куплено: <b><?=$user_data["b_t"]; ?></b> шт.</li>
		<li>
		<div class="block_img"><img src="/images/animals/2.png" alt="nVidia GeForce GTX960" title="nVidia GeForce GTX960">
		<form method="post" action="/account/shop.html">
		<input type="hidden" value="2" name="item">
		<input type="submit" class="subm_button" style="float: center;margin-top: 10px;" value="Купить">
		</form>
		ЦЕНА: <span style="font-size: 22px;"><b><?=$sonfig_site["amount_b_t"]; ?></b></span> монет</li></ul>
		</div>
		</div>
	</div>
</div>
<br><br>
<div class="shop">
	<div class="block">
		<div style="margin-top: -5px;" class="block_list"><ul class="block_ul">
		<li>Видеокарта: Asus geforce gtx 1060</li>
		<li>Скорость: <b><?=$sonfig_site["c_in_h"]; ?></b> хеш в час</li>
		<li>Доходность: <b>37% / мес.</b></li>
		<li>Куплено: <b><?=$user_data["c_t"]; ?></b> шт.</li>
		<li>
		<div class="block_img"><img src="/images/animals/3.png" alt="Asus geforce gtx 1060" title="Asus geforce gtx 1060">
		<form method="post" action="/account/shop.html">
		<input type="hidden" value="3" name="item">
		<input type="submit" class="subm_button" style="float: center;margin-top: 10px;" value="Купить">
		</form>
		ЦЕНА: <span style="font-size: 22px;"><b><?=$sonfig_site["amount_c_t"]; ?></b></span> монет</li></ul>
		</div>
		</div>
	</div>
</div>
<br><br>
<div class="shop">
	<div class="block">
		<div style="margin-top: -5px;" class="block_list"><ul class="block_ul">
		<li>Видеокарта: MSI GeForce GTX 1080</li>
		<li>Скорость: <b><?=$sonfig_site["d_in_h"]; ?></b> хеш в час</li>
		<li>Доходность: <b>38% / мес.</b></li>
		<li>Куплено: <b><?=$user_data["d_t"]; ?></b> шт.</li>
		<li>
			<div class="block_img"><img src="/images/animals/4.png" alt="MSI GeForce GTX 1080" title="MSI GeForce GTX 1080">
		<form method="post" action="/account/shop.html">
		<input type="hidden" value="4" name="item">
		<input type="submit" class="subm_button" style="float: center;margin-top: 10px;" value="Купить">
		</form>
		ЦЕНА: <span style="font-size: 22px;"><b><?=$sonfig_site["amount_d_t"]; ?></b></span> монет</li></ul>
		</div>
		</div>
	</div>
</div>
<br><br>
<div class="shop">
	<div class="block">
		<div style="margin-top: -5px;" class="block_list"><ul class="block_ul">
		<li>Видеокарта: nVidia GeForce 1080 ti<li>
		<li>Скорость: <b><?=$sonfig_site["e_in_h"]; ?></b> хеш в час</li>
		<li>Доходность: <b>42% / мес.</b></li>
		<li>Куплено: <b><?=$user_data["e_t"]; ?></b> шт.</li>
		<li>
		<div class="block_img"><img src="/images/animals/5.png" alt="nVidia GeForce 1080 ti" title="nVidia GeForce 1080 ti">
		<form method="post" action="/account/shop.html">
		<input type="hidden" value="5" name="item">
		<input type="submit" class="subm_button" style="float: center;margin-top: 10px;" value="Купить">
		</form>
		ЦЕНА: <span style="font-size: 22px;"><b><?=$sonfig_site["amount_e_t"]; ?></b></span> монет</li></ul>
		</div>
		</div>
	</div>
</div>
 </h3>       



</div>
</div>


