<?PHP
$_OPTIMIZATION["title"] = "������� - ���������";
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a WHERE id = '$usid'");
$user_data = $db->FetchArray();
?>

<?PHP

		if(isset($_POST["old"])){
	
	
		$old = $func->md5Password($_POST["old"]);
		$new = $func->md5Password($_POST["new"]);
		
			if($old !== false AND strtolower($old) == strtolower($user_data["pass"])){
			
				if($new !== false){
				
					if( strtolower($new) == strtolower($func->md5Password($_POST["re_new"]))){
					
						$db->Query("UPDATE ".$pref."db_users_a SET pass = '$new' WHERE id = '$usid'");
						
						echo "<script>setTimeout(function(){swal(\"����� ������ ������� ����������\", \"�������\")}, 500); </script>";
					
					}else echo "<script>setTimeout(function(){swal(\"������ � ������ ������ �� ���������\", \"������\")}, 500);</script>";
				
				}else echo "<script>setTimeout(function(){swal(\"����� ������ ����� �������� ������\", \"������\")}, 500);</script>";
			
			}else echo "<script>setTimeout(function(){swal(\"������ ������ �������� �������\", \"������\")}, 500);</script>";
		
	}

	if(isset($_POST["plat_pass"])){
	
		function plat_passs($plat_passs){
		if(!preg_match("/^[0-9]{4}$/", $plat_passs)) return false;
		     return $plat_passs;
		}
		$plat_passs = plat_passs($_POST["plat_pass"]);
		$plat_pass = md5($plat_passs);
		
			
			
				if($plat_passs !== false){
				
					
					
						$db->Query("UPDATE db_users_a SET plat_pass = '$plat_pass' WHERE id = '$usid'");
						
						echo  "<script>setTimeout(function(){swal(\"����� ��������� ������ ������� ����������\", \"�������\")}, 500); </script>";
					
					
				
				}else echo "<script>setTimeout(function(){swal(\"��������� ������ ����� �������� ������!\", \"������\")}, 500);</script>";
			
			
		
	}

?>




<div class="col-sm-12 col-lg-6">
	<blockquote>
        <h2 style="margin-top: 2%;">��������� ��������</h2>
        </blockquote>
</div>


        </div>
            <div class="container-fluid">
                <div class="row">
				
				
				
				





    

          <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">��������� ������:</div>
                <div class="panel-body">
                  <form action="" name="config" enctype="multipart/form-data" method="POST">
				  
				  
                  <input type="hidden" name="_tocken" value="8d83370f4fc420d2cacb4bee4">
                    <div class="form-group">
                    <input name="old"  maxlength="20"  type="password" class="form-control" placeholder="������� ������� ������" autocomplete="off" required="" />
                            </div>

                    <div class="form-group">
                    <input name="new"  maxlength="20"  type="password" class="form-control" placeholder="������� �����" autocomplete="off" required="" />
                            </div>

                    <div class="form-group">
                    <input name="re_new"  maxlength="20"  type="password" class="form-control" placeholder="������� �����, ��������" autocomplete="off" required="" />
                            </div>
                            <button type="submit" class="btn btn-block btn-primary"> ������ ������</button>
                              </form>
                </div>
              </div>
            </div>
          <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">��������� ������:</div>
                <div class="panel-body">
                  <form action="" name="config" enctype="multipart/form-data" method="POST">
                  <input type="hidden" name="_tocken" value="8d83370f4fc420d2cacb4bee4">
                    <div class="input-group">
					<?php
if($user_data['plat_pass'] != 0) {
echo '<font color="green">�� ��� ���������� ��������� ������! ��� ��� ����� ���������� � ������ ���������!</font><br><br>';
} else {
?>
                    <input  name="plat_pass" maxlength="4" type="text" minlength="4" type="password" class="form-control" placeholder="������� PIN-���, �� ����..." autocomplete="off" required=""  />
                                    <span class="input-group-btn">
                                        <button type="submit"  class="btn btn-danger"> ��</button>
                                    </span><?php } ?>
                            </div>
                              </form>
                </div>        
              </div>
            </div>




                </div>
            </div>


