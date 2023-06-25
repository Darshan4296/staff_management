<?php echo  $this->extend('layout') ?>
<?php echo  $this->section('content') ?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
  <!-- Add Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2>Add Staff</h2>
    <form method="post" action="<?php echo site_url('/staff/store'); ?>" enctype="multipart/form-data">
    <?php csrf_field();  ?>
    <?php if(!empty(session()->getFlashdata('fail'))):?>
        <div class="alert alert-danger"><?php echo session()->getFlashdata('fail')  ?></div>
    <?php endif ?>
    
    <?php if(!empty(session()->getFlashdata('success'))):?>
        <div class="alert alert-success"><?php echo session()->getFlashdata('success')  ?></div>
    <?php endif ?>
      <div class="form-group">
        <label for="firstname">Firstname:</label>
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter the firstname">
        <span class="text-danger"><?php echo isset($validation) ?display_error($validation,'firstname'):'' ?></span>
      </div>
      <div class="form-group">
        <label for="lastname">Lastname:</label>
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter the lastname">
        <span class="text-danger"><?php echo isset($validation) ?display_error($validation,'lastname'):'' ?></span>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter the Email">
        <span class="text-danger"><?php echo isset($validation) ?display_error($validation,'email'):'' ?></span>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter the Password">
        <span class="text-danger"><?php echo isset($validation) ?display_error($validation,'password'):'' ?></span>
      </div>
      <div class="form-group">
        <label for="profilephoto">Profile Photo:</label>
        <input type="file" id="profilephoto" name="profilephoto" placeholder="select profilephoto">
        <span class="text-danger"><?php echo isset($validation) ?display_error($validation,'profilephoto'):'' ?></span>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  
  <!-- Add Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php echo  $this->endSection(); ?>