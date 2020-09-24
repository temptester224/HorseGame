<?PHP
$_OPTIMIZATION["title"] = "Контакты";
$_OPTIMIZATION["description"] = "Связь с администрацией";
$_OPTIMIZATION["keywords"] = "Связь с администрацией проекта";

if(isset($_POST['contact'])){
	$name = $_POST['name'];
	$email = $func->IsMail($_POST['email']);
	$text = $_POST['text'];
	if ($name !== false && $subject !== false && $email !== false && $text !== false) {
	
	$to = $email;
	$from = "support@mr-farmer.com";
	$subject = $_POST['subject'];
	$subject = "=?windows-1251?B?".base64_encode($_POST['subject'])."?=";
	$headers = "From: $from\r\nReply-To: $to\r\nContent-type: text/plain; charset=windows-1251\r\n";
	mail($from, $subject, $text, $headers);
	
	$mess[] = "<div class='ok'>Ваше сообщение успешно отправлено!</div>";
	} else $mess[] = "<div class='err'>Заполнены не все поля или заполнены не верно!</div>";
}
?>




 <!--== Page Title Area Start ==-->
    <section id="page-title-area" class="section-padding overlay">
        <div class="container">
            <div class="row">
                <!-- Page Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Контакты</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>Перед обращением, укажите ID, смотрите в личном кабинете.</p>
                    </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->

    <!--== Pricing Area Start ==-->
    <section id="pricing-page-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="col-lg-12">
                    <div class="sidebar-content-wrap m-t-50">
                        <!-- Single Sidebar Start -->
                        <div class="single-sidebar">
                            <h3>Наш адрес почты</h3>

                            <div class="sidebar-body">
                                <p><i class="fa fa-comments fa-lg fa-fw"></i> support@demo.com</p>
                            </div>
                        </div>
                        <!-- Single Sidebar End -->

                        <!-- Single Sidebar Start -->
                        <div class="single-sidebar">
                            <h3>Социальные сети</h3>

                            <div class="sidebar-body">
                                <div class="social-icons text-center">
                                    <a href="https://vk.com/" target="_blank"><i class="fa fa-vk"></i></a>
                                    <a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube"></i></a>
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