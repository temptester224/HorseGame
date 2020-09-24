<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
 * Серфинг для фермы
 * Версия: 1.00
 * SKYPE: sereega393
 * Использование без оплаты ЗАПРЕЩЕНО!!!
*/
define('TIME', time());

define('SERF_PRICE', 5); //минимальная стоимость просмотра
define('SERF_PRICE_TIMER', 0.2); //стоимость таймера
define('SERF_PRICE_MOVE', 0.8); //стоимость последующего перехода на сайт
define('SERF_PRICE_HIGH', 0.5); //стоимость выделения ссылки
define('SERF_PRICE_TARGET', 1.2); //стоимость таргетинга


header("Content-Type: text/html; charset=windows-1251");
$msg = '';

$db->Query("SELECT * FROM db_users_b WHERE id = '".$_SESSION['user_id']."'");
$users_info = $db->FetchAssoc();
?>
<link rel="stylesheet" href="/style/main.css" type="text/css" />
<?php

//Данные для формы (по умолчанию)
$title = '';
$url = 'http://';
$timer = 20;
$move = 0;
$high = 0;
$speed = 1;
$rating = 0;
$crev = 0;
    
$country1 = 'xx';
$country2 = 'xx';
$country3 = 'xx';
$country4 = 'xx';
$country5 = 'xx';

$advedit = isset($_GET['advedit']) ? (int)$_GET['advedit'] : 0; 

$user_name = $_SESSION['user'];

if (!$advedit && isset($_POST['ask_editcode'])) { $advedit = (int)$_POST['ask_editcode']; }

//print_r($_GET);

if ($advedit)
{  
  if (isset($_SESSION['admin'])) 
  {
    $db->query("SELECT * FROM  db_serfing WHERE id = '".$advedit."' LIMIT 1");
  } 
  else
  { 
    $db->query("SELECT * FROM  db_serfing WHERE id = '".$advedit."' and user_name = '".$user_name."' LIMIT 1");
  }
    
  if ($db->NumRows())
  {
    $result = $db->FetchAssoc();    
    
    //Подставляем данные из БД для формы редактирования
    $title = $result['title'] ? $result['title'] : '';
    $url = $result['url'] ? $result['url'] : '';   
    $timer = $result['timer'] ? $result['timer'] : 20;
    $move = $result['move'] ? $result['move'] : 0;
    $high = $result['high'] ? $result['high'] : 0;
    $speed = $result['speed'] ? $result['speed'] : 1;
    $rating = $result['rating'] ? $result['rating'] : 0;
    $crev = $result['crev'] ? $result['crev'] : 0;
    $status = $result['status'];
    
    $country = explode('|', $result['country']);
    
    $country1 = isset($country['0']) && $country['0'] ? $country['0'] : 'xx';
    $country2 = isset($country['1']) && $country['1'] ? $country['1'] : 'xx';
    $country3 = isset($country['2']) && $country['2'] ? $country['2'] : 'xx';
    $country4 = isset($country['3']) && $country['3'] ? $country['3'] : 'xx';
    $country5 = isset($country['4']) && $country['4'] ? $country['4'] : 'xx';
  } 
  else 
  {
    exit();
  }
} 

if (isset($_POST['ask_title']))
{
  //Заголовок ссылки
  $title = filter_var(mb_substr(trim($_POST['ask_title']), 0, 55), FILTER_SANITIZE_STRING);
  
  
  //URL сайта
  $url = isset($_POST['ask_url']) ? trim($_POST['ask_url']) : ''; 
  if (!filter_var($url, FILTER_VALIDATE_URL)) { echo '<span class="msgbox-error">Неверный адрес сайта</span>'; return; }
  
  //Время просмотра ссылки
  $timer = isset($_POST['ask_timer']) ? (int)$_POST['ask_timer'] : 20;
  $timer_arr = array('20' => 20, '30' => 30, '40' => 40, '50' => 50, '60' => 60);
  if (!isset($timer_arr[$timer])) { echo '<span class="msgbox-error">Ошибка данных</span>'; return; }
  
  //Последующий переход на сайт
  $move = isset($_POST['ask_move']) ? (int)$_POST['ask_move'] : 0;
  if ($move > 1 || $move < 0) { echo '<span class="msgbox-error">Ошибка данных</span>'; return; }
  
  //Выделить ссылку
  $high = isset($_POST['ask_high']) ? (int)$_POST['ask_high'] : 0;
  if ($high > 1 || $high < 0) { echo '<span class="msgbox-error">Ошибка данных</span>'; return; }
  
  
  
  //$kolvo = (int)$_POST['ask_kolvo'];
  
  //Доступность по странам
  $country1 = isset($_POST['ask_country1']) ? filter_var(mb_substr($_POST['ask_country1'], 0, 2), FILTER_SANITIZE_STRING) : 'xx';
  $country2 = isset($_POST['ask_country2']) ? filter_var(mb_substr($_POST['ask_country2'], 0, 2), FILTER_SANITIZE_STRING) : 'xx';
  $country3 = isset($_POST['ask_country3']) ? filter_var(mb_substr($_POST['ask_country3'], 0, 2), FILTER_SANITIZE_STRING) : 'xx';
  $country4 = isset($_POST['ask_country4']) ? filter_var(mb_substr($_POST['ask_country4'], 0, 2), FILTER_SANITIZE_STRING) : 'xx';
  $country5 = isset($_POST['ask_country5']) ? filter_var(mb_substr($_POST['ask_country5'], 0, 2), FILTER_SANITIZE_STRING) : 'xx';
  
  $country = '';
  
  $crev = isset($_POST['ask_crev']) ? (int)$_POST['ask_crev'] : 0;
  
  if ($crev > 1 || $crev < 0) { echo '<span class="msgbox-error">Ошибка данных</span>'; return; }
  
  if ($country1 != 'xx' || $country2 != 'xx' || $country3 != 'xx' || $country4 != 'xx' || $country5 != 'xx') 
  { 
    $country = $country1.'|'.$country2.'|'.$country3.'|'.$country4.'|'.$country5; 
  }
  
  //Если не заполнены основные поля
  if ($title == '' || $url == '') { echo '<span class="msgbox-error">Заполнены не все поля</span>'; return; }
  
  //Расчёт стоимости просмотра
  $price = SERF_PRICE;
  $price=$price / 100;    
  
  if ($move == 1) {$price += SERF_PRICE_MOVE; }
  
  if ($high == 1) { $price += SERF_PRICE_HIGH; }
  
  if ($timer == 30) { $price += SERF_PRICE_TIMER; } 
  else if ($timer == 40) { $price += (SERF_PRICE_TIMER * 2); } 
  else if ($timer == 50) { $price += (SERF_PRICE_TIMER * 3); } 
  else if ($timer == 60) { $price += (SERF_PRICE_TIMER * 4); }
  
  if (($rating > 0)|($country1 != 'xx')|($country2 != 'xx')|($country3 != 'xx')|
        ($country4 != 'xx')|($country5 != 'xx')) {
        $price += SERF_PRICE_TARGET;
    }
   
   
  $price = number_format($price, 2, '.', '');
  
  if ($advedit) 
  {  
    if (!isset($_SESSION['admin']))
    {
      if ($result['title'] != $title || $result['url'] != $url)
      {
        $status = 0;      
      }
    }  
   
    $db->query("UPDATE db_serfing SET `title` = '".$title."', `url` = '".$url."', `timer` = '".$timer."', `move` = '".$move."', `high` = '".$high."', `speed` = '".$speed."', `country` = '".$country."', `rating` = '".$rating."', `crev` = '".$crev."', `price` = '".$price."', `status` = '".$status."' WHERE id = '".$advedit."'");
    
    if (isset($_SESSION['admin'])) 
    {
      header('Location: /account/serfing/moder'); 
    } 
    else
    {
      header('Location: /account/serfing/add'); 
    }
    
    exit();
  }
  else
  { 
    if (isset($_SESSION['admin']))
    {
      $status = '3';
    }
    else
    {
      $status = '0';
    }
   
    $db->query("INSERT INTO db_serfing
        (
	  `user_name`,
	  `time_add`,	    
    `title`,
    `url`,         
    `timer`,
    `move`,
	  `high`,
	  `speed`,	  
	  `country`,
    `rating`,
	  `crev`,
	  `price`,
    `status`
    
        )
        VALUES
        (
          '".$_SESSION['user']."',
	  '".TIME."',
	  '".$title."',
	  '".$url."', 
	  '".$timer."',
	  '".$move."', 
	  '".$high."',
	  '".$speed."',	  
	  '".$country."',
    '".$rating."', 
	  '".$crev."',
	  '".$price."',
    '".$status."' 
    
        )");
  
    //echo '<span class="msgbox-success">Ссылка добавлена</span>';
  
    header('Location: /account/serfing/add'); exit();
  }  
} 

//end:

?>
<script>
 function SbmForm() {
    if (document.forms['surforder'].ask_title.value == '') {
        alert('Вы не указали заголовок ссылки');
        document.forms['surforder'].ask_title.focus();
        return false;
    }
    if ((document.forms['surforder'].ask_url.value == '')|(document.forms['surforder'].ask_url.value == 'http://')) {
        alert('Вы не указали URL-адрес ссылки');
        document.forms['surforder'].ask_url.focus();
        return false;
    }
    
    document.forms['surforder'].submit();
    return true;
}
 
 function PlanChange(frm)
{
   
 
    lprice = serf_price;
    if (frm.ask_move.value == 1) {
        lprice += serf_price_move;
    }
    if (frm.ask_high.value == 1) {
        lprice += serf_price_high;
    }
    if (frm.ask_timer.value == 30) {
        lprice += serf_price_timer;
    } else
    if (frm.ask_timer.value == 40) {
        lprice += (serf_price_timer * 2);
    } else
    if (frm.ask_timer.value == 50) {
        lprice += (serf_price_timer * 3);
    } else
    if (frm.ask_timer.value == 60) {
        lprice += (serf_price_timer * 4);
    } 
        lprice += serf_price_target;
    }
    frm.linkprice.value = number_format(lprice, 2, '.', '');
    
    //money = lprice * $('input[name=ask_kolvo]').val();
    
    //frm.money.value = number_format(money, 2, '.', '');
}

function number_format(number, decimals, dec_point, thousands_sep) {
    var i, j, kw, kd, km;
    if (isNaN(decimals = Math.abs(decimals))) {
        decimals = 2;
    }
    if (dec_point == undefined) {
        dec_point = ",";
    }
    if (thousands_sep == undefined) {
        thousands_sep = ".";
    }
    i = parseInt(number = (+number || 0).toFixed(decimals)) + "";
    if ((j = i.length) > 3) {
        j = j % 3;
    } else {
        j = 0;
    }
    km = (j ? i.substr(0, j) + thousands_sep : "");
    kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
    kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");
    return km + kw + kd;
}
 
 function showhide(bid) {
    if (document.getElementById('cattitle'+bid).className == 'cattitle-open')
        document.getElementById('cattitle'+bid).className = 'cattitle-close'; else
        document.getElementById('cattitle'+bid).className = 'cattitle-open';
    $('#catblock'+bid).slideToggle('fast');
}


            var serf_price = <?php echo SERF_PRICE; ?>;
            var serf_price_timer = <?php echo SERF_PRICE_TIMER; ?>;
            var serf_price_move = <?php echo SERF_PRICE_MOVE; ?>;
            var serf_price_high = <?php echo SERF_PRICE_HIGH; ?>;
            var serf_price_target = <?php echo SERF_PRICE_TARGET; ?>;
            function ClearForm()
            {
                document.forms['surforder'].ask_timer.value = <?php echo $timer; ?>;
                document.forms['surforder'].ask_move.value = <?php echo $move; ?>;
                document.forms['surforder'].ask_high.value = <?php echo $high; ?>;
                document.forms['surforder'].ask_country1.value = '<?php echo $country1; ?>';
                document.forms['surforder'].ask_country2.value = '<?php echo $country2; ?>';
                document.forms['surforder'].ask_country3.value = '<?php echo $country3; ?>';
                document.forms['surforder'].ask_country4.value = '<?php echo $country4; ?>';
                document.forms['surforder'].ask_country5.value = '<?php echo $country5; ?>';
                document.forms['surforder'].ask_crev.value = '<?php echo $crev; ?>';
                PlanChange(document.forms['surforder']);
            }
            
            $(document).ready(function() { ClearForm(); });
        
</script> 




<div class="col-sm-12 col-lg-6">
	<blockquote>
        <h2 style="margin-top: 2%;">Мои площадки</h2>
        </blockquote>
</div>

        </div>
<style>
.surftimer {
   font-size: 14px;
   color: #a94442;
   margin-left: 1px;
}

.surfprice {
   font-size: 14px;
   color: #0e6910;
}

.surfviewleft {
   font-size: 14px;
   float: right;
   color: #000;
   text-shadow: 1px 1px 1px #fff;
}
</style>

            <div class="container-fluid">
                <div class="row">
<section id="normalsec"></section><section id="content-1">
          
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-body text-center">
            <h3 class="m-t-0 m-b-10"> <b>Тариф "Эконом"</b></h3>
            <hr>
            <h5 class="m-b-0 m-t-15">Цена за 1000 просмотров: 40 руб.</h5>
          </div>
        </div>
      </div>

          
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-body text-center">
            <h3 class="m-t-0 m-b-10"> <b>Тариф "Обычный"</b></h3>
            <hr>
            <h5 class="m-b-0 m-t-15">Цена за 1000 просмотров: 60 руб.</h5>
          </div>
        </div>
      </div>

          
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-body text-center">
            <h3 class="m-t-0 m-b-10"> <b>Тариф "Премиум"</b></h3>
            <hr>
            <h5 class="m-b-0 m-t-15">Цена за 1000 просмотров: 80 руб.</h5>
          </div>
        </div>
      </div>

    
    </div>
    <div class="row">
      <div class="col-lg-4">
        <div class="panel panel-default">
          <div class="panel-heading"><h3 class="panel-title">Добавление сайта</h3></div>
          <div class="panel-body">
		 <div id="entermsg"> <?php if (!empty($msg)) { echo $msg; } ?></div>
            <form name="surforder" action="/account/serfing/add" onsubmit="return SbmForm(); return false;" method="POST">
              <input type="hidden" name="ask_editcode" value="<?php echo $advedit; ?>">
              <div class="form-group">
                <label>Заголовок рекламного блока:</label>
                <div><input name="ask_title" type="text" maxlength="55" class="form-control" placeholder="Например: Отличный сайт, смотреть всем!" value="<?php echo $title; ?>" required="" /></div>
              </div>
			  

              <div class="form-group">
                <label>URL сайта:</label>
                <div><input name="ask_url" type="url" class="form-control" placeholder="Например: https://site.biz" value="<?php echo $url; ?>" required="" /></div>
              </div>
              <div class="form-group">
                <label>Выберите тариф показа:</label>
                <select name="ask_timer" onChange="PlanChange(this.form); return false;" class="form-control">

                
                  <option value="20">Тариф "Эконом"</option>

                
                  <option value="40">Тариф "Обычный" + <?php echo SERF_PRICE_TIMER*2; ?> руб.</option>

                
                  <option value="60">Тариф "Премиум" + <?php echo SERF_PRICE_TIMER*4; ?> руб.</option>

                
                </select>
				 <label>Выделить ссылку</label>
				<select class="form-control" name="ask_high" onChange="PlanChange(this.form); return false;">
        <option value="0">Нет</option>
        <option value="1">Да&nbsp;&nbsp;(+ <?php echo SERF_PRICE_HIGH; ?> руб.)</option>
       </select>
	    <label>Последующий переход на сайт:</label>
	   <select class="form-control" name="ask_move" onChange="PlanChange(this.form); return false;">
        <option value="0">Нет</option>
        <option value="1">Да&nbsp;&nbsp;(+ <?php echo SERF_PRICE_MOVE; ?> руб.)</option>
       </select>
              </div>
	<blockquote>
             <a href="#" data-toggle="modal" data-target="#add_rules">Правила</a> 
        </blockquote>
		

		
                <button type="submit" name="add" class="btn btn-block btn-primary" onclick="SbmForm();"> Добавить сайт в серфинг</button>
				
				
            </form>
          </div>
        </div>
      </div>

	  

	  
	  <?php
/*
 * Серфинг для фермы
 * Версия: 1.00
 * SKYPE: sereega393
 * Использование без оплаты ЗАПРЕЩЕНО!!!
*/
$msg = '';
$_SESSION['cnt'] = md5($_SESSION['user_id'].session_id());

$db->Query("SELECT * FROM db_users_b WHERE id = '".$_SESSION['user_id']."'");
$users_info = $db->FetchAssoc();

?>
<script>
function getHTTPRequest()
{
    var req = false;
    try {
        req = new XMLHttpRequest();
    } catch(err) {
        try {
            req = new ActiveXObject("MsXML2.XMLHTTP");
        } catch(err) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(err) {
                req = false;
            }
        }
    }
    return req;
}

 var  defsummin = 1;
            function advevent(badv, buse) 
            {
                var postc = '<?php echo $_SESSION['cnt']; ?>';
                var issend = true;
                if (buse == 3) issend = confirm("Обнулить счётчик просмотров ссылки №" + badv + "?");
                if (buse == 4) issend = confirm("Вы уверены что хотите удалить ссылку №" + badv + "?");
                if (issend)
                    senddata(badv, buse, postc, 1);
                return true;
            }
         
 
 function senddata(radv, ruse, rpostc, rmode)
{
    var myReq = getHTTPRequest();
    var params = "use="+ruse+"&mode="+rmode+"&adv="+radv+"&cnt="+rpostc;
    function setstate()
    {
        if ((myReq.readyState == 4)&&(myReq.status == 200)) {
            var resvalue = parseInt(myReq.responseText);
            if (resvalue > 0) {
                if (ruse == 1) {
                    document.getElementById("advimg"+radv).innerHTML = "<span class='serfcontrol-pause' title='Остановить показ рекламной площадки' onclick='javascript:advevent(" + radv + ",2);'></span>";
                } else
                if (ruse == 2) {
                    document.getElementById("advimg"+radv).innerHTML = "<span class='serfcontrol-play' title='Запустить показ рекламной площадки' onclick='javascript:advevent(" + radv + ",1);'></span>";
                } else
                if (ruse == 3) {
                    document.getElementById("erase"+radv).innerHTML = "0";
                } else
                if (ruse == 4) {
                    $('#adv'+radv).fadeOut('def');
                } else
                if (ruse == 5) {
                    if ((resvalue > 0)&&(resvalue < 8))
                        document.getElementById("int"+radv).className = 'scon-speed-'+resvalue;
                } else
                if (ruse == 6) {
                    document.getElementById("status"+radv).innerHTML = "<span class='desctext' style='text-decoration: blink;'>Ожидает<br />проверки</span>";
                    document.getElementById("advimg"+radv).innerHTML = "<span class='serfcontrol-postmoder'></span>";
                } else
                if (ruse == 7) {
                    window.location.reload(true);
                }
            }
        }
    }
    myReq.open("POST", "/ajax/us-advservice.php", true);
    myReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myReq.setRequestHeader("Content-lenght", params.length);
    myReq.setRequestHeader("Connection", "close");
    myReq.onreadystatechange = setstate;
    myReq.send(params);
    return false;
}

function submitform(formnum)
{
    if (document.forms['payform'+formnum].pay_order) {
        var field = document.forms['payform'+formnum].pay_order.value;
        var minsum = $('#minsum'+formnum).text();      
        var tm;
        function hidemsg()
        {
            $('#entermsg'+formnum).fadeOut('slow');
            if (tm)
                clearTimeout(tm);
        }
        field = field.replace(",", ".");
        if (field == '') {
            document.getElementById('entermsg'+formnum).innerHTML = "<span class='msgbox-error'>Введите необходимую сумму</span>";
            document.getElementById('entermsg'+formnum).style.display = '';
            tm = setTimeout(function() {
                hidemsg()
            }, 1000);
            return false;
        }
        rprice = parseFloat(field);
        if (isNaN(rprice)) {
            document.getElementById('entermsg'+formnum).innerHTML = "<span class='msgbox-error'>Значение должно быть числовым</span>";
            document.getElementById('entermsg'+formnum).style.display = '';
            tm = setTimeout(function() {
                hidemsg()
            }, 1000);
            return false;
        }
        if (rprice != field) {
            document.getElementById('entermsg'+formnum).innerHTML = "<span class='msgbox-error'>Значение должно быть числовым</span>";
            document.getElementById('entermsg'+formnum).style.display = '';
            tm = setTimeout(function() {
                hidemsg()
            }, 1000);
            return false;
        }
        if (rprice < minsum) {
            document.getElementById('entermsg'+formnum).innerHTML = "<span class='msgbox-error'>Сумма должна быть не менее "+minsum+" руб</span>";
            document.getElementById('entermsg'+formnum).style.display = '';
            tm = setTimeout(function() {
                hidemsg()
            }, 1000);
            return false;
        }
        var rnote = document.forms['payform'+formnum].pay_adv.value;
        var rart = document.forms['payform'+formnum].pay_mode.value;
        var rcnt = document.forms['payform'+formnum].pay_cnt.value;
        senddatacart(rnote, rart, rprice, rcnt);
        return true;
    }
    return false;
}

function senddatacart(rnote, rart, rprice, rcnt)
{
    var myReq = getHTTPRequest();
    var params = "adv="+rnote+"&use="+rart+"&price="+rprice+"&cnt="+rcnt;
    function setstate()
    {
        if ((myReq.readyState == 4)&&(myReq.status == 200)) {
            var resvalue = myReq.responseText;
            if (resvalue != '') {
                if (resvalue > 0) {                   
                    document.getElementById("entermsg"+rnote).innerHTML = "<center>Оплачено</center>";
                    window.location.reload(true);
                } else
                    document.getElementById("entermsg"+rnote).innerHTML = "<span class='msgbox-error'>"+resvalue+"</span>";
            } else {
                document.getElementById("entermsg"+rnote).innerHTML = "<span class='msgbox-error'>Не удалось обработать запрос</span>";
            }
        } else {
            document.getElementById("entermsg"+rnote).innerHTML = "<span class='loading' title='Подождите пожалуйста...'></span>";
            document.getElementById("entermsg"+rnote).style.display = '';
        }
    }
    myReq.open("POST", "/ajax/us-advservice.php", true);
    myReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myReq.setRequestHeader("Content-lenght", params.length);
    myReq.setRequestHeader("Connection", "close");
    myReq.onreadystatechange = setstate;
    myReq.send(params);
    return false;
}

function hideserfaddblock(bname) {
    if (document.getElementById(bname).style.display == 'none')
        document.getElementById(bname).style.display = '';
    else
        document.getElementById(bname).style.display = 'none';
    return false;
}
function alertbudget()
{
    alert("Пополните рекламный бюджет");
    return false;
}
function alertnochange()
{
    alert("Задание можно редактировать только раз в 3 часа");
    return false;
}

function reportformactivate(dnum, dmode) {
    if (dmode == 2)
        document.getElementById('delcomment'+dnum).style.display = '';
    else
    if (dmode == 3)
        document.getElementById('reversecomment'+dnum).style.display = '';
    document.getElementById('btns'+dnum).style.display = 'none';
    return false;
    }
</script> 
	  
	  
	  
      <div class="col-lg-8">
        <div class="panel panel-default">
          <div class="panel-heading">
           <h3 class="panel-title">Мои сайты в сёрфинге</h3></div>
          <div class="panel-body">

          
            <div class="content">

    <table class="acc-summary-table black_table" width="100%" style="text-align:center">
 <?php
 $db->Query("SELECT * FROM db_serfing WHERE user_name = '".$_SESSION['user']."' ORDER BY time_add DESC");
  
 if ($db->NumRows())
 {  
   while ($row = $db->FetchAssoc())
   {
     ?>
     <table class="adv-serf">
      <tbody>
       <tr id="adv<?php echo $row['id']; ?>">
        <td>
         <div id="advimg<?php echo $row['id']; ?>">
          <?php   
          if ($row['status'] == 0)
          {
            ?><span class="serfcontrol-moder"></span><?php
          } 
          else if ($row['status'] == 1)
          {
            ?><span class="serfcontrol-postmoder"></span><?php
          }
          else if ($row['status'] == 2)
          {
            ?><span class="serfcontrol-pause" title="Остановить показ ссылки" onclick="javascript:advevent(<?php echo $row['id']; ?>,2);"></span><?php
          }
          else if ($row['status'] == 3)
          {
            if ($row['money'] >= $row['price'])
            {
              ?><span class="serfcontrol-play" title="Запустить показ ссылки" onclick="javascript:advevent(<?php echo $row['id']; ?>,1);"></span><?php
            }
            else
            {
              ?><span class="serfcontrol-play" title="Запустить показ ссылки" onclick="javascript:alertbudget();"></span><?php
            }           
          } 
          ?>
          
         </div>
        </td>
        <td width="80%">
         <a href="<?php echo $row['url']; ?>" target="_blank"><?php echo $row['title']; ?><br>
          <span class="desctext"><?php echo $row['desc']; ?></span></a><br>
         <span class="serfinfotext">№ <?php echo $row['id']; ?>&nbsp;&nbsp;Клик: <?php echo $row['price']; ?> руб.&nbsp;&nbsp;Просмотров: 
         <div style="display: inline;" id="erase<?php echo $row['id']; ?>"><?php echo $row['view']; ?></div>
         
         </span>
          <?php
          if ($row['money'] == 0)
          { 
            ?><span class="scon-delete" title="Удалить ссылку" onclick="javascript:advevent(<?php echo $row['id']; ?>,4);"></span><?php
          }
          ?>
          <span id="int<?php echo $row['id']; ?>" class="scon-speed-<?php echo $row['speed']; ?>" title="Изменить интервал показов" onclick="javascript:advevent(<?php echo $row['id']; ?>,5);"></span>
          <span class="scon-erase" title="Сброс статистики" onclick="javascript:advevent(<?php echo $row['id']; ?>,3);"></span>
        </td>
        <td class="budget">
         <?php
         if ($row['status'] == 0)
         {
           ?><div id="status<?php echo $row['id']; ?>"><span class="transport-moder" title="Отправить рекламу на проверку арбитрам" onclick="javascript:advevent(<?php echo $row['id']; ?>,6);">Отправить<br />на проверку</span></div><?php                                                                                   
         }
         else if ($row['status'] == 1)
         {
           ?><span class="desctext" style="text-decoration: blink">Ожидает<br />проверки</span><?php
         }        
         else
         {
           if ($row['money'] > 0)
           {
             ?><span class="add-budget" title="Пополнить рекламный бюджет" onclick="javascript:hideserfaddblock('serfadd<?php echo $row['id']; ?>');"><span style="font-size: 11px"><?php echo $row['money']; ?></span></span><?php
           }
           else
           { 
             ?><span class="add-budgetnone" title="Пополнить рекламный бюджет" onclick="javascript:hideserfaddblock('serfadd<?php echo $row['id']; ?>');"><span style="font-size: 11px">Пополнить</span></span><?php
           }
         }        
         ?>
         
        </td>      
       </tr>
       <tr id="serfadd<?php echo $row['id']; ?>" style="display: none">
        <td class="ext" colspan="3">
         <form name="payform<?php echo $row['id']; ?>" class="pay-form" onkeypress="if (event.keyCode == 13) return false;">
          <input name="pay_cnt" value="<?php echo $_SESSION['cnt']; ?>" type="hidden">
          <input name="pay_mode" value="12" type="hidden">
          <input name="pay_user" value="<?php echo $_SESSION['user_id']; ?>" type="hidden">
          <input name="pay_adv" value="<?php echo $row['id']; ?>" type="hidden">Укажите сумму, которую вы хотите внести в бюджет рекламной площадки<br>(Минимум <span id="minsum<?php echo $row['id']; ?>"><?php echo $row['price']; ?></span> рублей)<input name="pay_order" maxlength="10" value="<?php echo number_format($row['price']*1000, 2, '.', ''); ?>" type="text"><center><span class="button-red" title="Внести средства в бюджет площадки" onclick="javascript:submitform(<?php echo $row['id']; ?>);">Оплатить</span></center></form>
         <div id="entermsg<?php echo $row['id']; ?>" style="display: none"></div>
        </td>
       </tr>
      </tbody>
     </table>
 
     <?php
   }
 } 
 else
 {
   echo 'ссылок нет';
 }
 
 ?>

          
          </div>
        </div>
      </div>

    <!-- end row -->

    <!-- modal start -->
    <div id="add_rules" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
            <h4 class="modal-title">Правила размещения</h4>
          </div>
          <div class="modal-body">
            <h4>Запрещена реклама сайтов следующих категорий:</h4>
            <p>- Фишинг, вирусы, секс-шопы, знакомства "на одну ночь";</p>
            <p>- Сайты которые разрушают фрейм, сайты с редиректом;</p>
            <p>- Сайты содержащие порнографию, обилие эротических материалов;</p>
            <p>- Политические и религиозные ресурсы, любые виды насилия;</p>
            <p>- Ресурсы с элементами магии, спиритизма, оккультизма;</p>
            <p>- Ресурсы, с явно выраженным обманом;</p>
            <p>- Сайты набитые множеством партнёрок, всплывающих pop-up и т.д.</p>
            <p>- Ресурсы, требующие отправку платных СМС-сообщений</p>
            <hr>
            <h6>В случае нарушений, к аккаунту пользователя, могут быть применены штрафные санкции, вплоть до блокировки аккаунта, в зависимости от строгости нарушения.</h6>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-gray" data-dismiss="modal">Закрыть</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  
                </div>
            </div>
