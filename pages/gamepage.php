<!DOCTYPE html>
<html>

<?php include('components/head.php') ?>


<body>
  <!DOCTYPE html>
  <html>

  <body>
  <?php include("components/navigation_bar.php") ?>

    <div class="contentBorder">
      <h1 id="questionNum"></h1>
      <p id="questionName"></p>
      <label for="Question">Choose your answer below.</label>
      <br><br>
      <input type="radio" id="answerA" name="question" value="Answer A">
        <label name="questionLabel" for="Answer A">..</label>
      <br>
      <input type="radio" id="answerB" name="question" value="Answer B">
        <label name="questionLabel" for="Answer B">..</label>
      <br>
      <input type="radio" id="answerC" name="question" value="Answer C">
        <label name="questionLabel" for="Answer C">..</label>
      <br>
      <input type="radio" id="answerD" name="question" value="Answer D">
        <label name="questionLabel" for="Answer D">..</label>
      <br><br>
      <div class="sumbitbtn">
        <button type="button" id="submitbutton" class="submitbtn" onclick="onAnswer();">Submit Answer!</button>
      </div>
      </form>
    </div>
    <script  type="text/javascript" src="../javascript/gamepage.js"></script>
    <?php include("components/footer.php") ?>

  </body>

  </html>