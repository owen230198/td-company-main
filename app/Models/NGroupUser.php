<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class NGroupUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'n_group_users';
    protected $protectFields = false;
    const ADMIN = 1;
    const SALE = 2;
    const TECH_APPLY = 3;
    const DESIGN = 4;
    const TECH_HANDLE = 5;
    const PLAN_HANDLE = 6;
    const WAREHOUSE = 7;
    const APPLY_BUYING = 8;
    const DO_BUYING = 10;
    const KCS = 11;
    const PRODUCT_WAREHOUSE = 12;
    const ACCOUNTING = 13;
    const PRODUCTION_MANAGER = 14;

    //group modules
    const GROUP_MODULE = [
        'customer' => 'KHÁCH HÀNG',
        'shape_file' => 'TÌM KHUÔN SẢN PHẨM',
        'customer_quote' => 'BÁO GIÁ - DUYỆT GIÁ',
        'order_handle' => 'ĐƠN HÀNG - TIẾN ĐỘ',
        'tech_module' => 'KỸ THUẬT - SẢN XUẤT',
        'quote_price_config' => 'CÀI ĐẶT ĐƠN GIÁ',
        'design_module' => 'LỆNH THIẾT KẾ',
        'profit' => '% HOA HỒNG',
        'report' => 'BÁO CÁO - THỐNG KÊ',
        'c_orders' => 'HÀNG SẴN CÔNG TY',
        'factory' => 'QUẢN LÝ NHÀ MÁY',
        'supply_buying' => 'MUA VẬT TƯ',
        'warehouse' => 'KHO VẬT TƯ',
        'receipt' => 'ĐỀ XUẤT CHI',
        'product_warehouse' => 'KHO THÀNH PHẨM',
        'handle_supply' => 'LỆNH XỬ LÝ VẬT TƯ',
        'account' => 'THÔNG TIN TÀI KHOẢN'
    ];

    //modules
    const MODULE = [
        'price_device' => [
            'name' => 'Đơn giá thiết bị máy',
            'link' => 'config-device-price/supply_types?type=devices',
            'group' => 'quote_price_config'
        ],
        'worker' =>[
            'name' => 'Quản lí công nhân',
            'link' => 'list-worker-by-device/machine',
            'group' => 'factory'
        ],
        'worker_salary' =>[
            'name' => 'Bảng lương công nhân',
            'link' => 'view/w_salaries?default_data=%7B%22status%22%3A%22submited%22%7D',
            'group' => 'factory'
        ],
        'price_materal' => [
            'name' => 'Đơn giá vật tư sx',
            'link' => 'config-device-price/supply_types?type=materals',
            'group' => 'quote_price_config'
        ],
        'product_category' => [
            'name' => 'Danh mục sản phẩm',
            'link' => 'view/product_categories',
            'group' => 'quote_price_config'
        ],
        'supply_extend' => [
            'name' => 'Các loại vật tư khác',
            'link' => 'view/supply_extends?default_data=%7B%22type%22%3A%22other_supply%22%7D',
            'group' => 'quote_price_config'
        ],
        'quote_config' => [
            'name' => 'Các thông số khác',
            'link' => 'view/quote_configs',
            'group' => 'quote_price_config'
        ],
        'customer_list' => [
            'name' => 'DS khách hàng',
            'link' => 'view/customers',
            'group' => 'customer'
        ],
        'represent_list' => [
            'name' => 'DS người liên hệ',
            'link' => 'view/represents',
            'group' => 'customer'
        ],
        'partner_list' => [
            'name' => 'DS đối tác sx',
            'link' => 'view/partners?default_data=%7B%22internal%22%3A%220%22%7D',
            'group' => 'customer'
        ],
        'find_shape' => [
            'name' => 'Tìm khuôn đã sản xuất',
            'link' => 'search-pattern',
            'group' => 'shape_file'
        ],
        'role_tech' => [
            'name' => 'Phân quyền kỹ thuật',
            'link' => 'view/n_users?default_data=%7B%22group_user%22%3A%22'.self::TECH_APPLY.'%22%7D',
            'group' => 'tech_module'
        ],
        'tech_need_accp' => [
            'name' => 'DS duyệt thiết kế',
            'link' => 'view/products?default_data=%7B%22status%22%3A%22'.\StatusConst::NOT_ACCEPTED.'%22%7D',
            'group' => 'tech_module'
        ],
        'tech_need_design' => [
            'name' => 'DS thiết kế',
            'link' => 'view/c_designs?default_data=%7B%22status%22%3A%22'.\StatusConst::NOT_ACCEPTED.'%22%7D',
            'group' => 'tech_module'
        ],
        'tech_need_handle' => [
            'name' => 'DS xử lí kỹ thuật',
            'link' => 'view/products?default_data=%7B%22status%22%3A%22'.Order::DESIGN_SUBMITED.'%22%7D',
            'group' => 'tech_module'
        ],
        'create_quote' => [
            'name' => 'Tính giá',
            'link' => 'insert/quotes',
            'group' => 'customer_quote'
        ],
        'quote_management' => [
            'name' => 'DS báo giá',
            'link' => 'view/quotes',
            'group' => 'customer_quote'
        ],
        'quote_not_accepted' => [
            'name' => 'DS báo giá (chưa duyệt)',
            'link' => 'view/quotes?default_data=%7B%22status%22%3A%22not_accepted%22%7D',
            'group' => 'customer_quote'
        ],
        'quote_accepted' => [
            'name' => 'DS báo giá (đã duyệt)',
            'link' => 'view/quotes?default_data=%7B%22status%22%3A%22accepted%22%7D',
            'group' => 'customer_quote'
        ],
        'quote_order_created' => [
            'name' => 'DS báo giá (đã tạo đơn)',
            'link' => 'view/quotes?default_data=%7B%22status%22%3A%22order_created%22%7D',
            'group' => 'customer_quote'
        ],
        'design_not_accepted' => [
            'name' => 'DS lệnh TK mới',
            'link' => 'view/c_designs?default_data=%7B%22status%22%3A%22not_accepted%22%7D',
            'group' => 'design_module'
        ],
        'designing_command' => [
            'name' => 'DS lệnh TK đang nhận',
            'link' => 'view/c_designs?default_data=%7B%22status%22%3A%22designing%22%7D',
            'group' => 'design_module'
        ],
        'design_submited' => [
            'name' => 'DS lệnh TK đã xong',
            'link' => 'view/c_designs?default_data=%7B%22status%22%3A%22design_submited%22%7D',
            'group' => 'design_module'
        ],
        'order_process' => [
            'name' => 'DS đơn hàng',
            'link' => 'view/orders',
            'group' => 'order_handle'
        ],
        'join_print' => [
            'name' => 'Lệnh in ghép',
            'link' => 'join-print-command',
            'group' => 'order_handle'
        ],
        'handle_process' => [
            'name' => 'Theo dõi sản xuất',
            'link' => 'view/products?default_data=%7B%22order_created":"1%22%7D&order_by=order,desc',
            'group' => 'order_handle'
        ],
        'submited_product' => [
            'name' => 'SP chờ duyệt bởi KCS',
            'link' => 'view/products?default_data=%7B%22status":"submited%22%7D',
            'group' => 'order_handle'
        ],
        'kcs_submited_product' => [
            'name' => 'SP chờ nhập kho',
            'link' => 'view/products?default_data=%7B%22status":"kcs_submited%22%7D',
            'group' => 'order_handle'
        ],
        'last_submited_product' => [
            'name' => 'SP trong kho',
            'link' => 'view/products?default_data=%7B%22status":"last_submited%22%7D',
            'group' => 'order_handle'
        ],
        'supp_bying_req' => [
            'name' => 'Yêu cầu mua vật tư',
            'link' => 'view/supply_buyings?default_data=%7B%22payment_type":"0%22%7D',
            'group' => 'supply_buying'
        ],
        'price_provider' => [
            'name' => 'Bảng giá theo NCC',
            'link' => 'supply-origin-management?type=paper',
            'group' => 'supply_buying'
        ],
        'profit' => [
            'name' => 'Lợi nhuận của tôi',
            'link' => 'myprofit',
            'group' => 'profit'
        ],
        'warehouse_management' => [
            'name' => 'Kho vật tư',
            'link' => 'warehouse-management',
            'group' => 'warehouse'
        ],
        'supply_history' => [
            'name' => 'Tổng hợp tồn kho',
            'link' => 'inventory-aggregate',
            'group' => 'warehouse'
        ],
        'warehouse_provider' => [
            'name' => 'Nhà cung cấp vật tư',
            'link' => 'view/warehouse_providers',
            'group' => 'warehouse'
        ],
        'supply_role' => [
            'name' => 'Quyền quản lí vật tư',
            'link' => 'view/n_users?default_data=%7B%22group_user%22%3A%22'.self::WAREHOUSE.'%22%7D',
            'group' => 'warehouse'
        ],
        'ex_supply' => [
            'name' => 'Yêu cầu xuất vật tư',
            'link' => 'view/c_supplies?default_data=%7B%22status%22%3A%22handling%22%7D',
            'group' => 'handle_supply'
        ],
        'c_supply_all' => [
            'name' => 'Phiếu xuất vật tư',
            'link' => 'view/c_supplies',
            'group' => 'handle_supply'
        ],
        'im_supply' => [
            'name' => 'Băng lề vật tư',
            'link' => 'view/supply_warehouses?default_data=%7B%22status%22%3A%22waiting%22%7D',
            'group' => 'handle_supply'
        ],
        'im_paper' => [
            'name' => 'Băng lề giấy in',
            'link' => 'view/print_warehouses?default_data=%7B%22status%22%3A%22waiting%22%7D',
            'group' => 'handle_supply'
        ],
        'product_management' => [
            'name' => 'Kho thành phẩm',
            'link' => 'view/product_warehouses',
            'group' => 'product_warehouse'
        ],
        'expertise' => [
            'name' => 'Yêu cầu nhập kho',
            'link' => 'view/c_expertises?default_data=%7B%22status%22%3A%22not_accepted%22%7D',
            'group' => 'product_warehouse'
        ],
        'product_history' => [
            'name' => 'Tổng hợp tồn kho',
            'link' => 'product-warehouse-inventory',
            'group' => 'product_warehouse'
        ],
        'move_warehouse' => [
            'name' => 'Phiếu chuyển kho',
            'link' => 'view/base_receipts',
            'group' => 'product_warehouse'
        ],
        'move_warehouse' => [
            'name' => 'DS đề xuất chi',
            'link' => 'view/c_payments',
            'group' => 'receipt'
        ],
        'insert_corder' => [
            'name' => 'Tạo phiếu bán hàng',
            'link' => 'insert/c_orders?type='.COrder::SELL,
            'group' => 'c_orders'
        ],
        'order_ready' => [
            'name' => 'Phiếu bán hàng',
            'link' => 'view/c_orders?type='.COrder::SELL,
            'group' => 'c_orders'
        ],
        'warehouse_type' => [
            'name' => 'Quản lý kho lưu',
            'link' => 'view/supply_extends?default_data=%7B%22type%22%3A%22warehouse_type%22%7D',
            'group' => 'product_warehouse'
        ],
        'order_debt' => [
            'name' => 'Công nợ bán hàng',
            'link' => 'order-debt?group=0',
            'group' => 'report'
        ],
        'supply_debt' => [
            'name' => 'Công nợ mua vật tư',
            'link' => 'supply-debt',
            'group' => 'report'
        ],
        'order_sales' => [
            'name' => 'Doanh số đơn hàng',
            'link' => 'report/orderSale',
            'group' => 'report'
        ],
        'user' => [
            'name' => 'Danh sách nhân viên',
            'link' => 'view/n_users',
            'group' => 'account'
        ],
        'account' => [
            'name' => 'Thông tin tài khoản',
            'link' => 'account-detail',
            'group' => 'account'
        ],
        'change_password' => [
            'name' => 'Thay đổi mật khẩu',
            'link' => 'change-password',
            'group' => 'account'
        ]
    ];

    //role modules
    static function getModuleGroupUser($user){
        $group = $user['group_user'];
        $current_user = $user['id'];
        $role_module = [
            self::SALE => [
                self::MODULE['customer_list'],
                self::MODULE['represent_list'],
                self::MODULE['create_quote'],
                self::MODULE['quote_management'],
                self::MODULE['quote_not_accepted'],
                self::MODULE['quote_accepted'],
                self::MODULE['find_shape'],
                self::MODULE['order_process'],
                self::MODULE['handle_process'],
                self::MODULE['product_management'],
                self::MODULE['product_history'],
                self::MODULE['insert_corder'],
                self::MODULE['order_ready'],
                self::MODULE['account'],
                self::MODULE['change_password'],
            ],
            self::TECH_APPLY => [
                self::MODULE['find_shape'],
                self::MODULE['tech_need_accp'],
                self::MODULE['tech_need_design'],
                self::MODULE['tech_need_handle'],
                self::MODULE['handle_process'],
                self::MODULE['design_not_accepted'],
                self::MODULE['designing_command'],
                self::MODULE['design_submited'],
                self::MODULE['join_print'],
                self::MODULE['account'],
                self::MODULE['change_password'],
            ],
            self::DESIGN => [
                self::MODULE['design_not_accepted'],
                self::MODULE['designing_command'],
                self::MODULE['design_submited'],
                self::MODULE['account'],
                self::MODULE['change_password'],
            ],
            self::TECH_HANDLE => [
                self::MODULE['handle_process'],
                self::MODULE['join_print'],
                self::MODULE['account'],
                self::MODULE['change_password'],
            ],
            self::PLAN_HANDLE => [
                self::MODULE['supply_extend'],
                self::MODULE['worker_salary'],
                self::MODULE['handle_process'],
                self::MODULE['c_supply_all'],
                self::MODULE['im_paper'],
                self::MODULE['im_supply'],
                self::MODULE['supp_bying_req'],
                self::MODULE['warehouse_management'],
                self::MODULE['warehouse_provider'],
                self::MODULE['account'],
                self::MODULE['change_password'],
            ],
            self::WAREHOUSE => [
                self::MODULE['supp_bying_req'],
                self::MODULE['warehouse_management'],
                self::MODULE['ex_supply'],
                self::MODULE['im_paper'],
                self::MODULE['im_supply'],
                self::MODULE['warehouse_provider'],
                self::MODULE['account'],
                self::MODULE['change_password'],
            ],
            self::APPLY_BUYING => [
                self::MODULE['supp_bying_req'],
                self::MODULE['warehouse_management'],
                self::MODULE['ex_supply'],
                self::MODULE['im_paper'],
                self::MODULE['im_supply'],
                self::MODULE['warehouse_provider'],
                self::MODULE['account'],
                self::MODULE['change_password'],
            ],
            self::DO_BUYING => [
                self::MODULE['supp_bying_req'],
                [
                    'name' => 'Yêu cầu bạn đã liên hệ mua',
                    'link' => 'view/supply_buyings?default_data=%7B%22contact_by":"'.$current_user.'%22%7D',
                    'group' => 'supply_buying'
                ],
                [
                    'name' => 'Yêu cầu bạn đã xử lí mua',
                    'link' => 'view/supply_buyings?default_data=%7B%22bought_by":"'.$current_user.'%22%7D',
                    'group' => 'supply_buying'
                ],
                self::MODULE['ex_supply'],
                self::MODULE['im_paper'],
                self::MODULE['im_supply'],
                self::MODULE['warehouse_management'],
                self::MODULE['supply_history'],
                self::MODULE['warehouse_provider'],
                self::MODULE['account'],
                self::MODULE['change_password'],
            ],
            self::KCS => [
                self::MODULE['handle_process'],
                self::MODULE['account'],
                self::MODULE['change_password'],
            ],
            self::PRODUCT_WAREHOUSE => [
                self::MODULE['handle_process'],
                self::MODULE['product_management'],
                self::MODULE['expertise'],
                self::MODULE['product_history'],
                self::MODULE['account'],
                self::MODULE['change_password'],
            ],
            
            self::ACCOUNTING => [
                self::MODULE['worker_salary'],
                self::MODULE['customer_list'],
                self::MODULE['order_process'],
                self::MODULE['handle_process'],
                self::MODULE['warehouse_management'],
                self::MODULE['supply_history'],
                self::MODULE['ex_supply'],
                self::MODULE['im_paper'],
                self::MODULE['im_supply'],
                self::MODULE['product_management'],
                self::MODULE['move_warehouse'],
                self::MODULE['expertise'],
                self::MODULE['product_history'],
                self::MODULE['insert_corder'],
                self::MODULE['order_ready'],
                self::MODULE['order_debt'],
                self::MODULE['supply_debt'],
                self::MODULE['account'],
                self::MODULE['change_password'],
            ],
            self::PRODUCTION_MANAGER => [
                self::MODULE['worker_salary'],
                self::MODULE['handle_process'],
                self::MODULE['join_print'],
                self::MODULE['account'],
                self::MODULE['change_password'],
            ],
        ];
        return $role_module[$group];
    }
    //check method
    static function getGroupByModule($modules)
    {
        $ret = [];
        foreach ($modules as $module) {
            $parent_key = $module['group'];
            if (!array_key_exists($parent_key, $ret)) {
                $ret[$parent_key] = self::GROUP_MODULE[$module['group']];
            }
        }
        
        return $ret;
    }

    static function getMenuModule($user)
    {
        if ($user['group_user'] == self::ADMIN) {
            return ['group_modules' => self::GROUP_MODULE, 'modules' => self::MODULE];
        }else{
            $modules = self::getModuleGroupUser($user);
            return ['group_modules' => self::getGroupByModule($modules), 'modules' => $modules];
        }
        
    }

    static function getCurrent()
    {
        $user = \App\Models\NUser::getCurrent();
        return @$user['group_user'];
    }

    static function checkExtRoleAction($action){
        if (self::isAdmin()) {
            return true;
        }
        return self::isTechApply() && in_array($action, \User::getExtRole());
    }

    static function isAdmin($group_user = 0)
    {
        $group_user = !empty($group_user) ? $group_user : self::getCurrent();
        return $group_user == self::ADMIN;
    }

    static function isSale($group_user = 0)
    {
        $group_user = !empty($group_user) ? $group_user : self::getCurrent();
        return $group_user == self::SALE;
    }

    static function isTechApply($group_user = 0)
    {
        $group_user = !empty($group_user) ? $group_user : self::getCurrent();
        return $group_user == self::TECH_APPLY;
    }

    static function isDesign($group_user = 0)
    {
        $group_user = !empty($group_user) ? $group_user : self::getCurrent();
        return $group_user == self::DESIGN;
    }

    static function isTechHandle($group_user = 0)
    {
        $group_user = !empty($group_user) ? $group_user : self::getCurrent();
        return $group_user == self::TECH_HANDLE;
    }

    static function isPlanHandle($group_user = 0)
    {
        $group_user = !empty($group_user) ? $group_user : self::getCurrent();
        return $group_user == self::PLAN_HANDLE;
    }
    static function isWarehouse($group_user = 0)
    {
        $group_user = !empty($group_user) ? $group_user : self::getCurrent();
        return $group_user == self::WAREHOUSE;
    }
    static function isApplyBuying($group_user = 0)
    {
        $group_user = !empty($group_user) ? $group_user : self::getCurrent();
        return $group_user == self::APPLY_BUYING;
    }
    static function isDoBuying($group_user = 0)
    {
        $group_user = !empty($group_user) ? $group_user : self::getCurrent();
        return $group_user == self::DO_BUYING;
    }
    static function isKCS($group_user = 0)
    {
        $group_user = !empty($group_user) ? $group_user : self::getCurrent();
        return $group_user == self::KCS;
    }
    static function isProductWarehouse($group_user = 0)
    {
        $group_user = !empty($group_user) ? $group_user : self::getCurrent();
        return $group_user == self::PRODUCT_WAREHOUSE;
    }

    static function isAccounting($group_user = 0)
    {
        $group_user = !empty($group_user) ? $group_user : self::getCurrent();
        return $group_user == self::ACCOUNTING;
    }

    static function isProManager($group_user = 0)
    {
        $group_user = !empty($group_user) ? $group_user : self::getCurrent();
        return $group_user == self::PRODUCTION_MANAGER;
    }
}