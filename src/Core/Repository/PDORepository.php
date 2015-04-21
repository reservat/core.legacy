<?php

namespace Reservat\Core\Repository;

use Reservat\Core\Interfaces\SQLRepositoryInterface;
use Reservat\Core\Interfaces\EntityInterface;

abstract class PDORepository implements SQLRepositoryInterface, \Iterator
{
    /**
     * @var array
     * A map of fields that can be filled when
     * filling an entity from the database.
     * id is hardcoded as it is a private property.
     * properties that match exactly their db name need not be added.
     * db_name => property_name
     */
    public static $fillable = array('id' => 'id');

    /**
     * @var null|\PDO
     */
    protected $db = null;

    /**
     * @var array
     */
    protected $records = array();

    /**
     * Use for \Iterator.
     *
     * @var int
     */
    private $position = 0;

    /**
     * Inject an instance of PDO.
     *
     * @param \PDO $db
     */
    public function __construct(\PDO $db)
    {
        $this->position = 0;
        $this->db = $db;
    }

    /**
     * Search for a record by ID.
     *
     * @param $id
     * @param bool $cache
     */
    public function getById($id, $cache = false)
    {
        $data = $this->query(array('id' => $id), 1);

        if ($data->execute(array($id))) {
            $this->records[] = $data->fetch(\PDO::FETCH_ASSOC);
        }

        return $this;
    }

    /**
     * Fetch all and potentially in-house-cache the results.
     *
     * @param int $limit
     *
     * @return array
     */
    public function getAll($limit = 20)
    {
        $data = $this->query(array(), $limit);

        // Reset the array
        $this->records = array();

        if ($data->execute()) {
            foreach ($data->fetchAll(\PDO::FETCH_ASSOC) as $row) {
                $this->records[] = $row;
            }
        }

        return $this;
    }

    /**
     * Perform a PDO query.
     *
     * @param array $data
     * @param int   $limit
     *
     * @return bool
     */
    protected function query($data = array(), $limit = 10)
    {
        $query = $this->selectQuery($data).' LIMIT '.intval($limit);
        $db = $this->db->prepare($query);

        return $db;
    }

    /**
     * Build a generic select query up based on an array of data.
     *
     * @param array $data
     *
     * @return string
     */
    protected function selectQuery(array $data)
    {
        $query = 'SELECT * FROM '.$this->table();

        if (!empty($data)) {
            $query .= ' WHERE ';

            foreach ($data as $column => $value) {
                $query .= $column.' = ?';
            }
        }

        return $query;
    }

    public function getResults()
    {
        if (!count($this->records)) {
            return false;
        }

        if (count($this->records) > 1) {
            $results = [];
            foreach ($this->records as $record) {
                $results[] = $record;
            }
            return $results;
        } else {
            return $this->current();
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element.
     *
     * @link http://php.net/manual/en/iterator.current.php
     *
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->records[$this->position];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element.
     *
     * @link http://php.net/manual/en/iterator.next.php
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element.
     *
     * @link http://php.net/manual/en/iterator.key.php
     *
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid.
     *
     * @link http://php.net/manual/en/iterator.valid.php
     *
     * @return bool The return value will be casted to boolean and then evaluated.
     *              Returns true on success or false on failure.
     */
    public function valid()
    {
        return isset($this->records[$this->position]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element.
     *
     * @link http://php.net/manual/en/iterator.rewind.php
     */
    public function rewind()
    {
        $this->position = 0;
    }
}
