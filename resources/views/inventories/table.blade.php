<div class="table_base_view position-relative">
    <table class="table table-bordered mb-2 table_main">
        <theader>
            <tr>
                <th class="font-bold fs-13 text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <span>#</span>
                    </div>
                </th>
                <th class="font-bold fs-13">Tên hàng</th>
            </tr>
        </theader>
        <tbody>
            @foreach ($list_data as $key => $data)
                <tr>
                    <td class="text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <span>{{ $key + 1 }}</span>
                        </div>
                    </td>
                    <td>
                        {{ $data['name'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>