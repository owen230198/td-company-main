@include('orders.products.checkbox', 
['name'=>@$singleRecord?'json_data_conf[pin]':'c_process['.$key.'][json_data_conf][pin]', 
'value'=>@$dataConfProcess['pin']])