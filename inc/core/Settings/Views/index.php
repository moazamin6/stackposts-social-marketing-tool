<?php 
$request = \Config\Services::request();
if ( !$request->isAJAX() ) {
?>
    <?php 
     _e( $this->extend('Backend\Stackmin\Views\index'), false);
    ?>

    <?php echo $this->section('content') ?>
    <?php _e( $this->include('Core\Settings\Views\sidebar'), false);?>

    <form class="main-wrapper flex-grow-1 n-scroll actionForm" action="<?php _e( get_module_url("save") )?>" method="POST">
        <?php echo $content ?>
    </form>

    <?php echo $this->endSection() ?>

<?php }else{ ?>

    <?php echo $content ?>

<?php } ?>