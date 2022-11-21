<input type="text" class="form-control" name="{{ @$singleRecord?'finished_size':'c_process['.$key.'][json_data_conf][finished_size]' }}" 
    value="{{ @$dataItem['finished_size'] }}">