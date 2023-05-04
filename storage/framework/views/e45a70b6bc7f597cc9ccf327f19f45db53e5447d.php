<div class="quote_model py-lg-5 py-4" id="quote_model_w">
    <div style="font-weight: normal;
            background: #ffffff;
            max-width: 1200px;
            margin: auto;
            padding-bottom: 3rem!important;
            padding-top: 3rem!important;
            display: block;">
        <div style="font-family: auto;
                    border-bottom: 1px solid #ff1313;
                    margin-bottom: 1.5rem!important;
                    padding-bottom: 0.5rem!important;
                    display: block;
                    font-weight: normal;">
            <div style="display: -webkit-box;
                        display: -ms-flexbox;
                        display: flex;
                        -ms-flex-wrap: wrap;
                        flex-wrap: wrap;
                        margin-right: -15px;
                        margin-left: -15px;
                        font-family: auto;
                        font-weight: normal;">
                <div style="webkit-box-flex: 0;
                            -ms-flex: 0 0 33.333333%;
                            flex: 0 0 33.333333%;
                            max-width: 33.333333%;
                            position: relative;
                            width: 100%;
                            min-height: 1px;
                            padding-right: 15px;
                            padding-left: 15px;
                            ">
                    <a class="quote_logo d-inline-block" href="<?php echo e(url('')); ?>">
                        <img src="<?php echo e(url('frontend/admin/images/logo.jpg')); ?>" class="w-100 mb-1">	
                    </a>	
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-6 border_right_dashed">
                            <h2 class="ml-2 headr_title fs-21 mb-2 color_red font_bold font-italic">Văn phòng giao dịch</h2>
                            <p class="ml-2 fs-20 mb-1"><span class="font_bold color_red font-italic">A : </span>	<?php echo e(getDataConfig('QuoteConfig', 'OFFICE_ADD')); ?></p>
                            <p class="ml-2 fs-20 mb-1"><span class="font_bold color_red font-italic">T : </span><?php echo e(getDataConfig('QuoteConfig', 'OFFICE_PHONE')); ?></p>
                            <p class="ml-2 fs-20 mb-1"><span class="font_bold color_red font-italic">H : </span><?php echo e(getDataConfig('QuoteConfig', 'OFFICE_TEL')); ?></p>
                        </div>
                        <div class="col-6">
                            <h2 class="ml-2 headr_title fs-21 mb-2 color_red font_bold font-italic">Nhà máy sản xuất</h2>
                            <p class="ml-2 fs-20 mb-1"><span class="font_bold color_red font-italic">A : </span></span><?php echo e(getDataConfig('QuoteConfig', 'FACT_ADD')); ?></p>
                            <p class="ml-2 fs-20 mb-1"><span class="font_bold color_red font-italic">T : </span></span><?php echo e(getDataConfig('QuoteConfig', 'FACT_PHONE')); ?></p>
                            <p class="ml-2 fs-20 mb-1"><span class="font_bold color_red font-italic">H : </span><?php echo e(getDataConfig('QuoteConfig', 'FACT_TEL')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-lg-5 position-relative quote_content">
            <div class="quote_bg_content">
                <h1 class="text-uppercase fs-39 font_bold text-center mb-3">bảng báo giá</h1>
                <p class="fs-17 ml-lg-5 ml-md-3 mb-1">Kính gửi : <span class="font-italic"><span class="company"><?php echo e(@$data_customer['name']); ?></span></span></p>
                <p class="fs-17 ml-lg-5 ml-md-3 mb-1">Người liên hệ : <span class="font-italic"><?php echo e(@$data_customer['contacter']); ?></span></p>
                <p class="fs-17 ml-lg-5 ml-md-3 mb-1">Địa chỉ : <span class="font-italic"><?php echo e(@$data_customer['address']); ?></span></p>
                <p class="fs-17 ml-lg-5 ml-md-3 mb-1">Tel : <span class="font-italic"><?php echo e(@$data_customer['phone']); ?></span></p>
                <p class="fs-17 ml-lg-5 ml-md-3 mb-1">Email : <?php echo e(@$data_customer['email']); ?></p>
                <p class="fs-21 text-center font-italic"></span><?= getDataConfig('QuoteConfig', 'QUOTE_WISH') ?></p>

                <div class="table_quote my-lg-4 my-3">
                    <?php echo $__env->make('quotes.files.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="text-center p-2 border_grey">
                        <p class="fs-23 color_red font_bold mb-1">TỔNG GIÁ : 	<?php echo e(number_format(round((int)$data_quote['total_cost'], -3))); ?> VNĐ</p>
                        <p class="fs-18 font-italic">(Tổng cộng chưa VAT 10%)</p>
                    </div>
                </div>
                <div class="row footer_quote fs-17 font-italic pb_375">
                    <div class="col-9 quote_file_note">
                        <p class="d-flex align-items-center mb-1 font_bold font-italic">Ghi chú:</p>
                        <div class="ml-md-3">
                            <?php echo getDataConfig('QuoteConfig', 'ATTENTION'); ?>

                        </div>
                    </div>
                    <?php
                        $quote_admin = getDetailDataByID('NUser', @$data_quote['created_by'])
                    ?>
                    <div class="col-3 text-right mt-3 font-italic">
                        <p class="mb-0 font_bold">Người lập báo giá.</p>
                        <p class="mb-0 font_bold"><?php echo e(@$quote_admin['name']); ?></p>
                        <p class="mb-0 font_bold"><?php echo e(@$quote_admin['phone']); ?></p>		
                    </div>
                </div>
                <img src="<?php echo e(url('frontend/admin/images/footer_quote.jpg')); ?>" class="footer_quote_img">
            </div>
        </div>	
    </div>   
</div>
<?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/files/file_word.blade.php ENDPATH**/ ?>