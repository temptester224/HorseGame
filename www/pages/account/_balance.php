<?
$user_id = $_SESSION["user_id"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$user_id' LIMIT 1");
$user_data = $db->FetchArray();
?>
                    <div class="page-title">
                        <h3 class="breadcrumb-header">��������� ������</h3>
                    </div>
<?PHP
# �������� �� ����������
if(time() >= $user_data["last_sbor"] + 600 ){

?>
<center>
                <div class="col-lg-12">
                  <div class="panel panel-white">
                    <div class="panel-body">
					</div>
				  </div>
				</div>
</center>
<?PHP

}

?>
<?PHP
$_OPTIMIZATION["title"] = "��������� ������";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

/*
if($_SESSION["user_id"] != 1){
echo "<center><b><font color = red>����������� ������</font></b></center>";
return;
}
*/

?>


<?
# ��������� ��������!
$mini = 9; 

# Free-kassa
$fk_merchant_id = '71713'; //merchant_id ID �������� � free-kassa.ru http://free-kassa.ru/merchant/cabinet/help/
$fk_merchant_key = '030400'; //��������� ����� http://free-kassa.ru/merchant/cabinet/profile/tech.php

/// db_payeer_insert
if(isset($_POST["sum"])){

$sum = round(floatval($_POST["sum"]),2);

	if($sum > $mini){

# ������� � ��
$db->Query("INSERT INTO db_payeer_insert (user_id, user, sum, date_add) VALUES ('".$_SESSION["user_id"]."','".$_SESSION["user"]."','$sum','".time()."')");

$desc = base64_encode($_SERVER["HTTP_HOST"]." - USER ".$_SESSION["user"]);
$m_shop = $config->shopID;
$m_orderid = $db->LastInsert();
$m_amount = number_format($sum, 2, ".", "");
$m_curr = "RUB";
$m_desc = $desc;
$m_key = $config->secretW;

$arHash = array(
 $m_shop,
 $m_orderid,
 $m_amount,
 $m_curr,
 $m_desc,
 $m_key
);
$sign = strtoupper(hash('sha256', implode(":", $arHash)));


?>
<center><br>
                <div class="col-lg-12">
                  <div class="panel panel-warning">
                    <div class="panel-body">
					<form method="GET" action="//payeer.com/api/merchant/m.php">
					<input type="hidden" name="m_shop" value="<?=$config->shopID; ?>">
					<input type="hidden" name="m_orderid" value="<?=$m_orderid; ?>">
					<input type="hidden" name="m_amount" value="<?=number_format($sum, 2, ".", "")?>">
					<input type="hidden" name="m_curr" value="RUB">
					<input type="hidden" name="m_desc" value="<?=$desc; ?>">
					<input type="hidden" name="m_sign" value="<?=$sign; ?>">
					<div class="form-group">
						<label class="form-control-label">����� ����������: #<?=$m_orderid; ?></label>
					</div>
					<div class="form-group">
						<span class="form-control-label">����� ����������: <b><?=number_format($sum, 2, ".", "")?> ���.</b></span>
					</div>
					<div class="form-group">
						<span class="form-control-label">������ ������: RUB</span>
					</div>
					<div class="form-group">
						<label class="form-control">��������: <span class="text-muted">���������� ������� ������ <?=$usname; ?></span></label>
					</div>
					<div class="form-group">
						<input id="check" type="submit" class="btn btn-primary btn-lg" name="m_process" value="������� � ������" /><br>
						<font size="2" color="#A9A9A9"><i class="fa fa-camera"></i> ��������������� ����� ���������.</font>
                      </form>
					</div>
                    </div>
                  </div>
                </div>
				<p style="height: 150px;"/>
</center>
<?PHP
	}else echo "<center><div class='alert alert-danger'>����������� ����� ��� ���������� ���������� 10 ������</div></center><BR />";
?>
<?PHP

return;
}
?>
<script type="text/javascript">
var min = 0.01;
var ser_pr = 100;
function calculate(st_q) {
    
	var sum_insert = parseFloat(st_q);
	$('#res_sum').html( (sum_insert * ser_pr).toFixed(0) );
	
	
}
	
</script>
<center>
<div class="row">
                <div class="col-lg-6">
                  <div class="panel panel-primary">
                    <div class="panel-body">
                      <p><img src="/img/payeer2.png" style="height: 80px;"></p>
                      <form method="POST" action="" style="width: 300px;">
					  <input type="hidden" name="m" value="<?=$fk_merchant_id?>">
                        <div class="form-group">
                          <label class="form-control-label">��������� �� �����:</label>
						  <div class="input-group">
                          <input type="text" placeholder="������� �����" name="sum" size="7" id="psevdo" onchange="calculate(this.value)" onkeyup="calculate(this.value)" onfocusout="calculate(this.value)" onactivate="calculate(this.value)" ondeactivate="calculate(this.value)" class="form-control"><span class="input-group-addon">������. </span>
                          </div>
						</div>
                        <div class="line"></div>
                        <div class="form-group">       
						  <input type="submit" id="submit" value="����������" class="btn btn-primary btn-lg">
                        </div>
						<p class="text-muted"> ���������� ����������</p>
                      </form>
					  <hr>
					  <p>�������� �������: <b><span class="text-info">Payeer</span></b>, AdvCash, ���������, �������������, ����� ���������.</p>
                    </div>
                  </div>
                </div>
<script type="text/javascript">
var min = 10;
var ser_pr = 100;
function calculate(st_q) {
    
	var sum_insert = parseInt(st_q);
	$('#res_sum').html( (sum_insert * ser_pr) );
	
	var re = /[^0-9\.]/gi;
    var url = window.location.href;
    var desc = '<?=$usid;?>';
    var sum = $('#sum').val();
    if (re.test(sum)) {
        sum = sum.replace(re, '');
        $('#oa').val(sum);
    }
    if (sum < min) {
        $('#error').html('����� ������ ���� ������ '+min);
		$('#submit2').attr("disabled", "disabled");
        return false;
    } else {
        $('#error').html('');
    }

    $.get('/free-kassa-data.php?prepare_once=1&l='+desc+'&oa='+sum, function(data) {
         var re_anwer = /<hash>([0-9a-z]+)<\/hash>/gi;
         $('#s').val(re_anwer.exec(data)[1]);
         $('#submit2').removeAttr("disabled");
    });
}
	
</script>
<div id="error3"></div>
                <div class="col-lg-6">
                  <div class="panel panel-danger">
                    <div class="panel-body">
                      <p><img src="/img/free.png" style="height: 80px;"></p>
                      <form method=GET action="https://www.free-kassa.ru/merchant/cash.php" style="width: 300px;">
                        <div class="form-group">
                          <label class="form-control-label">��������� �� �����:</label>
						  <div class="input-group">
                          <input type="text" name="oa" id="sum" placeholder="������� �����" size="7" id="oa" onchange="calculate(this.value)" onkeyup="calculate(this.value)" onfocusout="calculate(this.value)" onactivate="calculate(this.value)" ondeactivate="calculate(this.value)" class="form-control"><span class="input-group-addon">������. </span>
                          </div>
						<input type="hidden" name="m" value="<?=$fk_merchant_id?>">
					  	<input type="hidden" name="s" id="s" value="0">
						<input type="hidden" name="us_id" id="us_id" value="<?=$usid;?>">
						<input type="hidden" name="o" id="desc" value="<?=$usid;?>" />
						</div>
                        <div class="line"></div>
                        <div class="form-group">   					
						  <input type="submit" id="submit2" value="������� � ������" class="btn btn-danger btn-lg">
                        </div>
						<p class="text-muted">���������� ����������</p>
                      </form>
					  <hr>
					  <p>�������� �������: <b><span class="text-warning">���� ������</span>, <span class="text-info">Payeer</span>, <span class="text-warning">������</span>.<span class="text-black">������</span>, Visa</b>, ��������� �����, SteamPay.</p>
                    </div>
                  </div>
                </div>
<script type="text/javascript">
calculate(100);
</script>
</div>
                <div class="col-lg-12">
                  <div class="panel panel-purple">
					<div class="panel-heading">
						<h3 class="panel-title text-white">������ ��������</h3>
					</div>
                    <div class="panel-body">
					<center><p>���� �������� ������� ����� +5% ��� ������ ���������� �������!</p></center>
                    </div>
                  </div>
                </div>
</center>