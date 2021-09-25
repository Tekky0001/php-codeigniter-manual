<h2><?= $title?></h2>
   
<?php foreach($posts as $post):?>
    <div class="card">
        <div class="card-header"><?php echo $post['title'];?></div>
        <div class="row card-body">
            <div class="col-md-12">
                <small class="post-date">Posted on: <?php echo $post['created_at'];?> for <strong><?php echo $post['device']?></strong></small><br>
                <?php echo $post['body'];?>
                <br><br>
                <a class="btn btn-primary" href="<?php echo base_url(). 'posts/viewfile/'.$post['upload_file'];?>" target="_blank">VIEW PDF</a>
                <?php if($this->session->userdata('user_id')==1):?>
                    <?php echo form_open('/posts/delete/'.$post['id'],'class="d-inline"');?>
                    <input type="submit" value="DELETE" class="d-inline btn btn-danger">
                    </form>
                <?php endif;?>
                <?php echo form_open('/posts/approve/'.$post['id'],'class="d-inline"');?>
                <input type="submit" value="APPROVE" class="d-inline btn btn-secondary">
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>