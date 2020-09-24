<div class="content">
        <div class="header">
      

            <h1 class="page-title">История продаж</h1>
                    

        </div>
        <div class="main-content">
		
		
   
        <div class="panel panel-default">
         <center>
<?PHP
/* 
Script MINE-INCOME
Autor: EvgeSH
URL: MyShopScript.ru
ICQ: 326-728
Email: EvgeSH@ProtonMail.com
*/
$tdadd = time() - 5*60;
	if(isset($_POST["clean"])){
	
		$db->Query("DELETE FROM ".$pref."db_sell_items WHERE date_add < '$tdadd'");
		echo "<center><font color = 'green'><b>Очищено</b></font></center><BR />";
	}

$db->Query("SELECT * FROM ".$pref."db_sell_items ORDER BY id DESC");

if($db->NumRows() > 0){

?>
<table class="table table-bordered table-striped" >
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Логин</th>
                  <th>Продал</th>
				   <th>Порлучил</th>
				    <th>Дата</th>
                </tr>
              </thead>




<?PHP

	while($data = $db->FetchArray()){
	
	?>
	
	<tbody>
                <tr>
                  <td><?=$data["id"]; ?></td>
                  <td><?=$data["user"]; ?></td>
                  <td><?=$data["all_sell"]; ?></td>
                <td><?=sprintf("%.2f",$data["amount"]); ?></td>
                  <td><?=date("d.m.Y в H:i:s",$data["date_add"]); ?></td>
				
				</tr>
                
              </tbody>
	

	<?PHP
	
	}

?>

</table>
<BR />
<form action="" method="post">
<center><input type="submit" name="clean" class="form-controlspan12 form-control" value="Очистить" /></center>
</form>
<?PHP

}else echo "<center><b>Записей нет</b></center><BR />";
?>
  </div>
    </div>
    
   


  <footer>
                <hr>

                
               <p class="pull-right">Admin <a href="https://profitscripts.tech" target="_blank">Panel</a> by <a href="https://profitscripts.tech/" target="_blank">Profit Scripts</a></p>
                <p>© 2018 <a href="https://profitscripts.tech/" target="_blank">Profit Scripts</a></p>
            </footer>
  
  
