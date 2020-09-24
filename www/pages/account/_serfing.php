<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

define('TIME', time());

$db->Query("SELECT * FROM db_users_a WHERE id = '".$_SESSION['user_id']."'");
$users_info = $db->FetchArray();

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

if (isset($_GET['delete']))
{
  $id = (int)$_GET['delete'];
  
  if (isset($_SESSION['admin']))
  {
    $db->query("SELECT money, user_name FROM db_serfing WHERE id = '".$id."' LIMIT 1");
 
    $result = $db->FetchArray();
  
    $db->query("UPDATE db_users_b SET money_b = money_b + '".$result['money']."' WHERE user = '".$result['user_name']."'");
  
    $db->query("DELETE FROM db_serfing WHERE id = '".$id."'");
    $db->query("DELETE FROM db_serfing_view WHERE ident = '".$id."'");
  }  
} 
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

jQuery(document).ready(function(){
    $(".normalm").click(function(e){
        var oLeft = 0, oTop = 0;
        element = this;
        if (element.className == 'normalm') {
            do {
                oLeft += element.offsetLeft;
                oTop  += element.offsetTop;
            } while (element = element.offsetParent);
            var sx = e.pageX - oLeft;
            var sy = e.pageY - oTop;
            var elid = $(this).attr("id");
            fixed(elid, sx, sy);
        }
    }); 
})                

function goserf(obj)
{
    obj.parentNode.innerHTML = "<span class='textgreen'>Спасибо за визит</span>";
    return false;
}

function fixed(p1, p2, p3)
{
    var myReq = getHTTPRequest();
    var params = "p1="+p1+"&p2="+p2+"&p3="+p3;
    function setstate()
    {
        if ((myReq.readyState == 4)&&(myReq.status == 200)) {
            var resvalue = myReq.responseText;
            if (resvalue != '') {
                if (resvalue.length > 12) {
                    if (elem = document.getElementById(p1)) {
                        elem.style.backgroundImage = 'none';
                        elem.className = 'goadvsite';
                        elem.innerHTML = '<div><a target="_blank" href="/'+resvalue+'" onclick="javascript:goserf(this);">Просмотреть сайт рекламодателя</a></div>';
                    }
                } else {
                    if (elem = document.getElementById(resvalue)) {
                        $(elem).fadeOut('low', function() {
                            elem.innerHTML = "<td colspan='3'></td>";
                        });
                    }
                }
            }
        }
    }
    myReq.open("POST", "/ajax/us-fixedserf.php", true);
    myReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myReq.setRequestHeader("Content-lenght", params.length);
    myReq.setRequestHeader("Connection", "close");
    myReq.onreadystatechange = setstate;
    myReq.send(params);
    return false;
}
</script> 


<div class="col-sm-12 col-lg-6">
	<blockquote>
        <h2 style="margin-top: 2%;">Просмотр сайтов</h2>
        </blockquote>
</div>

        </div>
<style>
.surfblock3 {
   background: #ffe5c3;
   border: 1px solid #f1cdbc;
   text-shadow: 1px 1px 1px #fff9ed;
}
.surfblock2 {
   background: #d9f9dd;
   border: 1px solid #b0e2b6;
   text-shadow: 1px 1px 1px #f2ffed;
}
.surfblock1 {
   cbackground: #d9edf7;
   text-shadow: 1px 1px 1px #edfffd;
}
.surflinkgoto {
   color: #000;
   letter-spacing: 1px;
}
.surflinkgoto:hover{
   color: #6d0808;
}

.surftimer {
   font-size: 14px;
   color: #a94442;
   margin-left: 36px;
}

.surfprice {
   font-size: 14px;
   color: #0e6910;
   margin-left: 10px;
}

.surfviewleft {
   font-size: 14px;
   float: right;
   color: #000;
   text-shadow: 1px 1px 1px #fff;
}
</style>


            <div class="container-fluid">
                <div class="row cm-fix-height">
                    <div class="col-sm-12">
					
 
					<?php
$db->query("SELECT ident, time_add FROM db_serfing_view WHERE user_id = '".$_SESSION['user_id']."' and time_add + INTERVAL 24*60*60 SECOND > NOW()");
 
  while ($row_view = $db->FetchAssoc())
  {
    $visits[$row_view['ident']] = $row_view;    
  }
  
  $db->Query("SELECT * FROM db_serfing WHERE money >= price and status = '2' ORDER BY high DESC, time_add DESC");
  
  if ($db->NumRows())
  {  
    while ($row = $db->FetchAssoc())
    {
      if (isset($visits[$row['id']])) continue;
     
      if ($row['speed'] > 1) 
      {             
        if (mt_rand(1, $row['speed']) != 1) continue;
      } 
      
      $high = ($row['high']) ? 'panel panel-default surfblock3' : 'panel panel-default surfblock1';
      $pay_user = number_format($row['price'] - $row['price'] * (10/100), 2); //оплата пользователю 
      
      if ($row['country']) 
      {	
	      $country = explode('|', $row['country']);
        
	      if ($row['crev'])
	      {  
	        if (in_array($_SESSION['country'], $country)) continue; //показывать всем кроме указаных
	      }
	      else
	      {
	        if (!in_array($_SESSION['country'], $country)) continue; //показывать только указаным
	      }  
      }	
      
      if ($row['rating'])
      {
        if ($row['rating'] == 1 && $users_info['insert_sum'] > 10)
        {
          continue;
        } 
        
        if ($row['rating'] == 2 && ($users_info['insert_sum'] < 10 && $users_info['insert_sum'] > 100))
        {
          continue;
        } 
        
        if ($row['rating'] == 3 && ($users_info['insert_sum'] < 100 && $users_info['insert_sum'] > 500))
        {
          continue;
        } 
        
        if ($row['rating'] == 4 && ($users_info['insert_sum'] < 500 && $users_info['insert_sum'] > 1000))
        {
          continue;
        }
        
        if ($row['rating'] == 5 && $users_info['insert_sum'] < 1000)
        {
          continue;
        } 
      } 
      ?>
	  
	  
	  
	  
	    <div class="<?php echo $high; ?>">
          <div class="panel-body">
              <img src="https://www.google.com/s2/favicons?domain=<?php echo $row['url']; ?>">
              <form action="/account/serfing/view/<?php echo $row['id']; ?>" method="POST"  target="_blank" style="display: inline-block;">
                <input type="hidden" class="<?php echo $high; ?>" id="tr<?php echo $row['id']; ?>" name="_tocken" value="d6c9b93d60d54b7a3da2782ac">
                <button type="submit" onclick="javascript: this.style.textDecoration='line-through'; this.style.color='#FF3800';" class="btn-link">«<?php echo $row['title']; ?>»</button>
              </form>
                    <h6>
                      <span class="surftimer">Время просмотра: <?php echo $row['timer']; ?></span>
                      <span class="surfprice">Оплата: <?php echo $row['price']; ?> руб.</span>
                      <span class="surfviewleft">[<?php echo (int)($row['money']/$row['price']); ?>] Осталось просмотров</span>
                    </h6>
            </div>
          </div>
      <?php
    }
  }
  else
  {
    
  } 
  ?>
		   
		   
		   
            </div>
          </div>
                          </div>


                </div>
            </div>
			
