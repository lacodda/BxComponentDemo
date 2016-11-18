<?php
    /**
     * @link      http://lacodda.com
     * @copyright Copyright © 2016 Kirill Lahtachev
     * @license   MIT
     */

    namespace Lacodda\BxComponent\Components;

    use Lacodda\BxComponent\Basis;

    if (!defined ('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    {
        die();
    }

    /**
     * Component for show stafftools list
     *
     * @author Kirill Lahtachev <lahtachev@gmail.com>
     */
    class ElementsList
        extends Basis
    {
        use \Lacodda\BxComponent\Traits\Elements;

        protected $needModules = ['iblock'];

        protected $checkParams = [
            'IBLOCK_TYPE' => ['type' => 'string'],
            'IBLOCK_ID'   => ['type' => 'int'],
        ];

        protected function executeMain ()
        {
            $rsElements = \CIBlockElement::GetList (
                $this->getParamsSort (),
                $this->getParamsFilters (),
                $this->getParamsGrouping (),
                $this->getParamsNavStart (),
                $this->getParamsSelected (
                    [
                        'DETAIL_PAGE_URL',
                        'LIST_PAGE_URL',
                    ]
                )
            );

            if (!isset($this->arResult['STAFFTOOLS']))
            {
                $this->arResult['STAFFTOOLS'] = [];
            }

            $processingMethod = $this->getProcessingMethod ();

            while ($element = $rsElements->$processingMethod())
            {
                if ($arElement = $this->processingElementsResult ($element))
                {
                    $this->arResult['STAFFTOOLS'][] = $arElement;
                }
            }

            if ($this->arParams['SET_404'] === 'Y' && empty($this->arResult['STAFFTOOLS']))
            {
                $this->return404 ();
            }

            $this->generateNav ($rsElements);
            $this->setResultCacheKeys (['NAV_CACHED_DATA']);
        }
    }