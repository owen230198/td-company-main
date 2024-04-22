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

    //Status constants
    const NOT_ACCEPTED = 'not_accepted';
    const ACCEPTED = 'accepted';
    const SUBMITED = 'submited';
    const LAST_SUBMITED = 'last_submited';
    const PROCESSING = 'processing';
    const CHECKING = 'checking';

    //Other Constants
    const NO_VALIDATE = 'no_validate';
}
