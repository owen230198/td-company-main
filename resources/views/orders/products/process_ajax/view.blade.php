<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Xén thành phẩm</label>
    <input type="text" class="form-control" name="{{ @$singleRecord?'crop':'c_process['.$key.'][json_data_conf][crop]' }}" 
    value="{{ @$dataItem['crop']??'Xén theo ốc' }}">
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Kích thước đế</label>
    <input type="text" class="form-control" name="{{ @$singleRecord?'soles_size':'c_process['.$key.'][json_data_conf][soles_size]' }}" 
    value="{{ @$dataItem['soles_size'] }}">
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Khổ thành phẩm</label>
    <input type="text" class="form-control" name="{{ @$singleRecord?'finished_size':'c_process['.$key.'][json_data_conf][finished_size]' }}" 
    value="{{ @$dataItem['finished_size'] }}">
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Cán nilon</label>
    <select name="{{ @$singleRecord?'roll':'c_process['.$key.'][json_data_conf][roll]' }}" class="form-control">
        <option value="0">Không cán</option>
        <option value="1"{{ @$dataItem['roll']==1?'selected':'' }}>Cán bóng</option>
        <option value="2"{{ @$dataItem['roll']==2?'selected':'' }}>Cán mờ</option>
    </select>
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Số mặt cán</label>
    <select name="{{ @$singleRecord?'num_face':'c_process['.$key.'][json_data_conf][num_face]' }}" class="form-control">
        <option value="0">Chọn số mặt cán</option>
        @for($i = 1; $i<3; $i++)
            <option value="{{ $i }}" {{ @$dataItem['num_face']==$i?'selected':'' }}>
                {{ $i }} mặt
            </option>   
        @endfor
    </select>
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Khuôn bế</label>
    <select name="{{ @$singleRecord?'elevated_frame':'c_process['.$key.'][json_data_conf][elevated_frame]' }}" class="form-control">
        <option value="0">Không khuôn</option>
        <option value="1" {{ @$dataItem['elevated_frame']==1?'selected':'' }}>Khuôn mới</option>
        <option value="2" {{ @$dataItem['elevated_frame']==2?'selected':'' }}>Khuôn cũ</option>
    </select>
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Khuôn ép nhũ</label>
    <select name="{{ @$singleRecord?'compress_frame':'c_process['.$key.'][json_data_conf][compress_frame]' }}" class="form-control">
        <option value="0">Không khuôn</option>
        <option value="1" {{ @$dataItem['compress_frame']==1?'selected':'' }}>Khuôn mới</option>
        <option value="2" {{ @$dataItem['compress_frame']==2?'selected':'' }}>Khuôn cũ</option>
    </select>
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Khuôn thúc nổi</label>
    <select name="{{ @$singleRecord?'push_frame':'c_process['.$key.'][json_data_conf][push_frame]' }}" class="form-control">
        <option value="0">Không khuôn</option>
        <option value="1" {{ @$dataItem['push_frame']==1?'selected':'' }}>Khuôn mới</option>
        <option value="2" {{ @$dataItem['push_frame']==2?'selected':'' }}>Khuôn cũ</option>
    </select>
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Đế bồi</label>
    <select name="{{ @$singleRecord?'soles_fill':'c_process['.$key.'][json_data_conf][soles_fill]' }}" class="form-control">
        <option value="0">Chọn đế bồi</option>
        <option value="1" {{ @$dataItem['soles_fill']==1?'selected':'' }}>Đế bồi đề can xi</option>
        <option value="2" {{ @$dataItem['soles_fill']==2?'selected':'' }}>Đế bồi đề cusche in</option>
    </select>
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Màu nhũ</label>
    <select name="{{ @$singleRecord?'emul_color':'c_process['.$key.'][json_data_conf][emul_color]' }}" class="form-control">
        <option value="0" {{ @$dataItem['emul_color']==0?'selected':'' }}>Vàng</option>
        <option value="1" {{ @$dataItem['emul_color']==1?'selected':'' }}>Bạc</option>
        <option value="2" {{ @$dataItem['emul_color']==2?'selected':'' }}>Khác</option>
    </select>
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Cán đế</label>
    <select name="{{ @$singleRecord?'soles_roll':'c_process['.$key.'][json_data_conf][soles_roll]' }}" class="form-control">
        <option value="0" {{ @$dataItem['soles_roll']==0?'selected':'' }}>Chọn đế cán</option>
        <option value="1" {{ @$dataItem['soles_roll']==1?'selected':'' }}>Đế cán bóng</option>
        <option value="2" {{ @$dataItem['soles_roll']==2?'selected':'' }}>Đế cán mờ</option>
    </select>
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Thành phẩm</label>
    <select name="{{ @$singleRecord?'finished_style':'c_process['.$key.'][json_data_conf][finished_style]' }}" class="form-control">
        <option value="0" {{ @$dataItem['finished_style']==0?'selected':'' }}>Lò xo</option>
        <option value="1" {{ @$dataItem['finished_style']==1?'selected':'' }}>Nẹp</option>
        <option value="2" {{ @$dataItem['finished_style']==2?'selected':'' }}>Lò xo giữa</option>
    </select>
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Loại thành phẩm</label>
    <select name="{{ @$singleRecord?'finished_type':'c_process['.$key.'][json_data_conf][finished_type]' }}" class="form-control">
        <option value="0" {{ @$dataItem['finished_type']==0?'selected':'' }}>Chọn loại thành phẩm</option>
        <option value="1" {{ @$dataItem['finished_type']==1?'selected':'' }}>Đóng gói</option>
        <option value="2" {{ @$dataItem['finished_type']==2?'selected':'' }}>Bỏ thùng</option>
    </select>
</div>
@include('orders.products.checkbox', 
['label'=>'Ghim lồng', 'name'=>@$singleRecord?'json_data_conf[pin]':'c_process['.$key.'][json_data_conf][pin]', 
'value'=>@$processDataConf['pin']])

@include('orders.products.checkbox', 
['label'=>'Keo gáy', 'name'=>@$singleRecord?'json_data_conf[glue]':'c_process['.$key.'][json_data_conf][glue]', 
'value'=>@$processDataConf['glue']])

@include('orders.products.checkbox', 
['label'=>'Bế', 'name'=>@$singleRecord?'json_data_conf[elevated]':'c_process['.$key.'][json_data_conf][elevated]', 
'value'=>@$processDataConf['elevated']])

@include('orders.products.checkbox', 
['label'=>'Ép nhũ', 'name'=>@$singleRecord?'json_data_conf[compress]':'c_process['.$key.'][json_data_conf][compress]', 
'value'=>@$processDataConf['compress']])

@include('orders.products.checkbox', 
['label'=>'Số nhảy', 'name'=>@$singleRecord?'json_data_conf[jump]':'c_process['.$key.'][json_data_conf][jump]', 
'value'=>@$processDataConf['jump']])

@include('orders.products.checkbox', 
['label'=>'Bồi', 'name'=>@$singleRecord?'json_data_conf[fill]':'c_process['.$key.'][json_data_conf][fill]', 
'value'=>@$processDataConf['fill']])

@include('orders.products.checkbox', 
['label'=>'Dập nổi', 'name'=>@$singleRecord?'json_data_conf[stamp]':'c_process['.$key.'][json_data_conf][stamp]', 
'value'=>@$processDataConf['stamp']])

@include('orders.products.checkbox', 
['label'=>'Phay - sẻ rãnh', 'name'=>@$singleRecord?'json_data_conf[grooved]':'c_process['.$key.'][json_data_conf][grooved]', 
'value'=>@$processDataConf['grooved']])

@include('orders.products.checkbox', 
['label'=>'GC thành phẩm', 'name'=>@$singleRecord?'json_data_conf[finish]':'c_process['.$key.'][json_data_conf][finish]', 
'value'=>@$processDataConf['finish']])

@include('orders.products.checkbox', 
['label'=>'Gấp máy', 'name'=>@$singleRecord?'json_data_conf[fold]':'c_process['.$key.'][json_data_conf][fold]', 
'value'=>@$processDataConf['fold']])

@include('orders.products.checkbox', 
['label'=>'Khâu chỉ', 'name'=>@$singleRecord?'json_data_conf[sew]':'c_process['.$key.'][json_data_conf][sew]', 
'value'=>@$processDataConf['sew']])

@include('orders.products.checkbox', 
['label'=>'Bế răng cưa', 'name'=>@$singleRecord?'json_data_conf[sawing]':'c_process['.$key.'][json_data_conf][sawing]', 
'value'=>@$processDataConf['sawing']])