<?PHP
$_OPTIMIZATION["title"] = "������� - ��� ������";
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();
$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
?>
	
<?PHP
# �������
if(isset($_POST["sell"])){

$all_items = $user_data["a_b"] + $user_data["b_b"] + $user_data["c_b"] + $user_data["d_b"] + $user_data["e_b"] + $user_data["r_b"] + $user_data["t_b"] + $user_data["y_b"] + $user_data["u_b"];

	if($all_items > 0){
	
		$money_add = $func->SellItems($all_items, $sonfig_site["items_per_coin"]);
		
		$tomat_b = $user_data["a_b"];
		$straw_b = $user_data["b_b"];
		$pump_b = $user_data["c_b"];
		$pean_b = $user_data["d_b"];
		$peas_b = $user_data["e_b"];
		$peach_b = $user_data["r_b"];
		$watermelon_b = $user_data["t_b"];
		$peach8_b = $user_data["y_b"];
		$watermelon9_b = $user_data["u_b"];
		
		$money_b = ( (100 - $sonfig_site["percent_sell"]) / 100) * $money_add;
		$money_p = ( ($sonfig_site["percent_sell"]) / 100) * $money_add;
		
		# ��������� ������
		$db->Query("UPDATE db_users_b SET money_b = money_b + '$money_b', money_p = money_p + '$money_p', a_b = 0, b_b = 0, c_b = 0, d_b = 0, e_b = 0, r_b = 0, t_b = 0, y_b = 0, u_b = 0   
		WHERE id = '$usid'");
		
		$da = time();
		$dd = $da + 60*60*24*15;
		
		# ��������� ������ � ����������
		$db->Query("INSERT INTO db_sell_items (user, user_id, a_s, b_s, c_s, d_s, e_s, r_s, t_s, y_s, u_s, amount, all_sell, date_add, date_del) VALUES 
		('$usname','$usid','$tomat_b','$straw_b','$pump_b','$pean_b','$peas_b','$peach_b','$watermelon_b','$peach8_b','$watermelon9_b','$money_add','$all_items','$da','$dd')");
		
		echo "<center><font color = 'green'><b>�� ������� {$all_items} �������, �� ����� {$money_add} �������</b></font></center><BR />";
		
		$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
		$user_data = $db->FetchArray();
		
	}else echo "<center><font color = 'red'><b>��� ������ ��������� :(</b></font></center><BR />";

}
?>	




<?php 

	if(isset($_POST["sbor"])){
	
		if($user_data["last_sbor"] < (time() - 6) ){
		
			$tomat_s = $func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);
			$straw_s = $func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);
			$pump_s = $func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);
			$peas_s = $func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"]);
			$pean_s = $func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"]);
			$peach_s = $func->SumCalc($sonfig_site["r_in_h"], $user_data["r_t"], $user_data["last_sbor"]);
			$watermelon_s = $func->SumCalc($sonfig_site["t_in_h"], $user_data["t_t"], $user_data["last_sbor"]);
			$peach8_s = $func->SumCalc($sonfig_site["y_in_h"], $user_data["y_t"], $user_data["last_sbor"]);
			$watermelon9_s = $func->SumCalc($sonfig_site["u_in_h"], $user_data["u_t"], $user_data["last_sbor"]);
			
			$db->Query("UPDATE db_users_b SET 
			a_b = a_b + '$tomat_s', 
			b_b = b_b + '$straw_s', 
			c_b = c_b + '$pump_s', 
			d_b = d_b + '$peas_s', 
			e_b = e_b + '$pean_s', 
			r_b = r_b + '$peach_s', 
			t_b = t_b + '$watermelon_s',
			y_b = y_b + '$peach8_s', 
			u_b = u_b + '$watermelon9_s',
			all_time_a = all_time_a + '$tomat_s',
			all_time_b = all_time_b + '$straw_s',
			all_time_c = all_time_c + '$pump_s',
			all_time_d = all_time_d + '$peas_s',
			all_time_e = all_time_e + '$pean_s',
			all_time_r = all_time_r + '$peach_s',
			all_time_t = all_time_t + '$watermelon_s',
			all_time_y = all_time_y + '$peach8_s',
			all_time_u = all_time_u + '$watermelon9_s',
			last_sbor = '".time()."' 
			WHERE id = '$usid' LIMIT 1");
			
			echo "<center><font color = 'green'><b>�� ������� ������</b></font></center><BR />";
			
			$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
			$user_data = $db->FetchArray();
			
		}else echo "<center><font color = 'red'><b>������ ����� �������� �� ���� 1�� ���� �� 10 �����</b></font></center><BR />";
	
	}



?>


<?php 

# ������� ������ ������
if(isset($_POST["item"])){

$array_items = array(1 => "a_t", 2 => "b_t", 3 => "c_t", 4 => "d_t", 5 => "e_t", 6 => "r_t", 7 => "t_t", 8 => "y_t", 9 => "u_t");
$array_name = array(1 => "������ 1 ��", 2 => "������ 2 ��", 3 => "������ 3 ��", 4 => "������ 4 ��", 5 => "������ 5 ��", 6 => "������ 6 ��", 7 => "������ 7 ��", 8 => "������ 8 ��", 9 => "������ 9 ��");
$item = intval($_POST["item"]);
$citem = $array_items[$item];

	if(strlen($citem) >= 3){
		
		# ��������� �������� ������������
		$need_money = $sonfig_site["amount_".$citem];
		if($need_money <= $user_data["money_b"]){
		
			if($user_data["last_sbor"] == 0 OR $user_data["last_sbor"] > ( time() - 60*20) ){
				
				$to_referer = $need_money * 0.1;
				# ��������� ������ � ��������� ������
				$db->Query("UPDATE db_users_b SET money_b = money_b - $need_money, $citem = $citem + 1,  
				last_sbor = IF(last_sbor > 0, last_sbor, '".time()."') WHERE id = '$usid'");
				
				# ������ ������ � �������
				$db->Query("INSERT INTO db_stats_btree (user_id, user, tree_name, amount, date_add, date_del) 
				VALUES ('$usid','$usname','".$array_name[$item]."','$need_money','".time()."','".(time()+60*60*24*15)."')");
				
				echo "<script>setTimeout(function(){swal(\"�� ������� ������ ������\", \"�������\")}, 500); </script>";
				
				$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
				$user_data = $db->FetchArray();
				
			}else echo "<script>setTimeout(function(){swal(\"����� ��� ��� �������� ������  �������� � ������ �����\", \"������\")}, 500);</script>";
		
		}else echo "<script>setTimeout(function(){swal(\"�� ����� ����� �� ���������� ������� ��� ������� ������\", \"������\")}, 500);</script>";
	
	}else echo 222;

}

?>






<div class="col-sm-12 col-lg-6">
	<blockquote>
        <h2 style="margin-top: 2%;">��������</h2>
        </blockquote>
</div>

        </div>
            <div class="container-fluid">
                <div class="row cm-fix-height">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">����� ����� ���������:</div>
                            <div class="panel-body text-center">
                                <h1 style="margin-top: 0;">
                                    <span id="bls"><?=$func->SellItems($user_data["a_t,b_t,c_t,d_t,e_t,r_t,t_t,y_t,u_t"], $sonfig_site["items_per_coin"]); ?></span> <small>���.</small>
                                </h1>
                                <h2>
                                    <b><?php echo sprintf("%.4f",$kyrcall/$sonfig_site["items_per_coin"]);?></b> <small><span class="rub"> �</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style> / ���</small>
                                </h2>
              
                                <h5 style="margin-top: 18px;">
                                    ����� �����, ��� ������ ���������, ���� �� <small>0.01 ���.</small>
                                </h5>
                                          </div>
										  <form action="" method="post">
										 <?=$user_data["a_t"]; ?>	 <?=$func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);?>
										<?=$user_data["b_t"]; ?>	  <?=$func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);?>
										<?=$user_data["c_t"]; ?>	  <?=$func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);?>
										 <?=$user_data["d_t"]; ?>	 <?=$func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"]);?>
										<?=$user_data["e_t"]; ?>	  <?=$func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"]);?>
										<?=$user_data["r_t"]; ?>	  <?=$func->SumCalc($sonfig_site["r_in_h"], $user_data["r_t"], $user_data["last_sbor"]);?>
										 <?=$user_data["t_t"]; ?>	 <?=$func->SumCalc($sonfig_site["t_in_h"], $user_data["t_t"], $user_data["last_sbor"]);?>
										 <?=$user_data["y_t"]; ?>	 <?=$func->SumCalc($sonfig_site["y_in_h"], $user_data["y_t"], $user_data["last_sbor"]);?>
										 <?=$user_data["u_t"]; ?>	 <?=$func->SumCalc($sonfig_site["u_in_h"], $user_data["u_t"], $user_data["last_sbor"]);?>
<center><input type="submit" name="sbor" value="������� ����� ��� �����" class="btn btn-block btn-danger waves-effect"/></center>
</form>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">�������� �������� ��������</div>
                            <div class="panel-body">
                                <blockquote style="margin: 0;">
                                    <p>��� ������ � ��� ����, ��� ���� �����. � ������ �� ������, ���� �������� ���������. ��������, ���������� 9 ������ ��������:</p>
                                    <footer>27.5050 <span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style>. � ���, 660.120 <span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style>. � ����, 19 803.60 <span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style>. � �����!</footer>
                                </blockquote>
                            </div>
							<form action="" method="post">
							  <?=$user_data["a_t"]; ?>	            <?=$func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);?>
								<?=$user_data["b_t"]; ?>			  <?=$func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);?>
								<?=$user_data["c_t"]; ?>			  <?=$func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);?>
								<?=$user_data["d_t"]; ?>			  <?=$func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"]);?>
								<?=$user_data["e_t"]; ?>			  <?=$func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"]);?>
								<?=$user_data["r_t"]; ?>			  <?=$func->SumCalc($sonfig_site["r_in_h"], $user_data["r_t"], $user_data["last_sbor"]);?>
								<?=$user_data["t_t"]; ?>			  <?=$func->SumCalc($sonfig_site["t_in_h"], $user_data["t_t"], $user_data["last_sbor"]);?>
								<?=$user_data["y_t"]; ?>			  <?=$func->SumCalc($sonfig_site["y_in_h"], $user_data["y_t"], $user_data["last_sbor"]);?>
								<?=$user_data["u_t"]; ?>			  <?=$func->SumCalc($sonfig_site["u_in_h"], $user_data["u_t"], $user_data["last_sbor"]);?>
	<input type="submit" name="sell" value="����� ����� �������� ������" class="btn btn-block btn-danger waves-effect" style="height: 30px;"></form>
                        </div>
                    </div>

                </div>


                <div class="row">

                            <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">������ 1 ��.</div>
                            <div class="panel-body text-center">
                    <table class="table table-bordered">
                            <img src="/assets/img/car/car-1.png" align="center" style="width: 50%;" alt="" />
                        <tr>
                            <td><span class="pull-left">���������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["amount_a_t"]; ?> ���.</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">�������:</span></td>
                            <td><span class="pull-right">15% / �����</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">��������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["a_in_h"]; ?><span class="rub"> �</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style> / ���</span></td>
                        </tr>

                    </table>
                  <form method="post" action="/account/market.html">
                    <input type="hidden" name="item" value="1">
                        <button type="submit" class="btn btn-block btn-danger waves-effect">  ������ ������ <?=$sonfig_site["amount_a_t"]; ?> <span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style></button>
                            </form>
                            </div>
                        </div>
                    </div>
                            <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">������ 2 ��.</div>
                            <div class="panel-body text-center">
                    <table class="table table-bordered">
                            <img src="/assets/img/car/car-2.png" align="center" style="width: 50%;" alt="" />
                        <tr>
                            <td><span class="pull-left">���������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["amount_b_t"]; ?> ���.</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">�������:</span></td>
                            <td><span class="pull-right">24% / �����</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">��������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["b_in_h"]; ?><span class="rub"> �</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style> / ���</span></td>
                        </tr>

                    </table>
                  <form method="post" action="/account/market.html">
                    <input type="hidden" name="item" value="2">
                        <button type="submit" name="buy" class="btn btn-block btn-danger waves-effect">  ������ ������ <?=$sonfig_site["amount_b_t"]; ?> <span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style></button>
                            </form>
                            </div>
                        </div>
                    </div>
                            <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">������ 3 ��.</div>
                            <div class="panel-body text-center">
                    <table class="table table-bordered">
                            <img src="/assets/img/car/car-3.png" align="center" style="width: 50%;" alt="" />
                        <tr>
                            <td><span class="pull-left">���������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["amount_c_t"]; ?> ���.</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">�������:</span></td>
                            <td><span class="pull-right">26% / �����</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">��������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["c_in_h"]; ?><span class="rub"> �</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style> / ���</span></td>
                        </tr>

                    </table>
                   <form method="post" action="/account/market.html">
                    <input type="hidden" name="item" value="3">
                        <button type="submit" name="buy" class="btn btn-block btn-danger waves-effect">  ������ ������ <?=$sonfig_site["amount_c_t"]; ?> <span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style></button>
                            </form>
                            </div>
                        </div>
                    </div>
                            <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">������ 4 ��.</div>
                            <div class="panel-body text-center">
                    <table class="table table-bordered">
                            <img src="/assets/img/car/car-4.png" align="center" style="width: 50%;" alt="" />
                        <tr>
                            <td><span class="pull-left">���������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["amount_d_t"]; ?> ���.</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">�������:</span></td>
                            <td><span class="pull-right">28% / �����</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">��������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["d_in_h"]; ?><span class="rub"> �</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style> / ���</span></td>
                        </tr>

                    </table>
                 <form method="post" action="/account/market.html">
                    <input type="hidden" name="item" value="4">
                        <button type="submit" name="buy" class="btn btn-block btn-danger waves-effect">  ������ ������ <?=$sonfig_site["amount_d_t"]; ?> <span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style></button>
                            </form>
                            </div>
                        </div>
                    </div>
                            <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">������ 5 ��.</div>
                            <div class="panel-body text-center">
                    <table class="table table-bordered">
                            <img src="/assets/img/car/car-5.png" align="center" style="width: 50%;" alt="" />
                        <tr>
                            <td><span class="pull-left">���������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["amount_e_t"]; ?> ���.</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">�������:</span></td>
                            <td><span class="pull-right">29% / �����</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">��������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["e_in_h"]; ?><span class="rub"> �</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style> / ���</span></td>
                        </tr>

                    </table>
                  <form method="post" action="/account/market.html">
                    <input type="hidden" name="item" value="5">
                        <button type="submit" name="buy" class="btn btn-block btn-danger waves-effect">  ������ ������ <?=$sonfig_site["amount_e_t"]; ?> <span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style></button>
                            </form>
                            </div>
                        </div>
                    </div>
                            <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">������ 6 ��.</div>
                            <div class="panel-body text-center">
                    <table class="table table-bordered">
                            <img src="/assets/img/car/car-6.png" align="center" style="width: 50%;" alt="" />
                        <tr>
                            <td><span class="pull-left">���������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["amount_r_t"]; ?> ���.</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">�������:</span></td>
                            <td><span class="pull-right">30% / �����</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">��������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["r_in_h"]; ?><span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style> / ���</span></td>
                        </tr>

                    </table>
                    <form method="post" action="/account/market.html">
                    <input type="hidden" name="item" value="6">
                        <button type="submit" name="buy" class="btn btn-block btn-danger waves-effect">  ������ ������ <?=$sonfig_site["amount_r_t"]; ?> <span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style></button>
                            </form>
                            </div>
                        </div>
                    </div>
                            <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">������ 7 ��.</div>
                            <div class="panel-body text-center">
                    <table class="table table-bordered">
                            <img src="/assets/img/car/car-7.png" align="center" style="width: 50%;" alt="" />
                        <tr>
                            <td><span class="pull-left">���������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["amount_t_t"]; ?> ���.</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">�������:</span></td>
                            <td><span class="pull-right">31% / �����</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">��������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["t_in_h"]; ?><span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style> / ���</span></td>
                        </tr>

                    </table>
                     <form method="post" action="/account/market.html">
                    <input type="hidden" name="item" value="7">
                        <button type="submit" name="buy" class="btn btn-block btn-danger waves-effect">  ������ ������ <?=$sonfig_site["amount_t_t"]; ?> <span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style></button>
                            </form>
                            </div>
                        </div>
                    </div>
                            <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">������ 8 ��.</div>
                            <div class="panel-body text-center">
                    <table class="table table-bordered">
                            <img src="/assets/img/car/car-8.png" align="center" style="width: 50%;" alt="" />
                        <tr>
                            <td><span class="pull-left">���������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["amount_y_t"]; ?> ���.</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">�������:</span></td>
                            <td><span class="pull-right">33% / �����</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">��������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["y_in_h"]; ?><span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style> / ���</span></td>
                        </tr>

                    </table>
                    <form method="post" action="/account/market.html">
                    <input type="hidden" name="item" value="8">
                        <button type="submit" name="buy" class="btn btn-block btn-danger waves-effect">  ������ ������ <?=$sonfig_site["amount_y_t"]; ?> <span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style></button>
                            </form>
                            </div>
                        </div>
                    </div>
                            <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">������ 9 ��.</div>
                            <div class="panel-body text-center">
                    <table class="table table-bordered">
                            <img src="/assets/img/car/car-9.png" align="center" style="width: 50%;" alt="" />
                        <tr>
                            <td><span class="pull-left">���������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["amount_u_t"]; ?> ���.</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">�������:</span></td>
                            <td><span class="pull-right">34% / �����</span></td>
                        </tr>
                        <tr>
                            <td><span class="pull-left">��������:</span></td>
                            <td><span class="pull-right"><?=$sonfig_site["u_in_h"]; ?><span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style> / ���</span></td>
                        </tr>

                    </table>
                    <form method="post" action="/account/market.html">
                    <input type="hidden" name="item" value="9">
                        <button type="submit" name="buy" class="btn btn-block btn-danger waves-effect">  ������ ������ <?=$sonfig_site["amount_u_t"]; ?> <span class="rub">�</span> <style>.rub { 
	line-height: 5px;
	width: 0.4em;
	border-bottom: 1px solid #000; 
	display: inline-block;
} </style></button>
                            </form>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">��� ������</div>
                            <div class="panel-body">
                                  <div class="col-lg-1 col-sm-1 col-xs-1">
                    <img src="/assets/img/car/car-1.png" style="width: 100%;" alt="" />
                  </div>
                 
                            </div>
                        </div>
                    </div>

                </div>
            </div>



<script>
  function funcSuccessgetBallance (error){
      var result = JSON.parse(error);
      var balance = parseFloat(result).toFixed(8); 
      $('#bls').html(balance);
  }

  function getBallance (){
      setInterval(function(){
             var data_pr = {type: 'ajax'};
          $.ajax ({
              cache: false,
              data: data_pr,
              dataType: "json",
              type: 'POST',
              timeout: 5000,
              url: '/ajax/balance',
              success: funcSuccessgetBallance
          })
      }, 1000)
  }

  getBallance ();
</script>