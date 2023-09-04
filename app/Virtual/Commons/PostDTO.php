<?php

namespace App\Virtual\Commons;

/**
 * 討論板文章的格式
 *
 * @OA\Schema(
 *   title="討論板文章的格式",
 *   description="討論板文章的格式",
 *   type="object"
 * )
 */
class PostDTO
{
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
    public $id;

    /**
     * 討論板 PK
     *
     * @var int
     *
     * @OA\Property(
     *   description="討論板 PK",
     *   example=1
     * )
     */
    public $board_id;

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
     * 分類 PK
     *
     * @var int
     *
     * @OA\Property(
     *   description="分類 PK",
     *   example=1
     * )
     */
    public $category_id;

    /**
     * 分類名稱
     *
     * @var string
     *
     * @OA\Property(
     *   description="分類名稱",
     *   example="綜合討論"
     * )
     */
    public $category;

    /**
     * 文章標題
     *
     * @var string
     *
     * @OA\Property(
     *   description="文章標題",
     *   example="標題"
     * )
     */
    public $title;

    /**
     * 文章內容
     *
     * @var string
     *
     * @OA\Property(
     *   description="文章內容",
     *   example="文章內容"
     * )
     */
    public $content;

    /**
     * 文章狀態
     *
     * @var int
     *
     * @OA\Property(
     *   description="文章狀態",
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
