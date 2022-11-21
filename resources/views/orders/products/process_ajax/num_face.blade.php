<select name="{{ @$singleRecord?'num_face':'c_process['.$key.'][json_data_conf][num_face]' }}" class="form-control">
    <option value="0">Chọn số mặt cán</option>
    @for($i = 1; $i<3; $i++)
        <option value="{{ $i }}" {{ @$dataItem['num_face']==$i?'selected':'' }}>
            {{ $i }} mặt
        </option>   
    @endfor
</select>