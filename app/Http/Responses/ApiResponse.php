<?php
    namespace App\Http\Responses;

    use Illuminate\Http\JsonResponse;

    class ApiResponse {
        public static function errorResponseAuth(): JsonResponse
        {
            return response()->json(['message' => 'Authorization denied'], 401);
        }

        public static function errorResponseDetail(string $errorMessage): JsonResponse
        {
            return response()->json(['message' => $errorMessage]);
        }

        public static function successResponse(array $data): JsonResponse
        {
            return response()->json($data);
        }
    }