@php
    $singleRecord = !empty($singleObject);
@endphp
<div class="cogfig_process_command bg_eb">
    <h3 class="color_main font_inter font_bold fs-15 text-uppercase justify-content-center 
    mb-4 d-flex align-items-center command_title">
        Cấu hình lệnh gia công
    </h3>
    <div class="p-3 config_detail">
        <div class="command_config_detail">
            <div class="c_process_config_detail row">

            </div>
            <div class="row justify-between">
                <div class="form-group d-flex border_bot_eb col-12">
                    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize align-items-start">Ghi chú</label>
                    <textarea class="form-control" name="{{ $singleRecord?'note':'c_process['.$key.'][note]' }}">{{ @$dataItem['note'] }}</textarea>
                </div>
                <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Ngày đặt gia công</label>
                    <input type="text" name="{{ $singleRecord?'order_expired':'c_process['.$key.'][order_expired]' }}" 
                    value="{{ getDataDateTimeShow(@$dataItem['order_expired']) }}" class="form-control max_w_200 inputDatePicker">
                </div>
                <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Ngày xong</label>
                    <input type="text" name="{{ $singleRecord?'expired':'c_process['.$key.'][expired]' }}" 
                    value="{{ getDataDateTimeShow(@$dataItem['expired']) }}" class="form-control max_w_200 inputDatePicker">
                </div>
                
            </div>
        </div>
    </div>
</div>