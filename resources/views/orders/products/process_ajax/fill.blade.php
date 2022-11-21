@include('orders.products.checkbox', 
['name'=>@$singleRecord?'json_data_conf[fill]':'c_process['.$key.'][json_data_conf][fill]', 
'value'=>@$processDataConf['fill']])