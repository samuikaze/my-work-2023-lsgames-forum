<?php

namespace App\Virtual\Responses;

/**
 * 取得指定文章底下回應的格式
 *
 * @OA\Schema(
 *   title="取得指定文章底下回應的格式",
 *   description="取得指定文章底下回應的格式",
 *   type="object"
 * )
 */
class GetReplyListResponse
{
    /**
     * 回應資料
     *
     * @var array
     *
     * @OA\Property(
     *   description="回應資料",
     *   type="array",
     *   @OA\Items(ref="#/components/schemas/ReplyDTO")
     * )
     */
    public $replies;

    /**
     * 總頁數
     *
     * @var int
     *
     * @OA\Property(
     *   description="總頁數",
     *   example=1
     * )
     */
    public $totalPages;
}
