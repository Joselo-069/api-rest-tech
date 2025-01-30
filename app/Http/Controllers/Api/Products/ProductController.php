<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Helpers\UsersHelper;
use App\Http\Requests\StoreProductRequest;
use App\Http\Responses\ApiResponse;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected ProductService $productService;
    protected ProductRepository $productRepository;

    public function __construct(ProductService $productService, ProductRepository $productRepository)
    {
        $this->productService = $productService;
        $this->productRepository = $productRepository;
    }

    public function list()
    {
        $data = $this->productService->getListProducts();
        return ApiResponse::successResponse($data);
    }

    public function create(StoreProductRequest $request)
    {
        $data = $this->productService->getRegisterProduct($request);
        return ApiResponse::successResponse($data);
    }

    public function show($id)
    {
        $data = $this->productService->getDetailProduct($id);
        return ApiResponse::successResponse($data);
    }

    public function update(Request $request)
    {
        $data = $this->productService->getUpdateProduct($request);
        return ApiResponse::successResponse($data);
    }

    public function destroy($id)
    {
        $userIsAdmin = UsersHelper::userIsAdmin();

        if ($userIsAdmin){
            $data = $this->productService->getDestroyProduct($id);
            return ApiResponse::successResponse($data);
        }

        return ApiResponse::errorResponseAuth();
    }

    public function report(Request $request){
        $userIsAdmin = UsersHelper::userIsAdmin();

        if ($userIsAdmin){

            $query = $this->productRepository->getProductsTop();

            if ($request->has('product_id')) {
                $query->where('products.id', $request->product_id);
            }
            if ($request->has('client_id')) {
                $query->where('sales.client_id', $request->client_id);
            }
            if ($request->has('user_id')) {
                $query->where('sales.user_id', $request->user_id);
            }
            if ($request->has(['start_date', 'end_date'])) {
                $query->whereBetween('sales.date', [$request->start_date, $request->end_date]);
            }

            $topProducts = $query->get()->take(20);

            return ApiResponse::successResponse(["data" => $topProducts]);
        }

        return ApiResponse::errorResponseAuth();
    }
}
