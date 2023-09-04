<?php

namespace App\Virtual\Responses;

use App\Virtual\Commons\PostDTO;

/**
 * 取得討論板文章的格式
 *
 * @OA\Schema(
 *   title="取得討論板文章的格式",
 *   description="取得討論板文章的格式",
 *   type="object"
 * )
 */
class GetPostListResponse extends PostDTO
{
    /**
     * 回應總數
     *
     * @var int
     *
     * @OA\Property(
     *   description="回應總數",
     *   example=30
     * )
     */
    public $replies_quantity;

    /**
     * 最後操作時間
     *
     * @var string
     *
     * @OA\Property(
     *   description="最後操作時間",
     *   example="2022-11-17T01:50:00.000Z"
     * )
     */
    public $last_operation_at;
}
