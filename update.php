<?php
// ****************************************
// Update database entry page
// ****************************************


// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$title = $year = $rating = $note = "";
$title_err = $year_err = $rating_err = $note_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];

    // Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter a title.";
    } else{
        $title = $input_title;
    }
    // $input_title = trim($_POST["title"]);
    // $title = $input_title;
    
    $input_year = trim($_POST["year"]);
    $year = $input_year;

    $input_rating = trim($_POST["rating"]);
    $rating = $input_rating;

    $input_note = trim($_POST["note"]);
    $note = $input_note;
    
    
    // If no validation errors,
    if(empty($title_err)){
        $sql = "UPDATE movies SET title=?, year=?, rating=?, note=? WHERE id=?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssi", $param_title, $param_year, $param_rating, $param_note, $param_id);

            $param_title = $title;
            $param_year = $year;
            $param_rating = $rating;
            $param_note = $note;
            $param_id = $id;

            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);

        $sql = "SELECT * FROM movies WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $title = $row["title"];
                    $year = $row["year"];
                    $rating = $row["rating"];
                    $note = $row["note"];
                } else{
                    header("location: error.php");
                    exit();
                }
            } else{
                echo "Something went wrong...";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    } else{
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    </style>
</head>
<body>
<?php include 'header.php' ?>
<div class="wrapper">
        <div class="container col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Edit Movie Data</h2>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Title</label>
                            <input 
                            type="text" 
                            name="title" 
                            class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" 
                            value="<?php echo $title; ?>">
                            <span class="invalid-feedback"><?php echo $title_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Year</label>
                            <input name="year" class="form-control" value="<?php echo (!empty($year)) ? $year : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label>Rating</label>
                            <input type="text" name="rating" class="form-control" value="<?php echo (!empty($rating)) ? $rating : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea name="note" class="form-control"><?php echo $note; ?></textarea>
                            <span class="invalid-feedback"><?php echo $note_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Update">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                                    </form>
                    </div>
            </div>        
        </div>
    </div>
</body>
</html>
