<?php

namespace App\Data;

class CharacterArcData extends ArchivistDto
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function __construct(array $attributes = [])
    {
        // GET /v1/characters/{id}/arc returns a list, empty when the campaign
        // has no CharacterArcTheme rows. A missing or null key is that same
        // state. Laravel's `required` rule rejects [], and nothing downstream
        // persists themes from this payload; the tool only forwards them.
        if (! array_key_exists('themes', $attributes) || $attributes['themes'] === null) {
            $attributes['themes'] = [];
        }

        parent::__construct($attributes);
    }

    public static function rules(): array
    {
        return [
            'character_id' => ['required', 'string'],
            // Each theme: {id, key, title, description, facets: [CharacterArcFacetData-shaped objects]}.
            // `list` (not `required`) so an empty array is valid. Facets on a
            // theme may also be empty; they are not validated as their own DTO.
            'themes' => ['list'],
        ];
    }
}
