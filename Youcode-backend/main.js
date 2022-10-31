let type_feature = document.getElementById('task-type-feature');
let type_bug     = document.getElementById('task-type-bug');

function addTask(){
    document.getElementById('task-save-btn').style.display   = "block";
    document.getElementById('task-update-btn').style.display = "none";
    document.getElementById('task-delete-btn').style.display = "none";

    document.getElementById('form-task').reset();
}

function editTask(id){
    document.getElementById("task-id").value = id;

    document.getElementById('task-save-btn').style.display   = "none";
    document.getElementById('task-update-btn').style.display = "block";
    document.getElementById('task-delete-btn').style.display = "block";

    document.getElementById('task-title').value = document.getElementById(id).getAttribute("title");
    document.getElementById('task-priority').value = document.getElementById(id).getAttribute("priority");
    document.getElementById('task-description').value = document.getElementById(id).getAttribute("description");
    document.getElementById('task-status').value = document.getElementById(id).getAttribute("status");
    document.getElementById('task-date').value = document.getElementById(id).getAttribute("date");
    if(document.getElementById(id).getAttribute("type") == 1){
        type_feature.checked = true;
    }
    else{
        type_bug.checked = true;
    }
}

