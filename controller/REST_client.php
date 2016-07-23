<?php
    require_once('/opt/lampp/htdocs/Task_manager/model/task.php');
        if ( $_GET["action"] == "create") 
        {
            if(isset($_POST['submit']))
            {
                if(isset($_POST['task_name']))
                    $name = $_POST['task_name'];
                else
                    echo '<script type="text/javascript">alert("Enter task name!");</script>';
                if(isset($_POST['description']))
                    $description = $_POST['description'];
                else
                    $description = "";
                if(isset($_POST['deadline']))
                    $deadline = $_POST['deadline'];
                if(isset($_POST['reminder']))
                    $reminder = 1;
                else
                    $reminder = 0;
                date_default_timezone_set('Asia/Kolkata');
                $current = date('Y-m-d H:i:s');
                $time = date('Y-m-d H:i:s',strtotime($deadline));
                if($current>$time)
                    $completed = 1;
                else
                    $completed = 0;
                
                $task_info = file_get_contents('http://localhost/Task_manager/controller/task_controller.php?action=create&name=' . $name . '&description=' . $description . '&deadline=' . $deadline . '&reminder=' . $reminder . '&completed=' . $completed );
                $task_info = json_decode($task_info, true);
                echo $task_info;
            }
            else
                echo '<script type="text/javascript">alert("Task not created")</script>';
        }

        if ( $_GET["action"] == "get_task") 
        {
            if(isset($_POST['get']))
            {
                if(isset($_POST['task_name']))
                    $name = $_POST['task_name'];     
                $task_info = file_get_contents('http://localhost/Task_manager/controller/task_controller.php?action=get_task&name1=' . $name);
                $task_info = json_decode($task_info, true);
                print_r($task_info);
             }
        }

        if ( $_GET["action"] == "delete") 
        {
            if(isset($_POST['del']))
            {
                if(isset($_POST['task_name']))
                    $name = $_POST['task_name'];     
                $task_del = file_get_contents('http://localhost/Task_manager/controller/task_controller.php?action=delete&name2=' . $name);
                $task_del = json_decode($task_del, true);
                echo "done!";
            }
        }

        if($_GET["action"] == "get_task_list")
        {
            $task_list = file_get_contents('http://localhost/Task_manager/controller/task_controller.php?action=get_task_list');
            $task_list = json_decode($task_list, true);
            echo $task_list;    
        } 

        if($_GET["action"] == "refresh")
        {
            $task_list = file_get_contents('http://localhost/Task_manager/controller/task_controller.php?action=refresh');
            $task_list = json_decode($task_list, true);
            echo $task_list;
        } 

        if($_GET["action"] == "reminder")
        {
            Task::show_reminder();
        } 