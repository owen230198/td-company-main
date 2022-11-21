<select name="{{ @$singleRecord?'roll':'c_process['.$key.'][json_data_conf][roll]' }}" class="form-control">
    <option value="0">Không cán</option>
    <option value="1"{{ @$dataItem['roll']==1?'selected':'' }}>Cán bóng</option>
    <option value="2"{{ @$dataItem['roll']==2?'selected':'' }}>Cán mờ</option>
</select>