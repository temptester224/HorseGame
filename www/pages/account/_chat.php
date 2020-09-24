<?
//Проверяем Пост, Гет и куки на ненужные символы
$arrs=array('_GET', '_POST', '_COOKIE');
foreach($arrs as $arr_key => $arr_value){
    if(is_array($$arr_value)){
        foreach($$arr_value as $key => $value){
            $nbz1=substr_count($value,'--');
            $nbz2=substr_count($value,'/*');
            $nbz3=substr_count($value,"'");
            $nbz4=substr_count($value,'"');
            if($nbz1>0 || $nbz2>0 || $nbz3>0 || $nbz4>0){
                print '<div class="error">Вы используете недопустимые символы или ваш ПК заражен вирусом '.str_replace('_','',$arr_value).'-повторите попытку позже!<br><a href="javascript:window.history.back();">Назад</a></div>';
                exit();
            }
        }
    }
}









$_OPTIMIZATION["title"] = "";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();



/*
if($_SESSION["user_id"] != 1){
echo "<center><b><font color = red>Технические работы</font></b></center>";
return;
}
*/
?>

<div class="col-sm-12 col-lg-6">
	<blockquote>
        <h2 style="margin-top: 2%;">Чат</h2>
        </blockquote>
</div>

        </div>
            <div class="container-fluid">
                <div class="row cm-fix-height">

<center><br><br><br><br>

<script type="text/javascript" src="https://yandex.st/jquery/1.6.2/jquery.min.js"></script>
<script LANGUAGE="JavaScript1.1"> 
document.oncontextmenu = function(){return false;}; 
</script>	

<?php
$_OPTIMIZATION["title"] = "Общение";
if(!isset($_SESSION["user"]))
	return;
	
header("Content-type: text/html; charset=windows-1251");
$db->query("SET NAMES cp1251");
?>
<script type="text/javascript" src="/js/cookies.js" /></script>

<script type="text/javascript">
function insert_comm(open, close, no_focus)
{
  msgfield = (document.all) ? document.all.forma_com : document.forms['form_com']['comment'];
  if (document.selection && document.selection.createRange)
  {
    if (no_focus != '1' ) msgfield.focus();
	sel = document.selection.createRange();
	sel.text = open + sel.text + close;
	if (no_focus != '1' ) msgfield.focus();
	}else if (msgfield.selectionStart || msgfield.selectionStart == '0'){
	  var startPos = msgfield.selectionStart;
	  var endPos = msgfield.selectionEnd;
	  msgfield.value = msgfield.value.substring(0, startPos) + open + msgfield.value.substring(startPos, endPos) + close + msgfield.value.substring(endPos, msgfield.value.length);
	  msgfield.selectionStart = msgfield.selectionEnd = endPos + open.length + close.length;
	  if (no_focus != '1' ) msgfield.focus();
	    }else{
		msgfield.value += open + close;
		if (no_focus != '1' ) msgfield.focus();
		}return;}
		
		function reset_chat(){
			$.ajax({
				type: "POST",
				url: "/ajax/chat.php?p=get",
				data: "",
				success: function(result){
					if($("#chat #chat_scroll").html() != result)
						$("#chat #chat_scroll").html(result);
						$("#chat #chat_scroll").scrollTo(9999);					
				}
			});
		}
    
    function reset_online(){
			$.ajax({
				type: "POST",
			//	url: "/ajax/chat.php?p=online",
				data: "",
				success: function(result){
					
						$("#chat #chat-online").html(result);
								
        }
			});
		}
		
		function reset_warning(){
			$("#chat .bbcode #warnings").text('');
		}
		
		function swich_close(){
			$('body').css('padding-bottom', '7px');
			$('#chat').css('bottom', '-150px');
			$.cookie('swich', 'close');
		}
		
		function swich_open(){
			$('body').css('padding-bottom', '157px');
			$('#chat').css('bottom', '-0px');
			$.cookie('swich', 'open');
		}
		
		$(function(){	
		
			reset_chat();
      reset_online();
			
			setInterval(reset_chat, 7000);
      setInterval(reset_online, 50000);
			setInterval(reset_warning, 9000);
								
			$('#chat #form_com').submit(function(e){
				e.preventDefault();	
				$.ajax({
					type: "POST",
					url: "/ajax/chat.php?p=send",
					data: $('#chat #form_com').serialize(),
					success: function(result){
						$("#chat .bbcode #warnings").html(result);
						if(result == '<span style="color:#0f0">Сообщение отправлено</span>'){
							$('#chat .message input[name="comment"]').val('');
							reset_chat();
						}
					}
				});					
						
			});
			
			$('#chat #chat_scroll .user').click(function(){
      
				$('#chat .message input[name="comment"]').val($(this).text() + $('#chat .message input[name="comment"]').val());
			});
      
      $('#chat #chat-online .user').click(function(){
       
				$('#chat .message input[name="comment"]').val($(this).text() + $('#chat .message input[name="comment"]').val());
			});
			
		});
</script>
<style type="text/css" href="/style/style.css">

#chat{position:relative;
bottom:<?php
if(!isset($_SESSION['chathide']))
	$_SESSION["chathide"] = false;

if(isset($_GET['chats'])){
	if($_SESSION['chathide'] == false)
		$_SESSION["chathide"] = true;
	else
		$_SESSION["chathide"] = false;
}

echo $_SESSION['chathide'] == false?'10':'-155';
?>px; margin-top:10px; width:780px; background:#ffffff; opacity:0.8; box-shadow: 0 0 10px rgba(1,1,1,10); padding:15px 10px 2px 12px; z-index:1; border:4px solid #134786;}
#chat #chat_scroll{height:360px; width:580px; display: inline-block; font-size:14px; padding:2px; overflow: auto; line-height:20px;}
#chat .swich{position:absolute; display:block; right:-2px; top:-31px; cursor:pointer; height:33px; width:155px; background:url(/img/chat/swich.png); text-align:center; line-height:33px;}
#chat #chat_scroll .user{font-weight:900; color:00f; text-decoration:underline; cursor:pointer;}
#chat #chat_scroll .user:hover{text-decoration:none;}
#chat #chat-online .user:hover{text-decoration:none;}
#chat #chat_scroll .to{background:#fff;}
#chat #chat_scroll .private{color:#f00;}
#chat #chat_scroll .time{color:#fff; float:left;}
#chat .message input[name="comment"]{background:#fff;
float:left;
color:#000;
border:1px solid #1b538d;	
width:550px;
margin:14px 6px 5px 0px;
padding:0px 15px 0px 15px;	
height:43px;
font-size:16px;}
#chat .message input[name="message_sub"]{
	background-color:#194e7f;
	text-decoration:none;
	border: none;
	color:#FFFFFF;
	width:148px;
	padding:10px 0px 9px 0px;
	margin:15px 6px 5px 0px;
	cursor:pointer;
	font-size:20px;
	font-family: 'PT Sans', sans-serif;}
</style>
<div id="chat">
	
	<div id="chat_scroll">Загрузка...</div>
  <div id="clear: both;"></div>
	<div class="message">
		<form id="form_com" action="#form_com" method="post">
			<input type="text" id="comment" placeholder="Сообщение" name="comment" maxlength="255" />
			<input type="hidden" name="to" />
			 <input type="submit" name="message_sub" value="Отправить" />
</div> 
</div>		 
		</form>
</div>							
<br>
