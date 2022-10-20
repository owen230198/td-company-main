<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pro-1-tab" data-toggle="tab" href="#pro-1" role="tab" aria-controls="pro-1"
            aria-selected="true">Sản phẩm 1</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pro-2-tab" data-toggle="tab" href="#pro-2" role="tab" aria-controls="pro-2"
            aria-selected="false">Sản phẩm 2</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active py-3" id="pro-1" role="tabpanel" aria-labelledby="pro-1-tab">
        <div class="row">
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Tên sản phẩm</label>
                <input type="text" class="form-control" name="product[0]['name']" value="">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Nhóm sản phẩm</label>
                <select name="product[0]['product_category_id']" class="form-control select_config">
                    <option value="">Tất cả danh mục</option>
                    <optgroup label="Hàng đặt">
                        <option value="">___Hộp cứng</option>
                        <option value="">___Hộp giấy</option>
                    </optgroup>
                    <optgroup label="Hàng bán sẵn">
                        <optgroup label="__Hộp cứng">
                            <option value="">___Hộp quà tết</option>
                            <option value="">___Hộp bánh trung thu</option>
                            <option value="">___Hộp nắp mika</option>
                            <option value="">___Hộp trụ tròn</option>
                            <option value="">___Thuyền</option>
                        </optgroup>
                        <optgroup label="__Hộp giấy">
                            <option value="">___Hộp bánh trung thu</option>
                        </optgroup>
                    </optgroup>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Số mặt thiết kế</label>
                <input type="number" class="form-control" name="product[0]['num_face_design']" value="">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">SL thành phẩm</label>
                <input type="number" class="form-control" name="product[0]['qty']" value="">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Đơn giá</label>
                <input type="number" class="form-control" name="product[0]['price']" value="">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Thành tiền</label>
                <input type="number" class="form-control disable_field" name="product[0]['total_cost']" value="">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-12">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize align-items-start">Ghi chú về sản phẩm</label>
                <textarea class="form-control" name="product[0]['note']"></textarea>
            </div>
        </div>
        <div class="cogfig_design_command bg_eb">
            <h3 class="color_main font_inter font_bold fs-15 text-uppercase justify-content-center 
            mb-4 d-flex align-items-center command_title">
                Cấu hình lệnh thiết kế
            </h3>
            <div class="p-3 config_detail">
                <div class="form-group d-flex mb-3 pb-3 border_bot_eb">
                    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Người liên hệ</label>
                    <input type="text" class="form-control" name="c_design[0]['name']" value="">
                </div>
                <div class="row">
                    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Số màu TK</label>
                        <select name="c_design[0]['num_color']" class="form-control">
                            <option value="">Chọn số màu</option>
                            @for($i = 1; $i<7; $i++)
                                <option value="{{ $i }}">{{ $i }} màu {{ $i==5?'Panton':'' }}</option>   
                            @endfor
                        </select>
                    </div>
                    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Số mặt TK</label>
                        <select name="c_design[0]['num_face']" class="form-control">
                            <option value="">Chọn số mặt</option>
                            @for($i = 1; $i<3; $i++)
                                <option value="{{ $i }}">{{ $i }} mặt</option>   
                            @endfor
                        </select>
                    </div>
                    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Kiểu TK</label>
                        <select name="c_design[0]['type']" class="form-control">
                            <option value="">Thiết kế</option>
                            <option value="">Chế bản</option>
                        </select>
                    </div>
                    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Loại TK</label>
                        <select name="c_design[0]['style']" class="form-control">
                            <option value="">Thiết kế mới</option>
                            <option value="">File cũ không chỉnh sửa</option>
                            <option value="">File cũ có chỉnh sửa</option>
                            <option value="">File khách gửi</option>
                        </select>
                    </div>
                    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Kiểu in</label>
                        <select name="c_design[0]['type']" class="form-control">
                            <option value="">Chọn kiểu in</option>
                            <option value="">In Offset</option>
                            <option value="">In Offset UV</option>
                            <option value="">In TEST Offset</option>
                            <option value="">In lưới</option>
                        </select>
                    </div>
                    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Màu sắc</label>
                        <select name="c_design[0]['type']" class="form-control">
                            <option value="">Chọn màu sắc</option>
                            <option value="">Màu cơ bản</option>
                            <option value="">Màu pha đính kèm</option>
                        </select>
                    </div>
                    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Tùy KH duyệt</label>
                        <select name="c_design[0]['type']" class="form-control">
                            <option value="">Không gửi</option>
                            <option value="">Gửi mail khách duyệt</option>
                            <option value="">In maket khách duyệt</option>
                            <option value="">cả hai</option>
                        </select>
                    </div>
                    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Hạn gửi DEMO</label>
                        <input type="text" name="c_design[0]['demo_expired']" value="" 
                        class="form-control max_w_200 inputDatePicker">
                    </div>
                    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Hạn hoàn thành</label>
                        <input type="text" name="c_design[0]['expired']" value="" 
                        class="form-control max_w_200 inputDatePicker">
                    </div>
                    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-12">
                        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize align-items-start">Ghi chú</label>
                        <textarea class="form-control" name="c_design[0]['note']"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pro-2" role="tabpanel" aria-labelledby="pro-2-tab">
        2
    </div>
</div>
