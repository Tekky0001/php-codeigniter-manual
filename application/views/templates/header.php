<html>
    <head>
        <title>Instruction Manual</title>
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.min.css");?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style.css");?>"/>
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand bg-secondary p-3" href="/manual">
            <img src="<?php echo base_url();?>assets/image/bookshelf.png" width="42" height="34" class="d-inline-block align-text-top">
            Manual Booklet</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>">Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>posts">Posts</a>
                </li>
                
            </ul>
            <!--to open form action, and give form class='' -->
            <?php echo form_open('posts/search','class="nav navbar-nav"'); ?>
                <input type="text" name="search" placeholder="Search">
                <button type="submit" class="btn btn-secondary btn-sm">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <?php if($this->session->userdata('user_id')==1):?>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo base_url();?>posts/request">Request Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();?>users/userlist">Userlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();?>complaints/view">Complaints</a>
                    </li>

                <?php endif;?>
                <?php if(!$this->session->userdata('logged_in')):?>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo base_url();?>users/register">Register</a> 
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo base_url();?>users/login">Log In</a> 
                    </li>
                <?php endif;?>
                <?php if($this->session->userdata('logged_in')):?>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo base_url();?>posts/create">Upload Manual</a> 
                    </li> 
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo base_url();?>users/logout">Log Out</a> 
                    </li>
                <?php endif;?>
            
        </div>
    </nav>

    <div class = "container">
        <!-- Flash Messages -->
        <?php if($this->session->flashdata('user_registered')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'?>
        <?php endif;?>
        <?php if($this->session->flashdata('post_created')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'?>
        <?php endif;?>
        <?php if($this->session->flashdata('post_deleted')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_deleted').'</p>'?>
        <?php endif;?>
        <?php if($this->session->flashdata('login_failed')):?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'?>
        <?php endif;?>
        <?php if($this->session->flashdata('user_loggedin')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>'?>
        <?php endif;?>
        <?php if($this->session->flashdata('user_loggedout')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>'?>
        <?php endif;?>
        <?php if($this->session->flashdata('user_status')):?>
            <?php echo '<p class="alert alert-warning">'.$this->session->flashdata('user_status').'</p>'?>
        <?php endif;?>
        <?php if($this->session->flashdata('post_requested')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_requested').'</p>'?>
        <?php endif;?>
        <?php if($this->session->flashdata('complaint_submit')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('complaint_submit').'</p>'?>
        <?php endif;?>
        <?php if($this->session->flashdata('captcha_invalid')):?>
            <?php echo '<p class="alert alert-warning">'.$this->session->flashdata('captcha_invalid').'</p>'?>
        <?php endif;?>