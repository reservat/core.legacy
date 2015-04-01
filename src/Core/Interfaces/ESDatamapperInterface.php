<?

namespace Reservat\Core\Interfaces;

use Reservat\Core\Interfaces\EntityInterface;

interface ESDatamapperInterface
{
	/**
     * Return the name of the table we're interacting with
     *
     * @return string
     */
    public function insert(EntityInterface $entity);
    public function update(EntityInterface $entity, $id);
    public function save(EntityInterface $entity, $id = null);
    public function delete(EntityInterface $entity, $id);
}