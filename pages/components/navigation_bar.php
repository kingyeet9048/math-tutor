<div id="navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <div class="container-fluid">
            <a id="image" class="navbar-brand" href="">Math Tutor</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul id="parentList" class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a id="home" class="nav-link" href="">Home</a>
                </li>
                <li class="nav-item">
                    <a id="account" class="nav-link" href="">Account Information</a>
                </li>
                <li class="nav-item">
                    <a id="progress" class="nav-link" href="">Progress</a>
                </li>
                <li class="nav-item">
                    <a id="course" class="nav-link" href=""></a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
</div>
<script>
    isTeacher().then((result) => {
        if(!result) {
            document.getElementById("home").href = "home_student.php";
            document.getElementById("image").href = "home_student.php";
            document.getElementById("progress").href = "progress_student.php";
            document.getElementById("account").href = "account.php";
            document.getElementById("course").innerHTML = "Course Learning";
            document.getElementById("course").href = "course_student.php";
            var parent = document.getElementById("parentList");
            var node = document.createElement('li');
            node.classList.add('nav-item');
            var aTag = document.createElement('a');
            aTag.classList.add('nav-link');
            aTag.href = "editCourse_student.php";
            aTag.innerHTML = "Add or Remove a Course";
            node.appendChild(aTag);
            parent.appendChild(node);
        }
        else {
            document.getElementById("home").href = "home_teacher.php";
            document.getElementById("progress").href = "progress_teacher.php";
            document.getElementById("account").href = "account.php";
            document.getElementById("course").innerHTML = "Course Teaching";
            document.getElementById("course").href = "course_teaching.php";
        }
    });
</script>