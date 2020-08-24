<?php

declare(strict_types=1);

namespace Core;

final class View
{
    private $viewPath;

    public function __construct(string $viewPath)
    {
        $path = realpath($viewPath);
        if (false === $path) {
            throw new \UnexpectedValueException(sprintf('Directory "%s" not found!', $path));
        }
        $this->viewPath = $path.DIRECTORY_SEPARATOR;
    }

    public function render(string $template, array $data = []): string
    {
        $template = $this->viewPath . $template . '.php';
        if (file_exists($template)) {
            extract($data, EXTR_OVERWRITE);
            ob_start();
            include $template;
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        }

        throw new \UnexpectedValueException(sprintf('Template "%s" not found!', $template));
    }
}