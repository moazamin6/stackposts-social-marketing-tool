<?php 
$request = \Config\Services::request();
if ( !$request->isAJAX() ) {
?>
    <?php 
     _e( $this->extend('Backend\Stackmin\Views\index'), false);
    ?>

    <?php echo $this->section('content') ?>
    <div class="main-wrapper flex-grow-1 n-scroll <?php _ec( $config['id']."-main" )?>">
        <?php if (!check_expiration_date()): ?>
        <div class="container pt-5">
            <div class="alert alert-danger d-flex align-items-top">
                <div class="me-3"><i class="fad fa-exclamation-circle fs-40 "></i></div>
                <div>
                    <div class="fw-bold"><?php _e("Notification")?></div>
                    <?php _e("Your plan has expired, and as a result, all current features are disabled. However, it's easy to reconnect. Please upgrade or extend your plan.")?>
                </div>
            </div>
        </div>
        <?php endif ?>

        <?php echo $content ?>
    </form>

    <?php echo $this->endSection() ?>

<?php }else{ ?>

    <?php echo $content ?>

<?php } ?>