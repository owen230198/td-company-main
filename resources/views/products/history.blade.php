@extends('index')
@section('content')
    @include('title_base_page')
    <div class="dashborad_content">
        @if (!empty($list_data))
            <ul>
                @foreach ($list_data as $item)
                    <li class=" mb-2 pb-2 border_bot_eb">
                        Thời gian: <span class="color_green font_bold">{{ getDateTimeFormat($item->created_at) }}</span>,
                        nhân viên kho: <span class="color_main font_bold">{{ getFieldDataById('name', 'n_users', $item->created_by) }}</span>
                        đã xác nhận {{ $item->action == 'import' ? 'nhập kho' : 'xuất kho' }} <span class="color_red font_bold">{{ $item->qty }}</span> sản phẩm,
                        số lượng vật tư đã thay đổi từ <span class="color_red font_bold">{{ $item->old_qty }}</span> thành <span class="color_red font_bold">{{ $item->new_qty }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection