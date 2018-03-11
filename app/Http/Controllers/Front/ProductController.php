<?php

namespace App\Http\Controllers\Front;

use App\Shop\Products\Product;
use App\Shop\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Shop\Products\Transformations\ProductTransformable;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Recombee\RecommApi\Client;
use Recombee\RecommApi\Requests as Reqs;
use Recombee\RecommApi\Exceptions as Ex;

class ProductController extends Controller
{
    use ProductTransformable;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepo;

    protected $client;


    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        $list = $this->productRepo->searchProduct(request()->input('q'));

        $products = $list->map(function (Product $item) {
            return $this->transformProduct($item);
        })->all();

        return view('front.products.product-search', [
            'products' => $this->productRepo->paginateArrayResults($products, 10)
        ]);
    }

    /**
     * Get the product
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProduct(string $slug)
    {
        $product = $this->productRepo->findProductBySlug(['slug' => $slug]);

        $this->client = new Client('laracom', 'KoZox0Mq535SdL1qUwOQD9zjIdFnYjjtlSmx54EmGM5XZm1owuLIIOUM24L00OpD');

        $this->client->send(new Reqs\AddDetailView("user-".Auth::user()->id, $product->slug,  ['timestamp' => Carbon::now()->toDateTimeString(), 'cascadeCreate' => true]));

        // Items you may like
        $recommended_me = $this->client->send(new Reqs\RecommendItemsToUser('user-'.Auth::user()->id, 5));

        $recommended_me_ids = $recommended_me['recomms'];

        //Related Items
        $recommended = $this->client->send(new Reqs\RecommendItemsToItem($product->slug, "user-".Auth::user()->id, 5));

//        echo 'Recommended items: ' . json_encode($recommended, JSON_PRETTY_PRINT) . "\n";

//        $data = json_encode($recommended, true);
        $product_ids = $recommended['recomms'];

        $recommended_others = $this->client->send(new Reqs\RecommendUsersToUser("user-".Auth::user()->id, 5, []));

        $recommended_other_ids = $recommended_others['recomms'];

        return view('front.products.product', [
            'product_ids' => $product_ids,
            'recommended_me_ids' => $recommended_me_ids,
            'recommended_other_ids' => $recommended_other_ids,
            'product' => $product,
            'images' => $product->images()->get()
        ]);
    }
}
