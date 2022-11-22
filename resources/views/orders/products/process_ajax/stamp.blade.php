@include('orders.products.checkbox', 
['name'=>@$singleRecord?'json_data_conf[stamp]':'c_process['.$key.'][json_data_conf][stamp]', 
'value'=>@$dataConfProcess['stamp']])