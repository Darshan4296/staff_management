<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url(); ?>">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Staff Management</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?php echo site_url('');  ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<?php $loggedInUser = session()->get('loggedUser'); ?>

<?php if ($loggedInUser['role'] == 'admin') : ?>
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="<?php echo site_url("staff");  ?>">
        <i class="fas fa-fw fa-table"></i>
        <span>Staff</span></a>
</li>
<?php endif; ?>
</ul>