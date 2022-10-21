<div class="cogfig_process_command bg_eb">
    <h3 class="color_main font_inter font_bold fs-15 text-uppercase justify-content-center 
    mb-4 d-flex align-items-center command_title">
        Cấu hình lệnh gia công
    </h3>
    <div class="p-3 config_detail">
        <div class="row command_config_detail">
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Xén thành phẩm</label>
                <input type="text" class="form-control" name="c_process[0]['crop']" value="Xén theo ốc">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Kích thước đế</label>
                <input type="text" class="form-control" name="c_process[0]['soles_size']" value="">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Khổ thành phẩm</label>
                <input type="text" class="form-control" name="c_process[0]['finished_size']" value="">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Cán nilon</label>
                <select name="c_process[0]['roll']" class="form-control">
                    <option value="0">Không cán</option>
                    <option value="1">Cán bóng</option>
                    <option value="2">Cán mờ</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Số mặt cán</label>
                <select name="c_process[0]['num_face']" class="form-control">
                    <option value="0">Chọn số mặt cán</option>
                    @for($i = 1; $i<3; $i++)
                        <option value="{{ $i }}">{{ $i }} mặt</option>   
                    @endfor
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Khuôn bế</label>
                <select name="c_process[0]['elevated_frame']" class="form-control">
                    <option value="0">Không khuôn</option>
                    <option value="1">Khuôn mới</option>
                    <option value="2">Khuôn cũ</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Khuôn ép nhũ</label>
                <select name="c_process[0]['compress_frame']" class="form-control">
                    <option value="0">Không khuôn</option>
                    <option value="1">Khuôn mới</option>
                    <option value="2">Khuôn cũ</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Khuôn thúc nổi</label>
                <select name="c_process[0]['push_frame']" class="form-control">
                    <option value="0">Không khuôn</option>
                    <option value="1">Khuôn mới</option>
                    <option value="2">Khuôn cũ</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Đế bồi</label>
                <select name="c_process[0]['soles_fill']" class="form-control">
                    <option value="0">Chọn đế bồi</option>
                    <option value="1">Đế bồi đề can xi</option>
                    <option value="2">Đế bồi đề cusche in</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Màu nhũ</label>
                <select name="c_process[0]['emul_color']" class="form-control">
                    <option value="0">Vàng</option>
                    <option value="1">Bạc</option>
                    <option value="2">Khác</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Cán đế</label>
                <select name="c_process[0]['soles_roll']" class="form-control">
                    <option value="0">Chọn đế bồi</option>
                    <option value="1">Đế cán bóng</option>
                    <option value="2">Đế cán mờ</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Thành phẩm</label>
                <select name="c_process[0]['finished_style']" class="form-control">
                    <option value="0">Lò xo</option>
                    <option value="1">Nẹp</option>
                    <option value="2">Lò xo giữa</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Loại thành phẩm</label>
                <select name="c_process[0]['finished_type']" class="form-control">
                    <option value="0">Chọn loại thành phẩm</option>
                    <option value="1">Đóng gói</option>
                    <option value="2">Bỏ thùng</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Ngày đặt gia công</label>
                <input type="text" name="c_process[0]['order_expired']" value="" 
                class="form-control max_w_200 inputDatePicker">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Ngày xong</label>
                <input type="text" name="c_process[0]['expired']" value="" 
                class="form-control max_w_200 inputDatePicker">
            </div>
            @include('orders.products.checkbox', ['label'=>'Ghim lồng', 'name'=>"c_process[0]['pin']"])
            @include('orders.products.checkbox', ['label'=>'Keo gáy', 'name'=>"c_process[0]['glue']"])
            @include('orders.products.checkbox', ['label'=>'Bế', 'name'=>"c_process[0]['elevated']"])
            @include('orders.products.checkbox', ['label'=>'Ép nhũ', 'name'=>"c_process[0]['compress']"])
            @include('orders.products.checkbox', ['label'=>'Số nhảy', 'name'=>"c_process[0]['jump']"])
            @include('orders.products.checkbox', ['label'=>'Bồi', 'name'=>"c_process[0]['fill']"])
            @include('orders.products.checkbox', ['label'=>'Dập nổi', 'name'=>"c_process[0]['stamp']"])
            @include('orders.products.checkbox', ['label'=>'Phay - sẻ rãnh', 'name'=>"c_process[0]['grooved']"])
            @include('orders.products.checkbox', ['label'=>'GC thành phẩm', 'name'=>"c_process[0]['finish']"])
            @include('orders.products.checkbox', ['label'=>'Gấp máy', 'name'=>"c_process[0]['fold']"])
            @include('orders.products.checkbox', ['label'=>'Khâu chỉ', 'name'=>"c_process[0]['sew']"])
            @include('orders.products.checkbox', ['label'=>'Bế răng cưa', 'name'=>"c_process[0]['sawing']"])
            <div class="form-group d-flex border_bot_eb col-12">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize align-items-start">Ghi chú</label>
                <textarea class="form-control" name="c_process[0]['note']"></textarea>
            </div>
        </div>
    </div>
</div>