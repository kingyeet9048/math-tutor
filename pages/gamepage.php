<!DOCTYPE html>
<html>

<?php include('components/head.php') ?>


<body>
  <!DOCTYPE html>
  <html>

  <body>
  <?php include("components/navigation_bar.php") ?>

    <div class="contentBorder">
      <h1 id="questionNum">Question 1</h1>
      <p id="questionName">What in the sweet fuck is 2 + 2, kiddo?</p>
      <label for="Question">Choose your answer below.</label>
      <br><br>
      <input type="radio" id="answerA" name="question" value="Answer A">
        <label name="questionLabel" for="Answer A">5</label>
      <br>
      <input type="radio" id="answerB" name="question" value="Answer B">
        <label name="questionLabel" for="Answer B">4</label>
      <br>
      <input type="radio" id="answerC" name="question" value="Answer C">
        <label name="questionLabel" for="Answer C">6</label>
      <br>
      <input type="radio" id="answerD" name="question" value="Answer D">
        <label name="questionLabel" for="Answer D">Pick B, you absolute fucking retard</label>
      <br><br>
      <div class="sumbitbtn">
        <button type="submit" class="submitbtn">Submit Answer!</button>
      </div>
      </form>
    </div>
    <script  type="text/javascript" src="../javascript/gamepage.js"></script>
    <?php include("components/footer.php") ?>

  </body>

  </html>