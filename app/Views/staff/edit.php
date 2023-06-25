<?php echo $this->extend('layout') ?>
<?php echo $this->section('content') ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add/Edit</h1>

    <form class="user" method="post" action="<?php echo site_url('/staff/'.$staff['id'].'/update'); ?>" enctype="multipart/form-data">
    <?php csrf_field();  ?>
        <?php if(!empty(session()->getFlashdata('fail'))):?>
            <div class="alert alert-danger"><?php echo session()->getFlashdata('fail')  ?></div>
        <?php endif ?>

        <?php if(!empty(session()->getFlashdata('success'))):?>
            <div class="alert alert-success"><?php echo session()->getFlashdata('success')  ?></div>
        <?php endif ?>
           
        <div class="form-group">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="firstname">Firstname</label>
                <input type="text" class="form-control form-control-user" id="firstname"
                    name="firstname" value="<?php echo  $staff['firstname'];  ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="lastname">Lastname</label>
                <input type="text" class="form-control form-control-user" id="lastname"
                    name="lastname" value="<?php echo  $staff['lastname'];  ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="email">Email</label>
                <input type="email" class="form-control form-control-user" id="email"
                 name="email" value="<?php echo  $staff['email'];  ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="password">Password</label>
                <input type="password" class="form-control form-control-user" id="password"
                 name="password">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="profilephoto">Profile Photo</label>
                <input type="file" id="profilephoto" name="profilephoto" 
                value="<?php echo  $staff['profilephoto'];  ?>">
            </div>
            <?php if (!empty($staff['profilephoto']) && file_exists(ROOTPATH . '/public/uploads/'.$staff['profilephoto'])) : ?>
                <img  title="Profile Photo" class="img-thumbnail img-staff"
                    src="<?php echo site_url('uploads/'.$staff['profilephoto']) ?>" />
            <?php endif; ?>
      </div>
     
        <div class="col-sm-6 mb-3 mb-sm-0">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="<?php echo site_url('staff')?>" class="btn btn-link">Back</a>
        </div>
    </form>
</div>
<?php echo $this->endSection(); ?>