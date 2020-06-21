<?php

namespace App\Repositories;

use App\Description;
use App\Lang;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class LangRepository.
 */
class LangRepository extends BaseRepository
{
    protected $model;
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return LangRepository::class;
    }
    public function __construct(Lang $model)
    {
        $this->model = $model;
    }
}
