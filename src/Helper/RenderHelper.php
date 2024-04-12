<?php

declare(strict_types=1);

namespace TestApp\Helper;

class RenderHelper
{
    public function renderErrorMessage(string $key, mixed $messages): string
    {
        if (!isset($messages)) {
            return  '';
        }
        if (isset($messages[$key])) {
            return  sprintf('<span class="input-block__error">%s</span>', $messages[$key]);
        }
        return '';
    }

    public function renderOldData(string $key, mixed $data): string
    {
        if (!isset($data)) {
            return  '';
        }
        if (isset($data[$key])) {
            return  sprintf(' value="%s" ', $data[$key]);
        }
        return '';
    }
}
