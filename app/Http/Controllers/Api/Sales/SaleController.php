<?php

namespace App\Http\Controllers\Api\Sales;

use App\Helpers\UsersHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Sale;
use App\Services\SaleService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    protected SaleService $saleService;
    protected bool $userIsAdmin;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
        $this->userIsAdmin = UsersHelper::userIsAdmin();
    }

    public function list()
    {
        $data = $this->saleService->getListSales();
        return ApiResponse::successResponse($data);
    }

    public function create(StoreSaleRequest $request)
    {
        $data = $this->saleService->getRegisterSale($request);
        return ApiResponse::successResponse($data);
    }

    public function show($id)
    {
        $data = $this->saleService->getDetailSale($id);
        return ApiResponse::successResponse($data);
    }

    public function report(Request $request) {
        $userIsAdmin = UsersHelper::userIsAdmin();

        if ($userIsAdmin){

            $today = Carbon::today();

            if ($request->filter == 'daily') {
                $startDate = $today;
                $endDate = $today->copy()->endOfDay();
            } elseif ($request->filter == 'weekly') {
                $startDate = $today->copy()->startOfWeek();
                $endDate = $today->copy()->endOfWeek();
            } elseif ($request->filter == 'monthly') {
                $startDate = $today->copy()->startOfMonth();
                $endDate = $today->copy()->endOfMonth();
            } else {
                return ApiResponse::errorResponseDetail('Filtro inválido');
            }

            $salesQuery = Sale::with(['clients', 'products' => function ($query) {
                    $query->withTrashed();
                }])
                ->whereBetween('date', [$startDate, $endDate]);

            if ($request->has('client_id')) {
                $salesQuery->where('client_id', $request->client_id);
            }
            if ($request->has('user_id')) {
                $salesQuery->where('user_id', $request->user_id);
            }

            $sales = $salesQuery->get();

            return ApiResponse::successResponse([
                'data' => $sales
            ]);
        }

        return ApiResponse::errorResponseAuth();
    }
}
