function customSkills () {
    var courseID = document.getElementById('courseInput').value;
    // https://stackoverflow.com/questions/4777077/removing-elements-by-class-name
    // deleting everything inside the modal first..
    if (document.getElementsByClassName('customHolder')) {
        const elements = document.getElementsByClassName('customHolder');
        while(elements.length > 0){
            // console.log('deleting...');
            elements[0].parentNode.removeChild(elements[0]);
        }

    }
    var skills = ['Recognizing numbers/Counting', 'Recognizing larger/smaller (more/less) – Using number line', 'Using number line to add, count and add up to 10, add more to make 10', 'Count and add up to 20, add 3 values up to 20', 'Vertical addition, find missing number to make 10/20', 'Horizontal addition, adding 3 values', 'Adding two-digit number (no carry), adding 2-digit number with carry'];
    getStudentTeaching({"courseID" : courseID}).then((allStudents) => {

        isTeaching().then((result) => {
            function addAQuestion() {
                var parentContainer = document.getElementById('addCustomQuestions');
                var newDiv = document.createElement('div');
                newDiv.className = "list-group-item customHolder";
    
                var newDiv2 = document.createElement('div');
                newDiv2.className = "d-flex w-100 justify-content-between";
                
                var starIDInput = document.createElement('select');
                starIDInput.className = "form-control mb-2";
                for(var i = 0; i < allStudents.students.length; i++) {
                    var option = document.createElement('option');
                    option.value = allStudents.students[i].starID;
                    option.text = allStudents.students[i].firstName + " " + allStudents.students[i].lastName + " - " + option.value;
                    starIDInput.appendChild(option);
                }

                var input = document.createElement('input');
                input.type = "number";
                input.className = "form-control mb-2";
                input.value = 0;
                input.min = 0;
                input.max = 99;
    
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
                    var isOverride = true;
                    var starID = starIDInput.options[starIDInput.selectedIndex].value;
                    addQuestionButton.disabled = true;
                }
                var addQuestionButton = document.createElement('button');
                addQuestionButton.type = 'button';
                addQuestionButton.className = "btn btn-primary";
                addQuestionButton.innerHTML = "Send";
                addQuestionButton.onclick = sendRequest;
    
    
                var closeButton = document.createElement('span');
                closeButton.className = "badge clickable closeButton";
                closeButton.style = "color: red;";
                var icon = document.createElement('i');
                icon.className = "fa fa-times";
                closeButton.appendChild(icon);
                function closeAndChange() {
                    $(this).closest('.list-group-item').remove();
                }
                closeButton.onclick = closeAndChange;
    
                parentContainer.appendChild(newDiv);
                newDiv.appendChild(newDiv2);
                newDiv.appendChild(starIDInput);
                newDiv2.append(input);
                newDiv2.appendChild(selectInput);
                newDiv2.appendChild(addQuestionButton);
                newDiv2.appendChild(closeButton);
            }
            document.getElementById('customPlusButton').onclick = addAQuestion;
            if (result.questions) {
                for(var i = 0; i < result.questions.length; i++) {
                    if (!result.questions[i].isOverride)
                        continue;
                        var parentContainer = document.getElementById('addCustomQuestions');
                        var newDiv = document.createElement('div');
                        newDiv.className = "list-group-item customHolder";
            
                        var newDiv2 = document.createElement('div');
                        newDiv2.className = "d-flex w-100 justify-content-between";
                        
                        var starIDInput = document.createElement('select');
                        starIDInput.className = "form-control mb-2";
                        for(var i = 0; i < allStudents.students.length; i++) {
                            var option = document.createElement('option');
                            option.value = allStudents.students[i].starID;
                            option.text = allStudents.students[i].firstName + " " + allStudents.students[i].lastName + " - " + option.value;
                            starIDInput.appendChild(option);
                        }
                        starIDInput.disabled = true;
        
                        var input = document.createElement('input');
                        input.type = "number";
                        input.className = "form-control mb-2";
                        input.value = 0;
                        input.min = 0;
                        input.max = 99;
                        input.disabled = true;
            
                        var selectInput = document.createElement('select');
                        selectInput.className = "form-control mb-2";
                        for(var i = 0; i < skills.length; i++) {
                            var option = document.createElement('option');
                            option.value = i + 1;
                            option.text = skills[i];
                            selectInput.appendChild(option);
                        }
                        selectInput.disabled = true;
            
            
                        function sendRequest() {
                            var courseName = document.getElementById('courseInput').value;
                            var questionType = selectInput.options[selectInput.selectedIndex].value;
                            var questionNumber = input.value;
                            var isOverride = true;
                            var starID = starIDInput.options[starIDInput.selectedIndex].value;
                            addQuestionButton.disabled = true;
                        }
            
            
                        var closeButton = document.createElement('span');
                        closeButton.className = "badge clickable closeButton";
                        closeButton.style = "color: red;";
                        var icon = document.createElement('i');
                        icon.className = "fa fa-times";
                        closeButton.appendChild(icon);
                        function closeAndChange() {
                            $(this).closest('.list-group-item').remove();
                        }
                        closeButton.onclick = closeAndChange;
            
                        parentContainer.appendChild(newDiv);
                        newDiv.appendChild(newDiv2);
                        newDiv.appendChild(starIDInput);
                        newDiv2.append(input);
                        newDiv2.appendChild(selectInput);
                        newDiv2.appendChild(closeButton);
                }
            }
        });
    });
}

function classSkills () {
    // https://stackoverflow.com/questions/4777077/removing-elements-by-class-name
    // deleting everything inside the modal first..
    if (document.getElementsByClassName('holder')) {
        const elements = document.getElementsByClassName('holder');
        while(elements.length > 0){
            // console.log('deleting...');
            elements[0].parentNode.removeChild(elements[0]);
        }

    }
    var skills = ['Recognizing numbers/Counting', 'Recognizing larger/smaller (more/less) – Using number line', 'Using number line to add, count and add up to 10, add more to make 10', 'Count and add up to 20, add 3 values up to 20', 'Vertical addition, find missing number to make 10/20', 'Horizontal addition, adding 3 values', 'Adding two-digit number (no carry), adding 2-digit number with carry'];
    isTeaching().then((result) => {
        function addAQuestion() {
            //algorithm to find the lowest missing number
            // first find all values and put them into an array
            //https://www.geeksforgeeks.org/find-the-first-missing-number/
            const elements = document.getElementsByClassName('holder');
            let questionsArray = [];
            if (elements.length > 0) {
                for (let index = 0; index < elements.length; index++) {
                    let questionNumberInput = elements[index].childNodes[0].childNodes[0].value;
                    questionsArray.push(parseInt(questionNumberInput));
                }
            }
            // algorithm cannot work unsorted. 
            questionsArray.sort(function(a,b){return a-b});
            // Javascript program to find the smallest
            // elements missing in a sorted array.
            // uses the binary search technique
            // but modified to check with indeces
            // complexity O(logn)
            function findFirstMissing(array, start, end)
            {
                // if the starting index is greater
                // then the ending index, increase end
                // and return the new index
                if (start > end)
                    return end + 1;
        
                // if the start index is not actually
                // the starting number....
                if (start != array[start])
                    return start;
        
                // get middle
                let mid = parseInt((start + end) / 2, 10);
        
                // Left half has all elements from 0 to mid
                if (array[mid] == mid) {
                    return findFirstMissing(array, mid+1, end);
                }
        
                return findFirstMissing(array, start, mid);
            }

            const end = questionsArray.length == 0 ? 0 : Math.max(...questionsArray);
            const missingNumber = findFirstMissing(questionsArray, 0, end);
            var parentContainer = document.getElementById('addQuestion');
            var newDiv = document.createElement('div');
            newDiv.className = "list-group-item holder";

            var newDiv2 = document.createElement('div');
            newDiv2.className = "d-flex w-100 justify-content-between";

            var input = document.createElement('input');
            input.type = "text";
            input.className = "form-control mb-2";
            input.value = missingNumber;
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
            closeButton.className = "badge clickable closeButton";
            closeButton.style = "color: red;";
            var icon = document.createElement('i');
            icon.className = "fa fa-times";
            closeButton.appendChild(icon);
            function closeAndChange() {
                $(this).closest('.list-group-item').remove();
            }
            closeButton.onclick = closeAndChange;

            parentContainer.appendChild(newDiv);
            newDiv.appendChild(newDiv2);
            newDiv2.append(input);
            newDiv2.appendChild(selectInput);
            newDiv2.appendChild(addQuestionButton);
            newDiv2.appendChild(closeButton);
        }
        document.getElementById('plusButton').onclick = addAQuestion;
        if (result.questions) {
            for(var i = 0; i < result.questions.length; i++) {
                if (result.questions[i].isOverride)
                    continue;
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
                closeButton.className = "badge clickable closeButton";
                closeButton.style = "color: red;";
                var icon = document.createElement('i');
                icon.className = "fa fa-times";
                closeButton.appendChild(icon);
                function closeAndChange() {
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