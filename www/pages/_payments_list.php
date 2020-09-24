<?PHP
$_OPTIMIZATION["title"] = "Статистика";
$_OPTIMIZATION["description"] = "Статистика проекта";
$_OPTIMIZATION["keywords"] = "Подробная статистика проекта";
?>

	<?PHP
$tfstats = time() - 60*60*24;
$db->Query("SELECT 
(SELECT COUNT(*) FROM db_users_a) all_users,
(SELECT SUM(insert_sum) FROM db_users_b) all_insert, 
(SELECT SUM(payment_sum) FROM db_users_b) all_payment, 
(SELECT COUNT(*) FROM db_users_a WHERE date_reg > '$tfstats') new_users,
(SELECT COUNT(*) FROM db_users_a WHERE date_login > '$tfstats') activ_users");
$stats_data = $db->FetchArray();

?>



<!--== Page Title Area Start ==-->
    <section id="page-title-area" class="section-padding overlay">
        <div class="container">
            <div class="row">

                <!-- Page Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Статистика</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>Открытая статистика, пополнения, выплаты</p>
                    </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->

    <!--== Help Desk Page Content Start ==-->
    <section id="help-desk-page-wrap" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="team-content">
                        <div class="row">
                            <!-- Team Tab Menu start -->
                            <div class="col-lg-6">
                                <div class="team-tab-menu">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="tab_item_1" data-toggle="tab" href="#team_member_1" role="tab" aria-selected="true">
                                                <div class="team-mem-icon">
                                                    <img src="/assets/img/team/team-mem-thumb-1.png" alt="Super-Gonka">
                                                </div>
                                                <h5><span class="counter"><?=$stats_data["all_users"]; ?></span> +[<?=$stats_data["new_users"]; ?>]<br />Участников</h5>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab_item_2" data-toggle="tab" href="#team_member_2" role="tab" aria-selected="true">
                                                <div class="team-mem-icon">
                                                    <img src="/assets/img/team/team-mem-thumb-2.png" alt="Super-Gonka">
                                                </div>
                                                <h5><span class="counter"><?=sprintf("%.2f",$stats_data["all_insert"]); ?></span><i class="fa fa-rub fa-fw"></i><br />Пополнено</h5>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- Team Tab Menu End -->

                            <!-- Team Tab Menu start -->
                            <div class="col-lg-6">
                                <div class="team-tab-menu">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="tab_item_3" data-toggle="tab" href="#team_member_3" role="tab" aria-selected="true">
                                                <div class="team-mem-icon">
                                                    <img src="/assets/img/team/team-mem-thumb-3.png" alt="Super-Gonka">
                                                </div>
                                                <h5><span class="counter"><?=intval(((time() - $config->SYSTEM_START_TIME) / 86400 ) +1); ?></span> Д/ней<br />Время работы</h5>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab_item_4" data-toggle="tab" href="#team_member_4" role="tab" aria-selected="true">
                                                <div class="team-mem-icon">
                                                    <img src="/assets/img/team/team-mem-thumb-4.png" alt="Super-Gonka">
                                                </div>
                                                <h5><span class="counter"><?=sprintf("%.2f",$stats_data["all_payment"]); ?></span><i class="fa fa-rub fa-fw"></i><br />Выплачено</h5>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- Team Tab Menu End -->

                                </div>
                            </div>
                            <!-- Team Tab Content End -->
                        </div>
                    </div>
                </div>
        	</div>
        </div>
    </section>
    <!--== Help Desk Page Content End ==-->
	
	

    <!--== Pricing Area Start ==-->
    <section id="pricing-page-area" class="section-padding">
        <div class="container">
            <div class="row">
		<!-- Sidebar Area Start -->
                <div class="col-lg-6">
                    <div class="sidebar-content-wrap m-t-50">
                        <!-- Single Sidebar Start -->
                        <div class="single-sidebar">
                            <h3>Последние 20 выплат</h3>

                            <div class="sidebar-body">
                                        <div class="tech-info-table">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>Логин</th>
                                                    <th>Сумма</th>
                                                </tr>
                                                </thead>
                                              

<?php
	$db->Query("SELECT * FROM `db_users_b`,`db_users_a` WHERE db_users_b.id = db_users_a.id ORDER BY db_users_b.payment_sum DESC LIMIT 20 ");
	while($data = $db->FetchArray()){
	?>
	  <tr class="text-center">
<th><?=$data["user"]; ?></th>
		<td><?=sprintf("%.2f",$data["payment_sum"]); ?> руб.</td>
	</tr>
	<?PHP
	}
?>
</table>
                                        </div>
                            </div>
                        </div>

  <!-- Single Sidebar Start -->
                        <div class="single-sidebar">
                            <h3>Последние 20 пополнений</h3>

                            <div class="sidebar-body">
                                        <div class="tech-info-table">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>Логин</th>
                                                    <th>Сумма</th>
                                                </tr>
                                                </thead>
                                                                     
 
<?php
	$db->Query("SELECT * FROM `db_users_b`,`db_users_a` WHERE db_users_b.id = db_users_a.id ORDER BY db_users_b.insert_sum DESC LIMIT 20 ");
	while($data = $db->FetchArray()){
	?>
	  <tr class="text-center">
<th><?=$data["user"]; ?></th>
		<td><?=sprintf("%.2f",$data["insert_sum"]); ?> руб.</td>
	</tr>
	<?PHP
	}
?>
</table>
                                        </div>
                            </div>
                        </div>
                        <!-- Single Sidebar End -->
                    </div>
                </div>

<!-- Sidebar Area Start -->
                <div class="col-lg-6">
                    <div class="sidebar-content-wrap m-t-50">
                        <!-- Single Sidebar Start -->
                        <div class="single-sidebar">
                            <h3>Участники по количесвтву рефералов</h3>

                            <div class="sidebar-body">
                                        <div class="tech-info-table">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr class="text-center">
												 <th>Логин</th>
                                                 <th>Кол-во рефералов</th>
                                                </tr>
                                                </thead>
                                                                      

<?php
	$db->Query("SELECT * FROM `db_users_a` ORDER BY referals DESC LIMIT 20 ");
	while($data = $db->FetchArray()){
	?>
	  <tr class="text-center">
<th><?=$data["user"]; ?></th>
		<td><?=$data["referals"]; ?> чел.</td>
	</tr>
	<?PHP
	}
?>
 </table>
                                        </div>
                            </div>
                        </div>
						
                                        </div>
                            </div>
                        </div>
                        <!-- Single Sidebar End -->
                    </div>
                </div>
                <!-- Sidebar Area End -->


            </div>
        </div>
    </section>
    <!--== FAQ Area End ==-->