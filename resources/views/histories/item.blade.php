@php
    $user = getDetailDataByID('NUser', $history->user);
    $is_collapse = @$type_detail == 'collapse';
    $collapse_id = 'collapse_detail_history_' . $history->id;
@endphp
<div class="mb-2 pb-2 border_bot_eb">
    <div class="d-flex justify-content-between align-items-center">
        <div class="history_content">
            <span class="color_green font_bold">{{ getDateTimeFormat($history->created_at) }}</span>,
            {{ getFieldDataById('name', 'n_group_users', $user->group_user) . ' : ' }}
            <span class="color_green font_bold">{{ @$user->name }}</span>
            đã {{ getActionHistory($history->action) }}
            <strong class="ml-1 color_green">{{ $history->name }}</strong>
        </div>
        <div class="history_detail">
            @if ($is_collapse)
                <p>
                    <a class="btn btn-primary main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth ml-3" 
                        data-toggle="collapse" href="#{{ $collapse_id }}" role="button"
                        aria-expanded="false" aria-controls="{{ $collapse_id }}">Chi tiết dữ liệu</a>
                </p>
            @else
                <button type="button"
                    class="btn btn-primary main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth ml-3 load_view_popup"
                    data-toggle="modal" data-target="#actionModal" data-src={{ url('history-detail/' . $history->id) }}>
                    <i class="fa fa-info-circle mr-2 fs-15" aria-hidden="true"></i>Xem chi tiết thay đổi dữ liệu
                </button>
            @endif
        </div>
    </div>
    @if ($is_collapse)
        @php
            $view_action = $history->action == 'insert' ? 'insert' : 'update';
        @endphp
        <div class="row">
            <div class="col-6">
                <div class="collapse multi-collapse" id="{{ $collapse_id }}">
                    <div class="card card-body bg_eb">
                        @php
                            $view_action = $data->action == 'insert' ? 'insert' : 'update';
                        @endphp
                        @include('histories.' . $view_action, [
                            'detail_data' => $data->detail_data,
                            'table_map' => $data->table_map,
                        ])
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
