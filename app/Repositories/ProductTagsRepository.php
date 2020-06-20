<?php

namespace App\Repositories;

use App\ProductTags;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;


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

    public function updateProductTags($tags, $product_id)
    {
        if ($tags == null){
            $this->where('product_id',$product_id)->delete();

        }else{
            $product_tags = $this->where('product_id',$product_id)->get();
            /*Ha van*/
            if (count($product_tags) > 0){
                foreach ($product_tags as $product_tag)
                {
                    if (!array_key_exists($product_tag->tag_id,$tags)){
                        $product_tag->delete();
                    }else{

                        unset($tags[$product_tag->tag_id]);
                    }
                }
            }
            if (!empty($tags)){
                $this->store($tags,$product_id);
            }

        }

    }

    public function getProductTagsById($product_id,$key)
    {
        $tags =  DB::table('product_tags')->where('product_id','=',$product_id)->get();
        $tags_array = array();
        if ($key == "key"){
            foreach ($tags as $tag){
                $tags_array[$tag->tag_id] = "on";
            }
        }else{
            foreach ($tags as $tag){
                array_push($tags_array,$tag->id);
            }
        }

        return $tags_array;
    }

}
