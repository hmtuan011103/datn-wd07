<?php

namespace App\Http\Controllers\DiscountCode\Client;

use App\Http\Controllers\DiscountCode\BaseDiscountCodeController;
use Symfony\Component\HttpFoundation\Response;

class DiscountCodeController extends BaseDiscountCodeController
{
    public function getCodeUser($code){
        $discount_code = $this->discountcodeService->getDiscount($code);
        if($discount_code) {
            return response()->json([
                'data' => $discount_code
            ], Response::HTTP_OK);
        }
        return response()->json([
            'data' => null
        ], Response::HTTP_OK);
    }
}
