<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        try {
            $comment = $this->commentService->createComment($request->user(), $request->validated());
            return $this->successResponse('Comment Created Successfully', new CommentResource($comment));
        } catch (AuthorizationException $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, string $id)
    {
        try {
            $comment = $this->commentService->updateComment($request->user(), $request->validated(), $id);
            return $this->successResponse('Comment Updated Successfully', new CommentResource($comment));
        } catch (AuthorizationException $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $comment = $this->commentService->deleteComment($request->user(), $id);
            return $this->successResponse('Comment Deleted Successfully');
        } catch (AuthorizationException $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
