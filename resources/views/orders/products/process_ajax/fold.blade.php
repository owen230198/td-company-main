@include('orders.products.checkbox', 
['name'=>@$singleRecord?'json_data_conf[fold]':'c_process['.$key.'][json_data_conf][fold]', 
'value'=>@$processDataConf['fold']])