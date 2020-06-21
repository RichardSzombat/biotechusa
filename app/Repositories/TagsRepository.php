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

    /**Returns an array containing every tag_id
     * @return array
     */
    public function getAllId()
    {
        $tags = Tags::all();
        $tags_array = array();
        foreach ($tags as $tag) {
            array_push($tags_array, $tag->id);
        }
        return $tags_array;
    }
}
