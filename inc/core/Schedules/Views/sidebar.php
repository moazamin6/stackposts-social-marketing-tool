<div class="sub-sidebar bg-white d-flex flex-column flex-row-auto">
    <input type="hidden" name="schedule_time" value="<?php _e( uri('segment', 5) )?>">

    <div class="d-flex mb-10 p-20">
        <div class="d-flex align-items-center w-lg-400px">
            <form class="w-100 position-relative ">
                <div class="input-group sp-input-group">
                  <span class="input-group-text bg-light border-0 fs-20 bg-gray-100 text-gray-800" id="sub-menu-search"><i class="fad fa-search"></i></span>
                  <input type="text" class="form-control form-control-solid ps-15 bg-light border-0 search-input" data-search="search-area" name="search" value="" placeholder="<?php _e("Search")?>" autocomplete="off">
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex mb-10 p-l-20 p-r-20 m-b-12">
        <h2 class="text-gray-800 fw-bold"><?php _e( $title )?></h2>
    </div>

    <div class="sp-menu n-scroll sp-menu-two menu menu-column menu-state-bg menu-rounded menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 p-l-20 p-r-20 m-b-12 fw-5">
        <input type="text" name="schedule_time" class="d-none" value="<?php _e( uri('segment', 5));?>">

        <div class="menu-item m-b-2 search-area">
            <a class="menu-link sp-menu-item schedule-type <?php _e( uri('segment', 3) == "queue"?"active":"" )?>" href="<?php _e( get_module_url( "index/queue/".uri('segment', 4)."/" ) )?>" >
                <span class="menu-icon">
                    <i class="text-primary fs-20 fas fa-circle-notch fa-spin"></i>
                </span>
                <span class="menu-title"><?php _e("Queue")?></span>
                <input type="radio" name="schedule_type" class="d-none" value="queue" <?php _e( uri('segment', 3) == "queue"?"checked":"" )?>>
            </a>
        </div>
        <div class="menu-item m-b-2 search-area">
            <a class="menu-link sp-menu-item schedule-type <?php _e( uri('segment', 3) == "published"?"active":"" )?>" href="<?php _e( get_module_url( "index/published/".uri('segment', 4)."/" ) )?>" >
                <span class="menu-icon">
                    <i class="text-primary fs-20 fad fa-check-double"></i>
                </span>
                <span class="menu-title"><?php _e("Published")?></span>
                <input type="radio" name="schedule_type" class="d-none" value="published" <?php _e( uri('segment', 3) == "published"?"checked":"" )?>>
            </a>
        </div>
        <div class="menu-item m-b-2 search-area">
            <a class="menu-link sp-menu-item schedule-type <?php _e( uri('segment', 3) == "unpublished"?"active":"" )?>" href="<?php _e( get_module_url( "index/unpublished/".uri('segment', 4)."/" ) )?>" >
                <span class="menu-icon">
                    <i class="text-primary fs-20 fad fa-exclamation-circle"></i>
                </span>
                <span class="menu-title"><?php _e("Unpublished")?></span>
                <input type="radio" name="schedule_type" class="d-none" value="unpublished" <?php _e( uri('segment', 3) == "unpublished"?"checked":"" )?>>
            </a>
        </div>

        <?php if (!empty($categories)): ?>
            <div class="schedule_of">
                <div class="menu-item py-3">
                    <div class="menu-content pb-2 ps-0">
                        <span class="menu-section text-muted text-uppercase fs-12 ls-1"><i class="fal fa-filter pe-2"></i> <?php _e("Schedules of")?></span>
                    </div>
                </div>

                <a href="javascript:void(0);" class="sp-menu-item d-flex align-items-center px-2 py-2 rounded bg-hover-light">
                    <div class="d-flex mb-10 me-auto w-100 align-items-center search-area">
                        <div class="d-flex align-items-center mb-10 ">
                            <div class="symbol symbol-40px p-r-10">
                                <span class="symbol-label bg-white border">
                                    <i class="fas fa-share-alt-square align-self-center fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-grow-1">
                            <div class="custom-list-title text-gray-600 mb-1 fs-14"><?php _e("All schedules")?></div>
                        </div>
                        <div class="d-flex align-items-center ms-auto">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="schedule_of" value="all" id="schedule_of_all" <?php _e( uri('segment', 4)=="all"?"checked":"" )?>>
                                <label class="form-check-label" for="schedule_of_all"></label>
                            </div>
                        </div>
                    </div>
                </a>

                <?php foreach ($categories as $key => $value): ?>
                <a href="javascript:void(0);" class="sp-menu-item d-flex align-items-center px-2 py-2 rounded bg-hover-light">
                    <div class="d-flex mb-10 me-auto w-100 align-items-center search-area">
                        <div class="d-flex align-items-center mb-10 ">
                            <div class="symbol symbol-40px p-r-10">
                                <span class="symbol-label bg-white border">
                                    <i class="<?php _e( $value->icon )?> align-self-center fs-18" style=" color: <?php _e( $value->color )?> "></i>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-grow-1">
                            <div class="custom-list-title text-gray-600 mb-1 fs-14"><?php _e( $value->name )?></div>
                        </div>
                        <div class="d-flex align-items-center ms-auto">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="schedule_of" value="<?php _e( $value->social_network )?>" id="schedule_of_<?php _e( $value->social_network )?>" <?php _e( uri('segment', 4)==$value->social_network?"checked":"" )?>>
                                <label class="form-check-label text-over" for="schedule_of_<?php _e( $value->social_network )?>"></label>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach ?>
            </div>
        

            <div class="menu-item py-3">
                <div class="menu-content pb-2 ps-0">
                    <span class="menu-section text-muted text-uppercase fs-12 ls-1"><i class="fal fa-trash-alt pe-2"></i> <?php _e("Delete schedules")?></span>
                </div>
            </div>

            <form class="actionForm" action="<?php _ec( get_module_url("delete/multi") )?>" data-redirect="<?php _ec( current_url() )?>">
                <div class="card border">
                    <div class="card-body p-20">
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="schedule_delete_queue" value="queue" <?php _ec( uri("segment", 3) == "queue"?"checked":"" )?>>
                                <label class="form-check-label" for="schedule_delete_queue"><?php _e("Queue")?></label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="schedule_delete_published" value="published" <?php _ec( uri("segment", 3) == "published"?"checked":"" )?>>
                                <label class="form-check-label" for="schedule_delete_published"><?php _e("Published")?></label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="schedule_delete_unpublished" value="unpublished" <?php _ec( uri("segment", 3) == "unpublished"?"checked":"" )?>>
                                <label class="form-check-label" for="schedule_delete_unpublished"><?php _e("Unpublished")?></label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="website_logo_black" class="form-label fw-4 fs-12"><?php _e("Social network")?></label>
                            <select class="form-select form-select-sm" name="social_network">
                                <option value="all"><?php _e("All")?></option>
                                <?php foreach ($categories as $key => $value): ?>
                                <option value="<?php _e( $value->social_network )?>" <?php _ec( uri("segment", 4) == $value->social_network?"selected":"" )?> ><?php _e( $value->name )?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-0">
                            <button type="symbol" class="btn btn-light-danger w-100"><?php _e("Submit")?></button>
                        </div>
                    </div>
            </form>
            </div>
        <?php endif ?>
    </div>
</div>