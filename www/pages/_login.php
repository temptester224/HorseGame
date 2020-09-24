<?PHP
$_OPTIMIZATION["title"] = "Регистрация";
$_OPTIMIZATION["description"] = "Регистрация пользователя в системе";
$_OPTIMIZATION["keywords"] = "Регистрация нового участника в системе";

if(isset($_SESSION["user_id"])){ Header("Location: /account"); return; }
$referer_id = (isset($_COOKIE["i"]) AND intval($_COOKIE["i"]) > 0 AND intval($_COOKIE["i"]) < 1000000) ? intval($_COOKIE["i"]) : 1;
	$db->Query("SELECT * FROM `db_users_a` WHERE `id` = '$referer_id'");
	if ($db->Numrows() > 0){
		$r = $db->FetchArray();
		$referer_name = $r["user"];
	} else {
		$referer_name = 'admin';
		$referer_id = 1;
	}
?>

<script>
  $.notify("Неверный формат E-mail", "error", "Ошибка"); 
  </script>

<?PHP
	if(isset($_POST["loginform"])){
		$login = $func->IsLogin($_POST["login"]);
		if($login !== false){
			$db->Query("SELECT `id`, `user`, `pass`, `referer_id`, `banned` FROM `db_users_a` WHERE `user` = '$login'");
			if($db->NumRows() == 1){
			
			$log_data = $db->FetchArray();
			
				$pass = $func->md5Password($_POST["pass"]);
				if($log_data["pass"] == $pass){
				
					if($log_data["banned"] == 0){
						
						# Считаем рефералов
						$db->Query("SELECT COUNT(*) FROM `db_users_a` WHERE `referer_id` = '".$log_data["id"]."'");
						$refs = $db->FetchRow();
						
						$db->Query("UPDATE `db_users_a` SET `referals` = '$refs', `date_login` = '".time()."', `ip` = INET_ATON('".$func->UserIP."') WHERE `id` = '".$log_data["id"]."'");
						
						$_SESSION["user_id"] = $log_data["id"];
						$_SESSION["user"] = $log_data["user"];
						$_SESSION["referer_id"] = $log_data["referer_id"];
						Header("Location: /account.html");
						
		}else echo "<div class='notifyjs-corner' style='top: 0px; right: 0px;'><div class='notifyjs-wrapper notifyjs-hidable'>
	<div class='notifyjs-arrow' style=''></div>
	<div class='notifyjs-container' style=''><div class='notifyjs-bootstrap-base notifyjs-bootstrap-error'>
<span data-notify-text=''>Аккаунт заблокирован</span>
</div></div>
</div></div>";
		}else echo "<div class='notifyjs-corner' style='top: 0px; right: 0px;'><div class='notifyjs-wrapper notifyjs-hidable'>
	<div class='notifyjs-arrow' style=''></div>
	<div class='notifyjs-container' style=''><div class='notifyjs-bootstrap-base notifyjs-bootstrap-error'>
<span data-notify-text=''>Пароль указан неверно</span>
</div></div>
</div></div>";
		}else echo "<div class='notifyjs-corner' style='top: 0px; right: 0px;'><div class='notifyjs-wrapper notifyjs-hidable'>
	<div class='notifyjs-arrow' style=''></div>
	<div class='notifyjs-container' style=''><div class='notifyjs-bootstrap-base notifyjs-bootstrap-error'>
<span data-notify-text=''>Указанный пользователь не зарегистрирован в системе</span>
</div></div>
</div></div>";


		}else echo "<div class='notifyjs-corner' style='top: 0px; right: 0px;'><div class='notifyjs-wrapper notifyjs-hidable'>
	<div class='notifyjs-arrow' style=''></div>
	<div class='notifyjs-container' style=''><div class='notifyjs-bootstrap-base notifyjs-bootstrap-error'>
<span data-notify-text=''>Логин указан неверно</span>
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
									<a href="/"><img src="/assets/img/super-gonka.svg" style="width: 100%;" alt="Авторизация" /></a>
								</div>
                	<div class="login-page-content">
                		<div class="login-form">
							<form method="POST" action="/login.html">
							<input type="hidden" name="_tocken" value="1a23cd66ef3086eae4363e481">
								
								<div class="username">
									<input type="text" name="login" autocomplete="off" value="<?=(isset($_POST["login"])) ? htmlspecialchars($_POST["login"]) : false; ?>" placeholder="Введите логин" required="" />
								</div>
								<div class="password">
									<input type="password" name="pass" placeholder="Введите пароль" required="" />
								</div>
								<div class="log-btn">
									<button type="submit" name="loginform"><i class="fa fa-sign-in"></i> Войти</button>
								</div>
							</form>
                		</div>
                		
                		<div class="login-other">
                			<span class="or"><i class="fa fa-car"></i></span>
                		</div>
                		<div class="login-menu">
                			<a href="/recovery.html">Напомнить пароль?</a>
                		<div class="create-ac">
                			<p>OR</p>
                		</div>
                			<a href="/signup.html">Форма регистрации</a>
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



