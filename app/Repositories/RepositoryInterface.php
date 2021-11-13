<?

namespace App\Repositories;

interface RepositoryInterface
{

    public function findOneById($id);

    public function findAll();
}
