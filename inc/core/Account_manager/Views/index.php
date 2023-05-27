<?php 
$request = \Config\Services::request();
if ( !$request->isAJAX() ) {
?>
    <?php 
     _ec( $this->extend('Backend\Stackmin\Views\index'), false);
    ?>

    <?php echo $this->section('content') ?>
    <?php _ec( $this->include('Core\Account_manager\Views\sidebar'), false);?>

    <form class="main-wrapper flex-grow-1 n-scroll actionForm" action="<?php _ec( get_module_url("save") )?>" method="POST">
        <?php echo $content ?>
    </form>

    <?php echo $this->endSection() ?>

<?php }else{ ?>

    <?php echo $content ?>

<?php } ?>