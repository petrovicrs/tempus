<?php

namespace AppBundle\DataTableType;

use Omines\DataTablesBundle\DataTableTypeInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class AbstractDataTableType
 *
 * @package AppBundle\DataTableType
 */
abstract class AbstractDataTableType implements DataTableTypeInterface {

    /** @var ContainerInterface */
    protected $container;

    /**
     * KernelListener constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * Generate route
     *
     * @param string $name
     * @param array $params
     * @param int $referenceType
     *
     * @return string
     */
    protected function generateRoute($name, $params = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH) {
        return $this->getRouter()->generate($name, $params, $referenceType);
    }


    /**
     * Translate string
     *
     * @param string $string
     * @param array $params
     *
     * @return string
     */
    protected function translate(string $string, array $params = []) {
        return $this->getTranslator()->trans($string, $params);
    }

    /**
     * Get locale
     *
     * @return string
     */
    protected function getLocale() {
        return $this->getTranslator()->getLocale();
    }

    /**
     * Return common name column
     *
     * @return string
     */
    protected function getNameColumnName() {
        $nameColumn = 'nameEn';
        if ($this->getLocale() === 'sr') {
            $nameColumn = 'nameSr';
        } elseif ($this->getLocale() === 'lat') {
//            $nameColumn = 'nameLat';
            $nameColumn = 'nameSr';
        }
        return $nameColumn;
    }

    /**
     * Get translator
     *
     * @return TranslatorInterface
     */
    private function getTranslator() {
        /** @var Translator $translator */
        $translator = $this->container->get('translator');
        return $translator;
    }

    /**
     * Get router
     *
     * @return RouterInterface
     */
    private function getRouter() {
        /** @var RouterInterface $router */
        $router = $this->container->get('router');
        return $router;
    }

}