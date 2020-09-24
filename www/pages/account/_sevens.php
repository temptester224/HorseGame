<?PHP
$_OPTIMIZATION["title"] = "������� - ����������� ����������";

?>
<div class="col-sm-12 col-lg-6">
	<blockquote>
        <h2 style="margin-top: 2%;">�����������</h2>
        </blockquote>
</div>

        </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                    <div class="tab-content">
                        <div class="panel panel-default">
                            <div class="panel-heading">����������</div>
                            <div class="panel-body">
                                <blockquote style="margin-bottom: 5%;">
                                    <p>����������� ������ ������ ��� ������� ����� ������� �� �����. ����������� �� ��������� ��������� ������, � ��� �� ����������� ��������������. ����������� ������� ������ ������ ������� �� ���, �����, ����� � ���, �������� �������� ��������� ������� ����.</p>
                                    <footer>������������ ������, �� 1 �� 9.</footer>
                                </blockquote>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">������� ����������</div>
                            <div class="panel-body">
            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">������ 1 ��.</label>
                  <input id="car1" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">������ 2 ��.</label>
                  <input id="car2" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">������ 3 ��.</label>
                  <input id="car3" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">������ 4 ��.</label>
                  <input id="car4" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">������ 5 ��.</label>
                  <input id="car5" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">������ 6 ��.</label>
                  <input id="car6" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">������ 7 ��.</label>
                  <input id="car7" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">������ 8 ��.</label>
                  <input id="car8" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">������ 9 ��.</label>
                  <input id="car9" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">���������� �������</div>
                            <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <td width="50%"><span class="pull-left">����� �� 1 ���:</span></td>
                            <td><span class="pull-right" id="dhd1">0 ���.</span></td>
                        </tr>
                        <tr>
                            <td width="50%"><span class="pull-left">����� �� 24 ����:</span></td>
                            <td><span class="pull-right" id="dhd2">0 ���.</span></td>
                        </tr>
                        <tr>
                            <td width="50%"><span class="pull-left">����� �� 30 ����:</span></td>
                            <td><span class="pull-right" id="dhd3">0 ���.</span></td>
                        </tr>
                        <tr>
                            <td width="50%"><span class="pull-left">����� �� 365 ����:</span></td>
                            <td><span class="pull-right" id="dhd4">0 ���.</span></td>
                        </tr>

                    </table>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <div class="col-sm-offset-0 col-sm-0">
                                            <button type="submit" class="btn btn-primary" onclick="calculate();">����������</button>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>

                            </div>
                        </div>
                    </div>
               </div>



                </div>
            </div>

<script>
var cars=[];


  cars[1]=0.002;


  cars[2]=0.016;


  cars[3]=0.088;


  cars[4]=0.374;


  cars[5]=1.158;


  cars[6]=2.975;


  cars[7]=5.155;


  cars[8]=8.866;


  cars[9]=27.505;


function number_format( number, decimals, dec_point, thousands_sep ) {

  var i, j, kw, kd, km;

  if( isNaN(decimals = Math.abs(decimals)) ){
    decimals = 2;
  }
  if( dec_point == undefined ){
    dec_point = ",";
  }
  if( thousands_sep == undefined ){
    thousands_sep = ".";
  }

  i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

  if( (j = i.length) > 3 ){
    j = j % 3;
  } else{
    j = 0;
  }

  km = (j ? i.substr(0, j) + thousands_sep : "");
  kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
  kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");


  return km + kw + kd;
}


function calculate() {
  var h1=0;
  var h24=0;
  var d30=0;
  var d365=0;
  for(var i=1;i<=9;i++) {
    h1+=cars[i]*parseInt($("#car"+i).val());
    h24+=cars[i]*parseInt($("#car"+i).val())*24;
    d30+=cars[i]*parseInt($("#car"+i).val())*24*30;
    d365+=cars[i]*parseInt($("#car"+i).val())*24*365;
  }
  $("#dhd1").html(number_format(h1, 4, '.', ' ')+" ���.");
  $("#dhd2").html(number_format(h24, 3, '.', ' ')+" ���.");
  $("#dhd3").html(number_format(d30, 2, '.', ' ')+" ���.");
  $("#dhd4").html(number_format(d365, 0, '.', ' ')+" ���.");
}
</script>

