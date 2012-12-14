<?php

function sap_save($userid, $docid, $data)
{
  $result = db_query("SELECT `docid` FROM sap WHERE `userid` = '$userid' AND `docid` = '$docid'");
  $row = db_fetch_object($result);

  if (!$row)
  {
    db_query("INSERT INTO sap (`userid`, `docid`, `data`) VALUES ('$userid','$docid','$data')");
  }
  else
  {
    db_query("UPDATE sap SET `data` = '$data' WHERE `userid` = '$userid' AND `docid` = '$docid'");
  }
}

function sap_get($userid,$docid)
{
  $result = db_query("SELECT `data` FROM sap WHERE `userid` = '$userid' AND `docid` = '$docid'");
  $row = db_fetch_array($result);
  if ($row) return $row['data']; else return '0';
}

?>
