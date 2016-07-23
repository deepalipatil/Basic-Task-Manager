<?php
  class Database {
    private static $instance = NULL;

    private function __construct() {}
    public static function getInstance() {
      if (!isset(self::$instance)) {
        self::$instance = new PDO('mysql:host=localhost;dbname=task_controller', 'root', '');
        self::$instance->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      }
      return self::$instance;
    }
  }

// Database details:  
//    database name: task_controller
//    table name: tasks 
//   column         type
//   task_name      varchar(40)
//   description    varchar(200)
//   deadline       datetime
//   reminder       boolean
//   completed      boolean
?>
