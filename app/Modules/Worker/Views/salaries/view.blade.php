@extends('Worker::index')
@section('content')
    <div class="worker_table_salary">
        <table class="table table-responsive-sm table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Tuổi</th>
                    <th scope="col">Địa chỉ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Nguyễn Văn A</td>
                    <td>25</td>
                    <td>Hà Nội</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Trần Thị B</td>
                    <td>23</td>
                    <td>Đà Nẵng</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Lê Văn C</td>
                    <td>27</td>
                    <td>Hồ Chí Minh</td>
                </tr>
            </tbody>
        </table>
    </div>    
@endsection