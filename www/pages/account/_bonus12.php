<?PHP
$_OPTIMIZATION["title"] = "���������� �����";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];


$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

# ��������� �������
$bonus_min = 1;
$bonus_max = 300;

?>
<div class="s-bk-lf">
<div class="acc-title">����� Light Invests</div>
</div>
<div class="silver-bk">
<div class="clr"></div>

<div class="s-bk-lf">
</div>

<div class="clr"></div>
<ul class="bonus-menu">
 <li><a href="/account/bonus11">Min Invests</a></li> 
  <li><a href="/account/bonus12">Light Invests</a></li>
  <li><a href="/account/bonus13">Stan Invests</a></li>
  <li><a href="/account/bonus14">Max Invests</a></li>
</ul> 
   <td colspan="2"><hr></td>

<center>����� ����� �������� 1 ��� � 24 ���� �� ���� ��� ������. <BR />
����� ������ ������������ �������� �� <font color = '#6F4B16'><b>1</b> �� <b>300</b></font> ������� � �������� ������������� ����������� ������ �� ����� ����� <b>1000 ������</b>.</center>
</p>



<?PHP
# �������� �� ����������
if($user_data["insert_sum"] <= 999.99){

?>
<center><font color="red"><b>����������� ����� ���������� ��� ��������� ������ ���������� 1000 ���!<b></font></center><BR />

<div class="clr"></div>		
</div>
<?PHP

return;
}

?>




<?PHP
$ddel = time() + 60*60*24;
$dadd = time();
$db->Query("SELECT COUNT(*) FROM db_bonus12_list WHERE user_id = '$usid' AND date_del > '$dadd'");

$hide_form = false;

	if($db->FetchRow() == 0){

		# ������ ������
		if(isset($_POST["bonus"])){

			$sum = rand($bonus_min, rand($bonus_min, $bonus_max) );

			# ��������� ������
			$db->Query("UPDATE db_users_b SET money_p = money_p + '$sum' WHERE id = '$usid'");

			# ������ ������ � ������ �������


			$db->Query("INSERT INTO db_bonus12_list (user, user_id, sum, date_add, date_del) VALUES ('$uname','$usid','$sum','$dadd','$ddel')");

			# ��������� ������� ���������� �������
			$db->Query("DELETE FROM db_bonus12_list WHERE date_del < '$dadd'");

			echo "<center><font color = ''><b>�� ��� ���� ��� ������� �������� ����� � ������� {$sum} �������</b></font></center><BR />";

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
  <tr>
    <td align="center"><input type="submit" name="bonus" value="�������� �����" style="height: 30px; margin-top:10px;"></td>
  </tr>
</table>
</form>

<?PHP

			}

	}else echo "<center><font color = 'red'><b></b></font></center><BR />"; ?>







<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
<?PHP
$db->Query("SELECT * FROM db_bonus12_list WHERE user = '$uname' LIMIT 1");
if($db->NumRows() > 0){
while($data_bonus = $db->FetchArray()){
?>
<center><font color="rgb(160, 178, 178);"><b>����� ����� �������� ��� ���������: <?=date("d.m � H:i:s",$data_bonus["date_del"]) ;?> </b></font></center>
<?PHP
}
}else echo "<center><font color = 'cadetblue'><b>�� ����� �� �������� �����, ������� ������, ����� ��������.</b></font></center>";
?>







  <tr>
    <td colspan="5" align="center"><h4>��������� 20 �������</h4></td>
    </tr>
  <tr>
<table width="99%" border="0" align="center">
  <tr bgcolor="#6F4B16">
    <td align="center" class="m-t">ID</td>
    <td align="center" class="m-t">������������</td>
	<td align="center" class="m-t">�����</td>
	<td align="center" class="m-t">����</td>
  </tr>
  <?PHP

  $db->Query("SELECT * FROM db_bonus12_list ORDER BY id DESC LIMIT 20");

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

<div class="clr"></div>
</div>


 <script LANGUAGE="JavaScript1.1">
document.oncontextmenu = function(){return false;};
</script> 


