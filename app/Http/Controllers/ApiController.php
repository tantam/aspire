<?php
/**
 * Created by PhpStorm.
 * User: tam
 * Date: 6/11/18
 * Time: 5:20 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ApiController extends Controller
{
    public function responseSuccess($data)
    {
        return $data;
    }

    /**
     * @param $data
     * @param int $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError($data, $status_code = 400)
    {
        return response()->json(['error'=>$data],$status_code);
    }


}
