@php
    $num = $findex + 1;
    $note =$findex > 0 ? 'ĐG các công đoạn hoàn thiện ('.$num.')' : 'ĐG các công đoạn hoàn thiện';
    $data_select_finish = [
        'other_data' => [
            'config' => ['search' => 1], 
            'data' => ['table' => 'fill_finish_prices', 'where' => ['type' => \App\Constants\TDConstant::FINISH]]
        ],
        'name' => 'product['.$j.'][fill_finish][finish]['.$findex.'][stage]',
        'type' => 'linking',
        'note' => $note
    ]
@endphp
<div class="quote_fill_finish_item position-relative" data-index={{ $findex }}>
    @if ($findex > 0)
        <span class="remove_ext_paper_quote d-flex remove_ff_quote color_red smooth"><i class="fa fa-times" aria-hidden="true"></i></span> 
    @endif
    @include('view_update.view', $data_select_finish)
</div>