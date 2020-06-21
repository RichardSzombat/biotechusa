<?php

namespace App\Repositories;

use App\ProductDescription;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class ProductDescriptionRepository.
 */
class ProductDescriptionRepository extends BaseRepository
{
    protected $model;

    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return ProductDescriptionRepository::class;
    }

    function __construct(ProductDescription $model)
    {
        $this->model = $model;
    }

    public function store($product_id, $description_id)
    {
        $this->model = new ProductDescription();
        $this->model->product_id = $product_id;
        $this->model->description_id = $description_id;
        $this->model->save();
        return $this->model;
    }

    public function getDescriptionByProductAndLangId($product_id, $lang_id)
    {
        return DB::table('product_description')->leftJoin('description', 'product_description.description_id', '=', 'description.id')
            ->where('product_description.product_id', '=', $product_id)
            ->where('description.lang_id', '=', $lang_id)->first();
    }

    public function getProdDescAttributeByProduct($product_id, $attribute)
    {
        $results = DB::table('product_description')->leftJoin('description', 'product_description.description_id', '=', 'description.id')
            ->where('product_id', $product_id)->get();
        $result_array = array();

        foreach ($results as $result) {
            array_push($result_array, $result->$attribute);
        }
        return $result_array;

    }


}
