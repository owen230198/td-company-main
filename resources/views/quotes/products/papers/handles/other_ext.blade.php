<div class="d-flex align-items-center">
    @php
        $key_stage = \App\Constants\TDConstant::OTHER_EXT;
        $paper_other_ext = [
            'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][price]',
            'note' => 'Chi phí 1 sản phẩm',
            'attr' => ['type_input' => 'number'],
            'value' => 0
        ] 
    @endphp
    @include('view_update.view', $paper_other_ext)
    <span class="ml-2 fs-12 font-italic color_red">Điền chi phí vật tư khác cho 1 sản phẩm nếu có phát sinh</span>
</div>
@php
    $paper_other_note = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][note]',
        'type' => 'textarea',
        'note' => 'ghi chú'
    ] 
@endphp
@include('view_update.view', $paper_other_note)