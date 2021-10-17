<?php
  require_once("navbar.php");
?>  
 <!-- Page content-->
    <div class="container mt-5 m">
        <div class="row">
            <div class="col-lg-12">
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header"><?= $masseges["Write Your Post .."] ?> </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="create_post.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="inputAddress"><?= $masseges["Title Post"] ?></label>
                                    <input type="text" name="post_title" class="form-control mb-2" id="inputAddress"></br>
                                    <input type="file" name="img_post" class="form-control mb-2"> </br>
                                    <label for="inputAddress2"><?= $masseges["Write Post"] ?></label>
                                    <textarea name="post_body" class="form-control mb-2" id="inputAddress2" rows="5"> </textarea>
                                </div>
                                <button type="submit" class="btn btn-primary"><?= $masseges["POST"] ?></button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Side widget-->
                <!-- Post content-->
                <article>
                    <?php

                    if($user["role"] != "admin") $status_cond = "statues = 'approved'"  ;
                    else $status_cond = "statues in ('approved' ,'pending')" ;

                    $qyr = "SELECT po.id,po.post_title,po.post_body,po.image_post, po.created_by, po.created_at,po.statues,us.name FROM posts po join users us on (us.id = po.created_by) where $status_cond  order by po.created_at desc;";
                    require_once("config.php");
                    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PASSWORD, DB_NAME, DB_PORT);
                    $rslt = mysqli_query($cn, $qyr);
                    while($post=mysqli_fetch_assoc($rslt)){
                    ?>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1"><?=$post['post_title'];?></h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posted on <?=$post['created_at'];?> by <?=$post['name'];?></div>
                        <!-- Post categories-->
                        <?php
                        if ( $user["role"] == "admin" && $post["statues"] != "approved"){
                            ?>
                            <a class="badge bg-success text-decoration-none link-light p-2" href="action_post.php?post_id=<?=$post['id']?>&action=approved"><?= $masseges["Approve"] ?></a>
                            <a class="badge bg-danger text-decoration-none link-light p-2" href="action_post.php?post_id=<?=$post['id']?>&action=rejected"><?= $masseges["Reject"] ?></a>
                            <?php 
                         }
                        else{
                         if ($user["id"] == $post['created_by'] || $user["role"] == "admin"){
                        ?>
                        <a class="badge bg-danger text-decoration-none link-light p-2" href="delete_post.php?post_id=<?=$post['id']?>"><?= $masseges["DELETE"] ?>
                       </a>
                        <?php 
                        }
                         if ($user["id"] == $post['created_by']){
                        ?>
                        <a class="badge bg-primary text-decoration-none link-light p-2" href="edit_post.php?post_id=<?=$post['id']?>"><?= $masseges["EIDIT"] ?>
                        </a>
                       <?php 
                        }
                        }
                        ?>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4 row justify-content-center"><img class="img-fluid rounded" src="<?=$post['image_post'];?>" alt="..." /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-0"><h3>
                        <?=$post['post_title'];?>
                        </h3>
                        </p></br>
                <!-- start rate code -->
                 <div class="rate" >
                   <input type="radio" id="star5" name="rate" value="5" />
                   <label for="star5" title="text">5 stars</label>
                   <input type="radio" id="star4" name="rate" value="4" />
                   <label for="star4" title="text">4 stars</label>
                   <input type="radio" id="star3" name="rate" value="3" />
                   <label for="star3" title="text">3 stars</label>
                   <input type="radio" id="star2" name="rate" value="2" />
                   <label for="star2" title="text">2 stars</label>
                   <input type="radio" id="star1" name="rate" value="1" />
                   <label for="star1" title="text">1 star</label>
                 </div>  
                 <!--end rate code -->
                    </section>
                    
                </article>
                <!-- Comments section-->
                <section class="mb-5 ">
                    <div class="card bg-light">
                        <div class="card-body">
                            <!-- Comment form-->
                            <form class="mb-4"><textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea></form>
                            <!-- Comment with nested comments-->
                            <div class="d-flex mb-4">
                                <!-- Parent comment-->
                                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                <div class="ms-3">
                                    <div class="fw-bold">Commenter Name</div>
                                    If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                                    <!-- Child comment 1-->
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">Commenter Name</div>
                                            And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                        </div>
                                    </div>
                                    <!-- Child comment 2-->
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">Commenter Name</div>
                                            When you put money directly to a problem, it makes a good headline.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single comment-->
                            <div class="d-flex">
                                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                <div class="ms-3">
                                    <div class="fw-bold">Commenter Name</div>
                                    When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                    <?Php
                    };
                    mysqli_close($cn);
                    ?>

                
            </div>
        </div>
    </div>

    <?php
    require_once("footer.php");
    ?>