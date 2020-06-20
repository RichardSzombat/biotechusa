<?php

namespace App\Repositories;

use App\Tags;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class TagsRepository.
 */
class ImageRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return ImageRepository::class;
    }
    function __construct(Tags $model)
    {
        $this->model = $model;
    }

}
