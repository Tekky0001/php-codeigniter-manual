<h2><?= $title?></h2>
<?php foreach($posts as $post):?>
    <div class="card">
        <div class="card-header"><?php echo $post['title'];?></div>
        <div class="row card-body">
            <div class="col-md-12">
                <small class="post-date d-block">Posted on: <?php echo $post['created_at'];?> for <strong><?php echo $post['device']?></strong></small><br>
                <?php echo $post['body'];?>
                <br><br>
                <a class="btn btn-primary d-inline-block" href="<?php echo base_url(). 'posts/viewfile/'.$post['upload_file'];?>" target="_blank">VIEW PDF</a>
                <a class="btn btn-primary d-inline-block" href="<?php echo base_url(). 'assets/files/posts/'.$post['upload_file'];?>" download="<?php $post['upload_file'];?>">DOWNLOAD</a>
                <a class="btn btn-primary d-inline-block" href="<?php echo base_url(). 'complaints/create/'.$post['id'];?>">COMPLAIN</a>
                <?php if($this->session->userdata('user_id')==1):?>
                    <?php echo form_open('/posts/delete/'.$post['id'],'class="d-inline"');?>
                    <input type="submit" value="Delete" class="d-inline btn btn-danger">
                    </form>
                <?php endif;?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
