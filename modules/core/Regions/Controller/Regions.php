<?php

namespace Regions\Controller;

class Regions extends \Cockpit\Controller {


	public function index(){
    $control = $this->app->module("auth")->hasaccess("Regions","control");
		return $this->render("regions:views/index.php", compact('control'));
	}


    public function region($id=null){

        if (!$id && !$this->app->module("auth")->hasaccess("Regions", 'create.regions')) {
            return false;
        }

        $locales = $this->app->db->getKey("cockpit/settings", "cockpit.locales", []);

        return $this->render("regions:views/region.php", compact('id', 'locales'));
    }

}
