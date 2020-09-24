    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <a class="" href="index.html"><span class="navbar-brand"><span class="fa fa-paper-plane"></span> Панель администратора</span></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">

        </div>
      </div>
    </div>
	
	<div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse">Авторизация</p>
        <div class="panel-body">
            


<?PHP
/* 
Script MINE-INCOME
Autor: EvgeSH
URL: MyShopScript.ru
ICQ: 326-728
Email: EvgeSH@ProtonMail.com
*/
if(isset($_SESSION["admin"])){ Header("Location: /admin"); return; }

if(isset($_POST["admlogin"])){
	
	
	$db->Query("SELECT * FROM db_config WHERE id = 1 LIMIT 1");
	$data_log = $db->FetchArray();
	
	if(strtolower($_POST["admlogin"]) == strtolower($data_log["admin"]) AND strtolower($_POST["admpass"]) == strtolower($data_log["pass"]) ){
	
		$_SESSION["admin"] = $data_log['admin'];
		Header("Location: /admin");
		return;
	}else echo "<center><font color = 'red'><b>Неверно введен логин и/или пароль</b></font></center><BR />";
	
}

?>

<form action="" method="post">
                <div class="form-group">
                    <label>Логин:</label>
                    <input type="text" name="admlogin"  class="form-control span12" value="" />
                </div>
                <div class="form-group">
                <label>Пароль:</label>
                   <input type="password" name="admpass" class="form-controlspan12 form-control" value="" />
                </div>
                <input type="submit" value="Войти" />
            
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
    <p class="pull-right" style=""><a href="https://profitscripts.tech/" target="blank" style="font-size: .75em; margin-top: .25em;">Design by Profit Scripts</a></p>
  
</div>

