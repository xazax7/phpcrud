<?php
// ***************************
// Render Movie List items into HTML
// ***************************
while($row = mysqli_fetch_array($result)){
echo '<tr>';

//Id
echo '<td class="text-right">';
if($row['id']){
    echo $row['id'];
}else{
    echo '&nbsp;';
}
echo '</td>';

//Title
echo '<td><b>';
if ($row['title']){
    echo $row['title'];
} else {
    echo '&nbsp;';
}
echo '</b></td>';

//Year
echo '<td class="text-right">';
if ($row['year']){
    echo $row['year'];
} else {
    echo '&nbsp;';
}
echo '</td>';

//Rating
echo '<td class="text-primary text-center">';
if ($row['rating']){
    // Create as many full stars as the rating, with 5 stars total. Eg. "★★★☆☆"
    for ($x = 0; $x < 5; $x++){
        if($x < $row['rating']) {
        echo "<span class='glow-blue'>★</span>";
        } else{
            echo "☆";
        }
    }
    echo " <span class='text-secondary'>(".$row['rating'].")</span>";
} else {
    echo '&nbsp;';
}
echo '</td>';

//Note
echo '<td><span class="d-block text-truncate" title="'.$row['note'].'" data-toggle="tooltip" style=" width:200px;">';
if ($row['note']){
    echo $row['note'];
} else {
    echo '&nbsp;';
}
echo '</span></td>';

// View btn
echo '<td class="text-center">';
echo '<a href="read.php?id='. $row['id'] .'" title="View Record" class="mr-3" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';

// Update btn
echo '<a href="update.php?id='. $row['id'].'" title="Update Record" class="mr-3" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';

// Delete btn
echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';

echo '</td></tr>';
}

?>