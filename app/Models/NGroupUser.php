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

    //group modules
    const GROUP_MODULE = [
        'quote_price_config' => 'Cài đặt đơn giá SX',
        'factory' => 'Quản lí nhà xưởng',
        'customer' => 'Khách hàng',
        'customer_quote' => 'Báo giá & Khách hàng',
        'design_module' => 'Thiết kế',
        'order_handle' => 'Đơn hàng & sản xuất',
        'supply_buying' => 'Mua vật tư',
        'profit' => '% Hoa hồng',
        'report' => 'Báo cáo',
        'available_order' => 'Đơn hàng bán sẵn',
        'warehouse' => 'Kho vật tư',
        'handle_supply' => 'Lệnh xử lí vật tư',
        'account' => 'Thông tin tài khoản'
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
            'link' => 'view/w_salaries?default_data=%7B"status"%3A"submited"%7D',
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
        'create_quote' => [
            'name' => 'Tính giá', 
            'link' => 'insert/quotes', 
            'group' => 'customer_quote'
        ],
        'quote_not_accepted' => [
            'name' => 'DS báo giá (chưa duyệt)', 
            'link' => 'view/quotes?default_data=%7B"status"%3A"not_accepted"%7D', 
            'group' => 'customer_quote'
        ],
        'quote_accepted' => [
            'name' => 'DS báo giá (đã duyệt)', 
            'link' => 'view/quotes?default_data=%7B"status"%3A"accepted"%7D', 
            'group' => 'customer_quote'
        ],
        'quote_order_created' => [
            'name' => 'DS báo giá (đã tạo đơn)', 
            'link' => 'view/quotes?default_data=%7B"status"%3A"order_created"%7D', 
            'group' => 'customer_quote'
        ],
        'design_not_accepted' => [
            'name' => 'DS lệnh TK chưa duyệt', 
            'link' => 'view/c_designs?default_data=%7B"status"%3A"not_accepted"%7D', 
            'group' => 'design_module'
        ],
        'designing_command' => [
            'name' => 'DS lệnh TK đang nhận', 
            'link' => 'view/c_designs?default_data=%7B"status"%3A"designing"%7D', 
            'group' => 'design_module'
        ],
        'design_submited' => [
            'name' => 'DS lệnh TK đã xong', 
            'link' => 'view/c_designs?default_data=%7B"status"%3A"design_submited"%7D', 
            'group' => 'design_module'
        ],
        'order_process' => [
            'name' => 'DS đơn hàng', 
            'link' => 'view/orders', 
            'group' => 'order_handle'
        ],
        'handle_process' => [
            'name' => 'Theo dõi sản xuất', 
            'link' => 'view/products?default_data=%7B"order_created":"1"%7D', 
            'group' => 'order_handle'
        ],
        'supp_bying_req' => [
            'name' => 'Yêu cầu mua vật tư', 
            'link' => 'view/supply_buyings', 
            'group' => 'supply_buying'
        ],
        'profit' => [
            'name' => 'Lợi nhuận của tôi', 
            'link' => 'myprofit', 
            'group' => 'profit'
        ],
        'rpt_quote_not_accepted' => [
            'name' => 'Báo giá chưa duyệt', 
            'link' => 'report/status=not_accepted', 
            'group' => 'report'
        ],
        'rpt_quote_accepted' => [
            'name' => 'Báo giá đã duyệt', 
            'link' => 'report/quotes?status=accepted', 
            'group' => 'report'
        ],
        'rpt_debt' => [
            'name' => 'Báo cáo công nợ', 
            'link' => 'report/quotes?status=accepted', 
            'group' => 'report'
        ],
        'rpt_categories_revenue' => [
            'name' => 'Doanh thu theo nhóm SP', 
            'link' => 'report/revenue?type=category', 
            'group' => 'report'
        ],
        'rpt_location_revenue' => [
            'name' => 'Doanh thu theo tỉnh/TP', 
            'link' => 'report/revenue?type=location', 
            'group' => 'report'
        ],
        'create_available_order' => [
            'name' => 'Đơn hàng bán sẵn', 
            'link' => 'view/available_orders', 
            'group' => 'available_order'
        ],
        'warehouse_management' => [
            'name' => 'Kho vật tư', 
            'link' => 'warehouse-management', 
            'group' => 'warehouse'
        ],
        'warehouse_provider' => [
            'name' => 'Nhà cung cấp vật tư', 
            'link' => 'view/warehouse_providers', 
            'group' => 'warehouse'
        ],
        'ex_supply' => [
            'name' => 'Yêu cầu xuất vật tư', 
            'link' => 'view/c_supplies?default_data=%7B"status"%3A"handling"%7D', 
            'group' => 'handle_supply'
        ],
        'im_supply' => [
            'name' => 'Yêu cầu nhập kho băng lề', 
            'link' => 'view/supply_warehouses?default_data=%7B"status"%3A"waiting"%7D', 
            'group' => 'handle_supply'
        ],
        'shipping_process' => [
            'name' => 'Lộ trình xuất - giao hàng', 
            'link' => 'shipping-process', 
            'group' => 'available_order'
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
    static $role_module = [
        self::SALE => [
            self::MODULE['create_quote'],
            self::MODULE['quote_not_accepted'],
            self::MODULE['quote_accepted'],
            self::MODULE['handle_process'],
            self::MODULE['profit'],
            self::MODULE['rpt_quote_not_accepted'],
            self::MODULE['rpt_quote_accepted'],
            self::MODULE['rpt_debt'],
            self::MODULE['rpt_categories_revenue'],
            self::MODULE['rpt_location_revenue'],
            self::MODULE['create_available_order'],
            self::MODULE['shipping_process'],
            self::MODULE['account'],
            self::MODULE['change_password'],
        ],
        self::TECH_APPLY => [
            self::MODULE['handle_process'],
            self::MODULE['profit'],
            self::MODULE['create_available_order'],
            self::MODULE['account'],
            self::MODULE['change_password'],
        ],
        self::DESIGN => [
            self::MODULE['profit'],
            self::MODULE['design_not_accepted'],
            self::MODULE['designing_command'],
            self::MODULE['design_submited'],
            self::MODULE['account'],
            self::MODULE['change_password'],
        ],
        self::TECH_HANDLE => [
            self::MODULE['handle_process'],
            self::MODULE['profit'],
            self::MODULE['create_available_order'],
            self::MODULE['account'],
            self::MODULE['change_password'],
        ],
        self::PLAN_HANDLE => [
            self::MODULE['handle_process'],
            self::MODULE['supp_bying_req'],
            self::MODULE['profit'],
            self::MODULE['create_available_order'],
            self::MODULE['account'],
            self::MODULE['change_password'],
        ],
        self::WAREHOUSE => [
            self::MODULE['warehouse_management'],
            self::MODULE['ex_supply'],
            self::MODULE['im_supply'],
            self::MODULE['account'],
            self::MODULE['change_password'],
        ],
        self::APPLY_BUYING => [
            self::MODULE['supp_bying_req'],
            self::MODULE['warehouse_management'],
            self::MODULE['ex_supply'],
            self::MODULE['im_supply'],
            self::MODULE['account'],
            self::MODULE['change_password'],
        ],
        self::DO_BUYING => [
            self::MODULE['supp_bying_req'],
            self::MODULE['warehouse_management'],
            self::MODULE['ex_supply'],
            self::MODULE['im_supply'],
            self::MODULE['account'],
            self::MODULE['change_password'],
        ]
    ];

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

    static function getMenuModule($group_user)
    {
        if ($group_user == self::ADMIN) {
            return ['group_modules' => self::GROUP_MODULE, 'modules' => self::MODULE];
        }else{
            $modules = self::$role_module[$group_user];
            return ['group_modules' => self::getGroupByModule($modules), 'modules' => $modules];
        }
        
    }

    static function getCurrent()
    {
        $user = \App\Models\NUser::getCurrent();
        return @$user['group_user'];
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
}