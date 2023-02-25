@php
    $singleRecord = !empty($singleObject);
@endphp
<div class="cogfig_design_command bg_eb">
    <h3 class="color_main font_inter font_bold fs-15 text-uppercase justify-content-center 
    mb-4 d-flex align-items-center command_title">
        Cấu hình lệnh thiết kế
    </h3>
    <div class="p-3 config_detail">
        <div class="row command_config_detail">
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-12">
                <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Người liên hệ</label>
                <input type="text" class="form-control" name="{{ $singleRecord ? 'name' : 'c_design['.$key.'][name]' }}" 
                value="{{ @$dataItem['name'] ?? @$cDesignContacter }}">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Số màu TK</label>
                <select name="{{ $singleRecord?'num_color':'c_design['.$key.'][num_color]' }}" class="form-control" required>
                    <option value="">Chọn số màu</option>
                    @for($i = 1; $i<7; $i++)
                        <option value="{{ $i }}" {{ @$dataItem['num_color']==$i?'selected':'' }}>
                            {{ $i }} màu {{ $i==5?'Panton':'' }}
                        </option>   
                    @endfor
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Số mặt TK</label>
                <select name="{{ $singleRecord?'num_face':'c_design['.$key.'][num_face]' }}" class="form-control" required>
                    <option value="">Chọn số mặt</option>
                    @for($i = 1; $i<3; $i++)
                        <option value="{{ $i }}" {{ @$dataItem['num_face']==$i?'selected':'' }}>
                            {{ $i }} mặt
                        </option>   
                    @endfor
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Kiểu TK</label>
                <select name="{{ $singleRecord?'type':'c_design['.$key.'][type]' }}" class="form-control">
                    <option value="1" {{ @$dataItem['type']==1?'selected':'' }}>Thiết kế</option>
                    <option value="2" {{ @$dataItem['type']==2?'selected':'' }}>Chế bản</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Loại TK</label>
                <select name="{{ $singleRecord?'style':'c_design['.$key.'][style]' }}" class="form-control design_style_order" required>
                    <option value="">Chọn loại thiết kế</option>
                    <option value="1" {{ @$dataItem['style']==1?'selected':'' }}>Thiết kế mới</option>
                    <option value="2" {{ @$dataItem['style']==2?'selected':'' }}>File cũ không chỉnh sửa</option>
                    <option value="3" {{ @$dataItem['style']==3?'selected':'' }}>File cũ có chỉnh sửa</option>
                    <option value="4" {{ @$dataItem['style']==4?'selected':'' }}>File khách gửi</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Kiểu in</label>
                <select name="{{ $singleRecord?'print_style':'c_design['.$key.'][print_style]' }}" class="form-control" required>
                    <option value="">Chọn kiểu in</option>
                    <option value="1" {{ @$dataItem['print_style']==1?'selected':'' }}>In Offset</option>
                    <option value="2" {{ @$dataItem['print_style']==2?'selected':'' }}>In Offset UV</option>
                    <option value="3" {{ @$dataItem['print_style']==3?'selected':'' }}>In TEST Offset</option>
                    <option value="4" {{ @$dataItem['print_style']==4?'selected':'' }}>In lưới</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Màu sắc</label>
                <select name="{{ $singleRecord?'print_color':'c_design['.$key.'][print_color]' }}" class="form-control" required>
                    <option value="">Chọn màu sắc</option>
                    <option value="1" {{ @$dataItem['print_color']==1?'selected':'' }}>Màu cơ bản</option>
                    <option value="2" {{ @$dataItem['print_color']==2?'selected':'' }}>Màu pha đính kèm</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Tùy chọn KH duyệt</label>
                <select name="{{ $singleRecord?'custom_sending':'c_design['.$key.'][custom_sending]' }}" class="form-control">
                    <option value="1" {{ @$dataItem['custom_sending']==1?'selected':'' }}>Không gửi</option>
                    <option value="2" {{ @$dataItem['custom_sending']==2?'selected':'' }}>Gửi mail khách duyệt</option>
                    <option value="3" {{ @$dataItem['custom_sending']==3?'selected':'' }}>In maket khách duyệt</option>
                    <option value="4" {{ @$dataItem['custom_sending']==4?'selected':'' }}>cả hai</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Hạn gửi DEMO</label>
                <input type="text" name="{{ $singleRecord?'demo_expired':'c_design['.$key.'][demo_expired]' }}" 
                value="{{ getDataDateTimeShow(@$dataItem['demo_expired']) }}" class="form-control max_w_200 inputDatePicker">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Hạn hoàn thành</label>
                <input type="text" name="{{ $singleRecord?'expired':'c_design['.$key.'][expired]' }}" 
                value="{{ getDataDateTimeShow(@$dataItem['expired']) }}" class="form-control max_w_200 inputDatePicker">
            </div>
            <div class="form-group d-flex border_bot_eb col-12">
                <label class="mb-0 mr-3 w_150 fs-13 text-capitalize align-items-start">Ghi chú</label>
                <textarea class="form-control" name="{{ $singleRecord?'note':'c_design['.$key.'][note]' }}">{{ @$dataItem['note'] }}</textarea>
            </div>
            <div class="col-12 text-center customer_file_upload" style="display:none">
                <div class="upload_click position-relative">
                    <button class="station-richmenu-main-btn-area">
                        <i class="fa fa-upload mr-2 upload_btn fs-15" aria-hidden="true"></i>Upload file TK
                    </button>
                    <input type="file" name="{{ $singleRecord?'file':'c_design['.$key.'][file]' }}" value="" class="upload_input file_input">
                </div>
            </div>
        </div>
    </div>
</div>