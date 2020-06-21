<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use App\Repositories\DescriptionRepository;
use App\Repositories\LangRepository;
use App\Repositories\ProductDescriptionRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductTagsRepository;
use App\Repositories\TagsRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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

    public function __construct(ProductRepository $productRepository, DescriptionRepository $descriptionRepository, ProductDescriptionRepository $productDescriptionRepository, ProductTagsRepository $productTagsRepository, LangRepository $langRepository, TagsRepository $tagsRepository)
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
        $products = $this->productRepository->all();
        return view('index', compact('products'));
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

        return view("product.create-edit", compact('langs', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request)
    {

        $data = $request->all();
        $image = $request->file('image');
        if ($image) {
            $data['image'] = $this->uploadImage($image);
        } else {
            $data['image'] = "";
        }
        $product = $this->productRepository->store($data);
        $descriptions = $this->descriptionRepository->store($data["lang"]);
        foreach ($descriptions as $description) {
            $this->productDescriptionRepository->store($product->id, $description->id);
        }

        if (isset($data["tags"])) {
            $this->productTagsRepository->store($data["tags"], $product->id);
        }

        if ($product) {
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
        $product_tags = $this->productTagsRepository->getProductTagsById($id, 'key');

        return view('product.create-edit', compact('langs', 'tags', 'product', 'description', 'product_tags'));
    }

    /**
     * Update records by product id.
     *
     * @param $id
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function update($id, ProductRequest $request)
    {
        $data = $request->all();
        $product = DB::table('products')->where('id', $id)->exists();
        if ($product) {
            $product = $this->productRepository->getById($id);
            $image = $request->file('image');
            if ($image) {
                $image = $this->uploadImage($image);
                File::delete('uploads/' . $product->image);
                $this->productRepository->updateById($id, array('image' => $image));
            }
            $this->productRepository->updateById($id, array('name' => $data["name"],
                'publish_start' => $data["publish_start"],
                'publish_end' => $data["publish_end"],
                'price' => $data["price"],));

            $this->descriptionRepository->updateDescriptions($id, $data["lang"]);
            if (!array_key_exists('tags', $data)) {
                $data["tags"] = null;
            }
            $this->productTagsRepository->updateProductTags($data["tags"], $id);
            $product->refresh();
            return redirect()->route('index');
        } else {
            return redirect()->back()->withInput()->withErrors(['Product_id is invalid']);
        }

    }

    /**
     * Delete product by id and every record that it is related to.
     *
     * @param $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        $product = DB::table('products')->where('id', $id)->exists();
        if ($product) {
            $product = $this->productRepository->getById($id);
            $this->deleteAllByProduct($id);
            File::delete('uploads/' . $product->image);
            $product->delete();
            return response()->json(['success' => 'Product deleted.'], 200);
        } else {
            return response()->json(['error' => 'Product not found.'], 404);

        }

    }

    /**
     * Delete related records to by product_id
     * @param $product_id
     */
    public function deleteAllByProduct($product_id)
    {
        $description_ids = $this->productDescriptionRepository->getProdDescAttributeByProduct($product_id, 'description_id');
        $this->productTagsRepository->where('product_id', $product_id)->delete();
        $this->productDescriptionRepository->where('product_id', $product_id)->delete();
        $this->descriptionRepository->deleteMultipleById($description_ids);
    }

    /**Upload image to to server's upload folder. Returns image's path.
     * @param $image string
     * @return string
     */
    public function uploadImage($image)
    {
        $destinationPath = 'uploads';
        $timestamp = time();
        $image_name = $timestamp . "_product." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $image_name);
        return $image_name;
    }
}
