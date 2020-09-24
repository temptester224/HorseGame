      <script src="lib/jQuery-Knob/js/jquery.knob.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $(".knob").knob();
        });
    </script>


    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/premium.css">
  
  <div class="content">
        <div class="header">
      

            <h1 class="page-title">Статистика проекта</h1>
                    

        </div>
        <div class="main-content">
 
 

	


<?PHP
/* 
Script MINE-INCOME
Autor: EvgeSH
URL: MyShopScript.ru
ICQ: 326-728
Email: EvgeSH@ProtonMail.com
*/

$db->Query("SELECT 
	COUNT(id) all_users, 
	SUM(money_b) money_b, 
	SUM(money_p) money_p, 
	
	SUM(a_t) a_t, 
	SUM(b_t) b_t, 
	SUM(c_t) c_t, 
	SUM(d_t) d_t, 
	SUM(e_t) e_t, 
	SUM(r_t) r_t,
	SUM(t_t) t_t,
	SUM(y_t) y_t,
	SUM(u_t) u_t,
	
	SUM(a_b) a_b, 
	SUM(b_b) b_b, 
	SUM(c_b) c_b, 
	SUM(d_b) d_b, 
	SUM(e_b) e_b, 
	SUM(r_b) r_b, 
	SUM(t_b) t_b, 
	SUM(y_b) y_b, 
	SUM(u_b) u_b, 
		
	SUM(all_time_a) all_time_a, 
	SUM(all_time_b) all_time_b, 
	SUM(all_time_c) all_time_c, 
	SUM(all_time_d) all_time_d, 
	SUM(all_time_e) all_time_e,
	SUM(all_time_r) all_time_r,
	SUM(all_time_t) all_time_t,
	SUM(all_time_y) all_time_y,
	SUM(all_time_u) all_time_u,
	SUM(payment_sum) payment_sum, 
	SUM(insert_sum) insert_sum
	
	
	FROM ".$pref."db_users_b");
$data_stats = $db->FetchArray();

?>

<div class="panel panel-default" >

        <a href="#page-stats" class="panel-heading" data-toggle="collapse">Инфо</a>
        <div id="page-stats" class="panel-collapse panel-body collapse in">

                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="knob-container">
                                <input class="knob" data-width="200" data-min="0" data-max="3000" data-displayPrevious="true" value="<?=$data_stats["all_users"]; ?>" data-fgColor="#92A3C2" data-readOnly=true;>
                                <h3 class="text-muted text-center">Пользователей</h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="knob-container">
                                <input class="knob" data-width="200" data-min="0" data-max="4500" data-displayPrevious="true" value="<?=sprintf("%.2f",$data_stats["insert_sum"]); ?>" data-fgColor="#92A3C2" data-readOnly=true;>
                                <h3 class="text-muted text-center">Введено пользователями</h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="knob-container">
                                <input class="knob" data-width="200" data-min="0" data-max="2700" data-displayPrevious="true" value="<?=sprintf("%.2f",$data_stats["payment_sum"]); ?>" data-fgColor="#92A3C2" data-readOnly=true;>
                                <h3 class="text-muted text-center">Выплачено пользователям</h3>
                            </div>
                        </div>
                      
                    </div>
					
        </div>
		
    </div>

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading no-collapse">Статистика Автомобилей<span class="label label-warning"></span></div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Машина 1 ур</th>
                  <th>Машина 2 ур</th>
                  <th>Машина 3 ур</th>
				  
				   <th>Машина 4 ур</th>
                  <th>Машина 5 ур</th>
                  <th>Машина 6 ур</th>
				  
				   <th>Машина 7 ур</th>
				   <th>Машина 8 ур</th>
				   <th>Машина 9 ур</th>
				  
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?=intval($data_stats["a_t"]); ?></td>
                  <td><?=intval($data_stats["b_t"]); ?></td>
                  <td><?=intval($data_stats["c_t"]); ?></td>
				  
				      <td><?=intval($data_stats["d_t"]); ?></td>
                  <td><?=intval($data_stats["e_t"]); ?></td>
                  <td><?=intval($data_stats["r_t"]); ?></td>
				   <td><?=intval($data_stats["t_t"]); ?></td>
				    <td><?=intval($data_stats["y_t"]); ?></td>
					 <td><?=intval($data_stats["u_t"]); ?></td>
                </tr>
                
              </tbody>
            </table>
        </div>
    </div>
  

   
    <div class="col-sm-6 col-md-6">
        <div class="panel panel-default">
            <a href="#widget1container" class="panel-heading" data-toggle="collapse">Финансовая часть </a>
            
                <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>На счетах для покупок</th>
                  <th>На счетах для вывода</th>
                  
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?=sprintf("%.0f",$data_stats["money_b"]); ?></td>
                  <td><?=sprintf("%.0f",$data_stats["money_p"]); ?></td>
                  
                </tr>
                
              </tbody>
            </table>
            
        </div>
    </div>
</div>



  <footer>
                <hr>

                
                <p class="pull-right">Admin <a href="https://profitscripts.tech" target="_blank">Panel</a> by <a href="https://profitscripts.tech/" target="_blank">Profit Scripts</a></p>
                <p>© 2018 <a href="https://profitscripts.tech/" target="_blank">Profit Scripts</a></p>
            </footer>
  
  