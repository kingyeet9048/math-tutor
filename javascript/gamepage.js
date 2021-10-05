alert("hi");
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
    alert("hiii");
    if (result) {
        alert("hi");
    if (result.error) {
        alert(result.error);
    }
    else if (result.success) {
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
