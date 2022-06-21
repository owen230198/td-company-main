<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class NRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'n_roles';
    protected $protectFields = false;

    public function getModuleByGroupUser($group_user_id)
    {
    	$this->select('*');
    	$this->where('view', 1);
    	$this->orWhere('insert', 1);
    	$this->orWhere('update', 1);
    	$this->orWhere('remove', 1);
    	$this->orWhere('copy', 1);
		$this->join('n_modules', 
		'right, n_modules.id = n_roles.module_id 
        AND n_modules.menu = 1
		AND n_roles.group_user_id = '.$group_user_id.'');
		$data = $this->get()->toArray();
        var_dump($data); die();
        return $data;
    }
}