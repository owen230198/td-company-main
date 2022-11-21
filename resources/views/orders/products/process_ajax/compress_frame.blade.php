<select name="{{ @$singleRecord?'compress_frame':'c_process['.$key.'][json_data_conf][compress_frame]' }}" class="form-control">
    <option value="0">Không khuôn</option>
    <option value="1" {{ @$dataItem['compress_frame']==1?'selected':'' }}>Khuôn mới</option>
    <option value="2" {{ @$dataItem['compress_frame']==2?'selected':'' }}>Khuôn cũ</option>
</select>