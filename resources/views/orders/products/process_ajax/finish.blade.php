@include('orders.products.checkbox', 
['name'=>@$singleRecord?'json_data_conf[finish]':'c_process['.$key.'][json_data_conf][finish]', 
'value'=>@$dataConfProcess['finish']])