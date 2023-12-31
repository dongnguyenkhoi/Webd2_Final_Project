
<?php

/*******w******** 
    
    Name: Khoi Dong
    Date: Sep 25
    Description: Final Project

****************/

require('connect.php');
if(isset($_GET['make_search']) && strlen($_GET['make_search']) != 0 ){
    $make_search = $_GET['make_search'];
    $query = "SELECT * FROM cars WHERE make LIKE '%$make_search%' LIMIT 5";
}
else{
    $query = "SELECT * FROM cars ORDER BY datepost DESC LIMIT 5";
}

$statement = $db->prepare($query);

$statement ->execute();
?>

<div class="container">
        <?php include('nav.php') ?>
        <header>
            <h1 class="display-6">WELCOME TO WINNIE CAR DEALERSHIP</h1>
        </header>    
        <a class="card-link" href="post.php">New Post</a>    
        <form  action="index.php" method="get">
            <div class="input-group my-3" style="max-width:20rem;">
                <input class="form-control" type="search" placeholder="search by make" name="make_search">
                <button class="btn btn-primary">Search</button>
            </div>
        </form>
        <?php if($statement ->rowCount() == 0):?>
                <li>No Car Listed</li>
                <?php endif?>

            <?php if($statement->rowCount() > 0):?>
                <div class="d-flex gap-2 flex-wrap">
                <?php while($row = $statement ->fetch()):?>
                    <div class="card" style="width: 18rem;">
                        <?php if(($row['image'])){ ?>
                            <img class="card-img-top" src="uploads/<?=($row['image'])?>" />
                        <?php } else { ?>
                            <img class="card-img-top" src="images/no_image.png" />
                        <?php } ?>
                        <div class="card-body">
                            <h5 class="card-title"><a href="show.php?id=<?=$row['id']?>"><?=$row['title']?></a></h5>
                            <p class="card-text"><?=substr($row['description'],0,90) ?>...</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Make: <?=($row['make']) ?></li>
                            <li class="list-group-item">Price: <?=($row['price']) ?> $CAN</li>
                            <li class="list-group-item">Posted at <?=$row['datepost']?> </li>
                        </ul>
                        <div class="card-body">
                            <a class="btn btn-primary" href="show.php?id=<?=$row['id']?>">Show <?=$row['title']?></a><br>
                            <a href="edit.php?id=<?=$row['id']?>" class="card-link">edit</a>    
                        </div>
                    </div>
                <?php endwhile ?>
                </div>
            <?php endif?>
            <?php include('footer.php') ?>
    </div>
    <ul>
    <?php if($statement->rowCount() > 0):?>
                <?php while($row = $statement ->fetch()):?>

                    <?php endwhile ?>
                    <?php endif?>
    </ul>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>