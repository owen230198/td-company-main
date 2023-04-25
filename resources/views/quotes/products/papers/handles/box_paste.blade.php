@php
    $key_stage = \TDConst::BOX_PASTE;
    $paper_box_device = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][machine]',
        'type' => 'linking',
        'note' => 'thiết bị',
        'value' => !empty($data_paper->id) ? @$data_handle['machine'] : getDeviceId(['key_device' => $key_stage, 'supply' => 'paper', 'default_device' => 1]),
        'other_data' => ['data' => ['table' => 'devices', 'where' => ['key_device' => $key_stage], 'select' => ['id', 'name']]]
    ] 
@endphp

<div class="d-flex align-items-center">
    @include('view_update.view', $paper_box_device)
    <span class="ml-2 color_red fs-12 font-italic">(Dán hộp tay dành cho sản phẩm nhỏ hoặc dị dạng)</span>
</div>