<?php

namespace Reservat\Core\Datamapper;

use Reservat\Core\Interfaces\EntityInterface;

abstract class ESDatamapper
{

    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function putMapping($client)
    {
        $this->deleteMapping($client);

        $params['index'] = $this->getIndex();
        $params['body']['mappings'][$this->getType()] = $this->getMapping();

        $client->indices()->create($params);
    }

    public function deleteMapping($client)
    {
        $params['index'] = $this->getIndex();
        $client->indices()->delete($params);
    }

    public function getMapping()
    {
        return $this->mapping;
    }

    public static function getIndex()
    {
        return static::$index;
    }

    public static function getType()
    {
        return static::$type;
    }

    public static function getId()
    {
        return static::$id;
    }

    public function insert(EntityInterface $entity)
    {
        $this->save($entity);
    }

    public function update(EntityInterface $entity, $id)
    {
        $this->save($entity);
    }

    public function save(EntityInterface $entity, $id = null)
    {
        $params = [];
        $params['body']  = $entity->toArray();

        $params['index'] = static::getIndex();
        $params['type']  = static::getType();
        $params['id']    = $entity->getId();

        $ret = $this->client->index($params);

        if ($ret['created']) {
            return true;
        } else {
            throw new \Exception('Could not create booking');
        }
    }

    public function delete(EntityInterface $entity, $id)
    {

    }
}
