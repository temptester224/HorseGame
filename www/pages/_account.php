<?PHP
$_OPTIMIZATION["title"] = "�������";
$_OPTIMIZATION["description"] = "������� ������������";
$_OPTIMIZATION["keywords"] = "�������, ������ �������, ������������";

# ���������� ������
if(!isset($_SESSION["user_id"])){ Header("Location: /"); return; }

if(isset($_GET["sel"])){
		
	$smenu = strval($_GET["sel"]);
			
	switch($smenu){
		
		case "404": include("pages/_404.php"); break; // �������� ������
		case "referals": include("pages/account/_referals.php"); break; // ��������
		case "sevens": include("pages/account/_sevens.php"); break; // ��� �������
case "serfing": include("pages/account/_serfing.php"); break; // �������
case "serfing_add": include("pages/account/_serfing_add.php"); break; // �������
case "serfing_view": include("pages/account/_serfing_view.php"); break; // �������
case "serfing_cabinet": include("pages/account/_serfing_cabinet.php"); break; // �������
case "serfing_moder": include("pages/account/_serfing_moder.php"); break;
		case "payment": include("pages/account/_payment.php"); break; // ����������
           case "farm": include("pages/account/_farm.php"); break; // �����
          case "gono4ki": include("pages/account/_gono4ki.php"); break; // ����� �����
          case "exchange": include("pages/account/_exchange.php"); break; // �������� �����
		case "market": include("pages/account/_market.php"); break; // �����
		case "withdraw": include("pages/account/_withdraw.php"); break; // ������� WM
		case "balance": include("pages/account/_balance.php"); break; // ���������� �������
		case "config": include("pages/account/_config.php"); break; // ���������
		case "bonus": include("pages/account/_bonus.php"); break; // ���������� �����
		case "bonus-investor": include("pages/account/_bonus-investor.php"); break; // ������������ �����
case "investor": include("pages/account/_investor.php"); break; // ������������ �����
case "bonus11": include("pages/account/_bonus11.php"); break; // ������������ �����
case "bonus12": include("pages/account/_bonus12.php"); break; // ������������ �����
case "bonus13": include("pages/account/_bonus13.php"); break; // ������������ �����
case "bonus14": include("pages/account/_bonus14.php"); break; // ������������ �����

		case "chat": include("pages/account/_chat.php"); break; // chat
		case "chat": include("pages/_chat.php"); break; // chat 
		case "exit": include("exit.php"); break; // �����
				
	# �������� ������
	default: @include("pages/_404.php"); break;
	
			
	}
			
}else @include("pages/account/_user_account.php");

?>