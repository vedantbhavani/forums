<h2 class="text-center my-3">iDiscuss - Browse Categories</h2>
<div class="row">
    <?php
    $sql = "SELECT * FROM `categories` ";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $id = $row['category_id'];
        $images_card = $row['category_image'];
        $name_card = $row['category_name'];
        $desc_card = $row['category_description'];
        echo '
            <div class="col-md-4 my-3">
                <div class="card" style="width: 18rem; height: 70vh">'?>
                    <img src="uploded_images/<?php echo $images_card ?>" class="card-img-top" style="width: 100%; height: 190px;" alt="">
                    <?php 
                    echo '
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold">'.$name_card.'</h5>
                        <code class="card-text text-dark card_desc d-block" style="height:15vh ">'. $desc_card .'</code>
                        <a href="threadlist.php?catid='. $id .'" class="btn mt-4 btn-primary">View Threads</a>
                    </div>
                </div>
            </div>
        ';
    }
    ?>
</div>
<script>
    let desc = document.querySelectorAll('.card_desc')
    console.log(desc[9]);
    for(let i = 0; i < desc.length; i++){
        desc[i].innerHTML.length > 120 ? desc[i].innerHTML = desc[i].innerHTML.slice(0,120)+"..." : desc[i].innerHTML;
    }
</script>