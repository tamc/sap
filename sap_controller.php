<?php
  /*
   All Emoncms code is released under the GNU Affero General Public License.
   See COPYRIGHT.txt and LICENSE.txt.

    ---------------------------------------------------------------------
    Emoncms - open source energy visualisation
    Part of the OpenEnergyMonitor project:
    http://openenergymonitor.org
  */

  // no direct access
  defined('EMONCMS_EXEC') or die('Restricted access');

  function sap_controller()
  {
    require "Modules/sap/sap_model.php";
    global $session, $route;

    $format = $route['format'];
    $action = $route['action'];

    $output['content'] = "";
    $output['message'] = "";


    if ($action == 'save' && $session['write'])
    {
      $data = post('data');
      sap_save($session['userid'],1,$data);
    }
    elseif ($session['write'])
    {
      if (!$action) $action = 1;
      $data = sap_get($session['userid'], 1);
      $output['content'] = view("sap/sap_view.php",array('data'=>$data, 'page'=>$action));
    }
  
    $output['fullwidth'] = true;
    return $output;
  }

?>
