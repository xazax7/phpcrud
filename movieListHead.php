<?php
// *******************
// Render movie list table headers
// *******************
            
// Table Headers start
echo '<thead class="thead-dark text-capitalize">';
echo '<tr>';

// Table Header values with their default ordering state
$sortOptions = array(
    array("id", "asc"),
    array("title","asc"),
    array("year","desc"),
    array("rating","desc"),
    array("note","asc"));

// Create Table Headers, and style them
foreach($sortOptions as &$value) {

    // Default Asc or Desc
    $thisAscDesc = $value[1];
    // Default asc/desc symbol styling
    $thisAscDescSymbol = '<span class="order-btn"><span class="text-secondary">▴</span><span class="text-secondary">▾</span></span>';

    // If this table header is currently being used to order
    if($value[0] == $order) { 
        // If the user is currently sorting by DESC, switch it to ASC when clicked
        if($sortAscDesc == "desc"){
            $thisAscDesc = "asc";
            $thisAscDescSymbol = '<span class="order-btn"><span class="text-secondary">▴</span><span class="text-white glow">▾</span></span>';
        //Reverse of above
        } elseif($sortAscDesc == "asc"){
            $thisAscDesc = "desc";
            $thisAscDescSymbol = '<span class="order-btn"><span class="text-white glow">▴</span><span class="text-secondary">▾</span></span>';
        } else{
            // Safety option
            $thisAscDesc = $value[1];
        }
    }

echo '<th><a class="text-white d-flex align-content-center justify-content-between" href="index.php?order='.$value[0].'&by='.$thisAscDesc.$keepParams.'">'.$value[0].$thisAscDescSymbol.'</a>'.'</th>';
}
// The last table header
echo '<th>Actions</th>';

// TABLE headers end
echo '</tr></thead>';
?>