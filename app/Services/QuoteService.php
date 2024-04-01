<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Customer;
use App\Models\Product;
use App\Constants\TDConstant;
use App\Models\NGroupUser;
use PhpOffice\PhpWord\TemplateProcessor;

class QuoteService extends BaseService
{
	function __construct()
	{
		parent::__construct();
	}
    public function dataActionCustomer($customer_id, $data_customer)
    {
        $data_quote = $data_customer;
        if (empty($customer_id)) {
            $this->configBaseDataAction($data_customer);
            $data_customer['code'] = Customer::getInsertCode();
            $data_customer['status'] = 0;
            $customer_id = Customer::insertGetId($data_customer);
            logActionUserData('insert', 'customers', $customer_id);
        }
        $data_quote['seri'] = 'BG-'.getCodeInsertTable('quotes');
        $data_quote['customer_id'] = $customer_id;
        $data_quote['company_name'] = $data_customer['name'];
        return $data_quote;
    }

    public function getPaperSizeAjax(&$data){
        $data['size_length'] = (($data['length'] + $data['width']) * 2 + $data['edge']) * $data['nqty_length'];
        if ($data['nqty_height'] > 1 && $data['nqty_height'] < 7) {
            $data['size_height']  = $data['height'] + 0 + $data['lid'] + $data['nqty_space']; 
        }else{
            $data['size_height'] = ($data['height'] + 0 + $data['lid'] + $data['bottom']);
        }
        $temp_length = $data['size_length'] + 10;
        $temp_height = $data['size_height'] + 10;
        if ($temp_length < $temp_height) {
            $temp_length = $temp_length + $data['min_paper_size'];
        }else{
            $temp_height = $temp_height + $data['min_paper_size']; 
        }
        $data['temp_length'] = $temp_length / 10;
        $data['temp_height'] = $temp_height / 10;
        $data['optimal_length'] = $temp_length / 1000;
        $data['optimal_width'] = $temp_height / 1000;
    }

    private function productValidate($data, $key, $step){
        $num = $key + 1;
        if (empty($data['name'])) {
            return returnMessageAjax(100, 'Bạn chưa nhập tên cho sản phẩm '. $num);
        }else{
            if (empty($data['qty'])) {
                return returnMessageAjax(100, 'Số lượng sản phẩm '. $data['name']. ' không hợp lệ !');
            }
            if (empty($data['category'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn nhóm sản phẩm cho '. $data['name']);
            }
            if (NGroupUser::isSale() && empty($data['sale_shape_file'])) {
                return returnMessageAjax(100, 'Bạn chưa upload file khuôn tính giá cho sản phẩm '. $data['name']);
            }

            // if (empty($data['length'])) {
            //     return returnMessageAjax(100, 'Bạn chưa nhập kích thước chiều dài cho '. $data['name']);
            // }
            // if (empty($data['width'])) {
            //     return returnMessageAjax(100, 'Bạn chưa nhập kích thước chiều rộng cho '. $data['name']);
            // }
            // if (empty($data['height'])) {
            //     return returnMessageAjax(100, 'Bạn chưa nhập kích thước chiều cao cho '. $data['name']);
            // }
            if (empty($data['design'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn mẫu thiết kế cho sản phẩm '. $data['name']);
            }
            if ($step == TDConstant::ORDER_ACTION_FLOW) {
                if (NGroupUser::isSale() && empty($data['custom_design_file']) && $data['design'] == 5) {
                    return returnMessageAjax(100, 'Bạn chưa upload file thiết kế của khách hàng cho sản phẩm '. $data['name']);
                }
                if (NGroupUser::isTechApply() && empty($data['tech_shape_file'])) {
                    return returnMessageAjax(100, 'Bạn chưa upload file sản xuất giá cho sản phẩm '. $data['name']);
                }
                if (NGroupUser::isDesign()) {
                    if (empty($data['design_file'])) {
                        return returnMessageAjax(100, 'Bạn chưa upload file thiết kế cho sản phẩm '. $data['name']);
                    }
                    if (empty($data['design_shape_file'])) {
                        return returnMessageAjax(100, 'Bạn chưa upload file thiết kế đã bình cho sản phẩm '. $data['name']);
                    }
                }
                if (NGroupUser::isTechHandle() && empty($data['handle_shape_file'])) {
                    return returnMessageAjax(100, 'Bạn chưa upload khuôn ép nhũ, thúc nổi, in UV cho sản phẩm '. $data['name']);
                }
            }
        }
        return returnMessageAjax(200, 'Cập nhật thành công dữ liệu !');
    }

    public function getDataActionProduct($data){
        if (!empty($data['quote_id'])) {
            !empty($data_action['quote_id'] = $data['quote_id']);
        }
        if (!empty($data['name'])) {
            $data_action['name'] = $data['name'];
        }
        if (!empty($data['qty'])) {
            $data_action['qty'] = $data['qty'];
            $data_action['outside_qty'] = $data['qty'];
        }
        $data_action['detail'] = @$data['detail'];
        if (!empty($data['id'])) {
            $data_action['id'] = $data['id'];
        }
        if (!empty($data['length'])) {
            $data_action['length'] = $data['length'];
        }
        if (!empty($data['width'])) {
            $data_action['width'] = $data['width'];
        }
        if (!empty($data['height'])) {
            $data_action['height'] = $data['height'];
        }
        if (!empty($data['category'])) {
            $data_action['category'] = $data['category'];
        }
        if (!empty($data['product_style'])) {
            $data_action['product_style'] = $data['product_style'];
        }
        if (!empty($data['design'])) {
            $data_action['design'] = $data['design'];
        }
        if (!empty($data['size'])) {
            $data_action['size'] = json_encode($data['size']);
        }
        if (!empty($data['custom_design_file'])) {
            $data_action['custom_design_file'] = $data['custom_design_file'];
        }
        if (!empty($data['sale_shape_file'])) {
            $data_action['sale_shape_file'] = $data['sale_shape_file'];
        }
        if (!empty($data['tech_shape_file'])) {
            $data_action['tech_shape_file'] = $data['tech_shape_file'];
        }
        if (!empty($data['design_file'])) {
            $data_action['design_file'] = $data['design_file'];
        }
        if (!empty($data['design_shape_file'])) {
            $data_action['design_shape_file'] = $data['design_shape_file'];
        }
        if (!empty($data['handle_shape_file'])) {
            $data_action['handle_shape_file'] = $data['design_shape_file'];
        }
        if (!empty($data['note'])) {
            $data_action['note'] = json_encode($data['note']);
        }  
        $this->configBaseDataAction($data_action);
        return $data_action;
    }

    public function processProduct($data, $step, $key = 0)
    {
        if ($step != \StatusConst::NO_VALIDATE) {
            $product_valid = $this->productValidate($data, $key, $step);
            if (@$product_valid['code'] == 100) {
                return $product_valid;    
            }
        }
        $data_process = $this->getDataActionProduct($data);
        if (!empty($data['id'])) {
            Product::where('id', $data['id'])->update($data_process);
            return $data['id'];
        }else{
            return Product::insertGetId($data_process);
        }
    }

    public function processSupply($product_id, $data_product)
    {
        $elements = TDConstant::HARD_ELEMENT;
        foreach ($elements as $element) {
            if (!empty($data_product[$element['pro_field']])) {
                $model = getModelByTable($element['table']);
                $process = $model->processData($product_id, $data_product, $element['pro_field']);
            }
        }
        return !empty($process);
    }

    public function processDataProduct($data, $arr_quote = [], $step = TDConstant::QUOTE_FLOW)
    {
        if (empty($data['product'])) {
            return returnMessageAjax(100, 'Bạn chưa có thông tin sản phẩm nào !');
        }
        $data_product = $data['product'];
        foreach ($data_product as $key => $product) {
            if (!empty($arr_quote['id'])) {
                $product['quote_id'] = $arr_quote['id'];
            }
            $product_process = $this->processProduct($product, $step, $key);
            if (!empty($product_process['code']) && $product_process['code'] == 100) {
                return $product_process;
                break;
            }else{
                $this->processSupply($product_process, $product);
            }
        }
        if (!empty($arr_quote)) {
            if ($step == TDConstant::QUOTE_FLOW) {
                RefreshQuotePrice($arr_quote);
            }else{
                refreshQuoteProfit($arr_quote);
            }
        }else{
            return !empty($product_id) ? $product_id : false;
        }
    }

    public function getCustomerSelectDataView($id)
    {
        $data['data_customer'] = Customer::find($id);
        $data['fields'] = Customer::FIELD_UPDATE;
        return $data;
    }

    public function selectCustomerUpdateQuote($request, $id = 0)
    {
        $data_customer = $request->except('_token', 'step', 'customer_id');
        $customer_id = $request->input('customer_id');
        $data_quote = $this->dataActionCustomer($customer_id, $data_customer);
        if (!empty($id)) {
            $update = \DB::table('quotes')->where('id', $id)->update($data_quote);
            if ($update) {
                logActionUserData('update_customer', 'quotes', $id, $data_customer);
            }
        }else{
            $data_quote['status'] = \StatusConst::NOT_ACCEPTED;
            (new \BaseService)->configBaseDataAction($data_quote);
            $insert_id = \DB::table('quotes')->insertGetId($data_quote);
            if ($insert_id) {
                logActionUserData('insert_customer', 'quotes', $insert_id, $data_customer);
            }
        }
        $redr = !empty($insert_id) ? 'insert/quotes?step=handle_config&id='.$insert_id : 'update/quotes/'.$id.'?step=handle_config';
        return returnMessageAjax(200, '', asset($redr));
    }

    public function processDataQuote($request, $arr_quote)
    {
        $data = $request->except('_token', 'step');
        if (empty($data['product'])) {
            return returnMessageAjax(100, 'Không tìm thấy sản phẩm !');
        }else{
            $status = $this->processDataProduct($data, $arr_quote);
            return $status;
        }
    }

    private function getArrValueExportQuote($product, $main_paper, $arr_quote, $num = 1)
    {
        $arr['pro_num'] = $num;
        $arr['pro_name'] = $product['name'];
        $arr['paper_materal'] = getFieldDataById('name', 'materals', $main_paper['size']['materal']);
        $arr['pro_size'] = getSizeTitleProduct($product);
        $arr['pro_design'] = getFieldDataById('name', 'design_types', $product['design']);
        if (!empty($main_paper['print'])) {
            $arr['paper_print_tech'] = getTextdataPaperStage(\TDConst::PRINT, @$main_paper['print']['machine']);
        }
        $arr['paper_finish'] = getTextQuoteFinish($main_paper);
        $arr['product_detail'] = $product['detail'];
        $arr['pro_qty'] = @$product['qty'];
        $each_price = $product['total_amount'] / (int) @$product['qty'];
        $arr['pro_price'] = number_format($each_price, 3);
        $arr['pro_total'] = number_format(round($product['total_amount'], -3));
        return $arr;
    }

    public function export($arr_quote, $customer, $products)
    {
        $templateProcessor = new TemplateProcessor(base_path('public/frontend/admin/templates/words/quote_template.docx'));
        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
        $templateProcessor->setValue('customer_name', @$customer['name']);
        $templateProcessor->setValue('customer_contacter', @$customer['contacter']);
        $templateProcessor->setValue('customer_phone', @$customer['phone']);
        $templateProcessor->setValue('customer_address', @$customer['address']);
        $templateProcessor->setValue('customer_email', @$customer['email']);

        $list_pro = [];
        foreach ($products as $key => $product) {
            $main_paper = getDataProExportFile($product);
            $num = $key + 1;
            $arr_value = $this->getArrValueExportQuote($product, $main_paper, $arr_quote, $num);
            array_push($list_pro, $arr_value);
        }
        if (count($list_pro) > 0) {
            $templateProcessor->cloneRowAndSetValues('pro_num', $list_pro);
        }
        $templateProcessor->setValue('quote_total', number_format(round((int) @$arr_quote['total_amount'], -3)));
        $user = getDetailDataByID('NUser', @$arr_quote['created_by']);
        $templateProcessor->setValue('user_name', @$user['name']);
        $templateProcessor->setValue('user_phone', @$user['phone']);
        // $fileName = date('m-d-Y', Time()).'_'.$arr_quote['seri'].'_'.getFieldDataById('name', 'products', $products[0]['id']).'_'.$arr_quote['name'].".docx";
        $fileName = date('m-d-Y', Time()).'_'.$arr_quote['seri'].".docx";
        $fileStorage = public_path($fileName);
        $templateProcessor->saveAs($fileStorage);
        return response()->download($fileStorage);
    }
}
