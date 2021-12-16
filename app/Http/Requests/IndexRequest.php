<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * All the rules.
     */
    final public function rules(): array
    {
        $rules = $this->additionalRules();

        return $this->injectPaginationRules($rules);
    }

    /**
     * Additional rules that can be overridden.
     */
    protected function additionalRules(): array
    {
        return [];
    }

    /**
     * Prepare the data for validation.
     */
    final protected function prepareForValidation()
    {
        $this->injectDefaultPaginationValues();
    }

    /**
     * Adding to existing rules pagination rules.
     */
    protected function injectPaginationRules(array $rules = []): array
    {
        $rules['current_page'] = 'nullable|integer|min:1';
        $rules['per_page'] = 'nullable|integer|min:' . config('pagination.per_page_min');

        return $rules;
    }

    /**
     * Inject into request default values for pagination.
     */
    protected function injectDefaultPaginationValues(): void
    {
        $this->merge([
            'current_page' => !is_null($this->current_page) ? $this->current_page : 1,
            'per_page' => !is_null($this->per_page) ? $this->per_page : config('pagination.per_page_default'),
        ]);
    }
}
