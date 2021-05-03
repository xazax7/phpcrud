<?php
require_once "config.php";

//Define variables
$title = $year = $rating = $note = "";
$title_err = "";

//Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter the movie title.";
    } else {
        $title = $input_title;
    }

    //Validate rating
    $input_rating = trim($_POST["rating"]);
    if(!ctype_digit($input_rating)){
        $input_rating = "Please enter a valid rating of 1-5.";
    } else {
        $rating = $input_rating;
    }
    //Need to check if the rating is >= 0 and <=5

    // No validation on these (yet)
    $input_year = trim($_POST["year"]);
    $year = $input_year;
    $input_note = trim($_POST["note"]);
    $note = $input_note;
    

    //Check input errors before inserting in database
    if(empty($title_err)){
        //Prepare an insert statement
        $sql = "INSERT INTO movies (title, year, rating, note) VALUES (?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            //bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_title, $param_year, $param_rating, $param_note);

            //set parameters
            $param_title = $title;
            $param_year = $year;
            $param_rating = $rating;
            $param_note = $note;

            if(mysqli_stmt_execute($stmt)){
                //Records created succesfully, redirect to index
                header("location: index.php");
                exit();
            } else {
                echo "Error";
            }
        }

        //Close statement
        mysqli_stmt_close($stmt);
    }
    //close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<?php include 'header.php' ?>
<div class="container col-md-6">
        <h2>Add Movie Data</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
            <span class="invalid-feedback"><?php echo $title_err;?></span>
        </div>
        <div class="form-group">
            <label>Year</label>
            <input type="text" name="year" class="form-control" value="<?php echo $year; ?>">
        </div>
        <div class="form-group">
        <label>Rating</label>
            <input type="text" name="rating" class="form-control" value="<?php echo $rating; ?>">
        </div>

        <div class="form-group">
        <label>Note:</label>
            <input type="text" name="note" class="form-control" value="<?php echo $note; ?>">
        </div>

        <input type="submit" class="btn btn-primary" value="Submit" />
        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>
        </div>
</body>
</html>