<h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
    <p class="mb-1">{{ $supp_index == 0 ? 'Phần vật tư '.@$name : 'Vật tư '.@$name.' thêm '.$supp_index }}</p>
    @if (!empty($divide))
        <p class="mb-1">Kích thước tấm {{ @$name }} là {{ $divide[0] }} x {{ $divide[1] }}cm</p>
    @endif
    @if (!empty($supply_obj->id))
        <a href="{{ url('print-data/supplies/'.$supply_obj->id) }}" target="_blank" class="main_button color_white bg_green border_green radius_5 font_bold sooth">
            <i class="fa fa-print mr-2 fs-14" aria-hidden="true"></i> In lệnh
        </a>
    @endif
</h3>