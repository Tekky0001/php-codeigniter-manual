<h2><?=$title?></h2>
<?php //print_r($complaint_posts);
    $temp_id = '';
?>
<?php foreach($complaint_posts as $complaint_post){
    if($complaint_post['id']!= $temp_id){
        //use id to check if the card has been created
        //if card had created then closing the div tag of class card
        if($temp_id!=''){?>
                </div>
            </div>
        </div>
        <?php }?>
        <div class="card">
            <div class="card-header"><?php echo $complaint_post['title'];?></div>
            <div class="row card-body">
                <div class="col-md-12">

                    <a class="btn btn-primary d-inline-block mb-2" href="<?php echo base_url(). 'posts/viewfile/'.$complaint_post['upload_file'];?>" target="_blank">VIEW PDF</a>

                    <small class="post-date d-block">Complained on: <?php echo $complaint_post['complain_time']." by ".$complaint_post['username'];?></small><br>
                    <p class="card-text pl-4 "><?php echo $complaint_post['description']?></p>
                    <?php $temp_id = $complaint_post['id'];?>
                
    <?php }
    //if the complaint_post id is the same with the previous complaint_post
    //just add the comment into the card body
    else if($complaint_post['id']==$temp_id){?>
                    <br>
                    <small class="post-date d-block">Complained on: <?php echo $complaint_post['complain_time']." by ".$complaint_post['username'];?></small><br>
                    <p class="card-text pl-4 "><?php echo $complaint_post['description']?></p>
                    <?php $temp_id = $complaint_post['id'];?>
    <?php }?>

<?php }?>
