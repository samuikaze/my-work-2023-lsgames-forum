<?php

namespace App\Virtual\Requests;

/**
 * 建立討論板文章的請求格式
 *
 * @OA\Schema(
 *   title="建立討論板文章的請求格式",
 *   description="建立討論板文章的請求格式",
 *   type="object",
 *   required={"title", "category", "content"}
 * )
 */
class CreatePostRequest
{
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
     * 文章分類 PK
     *
     * @var int
     *
     * @OA\Property(
     *   description="文章分類 PK",
     *   example=1
     * )
     */
    public $category;

    /**
     * 文章內容
     *
     * @var string
     *
     * @OA\Property(
     *   description="文章內容",
     *   example="內容"
     * )
     */
    public $content;
}
