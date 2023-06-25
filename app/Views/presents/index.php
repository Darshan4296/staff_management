<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
 
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Staff: <?php echo sprintf("%s %s", $user['firstname'], $user['lastname']); ?></h1>


<div style="clear:both;" class="mb-3"></div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Presents
    </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Clock In</th>
                        <th>Clock out</th>
                        <th>Total Time</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($presents as $key=>$present) : ?>
                <tr>
                    <td><?php echo ++$key; ?></td>
                    <td><?php echo $present['clock_in'] ?></td>
                    <td><?php echo $present['clock_out'] ?></td>
                    <td><?php echo getDateDifference($present['clock_in'], $present['clock_out']); ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>