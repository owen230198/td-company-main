<input type="text" class="form-control" 
name="{{ @$singleRecord?'json_data_conf[finished_size]':'c_process['.$key.'][json_data_conf][finished_size]' }}" 
value="{{ @$dataConfProcess['finished_size'] }}">