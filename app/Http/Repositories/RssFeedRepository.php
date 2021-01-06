<?php

namespace App\Http\Repositories;

use App\Models\Data\RssFeed;
use Exception;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

/**
 * Class DashboardRepository
 *
 * @package App\Http\Repositories
 */
class RssFeedRepository extends Repository
{
    /**
     * RssFeedRepository constructor.
     *
     * @param RssFeed $model
     */
    public function __construct(RssFeed $model)
    {
        parent::__construct($model);
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
            return $this->createNewRssFeed($data);
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
            throw new RuntimeException('Invalid state: could not delete a RssFeed object');
        }

        return $model->delete();
    }

    /**
     * @param array $data
     * @return bool
     */
    private function createNewRssFeed(array $data): bool
    {
        return $this->getModel()->newInstance($data)->save();
    }
}