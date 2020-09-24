<?PHP
$_OPTIMIZATION["title"] = "������� ���������";
$_OPTIMIZATION["description"] = "������� ���������";
$_OPTIMIZATION["keywords"] = "�������, ������� ���������";
?>


<!--== Page Title Area Start ==-->
    <section id="page-title-area" class="section-padding overlay">
        <div class="container">
            <div class="row">
                <!-- Page Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>����������� ��������</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>��� ���������.</p>
                    </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->


                <!-- Sidebar Area End -->
<center>
                <!-- Sidebar Area Start -->
                <div class="col-lg-6">
                    <div class="sidebar-content-wrap m-t-50">

                        <!-- Single Sidebar Start -->
                              <div class="single-sidebar">
                            <center><h3>������� ���������</h3>

                            <div class="sidebar-body">
                                        <div class="tech-info-table">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr class="text-center">
                                                 
	<center><b>������� ���������</b><br>	
<center><a href="/competition" class="stn">������� ��������</a> || <a href="/competition/list" class="stn">�����������</a><BR /></center>
<?PHP

# ������ ���������
if(isset($_GET["list"])){


	# ������ �������������
	$db->Query("SELECT * FROM db_competition WHERE status > 0");
	if($db->NumRows() > 0){
	
	?>
	
	
	<?PHP
		while($data = $db->FetchArray()){
		
		?>
			<table width="99%" border="0" align="center">
			<tr bgcolor="#ffff00">
				<td align="center" width="75" class="m-tb">ID</td>
				<td align="center" class="m-tb">�����</td>
				<td align="center" class="m-tb">��������</td>
				<td align="center" class="m-tb">����</td>
			</tr>
			<tr class="htt" >
				<td align="center"><?=$data["id"]; ?></td>
				<td align="center"><?=date("d.m.Y", $data["date_add"]); ?></td>
				<td align="center"><?=date("d.m.Y", $data["date_end"]); ?></td>
				<td align="center"><?=$data["1m"]+$data["2m"]+$data["3m"]; ?> RUB</td>
		 	</tr>
			<tr bgcolor="#ffff00">
				<td align="center" width="75" class="m-tb">������</td>
				<td align="center" class="m-tb">1 ����� / ����</td>
				<td align="center" class="m-tb">2 ����� / ����</td>
				<td align="center" class="m-tb">3 ����� / ����</td>
			</tr>
			<tr class="htt" >
				<td align="center"><?=($data["status"] > 1) ? "�������" : "��������"; ?></td>
				<td align="center"><?=$data["user_1"]; ?> / <?=$data["1m"]; ?></td>
				<td align="center"><?=$data["user_2"]; ?> / <?=$data["2m"]; ?></td>
				<td align="center"><?=$data["user_3"]; ?> / <?=$data["3m"]; ?></td>
		 	</tr>
			</table>
		<BR /><BR />
		<?PHP
		}

	}else echo "<center><b><font color = 'red'>��� ����������� ���������</font></b></center><BR />";


?>
</div>
<div class="clr"></div>	
<?PHP

return;
}


$db->Query("SELECT * FROM db_competition WHERE status = 0 LIMIT 1");
if($db->NumRows() == 1){
$comp = $db->FetchArray();	
	?>
<b>������� ��������� � <?=$comp["id"]; ?> � ����� �������� ������ <?=$comp["1m"]+$comp["2m"]+$comp["3m"]; ?> RUB<BR /><BR />
����� ��������: <?=date("d.m.Y � H:i:s", $comp["date_add"]); ?> <BR />����������: <?=date("d.m.Y � H:i:s", $comp["date_end"]); ?>
<BR /><BR />
<u>�������� �����:</u><BR />
1 - <?=$comp["1m"]; ?> RUB <BR />
2 - <?=$comp["2m"]; ?> RUB <BR />
3 - <?=$comp["3m"]; ?> RUB <BR /><BR />

� �������� ����������� ������ �������� ��������, ������� ������������������ ����� ������� ��������. <BR />�� ������ ���������� ������� ����� ��������� ��� ����������� �����, 1 RUB = 1 �����. ��� ������ ������, ��� ������ ���� �������� � ��������. <BR /><BR />
</b>
	<?PHP
	
	# ������ �������������
	$db->Query("SELECT * FROM db_competition_users ORDER BY points DESC LIMIT 100");
	if($db->NumRows() > 0){
	
	?>
	<center><b>������� �������</b></center>
<table width="99%" border="0" align="center">
  <tr bgcolor="#ffff00">
    <td align="center" width="75" class="m-tb">�������</td>
    <td align="center" class="m-tb">������������</td>
    <td align="center" class="m-tb">������</td>
	<td align="center" class="m-tb">����</td>
  </tr>
	<?PHP
		$position = 1;
		while($data = $db->FetchArray()){
		
		?>
			<tr class="htt" >
				<td align="center" width="75"><?=$position; ?></td>
				<td align="center"><?=$data["user"]; ?></td>
				<td align="center"><?=sprintf("%.0f",$data["points"]); ?></td>
				<td align="center"><?=(intval($comp["{$position}m"]) > 0) ? $comp["{$position}m"]." RUB" : "-" ?></td>
		 	</tr>
		<?PHP
		$position++;
		}
	
	?>
	<?PHP
	
	}else echo "<center><b><font color = 'red'>��� ���������� � ��������</font></b></center><BR />";

}else echo "<center><b><font color = 'red'>� ������ ������ ������� �� ����������</font></b></center><BR />";

?>

            
              
          
                                            </table>
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

                <!-- Sidebar Area End -->

                <!-- Sidebar Area Start -->
                <div class="col-lg-6">
                    <div class="car-details-content">
                        <h2>������� ���������:</h2>
                        <div class="car-details-info blog-content">
                            <p class="thme-blockquote">3 �����, ��������� ��������, ������� �������� ���������� ���������� ��������� �� ����� ���������� ��������.</p>
                </div>
                    </div>
                </div>
                <!-- Sidebar Area End -->

            </div>
        </div>
    </section>
    <!--== Car List Area End ==-->
</center>

