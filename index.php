<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .glow {
            text-shadow: 0px 0px 6px white;
        }
        * {
  box-sizing:border-box;
}



.form-filter {
    display:none;
}
        .order-btn span{
            display:block;
            line-height:1;
        }
        .order-btn {
            background:none;
            border:none;
            
        }
        .order-btn span {
            
            height:8px;
        }
        .order-btn .text-secondary {
            text-decoration:none!important;
        }
        .active{
            color:white;
        }
        th a:hover {
            text-decoration: none;
        }



    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
        
    </script>
</head>
<body>
<?php include 'header.php'; ?>
<?php 

require_once "config.php";

// ******************************
// SORTING + FILTERING
// ******************************
// Default ordering settings
$order = "id";
$sortAscDesc = "asc";
// To save the current filtering/ordering parameters
$keepParams = '';

// User is sorting by table header
if(isset($_GET["order"])) {
    $order = htmlspecialchars($_GET["order"]);
    // Check if URL has param "?by=", then check if the value is "asc" or "desc"
    if(isset($_GET["by"]) && ($_GET["by"] == "asc" || $_GET["by"] == "desc")) {
        // Grab the "asc" or "desc
        $sortAscDesc = htmlspecialchars($_GET["by"]);
    }
}

// User filters by year
if(isset($_GET["yfrom"])) {
    $yfrom = htmlspecialchars($_GET["yfrom"]);
    $keepParams = $keepParams.'&yfrom='.$yfrom;
} else{
    $yfrom = 0;
}
if(isset($_GET["yto"])) {
    $yto = htmlspecialchars($_GET["yto"]);
    $keepParams = $keepParams.'&yto='.$yto;
} else{
    $yto = 9999;
}

// User filters by rating
if(isset($_GET["ratingfrom"])) {
    $ratingfrom = htmlspecialchars($_GET["ratingfrom"]);
    $keepParams = $keepParams.'&ratingfrom='.$ratingfrom;
} else{
    $ratingfrom = 0;
}
if(isset($_GET["ratingto"])) {
    $ratingto = htmlspecialchars($_GET["ratingto"]);
    $keepParams = $keepParams.'&ratingto='.$ratingto;
} else{
    $ratingto = 5;
}

// User filters by title
$searchType = "contains";
if(isset($_GET["title"])) {
    $searchTitle = htmlspecialchars($_GET["title"]);
    $keepParams = $keepParams.'&title='.$searchTitle;
    if(isset($_GET["searchType"])){
        $searchType = htmlspecialchars($_GET["searchType"]);
        $keepParams = $keepParams.'&searchType='.$searchType;
        if ($searchType == "contains") {
            $searchTitleVal = '%'.$searchTitle.'%';
        } elseif($searchType == "exact") {
            $searchTitleVal = $searchTitle;
        } else{
            //Fallback
            $searchTitleVal = '%'.$searchTitle.'%';
        }
    } else{
        // If searchtype isn't set, default 'contains'
        $searchTitleVal = '%'.$searchTitle.'%';
    }
} else{
    $searchTitle = '';
    $searchTitleVal = '%%';
}

// User is sorting by note.
if(isset($_GET["note"])){
    $searchNote = htmlspecialchars($_GET["note"]);
    $keepParams = $keepParams.'&note='.$searchNote;
} else{
    $searchNote = '';
}

// Prepare sql select statement
$sql = "SELECT * FROM movies WHERE year >= $yfrom AND year <= $yto AND rating >= $ratingfrom AND rating <= $ratingto AND title LIKE '$searchTitleVal' AND note LIKE '%$searchNote%' ORDER BY if($order = '' or $order is null,1,0),$order $sortAscDesc";


// *****************
// Building page elements
// *****************

// Container holding FILTER OPTIONS and TABLE
echo '<div class="container-fluid row flex-wrap d-flex justify-content-around">';

// Filter options panel
include 'filterOptions.php';

// Right Column Container (ADD btn, TABLE)
echo '<div class="col-md-7">';
// ADD Data button
echo '<a href="create.php" class="btn btn-primary pull-right mb-3">Add Data</a>';


// TABLE start
echo '<table class="table table-sm table-striped table-bordered">';

// Movie list table head <thead></thead>
include 'movieListHead.php';

// If there is data found from the SQL select query
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0) {
            //Render the movie list
            include 'movieList.php';
        // Free memory when while loop is done
        mysqli_free_result($result);
    } else {
        // End of TABLE
        echo '</table>';
        // Error message
        echo '<p class="text-center">Database connected. No data found.<br><a href="index.php">Reset</a></p>';
        // End of Right Column
        echo '</div>';
    }
} else {
    // End of TABLE
    echo '</table>';
    // Error message
    echo '<p class="text-center">Error connecting to database.<br><a href="index.php">Reset</a></p>';
    // End of Right Column
    echo '</div>';
    
}

// End of row (row includes filter options and table)
echo '</div>';

//Close connection
mysqli_close($link);
?>
</body>
</html>
