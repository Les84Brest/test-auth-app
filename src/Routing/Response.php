<?php

declare(strict_types=1);

namespace TestApp\Routing;

use TestApp\Api\ResponseInterface;
use TestApp\Helper\RenderHelper;

class Response implements ResponseInterface
{
    private string $template;
    private string $layout;

    public function __construct(
        private readonly string $templateDir,
        private array $vars = [],
        private array $layoutVars = []
    ) {
    }

    public function template(string $name, $vars = []): void
    {
        $this->addVars($vars);
        $this->template = $this->templateDir . '/' . $name . '.php';
    }

    public function setLayout(string $layout = 'layout'):void
    {
        $this->layout = $this->templateDir . '/' . 'base/' . $layout . '.php';
    }

    public function addVars($vars): void
    {
        $this->vars = array_merge($this->vars, $vars);
    }

    public function addLayoutVars($vars): void
    {
        $this->layoutVars = array_merge($this->layoutVars, $vars);
    }

    public function render(): void
    {
        if (empty($this->layout)) {
            return;
        }

        extract($this->layoutVars, EXTR_SKIP);
        extract($this->vars, EXTR_SKIP);

        ob_start();
        include $this->template;
        $content = ob_get_clean();
        include $this->layout;

    }
}
