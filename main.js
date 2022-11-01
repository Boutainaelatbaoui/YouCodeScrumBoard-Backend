let type_feature = document.getElementById('task-type-feature');
let type_bug     = document.getElementById('task-type-bug');
let title_form   = document.getElementById("task-title");
let status_form  = document.getElementById("task-status");

function addTask(){
    document.getElementById('task-save-btn').style.display   = "block";
    document.getElementById('task-update-btn').style.display = "none";
    document.getElementById('task-delete-btn').style.display = "none";

    document.getElementById("invalid-title").style.display = "none";
    document.getElementById("invalid-status").style.display = "none";

    document.getElementById('form-task').reset();
}

function editTask(id){
    document.getElementById("task-id").value = id;

    document.getElementById('task-save-btn').style.display   = "none";
    document.getElementById('task-update-btn').style.display = "block";
    document.getElementById('task-delete-btn').style.display = "block";

    document.getElementById("invalid-title").style.display = "none";
    document.getElementById("invalid-status").style.display = "none";

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

document.getElementById("form-task").onsubmit = function (e){

    let title_valid = false;
    let status_valid = false;

    if (title_form.value !== "") {
        title_valid = true;
        document.getElementById("invalid-title").style.display = "none";
    }
    
    if (status_form.value !== "") {
        status_valid = true;
        document.getElementById("invalid-status").style.display = "none";
    }
    
    if (title_valid === false) {
        e.preventDefault();
        document.getElementById("invalid-title").style.display  = "block";
        document.getElementById("invalid-status").style.display = "none";
    }

    if (status_valid === false) {
        e.preventDefault();
        document.getElementById("invalid-title").style.display  = "none";
        document.getElementById("invalid-status").style.display = "block";
    }

    if (status_valid === false && title_valid === false) {
        e.preventDefault();
        document.getElementById("invalid-title").style.display  = "block";
        document.getElementById("invalid-status").style.display = "block";
    }


}

