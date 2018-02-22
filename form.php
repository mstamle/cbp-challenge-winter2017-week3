<?php
// Page #1 - the form
// Create a form to be able to fill in all the necessary data for your data item (eg. a pole move). Make sure to use proper field types for different types of data.
// Make sure that the form is sent using the POST method. (We)
// For the easiest solution let the form submit to the same page that it is on. (We)
// Create a php script (at the top of this file) that would handle the form's submission in the following way:
// Retrieve all the sent data from $_POST array (We)
// Insert the sent data under appropriate keys into a new array. (We)
// Make sure that one of the pieces of data is inserted with the key 'name'. This is important. (We)
// Pass the new array to the insert_data function from lib/data-functions.php (Tu, We)
// Use the retrieved data as values in the form. (We)

$pdo = new PDO(
    'mysql:host=localhost;dbname=polemoves','root', 'rootroot'
  );


  if (count($_POST) > 0)
  {
    $name = filter_input(INPUT_POST, 'name');
    $difficulty = filter_input(INPUT_POST, 'difficulty');
    $isLearnt = filter_input(INPUT_POST,'isLearnt');
    $imgLink = filter_input(INPUT_POST, 'imgLink');
    $description = filter_input(INPUT_POST, 'description');

    if (!$name || !$imgLink)
    {
        header('Location: ?success=no');
    } else {
        //future INSERT into bookings table
        $statement = $pdo->prepare('INSERT INTO `polemoves`(`name`, difficulty, isLearnt, imgLink, `description` ) VALUES (?     , ?         , ?       ,?       ,?)');
        $result = $statement->execute([$name, $difficulty, $isLearnt,$imgLink,$description]);
        //update the polemoves table
        header('Location: ?success=yes');
    }

  }

  $success = filter_input(INPUT_GET, 'success');


  ?>
  <form method="post">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Name of move">
    </div>
    <div class="form-group">
      <label for="difficulty">Difficulty</label>
      <input type="text" name="difficulty" class="form-control" id="difficulty" placeholder="1">
    </div>
    <!-- <div class="form-group">
    <label for="difficulty">Difficulty</label>
    <select class="form-control" id="difficulty">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
    </div> -->
    <div class="form-group">
      <label for="imgLink">Link to img</label>
      <input type="text" name="imgLink" class="form-control" id="imgLink" placeholder="https://">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input type="text" name="description" class="form-control" id="description" placeholder="How to perform the move:">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
