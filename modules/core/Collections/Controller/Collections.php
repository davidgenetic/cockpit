<?php

namespace Collections\Controller;

class Collections extends \Cockpit\Controller {


	public function index() {
        $control = $this->app->module("auth")->hasaccess("Collections","control");
		return $this->render("collections:views/index.php", compact('control'));
	}

    public function collection($id = null) {
        return $this->render("collections:views/collection.php", compact('id'));
    }


    public function entries($id) {

        $collection = $this->app->db->findOne("common/collections", ["_id" => $id]);

        if(!$collection) {
            return false;
        }

        $count = $this->app->module("collections")->collectionById($collection["_id"])->count();

        $collection["count"] = $count;

        $control = $this->app->module("auth")->hasaccess("Collections","control");

        return $this->render("collections:views/entries.php", compact('id', 'collection', 'count', 'control'));
    }

    public function entry($collectionId, $entryId=null) {

        $collection = $this->app->db->findOne("common/collections", ["_id" => $collectionId]);
        $entry      = null;

        if(!$collection) {
            return false;
        }

        if($entryId) {
            $col   = "collection".$collection["_id"];
            $entry = $this->app->db->findOne("collections/{$col}", ["_id" => $entryId]);

            if(!$entry) {
                return false;
            }
        }

        return $this->render("collections:views/entry.php", compact('collection', 'entry'));

    }

}
