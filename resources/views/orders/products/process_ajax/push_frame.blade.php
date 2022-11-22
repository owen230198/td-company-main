<select 
name="{{ @$singleRecord?'json_data_conf[push_frame]':'c_process['.$key.'][json_data_conf][push_frame]' }}" 
class="form-control">
    <option value="0">Không khuôn</option>
    <option value="1" {{ @$dataConfProcess['push_frame']==1?'selected':'' }}>Khuôn mới</option>
    <option value="2" {{ @$dataConfProcess['push_frame']==2?'selected':'' }}>Khuôn cũ</option>
</select>