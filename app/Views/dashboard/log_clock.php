<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <?php if (empty($present) || !empty($present['clock_out'])): ?>
                <p>Click to set clock in time:</p>
                <button type="button" class="btn btn-primary clock_in">Clock in</button>
            <?php else: ?>
                <p>Click to set clock out time:</p>
                <button type="button" class="btn btn-secondary clock_out">Clock out</button>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    jQuery( document ).ready(function() {

        jQuery(".clock_in").on("click", function () {
            jQuery.ajax({
                type: 'GET',
                url: "<?php echo site_url('api/presents/clock_in')?>",
                dataType: "json",
                data: {
                    'user_id' : '<?php echo $user['id']; ?>'
                },
                success: function(response) { 
                    alert(response.messages.success); 
                    location.href = '<?php echo site_url()?>';
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    response = JSON.parse(xhr.responseText);
                    alert(response.messages.error);
                    location.href = '<?php echo site_url()?>';
                }
            });
        });

        jQuery(".clock_out").on("click", function () {
            jQuery.ajax({
                type: 'GET',
                url: "<?php echo site_url('api/presents/clock_out')?>",
                dataType: "json",
                data: {
                    'user_id' : '<?php echo $user['id']; ?>'
                },
                success: function(response) { 
                    alert(response.messages.success); 
                    location.href = '<?php echo site_url()?>';
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    response = JSON.parse(xhr.responseText);
                    alert(response.messages.error);
                    location.href = '<?php echo site_url()?>';
                }
            });
        });
    });
</script>