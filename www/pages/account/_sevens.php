<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Калькулятор доходности";

?>
<div class="col-sm-12 col-lg-6">
	<blockquote>
        <h2 style="margin-top: 2%;">Калькулятор</h2>
        </blockquote>
</div>

        </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                    <div class="tab-content">
                        <div class="panel panel-default">
                            <div class="panel-heading">Информация</div>
                            <div class="panel-body">
                                <blockquote style="margin-bottom: 5%;">
                                    <p>Калькулятор дохода служит для расчета Вашей прибыли от машин. Калькулятор не учитывает возможные бонусы, а так же реферальные вознаграждения. Калькулятор считает только чистую прибыль за час, сутки, месяц и год, согласно скорости заработка каждого авто.</p>
                                    <footer>Наименование уровня, от 1 до 9.</footer>
                                </blockquote>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Введите количество</div>
                            <div class="panel-body">
            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">МАШИНА 1 УР.</label>
                  <input id="car1" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">МАШИНА 2 УР.</label>
                  <input id="car2" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">МАШИНА 3 УР.</label>
                  <input id="car3" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">МАШИНА 4 УР.</label>
                  <input id="car4" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">МАШИНА 5 УР.</label>
                  <input id="car5" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">МАШИНА 6 УР.</label>
                  <input id="car6" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">МАШИНА 7 УР.</label>
                  <input id="car7" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">МАШИНА 8 УР.</label>
                  <input id="car8" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
              <div class="col-md-4">
                <div class="form-group" align="center">
                  <label class="control-label">МАШИНА 9 УР.</label>
                  <input id="car9" class="form-control text-center" type="text" value="0">
                </div>
              </div>

            
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Статистика расчета</div>
                            <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <td width="50%"><span class="pull-left">Доход за 1 час:</span></td>
                            <td><span class="pull-right" id="dhd1">0 руб.</span></td>
                        </tr>
                        <tr>
                            <td width="50%"><span class="pull-left">Доход за 24 часа:</span></td>
                            <td><span class="pull-right" id="dhd2">0 руб.</span></td>
                        </tr>
                        <tr>
                            <td width="50%"><span class="pull-left">Доход за 30 дней:</span></td>
                            <td><span class="pull-right" id="dhd3">0 руб.</span></td>
                        </tr>
                        <tr>
                            <td width="50%"><span class="pull-left">Доход за 365 дней:</span></td>
                            <td><span class="pull-right" id="dhd4">0 руб.</span></td>
                        </tr>

                    </table>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <div class="col-sm-offset-0 col-sm-0">
                                            <button type="submit" class="btn btn-primary" onclick="calculate();">Рассчитать</button>
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
  $("#dhd1").html(number_format(h1, 4, '.', ' ')+" руб.");
  $("#dhd2").html(number_format(h24, 3, '.', ' ')+" руб.");
  $("#dhd3").html(number_format(d30, 2, '.', ' ')+" руб.");
  $("#dhd4").html(number_format(d365, 0, '.', ' ')+" руб.");
}
</script>

