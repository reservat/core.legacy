<?

namespace Reservat\Core\Interfaces;

interface RepositoryInterface 
{
	public function table();
	public function getById($id);
	public function getAll();
}