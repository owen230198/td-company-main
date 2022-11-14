@php
    $singleRecord = !empty($singleObject);
@endphp
<div class="cogfig_process_command bg_eb">
    <h3 class="color_main font_inter font_bold fs-15 text-uppercase justify-content-center 
    mb-4 d-flex align-items-center command_title">
        Cấu hình lệnh gia công
    </h3>
    <div class="p-3 config_detail">
        <div class="row command_config_detail">
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Xén thành phẩm</label>
                <input type="text" class="form-control" name="{{ $singleRecord?'crop':'c_process['.$key.'][crop]' }}" value="Xén theo ốc">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Kích thước đế</label>
                <input type="text" class="form-control" name="{{ $singleRecord?'soles_size':'c_process['.$key.'][soles_size]' }}" value="">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Khổ thành phẩm</label>
                <input type="text" class="form-control" name="{{ $singleRecord?'finished_size':'c_process['.$key.'][finished_size]' }}" value="">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Cán nilon</label>
                <select name="{{ $singleRecord?'roll':'c_process['.$key.'][roll]' }}" class="form-control">
                    <option value="0">Không cán</option>
                    <option value="1">Cán bóng</option>
                    <option value="2">Cán mờ</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Số mặt cán</label>
                <select name="{{ $singleRecord?'num_face':'c_process['.$key.'][num_face]' }}" class="form-control">
                    <option value="0">Chọn số mặt cán</option>
                    @for($i = 1; $i<3; $i++)
                        <option value="{{ $i }}">{{ $i }} mặt</option>   
                    @endfor
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Khuôn bế</label>
                <select name="{{ $singleRecord?'elevated_frame':'c_process['.$key.'][elevated_frame]' }}" class="form-control">
                    <option value="0">Không khuôn</option>
                    <option value="1">Khuôn mới</option>
                    <option value="2">Khuôn cũ</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Khuôn ép nhũ</label>
                <select name="{{ $singleRecord?'compress_frame':'c_process['.$key.'][compress_frame]' }}" class="form-control">
                    <option value="0">Không khuôn</option>
                    <option value="1">Khuôn mới</option>
                    <option value="2">Khuôn cũ</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Khuôn thúc nổi</label>
                <select name="{{ $singleRecord?'push_frame':'c_process['.$key.'][push_frame]' }}" class="form-control">
                    <option value="0">Không khuôn</option>
                    <option value="1">Khuôn mới</option>
                    <option value="2">Khuôn cũ</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Đế bồi</label>
                <select name="{{ $singleRecord?'soles_fill':'c_process['.$key.'][soles_fill]' }}" class="form-control">
                    <option value="0">Chọn đế bồi</option>
                    <option value="1">Đế bồi đề can xi</option>
                    <option value="2">Đế bồi đề cusche in</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Màu nhũ</label>
                <select name="{{ $singleRecord?'emul_color':'c_process['.$key.'][emul_color]' }}" class="form-control">
                    <option value="0">Vàng</option>
                    <option value="1">Bạc</option>
                    <option value="2">Khác</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Cán đế</label>
                <select name="{{ $singleRecord?'soles_roll':'c_process['.$key.'][soles_roll]' }}" class="form-control">
                    <option value="0">Chọn đế cán</option>
                    <option value="1">Đế cán bóng</option>
                    <option value="2">Đế cán mờ</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Thành phẩm</label>
                <select name="{{ $singleRecord?'finished_style':'c_process['.$key.'][finished_style]' }}" class="form-control">
                    <option value="0">Lò xo</option>
                    <option value="1">Nẹp</option>
                    <option value="2">Lò xo giữa</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Loại thành phẩm</label>
                <select name="{{ $singleRecord?'finished_type':'c_process['.$key.'][finished_type]' }}" class="form-control">
                    <option value="0">Chọn loại thành phẩm</option>
                    <option value="1">Đóng gói</option>
                    <option value="2">Bỏ thùng</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Ngày đặt gia công</label>
                <input type="text" name="{{ $singleRecord?'order_expired':'c_process['.$key.'][order_expired]' }}" value="" 
                class="form-control max_w_200 inputDatePicker">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Ngày xong</label>
                <input type="text" name="{{ $singleRecord?'expired':'c_process['.$key.'][expired]' }}" value="" 
                class="form-control max_w_200 inputDatePicker">
            </div>
            @include('orders.products.checkbox', 
            ['label'=>'Ghim lồng', 'name'=>$singleRecord?'json_data_conf[pin]':'c_process['.$key.'][json_data_conf][pin]'])

            @include('orders.products.checkbox', 
            ['label'=>'Keo gáy', 'name'=>$singleRecord?'json_data_conf[glue]':'c_process['.$key.'][json_data_conf][glue]'])

            @include('orders.products.checkbox', 
            ['label'=>'Bế', 'name'=>$singleRecord?'json_data_conf[elevated]':'c_process['.$key.'][json_data_conf][elevated]'])

            @include('orders.products.checkbox', 
            ['label'=>'Ép nhũ', 'name'=>$singleRecord?'json_data_conf[compress]':'c_process['.$key.'][json_data_conf][compress]'])

            @include('orders.products.checkbox', 
            ['label'=>'Số nhảy', 'name'=>$singleRecord?'json_data_conf[jump]':'c_process['.$key.'][json_data_conf][jump]'])

            @include('orders.products.checkbox', 
            ['label'=>'Bồi', 'name'=>$singleRecord?'json_data_conf[fill]':'c_process['.$key.'][json_data_conf][fill]'])

            @include('orders.products.checkbox', 
            ['label'=>'Dập nổi', 'name'=>$singleRecord?'json_data_conf[stamp]':'c_process['.$key.'][json_data_conf][stamp]'])

            @include('orders.products.checkbox', 
            ['label'=>'Phay - sẻ rãnh', 'name'=>$singleRecord?'json_data_conf[grooved]':'c_process['.$key.'][json_data_conf][grooved]'])

            @include('orders.products.checkbox', 
            ['label'=>'GC thành phẩm', 'name'=>$singleRecord?'json_data_conf[finish]':'c_process['.$key.'][json_data_conf][finish]'])

            @include('orders.products.checkbox', 
            ['label'=>'Gấp máy', 'name'=>$singleRecord?'json_data_conf[fold]':'c_process['.$key.'][json_data_conf][fold]'])

            @include('orders.products.checkbox', 
            ['label'=>'Khâu chỉ', 'name'=>$singleRecord?'json_data_conf[sew]':'c_process['.$key.'][json_data_conf][sew]'])

            @include('orders.products.checkbox', 
            ['label'=>'Bế răng cưa', 'name'=>$singleRecord?'json_data_conf[sawing]':'c_process['.$key.'][json_data_conf][sawing]'])

            <div class="form-group d-flex border_bot_eb col-12">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize align-items-start">Ghi chú</label>
                <textarea class="form-control" name="{{ $singleRecord?'note':'c_process['.$key.'][note]' }}"></textarea>
            </div>
        </div>
    </div>
</div>