<?php

namespace App\Http\Controllers;

use App\Exceptions\EntityNotFoundException;
use App\Services\ForumService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

/**
 * 討論區 Controller
 *
 * @OA\Tag(
 *   name="Forum v1",
 *   description="討論區相關"
 * )
 */
class ForumController extends Controller
{
    /**
     * ForumService
     *
     * @var \App\Services\ForumService
     */
    protected $forum_service;

    /**
     * 建構方法
     *
     * @param \App\Services\ForumService $forum_service
     * @return void
     */
    public function __construct(ForumService $forum_service)
    {
        $this->forum_service = $forum_service;
    }

    /**
     * 取得討論板清單
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *   path="/api/v1/forums/boards",
     *   summary="取得討論板清單",
     *   tags={"Forum v1"},
     *   @OA\Response(
     *     response="200",
     *     description="成功取得討論板清單",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/BaseResponse"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data",
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/BoardDTO")
     *           )
     *         )
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="提供的資料不正確或註冊過程中發生錯誤",
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="系統發生無法預期的錯誤",
     *   ),
     * )
     */
    public function getForumBoardsList(): JsonResponse
    {
        $boards = $this->forum_service->getForumBoardsList();

        return $this->response(null, $boards);
    }

    /**
     * 取得討論版文章
     *
     * @param int|null $id 討論版 ID
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *   path="/api/v1/forums/boards/{id}",
     *   summary="取得討論版文章",
     *   tags={"Forum v1"},
     *   @OA\Parameter(
     *     name="id",
     *     description="討論板 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="成功取得討論板文章",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/BaseResponse"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data",
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/GetPostListResponse")
     *           )
     *         )
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="提供的資料不正確或註冊過程中發生錯誤",
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="系統發生無法預期的錯誤",
     *   ),
     * )
     */
    public function getBoardPosts(int $id = null): JsonResponse
    {
        if (is_null($id)) {
            return $this->response('未知的討論版 ID', null, self::HTTP_BAD_REQUEST);
        }

        $posts = $this->forum_service->getBoardPosts($id);

        return $this->response(null, $posts);
    }

    /**
     * 取得文章本體
     *
     * @param int|null $board_id 討論板 ID
     * @param int|null $post_id 文章 ID
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *   path="/api/v1/forums/boards/{board_id}/posts/{post_id}",
     *   summary="取得文章本體",
     *   tags={"Forum v1"},
     *   @OA\Parameter(
     *     name="board_id",
     *     description="討論板 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *     name="post_id",
     *     description="文章 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="成功取得文章本體",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/BaseResponse"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data",
     *             ref="#/components/schemas/PostDTO"
     *           )
     *         )
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="提供的資料不正確或註冊過程中發生錯誤",
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="系統發生無法預期的錯誤",
     *   ),
     * )
     */
    public function getPost(int $board_id = null, int $post_id = null): JsonResponse
    {
        if (is_null($board_id)) {
            return $this->response('未知的討論版 ID', null, self::HTTP_BAD_REQUEST);
        }

        if (is_null($post_id)) {
            return $this->response('未知的文章 ID', null, self::HTTP_BAD_REQUEST);
        }

        try {
            $post = $this->forum_service->getPost($board_id, $post_id);
        } catch (EntityNotFoundException $e) {
            return $this->response($e->getMessage(), null, self::HTTP_BAD_REQUEST);
        }

        return $this->response(null, $post);
    }

    /**
     * 取得指定文章底下的回應
     *
     * @param int|null $board_id 討論板 ID
     * @param int|null $post_id 文章 ID
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *   path="/api/v1/forums/boards/{board_id}/posts/{post_id}/replies",
     *   summary="取得指定文章底下的回應",
     *   tags={"Forum v1"},
     *   @OA\Parameter(
     *     name="board_id",
     *     description="討論板 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *     name="post_id",
     *     description="文章 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="成功取得指定文章底下的回應",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/BaseResponse"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data",
     *             ref="#/components/schemas/GetReplyListResponse"
     *           )
     *         )
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="提供的資料不正確或註冊過程中發生錯誤",
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="系統發生無法預期的錯誤",
     *   ),
     * )
     */
    public function getReplies(int $board_id = null, int $post_id = null, Request $request): JsonResponse
    {
        if (is_null($board_id)) {
            return $this->response('未知的討論版 ID', null, self::HTTP_BAD_REQUEST);
        }

        if (is_null($post_id)) {
            return $this->response('未知的文章 ID', null, self::HTTP_BAD_REQUEST);
        }

        /** @var int 頁碼 */
        $page = 1;
        if ($request->has('page') && strlen($request->query('page')) > 0) {
            $page = (int) $request->input('page');
        }

        $replies = $this->forum_service->getReplies($board_id, $post_id, $page);

        return $this->response(null, $replies);
    }

    /**
     * 取得指定的回應
     *
     * @param int|null $board_id 討論板 ID
     * @param int|null $post_id 文章 ID
     * @param int|null $reply_id 回應 ID
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *   path="/api/v1/forums/boards/{board_id}/posts/{post_id}/replies/{reply_id}",
     *   summary="取得指定的回應",
     *   tags={"Forum v1"},
     *   @OA\Parameter(
     *     name="board_id",
     *     description="討論板 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *     name="post_id",
     *     description="文章 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *     name="reply_id",
     *     description="回應 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="成功取得指定的回應",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/BaseResponse"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data",
     *             ref="#/components/schemas/ReplyDTO"
     *           )
     *         )
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="提供的資料不正確或註冊過程中發生錯誤",
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="系統發生無法預期的錯誤",
     *   ),
     * )
     */
    public function getReplyById(int $board_id = null, int $post_id = null, int $reply_id = null): JsonResponse
    {
        if (is_null($board_id)) {
            return $this->response('未知的討論版 ID', null, self::HTTP_BAD_REQUEST);
        }

        if (is_null($post_id)) {
            return $this->response('未知的文章 ID', null, self::HTTP_BAD_REQUEST);
        }

        if (is_null($reply_id)) {
            return $this->response('未知的回應 ID', null, self::HTTP_BAD_REQUEST);
        }

        $reply = $this->forum_service->getReplyById($board_id, $post_id, $reply_id);

        return $this->response(null, $reply);
    }

    /**
     * 取得所有文章種類
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *   path="/api/v1/forums/commons/post/types",
     *   summary="取得所有文章種類",
     *   tags={"Forum v1"},
     *   @OA\Response(
     *     response="200",
     *     description="成功取得所有文章種類",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/BaseResponse"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data",
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/CategoryDTO")
     *           )
     *         )
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="提供的資料不正確或註冊過程中發生錯誤",
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="系統發生無法預期的錯誤",
     *   ),
     * )
     */
    public function getPostTypeList(): JsonResponse
    {
        $types = $this->forum_service->getPostTypeList();

        return $this->response(null, $types);
    }

    /**
     * 發布新文章
     *
     * @param int $board_id 討論板 ID
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *   path="/api/v1/forums/boards/{board_id}/posts",
     *   summary="發布新文章",
     *   tags={"Forum v1"},
     *   security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *     name="board_id",
     *     description="討論板 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       ref="#/components/schemas/CreatePostRequest"
     *     )
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="成功發布新文章",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/BaseResponse"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data"
     *           )
     *         )
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="提供的資料不正確或註冊過程中發生錯誤",
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="系統發生無法預期的錯誤",
     *   ),
     * )
     */
    public function createPost(Request $request, int $board_id = null): JsonResponse
    {
        if (is_null($board_id)) {
            return $this->response('未知的討論板', null, self::HTTP_BAD_REQUEST);
        }

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'category' => ['required', 'numeric'],
            'content' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->response('標題、分類或內容格式不正確', null, self::HTTP_BAD_REQUEST);
        }

        $this->forum_service->createPost(
            $request->input('authorization.id'),
            $board_id,
            $request->input('title'),
            $request->input('category'),
            $request->input('content')
        );

        return $this->response();
    }

    /**
     * 發布新回應
     *
     * @param \Illuminate\Http\Request $request
     * @param int|null $board_id 討論版 ID
     * @param int|null $post_id 文章 ID
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *   path="/api/v1/forums/boards/{board_id}/post/{post_id}/replies",
     *   summary="發布新回應",
     *   tags={"Forum v1"},
     *   security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *     name="board_id",
     *     description="討論板 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *     name="post_id",
     *     description="文章 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       ref="#/components/schemas/CreateReplyRequest"
     *     )
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="成功發布新回應",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/BaseResponse"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data"
     *           )
     *         )
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="提供的資料不正確或註冊過程中發生錯誤",
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="系統發生無法預期的錯誤",
     *   ),
     * )
     */
    public function createReply(Request $request, int $board_id = null, int $post_id = null): JsonResponse
    {
        if (is_null($board_id)) {
            return $this->response('未知的討論板', null, self::HTTP_BAD_REQUEST);
        }

        if (is_null($post_id)) {
            return $this->response('未知的文章', null, self::HTTP_BAD_REQUEST);
        }

        $validator = Validator::make($request->all(), [
            'title' => ['nullable', 'string'],
            'content' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->response('標題、內容格式不正確', null, self::HTTP_BAD_REQUEST);
        }

        $this->forum_service->createReply(
            $request->input('authorization.id'),
            $board_id,
            $post_id,
            $request->input('content'),
            $request->input('title')
        );

        return $this->response();
    }

    /**
     * 編輯文章
     *
     * @param \Illuminate\Http\Request $request
     * @param int|null $board_id
     * @param int|null $post_id
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Patch(
     *   path="/api/v1/forums/boards/{board_id}/post/{post_id}",
     *   summary="編輯文章",
     *   tags={"Forum v1"},
     *   security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *     name="board_id",
     *     description="討論板 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *     name="post_id",
     *     description="文章 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       ref="#/components/schemas/EditPostRequest"
     *     )
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="成功編輯文章",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/BaseResponse"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data"
     *           )
     *         )
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="提供的資料不正確或註冊過程中發生錯誤",
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="系統發生無法預期的錯誤",
     *   ),
     * )
     */
    public function editPost(Request $request, int $board_id = null, int $post_id = null): JsonResponse
    {
        if (is_null($board_id)) {
            return $this->response('未知的討論板', null, self::HTTP_BAD_REQUEST);
        }

        if (is_null($post_id)) {
            return $this->response('未知的文章', null, self::HTTP_BAD_REQUEST);
        }

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'category' => ['required', 'numeric'],
            'content' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->response('標題、分類或內容格式不正確', null, self::HTTP_BAD_REQUEST);
        }

        try {
            $this->forum_service->editPost(
                $request->input('authorization.id'),
                $board_id,
                $post_id,
                $request->input('title'),
                $request->input('category'),
                $request->input('content')
            );
        } catch (EntityNotFoundException|InvalidArgumentException $e) {
            return $this->response($e->getMessage(), null, self::HTTP_BAD_REQUEST);
        }

        return $this->response();
    }

    /**
     * 編輯回應
     *
     * @param \Illuminate\Http\Request $request
     * @param int|null $board_id 討論板 ID
     * @param int|null $post_id 文章 ID
     * @param int|null $reply_id 回應 ID
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Patch(
     *   path="/api/v1/forums/boards/{board_id}/post/{post_id}/reply/{reply_id}",
     *   summary="編輯回應",
     *   tags={"Forum v1"},
     *   security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *     name="board_id",
     *     description="討論板 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *     name="post_id",
     *     description="文章 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *     name="reply_id",
     *     description="回應 PK",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       ref="#/components/schemas/EditReplyRequest"
     *     )
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="成功編輯回應",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/BaseResponse"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data"
     *           )
     *         )
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="提供的資料不正確或註冊過程中發生錯誤",
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="系統發生無法預期的錯誤",
     *   ),
     * )
     */
    public function editReply(Request $request, int $board_id = null, int $post_id = null, int $reply_id = null)
    {
        if (is_null($board_id)) {
            return $this->response('未知的討論板', null, self::HTTP_BAD_REQUEST);
        }

        if (is_null($post_id)) {
            return $this->response('未知的文章', null, self::HTTP_BAD_REQUEST);
        }

        if (is_null($reply_id)) {
            return $this->response('未知的回應', null, self::HTTP_BAD_REQUEST);
        }

        $validator = Validator::make($request->all(), [
            'title' => ['nullable', 'string'],
            'content' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->response('標題或內容格式不正確', null, self::HTTP_BAD_REQUEST);
        }

        try {
            $this->forum_service->editReply(
                $request->input('authorization.id'),
                $board_id,
                $post_id,
                $reply_id,
                $request->input('content'),
                $request->input('title')
            );
        } catch (EntityNotFoundException|InvalidArgumentException $e) {
            return $this->response($e->getMessage(), null, self::HTTP_BAD_REQUEST);
        }

        return $this->response();
    }
}
