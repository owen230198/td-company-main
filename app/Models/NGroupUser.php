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
    const SALE_MANAGER = 2;
    const DESIGN_MANAGER = 3;
    const SALE_STAFF = 4;
    const DESIGN_STAFF = 5;
    const GROUP_MODULE = [
        'quote_price_config' => 'Cài đặt đơn giá SX',
        'customer_quote' => 'Báo giá & Khách hàng',
        'order_handle' => 'Đơn hàng & sản xuất',
        'profit' => '% Hoa hồng',
        'report' => 'Báo cáo',
        'available_order' => 'Đơn hàng bán sẵn',
        'account' => 'Thông tin tài khoản'
    ];

    const MODULE = [
        'price_device' => ['name' => 'Đơn giá thiết bị máy', 'link' => 'view/devices', 'parent' => 'quote_price_config'],
        'create_quote' => ['name' => 'Tính giá', 'link' => 'create-quote', 'parent' => 'customer_quote'],
        'quote_not_accepted' => ['name' => 'DS báo giá (chưa duyệt)', 'link' => 'create-quote?status=not_accepted', 'parent' => 'customer_quote'],
        'create_new_order' => ['name' => 'Tạo mới đơn hàng', 'link' => 'create-handle-order', 'parent' => 'order_handle'],
        'order' => ['name' => 'Tạo đơn hàng cũ', 'link' => 'view/orders', 'parent' => 'order_handle'],
        'handle_process' => ['name' => 'Theo dõi sản xuất', 'link' => 'view/orders', 'parent' => 'order_handle'],
        'profit' => ['name' => 'Thu nhập cá nhân', 'link' => 'profit/sale', 'parent' => 'profit'],
        'rpt_quote_not_accepted' => ['name' => 'Báo giá chưa duyệt', 'link' => 'report/status=not_accepted', 'parent' => 'report'],
        'rpt_quote_accepted' => ['name' => 'Báo giá đã duyệt', 'link' => 'report/quotes?status=accepted', 'parent' => 'report'],
        'rpt_debt' => ['name' => 'Báo cáo công nợ', 'link' => 'report/quotes?status=accepted', 'parent' => 'report'],
        'rpt_categories_revenue' => ['name' => 'Doanh thu theo nhóm SP', 'link' => 'report/revenue?type=category', 'parent' => 'report'],
        'rpt_location_revenue' => ['name' => 'Doanh thu theo tỉnh/TP', 'link' => 'report/revenue?type=location', 'parent' => 'report'],
        'create_available_order' => ['name' => 'Tạo đơn hàng', 'link' => 'create-available-order', 'parent' => 'available_order'],
        'shipping_process' => ['name' => 'Lộ trình xuất - giao hàng', 'link' => 'shipping-process', 'parent' => 'available_order'],
        'account' => ['name' => 'Thông tin tài khoản', 'link' => 'account-detail', 'parent' => 'account'],
        'change_password' => ['name' => 'Thông tin tài khoản', 'link' => 'change/password', 'parent' => 'account']
    ];

    static $role_module = [
        self::SALE_MANAGER => [
            'group_modules' => [
                self::GROUP_MODULE['customer_quote'],
                self::GROUP_MODULE['order_handle'],
                self::GROUP_MODULE['profit'],
                self::GROUP_MODULE['report'],
                self::GROUP_MODULE['available_order'],
                self::GROUP_MODULE['account']
            ],
            'modules' => [
                self::MODULE['create_quote'],
                self::MODULE['quote_not_accepted'],
                self::MODULE['create_new_order'],
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
            ]
        ]
    ];

    static function getMenuModule($group_user)
    {
        
        return $group_user == self::ADMIN ? ['group_modules' => self::GROUP_MODULE, 'modules' => self::MODULE] : self::$role_module[$group_user];
    }

    static function isAdmin()
    {
        $user_login = session('user_login');
        $admin = @$user_login['user']?$user_login['user']:array();
        return @$admin['n_group_user_id'] == self::ADMIN;
    }
}