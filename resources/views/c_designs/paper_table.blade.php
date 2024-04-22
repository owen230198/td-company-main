<table class="table table-bordered my-4">
    <tr>
        <th class="font-bold fs-13 text-center"><span>#</span></th>
        <th class="font-bold fs-13">Tên tờ in</th>
        <th class="font-bold fs-13">Kiểu in</th>
        <th class="font-bold fs-13">Cán nilon</th>
        <th class="font-bold fs-13">Ép nhũ</th>
        <th class="font-bold fs-13">In lưới UV</th>
        <th class="font-bold fs-13">Thúc nổi</th>
    </tr>
    <tbody>
        @foreach ($data_paper as $key => $paper)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td class="text-center">{{ $paper->name }}</td>
                <td class="text-center">
                    @php
                        $print = !empty($paper->print) ? json_decode($paper->print, true) : [];
                    @endphp 
                    {{ !empty($print['machine']) ? getTextdataPaperStage(\TDConst::PRINT, $print['machine']) : "Không" }}   
                </td>
                <td class="text-center">
                    @php
                        $nilon = !empty($paper->nilon) ? json_decode($paper->nilon, true) : [];
                    @endphp 
                    {{ !empty($nilon) ? getTextdataPaperStage(\TDConst::NILON, $nilon) : "Không"}}   
                </td>
                <td class="text-center">
                    @php
                        $compress = !empty($paper->compress) ? json_decode($paper->compress, true) : [];
                    @endphp 
                    {{ !empty($compress['act']) ? 'Có' : "Không"}}   
                </td>
                <td class="text-center">
                    @php
                        $uv = !empty($paper->uv) ? json_decode($paper->uv, true) : [];
                    @endphp 
                    {{ !empty($uv['materal']) ? getTextdataPaperStage(\TDConst::UV, $uv) : "Không"}}   
                </td>
                <td class="text-center">
                    @php
                        $float = !empty($paper->float) ? json_decode($paper->float, true) : [];
                    @endphp 
                    {{ !empty($float['act']) ? 'Có' : "Không"}}   
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
