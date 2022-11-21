@include('orders.products.checkbox', 
['name'=>@$singleRecord?'json_data_conf[grooved]':'c_process['.$key.'][json_data_conf][grooved]', 
'value'=>@$processDataConf['grooved']])