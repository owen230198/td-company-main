@include('orders.products.checkbox', 
['name'=>@$singleRecord?'json_data_conf[sew]':'c_process['.$key.'][json_data_conf][sew]', 
'value'=>@$processDataConf['sew']])