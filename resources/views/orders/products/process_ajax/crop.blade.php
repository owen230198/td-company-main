<input type="text" class="form-control" name="{{ @$singleRecord?'crop':'c_process['.$key.'][json_data_conf][crop]' }}" 
    value="{{ @$dataItem['crop']??'Xén theo ốc' }}">