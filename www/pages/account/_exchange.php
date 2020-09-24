<?PHP
$_OPTIMIZATION["title"] = "Обменник";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

$summa = 1; // Минимальная сумма
?>  

<?PHP

if(isset($_POST["sum"])){

$sum = intval($_POST["sum"]);

	if($sum >= $summa){
	
		if($user_data["money_p"] >= $sum){
		
		$add_sum = ($sonfig_site["percent_swap"] > 0) ? ( ($sonfig_site["percent_swap"] / 100) * $sum) + $sum : $sum;
		
		$ta = time();
		$td = $ta + 60*60*24*15;
		
		$db->Query("UPDATE db_users_b SET money_b = money_b + $add_sum, money_p = money_p - $sum WHERE id = '$usid'");
		$db->Query("INSERT INTO db_swap_ser (user_id, user, amount_b, amount_p, date_add, date_del) VALUES ('$usid','$usname','$add_sum','$sum','$ta','$td')");
		
		echo "<script>setTimeout(function(){swal(\"Обмен выполнен успешно!\", \"Успешно\")}, 500); </script>";
		
		}else echo "<script>setTimeout(function(){swal(\"На Вашем счете не достаточно средств!\", \"Ошибка\")}, 500);</script>";
	
	}else echo "<script>setTimeout(function(){swal(\"Минимальная сумма для обмена состовляет {$summa}\", \"Ошибка\")}, 500);</script>";

}

?>

<div class="col-sm-12 col-lg-6">
	<blockquote>
        <h2 style="margin-top: 2%;">Обмен баланса</h2>
        </blockquote>
</div>

        </div>
            <div class="container-fluid">
                <div class="row cm-fix-height">

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Обмен с ВЫВОДА на ПОКУПКИ</div>
                            <div class="panel-body">
                                <blockquote style="margin: 5%;">
                                    <p>Односторонний обмен средств с Вашего баланса для вывода, на Ваш баланс для покупок.</p>
                                    <footer>Минимальная сумма: 1 руб.</footer>
                                </blockquote>
                  <form action="" method="POST">
                  <input type="hidden" name="_tocken" value="0de42f989980580ae997a6e7e">
                  <input type="hidden" name="change" value="1">
                    <div class="form-group">
                    <input name="sum" id="sum"  type="text" maxlength="7" autocomplete="off" class="form-control text-center" value="<?=floor($user_data['money_p']);?>" required="" />
                            </div>
                            <button type="submit" name="swap" class="btn btn-block btn-primary"> Произвести обмен средств</button>
                              </form>
                            </div>
                        </div>
                      </div>

                    </div>
                </div>

<script language="javascript">GetSumPer();</script>


</div>
<div class="text_pages_bottom"></div>
</div>
<script language="javascript">
function up(e) {
  if (e.value.indexOf(".") != '-1') {
    e.value=e.value.substring(0, e.value.indexOf(".") + 0);
  }
  document.getElementById('sum').onkeypress = function (e) {
  return !(/[А-Яа-яA-Za-z ]/.test(String.fromCharCode(e.charCode)));
  }
}
</script>	