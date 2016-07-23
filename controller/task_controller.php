<?php
    require_once('/opt/lampp/htdocs/Task_manager/model/task.php');
    $possible_url = array("get_task_list", "get_task", "refresh", "create", "delete");
    $value = "An error has occurred";

    if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url))
    {
      switch ($_GET["action"])
        {
            case "create":
                $value = Task::create($_GET['name'],$_GET['description'],$_GET['deadline'],$_GET['reminder'],$_GET['completed']);
                break;
            case "get_task_list":
                $value = Task::get_task_list();
                break;
            case "get_task":
                if (isset($_GET['name1']))
                    $value = Task::get_task_by_id($_GET["name1"]);
                else
                    $value = "Missing argument";
                break;
            case "refresh":
                $value=Task::refresh();
                break;
            case "delete":
                if (isset($_GET['name2']))
                    $value = Task::delete_task($_GET['name2']);
                else
                    $value = "Missing argument";
                break;
        }
    }
    exit(json_encode($value));
?>
