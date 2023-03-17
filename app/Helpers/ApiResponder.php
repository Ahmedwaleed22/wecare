<?php

namespace App\helpers;

trait ApiResponder
{

  public function apiResponse($code = 200, $message = null, $errors = null, $data = null)
  {
    $array = [];

    if (is_null($data) && !is_null($errors)) {
      $array['errors'] = $errors;
    } else if (!is_null($message)) {
      $array['message'] = $message;
    } 
    
    if (is_null($errors) && !is_null($data)) {
      $array['data'] = $data;
    }
    
    $responseData = count($array) > 0 ? $array : '';

    return response($responseData, $code);
  }
}
