<?PHP
$_OPTIMIZATION["title"] = "����� � ������";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];

# ��������� �������
$bonus_min = -35;
$bonus_max = 90;

?>
<section id="normalsec"></section><section id="content-1" class="account-page"><div class="row"><div class="twelve columns"><div class="un-row"><div class="un-col-3 account-nav-holder"><div class="account-nav">
	<?PHP include("inc/_user_menu.php"); ?>
	
</div></div>

        <div class="un-col-9 acc-main-content cashin-container operFormHolder"><h3 class="text-dark"><i class="acc-title-image" style="background-image:url('/img/cashin.png');"></i>����� � ������</h3><div class="errors_text"></div><div class="un-row acc-section"><div class="un-col-12">

<div class="content">

    <table class="acc-summary-table black_table" width="100%" style="text-align:center">

<BR />
<font color="0fff83">��� ����� ��� ��������� �������� :) ������ � ����� ���� �� �� ������ ����� ��������..
����� ������� 1 ��� � 96 �����. <BR />
����� �������� � ������� �� ���� ��� �������. <BR />
����� ������ ������������ �������� �� <b><?=$bonus_min;?></b> �� <b><?=$bonus_max;?></b> �����..</p></font>
<BR /><BR />
<?PHP
$ddel = time() + 60*60*96;
$dadd = time();

$db->Query("SELECT COUNT(*) FROM db_bonus_list2 WHERE user_id = '$usid' AND date_del > '$dadd'");

$hide_form = false;

	if($db->FetchRow() == 0){

		# ������ ������
		if(isset($_POST["bonus"])){

			$sum = rand($bonus_min, rand($bonus_min, $bonus_max) );

			# ��������� ������
			$db->Query("UPDATE db_users_b SET money_b = money_b + '$sum' WHERE id = '$usid'");

			# ������ ������ � ������ �������


			$db->Query("INSERT INTO db_bonus_list2 (user, user_id, sum, date_add, date_del) VALUES ('$uname','$usid','$sum','$dadd','$ddel')");

			# ��������� ������� ���������� �������
			$db->Query("DELETE FROM db_bonus_list2 WHERE date_del < '$dadd'");

			echo "<center><font color = 'blue'><b>�� ��� ���� ��� ������� �������� ����� � ������� {$sum} ���$</b></font></center><BR />";

			$hide_form = true;

		}

			# ���������� ��� ��� �����
			if(!$hide_form){
?>

<form action="" method="post">
<table width="330" border="0" align="center">
  <tr>
    <td align="center"></td>
  </tr>
 <center><input type="submit" name="bonus" value="��������" class="subm_button"></center><br><br>
  </tr>
</table>
</form>

<?PHP

			} 

	}else echo "<center><font color = 'blue'><b>�� ��� �������� ����� �� ��������� 96 ����� </b></font></center><BR />";  ?>  


<table cellpadding='3' cellspacing='0' border='0' bordercolor='blue' align='center' width="99%">
  <tr>
    <td colspan="5" align="center"><h4>��������� 10 �������</h4></td>
    </tr>
  <tr>
    <td align="center" class="m-tb">ID</td>
    <td align="center" class="m-tb">������������</td> 
	<td align="center" class="m-tb">�����</td>
	<td align="center" class="m-tb">����</td> 
  </tr>
  <?PHP

  $db->Query("SELECT * FROM db_bonus_list2 ORDER BY id DESC LIMIT 10");

	if($db->NumRows() > 0){

  		while($bon = $db->FetchArray()){

		?>
		<tr class="htt">
    		<td align="center"><?=$bon["id"]; ?></td>
    		<td align="center"><?=$bon["user"]; ?></td>
    		<td align="center"><?=$bon["sum"]; ?></td> 
			<td align="center"><?=date("d.m.Y",$bon["date_add"]); ?></td>
  		</tr>
		<?PHP

		}

	}else echo '<tr><td align="center" colspan="5">��� �������</td></tr>'
  ?>


</table>

</div>
</div>
</div>
