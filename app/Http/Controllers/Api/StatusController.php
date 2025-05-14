<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use App\Http\Resources\StatusResource;
use App\Models\Status;
use App\Services\StatusService;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected $statusService;

    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = $this->statusService->getAllStatuses();
        return $this->successResponse('All statuses fetched successfully !', StatusResource::collection($statuses));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusRequest $request)
    {
        $status = $this->statusService->createNewStatus($request->validated());
        return $this->successResponse('New status created successfully' , new StatusResource($status));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $status = $this->statusService->getStatusById($id);
        return $this->successResponse('Status Fetched successfully' , new StatusResource($status));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $this->statusService->deleteStatus($id);
            return $this->successResponse('status deleted successully !');

        }catch(AuthorizationException $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}
