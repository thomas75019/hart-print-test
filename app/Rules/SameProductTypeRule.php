<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Product;

class SameProductTypeRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $firstProductType = Product::find($value[0])->type;

        foreach ($value as $productId) {
            $product = Product::find($productId);
            if ($product->type !== $firstProductType) {
                $fail('All selected products must have the same type.');            
            }
        }
    }
}
