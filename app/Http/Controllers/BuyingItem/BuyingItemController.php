<?php
    namespace App\Http\Controllers\BuyingItem;
    use App\Http\Controllers\Controller;
    use App\Models\BuyingItem;
    class BuyingItemController extends Controller
    {
        function __construct()
        {
            parent::__construct();
        }

        public function update($request, $id)
        {
            $table = 'buying_items';
            $dataItem = BuyingItem::find($id);
            if (!$request->isMethod('POST')) {
                $data = $this->admins->getDataActionView($table, __FUNCTION__, 'Chi tiết');
                $data['nosidebar'] = $request->input('nosidebar');
                $dataItem['supply'] = BuyingItem::where('parent', $id)->get();
                $data['dataItem'] = $dataItem;
                $data['action_url'] = url('update/'.$table.'/'.$id);
                $data['field_note'] = [
                    'name' => 'note',
                    'note' => 'Ghi chú',
                    'type' => 'textarea',
                    'min_label' => 175,
                    'value' => @$dataItem->note
                ];
                return view('buying_items.view', $data);
            }else{
                $data = $request->except('_token');
                $validate = BuyingItem::validate($data['supply']);
                if (@$validate['code'] == 100) {
                    return $validate;
                }
                $data_update = reset($data['supply']);
                $data_update['note'] = @$data['note'];
                $update = BuyingItem::where('id', $id)->update($data_update);
                if ($update) {
                    logActionUserData(__FUNCTION__, $table, $id, $dataItem);
                    return returnMessageAjax(200, 'Cập nhật dữ liệu thành công!', getBackUrl());
                }else {
                    return returnMessageAjax(100, 'Lỗi không xác định !');
                }
            }    
        }
    }
