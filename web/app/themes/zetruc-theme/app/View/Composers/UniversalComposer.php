<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class UniversalComposer extends Composer
{
    protected static $views = ['*']; 

    public function with(): array
    {
        if (!is_singular()) {
            return [];
        }

        $data = [];
        $post_id = get_the_ID();
        $fields = get_field_objects($post_id);

        if ($fields) {
            foreach ($fields as $key => $field) {
                if ($field['type'] === 'image') {
                    $data[$key] = is_array($field['value']) ? $field['value']['url'] ?? '' : '';
                } else {
                    $data[$key] = $field['value'];
                }
            }
        }

        return $data;
    }
}
