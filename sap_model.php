<?php
// no direct access
defined('EMONCMS_EXEC') or die('Restricted access');

class Sap
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function save($userid, $docid, $data)
    {
        $result = $this->mysqli->query("SELECT `docid` FROM sap WHERE `userid` = '$userid' AND `docid` = '$docid'");
        $row = $result->fetch_object();

        if (!$row)
        {
            $this->mysqli->query("INSERT INTO sap (`userid`, `docid`, `data`) VALUES ('$userid','$docid','$data')");
        }
        else
        {
            $this->mysqli->query("UPDATE sap SET `data` = '$data' WHERE `userid` = '$userid' AND `docid` = '$docid'");
        }
    }

    public function get($userid,$docid)
    {
        $result = $this->mysqli->query("SELECT `data` FROM sap WHERE `userid` = '$userid' AND `docid` = '$docid'");
        $row = $result->fetch_array();
        if ($row) return $row['data']; else return '0';
    }
}
?>
