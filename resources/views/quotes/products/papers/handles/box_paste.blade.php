@php
    $key_stage = \App\Constants\TDConstant::BOX_PASTE;
    $paper_box_device = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][machine]',
        'type' => 'linking',
        'note' => 'thiết bị',
        'value' => getDeviceIdByKey($key_stage, \App\Constants\TDConstant::AUTO_DEVICE),
        'other_data' => ['data' => ['table' => 'devices', 'where' => ['key_device' => $key_stage], 'select' => ['id', 'name']]]
    ] 
@endphp

<div class="d-flex align-items-center">
    @include('view_update.view', $paper_box_device)
    <span class="ml-2 color_red fs-12 font-italic">(Dán hộp tay dành cho sản phẩm nhỏ hoặc dị dạng)</span>
</div>