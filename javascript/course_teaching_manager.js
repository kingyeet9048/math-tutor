processRequest("../php/isTeachingCourse.php", {}).then((result) => {
    if (result.error) {
        alert('Error - ' + result.error);
    }
    else {
        var parentContainer = document.getElementById('container');
        var courseLabel = document.createElement('label');
        // Course Name
        courseLabel.innerHTML = "Course Name";
        courseLabel.className = "mb-2";
        var courseInput = document.createElement('input');
        courseInput.type = "text";
        courseInput.id = "courseInput";
        courseInput.className = "form-control mb-2";
        parentContainer.appendChild(courseLabel);
        parentContainer.appendChild(courseInput);

        // Course Level
        var courseLevelLabel = document.createElement('label');
        courseLevelLabel.innerHTML = "Course Level";
        courseLevelLabel.className = "mb-2";
        var courseLevelInput = document.createElement('select');
        courseLevelInput.id = "SelectCourseLevel";
        courseLevelInput.className = "form-control mb-2";
        var option = document.createElement('option');
        option.value = 'k-1st';
        option.text = 'k-1st';
        courseLevelInput.appendChild(option);
        parentContainer.appendChild(courseLevelLabel);
        parentContainer.appendChild(courseLevelInput);

        var form = document.getElementById('form');
        var deleteButton = document.createElement('button');
        deleteButton.id = 'deleteButton';
        deleteButton.type = 'button';
        deleteButton.className = "btn btn-danger";
        deleteButton.innerHTML = "Delete Course";
        function deleteCourseT() {
            processRequest("../php/deleteCourse.php", {}).then((result) => {
                if (result.error) {
                    alert('Error - ' + result.error);
                }
                else {
                    var alert = document.createElement('div');
                    alert.className = "alert alert-success alert-dismissible fade show";
                    alert.role = "alert";
                    document.getElementById('card').appendChild(alert);
                    setTimeout(() => {
                        $('.alert').alert('close');
                    }, 1000);
                    if (result.success) {
                        alert.innerHTML = "Successfully deleted your course.";
                        document.getElementById('submitButton').innerHTML = "Add";
                        submitButton.onclick = add;
                        courseInput.value = "";
                        form.removeChild(deleteButton);
                        document.getElementById('customQuestions').disabled = true;
                        document.getElementById('classQuestions').disabled = true;
                    }
                    else {
                        alert.className = "alert alert-warning alert-dismissible fade show"
                        alert.innerHTML = "Failed deleted your course.";
                    }
                }
            });
        }
        function send() {
            processRequest("../php/modifyCourseName.php", {'courseName': courseInput.value}).then((result) => {
                if (result.error) {
                    alert('Error - ' + result.error);
                }
                else {
                    var alert = document.createElement('div');
                    alert.className = "alert alert-success alert-dismissible fade show";
                    alert.role = "alert";
                    document.getElementById('card').appendChild(alert);
                    setTimeout(() => {
                        $('.alert').alert('close');
                    }, 1000);
                    if (result.success) {
                        alert.innerHTML = "Successfully modified your course information.";
                    }
                    else {
                        alert.className = "alert alert-warning alert-dismissible fade show"
                        alert.innerHTML = "Failed to modify your course information.";
                    }
                }
            });
        }
        function add() {
            processRequest("../php/addCourse.php", {'courseName': courseInput.value}).then((result) => {
                if (result.error) {
                    alert('Error - ' + result.error);
                }
                else {
                    var alert = document.createElement('div');
                    alert.className = "alert alert-success alert-dismissible fade show";
                    alert.role = "alert";
                    document.getElementById('card').appendChild(alert);
                    setTimeout(() => {
                        $('.alert').alert('close');
                    }, 1000);
                    if (result.success) {
                        alert.innerHTML = "Successfully added your course information.";
                        document.getElementById('submitButton').innerHTML = "Modify";
                        submitButton.onclick = send;
                        deleteButton.onclick = deleteCourseT;
                        form.appendChild(deleteButton);
                        document.getElementById('customQuestions').disabled = false;
                        document.getElementById('classQuestions').disabled = false;
                    }
                    else {
                        alert.className = "alert alert-warning alert-dismissible fade show"
                        alert.innerHTML = "Failed to add your course information.";
                    }
                }
            });
        }
        var submitButton = document.getElementById('submitButton');
        if (result.success) {
            deleteButton.onclick = deleteCourseT;
            form.appendChild(deleteButton);

            document.getElementById('submitButton').innerHTML = "Modify";
            console.log(JSON.stringify(result));
            localStorage.setItem("courseInfo", JSON.stringify(result));
            courseInput.value = result.courseName;
            submitButton.onclick = send;
        }
        else {
            document.getElementById('customQuestions').disabled = true;
            document.getElementById('classQuestions').disabled = true;
            document.getElementById('submitButton').innerHTML = "Add";
            submitButton.onclick = add;
        }
    }
});
