processRequest("../php/isStarIDTeacher.php", {}).then((result1) => {
    if (result1.error) {
        alert(result1.error);
    }
    else {
        // if teacher
        if (result1.isTeacher) {
            // get all students progress report
            processRequest("../php/teacherProgress.php", {}).then((result) => {
                if (result.error) {
                    alert(result.error);
                }
                else {
                    const numberOfStudents = result.students.length;
                    const parent = document.getElementById("content");
                    var newTable = document.createElement('table');
                    var newRow = document.createElement('tr');
                    var newStar = document.createElement('th');
                    newStar.id = 'star';
                    newStar.innerHTML = "StarID";
                    var newFirst = document.createElement('th');
                    newFirst.id = 'first';
                    newFirst.innerHTML = "First Name";
                    var newLast = document.createElement('th');
                    newLast.id = 'last';
                    newLast.innerHTML = "Last Name";
                    var newNum = document.createElement('th');
                    newNum.id = 'percent';
                    newNum.innerHTML = "Questions Completed";
                    newRow.appendChild(newStar);
                    newRow.appendChild(newFirst);
                    newRow.appendChild(newLast);
                    newRow.appendChild(newNum);
                    newTable.appendChild(newRow);
                    parent.appendChild(newTable);
                    for (var i = 0; i < numberOfStudents; i++) {
                        const tableRow = document.createElement('tr');
                        const starID = document.createElement('td');
                        starID.innerHTML = result.students[i].starID;
                        const firstName = document.createElement('td');
                        firstName.innerHTML = result.students[i].firstName;
                        const lastName = document.createElement('td');
                        lastName.innerHTML = result.students[i].lastName;
                        const percentCompleted = document.createElement('td');
                        percentCompleted.innerHTML = result.students[i].numComplete;
                        tableRow.appendChild(starID);
                        tableRow.appendChild(firstName);
                        tableRow.appendChild(lastName);
                        tableRow.appendChild(percentCompleted);
                        newTable.appendChild(tableRow);
                    }
                }
            });
        }
        //if student
        else {
            //get one students progress report
            processRequest("../php/getStudentProgress.php", {}).then((student) => {
                if (student.error) {
                    alert(student.error);
                }
                else {
                    if (student.success) {
                        const parent = document.getElementById("content");
                        var progressContainer = document.createElement('div');
                        progressContainer.className = "progress mb-4";
                        var progressChild = document.createElement('div');
                        progressChild.className = "progress-bar";
                        progressChild.ariaRoleDescription = "progressbar";
                        progressChild.style = "width: 100%";
                        progressChild.ariaValueNow = student.progress;
                        progressChild.ariaValueMin = 0;
                        progressChild.ariaValueMax = 100;
                        progressChild.innerHTML = student.progress + "%";
                        progressContainer.appendChild(progressChild);
                        parent.appendChild(progressContainer);
                    }
                }
            });
        }
    }
});