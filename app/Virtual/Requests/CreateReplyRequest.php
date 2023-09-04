<?php

namespace App\Virtual\Request;

/**
 * 建立文章回應的請求格式
 *
 * @OA\Schema(
 *   title="建立文章回應的請求格式",
 *   description="建立文章回應的請求格式",
 *   type="object",
 *   required={"content"}
 * )
 */
class CreateReplyRequest
{
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
     *   example="內容"
     * )
     */
    public $content;
}
