<select 
name="{{ @$singleRecord?'json_data_conf[elevated_frame]':'c_process['.$key.'][json_data_conf][elevated_frame]' }}" 
class="form-control">
    <option value="0">Không khuôn</option>
    <option value="1" {{ @$dataConfProcess['elevated_frame']==1?'selected':'' }}>Khuôn mới</option>
    <option value="2" {{ @$dataConfProcess['elevated_frame']==2?'selected':'' }}>Khuôn cũ</option>
</select>