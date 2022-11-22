<select 
name="{{ @$singleRecord?'json_data_conf[finished_type]':'c_process['.$key.'][json_data_conf][finished_type]' }}" 
class="form-control">
    <option value="0" {{ @$dataConfProcess['finished_type']==0?'selected':'' }}>Chọn loại thành phẩm</option>
    <option value="1" {{ @$dataConfProcess['finished_type']==1?'selected':'' }}>Đóng gói</option>
    <option value="2" {{ @$dataConfProcess['finished_type']==2?'selected':'' }}>Bỏ thùng</option>
</select>