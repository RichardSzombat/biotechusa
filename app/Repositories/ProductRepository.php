<?php

namespace App\Repositories;

use App\Product;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    protected $model;

    /**
     * @param Product $model
     */

    function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function model()
    {
        return ProductRepository::class;
    }

    public function store($product)
    {
        $this->model->name = $product["name"];
        $this->model->publish_start = $product["publish_start"];
        $this->model->publish_end = $product["publish_end"];
        $this->model->price = $product["price"];
        $this->model->save();
        return $this->model;
    }



    public function getDetailedProducts()
    {
        return DB::table('products')->leftJoin('product_description','products.id','=','product_description.product_id')
                                                ->leftJoin('description','product_description.description_id','=','description.id')
                                                ->where('lang_id','1')
                                                ->get();
    }



}
