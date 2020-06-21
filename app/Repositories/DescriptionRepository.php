<?php

namespace App\Repositories;

use App\Description;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;


//use Your Model

/**
 * Class DescriptionRepository.
 */
class DescriptionRepository extends BaseRepository
{
    protected $langRepository;
    protected $productDescriptionRepository;
    protected $productRepository;
    protected $productTagsRepository;
    protected $tagRepository;
    protected $model;


    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return DescriptionRepository::class;
    }

    public function __construct(Description $model, LangRepository $langRepository, ProductRepository $productRepository, ProductDescriptionRepository $productDescriptionRepository, ProductTagsRepository $productTagsRepository, TagsRepository $tagRepository)
    {
        $this->model = $model;
        $this->productDescriptionRepository = $productDescriptionRepository;
        $this->langRepository = $langRepository;
        $this->productRepository = $productRepository;
        $this->productTagsRepository = $productTagsRepository;
        $this->tagRepository = $tagRepository;
    }

    public function store($descriptions)
    {
        $saved_descriptions = array();

        foreach ($descriptions as $key => $description) {
            $lang = $this->langRepository->getById($key);
            $description = $description == null ? "" : $description;

            if ($lang) {
                $this->model = new Description();
                $this->model->text = $description;
                $this->model->lang_id = $lang->id;
                $this->model->save();

                array_push($saved_descriptions, $this->model);
            }
        }
        return $saved_descriptions;
    }

    /**
     * Getting every descriptions Id by product_id and returning them in an array
     * @param $product_id
     * @return array
     */
    public function getOnlyDescriptionsByProductId($product_id)
    {
        $descriptions = DB::table('description')->leftJoin('lang', 'description.lang_id', '=', 'lang.id')
            ->rightJoin('product_description', 'description.id', '=', 'product_description.description_id')
            ->where('product_description.product_id', '=', $product_id)
            ->get();

        $description_array = array();
        foreach ($descriptions as $description) {
            $description_array[$description->code] = $description->text;
        }
        return $description_array;
    }

    /**
     * Get description.id by product_id and lang_id
     * @param $product_id integer
     * @param $lang_id integer
     * @return Model|Builder|object|null
     */
    public function getDescriptionByProductAndLangId($product_id, $lang_id)
    {
        return $this->productDescriptionRepository->getDescriptionByProductAndLangId($product_id, $lang_id);
    }

    /**
     * Update descriptions by product_id.
     * @param $product_id integer
     * @param $langs array
     */
    public function updateDescriptions($product_id, $langs)
    {
        foreach ($langs as $lang => $description) {
            $description = $description == null ? "" : $description;
            $description_id = $this->getDescriptionByProductAndLangId($product_id, $lang)->description_id;
            $this->updateById($description_id, array('text' => $description));
        }

    }
}
