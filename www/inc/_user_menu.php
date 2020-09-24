	
<?PHP
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();


$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '$user_id'");
$refs = $db->FetchRow(); // Считаем рефералов 1 уровня





$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();



$A=$func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);
$B=$func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);
$C=$func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);
$D=$func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"]);
$E=$func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"]);
$R=$func->SumCalc($sonfig_site["r_in_h"], $user_data["r_t"], $user_data["last_sbor"]);
$T=$func->SumCalc($sonfig_site["t_in_h"], $user_data["t_t"], $user_data["last_sbor"]);
$Y=$func->SumCalc($sonfig_site["y_in_h"], $user_data["y_t"], $user_data["last_sbor"]);
$U=$func->SumCalc($sonfig_site["u_in_h"], $user_data["u_t"], $user_data["last_sbor"]);
$G=$A+$B+$C+$D+$E+$R+$T+$Y+$U; 

$kyr1 = $user_data["a_t"]*$sonfig_site["a_in_h"];
$kyr2 = $user_data["b_t"]*$sonfig_site["b_in_h"];
$kyr3 = $user_data["c_t"]*$sonfig_site["c_in_h"];
$kyr4 = $user_data["d_t"]*$sonfig_site["d_in_h"];
$kyr5 = $user_data["e_t"]*$sonfig_site["e_in_h"];
$kyr6 = $user_data["r_t"]*$sonfig_site["r_in_h"];
$kyr7 = $user_data["t_t"]*$sonfig_site["t_in_h"];
$kyr8 = $user_data["y_t"]*$sonfig_site["y_in_h"];
$kyr9 = $user_data["u_t"]*$sonfig_site["u_in_h"];
 
$kyrcall = $kyr1+$kyr2+$kyr3+$kyr4+$kyr5+$kyr6+$kyr7+$kyr8+$kyr9;


?>
