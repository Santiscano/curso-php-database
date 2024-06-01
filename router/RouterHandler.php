<?php

namespace Router;

class RouterHandler {

  protected $method;
  protected $data;

  public function set_method($method) {
    $this->method = $method;
  }

  public function set_data($data) {
    $this->data = $data;
  }

  public function route($controller, $id) {
    $resourse = new $controller();
    
    switch($this->method) {

      case "get":
        if ($id && $id == "create") {
          $resourse->create();
        } else if ($id) {
          $resourse->show($id);
        } else {
          $resourse->index();
        }
        break;
      
      case "post":
        $resourse->store($this->data);
        break;

      case "delete":
        $resourse->destroy($id);
        break;
    }
  }
}
