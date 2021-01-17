<?php

namespace App\Http\Repositories;

use App\Models\Dashboard;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

/**
 * Class DashboardRepository
 *
 * @package App\Http\Repositories
 */
class DashboardRepository extends Repository
{
    /**
     * CompanyRepository constructor.
     *
     * @param Dashboard $model
     */
    public function __construct(Dashboard $model)
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
        if (is_null($model)) {
            return $this->createNewDashboard($data);
        }

        return $model->update($data);
    }

    /**
     * @param Model $model
     *
     * @return bool|null
     * @throws Exception
     */
    protected function destroy(Model $model): ?bool
    {
        $success = (bool) $model->delete();

        if (!$success) {
            throw new RuntimeException('Invalid state: could not delete a dashboard object');
        }

        return $model->delete();
    }

    /**
     * @param array $data
     * @return bool
     */
    private function createNewDashboard(array $data): bool
    {
        return $this->getModel()->newInstance($data)->save();
    }
}