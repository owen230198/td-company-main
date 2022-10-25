<div class="cogfig_design_command bg_eb mb-4">
    <h3 class="color_main font_inter font_bold fs-15 text-uppercase justify-content-center 
    mb-4 d-flex align-items-center command_title">
        Cấu hình lệnh thiết kế
    </h3>
    <div class="p-3 config_detail">
        <div class="row command_config_detail">
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-12">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Người liên hệ</label>
                <input type="text" class="form-control" name="c_design[{{ $key }}][name]" value="">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Số màu TK</label>
                <select name="c_design[{{ $key }}][num_color]" class="form-control">
                    <option value="">Chọn số màu</option>
                    @for($i = 1; $i<7; $i++)
                        <option value="{{ $i }}">{{ $i }} màu {{ $i==5?'Panton':'' }}</option>   
                    @endfor
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Số mặt TK</label>
                <select name="c_design[{{ $key }}][num_face]" class="form-control">
                    <option value="">Chọn số mặt</option>
                    @for($i = 1; $i<3; $i++)
                        <option value="{{ $i }}">{{ $i }} mặt</option>   
                    @endfor
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Kiểu TK</label>
                <select name="c_design[{{ $key }}][type]" class="form-control">
                    <option value="">Thiết kế</option>
                    <option value="">Chế bản</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Loại TK</label>
                <select name="c_design[{{ $key }}][style]" class="form-control design_style_order">
                    <option value="1">Thiết kế mới</option>
                    <option value="2">File cũ không chỉnh sửa</option>
                    <option value="3">File cũ có chỉnh sửa</option>
                    <option value="4">File khách gửi</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Kiểu in</label>
                <select name="c_design[{{ $key }}][type]" class="form-control">
                    <option value="">Chọn kiểu in</option>
                    <option value="">In Offset</option>
                    <option value="">In Offset UV</option>
                    <option value="">In TEST Offset</option>
                    <option value="">In lưới</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Màu sắc</label>
                <select name="c_design[{{ $key }}][type]" class="form-control">
                    <option value="">Chọn màu sắc</option>
                    <option value="">Màu cơ bản</option>
                    <option value="">Màu pha đính kèm</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Tùy KH duyệt</label>
                <select name="c_design[{{ $key }}][type]" class="form-control">
                    <option value="">Không gửi</option>
                    <option value="">Gửi mail khách duyệt</option>
                    <option value="">In maket khách duyệt</option>
                    <option value="">cả hai</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Hạn gửi DEMO</label>
                <input type="text" name="c_design[{{ $key }}][demo_expired]" value="" 
                class="form-control max_w_200 inputDatePicker">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Hạn hoàn thành</label>
                <input type="text" name="c_design[{{ $key }}][expired]" value="" 
                class="form-control max_w_200 inputDatePicker">
            </div>
            <div class="form-group d-flex border_bot_eb col-12">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize align-items-start">Ghi chú</label>
                <textarea class="form-control" name="c_design[{{ $key }}][note]"></textarea>
            </div>
            <div class="col-12 text-center customer_file_upload" style="display:none">
                <div class="upload_click position-relative">
                    <button class="station-richmenu-main-btn-area">
                        <i class="fa fa-upload mr-2 upload_btn fs-15" aria-hidden="true"></i>Upload file TK
                    </button>
                    <input type="file" name="c_design[{{ $key }}][file]" value="" class="upload_input file_input" multiple="">
                </div>
            </div>
        </div>
    </div>
</div>