<?php

declare(strict_types=1);

namespace App\Http;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CommentAPIController
{
    public function addComment(CreateCommentRequest $request, int $taskId): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['task_id'] = $taskId;

        Comment::create($data);

        return response()->json(['message' => 'Comment added successfully!']);
    }

    public function updateComment(CreateCommentRequest $request, int $taskId, int $commentId): JsonResponse
    {
        $comment = Comment::findOrFail($commentId);
        $data = $request->validated();
        $comment->update($data);

        return response()->json(['message' => 'Comment updated successfully!']);
    }

    public function deleteComment(int $taskId, int $commentId): JsonResponse
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully!']);
    }

    public function getComment(int $taskId): JsonResponse
    {
        $comments = Comment::where('task_id', $taskId)->get();

        return response()->json(['comments' => $comments]);
    }
}
