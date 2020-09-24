<?PHP
$_OPTIMIZATION["title"] = "Новости";
$_OPTIMIZATION["description"] = "Новости проекта";
$_OPTIMIZATION["keywords"] = "Новости нашего проекта";
?>
<section id="normalsec" class=""></section><section id="content-2" class="none-line page-about-us"><div class="sec3-bg"></div><div class="row video-head"><div style="clear:both;"></div>
<?PHP

$db->Query("SELECT * FROM db_news ORDER BY id DESC");

if($db->NumRows() > 0){

	while($news = $db->FetchArray()){
	
	?>

      <div class="un-row"><div class="un-col-7" style="width:100%">               
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><h3><?=$news["title"]; ?></h3></td>
    <td align="right"><strong><?=date("d.m.Y",$news["date_add"]); ?></strong></td>
  </tr>

  <tr>
    <td colspan="2"><?=$news["news"]; ?></td>
  </tr>
</table> 
<BR />
	<?PHP
	
	}

}else echo "<center>
новостей нету (.</center>";

?>
<br>	<br>	<br>	<br>	<br>	<br>	<br>	<br>	<br>	<br>	<br>	
</div>
</div>
</div></div>	
