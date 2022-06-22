<?php
namespace App\Services;
class BaseService
{
 	function __construct(){
 		$this->users = new \App\Models\NUser;
 		$this->roles = new \App\Models\NRole;
 		$this->modules = new \App\Models\NModule;
 	}
}