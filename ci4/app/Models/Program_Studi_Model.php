<?php namespace App\Models;

use Codeigniter\Database\ConnectionInterface;

class Program_Studi_Model {

    private $table = 'prodi';

    public function __construct(ConnectionInterface &$db)
    {
        $this->builder = $db->table($this->table);
    }

    public function get($where = null)
    {
        if (!empty($where)) {
            return $this->builder->getWhere($where);
        } else {
            return $this->builder->get();
        }
    }

    public function insert($data)
    {
        return $this->builder->insert($data);
    }

    public function update($data, $where)
    {
        return $this->builder->update($data, $where);
    }

    public function delete($where)
    {
        return $this->builder->delete($where);
    }
}