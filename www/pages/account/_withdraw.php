<div class="col-sm-12 col-lg-6">
	<blockquote>
        <h2 style="margin-top: 2%;">����� �������</h2>
        </blockquote>
</div>

        </div>
            <div class="container-fluid">
                <div class="row">
<?PHP
 // by Raccoon
$_OPTIMIZATION["title"] = "������� - ����� �������";
$user_id = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$user_id' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$config_site = $db->FetchArray();

$status_array = array( 0 => "�����������", 1 => "�������������", 2 => "��������", 3 => "���������");
# ��������� ��������!
$minPay = 5;
/*if($user_id != '1'){
	echo '<center><b><font color = "red">������� ����������� ������</font></b></center><BR />';
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

$status_array = array( 0 => "�����������", 1 => "�������������", 2 => "��������", 3 => "���������");

$nd_time = time() - 60*60*24;
$db->Query("SELECT * FROM db_payment WHERE user_id = '$usid' AND date_add >= '$nd_time' order by id DESC");

$frompayments = $db->FetchArray();
$last24pay = $frompayments["sum"]*$sonfig_site["ser_per_wmr"];

# ����������� ���-�� ����� ��� �����������.
$maxforonepay = 2.0*$sonfig_site["ser_per_wmr"]*$user_data["insert_sum"] + 1.00*$user_data["from_referals"];
$max_pay = 3.0*$sonfig_site["ser_per_wmr"]*$user_data["insert_sum"] + $user_data["from_referals"];

# ��������� ��������!
$minPay = 5;
/*if($user_id != '1'){
	echo '<center><b><font color = "red">������� ����������� ������</font></b></center><BR />';
	return;
}*/
?>

<?
// ������ �������� �� �������������� ������� :)
$sumClose = 0; // �������� �� 30 ������

if($user_data["insert_sum"] < $sumClose){
$rest = $sumClose - $user_data["insert_sum"];
?>
<center><font color="red"><b>�� �� ������ �������� �������!<p>��� �������� ��������� ������� ������ �� <?=$rest?> ������!</center>
<BR /><BR />
 
<?PHP

return;
}

?>
<center><font color="red">������� �������� ��������� ������� �� ������, ����� ������� ����� ����� � ����� ����: </font></center> 
<BR />
<?PHP
$ddel = time() + 60*60*3;
$dadd = time();

# �������� �� ���� �������
$db->Query("SELECT COUNT(*) FROM db_pay_dat WHERE user_id = '$usid' AND date_del > '$dadd'");
 if($db->FetchRow() == 0){
# ������� �������
if(isset($_POST['swap'])){ // ��������: ���� �� ���������� �����
	if(!empty($_POST['purse'])){
		$ps = Array(
		'Payeer'=>'1136053',
		'QIWI'=>'60792237',
		'������'=>'25344',
		'������'=>'24898938',
		'�������'=>'24899391',
		'���'=>'24899291',
		'����2'=>'95877310',
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
			if($_POST['ps'] == '������'){
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
					if( !preg_match("#^([a-zA-Z�-���������������������������������\.\-\' ]+)$#",$person) ) return false;
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
					# ��������� �� ������������ ������
						$db->Query("SELECT COUNT(*) FROM db_payment WHERE user_id = '$user_id' AND (status = '0' OR status = '1')");
						if($db->FetchRow() == 0){
							$sum_pay = round( ($sum / $config_site['ser_per_wmr']), 2);
							# ������ �������
								$payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
								if ($payeer->isAuth()){
									
									$arBalance = $payeer->getBalance();
									if($arBalance['auth_error'] == 0){

										$balance = $arBalance['balance']['RUB']['DOSTUPNO'];
										if($balance >= $sum_pay){
											$array = array(
												'action' => 'output',
												'ps' => $ps,
												'curIn' => $val, // ���� ��������
												'sumOut' => $sum_pay, // ����� ���������
												'curOut' => $val, // ������ ���������
												'param_ACCOUNT_NUMBER' => $purse // ����������
											);
											if(!empty($person)){
												$array['param_CONTACT_PERSON'] = $person;
											}
											$initOutput = $payeer->initOutput($array);
											if ($initOutput){
												$historyId = $payeer->output();
													if ($historyId > 0){
													# ������� � ������������
														$db->Query("UPDATE db_users_b SET money_p = money_p - '$sum', payment_sum = payment_sum + '$sum_pay' WHERE id = '$user_id'");
														
														# ��������� ������ � �������
														$da = time();
														$dd = $da + 60*60*24*15;
														
														$ppid = $arTransfer["historyId"];
															
														$db->Query("INSERT INTO db_payment (user, user_id, purse, sum, valuta, serebro, pay_sys_id, payment_id, date_add, status) VALUES ('$usname','$user_id','$purse','$sum_pay','RUB', '$sum', '$ps', '$ppid','".time()."', '3')");
															
														$db->Query("UPDATE db_stats SET all_payments = all_payments + '$sum_pay' WHERE id = '1'");
														
																												# ������� ������ �� ������� ������� � ����
														$db->Query("INSERT INTO db_pay_dat (user, user_id, sum, date_add, date_del) VALUES ('$uname','$usid','$sum','$dadd','$ddel')");
                                           
														
														echo "<center><font color = 'green'><b>���������!</b></font></center><BR />";
														$db->Query("SELECT * FROM db_users_b WHERE id = '$user_id' LIMIT 1");
														$user_data = $db->FetchArray();
													}else{
														echo '<center><font color = "red"><b>������ ['.print_r($payeer->getErrors(), true).'] - ���������� ����� 10-15 ������ ��� �������� � ��� ��������������!</b></font></center><BR />';
													}
											}else{
												echo '<center><font color = "red"><b>������ ['.print_r($payeer->getErrors(), true).'] - ���������� ����� 10-15 ������ ��� �������� � ��� ��������������!</b></font></center><BR />';
											}
										}else echo '<center><font color = "red"><b>������ ���������� - ���������� ����� 10-15 ������ ��� �������� � ��� ��������������</b></font></center><BR />';
									}else echo '<center><font color = "red"><b>�� ������� ���������! ���������� �����.</b></font></center><BR />';
								}else echo '<center><font color = "red"><b>�� ������� ���������! ���������� �����. ������ � 631 </b></font></center><BR />';
							}else echo '<center><font color = "red"><b>� ��� ������� �������������� ������. ��������� �� ����������.</b></font></center><BR />';
					}else echo '<center><font color = "red"><b>�� ������� ������, ��� ������� �� ����� �����.</b></font></center><BR />';
                }else echo "<center><font color = 'red'><b>�� ������� �����, ������� ��������� �������� �������� ��� ������!</b></font></center><BR />";
				}else echo "<center><font color = 'red'><b>�� ������� �����, ������� ��������� �������� ��� ������!</b></font></center><BR />";
				 }else echo "<center><font color = 'red'><b>� ��������� 24 ���� �� ��� �������� �������! ���������� �����</b></font></center>";
				}else echo '<center><b><font color = "red">����������� ����� ��� ������� ���������� '.$minPay.' ������!</font></b></center><BR />';
				}else echo '<center><b><font color = "red">������ ��������� ����� ������� �������!</font></b></center><BR />';
			}else echo '<center><b><font color = "red">����� ����� '.$purse.' ������ �������</font></b></center><BR />';
		}else echo '<center><b><font color = "red">��������� ������� �� �������!</font></b></center><BR />';
		
		
	}else echo '<center><b><font color = "red">�� �� ����� ����� ��������</font></b></center><BR />';
	 
	}

	}else echo "<center><div class='alert alert-success'><font color = 'red'><b>������� ����� ��������� �� ���� ��� 1 ��� � 3 ����</b></font></div></center><BR />";
	

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
		newTd.innerHTML = '<font color="#000;">����� �������� '+name+':</font>';
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
		newTd.innerHTML = '<font color="#000;">����� ����� '+name+':</font>';
		paysys.insertBefore(newTd, paysys.children[0]);
		var newTd = document.createElement('td');
		newTd['id'] = 'new1';
		newTd.innerHTML = '<input type="text" name="purse" size="15"><input type="hidden" name="ps" value="'+name+'">';
		paysys.insertBefore(newTd, paysys.children[1]);
		min = <?=$minPay;?>;
		if(name == '������'){min = 1000;}
		document.getElementById('str_min').style.display = 'inline';
		document.getElementById('min').innerHTML = min;
		document.getElementById('name_ps').innerHTML = name;
	}	
	if(ps == 'card'){
		var newTd = document.createElement('td');
		newTd['id'] = 'new';
		newTd.innerHTML = '<font color="#000;">����� ����� '+name+':</font>';
		paysys.insertBefore(newTd, paysys.children[0]);
		var newTd = document.createElement('td');
		newTd['id'] = 'new1';
		newTd.innerHTML = '<input type="text" name="purse" size="15"><input type="hidden" name="ps" value="'+name+'"><input type="hidden" name="card">';
		paysys.insertBefore(newTd, paysys.children[1]);
		var newTd = document.createElement('td');
		newTd['id'] = 'new2';
		newTd.innerHTML = '<font color="#000;">���, ������� ���������:</font>';
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
                            <label>������� Payeer</label>
                    </div>
                        <div class="selectPS" >
                            <div class="imagesps" style="background: url(/img/ps/qiwi.png) no-repeat 50%;" onclick="addfield('phone','QIWI');"></div>
                            <label>������� QIWI</label>
                    </div>
                            <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/yandex.png) no-repeat 50%;" onclick="addfield('eps','������');"></div>
                            <label>������� ������.������</label>
                    </div>
				 
                            <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/beeline.png) no-repeat 50%;" onclick="addfield('phone','������');"></div>
                            <label>������� �� ������� (������)</label>
                    </div>
                                        <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/megafon.png) no-repeat 50%;" onclick="addfield('phone','�������');"></div>
                            <label>������� �� ������� (�������)</label>
                    </div>
                                        <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/mts.png) no-repeat 50%;" onclick="addfield('phone','���');"></div>
                            <label>������� �� ������� (���)</label>
                    </div>
                                        <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/tele2.png) no-repeat 50%;" onclick="addfield('phone','����2');"></div>
                            <label>������� �� ������� (����2)</label>
                    </div>
                                         <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/visa.png) no-repeat 50%;"  onclick="addfield('card','VISA');"></div>
                            <label>������� VISA</label>
                    </div>
                                        <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/master.png) no-repeat 50%;" onclick="addfield('card','MASTERCARD');"></div>
                            <label>������� MASTERCARD</label>
                    </div>
                                        <div class="selectPS">
                            <div class="imagesps" style="background: url(/img/ps/maestro.png) no-repeat 50%;" onclick="addfield('card','MAESTRO');"></div>
                            <label>������� MAESTRO</label>
                    </div>  
                            
    </div>
	
<br><center><b>
��� �������� ��������: <font color = 'red'><?=$maxforonepay/$sonfig_site["ser_per_wmr"];?> ���.</font><br>
�� ��������� ����� �� ������: <font color = 'red'><?=$last24pay/$sonfig_site["ser_per_wmr"];?>  ���.</font><br>
�� ��� ����� �� ������: <font color = 'red'><?=sprintf("%.2f",$user_data["payment_sum"]);?>  ���.</font><br>
�� ��������� �����: <font color = 'red'><?=$max_pay/$sonfig_site["ser_per_wmr"] ;?> ���.</font><br>
</b></center><br><br>
	
	<center> 
<div id="str_min" style="display:none">����������� ����� ������� �� <span id="name_ps"></span> ���������� <span id="min"></span> �����.</div><br> 

<form action="" method="post">
 <table class="data_table" width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr id="paysys"></tr>
  <tr id="person"></tr>
  <tr>
    <td><font color="#000;">����� ��� ������</font><font color="#000;">:</font> </td>
	<td><input type="text" name="sum" id="sum" value="<?=round($user_data['money_p']-0.51); ?>" size="15"></td>
  </tr>
 

  <tr>
    <td colspan="2" align="center">
	<input type="submit" name="swap" class="btn btn-success" value="�������� �������" style="height: 50px; margin-top:15px;" /></td>
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
    <td colspan="6" align="center"><h4>��������� 20 ������</h4></td>
    </tr>
  <tr>
    <td align="center" class="m-tb">�����</td>
    <td align="center" class="m-tb">���������</td>
	<td align="center" class="m-tb">��</td>
	<td align="center" class="m-tb">�������</td>
	<td align="center" class="m-tb">����</td>
	<td align="center" class="m-tb">������</td>
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
			<td align="center"><?=date("d.m.Y � H:i:s",$ref["date_add"]); ?></td>
    		<td align="center"><?=$status_array[$ref["status"]]; ?></td>
  		</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="6">��� �������</td></tr>'
  
  ?>

</table>
</div>				  </div>  