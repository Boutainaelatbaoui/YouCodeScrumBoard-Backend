<?php
    //INCLUDE DATABASE FILE
    include('database.php');
    //SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
    session_start();

    //ROUTING
    if(isset($_POST['save'])){
        saveTask();
    };
    if(isset($_POST['update'])){
        updateTask();
    }
    if(isset($_POST['delete'])){
        deleteTask();
    }

    function getTasks($check_status)
    {
        global $conn;
        //CODE HERE
        //SQL SELECT
        $sql    = "SELECT tasks.*,  
                    types.name as `type`,
                    priorities.name as `priority`,
                    statuses.name as `status`
                    FROM `tasks`
                    INNER JOIN `types` on tasks.type_id = types.id
                    INNER JOIN `priorities` on tasks.priority_id = priorities.id
                    INNER JOIN `statuses` on tasks.status_id = statuses.id";

        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $icon = '';
                if($check_status == 'To Do'){
                    $icon='fa fa-circle-question';
                }
                elseif ($check_status == 'In Progress'){
                    $icon='fa fa-spinner';
                }
                else{
                    $icon='fa fa-circle-check';
                }

                if($row["status"] == $check_status) {
                    $id = $row["id"];
                    echo '<button class="w-100 d-flex bg-white p-0 py-2 border-0 border-bottom" id = "'.$id.'" title="'.$row["title"].'" status="'.$row["status_id"].'"
                    date="'.$row["task_datetime"].'" description="'.$row["description"].'"
                    priority="'.$row["priority_id"].'" type="'.$row["type_id"].'" 
                    href="#modal-task" data-bs-toggle="modal" onclick="editTask('.$id.')">
                <div class="px-2">
                    <i class="'.$icon.' text-success fs-2"></i> 
                </div>
                <div class="text-start w-100 pe-2">
                    <div class="fw-bold" >'.$row["title"].'</div>
                    <div class="text-start">
                        <div class="text-gray">#'.$id.' created in '.$row["task_datetime"].'</div>
                        <div class="">'.$row["description"].'</div>
                    </div>
                    <div class="">
                        <span class="btn btn-primary py-1 px-2">'.$row["priority"].'</span>
                        <span class="btn btn-light text-black py-1 px-2">'.$row["type"].'</span>
                    </div>
                </div>
            </button>';
                }
            }
        } 
    }

    function countTasks($check_status){
        global $conn;
        //CODE HERE
        //SQL SELECT
        $sql    = "SELECT *  
                    FROM `tasks`
                    WHERE `status_id` =  $check_status";

        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        echo $rowcount;
    }


    function saveTask()
    {
        global $conn;
        //CODE HERE 
        $title       = $_POST['title'];
        $type        = $_POST['type'];
        $priority    = $_POST['priority'];
        $status      = $_POST['status'];
        $datetime    = $_POST['date-time'];
        $description = $_POST['description'];

        //Form validation
        if(empty($_POST['title']) || empty($_POST['status']) || empty($_POST['priority'])) {
            $_SESSION['message1'] = "Please fill the form !";
		    header('location: index.php');
        }
        else {
            //SQL INSERT
            $sql = "INSERT INTO `tasks`(`title`, `type_id`, `priority_id`, `status_id`, `task_datetime`, `description`) VALUES ('$title', '$type', '$priority', '$status', '$datetime', '$description')";

            //checking if the Query is successful. 
            if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = "Task has been added successfully !";
                header('location: index.php');
            } else {
                echo "ERROR: Could not able to execute $sql. " .mysqli_error($conn);
            }
        }

    }

    function updateTask()
    {
        global $conn;
        //CODE HERE
        $id          = $_POST['task-id'];
        $title       = $_POST['title'];
        $type        = $_POST['type'];
        $priority    = $_POST['priority'];
        $status      = $_POST['status'];
        $datetime    = $_POST['date-time'];
        $description = $_POST['description'];

        //Form validation
        if (empty($_POST['title']) || empty($_POST['status']) || empty($_POST['priority'])) {
            $_SESSION['message1'] = "Please fill the form !";
		    header('location: index.php');
        }
        else {
            //SQL UPDATE
            $sql = "UPDATE `tasks` 
            SET `title`='$title',`type_id`='$type',`priority_id`='$priority',`status_id`='$status',`task_datetime`='$datetime',`description`='$description' 
            WHERE id = $id";

            if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = "Task has been updated successfully !";
                header('location: index.php');
            } else {
                echo "ERROR: Could not able to execute $sql. " .mysqli_error($conn);
            }
        }


        
    }

    function deleteTask()
    {
        global $conn;

        $id = $_POST['task-id'];
        //CODE HERE
        //SQL DELETE
        $sql = "DELETE FROM tasks WHERE id = $id";

        //checking if the Query is successful. 
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "Task has been deleted successfully !";
		    header('location: index.php');
        } else {
            $_SESSION['message1'] = "Task has not been deleted !";
		    header('location: index.php');
        }
    }

?>