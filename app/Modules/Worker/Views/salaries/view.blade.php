@extends('Worker::index')
@section('content')
    <div class="worker_salary_table">
        <table>
            <caption>{{ $title }} - Công nhân: {{ \Worker::getCurrent('name') }}</caption>
            <thead>
                <tr>
                    <th scope="col">Mã lệnh</th>
                    <th scope="col">Tên lệnh</th>
                    <th scope="col">Chi tiết sản xuất</th>
                    <th scope="col">Thời gian chấm công</th>
                    <th scope="col">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collection as $item)
                    
                @endforeach
            </tbody>
        </table>
    </div>    
@endsection