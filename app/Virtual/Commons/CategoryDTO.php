<?php

namespace App\Virtual\Commons;

/**
 * 文章分類的格式
 *
 * @OA\Schema(
 *   title="文章分類的格式",
 *   description="文章分類的格式",
 *   type="object"
 * )
 */
class CategoryDTO
{
    /**
     * 文章分類 PK
     *
     * @var int
     *
     * @OA\Property(
     *   description="文章分類 PK",
     *   example=1
     * )
     */
    public $id;

    /**
     * 文章分類名稱
     *
     * @var int
     *
     * @OA\Property(
     *   description="文章分類名稱",
     *   example="綜合討論"
     * )
     */
    public $name;

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
