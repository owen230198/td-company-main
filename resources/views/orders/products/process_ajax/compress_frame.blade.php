<select name="{{ @$singleRecord?'json_data_conf[compress_frame]':
'c_process['.$key.'][json_data_conf][compress_frame]' }}" class="form-control">
    <option value="0">Không khuôn</option>
    <option value="1" {{ @$dataConfProcess['compress_frame']==1?'selected':'' }}>Khuôn mới</option>
    <option value="2" {{ @$dataConfProcess['compress_frame']==2?'selected':'' }}>Khuôn cũ</option>
</select>