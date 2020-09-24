<?PHP
$_OPTIMIZATION["title"] = "Регистрация";
$_OPTIMIZATION["description"] = "Регистрация пользователя в системе";
$_OPTIMIZATION["keywords"] = "Регистрация нового участника в системе";

if(isset($_SESSION["user_id"])){ Header("Location: /account"); return; }
?>


<?PHP
# –егистраци¤

	if(isset($_POST["singup"])){
	

	$login = $func->IsLogin($_POST["login"]);
	$pass = $func->IsPassword($_POST["password"]);
	$rules = isset($_POST["rules"]) ? true : false;
	$time = time();
	$ip = $func->UserIP;
	$ipregs = $db->Query("SELECT * FROM `db_users_a` WHERE INET_NTOA(db_users_a.ip) = '$ip' ");
	$ipregs = $db->NumRows();
	$passmd = $func->md5Password($pass);

	$email = $func->IsMail($_POST["email"]);
	$referer_id = (isset($_COOKIE["i"]) AND intval($_COOKIE["i"]) > 0 AND intval($_COOKIE["i"]) < 1000000) ? intval($_COOKIE["i"]) : 1;
	$referer_name = "";
	if($referer_id != 1){
		$db->Query("SELECT user FROM db_users_a WHERE id = '$referer_id' LIMIT 1");
		if($db->NumRows() > 0){$referer_name = $db->FetchRow();}
		else{ $referer_id = 1; $referer_name = "admin"; }
	}else{ $referer_id = 1; $referer_name = "admin"; }
	
		if (!empty($_POST['g-recaptcha-response'])) {
	
		if($rules){
			if($ipregs == 0) {

			if($email !== false){
		
			if($login !== false){
			
				if($pass !== false){
			
					if($pass == $_POST["re_password"]){
						
						$db->Query("SELECT COUNT(*) FROM db_users_a WHERE user = '$login'");
						if($db->FetchRow() == 0){
						
						# –егаем пользовател¤
						$db->Query("INSERT INTO db_users_a (user, email, pass, referer, referer_id, date_reg, ip) 
						VALUES ('$login','{$email}','$passmd','$referer_name','$referer_id','$time',INET_ATON('$ip'))");
						
						$lid = $db->LastInsert();
						
						$db->Query("INSERT INTO db_users_b (id, user, a_t, last_sbor) VALUES ('$lid','$login','1', '".time()."')");
						
						# ¬ставл¤ем статистику
						$db->Query("UPDATE db_stats SET all_users = all_users +1 WHERE id = '1'");
						
						echo "<div class='notifyjs-corner' style='top: 0px; right: 0px;'><div class='notifyjs-wrapper notifyjs-hidable'>
	<div class='notifyjs-arrow' style=''></div>
	<div class='notifyjs-container' style=''><div class='notifyjs-bootstrap-base notifyjs-bootstrap-error'>
<span data-notify-text=''>Вы успешно зарегистрировались.</span>
</div></div>
</div></div>";
						?><script language = 'javascript'> 
						document.location.href='/login.html';</script>
						<meta http-equiv="Refresh" content="2;url=/signup.html"><?
						?></div>
						<div class="clr"></div>	
						<?PHP
						return;
						
								}else echo "<div class='notifyjs-corner' style='top: 0px; right: 0px;'><div class='notifyjs-wrapper notifyjs-hidable'>
	<div class='notifyjs-arrow' style=''></div>
	<div class='notifyjs-container' style=''><div class='notifyjs-bootstrap-base notifyjs-bootstrap-error'>
<span data-notify-text=''>Указанный логин уже используется</span>
</div></div>
</div></div>";
						
							}else echo "<div class='notifyjs-corner' style='top: 0px; right: 0px;'><div class='notifyjs-wrapper notifyjs-hidable'>
	<div class='notifyjs-arrow' style=''></div>
	<div class='notifyjs-container' style=''><div class='notifyjs-bootstrap-base notifyjs-bootstrap-error'>
<span data-notify-text=''>Пароль и повтор пароля не совпадают</span>
</div></div>
</div></div>";
			
						}else echo "<div class='notifyjs-corner' style='top: 0px; right: 0px;'><div class='notifyjs-wrapper notifyjs-hidable'>
	<div class='notifyjs-arrow' style=''></div>
	<div class='notifyjs-container' style=''><div class='notifyjs-bootstrap-base notifyjs-bootstrap-error'>
<span data-notify-text=''>Пароль заполнен неверно</span>
</div></div>
</div></div>";
			
					}else echo "<div class='notifyjs-corner' style='top: 0px; right: 0px;'><div class='notifyjs-wrapper notifyjs-hidable'>
	<div class='notifyjs-arrow' style=''></div>
	<div class='notifyjs-container' style=''><div class='notifyjs-bootstrap-base notifyjs-bootstrap-error'>
<span data-notify-text=''>Логин заполнен неверно</span>
</div></div>
</div></div>";

				}else echo "<div class='notifyjs-corner' style='top: 0px; right: 0px;'><div class='notifyjs-wrapper notifyjs-hidable'>
	<div class='notifyjs-arrow' style=''></div>
	<div class='notifyjs-container' style=''><div class='notifyjs-bootstrap-base notifyjs-bootstrap-error'>
<span data-notify-text=''>Email имеет неверный формат</span>
</div></div>
</div></div>";

			}else echo "<div class='notifyjs-corner' style='top: 0px; right: 0px;'><div class='notifyjs-wrapper notifyjs-hidable'>
	<div class='notifyjs-arrow' style=''></div>
	<div class='notifyjs-container' style=''><div class='notifyjs-bootstrap-base notifyjs-bootstrap-error'>
<span data-notify-text=''>Регистрация с одного IP запрещена</span>
</div></div>
</div></div>";
	
		}else echo "<div class='notifyjs-corner' style='top: 0px; right: 0px;'><div class='notifyjs-wrapper notifyjs-hidable'>
	<div class='notifyjs-arrow' style=''></div>
	<div class='notifyjs-container' style=''><div class='notifyjs-bootstrap-base notifyjs-bootstrap-error'>
<span data-notify-text=''>Указанный Email уже есть в нашей базе!</span>
</div></div>
</div></div>";
		
	}else echo "<div class='notifyjs-corner' style='top: 0px; right: 0px;'><div class='notifyjs-wrapper notifyjs-hidable'>
	<div class='notifyjs-arrow' style=''></div>
	<div class='notifyjs-container' style=''><div class='notifyjs-bootstrap-base notifyjs-bootstrap-error'>
<span data-notify-text=''>Капча не пройдёна!</span>
</div></div>
</div></div>";
		
	}
	
	
?>

<br><br><br><br><br>

<body class="cm-views">
    <!--== Login Page Content Start ==-->
    <section id="lgoin-page-wrap" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-8 m-auto">
								<div class="alert alert-light">
									<a href="/"><img src="/assets/img/super-gonka.svg" style="width: 100%;" alt="Регистрация" /></a>
								</div>
                	<div class="login-page-content">
                		<div class="login-form">
							<form method="POST" action="/signup.html">
							<input type="hidden" name="_tocken" value="10486392677692f8896cbf940">
								<div class="name">
									<div class="row">
										<div class="col-md-6">
											<input type="text"  placeholder="Введите логин"  maxlength="15" minlength="3" autocomplete="off"  value="<?=(isset($_POST["login"])) ? htmlspecialchars($_POST["login"]) : false; ?>" name="login" required="" />
										</div>
										<div class="col-md-6">
											<input type="text"  placeholder="Введите email" minlength="5" autocomplete="off" value="<?=(isset($_POST["email"])) ? htmlspecialchars($_POST["email"]) : false; ?>"/ name="email" required="" />
										</div>
									</div>
								</div>

								<div class="name">
									<div class="row">
										<div class="col-md-6">
											<input type="password" value="" name="password" maxlength="20" minlength="6" placeholder="Введите пароль" required="" />
										</div>
										<div class="col-md-6">
											<input type="password" value="" name="re_password"  maxlength="20" minlength="6" placeholder="Повторите пароль" required="" />
										</div>
									</div>
								</div>
								
								
							<font color="ff6666">Я прочитал и соглашаюсь с <a href="/rules.html" target="_blank">условиями</a> использования сайта</font></label>	<input name="rules"  id="checkboxG1" type="checkbox"><label for="checkboxG1"> <label for="terms">
								
								<td colspan="2" align="left" style="padding:3px;">

	<center><table><tr><td><!-- НЕ ЗАБЫВАЕМ ВПИСАТЬ КЛЮЧ !!! -->
	<form> <div class="g-recaptcha" data-sitekey="6Ldq0WoUAAAAADyk7mC9HK1HIPh3ZhMinku6YVfW"></div> </form> 
	</td></tr></table></center>
	</td>
  </tr>
  <tr>
								
								
								<div class="log-btn">
									<button type="submit" name="singup"><i class="fa fa-check-square"></i> Зарегистрироваться</button>
								</div>
							</form>
                		</div>
                		
                		<div class="login-other">
                			<span class="or"><i class="fa fa-car"></i></span>
                		</div>
                		<div class="create-ac">
                			<p></p>
                		</div>
                		<div class="login-menu">
                			Уже есть аккаунт? <a href="/login.html">Войти</a>
                		</div>
                	</div>
                </div>
        	</div>
        </div>
    </section>
    <!--== Login Page Content End ==-->


        <script src="/assets/cabinet/js/lib/jquery-2.1.3.min.js"></script>
        <script src="/assets/cabinet/js/notify.js"></script>

	
  </body>







