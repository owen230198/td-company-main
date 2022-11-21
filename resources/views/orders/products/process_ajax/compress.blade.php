@include('orders.products.checkbox', 
['name'=>@$singleRecord?'json_data_conf[compress]':'c_process['.$key.'][json_data_conf][compress]', 
'value'=>@$processDataConf['compress']])