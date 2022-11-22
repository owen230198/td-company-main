@include('orders.products.checkbox', 
['name'=>@$singleRecord?'json_data_conf[glue]':'c_process['.$key.'][json_data_conf][glue]', 
'value'=>@$dataConfProcess['glue']])