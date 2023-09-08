<?php

namespace App\Virtual\Requests;

/**
 * 編輯文章回應的請求格式
 *
 * @OA\Schema(
 *   title="編輯文章回應的請求格式",
 *   description="編輯文章回應的請求格式",
 *   type="object",
 *   required={"title", "category", "content"}
 * )
 */
class EditReplyRequest extends CreateReplyRequest
{
    //
}
