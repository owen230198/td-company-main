<input type="text" class="form-control" 
name="{{ @$singleRecord?'json_data_conf[crop]':'c_process['.$key.'][json_data_conf][crop]' }}" 
value="{{ @$dataConfProcess['crop']??'Xén theo ốc' }}">