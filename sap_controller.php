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
    else
    {
      if (!$route->action) $route->action = 1;

      $example = false;
      if ($session['write']) {
        $data = $sap->get($session['userid'], 1); 
      } else { 
        $example = true;
        $data = file_get_contents('Modules/sap/example.data');
      }

      $result = view("Modules/sap/sap_view.php",array('data'=>$data, 'page'=>$route->action, 'example'=>$example));
    }
  
    return array('content'=>$result, 'fullwidth'=>true);
  }

?>
