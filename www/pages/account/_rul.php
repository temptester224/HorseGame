<section id="normalsec"></section><section id="content-1" class="account-page"><div class="row"><div class="twelve columns"><div class="un-row"><div class="un-col-3 account-nav-holder"><div class="account-nav">
	<?PHP include("inc/_user_menu.php"); ?>
	
</div></div>

        <div class="un-col-9 acc-main-content cashin-container operFormHolder"><h3 class="text-dark"><i class="acc-title-image" style="background-image:url('/img/cashin.png');"></i>Игра Наперстки</h3><div class="errors_text"></div><div class="un-row acc-section"><div class="un-col-12">

<div class="content">

    <table class="acc-summary-table black_table" width="100%" style="text-align:center">
<br>
<font color="0fff83">ВНИМАНИЕ: монеты,которые Вы проиграли возврату не подлежит. <BR />
     <p>Суть игры очень проста <BR />
Необходимо угадать под каким наперстком спрятаны монеты!<BR />
В случае выигрыша ваша ставка увеличивается в 2 раза и зачисляется на баланс для вывода!
</font>
<BR /><BR />
<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Наперстки";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();
if (isset($_POST['stavka'])) {
$naper = intval($_POST['naper']);
$stavka = intval($_POST['stavka']);
$nap = rand(1,3);
$time = time();
		if($stavka <= $user_data['money_b']) {
			if($stavka >= 10) {
				if($naper == 1 or $naper ==  2 or $naper == 3) {
					if($naper == $nap) {
					$sum = $stavka * 2;
					$win = 1;
						echo "<center><font color='green'>Выиграли :) </font>";
						
						$db->Query("UPDATE db_users_b SET money_b = money_b + '$sum' where id = '$usid'");
						$db->Query("INSERT INTO db_nap (user_id, login, date, summa, win) VALUES ('$usid', '$uname', '$time', '$sum', '$win')");
						
					} else {
						echo "<center><font color='red'>Проиграли! :(</font>";
						$win = 0;
						$db->Query("UPDATE db_users_b SET money_b = money_b - '$stavka' where id = '$usid'");
						$db->Query("INSERT INTO db_nap (user_id, login, date, summa, win) VALUES ('$usid', '$uname', '$time', '$stavka', '$win')");
					}
				}else echo "<center><font color='red'>Вы не выбрали наперсток</font>";
			}else echo "<center><font color='red'>Минимальная ставка - 10 серебра!</font>";
		}else echo "<center><font color='red'>Недостаточно средств на балансе!</font>";
}
?>



<div class="clr"></div>	
  <style>
   .text {
    text-align:  center;
   }
  </style>
 </head>
 <body>
  <div class="text">

<BR /><BR /></p>
  </div>
 </body>
</html>

<center>

<form method="post" action="">
<div class="input-container bottom-brd">
<input class="lg" type="text" name="stavka" value="100"><br>
<center>
<table align="center">
<tr>
<td>
<?php
if ($win == 1 and $naper == 1) {
?>
<img src="/img/nap2.png">
<? } else { ?>
<img src="/img/nap1.png">
<? } ?>
</td>
<td>
&nbsp;
</td>
<td>
<?php
if ($win == 1 and $naper == 2) {
?>
<img src="/img/nap2.png">
<? } else { ?>
<img src="/img/nap1.png">
<? } ?>
</td>
<td>
&nbsp;
</td>
<td>
<?php
if ($win == 1 and $naper == 3) {
?>
<img src="/img/nap2.png">
<? } else { ?>
<img src="/img/nap1.png">
<? } ?>
</td>
<td>
&nbsp;
</td>
</tr>


<tr>
<td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="naper" value="1">
</td>
<td>
&nbsp;
</td>
<td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="naper" value="2">
</td>
<td>
&nbsp;
</td>
<td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="naper" value="3">
</td>
<td>
&nbsp;
</td>
</tr>

</table>
</center>
<br>
<input class="subm_button" type="submit" value="Играть">

</form>
<center><h3>Ваши последние игры</h3></center><p>
    
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  
  <tr>
    <td align="center" class="m-tb">Сумма</td>
	<td align="center" class="m-tb">Дата</td>
	<td align="center" class="m-tb">Статус</td>
	
  </tr>
  <?PHP
  
  $db->Query("SELECT * FROM db_nap WHERE user_id = '$usid' ORDER BY id DESC LIMIT 20");
  
	if($db->NumRows() > 0){
  
  		while($ref = $db->FetchArray()){
		if ($ref["win"] == 1) { 
		$winn = '<font color="green">Победа</font>'; 
		} else { 
		$winn = '<font color="red">Проигрыш</font>'; 
		}
		$date = date('d-m-Y', $ref["date"]);
		?>
		<tr class="htt">
    		<td align="center"><?=$ref["summa"]; ?> </td>
			<td align="center"><?=$date; ?></td>
			<td align="center"><?=$winn; ?></td>
    		
  		</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="5">Нет записей</td></tr>'
  
  ?>

  
  
</table>




</div>
</div>
<div class="text_pages_bottom"></div>
</div>


