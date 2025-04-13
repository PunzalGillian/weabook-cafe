<?php require 'function.php'; ?>

<?php

    

    if(isset($_GET['Title'])){

        $title = urldecode($_GET['Title']);
        $counter = 1;
    } else {
        $title = $_POST['query'];
        $counter = 1;
    }
  
        
        
    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

    

    <?php $booksInfo = getInfo($title); ?>

    <?php
    
        foreach($booksInfo as $items){
            ?>
                <a href="info.php?Title=<?php echo urlencode($items['Title']);?>">
                <div>
           <?php   
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($items['Images']).'" height="400px"/>';
                    if($items['Availability'] == 1){
                        $status = "Available";
                    } else {$status = "Unavailable";}

         ?> 

                    <a><?php echo "<br>Title: ".$items['Title']."<br>"?></a>
                    <a><?php echo "Author: ".$items['Author'] ?></a>

                    <?php

                        foreach($booksInfo as $booksInfo){
                            if ($counter == 1){
                
                               echo '<br>Genre: '.$booksInfo['Genre'];

                               $counter++; 
                           } else {echo ", ".$booksInfo['Genre'];  } 


                        }
                    
                    ?>

                    <a><?php echo "<br>Volume: ".$booksInfo['Volumes']."<br>"?></a>
                    <a><?php echo "Status: ".$status."<br>"?></a>
                    


                </div>
            </a>

         <?php

                break;

        }
    
    
    ?>


</head>
<body>
    
</body>
</html>

