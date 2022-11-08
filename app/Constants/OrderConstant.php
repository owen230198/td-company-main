<?php
namespace App\Constants;
class OrderConstant
{
    const COMMAND_KEY_TABLE = [
        'c_design'=>'c_designs',
        'c_process'=>'c_processes'
    ];

    //Order Status
    const ORDER_NOT_ACCEPT = 'not_accept';
    const ORDER_ACCEPTED = 'accepted';

    //ORDER PAYMENT STATUS
    const ORD_NOT_PAYMENT = 'not_payment';
    const ORD_ADVANCE_PAYMENT = 'advance_payment';
    const ORD_PAID_PAYMENT = 'paid_payment';
}

?>