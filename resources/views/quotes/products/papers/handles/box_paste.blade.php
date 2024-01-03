@php
    $key_stage = \TDConst::BOX_PASTE;
    $paper_box_device = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][machine]',
        'type' => 'linking',
        'note' => 'thiết bị',
        'value' => @$data_handle['machine'] ?? getDeviceId(['key_device' => $key_stage, 'supply' => 'paper', 'default_device' => 1]),
        'other_data' => ['data' => ['table' => 'devices', 'where' => ['key_device' => $key_stage], 'select' => ['id', 'name']]]
    ] 
@endphp

<div class="d-flex align-items-center">
    @include('view_update.view', $paper_box_device)
    <div class="d-block">
        <p class="ml-2 color_red fs-12 font-italic mb-1">Dán hộp tay dành cho sản phẩm nhỏ hoặc dị dạng</p>
        <p class="ml-2 color_red fs-12 font-italic">(VD: Hộp nhỏ là chiều song song với cạnh dán dưới 12cm là không được sử dụng máy tự động)</p>
    </div>
</div>