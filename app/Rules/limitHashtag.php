<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\HashtagService;
class limitHashtag implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $hashtagService;
    public function __construct(HashtagService $hashtagService)
    {
        $this->hashtagService = $hashtagService;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $countHashtag = $this->hashtagService->getHashtags($value);
        return $countHashtag <= 5;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'هر :attribute فقط میتواند شامل 5 هشتگ باشد';
    }
}
