<!-----------------------------------------------------------------------------

  All SAP Emoncms module code is released under the GNU Affero General Public License.
  See COPYRIGHT.txt and LICENSE.txt.

  ---------------------------------------------------------------------
  Part of the OpenEnergyMonitor project:
  http://openenergymonitor.org
 
------------------------------------------------------------------------------->

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="jquery.min.js"></script>
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
  </head>
  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Project name</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<style>
  input {
    width:80px;
  }
</style>

    <div class="container">

      <h1>SAP Worksheet 2012</h1>

<?php
$myFile = "desc.txt";
$fh = fopen($myFile, 'r');

$equations = array();

$br = 0;

while(!feof($fh))
{
  $line = fgets($fh);
  $line = trim($line);

  // Headings
  if ($line[0] == '#') {$line[0]=null; echo "<h3>".$line."</h3>";}
  if ($line[0] == 'p') {$line[0]=null; echo "<p style='color:#222'><i>".$line."</i></p>";}

  if ($line[0] == 't' && $line[2]=='1')  {$br = 1;}
  if ($line[0] == 't' && $line[2]=='0')  {$br = 0;}

  if ($line[0] == '$') {
    $line = preg_replace('/[^\w\s=+÷.-]/','|',$line);
    $items = explode('|', $line);

    $equation_items = array();
    for ($i=4; $i<count($items)-1; $i++)
    {
      $equation_items[] = $items[$i];
    }
    $equations[] = array('result'=>$items[2],'items'=>$equation_items);
  }

  if ($line[0] == '>') {$table = false; echo "</table>";}

  if ($table) 
  {
    $items = explode('|', $line);
    echo "<tr>";
    foreach ($items as $td)
    {
      if ($td[0]=='(') 
      {
        $id = getid($td);
        if (!$br) echo "<td><input id='".$id."' type='text' />".$td."</td>";
        if ($br) echo "<td><input style='width:60px' id='".$id."' type='text' /><br><span style='font-size:12px; color:#444;'>".$td."</span></td>";
      }
      else
      {
        echo "<td>".$td."</td>";
      }
    }
    echo "</tr>";
  }

  if ($line[0] == '<') {$table = true; echo "<table>";}

}

fclose($fh);

function getid($str)
{
  $id = '';
  for ($i=1; $i<strlen($str)-1; $i++)
  {
    $id .= $str[$i];
  }
  return $id;
}

?>

<script>

var equation_list = <?php echo json_encode($equations); ?>;
console.log(equation_list);

$('input').keyup(function()
{

for (z in equation_list)
{
  var equation = equation_list[z];
  var len = equation['items'].length;

    var value = 0;
    if (equation['items'][0][0] == 'v')
    {
      var str = equation['items'][0];
      value = parseFloat(str.replace('v',''));
    }
    else
    {
      value = parseFloat($("#"+equation['items'][0]).val());
    }
    if (isNaN(value)) value = 0;

  var result = value;

  for (var i=1; i<len; i=i+2)
  {
    var operator = equation['items'][i];

    // detect if value is input element id or fixed value denoted by v character
    var value = 0;
    if (equation['items'][i+1][0] == 'v')
    {
      var str = equation['items'][i+1];
      value = parseFloat(str.replace('v',''));
    }
    else
    {
      value = parseFloat($("#"+equation['items'][i+1]).val());
    }
    if (isNaN(value)) value = 0;

    if (operator == '+') result = result + value;
    if (operator == '-') result = result - value;
    if (operator == 'x') result = result * value;
    if (operator == '÷') result = result / value;
  }
  
  $("#"+equation['result']).val(result);
}

});
</script>

</div>

</body>
</html>
