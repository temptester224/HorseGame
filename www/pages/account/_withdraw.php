<div class="col-sm-12 col-lg-6">
	<blockquote>
        <h2 style="margin-top: 2%;">Заказ выплаты</h2>
        </blockquote>
</div>

        </div>
            <div class="container-fluid">
                <div class="row">
<?PHP
 // by Raccoon
$_OPTIMIZATION["title"] = "Аккаунт - Заказ выплаты";
$user_id = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$user_id' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$config_site = $db->FetchArray();

$status_array = array( 0 => "Проверяется", 1 => "Выплачивается", 2 => "Отменена", 3 => "Выплачено");
# Минималка серебром!
$minPay = 5;
/*if($user_id != '1'){
	echo '<center><b><font color = "red">Ведутся технические работы</font></b></center><BR />';
	return;
}*/
?>
 


<?PHP



$db->Query("SELECT * FROM db_users_b WHERE id = '$user_id' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$config_site = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

$db->Query("SELECT * FROM db_payment WHERE user_id = '$usid' ORDER BY id DESC LIMIT 1");
$sonfig_purse = $db->FetchArray();

$status_array = array( 0 => "Проверяется", 1 => "Выплачивается", 2 => "Отменена", 3 => "Выплачено");

$nd_time = time() - 60*60*24;
$db->Query("SELECT * FROM db_payment WHERE user_id = '$usid' AND date_add >= '$nd_time' order by id DESC");

$frompayments = $db->FetchArray();
$last24pay = $frompayments["sum"]*$sonfig_site["ser_per_wmr"];

# Настраиваем кол-во суток для ограничения.
$maxforonepay = 2.0*$sonfig_site["ser_per_wmr"]*$user_data["insert_sum"] + 1.00*$user_data["from_referals"];
$max_pay = 3.0*$sonfig_site["ser_per_wmr"]*$user_data["insert_sum"] + $user_data["from_referals"];

# Минималка серебром!
$minPay = 5;
/*if($user_id != '1'){
	echo '<center><b><font color = "red">Ведутся технические работы</font></b></center><BR />';
	return;
}*/
?>

<?
// глушим новичков от разворовывания бюджета :)
$sumClose = 0; // заглушка на 30 рублей

if($user_data["insert_sum"] < $sumClose){
$rest = $sumClose - $user_data["insert_sum"];
?>
<center><font color="red"><b>Вы не можете заказать выплату!<p>Вам осталось пополнить игровой баланс на <?=$rest?> рублей!</center>
<BR /><BR />
 
<?PHP

return;
}

?>
<center><font color="red">Сначала выберите платежную систему по иконке, затем введите номер счёта в форме ниже: </font></center> 
<BR />
<?PHP
$ddel = time() + 60*60*3;
$dadd = time();

# Проверка на дату выплаты
$db->Query("SELECT COUNT(*) FROM db_pay_dat WHERE user_id = '$usid' AND date_del > '$dadd'");
 if($db->FetchRow() == 0){
# Заносим выплату
if(isset($_POST['swap'])){ // проверка: была ли отправлена форма
	if(!empty($_POST['purse'])){
		$ps = Array(
		'Payeer'=>'1136053',
		'QIWI'=>'60792237',
		'Яндекс'=>'25344',
		'Билайн'=>'24898938',
		'Мегафон'=>'24899391',
		'МТС'=>'24899291',
		'ТЕЛЕ2'=>'95877310',
		'VISA' =>'117146509',
		'MASTERCARD' =>'57644634',
		'MAESTRO' =>'57766314'
		);
		$ps = $ps[$_POST['ps']];
		if(!empty($ps)){
			if($_POST['ps'] == 'Payeer'){
				function ViewPurse($purse){
					if( substr($purse,0,1) != "P" ) return false;
					if( !preg_match("#^[0-9]{7,8}$#", substr($purse,1)) ) return false;	
					return $purse;
				}
			}
			if($_POST['ps'] == 'Яндекс'){
				function ViewPurse($purse){
					if( !preg_match("#^41001[0-9]{7,10}$#",$purse) ) return false;
					return $purse;
				}
				$minPay = '1000';
			}
			if($_POST['ps'] == 'QIWI'){
				function ViewPurse($purse){
					if( !preg_match("#^\+(91|994|82|372|375|374|44|998|972|66|90|81|1|507|7|77|380|371|370|996|9955|992|373|84)[0-9]{6,14}$#",$purse) ) return false;
					return $purse;
				}
				$minPay = '1000';
			}
			if(isset($_POST['phone']) && $_POST['ps'] != 'QIWI'){
				function ViewPurse($purse){
					if( !preg_match("#^[\+]{1}[7]{1}[9]{1}[\d]{9}$#",$purse) ) return false;
					return $purse;
				}
				$minPay = '1000';
			}
			
			if($_POST['ps'] == 'VISA'){
				function ViewPurse($purse){
					if(!preg_match("#^([45]{1}[\d]{15}|[6]{1}[\d]{17})$#",$purse)) return false;
					return $purse;
				}
			}
			if($_POST['ps'] == 'MASTERCARD'){
				function ViewPurse($purse){
					if( !preg_match("#^([45]{1}[\d]{15}|[6]{1}[\d]{17})$#",$purse) ) return false;
					return $purse;
				}
				
			}
			if($_POST['ps'] == 'MAESTRO'){
				function ViewPurse($purse){
					if( !preg_match("#^([45]{1}[\d]{15}|[6]{1}[\d]{15,17})$#",$purse) ) return false;
					return $purse;
				}
				
			}
			if(isset($_POST['card'])){
				$minPay = '65000';
				function ViewPerson($person){
					if( !preg_match("#^([a-zA-ZА-Яабвгдеёжзийклмнопрстуфхцчшщьыъэюя\.\-\' ]+)$#",$person) ) return false;
					return $person;
				}
				$person = ViewPerson($_POST['person']);
			}
			$purse = ViewPurse($_POST['purse']);
			if($purse != false){
			if((!empty($person) AND $person != false) OR !isset($person)){
				$sum = round(intval($_POST['sum']),2);
				$val = 'RUB';
				if($sum >= $minPay){
				if ($frompayments["date_add"] <= time() - 86400) {
				if($sum + $sonfig_site["ser_per_wmr"]*$user_data["payment_sum"] <= $max_pay) {
				if($sum + $last24pay <= $maxforonepay) {
					if($sum <= $user_data['money_p']){
					# Проверяем на существующие заявки
						$db->Query("SELECT COUNT(*) FROM db_payment WHERE user_id = '$user_id' AND (status = '0' OR status = '1')");
						if($db->FetchRow() == 0){
							$sum_pay = round( ($sum / $config_site['ser_per_wmr']), 2);
							# Делаем выплату
								$payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
								if ($payeer->isAuth()){
									
									$arBalance = $payeer->getBalance();
									if($arBalance['auth_error'] == 0){

										$balance = $arBalance['balance']['RUB']['DOSTUPNO'];
										if($balance >= $sum_pay){
											$array = array(
												'action' => 'output',
												'ps' => $ps,
												'curIn' => $val, // счет списания
												'sumOut' => $sum_pay, // сумма получения
												'curOut' => $val, // валюта получения
												'param_ACCOUNT_NUMBER' => $purse // получатель
											);
											if(!empty($person)){
												$array['param_CONTACT_PERSON'] = $person;
											}
											$initOutput = $payeer->initOutput($array);
											if ($initOutput){
												$historyId = $payeer->output();
													if ($historyId > 0){
													# Снимаем с пользователя
														$db->Query("UPDATE db_users_b SET money_p = money_p - '$sum', payment_sum = payment_sum + '$sum_pay' WHERE id = '$user_id'");
														
														# Вставляем запись в выплаты
														$da = time();
														$dd = $da + 60*60*24*15;
														
														$ppid = $arTransfer["historyId"];
															
														$db->Query("INSERT INTO db_payment (user, user_id, purse, sum, valuta, serebro, pay_sys_id, payment_id, date_add, status) VALUES ('$usname','$user_id','$purse','$sum_pay','RUB', '$sum', '$ps', '$ppid','".time()."', '3')");
															
														$db->Query("UPDATE db_stats SET all_payments = all_payments + '$sum_pay' WHERE id = '1'");
														
																												# заносим защиту от большой выплаты и дату
														$db->Query("INSERT INTO db_pay_dat (user, user_id, sum, date_add, date_del) VALUES ('$uname','$usid','$sum','$dadd','$ddel')");
                                           
														
														echo "<center><font color = 'green'><b>Выплачено!</b></font></center><BR />";
														$db->Query("SELECT * FROM db_users_b WHERE id = '$user_id' LIMIT 1");
														$user_data = $db->FetchArray();
													}else{
														echo '<center><font color = "red"><b>Ошибка ['.print_r($payeer->getErrors(), true).'] - попробуйте через 10-15 секунд или сообщите о ней администратору!</b></font></center><BR />';
													}
											}else{
												echo '<center><font color = "red"><b>Ошибка ['.print_r($payeer->getErrors(), true).'] - попробуйте через 10-15 секунд или сообщите о ней администратору!</b></font></center><BR />';
											}
										}else echo '<center><font color = "red"><b>Сервер перегружен - попробуйте через 10-15 секунд или сообщите о ней администратору</b></font></center><BR />';
									}else echo '<center><font color = "red"><b>Не удалось выплатить! Попробуйте позже.</b></font></center><BR />';
								}else echo '<center><font color = "red"><b>Не удалось выплатить! Попробуйте позже. Ошибка № 631 </b></font></center><BR />';
							}else echo '<center><font color = "red"><b>У вас имеются необработанные заявки. Дождитесь их выполнения.</b></font></center><BR />';
					}else echo '<center><font color = "red"><b>Вы указали больше, чем имеется на вашем счету.</b></font></center><BR />';
                }else echo "<center><font color = 'red'><b>Вы указали сумму, которая превышает суточный максимум для выплат!</b></font></center><BR />";
				}else echo "<center><font color = 'red'><b>Вы указали сумму, которая превышает максимум для выплат!</b></font></center><BR />";
				 }else echo "<center><font color = 'red'><b>В ближайшие 24 часа Вы уже получали выплату! Попробуйте позже</b></font></center>";
				}else echo '<center><b><font color = "red">Минимальная сумма для выплаты составляет '.$minPay.' золота!</font></b></center><BR />';
				}else echo '<center><b><font color = "red">Данные держателя карты указаны неверно!</font></b></center><BR />';
			}else echo '<center><b><font color = "red">Номер счета '.$purse.' указан неверно</font></b></center><BR />';
		}else echo '<center><b><font color = "red">Платежная система не указана!</font></b></center><BR />';
		
		
	}else echo '<center><b><font color = "red">Вы не ввели номер кошелька</font></b></center><BR />';
	 
	}

	}else echo "<center><div class='alert alert-success'><font color = 'red'><b>Выплаты можно совершать не чаще чем 1 раз в 3 часа</b></font></div></center><BR />";
	

?>

<style>
	.selectPS{
    display: inline-block;
    width: 100px;
    vertical-align: top;
    text-align: center;
    padding: 5px 5px 10px 5px;
    margin: 5px 2px;
    border: 0 dotted #2a2a2a;
    cursor: pointer;
}
.selectPS:hover{
    border: 2px dotted #cb8851;
    background: #fde6c3;
}
.selectPS .imagesps{
    width: 55px;
    box-sizing: border-box;
    height: 55px;
    display: inline-block;
}
.selectPS label{
    font-size: 8pt;
    display: block;
    margin-top: 10px;
}
</style>
<script type="text/javascript">
function addfield(ps,name){
	var el = document.getElementById('new');
	var el1 = document.getElementById('new1');
	var el2 = document.getElementById('new2');
	var el3 = document.getElementById('new3');
	if(el){el.parentNode.removeChild(el);}
	if(el1){el1.parentNode.removeChild(el1);}
	if(el2){el2.parentNode.removeChild(el2);}
	if(el3){el3.parentNode.removeChild(el3);}
	if(ps == 'phone'){
		var newTd = document.createElement('td');
		newTd['id'] = 'new';
		newTd.innerHTML = '<font color="#000;">Номер телефона '+name+':</font>';
		paysys.insertBefore(newTd, paysys.children[0]);
		var newTd = document.createElement('td');
		newTd['id'] = 'new1';
		newTd.innerHTML = '<input type="text" name="purse" size="15"><input type="hidden" name="ps" value="'+name+'"><input type="hidden" name="phone">';
		paysys.insertBefore(newTd, paysys.children[1]);
		min = 1000;
		document.getElementById('str_min').style.display = 'inline';
		document.getElementById('min').innerHTML = min;
		document.getElementById('name_ps').innerHTML = name;
	}
	if(ps == 'eps'){
		var newTd = document.createElement('td');
		newTd['id'] = 'new';
		newTd.innerHTML = '<font color="#000;">Номер счета '+name+':</font>';
		paysys.insertBefore(newTd, paysys.children[0]);
		var newTd = document.createElement('td');
		newTd['id'] = 'new1';
		newTd.innerHTML = '<input type="text" name="purse" size="15"><input type="hidden" name="ps" value="'+name+'">';
		paysys.insertBefore(newTd, paysys.children[1]);
		min = <?=$minPay;?>;
		if(name == 'Яндекс'){min = 1000;}
		document.getElementById('str_min').style.display = 'inline';
		document.getElementById('min').innerHTML = min;
		document.getElementById('name_ps').innerHTML = name;
	}	
	if(ps == 'card'){
		var newTd = document.createElement('td');
		newTd['id'] = 'new';
		newTd.innerHTML = '<font color="#000;">Номер карты '+name+':</font>';
		paysys.insertBefore(newTd, paysys.children[0]);
		var newTd = document.createElement('td');
		newTd['id'] = 'new1';
		newTd.innerHTML = '<input type="text" name="purse" size="15"><input type="hidden" name="ps" value="'+name+'"><input type="hidden" name="card">';
		paysys.insertBefore(newTd, paysys.children[1]);
		var newTd = document.createElement('td');
		newTd['id'] = 'new2';
		newTd.innerHTML = '<font color="#000;">Имя, Фамилия держателя:</font>';
		person.insertBefore(newTd, person.children[0]);
		var newTd = document.createElement('td');
		newTd['id'] = 'new3';
		newTd.innerHTML = '<input type="text" name="person" size="15">';
		person.insertBefore(newTd, person.children[1]);
		min = 65000;
		document.getElementById('str_min').style.display = 'inline';
		document.getElementById('min').innerHTML = min;
		document.getElementById('name_ps').innerHTML = name;
	}
}
</script>
    <div align="center">

                      <div class="selectPS" >
                            <div class="imagesps" style="background: url(/img/ps/payeer.png) no-repeat 50%;" onclick="addfield('eps','Payeer');"></div>
                            <label>Выплаты Payeer</label>
                    </div>
                        <div class="selectPS" >
                            <div class="imagesps" style="background: url(/img/ps/qiwi.png) no-repeat 50%;" onclick="addfield('phone','QIWI');"></div>
                            <label>Выплаты QIWI</label>
                    </div>
                            <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/yandex.png) no-repeat 50%;" onclick="addfield('eps','Яндекс');"></div>
                            <label>Выплаты Яндекс.Деньги</label>
                    </div>
				 
                            <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/beeline.png) no-repeat 50%;" onclick="addfield('phone','Билайн');"></div>
                            <label>Выплаты на сотовый (БИЛАЙН)</label>
                    </div>
                                        <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/megafon.png) no-repeat 50%;" onclick="addfield('phone','Мегафон');"></div>
                            <label>Выплаты на сотовый (МЕГАФОН)</label>
                    </div>
                                        <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/mts.png) no-repeat 50%;" onclick="addfield('phone','МТС');"></div>
                            <label>Выплаты на сотовый (МТС)</label>
                    </div>
                                        <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/tele2.png) no-repeat 50%;" onclick="addfield('phone','ТЕЛЕ2');"></div>
                            <label>Выплаты на сотовый (ТЕЛЕ2)</label>
                    </div>
                                         <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/visa.png) no-repeat 50%;"  onclick="addfield('card','VISA');"></div>
                            <label>Выплаты VISA</label>
                    </div>
                                        <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/master.png) no-repeat 50%;" onclick="addfield('card','MASTERCARD');"></div>
                            <label>Выплаты MASTERCARD</label>
                    </div>
                                        <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/maestro.png) no-repeat 50%;" onclick="addfield('card','MAESTRO');"></div>
                            <label>Выплаты MAESTRO</label>
                    </div>  
                            
    </div>
	
<br><center><b>
Ваш суточный максимум: <font color = 'red'><?=$maxforonepay/$sonfig_site["ser_per_wmr"];?> РУБ.</font><br>
За последние сутки Вы вывели: <font color = 'red'><?=$last24pay/$sonfig_site["ser_per_wmr"];?>  РУБ.</font><br>
За все время Вы вывели: <font color = 'red'><?=sprintf("%.2f",$user_data["payment_sum"]);?>  РУБ.</font><br>
Из возможных Ваших: <font color = 'red'><?=$max_pay/$sonfig_site["ser_per_wmr"] ;?> РУБ.</font><br>
</b></center><br><br>
	
	<center> 
<div id="str_min" style="display:none">Минимальная сумма выплаты на <span id="name_ps"></span> составляет <span id="min"></span> монет.</div><br> 

<form action="" method="post">
 <table class="data_table" width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr id="paysys"></tr>
  <tr id="person"></tr>
  <tr>
    <td><font color="#000;">Сумма для вывода</font><font color="#000;">:</font> </td>
	<td><input type="text" name="sum" id="sum" value="<?=round($user_data['money_p']-0.51); ?>" size="15"></td>
  </tr>
 

  <tr>
    <td colspan="2" align="center">
	<input type="submit" name="swap" class="btn btn-success" value="Заказать выплату" style="height: 50px; margin-top:15px;" /></td>
	 <td colspan="2" align="center"></td>
  </tr>
 
    </center>
 
</table>
</form>
<?$minPay = '';?>
<script language="javascript">PaymentSum(); SetVal();</script>
 <br> 
 
<table cellpadding='3' cellspacing='0' border='2' bordercolor='#336633' align='center' width="99%">
  <tr>
    <td colspan="6" align="center"><h4>Последние 20 выплат</h4></td>
    </tr>
  <tr>
    <td align="center" class="m-tb">Рубли</td>
    <td align="center" class="m-tb">Получаете</td>
	<td align="center" class="m-tb">ПС</td>
	<td align="center" class="m-tb">Кошелек</td>
	<td align="center" class="m-tb">Дата</td>
	<td align="center" class="m-tb">Статус</td>
  </tr>
  <?PHP
  
  $db->Query("SELECT * FROM db_payment WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 20");
  
	if($db->NumRows() > 0){
	$img = Array(
		'1136053'=>'payeer',
		'60792237'=>'qiwi',
		'25344'=>'yandex',
		'24898938'=>'beeline',
		'24899391'=>'megafon',
		'24899291'=>'mts',
		'95877310'=>'tele2',
		'117146509' =>'visa',
		'57644634' =>'master',
		'57766314' =>'maestro'
		);
  		while($ref = $db->FetchArray()){
		
		?>
		<tr class="htt">
    		<td align="center"><?=$ref["serebro"]; ?></td>
    		<td align="center"><?=sprintf("%.2f",$ref["sum"] - $ref["comission"]); ?> <?=$ref["valuta"]; ?></td>
			<td align="center"><? if(!empty($ref["pay_sys_id"])){echo '<img src="/img/ps/'.$img[$ref["pay_sys_id"]].'.png" width="25px">';}?></td>
    		<td align="center"><?=$ref["purse"]; ?></td>
			<td align="center"><?=date("d.m.Y в H:i:s",$ref["date_add"]); ?></td>
    		<td align="center"><?=$status_array[$ref["status"]]; ?></td>
  		</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="6">Нет записей</td></tr>'
  
  ?>

</table>
</div>				  </div>  