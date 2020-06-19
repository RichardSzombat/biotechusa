<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repositories\DescriptionRepository;
use App\Repositories\LangRepository;
use App\Repositories\ProductDescriptionRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductTagsRepository;
use App\Repositories\TagsRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    protected $productRepository;
    protected $descriptionRepository;
    protected $productDescriptionRepository;
    protected $productTagsRepository;
    protected $langRepository;
    protected $tagsRepository;

    public function __construct(ProductRepository $productRepository, DescriptionRepository $descriptionRepository,ProductDescriptionRepository $productDescriptionRepository,ProductTagsRepository $productTagsRepository,LangRepository $langRepository, TagsRepository $tagsRepository)
    {
        $this->productRepository = $productRepository;
        $this->descriptionRepository = $descriptionRepository;
        $this->productDescriptionRepository = $productDescriptionRepository;
        $this->productTagsRepository = $productTagsRepository;
        $this->langRepository = $langRepository;
        $this->tagsRepository = $tagsRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getDetailedProducts();

        return view('index',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {

        $langs = $this->langRepository->all();
        $tags = $this->tagsRepository->getAll();

        return view("product.create-edit",compact('langs','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $product = $this->productRepository->store($data);
        $descriptions = $this->descriptionRepository->store($data["lang"]);
        foreach ($descriptions as $description)
        {
            $this->productDescriptionRepository->store($product->id,$description->id);
        }
        $this->productTagsRepository->store($data["tags"],$product->id);


        if ($product){
            return redirect("/");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return void
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $langs = $this->langRepository->all();
        $tags = $this->tagsRepository->getAll();
        $product = $this->productRepository->getById($id);
        $description = $this->descriptionRepository->getOnlyDescriptionsByProductId($id);

        return view('product.create-edit',compact('langs','tags','product','description'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $data = $request->all();
        $product = $this->productRepository->getById($id);
        if ($product){
            $product->update(array('name' => $data["name"],
                                    'publish_start' =>$data["publish_start"],
                                    'publish_end' =>$data["publish_end"],
                                    'price' =>$data["price"],));
        }

        if ($data['lang']){
            foreach ($data['lang'] as $key => $langText)
            {

                $descriptionId = $this->descriptionRepository->getDescriptionByProductAndLangId($id,$key);
                $this->descriptionRepository->getById($descriptionId->description_id)->update(array('text' => $langText));

            }
        }


        $product->refresh();
        return redirect()->route('product.edit',$product->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->getById($id);
        $product->delete();
    }
}
