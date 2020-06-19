<?php

namespace App\Repositories;

use App\ProductTags;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ProductTagsRepository.
 */
class ProductTagsRepository extends BaseRepository
{
    protected $tagsRepository;
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return ProductTagsRepository::class;
    }
    function __construct(ProductTags $model, TagsRepository $tagsRepository)
    {
        $this->model = $model;
        $this->tagsRepository = $tagsRepository;
    }

    public function store($tags, $product_id)
    {
        foreach ($tags as $key => $tag)
        {
            if ($this->tagsRepository->getById($key))
            {
                $this->model = new ProductTags();
                $this->model->product_id = $product_id;
                $this->model->tag_id = $key;
                $this->model->save();
            }


        }
    }

}
