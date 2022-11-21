@include('orders.products.checkbox', 
['name'=>@$singleRecord?'json_data_conf[jump]':'c_process['.$key.'][json_data_conf][jump]', 
'value'=>@$processDataConf['jump']])