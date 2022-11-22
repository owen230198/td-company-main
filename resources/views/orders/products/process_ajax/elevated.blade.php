@include('orders.products.checkbox', 
['name'=>@$singleRecord?'json_data_conf[elevated]':'c_process['.$key.'][json_data_conf][elevated]', 
'value'=>@$dataConfProcess['elevated']])