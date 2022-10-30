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
        $sql    = "SELECT tasks.id, tasks.title, tasks.task_datetime, tasks.description, tasks.type_id, tasks.priority_id, tasks.status_id,  
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
                    echo '<button class="w-100 d-flex bg-white p-0 py-2 border-0 border-bottom" href="#modal-task" data-bs-toggle="modal" onclick="editTask('.$id.')">
                <div class="px-2">
                    <i class="'.$icon.' text-success fs-2"></i> 
                </div>
                <div class="text-start w-100 pe-2">
                    <div class="fw-bold" id="t'.$id.'" data="'.$row["title"].'" status="'.$row["status_id"].'">'.$row["title"].'</div>
                    <div class="text-start">
                        <div class="text-gray" id="m'.$id.'" data="'.$row["task_datetime"].'">#'.$id.' created in '.$row["task_datetime"].'</div>
                        <div class="" id="d'.$id.'" data="'.$row["description"].'">'.$row["description"].'</div>
                    </div>
                    <div class="">
                        <span class="btn btn-primary py-1 px-2" id="p'.$id.'" data="'.$row["priority_id"].'">'.$row["priority"].'</span>
                        <span class="btn btn-light text-black py-1 px-2" id="y'.$id.'" data="'.$row["type_id"].'">'.$row["type"].'</span>
                    </div>
                </div>
            </button>';
                }
            }
        } 
    }


    function saveTask()
    {
        global $conn;
        //CODE HERE 
        $title       = $_POST['title'];
        $type        = $_POST['type'];
        $priority    = $_POST['priority'];
        $status      = $_POST['status'];
        $date        = $_POST['date'];
        $description = $_POST['description'];

        //SQL INSERT
        $sql = "INSERT INTO `tasks`(`title`, `type_id`, `priority_id`, `status_id`, `task_datetime`, `description`) VALUES ('$title', '$type', '$priority', '$status', '$date', '$description')";

        //checking if the Query is successful. 
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $_SESSION['message'] = "Task has been added successfully !";
		header('location: index.php');
    }

    function updateTask()
    {
        //CODE HERE
        //SQL UPDATE
        $_SESSION['message'] = "Task has been updated successfully !";
		header('location: index.php');
    }

    function deleteTask()
    {
        //CODE HERE
        //SQL DELETE
        $sqlDELETE FROM `tasks` WHERE CustomerName='Alfreds Futterkiste';
        $_SESSION['message'] = "Task has been deleted successfully !";
		header('location: index.php');
    }

?>