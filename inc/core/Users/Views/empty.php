<div class="container my-5">

    <div class="card card-flush">
        <div class="card-header m-t-20">
            <div class="card-title w-100">
                <div class="d-flex">
                    <div class="input-group sp-input-group">
                        <span class="input-group-text bg-light border-0 fs-20 bg-gray-100 text-gray-800" id="sub-menu-search"><i class="fad fa-search"></i></span>
                        <input type="text" class="form-control form-control-solid ps-15 bg-light border-0" name="search" value="" placeholder="Search" autocomplete="off">
                    </div>
                </div>
                <div class="d-flex ms-auto">
                    <div class="">
                        <button type="submit" class="btn btn btn-light-primary me-3"><i class="fad fa-file-export"></i> <?php _e('Export')?></button>
                        <button type="submit" class="btn btn-primary"><i class="fad fa-plus"></i> <?php _e('Add new')?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-13 gy-5">
                    <thead>
                        <tr class="text-start text-muted fw-bolder text-uppercase gs-0">
                            <th scope="col">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_subscriptions_table .form-check-input" value="1">
                                </div>
                            </th>
                            <th scope="col"><?php _e('Info')?></th>
                            <th scope="col"><?php _e('Package')?></th>
                            <th scope="col"><?php _e('Expiration date')?></th>
                            <th scope="col"><?php _e('Status')?></th>
                            <th scope="col"><?php _e('Changed')?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_subscriptions_table .form-check-input" value="1">
                                </div>
                            </th>
                            <td>
                                <div class="fw-6 text-primary">Tien Pham</div>
                                <div>tienpham1606@gmail.com</div>
                            </td>
                            <td><?php _e('Premium')?></td>
                            <td><?php _e('31-01-2022')?></td>
                            <td>
                                <span class="badge badge-light-primary p-6"><?php _e('Active')?></span>
                            </td>
                            <td><?php _e('03/05/2021 1:28 AM')?></td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_subscriptions_table .form-check-input" value="1">
                                </div>
                            </th>
                            <td>
                                <div class="fw-6 text-primary">Tien Pham</div>
                                <div>tienpham1606@gmail.com</div>
                            </td>
                            <td><?php _e('Premium')?></td>
                            <td><?php _e('31-01-2022')?></td>
                            <td>
                                <span class="badge badge-light-primary p-6"><?php _e('Active')?></span>
                            </td>
                            <td><?php _e('03/05/2021 1:28 AM')?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <nav class="m-t-20">
                <ul class="pagination d-flex justify-content-end">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>

        </div>
    </div>

    <div class="m-t-25 mw-650">
        <div class="card card-flush">
            <div class="card-header mt-6">
                <div class="card-title flex-column">
                    <h3 class="fw-bolder"><i class="fad fa-edit text-primary"></i> <?php _e('Update')?></h3>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label for="website_description" class="form-label"><?php _e('Role')?></label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1"><?php _e('User')?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2"><?php _e('Admin')?></label>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="website_description" class="form-label"><?php _e('Status')?></label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1"><?php _e('Active')?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2"><?php _e('Inactive')?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox3" value="option3">
                            <label class="form-check-label" for="inlineCheckbox3"><?php _e('Banned')?></label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="datetime_format" class="form-label"><?php _e('Fullname')?></label>
                    <input type="text" class="form-control form-control-solid" id="datetime_format" name="datetime_format" value="<?php _e( get_option("datetime_format", "") )?>">
                </div>
                <div class="mb-3">
                    <label for="datetime_format" class="form-label"><?php _e('Email')?></label>
                    <input type="text" class="form-control form-control-solid" id="datetime_format" name="datetime_format" value="<?php _e( get_option("datetime_format", "") )?>">
                </div>
                <div class="mb-3">
                    <label for="datetime_format" class="form-label"><?php _e('Password')?></label>
                    <input type="text" class="form-control form-control-solid" id="datetime_format" name="datetime_format" value="<?php _e( get_option("datetime_format", "") )?>">
                </div>
                <div class="mb-3">
                    <label for="datetime_format" class="form-label"><?php _e('Confirm password')?></label>
                    <input type="text" class="form-control form-control-solid" id="datetime_format" name="datetime_format" value="<?php _e( get_option("datetime_format", "") )?>">
                </div>
                <div class="mb-3">
                    <label for="datetime_format" class="form-label"><?php _e('Package')?></label>
                    <select class="form-control form-select form-control-solid">
                        <option>Basic</option>
                        <option>Premium</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="datetime_format" class="form-label"><?php _e('Expiration date')?></label>
                    <input type="text" class="form-control form-control-solid" id="datetime_format" name="datetime_format" value="<?php _e( get_option("datetime_format", "") )?>">
                </div>
                <div class="mb-3">
                    <label for="datetime_format" class="form-label"><?php _e('Timezone')?></label>
                    <select class="form-control form-select form-control-solid">
                        <option>Basic</option>
                        <option>Premium</option>
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><?php _e('Save')?></button>
            </div>
        </div>
    </div>

    

</div>

<div class="mw-400 container d-flex align-items-center align-self-center h-100">
    <div>
        <div class="text-center px-4">
            <img class="mw-100 mh-300px" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty.png">
        </div>
    </div>
</div> 