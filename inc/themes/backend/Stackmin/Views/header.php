<div class="header bg-white align-items-stretch">
    <div class="container-fluid d-flex align-items-stretch justify-content-between h-100">
        <div class="d-flex justify-content-between flex-lg-grow-1">
            <div class="d-flex align-items-stretch ms-1 ms-lg-3">
                <div class="d-flex align-items-stretch ms-2 ms-lg-3">
                    <div class="d-flex align-items-center">
                        <div class="d-lg-none d-md-none d-sm-block d-xs-block d-block">
                            <a href="javascript:void(0);" class="btn btn-light-primary px-3 btn-open-sidebar">
                                <i class="fad fa-bars p-r-0 fs-20"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-stretch ms-2 ms-lg-3">
                    <div class="d-flex align-items-center">
                        <div class="d-lg-none d-md-none d-sm-none d-none">
                            <a href="javascript:void(0);" class="btn btn-light-primary p-l-17 p-r-17 btn-open-sub-sidebar">
                                <i class="fad fa-chevron-right pe-0"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-stretch flex-shrink-0 me-1 me-lg-3">
            <?php
                $request = \Config\Services::request();
                $topbars = $request->topbars;
            ?>

            <?php if ( !empty($topbars) ): ?>
                
                <?php foreach ($topbars as $key => $value): ?>
                    <?php _ec( $value['topbar'] )?>
                <?php endforeach ?>

            <?php endif ?>
        </div>
    </div>
</div>