processRequest("../php/isStarIDTeacher.php", {}).then((result) => {
    if (result.error) {
        alert(result.error);
    }
    else {
        // if teacher
        if (result.isTeacher) {
            // get all students progress report
            processRequest("../php/teacherProgress.php").then((result) => {
                // if (result.error) {

                // }
                // else {
                    const numberOfStudents = result.students.length;
                    const parent = document.getElementById("content");
                    for (var i = 0; i < numberOfStudents; i++) {
                        const tableRow = document.createElement('tr');
                        const starID = document.createElement('td');
                        starID.innerHTML = result.students[i].starID;
                        const firstName = document.createElement('td');
                        firstName.innerHTML = result.students[i].firstName;
                        const lastName = document.createElement('td');
                        lastName.innerHTML = result.students[i].lastName;
                        const percentCompleted = document.createElement('td');
                        percentCompleted.innerHTML = result.students[i].percent;
                        tableRow.appendChild(starID);
                        tableRow.appendChild(firstName);
                        tableRow.appendChild(lastName);
                        tableRow.appendChild(percentCompleted);
                        parent.appendChild(tableRow);
                    }
                // }
            });
        }
        //if student
        else {
            //get one students progress report
            
        }
    }
});