let type_feature = document.getElementById('task-type-feature');
let type_bug     = document.getElementById('task-type-bug');
let title_form   = document.getElementById("task-title");
let status_form  = document.getElementById("task-status");
let priority_form = document.getElementById("task-priority");

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
    if (title_form.value === "") {
        e.preventDefault();
        document.getElementById("invalid-title").style.display  = "block";
    }

    if(priority_form.value === ""){
        e.preventDefault();
        document.getElementById("invalid-priority").style.display = "block";
    }

    if (status_form.value === "") {
        e.preventDefault();
        document.getElementById("invalid-status").style.display = "block";
    }


    if (title_form.value !== "" && priority_form.value !== "" && status_form.value !== "") {
        document.getElementById("invalid-title").style.display = document.getElementById("invalid-status").style.display = document.getElementById("invalid-priority").style.display = "none";
    }
}

