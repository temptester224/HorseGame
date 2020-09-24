<?PHP
$_OPTIMIZATION["title"] = "Восстановление пароля";
$_OPTIMIZATION["description"] = "Восстановление забытого пароля";
$_OPTIMIZATION["keywords"] = "Восстановление забытого пароля";

if(isset($_SESSION["user_id"])){ Header("Location: /account"); return; }

?>


<?PHP
	if(isset($_POST["submit"])){
		$email = $func->IsMail($_POST["email"]);
		$login = $func->IsLogin($_POST["login"]);
		$time = time();
		$tdel = $time + 60*30;
		
		$new_password = substr(md5(time()), 0, 7);
		$new_pass = $func->md5Password($new_password);
		
	if($email !== false || $login !== false){
		if($email !== false && $login !== false) {
			$db->Query("DELETE FROM `db_recovery` WHERE `date_del` < '$time'");
			$db->Query("SELECT COUNT(*) FROM `db_recovery` WHERE `ip` = INET_ATON('".$func->UserIP."') OR `email` = '$email' OR `user` = '$login'");
			if($db->FetchRow() == 0){
				$db->Query("SELECT `id`, `user`, `email`, `pass` FROM `db_users_a` WHERE `email` = '$email' AND `user` = '$login'");
				if($db->NumRows() == 1){
				$db_q = $db->FetchArray();
				$db->Query("INSERT INTO `db_recovery` (`user`, `email`, `ip`, `date_add`, `date_del`) VALUES ('$login', '$email',INET_ATON('".$func->UserIP."'),'$time','$tdel')");
				$db->Query("UPDATE `db_users_a` SET `pass` = '$new_pass' WHERE `email` = '$email'");
					$sender = new isender;
					$sender -> RecoveryPassword($db_q['user'], $new_password, $db_q['email']);
					echo "<div class='ok'>Данные для входа отправлены на Email</div>";
				} else echo "<div class='err'>Ошибка! Пользователь не найден!</div>";
			} else echo "<div class='err'>Вы можете повторить операцию не чаще чем 1 раз в 30 минут!</div>";
		}
		elseif($email !== false && $login === false) {
			$db->Query("DELETE FROM `db_recovery` WHERE `date_del` < '$time'");
			$db->Query("SELECT COUNT(*) FROM `db_recovery` WHERE `ip` = INET_ATON('".$func->UserIP."') OR `email` = '$email'");
			if($db->FetchRow() == 0){
				$db->Query("SELECT `id`, `user`, `email`, `pass` FROM `db_users_a` WHERE `email` = '$email'");
				if($db->NumRows() == 1){
				$db_q = $db->FetchArray();
				$db->Query("INSERT INTO `db_recovery` (`email`, `ip`, `date_add`, `date_del`) VALUES ('$email',INET_ATON('".$func->UserIP."'),'$time','$tdel')");
				$db->Query("UPDATE `db_users_a` SET `pass` = '$new_pass' WHERE `email` = '$email'");
					$sender = new isender;
					$sender -> RecoveryPassword($db_q['user'], $new_password, $db_q['email']);
					echo "<div class='ok'>Данные для входа отправлены на Email</div>";
				} else echo "<div class='err'>Ошибка! Пользователь не найден!</div>";
			} else echo "<div class='err'>Вы можете повторить операцию не чаще чем 1 раз в 30 минут!</div>";
		}
		elseif($email === false && $login !== false) {
			$db->Query("DELETE FROM `db_recovery` WHERE `date_del` < '$time'");
			$db->Query("SELECT COUNT(*) FROM `db_recovery` WHERE `ip` = INET_ATON('".$func->UserIP."') OR `user` = '$login'");
			if($db->FetchRow() == 0){
				$db->Query("SELECT `id`, `user`, `email`, `pass` FROM `db_users_a` WHERE `user` = '$login'");
				if($db->NumRows() == 1){
				$db_q = $db->FetchArray();
				$db->Query("INSERT INTO `db_recovery` (`user`, `ip`, `date_add`, `date_del`) VALUES ('$login', INET_ATON('".$func->UserIP."'),'$time','$tdel')");
				$db->Query("UPDATE `db_users_a` SET `pass` = '$new_pass' WHERE `user` = '$login'");
					$sender = new isender;
					$sender -> RecoveryPassword($db_q['user'], $new_password, $db_q['email']);
					echo "<div class='ok'>Данные для входа отправлены на Email</div>";
				} else echo "<div class='err'>Ошибка! Пользователь не найден!</div>";
			} else echo "<div class='err'>Вы можете повторить операцию не чаще чем 1 раз в 30 минут!</div>";
		}
	}else echo "<div class='err'>Данные указаны неверно!</div>";
 } 
 
	if(isset($_POST["loginform"])){
		$lmail = $func->IsMail($_POST["email"]);
		$login = $func->IsLogin($_POST["login"]);
		if($login !== false){
		if($lmail !== false){
			$db->Query("SELECT `id`, `user`, `pass`, `referer_id`, `banned` FROM `db_users_a` WHERE `email` = '$lmail' AND `user` = '$login'");
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
						
		}else echo "<div class='err'>Аккаунт заблокирован</div>";
		}else echo "<div class='err'>Пароль указан неверно</div>";
		}else echo "<div class='err'>Указанный пользователь не зарегистрирован в системе</div>";
		}else echo "<div class='err'>Email указан неверно</div>";
		}else echo "<div class='err'>Логин указан неверно</div>";
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
						
						<form method="post" action="">
						<input type="hidden" name="_tocken" value="1a23cd66ef3086eae4363e481">
						
				<div class="username">		
			<input type="text" placeholder="Логин" class="input_text w340" value="<?=(isset($_POST["login"])) ? htmlspecialchars($_POST["login"]) : false; ?>" name="login"/>
			</div>
			
		<div class="create-ac">
                			<p>Или</p>
                		</div>
						<div class="username">
			<input type="text" placeholder="E-mail" class="input_text w340" value="<?=(isset($_POST["email"])) ? htmlspecialchars($_POST["email"]) : false; ?>" name="email"/>
			</div>
			
			<div class="log-btn">
									<button type="submit" name="submit"><i class="fa fa-sign-in"></i> Смена пароля</button>
								</div>
		</form>    
		
		
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



