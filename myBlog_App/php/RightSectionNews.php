<section class="rightNews">
    <div class="publicBox card grey lighten-4">
        <div class="card-content">
            <span class="card-title orange-text text-darken-4">Outstanding News</span>
            <?php
            $query = "SELECT Post_ID, Post_Title FROM T_Posts WHERE Post_Status = 1 ORDER BY Post_Date desc LIMIT 6";
            #execute the query
            $rs2 = mysqli_query($conn,$query);
            while ($row2 = mysqli_fetch_array($rs2) ) {
            ?>
                <div class="rightNewsLinks"><a href="DetailPost.php?postId=<?php echo($row2["Post_ID"]); ?>">- <?php echo($row2["Post_Title"]); ?> </a></div>
            <?php
            }
            ?>  
        </div>
        <div class="card-action">
            <a href="#"><span class="contactMeLink">View More</span></a>
        </div>
    </div>
</section>