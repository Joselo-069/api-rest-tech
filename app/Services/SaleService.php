<?php

namespace App\Services;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Responses\ApiResponse;
use App\Mail\SaleMail;
use App\Models\Client;
use App\Models\Sale;
use DB;
use Mail;

class SaleService
{

    protected ProductService $productService;
    protected SaleProductService $saleProductService;

    public function __construct(ProductService $productService, SaleProductService $saleProductService)
    {
        $this->productService = $productService;
        $this->saleProductService = $saleProductService;
    }

    public function getListSales()
    {
        $sales = Sale::all();

        return [
            'sales' => $sales
        ];
    }

    public function getRegisterSale(StoreSaleRequest $request)
    {
        $user = auth('sanctum')->user();
        $clientId = $request->client_id;
        DB::beginTransaction();

        $this->productService->validationsProblems($request->products);

        try {

            $sale = Sale::create([
                'code' => $request->code,
                'client_id' => $request->client_id,
                'user_id' => $user->id,
            ]);

            $this->saleProductService->getRegisterDetailSaleProducts($sale, $request->products);

            $this->sentEmailClient($clientId, $sale, $sale->products);

            DB::commit();

            return [
                'sale' => $sale
            ];

        } catch (\Exception $e){
            DB::rollback();
            return [
                'Error al registrar la venta: ' => $e->getMessage()
            ];
        }
    }

    public function getDetailSale($id): array
    {
        $sale = Sale::findOrFail($id);

        $dataDetail = $this->saleProductService->getDetailSaleProducts($sale);

        return [
            'sale' => $dataDetail
        ];
    }

    public function sentEmailClient($clientId, $sale, $products) {
        $client = Client::find($clientId);
        Mail::to($client->email)->queue(new SaleMail($sale, $products));
    }

}