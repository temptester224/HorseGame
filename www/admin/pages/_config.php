<div class="content">
        <div class="header">
      

            <h1 class="page-title">Настройки</h1>
                    

        </div>
        <div class="main-content">
		
		
   
        <div class="panel panel-default">
         <center>	

<?PHP
$db->Query("SELECT * FROM db_config WHERE id = '1'");
$data_c = $db->FetchArray();

# Обновление
if(isset($_POST["save"])){

	$admin = $func->IsLogin($_POST["admin"]);
	$pass = $func->IsLogin($_POST["pass"]);
	
	
	$ser_per_wmr = floatval ($_POST["ser_per_wmr"]);
	$ser_per_wmz = floatval ($_POST["ser_per_wmz"]);
	$ser_per_wme = floatval ($_POST["ser_per_wme"]);
	$percent_swap = floatval ($_POST["percent_swap"]);
	$percent_sell = floatval ($_POST["percent_sell"]);
	$items_per_coin = floatval ($_POST["items_per_coin"]);
	
	$tomat_in_h = sprintf("%01.4f", $_POST['a_in_h']);
	$straw_in_h = sprintf("%01.4f", $_POST['b_in_h']);
	$pump_in_h = sprintf("%01.4f", $_POST['c_in_h']);
	$peas_in_h = sprintf("%01.4f", $_POST['d_in_h']);
	$pean_in_h = sprintf("%01.4f", $_POST['e_in_h']);
	$peach_in_h = sprintf("%01.4f", $_POST['r_in_h']);
	$watermelon_in_h = sprintf("%01.4f", $_POST['t_in_h']);
	$peach8_in_h = sprintf("%01.4f", $_POST['y_in_h']);
	$watermelon9_in_h = sprintf("%01.4f", $_POST['u_in_h']);
	
	$amount_tomat_t = intval($_POST["amount_a_t"]);
	$amount_straw_t = intval($_POST["amount_b_t"]);
	$amount_pump_t = intval($_POST["amount_c_t"]);
	$amount_peas_t = intval($_POST["amount_d_t"]);
	$amount_pean_t = intval($_POST["amount_e_t"]);
	$amount_peach_t = intval($_POST["amount_r_t"]);
	$amount_watermelon_t = intval($_POST["amount_t_t"]);
	$amount_peach8_t = intval($_POST["amount_y_t"]);
	$amount_watermelon9_t = intval($_POST["amount_u_t"]);

	{
	
		$db->Query("UPDATE db_config SET 
		
		admin = '$admin',
		pass = '$pass',
		ser_per_wmr = '$ser_per_wmr',
		ser_per_wmz = '$ser_per_wmz',
		ser_per_wme = '$ser_per_wme',
		percent_swap = '$percent_swap',
		percent_sell = '$percent_sell',
		items_per_coin = '$items_per_coin',
		a_in_h = '$tomat_in_h',
		b_in_h = '$straw_in_h',
		c_in_h = '$pump_in_h',
		d_in_h = '$peas_in_h',
		e_in_h = '$pean_in_h',
		r_in_h = '$peach_in_h',
		t_in_h = '$watermelon_in_h',
		y_in_h = '$peach8_in_h',
		u_in_h = '$watermelon9_in_h',
		amount_a_t = '$amount_tomat_t',
		amount_b_t = '$amount_straw_t',
		amount_c_t = '$amount_pump_t',
		amount_d_t = '$amount_peas_t',
		amount_e_t = '$amount_pean_t',
		amount_r_t = '$amount_peach_t',
		amount_t_t = '$amount_watermelon_t',
		amount_y_t = '$amount_peach8_t',
		amount_u_t = '$amount_watermelon9_t'
		
		WHERE id = '1'");
		
		echo "<center><font color = 'green'><b>Сохранено</b></font></center><BR />";
		$db->Query("SELECT * FROM db_config WHERE id = '1'");
		$data_c = $db->FetchArray();
	}
	
}

?>
<form action="" method="post">
<table width="100%" border="0">
<input type="hidden" name="save">




<tr>
    <td><b>Логин:</b></td>
	<td width="150" align="center"><input type="password" name="admin" value="<?=$data_c["admin"]; ?>" /></td>
  </tr>

  
  <tr bgcolor="#EFEFEF">
    <td><b>Пароль:</b></td>
	<td width="150" align="center"><input type="password" name="pass" value="<?=$data_c["pass"]; ?>" /></td>
  </tr>






  
  <tr>
    <td><b>Стоимость 1 RUB (Монетами):</b></td>
	<td width="150" align="center"><input type="text" name="ser_per_wmr" value="<?=$data_c["ser_per_wmr"]; ?>" /></td>
  </tr>

  
  <tr bgcolor="#EFEFEF">
    <td><b>Прибавлять % при обмене (От 1 до 99):</b></td>
	<td width="150" align="center"><input type="text" name="percent_swap" value="<?=$data_c["percent_swap"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>% монет на вывод при продаже (от 1 до 99):</b><BR /></td>
	<td width="150" align="center"><input type="text" name="percent_sell" value="<?=$data_c["percent_sell"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Сколько монет = 1 руб:</b></td>
	<td width="150" align="center"><input type="text" name="items_per_coin" value="<?=$data_c["items_per_coin"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Доходность завод 1 ур:</b></td>
	<td width="150" align="center"><input type="text" name="a_in_h" value="<?=$data_c["a_in_h"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Доходность завод 2 ур:</b></td>
	<td width="150" align="center"><input type="text" name="b_in_h" value="<?=$data_c["b_in_h"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Доходность завод 3 ур:</b></td>
	<td width="150" align="center"><input type="text" name="c_in_h" value="<?=$data_c["c_in_h"]; ?>" /></td>
  </tr>
  
  
  
  
   <tr bgcolor="#EFEFEF">
    <td><b>Доходность завод 4 ур:</b></td>
	<td width="150" align="center"><input type="text" name="d_in_h" value="<?=$data_c["d_in_h"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Доходность завод 5 ур:</b></td>
	<td width="150" align="center"><input type="text" name="e_in_h" value="<?=$data_c["e_in_h"]; ?>" /></td>
  </tr>
  
   <tr bgcolor="#EFEFEF">
    <td><b>Доходность завод 6 ур:</b></td>
	<td width="150" align="center"><input type="text" name="r_in_h" value="<?=$data_c["r_in_h"]; ?>" /></td>
  </tr>
  
  
  
    <tr>
    <td><b>Доходность завод 7 ур:</b></td>
	<td width="150" align="center"><input type="text" name="t_in_h" value="<?=$data_c["t_in_h"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Доходность завод 8 ур:</b></td>
	<td width="150" align="center"><input type="text" name="y_in_h" value="<?=$data_c["y_in_h"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Доходность завод 9 ур:</b></td>
	<td width="150" align="center"><input type="text" name="u_in_h" value="<?=$data_c["u_in_h"]; ?>" /></td>
  </tr>
  
  
  

  
  
  
  
  
  
  
  
  
  <tr>
    <td><b>Стоимость завод 1 ур:</b></td>
	<td width="150" align="center"><input type="text" name="amount_a_t" value="<?=$data_c["amount_a_t"]; ?>" /></td>
  </tr>
  
   <tr bgcolor="#EFEFEF">
    <td><b>Стоимость завод 2 ур:</b></td>
	<td width="150" align="center"><input type="text" name="amount_b_t" value="<?=$data_c["amount_b_t"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Стоимость завод 3 ур:</b></td>
	<td width="150" align="center"><input type="text" name="amount_c_t" value="<?=$data_c["amount_c_t"]; ?>" /></td>
  </tr>
  
  
  
   <tr bgcolor="#EFEFEF">
    <td><b>Стоимость завод 4 ур:</b></td>
	<td width="150" align="center"><input type="text" name="amount_d_t" value="<?=$data_c["amount_d_t"]; ?>" /></td>
  </tr>
  
   <tr>
    <td><b>Стоимость завод 5 ур:</b></td>
	<td width="150" align="center"><input type="text" name="amount_e_t" value="<?=$data_c["amount_e_t"]; ?>" /></td>
  </tr>
  
   <tr bgcolor="#EFEFEF">
    <td><b>Стоимость завод 6 ур:</b></td>
	<td width="150" align="center"><input type="text" name="amount_r_t" value="<?=$data_c["amount_r_t"]; ?>" /></td>
  </tr>
  
  
  
     <tr bgcolor="#EFEFEF">
    <td><b>Стоимость завод 7 ур:</b></td>
	<td width="150" align="center"><input type="text" name="amount_t_t" value="<?=$data_c["amount_t_t"]; ?>" /></td>
  </tr>
  
   <tr>
    <td><b>Стоимость завод 8 ур:</b></td>
	<td width="150" align="center"><input type="text" name="amount_y_t" value="<?=$data_c["amount_y_t"]; ?>" /></td>
  </tr>
  
   <tr bgcolor="#EFEFEF">
    <td><b>Стоимость завод 9 ур:</b></td>
	<td width="150" align="center"><input type="text" name="amount_u_t" value="<?=$data_c["amount_u_t"]; ?>" /></td>
  </tr>
  
  
  
  <tr> <td colspan="2" align="center"><input type="submit" value="Сохранить" /></td> </tr>
</table>
</form>
</div>
<div class="clr"></div>	
