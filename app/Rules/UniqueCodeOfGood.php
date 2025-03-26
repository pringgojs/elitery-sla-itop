<?php

namespace App\Rules;

use App\Models\Good;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueCodeOfGood implements ValidationRule
{
    protected $good;

    protected $code;

    public function __construct($code, $good = null)
    {
        $this->code = $code;
        $this->good = $good;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = Good::where('code', $this->code);

        if ($this->good) {
            $query->where('id', '!=', $this->good->id);
        }

        if ($query->exists()) {
            $fail('kode ini sudah ada. Silahkan pilih yang lain.');
        }
    }
}
