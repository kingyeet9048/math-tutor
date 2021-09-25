<!DOCTYPE html>
<html>
    <script src="../javascript/skills.js"></script>
    <!-- Get absolute path for the header -->
    <?php 
        $root = "../../";               // directory from where to start search
        $toSearch1 = 'head.php';   // basename of the file you wish to search
        $toSearch2 = 'footer.php';   // basename of the file you wish to search
        $toSearch3 = 'navigation_bar.php';   // basename of the file you wish to search
        $footer = "";
        $navbar = "";
        $currentPath = __DIR__;
        $it = new RecursiveDirectoryIterator($root);
        foreach(new RecursiveIteratorIterator($it) as $file){
            if($file->getBasename() === $toSearch1){
                include($file->getRealPath());
            }
            if($file->getBasename() === $toSearch2) {
                $footer = $file->getRealPath();
            }
            if ($file->getBasename() === $toSearch3) {
                $navbar = $file->getRealPath();
            }
        }
        chdir($currentPath);
    ?>
    <script>
        isTeacher().then((result) => {
            if (!result) {
                window.location.href = "access_denied.php"
            }
        });
    </script>
    <body>
        <div id="main-container">
            <?php include($navbar); ?>
            <div class="row mb-3">
                <div class="col d-flex justify-content-center">
                    <div class="card" style="width: 30rem;">
                        <img src="../img/tech-education.jpeg" class="card-img-top" alt="Technology Education Image">
                        <div class="card-body">
                            <h5 class="card-title">Welcome to the Course Teaching Section Educators</h5>
                            <p class="card-text">
                                Below are options to modify or add a class to teach. Due to our current budget,
                                we cannot allow teachers to be assigned to more than one course at time. We applogize for 
                                the inconvienance this may bring. 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <div class="card" style="width: 30rem;">
                        <div id="card">
                        </div>
                        <!-- <img src="..." class="card-img-top" alt="..."> -->
                        <div class="card-body">
                            <h5 id="modifyCourse" class="card-title"></h5>
                            <form id="form">
                                <div id="container" class="form-group">

                                </div>
                                <!-- Large modal -->
                                <button id="classQuestions" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-custom-modal-lg" onclick="customSkills();">Custom Skills</button>
                                <button id="customQuestions" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-class-modal-lg" onclick="classSkills();">Class Skills</button>

                                <div class="modal fade bd-class-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content d-flex justify-content-center">
                                            <div id="addQuestion" class="list-group">
                                                    <a id="plusButton" class="list-group-item list-group-item-action active" aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h5 class="mb-1">Add a question?</h5>
                                                            <span id="close-icon2" class="badge clickable"><i class="fa fa-plus"></i></span>
                                                        </div>
                                                    </a>
                                                    <!-- <div class="list-group-item">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h5 class="mb-1">Add a question?</h5>
                                                            <input type="text" placeholder="Question Number" name="questionNumber" required>
                                                            <select></select>
                                                            <span id="close-icon1" class="badge clickable" style="color: red;"><i class="fa fa-times"></i></span>
                                                        </div>
                                                    </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade bd-custom-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content d-flex justify-content-center">
                                            <div id = "addCustomQuestions" class="list-group">
                                                    <a id="customPlusButton" class="list-group-item list-group-item-action active" aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h5 class="mb-1">Custom Questions?</h5>
                                                            <span id="close-icon2" class="badge clickable"><i class="fa fa-plus"></i></span>
                                                        </div>
                                                    </a>
                                                <!-- <div class="list-group-item">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h5 class="mb-1">Add a question?</h5>
                                                        <span id="close-icon1" class="badge clickable" style="color: red;"><i class="fa fa-times"></i></span>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button id="submitButton" type="button" onclick="" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include($footer); ?>
            <script src="../javascript/course_teaching_manager.js"></script>
        </div>
    </body>
</html>

