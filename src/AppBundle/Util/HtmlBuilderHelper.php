<?php

namespace AppBundle\Util;

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
     * @param string $path
     * @param int|null $fontSize
     *
     * @return string
     */
    public static function createEditLinkSymbolHtml(string $path, int $fontSize = 20) {
        $editSymbol = self::createSymbolHtml('fa fa-edit', $fontSize);
        return self::createLinkHtml($path, $editSymbol);
    }

    /**
     * @param string $path
     * @param int|null $fontSize
     *
     * @return string
     */
    public static function createInfoLinkSymbolHtml(string $path, int $fontSize = 20) {
        $infoSymbol = self::createSymbolHtml('fa fa-info-circle', $fontSize);
        return self::createLinkHtml($path, $infoSymbol);
    }

    /**
     * @param string $path
     * @param int|null $fontSize
     *
     * @return string
     */
    public static function createDeleteLinkSymbolHtml(string $path, int $fontSize = 20) {
        $infoSymbol = self::createSymbolHtml('fa fa-trash', $fontSize);
        return self::createLinkHtml($path, $infoSymbol);
    }

    /**
     * @param string $hiddenValue
     * @param int|null $fontSize
     *
     * @return string
     */
    public static function createSuccessSymbolHtml(string $hiddenValue= null, int $fontSize = 20) {
        return self::createSymbolHtml('fa fa-check text-success', $fontSize, $hiddenValue);
    }

    /**
     * @param string|null $hiddenValue
     * @param int|null $fontSize
     *
     * @return string
     */
    public static function createDangerSymbolHtml(string $hiddenValue= null, int $fontSize = 20) {
        return self::createSymbolHtml('fa fa-times text-danger', $fontSize, $hiddenValue);
    }

    /**
     * Create font awesome html symbol
     *
     * @param string $classes
     * @param int|null $fontSize
     * @param null $hiddenValue
     *
     * @return string
     */
    private static function createSymbolHtml(string $classes, int $fontSize = null, $hiddenValue = null) {
        $styles = [];
        if ($fontSize) {
            $styles[] = "font-size: {$fontSize}px";
        }
        $styleStr = implode('', $styles);
        $styleStr = $styleStr ? "style='{$styleStr}'" : '';
        $value = isset($hiddenValue) ? '<span style="display: none">' . $hiddenValue . '</span>': '&nbsp;';
        return "<span class='{$classes}' {$styleStr}>{$value}</span>";
    }

}