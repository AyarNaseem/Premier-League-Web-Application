 <!-- <?php
    // $title = 'Heading 1';
    // $desc = 'lorem ipsum dolor sit amet, consectetur adipis';
    // $image = './image/ronaldo-item.jpg';

    // $sql = "INSERT INTO news (title, description, image) VALUES ('$title', '$desc', '$image')";

    // if (mysqli_query($conn, $sql)) {
        
    // } else {
    //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // }
?>  -->


<?php
    $title = 'Heading 7';
    $desc = 'lorem ipsum dolor sit amet, consectetur adipis';
    $image = './image/ronaldo-item.jpg';

    $sql = "SELECT * FROM news WHERE title='$title' AND description='$desc' AND image='$image'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // News already exists, do nothing or display a message
        // echo "News already exists!";
    } else {
        // Insert the news into the database
        $sql = "INSERT INTO news (title, description, image) VALUES ('$title', '$desc', '$image')";
        if (mysqli_query($conn, $sql)) {
            // News added successfully
            // echo "News added successfully!";
            //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        } else {
           // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>