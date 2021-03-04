<?php 
  function managerBackend2() 
  {
      $response = array (
          'response' => "hola"
      );
      header('Content-type: application/json');
      echo json_encode($response);
      die();
  }
  add_action('wp_ajax_nopriv_managerBackend2', 'managerBackend2');
  add_action('wp_ajax_managerBackend2', 'managerBackend2');
?>