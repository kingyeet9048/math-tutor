<!DOCTYPE html>
<html>
    <Head>
    <link rel="stylesheet" href="gamepage.css">
    </Head>
<body>
<!DOCTYPE html>
<html>
<body>

<div class="contentBorder">

<h1>Question 1</h1>

  <p>What in the sweet fuck is 2 + 2, kiddo?</p>

  <label for="Question">Choose your answer below.</label>

  <br><br>

  <input type="radio" id="answerA" name="Question 1" value="Answer A">
  <label for="Answer A">5</label>

    <br>

  <input type="radio" id="answerB" name="Question 1" value="Answer B">
  <label for="Answer B">4</label>

    <br>

  <input type="radio" id="answerC" name="Question 1" value="Answer C">
  <label for="Answer C">6</label>

    <br>

  <input type="radio" id="answerD" name="Question 1" value="Answer D">
  <label for="Answer D">Pick B, you absolute fucking retard</label>

    <br><br>

  <div class="sumbitbtn">

  <button type="submit" class="submitbtn">Submit Answer!</button>

  </div>

</form>

</div>

<script>
    var question = "What is 2+2?"; //string
    var options = {"1","22","4","8"}; //array of strings
    var answer = 2; //int (index from options)
  // processRequest("../php/getQuestion.php", {}).then((final) => {
  //     if (final) {
  //       if (final.error) {
  //         alert(final.error);
  //       }
  //       else if (final.success) {
  //         var question = final.question; //string
  //         var options = final.options; //array of strings
  //         var answer = final.answer; //int (index from options)
  //       }
  //       else {
  //         alert("update failed. Please try again later");
  //       }
  //     }
  //   });

    
</script>

</body>
</html>
