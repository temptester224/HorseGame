<?PHP
$_OPTIMIZATION["title"] = "������� - ������������ �����";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];

# ��������� �������
$bonus_min = 10;
$bonus_max = 200;
$db->Query("SELECT insert_sum FROM db_users_b WHERE id = '$usid'");
$prof_data1 = $db->FetchArray();
$dopusk=$prof_data1["insert_sum"];
?>
<div class="col-sm-12 col-lg-6">
	<blockquote>
        <h2 style="margin-top: 2%;">������������ �����</h2>
        </blockquote>
</div>

        </div>
            <div class="container-fluid">
                <div class="row cm-fix-height">
                    <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body" align="center">
            <p><code>����� ������� 1 ��� � 24 ����.</code></p>
            <h2><b>����� �������� �� ���� ��� �������. </b></h2>                   
             </div>
           </div>
        </div>

        <div class="col-lg-8">
          <div class="panel panel-default">
                            <div class="panel-body">
                                <blockquote style="margin: 0;">
                                    <p>��� ������� ��� �� ��������� �������� ���������� � ������� � ��������� ���� ������� ���� �� ����� �� ����� ��� 200 ������, ������ �������� ���������� �����.<br> <br>����� ������ ������������ �������� �� <b>0.10</b> �� <b>20</b> ������.</div></center></p>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                </div>
<?PHP
$ddel = time() + 60*60*24;
$dadd = time();
if($dopusk>=200){
$db->Query("SELECT COUNT(*) FROM db_bonus_listinvestor WHERE user_id = '$usid' AND date_del > '$dadd'");

$hide_form = false;

	if($db->FetchRow() == 0){
	
		# ������ ������
		if(isset($_POST["bonus"])){
		
			$sum = rand($bonus_min, rand($bonus_min, $bonus_max));
			$sum=$sum / 100;
			
			# ��������� ������
			$db->Query("UPDATE db_users_b SET money_p = money_p + '$sum' WHERE id = '$usid'");
			
			# ������ ������ � ������ �������
			
			
			$db->Query("INSERT INTO db_bonus_listinvestor (user, user_id, sum, date_add, date_del) VALUES ('$uname','$usid','$sum','$dadd','$ddel')");
			
			# ��������� ������� ���������� �������
			$db->Query("DELETE FROM db_bonus_listinvestor WHERE date_del < '$dadd'");
			
			echo "<center><font color = '#1900CF'><b>�� ��� ���� ��� ������� �������� ����� � ������� {$sum} ���!</b></font></center><BR />";
			
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
<tr height="5">
    <td align="center"><input type="submit" name="bonus" value="�������� �����" class="btn btn-block btn-primary waves-effect"></td>
</tr>
</table>
</form><br><br>

<?PHP

}

}else

{
$db->Query("SELECT * FROM db_bonus_listinvestor WHERE user_id = '$usid' order by ID DESC limit 1");
$u_data = $db->FetchArray();
$time = $u_data['date_del'] - $dadd;
$hours = floor($time/3600);
floor($minutes =($time/3600 - $hours)*60);
$seconds = ceil(($minutes - floor($minutes))*60);
$min=ceil($minutes)-1;

//echo $data['sec'] - time().' ���.';
//echo "<b>$hours:$min:$seconds</font></b>";
echo "<div id='bonus'><center><font color = 'red'><b>��������� ������ ����� �������� �����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo json_encode($hours);echo ' �. ';echo json_encode($min);echo ' ���. '; echo json_encode($seconds);echo ' ���. ';
echo '</font></b></b></font></center></div><BR />';
}
}else echo '<tr><td align="center" colspan="5"><font color = red><b><center>����� ����� �������� ������������, ������� ��������� ������ �� ����� ������ 200 ������.</center></b></font></td></tr><br><br>';
?>
<script>setInterval(function(){
$("#bonus").load("# #bonus"); }, 1000); </script>



  <div class="row">
                          <div class="col-md-12">
                        <div class="panel panel-default">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center"> ������������</th>
                                        <th class="text-center">����� </th>
                                        <th class="text-center">����</th>
                                    </tr>
                                </thead>
                                <tbody>

  <?PHP
  
  $db->Query("SELECT * FROM db_bonus_listinvestor ORDER BY id DESC LIMIT 20");
  
	if($db->NumRows() > 0){
  
  		while($bon = $db->FetchArray()){
		
		?>
		   <tr class="text-center">
    		<td><a href="/account/wall/<?=$bon["user"]; ?>"><?=$bon["user"]; ?></a></td>
    		<td><?=$bon["sum"]; ?></td>
			<td><?=date("d.m.Y",$bon["date_add"]); ?></td>
  		</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="5">��� �������</td></tr>'
  ?>

   </tbody>
                            </table>
                        </div>
                    </div>

</table>

 </div>
                    </div>