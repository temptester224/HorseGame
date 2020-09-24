<?
######################################
// ЗАЩИТА + 2
######################################
# Счетчик
function TimerSet(){
	list($seconds, $microSeconds) = explode(' ', microtime());
	return $seconds + (float) $microSeconds;
}













error_reporting(E_ALL);
ini_set('display_errors', 0);


//error_reporting(0); // вывод ошибок


if($_GET['menu']!='area' && 'support'){
function limpiarez($mensaje){
$mensaje = htmlspecialchars(trim($mensaje));
$mensaje = str_replace("'","&prime;",$mensaje);
$mensaje = str_replace(";","&brvbar;",$mensaje);
$mensaje = str_replace("$"," USD ",$mensaje);
$mensaje = str_replace("<","&lang;",$mensaje);
$mensaje = str_replace(">","&rang;",$mensaje);
$mensaje = str_replace('"',"&rdquo;",$mensaje);
$mensaje = str_replace("%27"," ",$mensaje);
$mensaje = str_replace("0x29"," ",$mensaje);
$mensaje = str_replace("&amp amp ","&",$mensaje);
return $mensaje;
}

foreach($HTTP_POST_VARS as $i => $value){$HTTP_POST_VARS[$i]=limpiarez($HTTP_POST_VARS[$i]);}
foreach($HTTP_GET_VARS as $i => $value){$HTTP_GET_VARS[$i]=limpiarez($HTTP_GET_VARS[$i]);}
foreach($_POST as $i => $value){$_POST[$i]=limpiarez($_POST[$i]);}
foreach($_GET as $i => $value){$_GET[$i]=limpiarez($_GET[$i]);}
foreach($_COOKIE as $i => $value){$_COOKIE[$i]=limpiarez($_COOKIE[$i]);}


foreach($HTTP_POST_VARS as $i => $value){$HTTP_POST_VARS[$i]=stripslashes($HTTP_POST_VARS[$i]);}
foreach($HTTP_GET_VARS as $i => $value){$HTTP_GET_VARS[$i]=stripslashes($HTTP_GET_VARS[$i]);}
foreach($_POST as $i => $value){$_POST[$i]=stripslashes($_POST[$i]);}
foreach($_GET as $i => $value){$_GET[$i]=stripslashes($_GET[$i]);}
foreach($_COOKIE as $i => $value){$_COOKIE[$i]=stripslashes($_COOKIE[$i]);}

################## Фильтрация всех POST и GET #######################################
function filter_sf(&$sf_array)
{
 while (list ($X,$D) = each ($sf_array)):
  $sf_array[$X] = limpiarez(mysql_escape_string(strip_tags(htmlspecialchars($D))));
 endwhile;
}
filter_sf($_GET);
filter_sf($_POST);
#####################################################################################

function anti_sql()
{
    $check = html_entity_decode( urldecode( $_SERVER['REQUEST_URI'] ) );
    $check = str_replace( "", "/", $check );

	$check = mysql_real_escape_string($str);
	$check = trim($str);
	$check = array("AND","UNION","SELECT","WHERE","INSERT","UPDATE","DELETE","OUTFILE","FROM","OR","SHUTDOWN","CHANGE","MODIFY","RENAME","RELOAD","ALTER","GRANT","DROP","CONCAT","cmd","exec");
    $check = str_replace($check,"",$str);


    if( $check )
	{
        if((strpos($check, '<')!==false) || (strpos($check, '>')!==false)  ||  (strpos($check, '"')!==false) || (strpos($check,"'")!==false) || (strpos($check, '*')!==false) || (strpos($check, '(')!==false) || (strpos($check, ')')!==false) || (strpos($check, ' ')!==false) || (strpos($check, ' ')!==false) || (strpos($check, ' ')!==false) )
		{
            $prover = true;
        }

		if((strpos($check, 'src')!==false) || (strpos($check, 'img')!==false) || (strpos($check, 'OR')!==false) ||  (strpos($check, 'Image')!==false) || (strpos($check, 'script')!==false) || (strpos($check, 'javascript')!==false) || (strpos($check, 'language')!==false) || (strpos($check, 'document')!==false) || (strpos($check, 'cookie')!==false) || (strpos($check, 'gif')!==false) || (strpos($check, 'png')!==false) || (strpos($check, 'jpg')!==false) || (strpos($check, 'js')!==false)  )
		{
            $prover = true;
        }

    }

    if (isset($prover))
    {
        die( "Доступ к сайту запрещен. Устраните вирусы или не используйте недопустимые символы!" );
		return false;
		exit;
    }
}
anti_sql();

}
?>


<?PHP
$_OPTIMIZATION["title"] = "Чат";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();
$dadd = time();
?>
<div class="s-bk-lf">
	<div class="acc-title">Чат</div>
</div>
<div class="silver-bk">
<h2><center>Правила:</center></h2>

<center>1. Запрещено использовать нецензурные выражения и спам.</center>

<center>2. Запрещено оставлять ссылки на другие сайты/проекты.      </center>

<center>3. Запрещено оставлять провокационные комментарии. </center>
<center><p style="font-size: 20px;color:#9E0404; font-weight: bold;">Просим вас строго соблюдать правила!!!</p></center>


<table cellpadding='3' cellspacing='0' border='0'  align='center' width="550" BGCOLOR="#f7f7f7" >
 <center><?PHP if($user_data["money_b"] >-1) {?><form action="" method="post">
<b>Сообщение:</b><BR />
<textarea  name="ntext" cols="50" rows="3"><?=(isset($_POST["ntext"])) ? $_POST["ntext"] : false; ?></textarea><BR />
<center><input type="submit" name="chat" value="Отправить" style="height:30px;" /></center>
</form><font color="blue"><b></b></font></a> <?PHP } else {	?> Для отправки сообщений на вашем счету должно быть серебро (Отправка бесплатная!)<?PHP } ?></center>
  <?PHP

  $db->Query("SELECT * FROM db_news ORDER BY id DESC LIMIT 10");

	if($db->NumRows() > 0){

  		while($bon = $db->FetchArray()){

		?>
		<tr>
		<td colspan="2"><HR SIZE="2" WIDTH="90%" ALIGN="center" COLOR="#fc6104"></td></tr><tr>
    		<td align="left" width="300">

			<font color=blue>
			<b><?=$bon["user"]; ?></b></font></td><td align="right" width="200"><font color=blue><?=date("d.m.Y",$bon["date_add"]); ?></td></tr><tr>
    		<td colspan="2" align="left"><? if ($bon["id"]=="1") # если ник пользователя в чате админ- то его сообщения имеют следующий цвет:
			{?><font color=red> <? } ?>  <?=$bon["tekst"]; ?></td>

		</tr>
		<?PHP

		}

	}else echo '<tr><td align="center" colspan="3">Нет записей</td></tr>'
  ?>

  <tr>
    <td colspan="2" align="center"><h4><font color="red">Показаны последние 10 сообщений</font></h4></td>
    </tr>
</table>
<?PHP

if(isset($_POST["chat"])) {

$text =$_POST["ntext"];
if($user_data["money_b"] < -1) # проверяем наличие денег


{
if (preg_match("/[\>|\<]/",$text)) # запрещаем символы < и >
{ echo "<center><b><font color = 'red'>Сообщение содержит запрещенные символы</font></b></center><BR />";
} else {

            $db->Query("INSERT INTO db_news (user, tekst, date_add) VALUES ('$uname','$text','$dadd')");
			$db->Query("UPDATE db_users_b SET money_b = money_b - 0 WHERE id = '$usid'");
			echo "<center><b><font color = 'blue'>Сообщение отправлено</font></b></center><BR />";

?>
<script type="text/javascript">
				location.replace("/chat");
				</script>
				<noscript>
				<meta http-equiv="refresh" content="0; url=/chat">
				</noscript>
<?



}
} else echo "<center><b><font color = 'red'>Недостаточно серебра для общения</font></b></center><BR />";
}
?>

<center style=" letter-spacing: 3px; font-size: 20px; padding: 20px; text-shadow: 0 1px 0 #fff,1px 2px 2px #aaa; ">



                            
                            