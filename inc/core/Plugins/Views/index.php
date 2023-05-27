<?php 
$request = \Config\Services::request();
if ( !$request->isAJAX() ) {
?>
    <?php 
     _e( $this->extend('Backend\Stackmin\Views\index'), false);
    ?>

    <?php echo $this->section('content') ?>

    <form class="main-wrapper flex-grow-1 n-scroll actionForm" action="<?php _e( get_module_url("save") )?>" method="POST">
        <?php if (post("error")): ?>
        <div class="container pt-5">
            <div class="alert alert-danger d-flex align-items-center">
                <div class="fs-40 me-3"><i class="fad fa-exclamation-circle"></i></div>
                <div>
                    <div class="fw-bold"><?php _e("Notification")?></div>
                    <?php _e(post("error"))?>
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