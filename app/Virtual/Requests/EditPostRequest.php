<?php

namespace App\Virtual\Request;

/**
 * 編輯討論板文章的請求格式
 *
 * @OA\Schema(
 *   title="編輯討論板文章的請求格式",
 *   description="編輯討論板文章的請求格式",
 *   type="object",
 *   required={"title", "category", "content"}
 * )
 */
class EditPostRequest extends CreatePostRequest
{
    //
}
