<?PHP
$_OPTIMIZATION["title"] = "Аккаунт";
$_OPTIMIZATION["description"] = "Аккаунт пользователя";
$_OPTIMIZATION["keywords"] = "Аккаунт, личный кабинет, пользователь";

# Блокировка сессии
if(!isset($_SESSION["user_id"])){ Header("Location: /"); return; }

if(isset($_GET["sel"])){
		
	$smenu = strval($_GET["sel"]);
			
	switch($smenu){
		
		case "404": include("pages/_404.php"); break; // Страница ошибки
		case "referals": include("pages/account/_referals.php"); break; // Рефералы
		case "sevens": include("pages/account/_sevens.php"); break; // Три семерки
case "serfing": include("pages/account/_serfing.php"); break; // серфинг
case "serfing_add": include("pages/account/_serfing_add.php"); break; // серфинг
case "serfing_view": include("pages/account/_serfing_view.php"); break; // серфинг
case "serfing_cabinet": include("pages/account/_serfing_cabinet.php"); break; // серфинг
case "serfing_moder": include("pages/account/_serfing_moder.php"); break;
		case "payment": include("pages/account/_payment.php"); break; // Статистика
           case "farm": include("pages/account/_farm.php"); break; // Склад
          case "gono4ki": include("pages/account/_gono4ki.php"); break; // Гонки машин
          case "exchange": include("pages/account/_exchange.php"); break; // Обменный пункт
		case "market": include("pages/account/_market.php"); break; // Рынок
		case "withdraw": include("pages/account/_withdraw.php"); break; // Выплата WM
		case "balance": include("pages/account/_balance.php"); break; // Пополнение баланса
		case "config": include("pages/account/_config.php"); break; // Настройки
		case "bonus": include("pages/account/_bonus.php"); break; // Ежедневный бонус
		case "bonus-investor": include("pages/account/_bonus-investor.php"); break; // Инвесторский бонус
case "investor": include("pages/account/_investor.php"); break; // Инвесторский бонус
case "bonus11": include("pages/account/_bonus11.php"); break; // Инвесторский бонус
case "bonus12": include("pages/account/_bonus12.php"); break; // Инвесторский бонус
case "bonus13": include("pages/account/_bonus13.php"); break; // Инвесторский бонус
case "bonus14": include("pages/account/_bonus14.php"); break; // Инвесторский бонус

		case "chat": include("pages/account/_chat.php"); break; // chat
		case "chat": include("pages/_chat.php"); break; // chat 
		case "exit": include("exit.php"); break; // Выход
				
	# Страница ошибки
	default: @include("pages/_404.php"); break;
	
			
	}
			
}else @include("pages/account/_user_account.php");

?>