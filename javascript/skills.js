function customSkills () {
    isTeaching().then((result) => {
        // $('#close-icon1').on('click',function() {
        //     $(this).closest('.list-group-item').hide();
        // });
        // $('#close-icon2').on('click',function() {
        //     $(this).closest('.list-group-item').hide();
        // });
    });
}

function classSkills () {
    if (document.getElementsByClassName('holder')) {
        var holder = document.getElementsByClassName('list-group-item holder');
        console.log(holder.length);
        for (var i = 0; i < holder.length; i++) {
            // console.log(document.getElementById('closeButton'+i));
            document.getElementById('closeButton'+i).click();
        }
    }
    var skills = ['Recognizing numbers/Counting', 'Recognizing larger/smaller (more/less) – Using number line', 'Using number line to add, count and add up to 10, add more to make 10', 'Count and add up to 20, add 3 values up to 20', 'Vertical addition, find missing number to make 10/20', 'Horizontal addition, adding 3 values', 'Adding two-digit number (no carry), adding 2-digit number with carry'];
    isTeaching().then((result) => {
        function addAQuestion() {
            var parentContainer = document.getElementById('addQuestion');
            var newDiv = document.createElement('div');
            newDiv.className = "list-group-item holder";

            var newDiv2 = document.createElement('div');
            newDiv2.className = "d-flex w-100 justify-content-between";

            var input = document.createElement('input');
            input.type = "text";
            input.className = "form-control mb-2";
            input.value = parseInt(localStorage.getItem('questionLength'));
            input.disabled = true;

            var selectInput = document.createElement('select');
            selectInput.className = "form-control mb-2";
            for(var i = 0; i < skills.length; i++) {
                var option = document.createElement('option');
                option.value = i + 1;
                option.text = skills[i];
                selectInput.appendChild(option);
            }


            function sendRequest() {
                var courseName = document.getElementById('courseInput').value;
                var questionType = selectInput.options[selectInput.selectedIndex].value;
                var questionNumber = input.value;
                var isOverride = false;
                var starID = null;
                addQuestionButton.disabled = true;
            }
            var addQuestionButton = document.createElement('button');
            addQuestionButton.type = 'button';
            addQuestionButton.className = "btn btn-primary";
            addQuestionButton.innerHTML = "Send";
            addQuestionButton.onclick = sendRequest;


            var closeButton = document.createElement('span');
            closeButton.className = "badge clickable";
            closeButton.id = "closeButton"+(parseInt(localStorage.getItem('questionLength')) + 1);
            closeButton.style = "color: red;";
            var icon = document.createElement('i');
            icon.className = "fa fa-times";
            closeButton.appendChild(icon);
            function closeAndChange() {
                localStorage.setItem("questionLength", parseInt(localStorage.getItem('questionLength')) - 1);
                $(this).closest('.list-group-item').remove();
            }
            closeButton.onclick = closeAndChange;

            parentContainer.appendChild(newDiv);
            newDiv.appendChild(newDiv2);
            newDiv2.append(input);
            newDiv2.appendChild(selectInput);
            newDiv2.appendChild(addQuestionButton);
            newDiv2.appendChild(closeButton);
            localStorage.setItem("questionLength", parseInt(localStorage.getItem('questionLength')) + 1);
        }
        document.getElementById('plusButton').onclick = addAQuestion;
        if (result.questions) {
            localStorage.setItem('questionLength', (result.questions).length);
            for(var i = 0; i < result.questions.length; i++) {
                var parentContainer = document.getElementById('addQuestion');
                var newDiv = document.createElement('div');
                newDiv.className = "list-group-item holder";


                var newDiv2 = document.createElement('div');
                newDiv2.className = "d-flex w-100 justify-content-between";

                var input = document.createElement('input');
                input.type = "text";
                input.className = "form-control mb-2";
                input.value = result.questions[i].questionNumber;
                input.id = result.questions[i].ID;
                input.disabled = true;

                var selectInput = document.createElement('select');
                selectInput.className = "form-control mb-2";
                for(var j = 0; j < skills.length; j++) {
                    var option = document.createElement('option');
                    option.value = j + 1;
                    option.text = skills[j];
                    selectInput.appendChild(option);
                }
                selectInput.getElementsByTagName('option')[result.questions[i].questionType - 1].selected = 'selected';
                selectInput.disabled = true;

                var closeButton = document.createElement('span');
                closeButton.className = "badge clickable";
                closeButton.style = "color: red;";
                closeButton.id = "closeButton"+i;
                var icon = document.createElement('i');
                icon.className = "fa fa-times";
                closeButton.appendChild(icon);
                function closeAndChange() {
                    localStorage.setItem("questionLength", parseInt(localStorage.getItem('questionLength')) - 1);
                    $(this).closest('.list-group-item').remove();
                }
                closeButton.onclick = closeAndChange;

                parentContainer.appendChild(newDiv);
                newDiv.appendChild(newDiv2);
                newDiv2.append(input);
                newDiv2.appendChild(selectInput);
                newDiv2.appendChild(closeButton);
            }
            
        }
    });
}