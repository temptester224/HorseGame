 <!--== slide Item One ==-->
        <div class="single-slide-item">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 text-left">
                        <div class="display-table">
                            <div class="display-table-cell">
                                <div class="slider-left-text">
								
								
									                                  <?php if(isset($_SESSION["user"])){?>
																	  <h1>                                    <a href="/account.html">������ ������</a>
                                                    </h1>
													<?php } else { ?>
																	  
																	  
                                    <h1>                                    <a href="/signup.html">�����������</a>
                                                    </h1>
													<?php } ?>
                                    <p>������� ���������, ������������� ����.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--== slide Item One ==-->

    <!--== About Us Area Start ==-->
    <section id="about-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>��������</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>��� ��� ��������, ������� �������� ��������</p>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="row">
                <!-- About Content Start -->
                <div class="col-lg-6">
                    <div class="display-table">
                        <div class="display-table-cell">
                            <div class="about-content">
                                <p>Super-Gonka � ��� ������� ���������, ������������� ����, � ������� �����������. ��������� ������ � ������������� �������� ������, ������ � ����, ���� ��, �� ����������� ��� ���������! ��������� ������������� ����������, ���� ������� ������ ��� �������� �����, ����� ��������� ��������!</p>
                                <div class="about-btn">
                                                                                        <a href="/signup.html"><i class="fa fa-user-plus"></i> �����������</a>
                                                                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- About Content End -->

                <!-- About Video Start -->
                <div class="col-lg-6">
                    <div class="about-video">
                        <iframe src="https://www.youtube.com/embed/KIZXKjjnFyY?rel=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                <!-- About Video End -->
            </div>
        </div>
    </section>
    <!--== About Us Area End ==-->

	
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
	
    <!--== Fun Fact Area Start ==-->
    <section id="funfact-area" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 m-auto">
                    <div class="funfact-content-wrap">
                        <div class="row">

                            <!-- Single FunFact Start -->
                            <div class="col-lg-6 col-md-12">
                                <div class="single-funfact">
                                    <div class="funfact-icon">
                                        <i class="fa fa-smile-o fa-fw"></i>
                                    </div>
                                    <div class="funfact-content">
                                        <p><span class="counter"><?=$stats_data["all_users"]; ?></span> +[<?=$stats_data["new_users"]; ?>]</p>
                                        <h4>����������</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Single FunFact End -->

                            <!-- Single FunFact Start -->
                            <div class="col-lg-6 col-md-12">
                                <div class="single-funfact">
                                    <div class="funfact-icon">
                                        <i class="fa fa-clock-o fa-fw"></i>
                                    </div>
                                    <div class="funfact-content">
                                        <p><span class="counter"><?=intval(((time() - $config->SYSTEM_START_TIME) / 86400 ) +1); ?></span> �/���</p>
                                        <h4>����� ������</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Single FunFact End -->

                            <!-- Single FunFact Start -->
                            <div class="col-lg-6 col-md-12">
                                <div class="single-funfact">
                                    <div class="funfact-icon">
                                        <i class="fa fa-bank fa-fw"></i>
                                    </div>
                                    <div class="funfact-content">
                                        <p><span class="counter"><?=sprintf("%.2f",$stats_data["all_insert"]); ?></span><i class="fa fa-rub fa-fw"></i></p>
                                        <h4>���������</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Single FunFact End -->

                            <!-- Single FunFact Start -->
                            <div class="col-lg-6 col-md-12">
                                <div class="single-funfact">
                                    <div class="funfact-icon">
                                        <i class="fa fa-car fa-fw"></i>
                                    </div>
                                    <div class="funfact-content">
                                        <p><span class="counter"><?=sprintf("%.2f",$stats_data["all_payment"]); ?></span><i class="fa fa-rub fa-fw"></i></p>
                                        <h4>���������</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Single FunFact End -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Fun Fact Area End ==-->

    <!--== Services Area Start ==-->
    <section id="service-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>������������</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>�������� �������� �������</p>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>

           
			<!-- Service Content Start -->
			<div class="row">
				<!-- Single Service Start -->
				<div class="col-lg-4 text-center">
					<div class="service-item">
						<i class="fa fa-car"></i>
						<h3>������</h3>
						<p>� ������� ���� 9 �����������, �� ����� ������������,  � ������ ���������� � ��������.</p>
					</div>
				</div>
				<!-- Single Service End -->
				
				<!-- Single Service Start -->
				<div class="col-lg-4 text-center">
					<div class="service-item">
						<i class="fa fa-dashboard"></i>
						<h3>���������</h3>
						<p>� ��� ����� �����, �� �������� ������ �����, ������ �������� � ����� � �������������.</p>
					</div>
				</div>
				<!-- Single Service End -->
				
				<!-- Single Service Start -->
				<div class="col-lg-4 text-center">
					<div class="service-item">
						<i class="fa fa-trophy"></i>
						<h3>��������</h3>
						<p>�� �������� �������� �� ����������, ������� � ������� ����� ������� ����� �������� �������.</p>
					</div>
				</div>
				<!-- Single Service End -->
				
				<!-- Single Service Start -->
				<div class="col-lg-4 text-center">
					<div class="service-item">
						<i class="fa fa-gears"></i>
						<h3>������</h3>
						<p>�� ���������� ����������� ���������� �������, ���� ������ ����� ������ ��������������.</p>
					</div>
				</div>
				<!-- Single Service End -->
				
				<!-- Single Service Start -->
				<div class="col-lg-4 text-center">
					<div class="service-item">
						<i class="fa fa-photo"></i>
						<h3>������</h3>
						<p>���������� ���������� ������, ������� ���������, ������� � ��� ������ ������������� ������.</p>
					</div>
				</div>
				<!-- Single Service End -->
				
				<!-- Single Service Start -->
				<div class="col-lg-4 text-center">
					<div class="service-item">
						<i class="fa fa-mobile"></i>
						<h3>���������</h3>
						<p>���� �������� � ������ ���������� ���������� � ����� ���������������� ��� ���� ���������� ������.</p>
					</div>
				</div>
				<!-- Single Service End -->
			</div>
			<!-- Service Content End -->
        </div>
    </section>
    <!--== Services Area End ==-->

     <!--== Partner Area Start ==-->
    <div id="partner-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="partner-content-wrap">
                        <!-- Single Partner Start -->
                        <div class="single-partner">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    <img src="/assets/img/partner/partner-logo-1.png" alt="Super-Gonka">
                                </div>
                            </div>
                        </div>
                        <!-- Single Partner End -->

                        <!-- Single Partner Start -->
                        <div class="single-partner">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    <img src="/assets/img/partner/partner-logo-2.png" alt="Super-Gonka">
                                </div>
                            </div>
                        </div>
                        <!-- Single Partner End -->

                        <!-- Single Partner Start -->
                        <div class="single-partner">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    <img src="/assets/img/partner/partner-logo-3.png" alt="Super-Gonka">
                                </div>
                            </div>
                        </div>
                        <!-- Single Partner End -->

                        <!-- Single Partner Start -->
                        <div class="single-partner">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    <img src="/assets/img/partner/partner-logo-4.png" alt="Super-Gonka">
                                </div>
                            </div>
                        </div>
                        <!-- Single Partner End -->

                        <!-- Single Partner Start -->
                        <div class="single-partner">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    <img src="/assets/img/partner/partner-logo-5.png" alt="Super-Gonka">
                                </div>
                            </div>
                        </div>
                        <!-- Single Partner End -->

                        <!-- Single Partner Start -->
                        <div class="single-partner">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    <img src="/assets/img/partner/partner-logo-1.png" alt="Super-Gonka">
                                </div>
                            </div>
                        </div>
                        <!-- Single Partner End -->

                        <!-- Single Partner Start -->
                        <div class="single-partner">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    <img src="/assets/img/partner/partner-logo-4.png" alt="Super-Gonka">
                                </div>
                            </div>
                        </div>
                        <!-- Single Partner End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== Partner Area End ==-->

    <!--== What We Do Area Start ==-->
    <section id="what-do-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>�������������</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>������� ����� ������� Super-Gonka</p>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="row">
                <!-- Single We Do Start -->
                <div class="col-lg-4 col-md-4">
                    <div class="single-we-do we-do-bg-1">
                        <div class="we-do-content">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    <h3>�������</h3>
                                    <p>������� ����� Super-Gonka, �� ���� ���������! ��� ����������� ����������.</p>
                                    <a href="/about.html">���������</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single We Do End -->

                <!-- Single We Do Start -->
                <div class="col-lg-4 col-md-4">
                    <div class="single-we-do we-do-bg-2">
                        <div class="we-do-content">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    <h3>�����</h3>
                                    <p>��� �� �����, ����� ������������ ������, �����, ������ ���� �� �����������!</p>
                                    <a href="/about.html">���������</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single We Do End -->

                <!-- Single We Do Start -->
                <div class="col-lg-4 col-md-4">
                    <div class="single-we-do we-do-bg-3">
                        <div class="we-do-content">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    <h3>������������</h3>
                                    <p>���������� �������. ������������ � ���������� ������� ��������������.</p>
                                    <a href="/about.html">���������</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single We Do End -->
            </div>
        </div>
    </section>
    <!--== What We Do Area End ==-->