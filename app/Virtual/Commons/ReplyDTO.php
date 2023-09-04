<?php

namespace App\Virtual\Commons;

/**
 * 文章回應的格式
 *
 * @OA\Schema(
 *   title="文章回應的格式",
 *   description="文章回應的格式",
 *   type="object"
 * )
 */
class ReplyDTO
{
    /**
     * 回應 PK
     *
     * @var int
     *
     * @OA\Property(
     *   description="回應 PK",
     *   example=1
     * )
     */
    public $id;

    /**
     * 張貼者帳號 PK
     *
     * @var int
     *
     * @OA\Property(
     *   description="張貼者帳號 PK",
     *   example=1
     * )
     */
    public $post_user_id;

    /**
     * 文章 PK
     *
     * @var int
     *
     * @OA\Property(
     *   description="文章 PK",
     *   example=1
     * )
     */
    public $post_id;

    /**
     * 回應標題
     *
     * @var string
     *
     * @OA\Property(
     *   description="回應標題",
     *   example="標題"
     * )
     */
    public $title;

    /**
     * 回應內容
     *
     * @var string
     *
     * @OA\Property(
     *   description="回應內容",
     *   example="回應內容"
     * )
     */
    public $content;

    /**
     * 回應狀態
     *
     * @var int
     *
     * @OA\Property(
     *   description="回應狀態",
     *   example=1
     * )
     */
    public $status;

    /**
     * 建立時間
     *
     * @var string
     *
     * @OA\Property(
     *   description="建立時間",
     *   example="2022-11-17T01:50:00.000Z"
     * )
     */
    public $create_at;

    /**
     * 更新時間
     *
     * @var string
     *
     * @OA\Property(
     *   description="更新時間",
     *   example="2022-11-17T01:50:00.000Z"
     * )
     */
    public $updated_at;

    /**
     * 刪除時間
     *
     * @var string
     *
     * @OA\Property(
     *   description="刪除時間",
     *   example="2022-11-17T01:50:00.000Z"
     * )
     */
    public $deleted_at;
}
