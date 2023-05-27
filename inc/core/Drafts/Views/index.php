<?php 
$request = \Config\Services::request();
if ( !$request->isAJAX() ) {
?>
    <?php 
     _e( $this->extend('Backend\Stackmin\Views\index'), false);
    ?>

    <?php echo $this->section('content') ?>

    <form class="main-wrapper flex-grow-1 n-scroll actionForm" action="<?php _e( get_module_url("save") )?>" method="POST">
        <?php echo $content ?>
    </form>

    <?php echo $this->endSection() ?>

<?php }else{ ?>

    <?php echo $content ?>

<?php } ?>