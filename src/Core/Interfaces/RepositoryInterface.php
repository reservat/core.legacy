<?

namespace Reservat\Core\Interfaces;

interface RepositoryInterface 
{
	public function getById($id);
	public function getAll();
}