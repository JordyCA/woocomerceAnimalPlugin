<?php 
  function managerBackend2() 
  {
    $isAllRecords = $_GET['isAllRecords'];
    $animal = $_GET['animal'];
    $html = "";
    if ($isAllRecords === '0') {
      $html = manage_print_general(false, $animal, true);
    } else {
      $html = manage_print_general(true, "", true);
    }
    $response = array (
        'response' => $html
    );
    header('Content-type: application/json');
    echo json_encode($response);
    //echo $html;
    die();
  }
  add_action('wp_ajax_nopriv_managerBackend2', 'managerBackend2');
  add_action('wp_ajax_managerBackend2', 'managerBackend2');
?>