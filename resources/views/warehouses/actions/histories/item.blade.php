Thời gian: <span class="color_green font_bold">{{getDateTimeFormat($created_at) }}</span>, 
nhân viên: <span class="color_main font_bold">{{ getFieldDataById('name', 'n_users', $created_by) }}</span>
@if (@$exported > 0)
    đã xác nhận xuất <span class="color_red font_bold">{{ $exported }}</span> vật tư,
    @if (!empty($product))
        cho việc sản xuất sản phẩm <span class="color_red font_bold">{{ getFieldDataById('name', 'products', $product) }}</span>,
    @endif
@else
    đã nhập thêm <span class="color_red font_bold">{{ $imported }}</span> vật tư, 
    từ nhà cung cấp <span class="font_bold">{{ getFieldDataById('name', 'warehouse_providers', $provider) }}</span>, 
    với giá: <span class="font_bold color_red">{{ number_format((float) $price) }}đ</span>, 
    @php
        $file_bill = !empty($bill) ? json_decode($bill, true) : [];
    @endphp
@if (!empty($file_bill['path']))
    tải về file hóa đơn nhập vật tư <a href="{{ url('file-download?path='.@$file_bill['path']) }}" target="_blank" class="color_green font_bold">tại đây</a>.
@endif
@endif
số lượng vật tư đã thay đổi từ <span class="color_red font_bold">{{ $ex_inventory }}</span> thành <span class="color_red font_bold">{{ $inventory }}</span>,
