<?php

namespace App\Http\Repositories;

use App\Models\Client;
use App\Models\User;
use App\Traits\CreatesUsers;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

/**
 * Class ClientRepository
 *
 * @package App\Http\Repositories
 */
class ClientRepository extends Repository
{
    use CreatesUsers;

    /**
     * @var User
     */
    private $user;

    /**
     * EmployeeRepository constructor.
     *
     * @param Client $model
     * @param User $user
     */
    public function __construct(Client $model, User $user)
    {
        parent::__construct($model);

        $this->user = $user;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->getModel()->with('user')->get();
    }

    /**
     * @param  array  $data
     * @param Model|null  $model
     *
     * @return bool
     */
    protected function fill(array $data, Model $model = null): bool
    {
        [$userData, $clientData] = $this->splitData($data);

        $success = parent::fill($clientData, $model);

        if (!$success) {
            throw new RuntimeException('Invalid state: could not create a employee object');
        }

        if (is_null($model)) {
            return $this->createNewUser($userData, $this->getModel()->id);
        }

        return $model->user->update($userData);
    }

    /**
     * @param Model $model
     *
     * @return bool|null
     * @throws Exception
     */
    protected function destroy(Model $model): ?bool
    {
        $success = (bool) $model->user()->delete();

        if (!$success) {
            throw new RuntimeException('Invalid state: could not delete a employee object');
        }

        return $model->delete();
    }

    /**
     * @return string
     */
    protected function getType()
    {
        return 'employee';
    }
}