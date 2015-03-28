<?

namespace Reservat\Core\Interfaces;

use Reservat\Core\Interfaces\EntityInterface;

interface DatamapperInterface
{
	public function insert(EntityInterface $entity);
	public function update(EntityInterface $entity);
	public function save(EntityInterface $entity);
	public function delete(EntityInterface $entity);
}