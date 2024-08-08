@extends('Worker::index')
@section('content')
    <div class="worker_salary_table">
        <table>
            <h3 class="fs-14 text-uppercase my-lg-4 my-3 text-center handle_title color_green mx-auto">
                {{ $title }} - Công nhân: {{ \Worker::getCurrent('name') }}
            </h3>
            <h3 class="fs-14 my-lg-4 mb-3 color_main">
                <i class="fa fa-money mr-2 fs-14 color_green" aria-hidden="true"></i>
                Thu nhập hiện tại: {{ number_format($summary) }}đ
            </h3>     
            <caption class="text-center fs-16 font_bold color_red">TỔNG TIỀN: {{ number_format($summary) }}Đ</caption>
            <thead>
                <tr>
                    <th scope="col">Mã lệnh</th>
                    <th scope="col">Tên lệnh</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">ĐG lượt</th>
                    <th scope="col">ĐG lên khuôn</th>
                    <th scope="col">Hệ số</th>
                    <th scope="col">Thành tiền</th>
                    <th scope="col">Thời gian</th>
                    <th scope="col">Chi tiết</th>
                    <th scope="col">Phản hồi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_data as $item)
                    <tr>
                        <td data-label="Mã lệnh:">
                            {{ $item->command }}
                        </td>
                        <td data-label="Tên lệnh:">
                            {{ $item->name }}
                        </td>
                        <td data-label="Số lượng:">
                            {{ $item->qty }}
                        </td>
                        <td data-label="ĐG lượt:">
                            {{ number_format($item->work_price) }}đ
                        </td>
                        <td data-label="ĐG lên khuôn:">
                            {{ number_format($item->shape_price) }}đ
                        </td>
                        <td data-label="Hệ số:">
                            {{ $item->factor }}
                        </td>
                        <td data-label="Thành tiền:">
                            {{ number_format($item->total) }}đ
                        </td>
                        <td data-label="Thời gian:">
                            <div>
                                @include('view_table.datetime', ['value' => $item->submited_at])
                            </div>
                        </td>
                        <td data-label="Chi tiết:">
                            <div>
                                @include('view_table.json_name', ['value' => $item->handle])
                            </div>
                        </td>
                        <td data-label="Phản hồi:">
                            <button 
                            type="button" data-toggle="modal" data-target="#worker-feedback-{{ $item->id }}-modal" class="radius_5 box_shadow_3 btn btn-primary main_button smooth  font_bold text-center bg_green color_white __worker_feedback_btn" 
                            data-id={{ $item->id }}>
                                <i class="fa fa-quote-right fs-14 mr-1" aria-hidden="true"></i> Phản hồi
                            </button>
                            @include('Worker::commands.submit_modal', ['form' => 'form_feedback', 'm_name' => 'feedback-'.$item->id, 'data_command' => $item])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>    
@endsection