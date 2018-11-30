<?php

namespace AppBundle\Helper;

/**
 * Class HtmlBuilderHelper
 *
 * @package AppBundle\Helper
 */
class HtmlBuilderHelper {

    /**
     * Create link html
     *
     * @param string $path
     * @param string $label
     *
     * @return string
     */
    public static function createLinkHtml(string $path, string $label) {
        return sprintf('<a href="%s">%s</a>', $path, $label);
    }

    /**
     * @param int|null $fontSize
     *
     * @return string
     */
    public static function createSuccessSymbolHtml(int $fontSize = null) {
        return self::createSymbolHtml('fa fa-check text-success', $fontSize);
    }

    /**
     * @param int|null $fontSize
     *
     * @return string
     */
    public static function createDangerSymbolHtml(int $fontSize = null) {
        return self::createSymbolHtml('fa fa-times text-danger', $fontSize);
    }

    /**
     * Create font awesome html symbol
     *
     * @param string $classes
     * @param int|null $fontSize
     *
     * @return string
     */
    private static function createSymbolHtml(string $classes, int $fontSize = null) {
        $styles = [];
        if ($fontSize) {
            $styles[] = "font-size: {$fontSize}px";
        }
        $styleStr = implode('', $styles);
        $styleStr = $styleStr ? "style='{$styleStr}'" : '';
        return "<span class='{$classes}' {$styleStr}>&nbsp;</span>";
    }

}