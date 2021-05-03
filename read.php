<?php
// ***************************
// Single page to "read" data from database
// ***************************
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM movies WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                // Not sure why this is necessary...
                $title = $row["title"];
                $year = $row["year"];
                $rating = $row["rating"];
                $note = $row["note"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Movie Details</title>
</head>
<body>
<?php include 'header.php' ?>
<div class="wrapper">
    <div class="container col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5 mb-3">Movie Details</h1>
                    <div class="form-group">
                        <label>Title</label>
                        <p><b><?php echo $row["title"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Year</label>
                        <p><b><?php echo $row["year"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Rating</label>
                        <p><b><?php echo $row["rating"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Note</label>
                        <p><b><?php echo $row["note"]; ?></b></p>
                    </div>
                    <a href="index.php" class="btn btn-primary">Back</a>
                    
            </div>
        </div>
    </div>
</div>
</body>
</html>

<!-- ?php echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>'; ?>  -->


<!-- $title = $row["title"];
                $year = $row["year"];
                $rating = $row["rating"];
                $note = $row["note"];
                 -->