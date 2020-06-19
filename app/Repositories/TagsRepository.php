<?php

namespace App\Repositories;

use App\Tags;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class TagsRepository.
 */
class TagsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return TagsRepository::class;
    }
    function __construct(Tags $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return Tags::all();
    }
}
