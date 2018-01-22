<?php
/**
 * Created by PhpStorm.
 * User: apolo96
 * Date: 18/01/2018
 * Time: 07:04
 */
namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

trait ApiResponse
{
    /**
     * @param $data
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    private function successResponse($data, $code)
    {
        return response()->json($data,$code);
    }

    /**
     * @param $message
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message, $code)
    {
        return response()->json(['error'=>$message,'code'=>$code],$code);
    }

    /**
     * @param Collection $collection
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showAll(Collection $collection, $code = 200)
    {
        $collection = $this->paginate($collection);
        return $this->successResponse(['data'=>$collection],$code);
    }

    /**
     * @param Model $model
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showOne(Model $model, $code = 200)
    {
        return $this->successResponse(['data'=>$model],$code);
    }

    protected function showMessage($message, $code = 200)
    {
        return $this->successResponse(['data'=>$message],$code);
    }

    /**
     * @param Collection $collection
     */
    private function paginate(Collection $collection)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;
        $results = $collection->slice(($page - 1) * $perPage, $perPage);
        $paginated = new LengthAwarePaginator($results,
            $collection->count(),
            $perPage,
            $page,
            [
                'path' => LengthAwarePaginator::resolveCurrentPath()
            ]
        );
        return $paginated;
    }
}