<?PHP
$_OPTIMIZATION["title"] = "������� - ����������� ���������";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '$user_id'");
$refs = $db->FetchRow();
?>  




<div class="col-sm-12 col-lg-6">
	<blockquote>
        <h2 style="margin-top: 2%;">��������</h2>
        </blockquote>
</div>

        </div>
            <div class="container-fluid">
                <div class="row">

                        
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                             <table class="table table-bordered">
                          <thead>
                          <tr>
                            <th class="text-center">�����</th>
                            <th class="text-center">���� �����������</th>
                            <th class="text-center">����� �� ��������</th>
                          </tr>
                          </thead>
                        
						
						
						<?PHP
  $all_money = 0;
  $db->Query("SELECT db_users_a.user, db_users_a.date_reg, db_users_b.to_referer FROM db_users_a, db_users_b 
  WHERE db_users_a.id = db_users_b.id AND db_users_a.referer_id = '$user_id' ORDER BY to_referer DESC");
  
	if($db->NumRows() > 0){
  
  		while($ref = $db->FetchArray()){
		if (sprintf("%.2f",$ref["to_referer"]) > 0) { $t = sprintf("%.2f",$ref["to_referer"]); } else { $t ='�� �������';}
		?>
		 <tr class="text-center">
			  <td width="25%"> <?=$ref["user"]; ?>�</td>
			  <td width="25%"> <?=date("d.m.Y � H:i:s",$ref["date_reg"]); ?>�</td>
			  <td width="25%"> <?=$t; ?>�</td>
		</tr>

		<?PHP
		$all_money += $ref["to_referer"];
		}
  
	}else echo '<div class="err">� ��� ��� ���������</div>'
  ?> 
                             </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                    <div class="tab-content">
                        <div class="panel panel-default">
                            <div class="panel-heading">����� ���������:</div>
							
							   <pre style="margin-top: 20px;"><h4 style="color: #013220;" align="center">https://<?=$_SERVER['HTTP_HOST']; ?>/?i=<?=$_SESSION["user_id"]; ?></h4></pre>
							   
                            <div class="col-sm-6">
                    <div class="tab-content">
                        <div class="panel panel-default">
                            <div class="panel-heading">������: 728x90</div>
                            <div class="panel-body text-center">
                               <img src="http://<?=$_SERVER['HTTP_HOST']; ?>/assets/banners/HB-728.gif"/><br>
                    <pre style="margin-top: 20px;"><code><input type="text" value="https://<?=$_SERVER['HTTP_HOST']; ?>/assets/banners/HB-728.gif" onClick="this.select();" class="form-control text-center" readonly="readonly"></code></pre>
                                      </div>
                        </div>
                    </div>
               </div>

                            <div class="col-sm-6">
                    <div class="tab-content">
                        <div class="panel panel-default">
                            <div class="panel-heading">������: 200x300</div>
                            <div class="panel-body text-center">
                              <img src="http://<?=$_SERVER['HTTP_HOST']; ?>/assets/banners/BS-200-2F.gif" size="70"/><br>
                        <pre style="margin-top: 20px;"><code><input type="text" value="https://<?=$_SERVER['HTTP_HOST']; ?>/assets/banners/BS-200-2F.gif" onClick="this.select();" class="form-control text-center" readonly="readonly"></code></pre>
                                       </div>
                        </div>
                    </div>
               </div>

                        </div>
                    </div>
               </div>


                </div>
            </div>

                
         