<?php

namespace App\Http\Requests;

use App\Repositories\TagsRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    protected $tagRepository;
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null, TagsRepository $tagsRepository)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->tagRepository = $tagsRepository;
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */



    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $tags = $this->tagRepository->getAllId();

        return [
            'name' => 'min:5|max:100',
            'price' => 'numeric|gt:0|lte:9999999',
            'publish_start' => 'before:publish_end|required',
            'publish_end' => 'after:publish_start|required',
            'tags.*' =>[ Rule::in($tags)],
            'lang' => 'required|array|min:1',
            'image' => 'image|max:4096'
        ];
    }

   /* public function messages()
    {
        return[
            'name.min' => 'Termék neve minimum 5 karakter kell legyen.',
            'name.max' => 'Termék neve maximum 100 karakter kell lehet.',
            'price.gt' => 'Termék ára csak pozitív szám lehet.',
            'price.lte' => 'Termék ára nem haladhatja meg a 9999999.-et.',
            'publish_start.before' => 'Publikálás kezdete nem haladhatja meg a végét.',
            'publish_end.before' => 'Publikálás vége nem lehet a kezdete előtt.',

        ];
    }*/
}
