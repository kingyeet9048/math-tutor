<<<<<<< Updated upstream
alert("hi");
=======
>>>>>>> Stashed changes
var questions = [];

// processRequest("../php/getQuestions.php", {}).then((result) => {
//     if (result) {
//       if(result.success) {
//           window.location.href = "home.php";
//       }
//       else if (result.error) {
//         alert('Error - ' + result.error);
//       }
//       else {
//         alert('Something went wrong during sign up. Please try again.');
//       }
//     }
//   });
processRequest("../php/getQuestions.php", {}).then((result) => {
<<<<<<< Updated upstream
    alert("hiii");
    if (result) {
        alert("hi");
=======
    if (result) {
>>>>>>> Stashed changes
    if (result.error) {
        alert(result.error);
    }
    else if (result.success) {
<<<<<<< Updated upstream
        alert("hi2");
        var questionsRaw = result.questions;

        for(var i = 0; i < questionsRaw.length; ++i)
        {
        if(questionsRaw[i].isOverride == false)
        {
            questions.push(questionsRaw[i].questionType);
        }
        }
        
    }
    else {
        alert("update failed. Please try again later");
    }
    }
});

var curQuestion = -1;
alert("ques = "+curQuestion);
function syncQuestion()
{
    ++curQuestion;
    var question = "What is 2+2?"; //string
    var options = ["1","22","4","8"]; //array of strings
    var correctAnswer = 2; //int (index from options)

    processRequest("../php/genQuestion.php", {'questionType': questions[curQuestion]}).then((final) => {
    if (final) {
        if (final.error) {
        alert(final.error);
        }
        else 
        {
        alert("Question found!"+final.answer);
        document.getElementByName("questionNum").innerHTML = "Question " + (curQuestion+1);
        document.getElementByName("questionName").innerHTML = final.question+1;

        var radios = document.getElementsByName('question');
        for(var i = 0; i < final.options.length; ++i)
        {
            radios[i].innerHTML = final.options[i];
        }
        }
    }
    });

    var radios = document.getElementsByName('question');
    var selAnswer = -1;//if -1 none selected
    for (var i = 0, length = radios.length; i < length; i++) {
    if (radios[i].checked) {
        selAnswer = i;
        // only one radio can be logically checked, don't check the rest
        break;
    }
    }
    //Source: https://stackoverflow.com/questions/9618504/how-to-get-the-selected-radio-button-s-value
    
    

}

// 
syncQuestion();
=======
            var questionsRaw = result.questions;
            var courseID = result.courseID;
            var studentStarID = result.studentStarID;
            var correctAnswer = -1;
            
            for(var i = 0; i < questionsRaw.length; ++i)
            {
            if(questionsRaw[i].isOverride == false)
            {
                questions.push(questionsRaw[i].questionType);
            }
            }
            
            var curQuestion = -1;
            function syncQuestion()
            {
                ++curQuestion;
                var question = "What is 2+2?"; //string
                var options = ["1","22","4","8"]; //array of strings
                // alert(questions.length);
                processRequest("../php/genQuestion.php", {'questionType': questions[curQuestion]}).then((final) => {
                if (final) {
                    if (final.error) {
                    alert(final.error);
                    }
                    else 
                    {
                    document.getElementById("questionNum").innerHTML = "Question " + (curQuestion+1) + " ("+final.typeLabel+")";
                    document.getElementById("questionName").innerHTML = final.question;
                    correctAnswer = final.answer;
                    var radios = document.getElementsByName('questionLabel');
                    for(var i = 0; i < final.options.length; ++i)
                    {
                        if(i == correctAnswer) {
                            radios[i].innerHTML = final.options[i] + " (Correct)";
                        }
                        else
                        {
                            radios[i].innerHTML = final.options[i];
                        }
                    }
                    }
                }
                });
                //Source: https://stackoverflow.com/questions/9618504/how-to-get-the-selected-radio-button-s-value
            }

            function onAnswer()
            {
                var radios = document.getElementsByName('question');
                var selAnswer = -1;//if -1 none selected
                for (var i = 0, length = radios.length; i < length; i++) {
                if (radios[i].checked) {
                    selAnswer = i;
                    // only one radio can be logically checked, don't check the rest
                    radios[i].checked = false;

                    break;
                }
                }

                if(selAnswer == correctAnswer)
                {
                    alert("Correct answer! Great work!");
                    processRequest("../php/addRecord.php", {'questionID': questionsRaw[curQuestion].questionID, 'courseID': courseID, 'studentStarID': studentStarID}).then((final) => {
                        if (final) {
                            if (final.error) {
                            alert(final.error);
                            }
                            else if(final.success == true)
                            {
                                alert("Next question...");
                                syncQuestion();
                            }
                        }
                    });
                }
                else{
                    alert("Incorrect answer, try again!");
                }
            }

            document.getElementById("submitbutton").onclick = onAnswer;

            // 
            syncQuestion();

        }
        else {
            alert("update failed. Please try again later");
        }
    }
});

>>>>>>> Stashed changes
