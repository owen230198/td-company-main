<select name="{{ @$singleRecord?'emul_color':'c_process['.$key.'][json_data_conf][emul_color]' }}" class="form-control">
    <option value="0" {{ @$dataItem['emul_color']==0?'selected':'' }}>Vàng</option>
    <option value="1" {{ @$dataItem['emul_color']==1?'selected':'' }}>Bạc</option>
    <option value="2" {{ @$dataItem['emul_color']==2?'selected':'' }}>Khác</option>
</select>