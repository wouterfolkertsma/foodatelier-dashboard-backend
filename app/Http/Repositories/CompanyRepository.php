<?php

namespace App\Http\Repositories;

use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use App\Traits\CreatesUsers;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

/**
 * Class CompanyRepository
 *
 * @package App\Http\Repositories
 */
class CompanyRepository extends Repository
{
    /**
     * EmployeeRepository constructor.
     *
     * @param Company $model
     */
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->getModel()::all();
    }

    /**
     * @param  array  $data
     * @param Model|null  $model
     *
     * @return bool
     */
    protected function fill(array $data, Model $model = null): bool
    {
        $success = parent::fill($data, $model);

        if (!$success) {
            throw new RuntimeException('Invalid state: could not create a employee object');
        }

        if (is_null($model)) {
            return $this->createNewCompany($data);
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