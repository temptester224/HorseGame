<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Инвесторский бонус";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];

# Настройки бонусов
$bonus_min = 10;
$bonus_max = 200;
$db->Query("SELECT insert_sum FROM db_users_b WHERE id = '$usid'");
$prof_data1 = $db->FetchArray();
$dopusk=$prof_data1["insert_sum"];
?>
<div class="col-sm-12 col-lg-6">
	<blockquote>
        <h2 style="margin-top: 2%;">Инвесторский бонус</h2>
        </blockquote>
</div>

        </div>
            <div class="container-fluid">
                <div class="row cm-fix-height">
                    <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body" align="center">
            <p><code>Бонус выдется 1 раз в 24 часа.</code></p>
            <h2><b>Бонус выдается на счет для выплаты. </b></h2>                   
             </div>
           </div>
        </div>

        <div class="col-lg-8">
          <div class="panel panel-default">
                            <div class="panel-body">
                                <blockquote style="margin: 0;">
                                    <p>При условии что Вы являетесь активным инвестором в проекте и пополнили свой игровой счет на сумму не менее чем 200 рублей, можете получать ежедневный бонус.<br> <br>Сумма бонуса генерируется случайно от <b>0.10</b> до <b>20</b> рублей.</div></center></p>
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
	
		# Выдача бонуса
		if(isset($_POST["bonus"])){
		
			$sum = rand($bonus_min, rand($bonus_min, $bonus_max));
			$sum=$sum / 100;
			
			# Зачилсяем юзверю
			$db->Query("UPDATE db_users_b SET money_p = money_p + '$sum' WHERE id = '$usid'");
			
			# Вносим запись в список бонусов
			
			
			$db->Query("INSERT INTO db_bonus_listinvestor (user, user_id, sum, date_add, date_del) VALUES ('$uname','$usid','$sum','$dadd','$ddel')");
			
			# Случайная очистка устаревших записей
			$db->Query("DELETE FROM db_bonus_listinvestor WHERE date_del < '$dadd'");
			
			echo "<center><font color = '#1900CF'><b>На Ваш счет для покупок зачислен бонус в размере {$sum} руб!</b></font></center><BR />";
			
			$hide_form = true;
			
		}
			
			# Показывать или нет форму
			if(!$hide_form){
?>

<form action="" method="post">
<table width="330" border="0" align="center">
  <tr>
    <td align="center"></td>
  </tr>
<tr height="5">
    <td align="center"><input type="submit" name="bonus" value="Получить бонус" class="btn btn-block btn-primary waves-effect"></td>
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

//echo $data['sec'] - time().' сек.';
//echo "<b>$hours:$min:$seconds</font></b>";
echo "<div id='bonus'><center><font color = 'red'><b>Получение бонуса будет доступно через&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo json_encode($hours);echo ' ч. ';echo json_encode($min);echo ' мин. '; echo json_encode($seconds);echo ' сек. ';
echo '</font></b></b></font></center></div><BR />';
}
}else echo '<tr><td align="center" colspan="5"><font color = red><b><center>Бонус могут получить пользователи, которые пополнили баланс на сумму больше 200 рублей.</center></b></font></td></tr><br><br>';
?>
<script>setInterval(function(){
$("#bonus").load("# #bonus"); }, 1000); </script>



  <div class="row">
                          <div class="col-md-12">
                        <div class="panel panel-default">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center"> Пользователь</th>
                                        <th class="text-center">Сумма </th>
                                        <th class="text-center">Дата</th>
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
  
	}else echo '<tr><td align="center" colspan="5">Нет записей</td></tr>'
  ?>

   </tbody>
                            </table>
                        </div>
                    </div>

</table>

 </div>
                    </div>