<?PHP
error_reporting(0); // ����� ������




if($_GET['menu']!='admin' && 'support'){
function limpiarez($mensaje){
$mensaje = htmlspecialchars(trim($mensaje));
$mensaje = str_replace("'","?",$mensaje);
$mensaje = str_replace(";","�",$mensaje);
$mensaje = str_replace("$"," USD ",$mensaje);
$mensaje = str_replace("<","?",$mensaje);
$mensaje = str_replace(">","?",$mensaje);
$mensaje = str_replace('"',"�",$mensaje);
$mensaje = str_replace("%27"," ",$mensaje);
$mensaje = str_replace("0x29"," ",$mensaje);
$mensaje = str_replace("& amp ","&",$mensaje);
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

################## ���������� ���� POST � GET #######################################
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
if((strpos($check, '<')!==false) || (strpos($check, '>')!==false) || (strpos($check, '"')!==false) || (strpos($check,"'")!==false) || (strpos($check, '*')!==false) || (strpos($check, '(')!==false) || (strpos($check, ')')!==false) || (strpos($check, ' ')!==false) || (strpos($check, ' ')!==false) || (strpos($check, ' ')!==false) ) 
{
$prover = true;
}

if((strpos($check, 'src')!==false) || (strpos($check, 'img')!==false) || (strpos($check, 'OR')!==false) || (strpos($check, 'Image')!==false) || (strpos($check, 'script')!==false) || (strpos($check, 'j�vascript')!==false) || (strpos($check, 'language')!==false) || (strpos($check, 'document')!==false) || (strpos($check, 'cookie')!==false) || (strpos($check, 'gif')!==false) || (strpos($check, 'png')!==false) || (strpos($check, 'jpg')!==false) || (strpos($check, 'js')!==false) ) 
{
$prover = true;
}

}

if (isset($prover))
{
die( "������� ����� �� ���� ��� ������� ����������� �������!" );
return false;
exit;
}
}
anti_sql();

}


/* 
Script MINE-INCOME
Autor: EvgeSH
URL: MyShopScript.ru
ICQ: 326-728
Email: EvgeSH@ProtonMail.com
*/

function TimerSet(){
	list($seconds, $microSeconds) = explode(' ', microtime());
	return $seconds + (float) $microSeconds;
}

$_timer_a = TimerSet();

# ����� ������
@session_start();

# ����� ������
@ob_start();



# ��������� ��� Include
define("CONST_RUFUS", true);

# ������������� �������
function __autoload($name){ include("../classes/_class.".$name.".php");}

# ����� ������� 
$config = new config;

# �������
$func = new func;


# ���� ������
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

$pref = $config->BasePrefix;
$admFolder = $config->FolderAdmin;


$_OPTIMIZATION["title"] = "���������������� ������";
$_OPTIMIZATION["description"] = "������� ������������";
$_OPTIMIZATION["keywords"] = "�������, ������ �������, ������������";
//$not_counters = true;



# �����
@include("inc/_header.php");
# ���������� ������
if(!isset($_SESSION["admin"])){ include("pages/_login.php"); return; }

if(isset($_GET["menu"])){
		
	$smenu = strval($_GET["menu"]);
			
	switch($smenu){
		
			case "404": include("pages/_404.php"); break; // �������� ������
		case "stats": include("pages/_stats.php"); break; // ����������
		case "config": include("pages/_config.php"); break; // ���������
		case "story_buy": include("pages/_story_buy.php"); break; // ������� ������� ��������
		case "story_swap": include("pages/_story_swap.php"); break; // ������� ������ � ���������
		case "story_insert": include("pages/_story_insert.php"); break; // ������� ���������� �������
		case "story_sell": include("pages/_story_sell.php"); break; // ������� �����
		case "news": include("pages/_news_a.php"); break; // �������
		case "users": include("pages/_users.php"); break; // ������ �������������
		case "sender": include("pages/_sender.php"); break; // �������� �������������	
		case "payments": include("pages/_payments.php"); break; // ������� �� ������� WM
		
		case "invcompconfig": include("pages/_invcompconfig.php"); break; // ���������� ����������
		case "pay_auto": include("pages/_pay_auto.php"); break; // ������� �� ������� WM
		case "compconfig": include("pages/_compconfig.php"); break; // ���������� ����������
		case "exit": @session_destroy(); Header("Location: /"); return; break; // �����
		
			
	# �������� ������
	default: @include("pages/_404.php"); break;
			
	}
			
}else @include("pages/_stats.php");

# ������
@include("inc/_footer.php");


# ������� ������� � ����������
$content = ob_get_contents();

# ������� �����
ob_end_clean();
	
	# �������� ������
	$content = str_replace("{!TITLE!}",$_OPTIMIZATION["title"],$content);
	$content = str_replace('{!DESCRIPTION!}',$_OPTIMIZATION["description"],$content);
	$content = str_replace('{!KEYWORDS!}',$_OPTIMIZATION["keywords"],$content);
	$content = str_replace('{!GEN_PAGE!}', sprintf("%.5f", (TimerSet() - $_timer_a)) ,$content);
	

	
// ������� �������
echo $content;

?>