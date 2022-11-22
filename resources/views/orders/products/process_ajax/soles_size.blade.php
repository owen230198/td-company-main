<input type="text" class="form-control" 
name="{{ @$singleRecord?'json_data_conf[soles_size]':'c_process['.$key.'][json_data_conf][soles_size]' }}" 
    value="{{ @$dataConfProcess['soles_size'] }}">