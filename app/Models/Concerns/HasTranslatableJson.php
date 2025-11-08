<?php

namespace App\Models\Concerns;

use Illuminate\Support\Arr;

/**
 * Lightweight JSON translation helper without external packages.
 *
 * Store attributes as either plain strings (backward compatible)
 * or as JSON objects like {"id": "Teks ID", "en": "EN text"}.
 *
 * Usage in Blade: $model->t('name') or $model->t('title', 'en')
 *
 * @deprecated Replaced by spatie/laravel-translatable. This trait is no longer referenced
 *             and can be safely deleted once confirmed unused in your local branches.
 */
trait HasTranslatableJson
{
    /**
     * Return a translated value for an attribute.
     * - If the stored value is a string, returns it as-is.
     * - If it's JSON (array), returns value for current locale, with fallback.
     */
    public function t(string $attribute, ?string $locale = null, bool $fallback = true): ?string
    {
        $value = $this->getAttribute($attribute);

        if (is_null($value)) {
            return null;
        }

        // If plain string, return directly (backward compatible)
        if (is_string($value)) {
            // Try decode if it's a JSON string stored in TEXT
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $value = $decoded;
            } else {
                return $value;
            }
        }

        // If array, treat as {locale => text}
        if (is_array($value)) {
            $locale = $locale ?: app()->getLocale();
            $text = Arr::get($value, $locale);
            if ($text) {
                return $text;
            }
            if ($fallback) {
                $fallbackLocale = config('app.fallback_locale');
                $text = Arr::get($value, $fallbackLocale);
                if ($text) {
                    return $text;
                }
            }
            // As last resort, first non-empty value
            foreach ($value as $v) {
                if (is_string($v) && trim($v) !== '') {
                    return $v;
                }
            }
        }

        return null;
    }

    /**
     * Convenience setter to update a single locale value on an attribute.
     */
    public function setTranslation(string $attribute, string $locale, ?string $text): void
    {
        $current = $this->getAttribute($attribute);
        if (is_string($current)) {
            $decoded = json_decode($current, true);
            $current = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : [];
        }
        if (!is_array($current)) {
            $current = [];
        }
        $current[$locale] = $text;
        $this->setAttribute($attribute, json_encode($current, JSON_UNESCAPED_UNICODE));
    }
}
