<select 
name="{{ @$singleRecord?'json_data_conf[soles_roll]':'c_process['.$key.'][json_data_conf][soles_roll]' }}" 
class="form-control">
    <option value="0" {{ @$dataConfProcess['soles_roll']==0?'selected':'' }}>Chọn đế cán</option>
    <option value="1" {{ @$dataConfProcess['soles_roll']==1?'selected':'' }}>Đế cán bóng</option>
    <option value="2" {{ @$dataConfProcess['soles_roll']==2?'selected':'' }}>Đế cán mờ</option>
</select>