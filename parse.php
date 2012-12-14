<?php
  // Descriptor file to parse
  $myFile = "desc.txt";
  $fh = fopen($myFile, 'r');

  $br = 0;

  $out = '';
  $eqs = "function calculate(data) { \n";

while(!feof($fh))
{
  $line = fgets($fh);
  $line = trim($line);

  // Headings
  if ($line[0] == '#' && !$table) {$line = substr($line,1); $out .= "<h3>".$line."</h3>\n";}
  if ($line[0] == 'p' && !$table) {$line = substr($line,1); $out .= "<p>".$line."</p>\n";}

  if ($line[0] == 't' && $line[2]=='1')  {$br = 1;}
  if ($line[0] == 't' && $line[2]=='0')  {$br = 0;}

  if ($line[0] == '$') {
    $line = preg_replace('/[^\w\s=+÷.-]/','|',$line);
    $items = explode('|', $line);

    // If result of equation has m for monthly as the precending character then equation is of monthly type
    if ($items[2][0]=='m')
    {
      $item = substr($items[2],1);
      $eqs .= "for (var i=1; i<13; i++) { data['".$item."-'+i] =";


      for ($i=4; $i<count($items)-1; $i++)
      {
        $item = $items[$i];
        if ($item[0]=='m')
        {
          $item = substr($items[$i],1);
          $item = "data['".$item."-'+i]";
        }
        elseif ($item[0]=='v') $item = substr($item,1);
        elseif ($item=='x') $item = '*';
        elseif ($item=='÷') $item = '/';
        elseif ($item=='+') $item = '+';
        elseif ($item=='-') $item = '-';
        else { $item = "data['".$item."']"; }
        $eqs .= ' '.$item;
      }

      $eqs .= "; }\n";
    }
    else
    {
      $eqs .= "data['".$items[2]."'] =";
      for ($i=4; $i<count($items)-1; $i++)
      {
          $item = $items[$i];
          if ($item[0]=='v') $item = substr($item,1);
          elseif ($item=='x') $item = '*';
          elseif ($item=='÷') $item = '/';
          elseif ($item=='+') $item = '+';
          elseif ($item=='-') $item = '-';
          else { $item = "data['".$item."']"; }
          $eqs .= ' '.$item;
      }
      $eqs .= ";\n";
    }
  }

  if ($line[0] == '>') {$table = false; $out .= "</table>\n";}

  if ($table) 
  {
    $items = explode('|', $line);
    $out .= "  <tr>\n";
    foreach ($items as $td)
    {
      if ($td[0]=='(') 
      {
        $id = getid($td);
        $out .= "    <td style='padding:8px 6px 6px 6px; width:60px'><input style='width:60px' class='".$id."' type='text' placeholder='".$id."' value='0' /></td>\n";
      }
      else
      {
        $out .= "    <td>".$td."</td>\n";
      }
    }
    $out .= "  </tr>\n";
  }

  if ($line[0] == '<') {$table = true; $out .= "<table class='table table-bordered'>\n";}

  // Parse monthly table automatically
  if ($line[0] == 'm' && !$table)
  {
    $tag = substr($line, 3,-1);
    $d='-';
    $out .= "<table class='table table-bordered'>\n  <tr>\n    <td style='padding-top:13px'>(".$tag.")m</td>\n";
    for ($i=1; $i<13; $i++)
    {
      $id = $tag.$d.$i;
      $out .= "    <td style='padding:8px 0px 6px 6px'><input style='width:45px;' class='".$id."' type='text' placeholder='".$id."' value='0' /></td>\n";
    }
    $out .= "  </tr>\n</table>\n";
  }
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

echo "Parsing complete";

// Export to html file
$outfile = "form.html";
$out_fh = fopen($outfile, 'w');
fwrite($out_fh, $out);
fclose($out_fh);

$eqs .= "return data; \n";
$eqs .= '}';
// Export to quations file
$outfile = "equations.js";
$out_fh = fopen($outfile, 'w');
fwrite($out_fh, $eqs);
fclose($out_fh);
?>
