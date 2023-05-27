<?php 
$request = \Config\Services::request();
if ( !$request->isAJAX() ) {
?>
    <?php 
        _e( $this->extend('Backend\Stackmin\Views\index'), false);
    ?>

    <?php echo $this->section('content') ?>

    <div class="main-wrapper flex-grow-1 n-scroll d-flex <?php _e( str_replace("_", "-", $id) )?>" data-loading="false">
        <?php echo $content ?>
        <?php _e( $this->include('Core\File_manager\Views\sidebar'), false);?>
    </div>

    <?php echo $this->endSection() ?>

<?php }else{ ?>

    <?php echo $content ?>

<?php } ?>