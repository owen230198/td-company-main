<select 
name="{{ @$singleRecord?'json_data_conf[finished_style]':'c_process['.$key.'][json_data_conf][finished_style]' }}" 
class="form-control">
    <option value="0" {{ @$dataConfProcess['finished_style']==0?'selected':'' }}>Lò xo</option>
    <option value="1" {{ @$dataConfProcess['finished_style']==1?'selected':'' }}>Nẹp</option>
    <option value="2" {{ @$dataConfProcess['finished_style']==2?'selected':'' }}>Lò xo giữa</option>
</select>