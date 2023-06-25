<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
 
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Staff Tables</h1>

<div class="float-right" role="alert">
    <a class="btn btn-primary" href="<?php echo site_url('staff/add')?>" role="button">Add Staff</a>
</div>

<div style="clear:both;" class="mb-3"></div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Staff</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Firstnaame</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php foreach ($staffs as $staff) : ?>
                <tr>
                    <td>
                        <?php if (!empty($staff['profilephoto']) && file_exists(ROOTPATH . '/public/uploads/'.$staff['profilephoto'])) : ?>
                            <img  title="Profile Photo" class="img-thumbnail img-staff"
                                src="<?php echo site_url('uploads/'.$staff['profilephoto']) ?>" />
                        <?php endif; ?>
                    </td>
                    <td><?php echo $staff['firstname'] ?></td>
                    <td><?php echo $staff['lastname'] ?></td>
                    <td><?php echo $staff['email'] ?></td>
                    <td><?php echo $staff['created_at'] ?></td>
                    <td><?php echo $staff['updated_at'] ?></td>
                    <td>
                        <a href="<?php echo base_url('/staff/'.$staff['id'].'/edit/'); ?>" class="btn btn-primary">Edit</a>
                        <a href="<?php echo base_url('/presents?user_id='.$staff['id']); ?>" class="btn btn-info">Presents</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>