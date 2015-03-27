<?

namespace ReservatCore\Interfaces;

use ReservatCore\Interfaces\EntityInterface;

interface DataMapperInterface
{
	public function insert(EntityInterface $entity);
	public function update(EntityInterface $entity);
	public function save(EntityInterface $entity);
	public function delete(EntityInterface $entity);
}