<?php

abstract class Controller
{
  protected $controller_name;
  protected $action_name;
  protected $application;
  protected $request;
  protected $response;
  protected $session;
  protected $db_manager;

  public function __construct($application) {
    $this->controller_name = strtolower(substr(get_class($this), 0, -10));

    $this->application = $application;
    $this->request = $appliction->getRequest();
    $this->response = $application->response();
    $this->session = $application->session();
    $this->db_manager = $application->getDbManager();
  }
}
