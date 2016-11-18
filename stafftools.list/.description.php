<?php

    use Bitrix\Main\Localization\Loc;

    if (!defined ('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    {
        die();
    }

    Loc::loadMessages (__FILE__);

    $arComponentDescription = array (
        'NAME'        => Loc::getMessage ('STAFFTOOLS_LIST_NAME'),
        'DESCRIPTION' => Loc::getMessage ('STAFFTOOLS_LIST_DESCRIPTION'),
        'SORT'        => 20,
        'PATH'        => array (
            'ID'    => 'basis',
            'NAME'  => Loc::getMessage ('STAFFTOOLS_LIST_GROUP'),
            'SORT'  => 10,
            'CHILD' => array (
                'ID'   => 'stafftools',
                'NAME' => Loc::getMessage ('STAFFTOOLS_LIST_CHILD_GROUP'),
                'SORT' => 10,
            ),
        ),
    );