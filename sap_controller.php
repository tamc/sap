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
    global $mysqli, $session, $route;

    require "Modules/sap/sap_model.php";
    $sap = new Sap($mysqli);

    if ($route->action == 'save' && $session['write'])
    {
      $data = post('data');
      $sap->save($session['userid'],1,$data);
      $result = true;
    }
    elseif ($session['write'])
    {
      if (!$route->action) $route->action = 1;
      $data = $sap->get($session['userid'], 1);
      $result = view("Modules/sap/sap_view.php",array('data'=>$data, 'page'=>$route->action));
    }
  
    return array('content'=>$result, 'fullwidth'=>true);
  }

?>
