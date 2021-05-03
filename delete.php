<?php
require_once "config.php";


// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){

    require_once "config.php";
    
    //Prepare a delete statement
    $sql = "DELETE FROM movies WHERE id = ?";
    

    if($stmt = mysqli_prepare($link, $sql)){
        //Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_POST["id"]);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            //Records deleted successfully, return to index page
            header("location: index.php");
            exit();
        } else {
            // Not sure what produces this error...
            echo "Error...";
        }
    } 
    
    //Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    //Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        //If url doesn't contain id parameter, send to error page
        header("location: error.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'header.php' ?>
<div class="wrapper">
        <div class="container col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Data</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this movie data?</p>
                            <?php include('readScript.php'); 
                            echo '<div class="p-3 m-3 shadow">';
                                echo '<div class="form-group">
                                <label>Title</label>
                                <p><b>'.$title.'</b></p>
                            </div>';
                            echo '<div class="form-group">
                            <label>Year</label>
                            <p><b>'.(!empty($year) ? $year : '').'</b></p></div>';
                            echo '<div class="form-group">
                            <label>Rating</label>
                            <p><b>'.(!empty($rating) ? $rating : '').'</b></p></div>';
                            echo '<div class="form-group">
                            <label>Note</label>
                            <p><b>'.(!empty($note) ? $note : '').'</b></p></div>';
                            echo '</div>';                            
                            ?>
                            <p>
                                <input type="submit" value="Delete" class="btn btn-danger">
                                <a href="index.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>