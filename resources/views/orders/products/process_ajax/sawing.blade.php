@include('orders.products.checkbox', 
['name'=>@$singleRecord?'json_data_conf[sawing]':'c_process['.$key.'][json_data_conf][sawing]', 
'value'=>@$processDataConf['sawing']])