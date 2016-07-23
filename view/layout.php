<?php
    echo "<script src='http://code.jquery.com/jquery-latest.js'></script>
         <script type='text/javascript'>
             $(document).ready(function () {
                $('#id_create').click(function () {
                   $('#div1').toggle('fast');
            });
            $('#id_get').click(function () {
                  $('#div2').toggle('fast');
             });
             $('#id_delete').click(function () {
                   $('#div3').toggle('fast');
            });
           });
           </script>";

    echo "<p>Welcome to Task Manager</p>
        <p ><a id='id_create' href='#'>Create new task</a></p>
        <div id='div1' style='display:none'>
            <form action='http://localhost/Task_manager/controller/REST_client.php?action=create' method='POST'>
                <p>Task Name: <input type='text' placeholder='task1' name='task_name' required></p>
                <p>Description: <input type='text' value='' name='description'></p>
                <p>Deadline(yyyy-mm-dd H:i:s): <input type='text' placeholder='2016-07-17 12:00 PM' name='deadline' required></p>
                <p><input type='checkbox' value='1' name='reminder'> Set reminder</p>
                <br>
                <input type='submit' name='submit' value='Create'>
            </form>
        </div>
        
        <p><a id='id_get' href='#'>Get Task</a></p>
        <div id='div2' style='display:none'>
            <form action='http://localhost/Task_manager/controller/REST_client.php?action=get_task' method='POST'>
                <p>Task Name: <input type='text' placeholder='task1' name='task_name' required></p>
                <input type='submit' name='get' value='Get'>
            </form>
        </div>
        
        <p><a id='id_delete' href='#'>Delete Task</a></p>
        <div id='div3' style='display:none'>
            <form action='http://localhost/Task_manager/controller/REST_client.php?action=delete' method='POST'>
                <p>Task Name: <input type='text' placeholder='task1' name='task_name' required></p>
                <input type='submit' name='del' value='Delete'>
            </form>
        </div>
       
        <p><a href='http://localhost/Task_manager/controller/REST_client.php?action=get_task_list'>Display List of all Tasks<br></a></p>
        
        <p><a href='http://localhost/Task_manager/controller/REST_client.php?action=refresh' >Refresh List to delete completed tasks!<br></a></p>
        
        <p><a href='http://localhost/Task_manager/controller/REST_client.php?action=reminder' >Show task reminders!<br></a></p>";

?>