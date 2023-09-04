<?php

namespace App\Virtual\Commons;

/**
 * 討論板的格式
 *
 * @OA\Schema(
 *   title="討論板的格式",
 *   description="討論板的格式",
 *   type="object"
 * )
 */
class BoardDTO
{
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
    public $id;

    /**
     * 建立者 PK
     *
     * @var int
     *
     * @OA\Property(
     *   description="建立者 PK",
     *   example=1
     * )
     */
    public $user_id;

    /**
     * 討論板名稱
     *
     * @var string
     *
     * @OA\Property(
     *   description="討論板名稱",
     *   example="測試討論板"
     * )
     */
    public $name;

    /**
     * 討論板圖片名稱
     *
     * @var string
     *
     * @OA\Property(
     *   description="討論板圖片名稱",
     *   example="board-test.png"
     * )
     */
    public $board_image;

    /**
     * 討論板描述
     *
     * @var string
     *
     * @OA\Property(
     *   description="討論板描述",
     *   example="討論板描述"
     * )
     */
    public $description;

    /**
     * 是否顯示討論板
     *
     * @var int
     *
     * @OA\Property(
     *   description="是否顯示討論板",
     *   example=1
     * )
     */
    public $show;

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
