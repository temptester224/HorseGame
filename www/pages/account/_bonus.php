<?PHP
$_OPTIMIZATION["title"] = "���������� �����";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];

# ��������� �������
$bonus_min = 10;
$bonus_max = 100;

?>
<div class="col-sm-12 col-lg-6">
	<blockquote>
        <h2 style="margin-top: 2%;">���������� �����</h2>
        </blockquote>
</div>

        </div>
            <div class="container-fluid">
                <div class="row cm-fix-height">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">����� ��������������:</div>
                            <div class="panel-body text-center">
                                <h1 style="margin-top: 0;">
                                    ����� ������ <small>��</small>
                                </h1>
                                <h2>
                                    <b>0.10</b><span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style> �� <small>0.20<span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style></small>
                                </h2>
              
                            <form action="" method="post">
                            <input type="hidden" name="_tocken" value="b60f90c9cf5654151b7a229e4">
                            <button type="submit" name="bonus" class="btn btn-block btn-success waves-effect">�������� �����</button>
                            </form>
                                                        </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">���������� ������ ������</div>
                            <div class="panel-body">
                                <blockquote style="margin: 0;">
                                    <p>��������� ����������� ������, ������� ������ �/��� ����������� ���������. �������� ����� ����������, ��� ����������:</p>
                                    <footer>�� ���������� ��������� � �� ����� <cite title="Source Title">���������</cite>!</footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
<?PHP
$ddel = time() + 60*60*24;
$dadd = time();

    $db->Query("SELECT user, referer_id FROM db_users_a WHERE id = '$usid' LIMIT 1");
   $user_ardata = $db->FetchArray();
   $user_name = $user_ardata["user"];
   $refid = $user_ardata["referer_id"];

$db->Query("SELECT COUNT(*) FROM db_bonus_list WHERE user_id = '$usid' AND date_del > '$dadd'");

$hide_form = false;

	if($db->FetchRow() == 0){
	
		# ������ ������
		if(isset($_POST["bonus"])){
		
		
			$sum = rand($bonus_min, rand($bonus_min, $bonus_max));
			$sum=$sum / 100;
			
			# ��������� ������
			$db->Query("UPDATE db_users_b SET money_p = money_p + '$sum' WHERE id = '$usid'");
			
			# ������ ������ � ������ �������
			
			
			$db->Query("INSERT INTO db_bonus_list (user, user_id, sum, date_add, date_del) VALUES ('$uname','$usid','$sum','$dadd','$ddel')");
			
			echo "<br><br><center><font color = 'green'>�� ��� ���� �������� ����� � ������� {$sum} ���.</font></center><BR />";
			 
			$hide_form = true;
			
		}
			
			# ���������� ��� ��� �����
			if(!$hide_form){
?>


<?PHP

}

}else

{
$db->Query("SELECT * FROM db_bonus_list WHERE user_id = '$usid' order by ID DESC limit 1");
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
?>


<script>setInterval(function(){
$("#bonus").load("# #bonus"); }, 1000); </script>

    <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4>��������� 20 ���������� �������</h4>
                                </div>
                            <div class="panel-body">
                                <table class="table" style="margin-bottom: 0;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">�����</th>
                                            <th class="text-center">����</th>
                                            <th class="text-center">�����</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                            <tr class="text-center">
  <?PHP
  
  $db->Query("SELECT * FROM `db_bonus_list` ORDER BY `id` DESC LIMIT 20");
  
	if($db->NumRows() > 0){
  
  		while($bon = $db->FetchArray()){
		
		?>
    		 <td><?=$bon["user"]; ?></td>
    		 <td><?=$bon["sum"]; ?></td>
			 <td><?=date("d.m.Y",$bon["date_add"]); ?></td>
  		</tr>
		<?PHP
		
		}
  
	}else echo "<center>������� �� �������!</center>"
  ?>

  
</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
  
              </div>

            </div>