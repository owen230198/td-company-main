<select name="{{ @$singleRecord?'finished_style':'c_process['.$key.'][json_data_conf][finished_style]' }}" class="form-control">
    <option value="0" {{ @$dataItem['finished_style']==0?'selected':'' }}>Lò xo</option>
    <option value="1" {{ @$dataItem['finished_style']==1?'selected':'' }}>Nẹp</option>
    <option value="2" {{ @$dataItem['finished_style']==2?'selected':'' }}>Lò xo giữa</option>
</select>