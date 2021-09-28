<div id="navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <div class="container-fluid">
            <a id="image" class="navbar-brand" href="home.php">Math Tutor</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul id="parentList" class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a id="home" class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a id="progress" class="nav-link" href="progress.php">Progress</a>
                </li>
                <li class="nav-item">
                    <a id="course" class="nav-link" href=""></a>
                </li>
                <li class="nav-item">
                    <a id="logout" class="nav-link" href="">Logout</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
</div>
<script>
    isTeacher().then((result) => {
        if(!result) {
            document.getElementById("course").innerHTML = "Course Learning";
            document.getElementById("course").href = "course_student.php";
        }
        else {
            document.getElementById("course").innerHTML = "Course Teaching";
            document.getElementById("course").href = "course_teaching.php";
        }
    });
</script>