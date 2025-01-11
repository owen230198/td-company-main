<?php  
namespace App\Constants;
class StatusConstant
{
	// ADMIN AUTH CONST
    const SUCCESS_CODE = 200;
    const ERR_CODE = 100;
    const SUCCESS_MSG = 'success_msg';
    const ERR_MSG = 'err_msg';
    const RELOAD = 'f5';
    const CLOSE_POPUP = 'close_popup';
    const CLOSE_POPUP_NO_RELOAD = 'close_popup_no_reload';
    const HIDDEN_CLONE_FIELD = ['code', 'created_by', 'created_at', 'updated_at'];

    //Status constants
    const NOT_ACCEPTED = 'not_accepted';
    const ACCEPTED = 'accepted';
    const SUBMITED = 'submited';
    const LAST_SUBMITED = 'last_submited';
    const PROCESSING = 'processing';
    const CHECKING = 'checking';
    const WAITING = 'waiting';
    const IMPORTED = 'imported';

    //Other Constants
    const NO_VALIDATE = 'no_validate';
    
    const OTHER = 'other';
}
