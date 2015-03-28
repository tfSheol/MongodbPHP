<?php
/**
 * MongodbPHP.php by Sheol
 * 01/03/2015 - 01:35
 */

namespace api\MongodbPHP;

class MongodbPHP {
    private $_mango;
    private $_db;
    private $_current;

    public function __construct() {
        $this->_mango = new \MongoClient();
    }

    public function setDebugMode() {
        \MongoLog::setLevel(\MongoLog::ALL);
        \MongoLog::setModule(\MongoLog::ALL);
    }

    public function debugDatabase() {
        echo "<pre>";
        print_r($this->_mango->listDBs());
        print_r($this->_db->getCollectionInfo());
        print_r($this->_db->getCollectionNames());
        print_r($this->getAllCountCollection());
        echo "</pre>";
    }

    public function getAllDatabase() {
        return $this->_mango->listDBs();
    }

    public function getAllCollections() {
        return $this->_db->getCollectionInfo();
    }

    public function getAllCollectionsInfos() {
        return $this->_db->getCollectionNames();
    }

    public function getAllCountCollection() {
        $tab = array();
        foreach ($this->_db->listCollections() as $i => $item) {
            $tab[$i] = $item->count();
        }
        return $tab;
    }

    public function dropDatabase() {
        $this->_db->drop();
    }

    public function selectDb($db) {
        $this->_db = $this->_mango->$db;
        $this->_current = $this->_db->$db;
    }

    public function selectCollection($collection) {
        $this->_db->createCollection($collection);
        $this->_current = $this->_db->$collection;
    }

    public function dropCollection() {
        $this->_current->drop();
    }

    public function getCount() {
        return $this->_current->count();
    }

    public function insert($tab) {
        if (isset($this->_current)) {
            $this->_current->insert($tab);
        } else {
            echo "Error : No current collection seted !<br />";
        }
    }

    public function insertU($tab) {
        if (isset($this->_current)) {
            if ($this->_current->find($tab)->count() == 0) {
                $this->_current->insert($tab);
            }
        } else {
            echo "Error : No current collection seted !<br />";
        }
    }

    public function getAll()
    {
        if (isset($this->_current)) {
            return $this->_current->find();
        } else {
            echo "Error : No current collection seted !<br />";
            return null;
        }
    }

    public function delete($tab) {
        if (isset($this->_current)) {
            $this->_current->remove($tab);
        } else {
            echo "Error : No current collection seted !<br />";
        }
    }

    public function deleteFirst($tab) {
        if (isset($this->_current)) {
            $this->_current->remove($tab, true);
        } else {
            echo "Error : No current collection seted !<br />";
        }
    }

    public function deleteAll() {
        if (isset($this->_current)) {
            $this->_current->remove();
        } else {
            echo "Error : No current collection seted !<br />";
        }
    }

    public function update($tab) {
        if (isset($this->_current)) {
            $this->_current->update($tab);
        } else {
            echo "Error : No current collection seted !<br />";
        }
    }
}
