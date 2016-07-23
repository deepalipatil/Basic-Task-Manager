<?php
    require_once('/opt/lampp/htdocs/Task_manager/connection.php');

    class Task {
        public $name;
        public $description;
        public $deadline;
        public $completed;
        public $reminder;

        public function __construct($name, $description, $deadline, $completed, $reminder) {
        $this->name      = $name;
        $this->description  = $description;
        $this->deadline = $deadline;
        $this->completed = $completed;
        $this->reminder = $reminder;
        }
        
        public static function create($name,$description,$deadline,$reminder,$completed) {
            $db = Database::getInstance();
            $req = $db->prepare('INSERT INTO tasks (task_name, description, deadline, reminder, completed) values (?,?,?,?,?)');
            $data = array($name,$description,$deadline,$reminder,$completed);
            $req->execute($data);
            $value = "Task created!";
            return json_encode($value);
        }

        public static function get_task_list() {
            $db = Database::getInstance();
            $req = $db->prepare('SELECT * FROM tasks');
            $req->execute();    
            $value = $req->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($value);
        }

        public static function get_task_by_id($task_name) {
            $db = Database::getInstance();
            $req = $db->prepare('SELECT * FROM tasks WHERE task_name = :name');
            $req->bindParam(':name', $task_name);
            $req->execute();
            $value = $req->fetch(PDO::FETCH_ASSOC);
            return json_encode($value);
        }
        
        public static function delete_task($task_name) {
            $db = Database::getInstance();
            $req = $db->prepare('DELETE FROM tasks WHERE task_name = :name');
            $req->bindParam(':name', $task_name);
            $req->execute();
            $count = $del->rowCount();
            $value="Deleted!";
            return json_encode($count);
        }
        
        public static function refresh() {
            $db = Database::getInstance();
            date_default_timezone_set('Asia/Kolkata');
            $current = date('Y-m-d H:i:s');
            $update = $db->prepare('UPDATE tasks SET completed=1 WHERE deadline < :current');
            $update->bindParam(':current', $current);
            $update->execute();
            $req = $db->prepare('DELETE FROM tasks WHERE completed=1');
            $req->execute();
            $value="Task list refreshed! ";
            return json_encode($value);
        }
        
        public static function show_reminder() {
            $db = Database::getInstance();
            $req = $db->prepare('SELECT * FROM tasks WHERE reminder=1 and completed=0');    
            $req->execute();
            date_default_timezone_set('Asia/Kolkata');
            while($row=$req->fetch()) {
                $current_date = date('Y-m-d H:i:s');
                $deadline_date = date('Y-m-d H:i:s',strtotime($row['deadline']));
                $prev_date = date('Y-m-d H:i:s', strtotime($deadline_date .' -1 day'));
                if($prev_date<$current_date && $current_date<$deadline_date)
                {
                    echo '<script type="text/javascript">alert("This is the reminder for '.$row['task_name'].'")</script>';
                }
            }
        }
        
    }
?>