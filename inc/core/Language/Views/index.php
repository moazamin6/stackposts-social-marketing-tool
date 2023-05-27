<?php 
$request = \Config\Services::request();
if ( !$request->isAJAX() ) {
?>
    <?php 
     _e( $this->extend('Backend\Stackmin\Views\index'), false);
    ?>

    <?php echo $this->section('content') ?>
    <?php _e( $this->include('Core\Language\Views\sidebar'), false);?>

    <div class="main-wrapper flex-grow-1 n-scroll">
        <?php echo $content ?>
    </div>

    <?php echo $this->endSection() ?>

<?php }else{ ?>

    <?php echo $content ?>

<?php } ?>