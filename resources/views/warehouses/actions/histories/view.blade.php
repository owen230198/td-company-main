<div class="warehouse_history">
    <h3 class="fs-14 text-uppercase border_bot_eb pb-1 mb-4 text-center handle_title">
        Lịch sử xuất nhập vật tư {{ $dataItem['name'] }}
    </h3>
    <ul>
        @foreach ($data_item_log as $item_log)
            <li class=" mb-2 pb-2 border_bot_eb">
                @include('warehouses.actions.histories.item', $item_log)
            </li>
        @endforeach
    </ul>
    <div class="paginate_view d-flex align-center justify-content-between mt-4">
        {!! $data_item_log->appends(request()->input())->links('pagination::bootstrap-4') !!}
    </div>
</div>