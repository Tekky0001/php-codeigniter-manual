<h2><?= $title?></h2>
<table class="table table-hover ">
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Registered Date</th>
            <th>Change Status</th>
            <th>Other</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user):?>
            <tr>
                <td><?php echo $user['username']?></td>
                <td><?php echo $user['email']?></td>
                <td><?php echo $user['register_date']?></td>
                <?php if($user['status']=='ban'){?>
                    <td><a class="btn btn-primary d-inline-block" href="<?php echo base_url()."users/unbanuser/".$user['id'] ;?>">UNBAN</a></td>
                <?php }?>
                <?php if($user['status']=='unban'){?>
                    <td><a class="btn btn-primary d-inline-block" href="<?php echo base_url()."users/banuser/".$user['id'];?>">BAN</a></td>
                <?php }?>
                <?php if($this->session->userdata('user_id')==1){?>
                    <td><a class="btn btn-danger d-inline-block" href="<?php echo base_url()."users/deleteuser/".$user['id'];?>">DELETE</a></td>
                <?php }?>
                
            </tr>
        <?php endforeach?>
    </tbody>
</table>