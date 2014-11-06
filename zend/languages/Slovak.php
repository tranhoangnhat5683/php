<?php

return array(
    'isEmpty'                      => 'Hodnota nemôže byť prázdna',
    'Captcha value is wrong'       => 'Nesprávny captcha text',
    // StringLength
    'stringLengthInvalid'          => "Nesprávny dátový typ, hodnota by mala byť reťazec",
    'stringLengthTooShort'         => "'%value%' je kratší ako %min% znakov dlhý reťazec",
    'stringLengthTooLong'          => "'%value%' je dlhší ako %max% znakov dlhý reťazec",
    // EmailAddress
    'emailAddressInvalid'          => "Nesprávny dátový typ, hodnota by mala byť reťazec",
    'emailAddressInvalidFormat'    => "'%value%' nie je validná emailová addresa v základnom formáte local-part@hostname",
    'emailAddressInvalidHostname'  => "'%hostname%' nie je validné hostname pre emailovú adresu '%value%'",
    'emailAddressInvalidMxRecord'  => "'%hostname%' pravdepodobne nemá validný MX záznam pre emailovú adresu '%value%'",
    'emailAddressDotAtom'          => "'%localPart%' nesedí s 'dot-atom' formátom",
    'emailAddressQuotedString'     => "'%localPart%' nesedí s 'quoted-string' formátom",
    'emailAddressInvalidLocalPart' => "'%localPart%' nie je validná lokálna časť pre emailovú adresu '%value%'",
    'emailAddressLengthExceeded'   => "'%value%' presahuje povolenú dĺžku",
    // Digits
    'notDigits'                    => "'%value%' neobsahuje ibe číslice",
    'stringEmpty'                  => "'%value%' je prázdny reťazec",
    'digitsInvalid'                => "Nesprávny dátový typ, hodnota by mala byť reťazec, celé alebo desatinné číslo",
    // Int
    'intInvalid'                   => "Nesprávny dátový typ, hodnota by mala byť reťazec alebo celé číslo",
    'notInt'                       => "'%value%' nie je celé číslo",
    // Date
    'dateInvalid'                  => "Nesprávny dátový typ, hodnota by mala byť reťazec, celé číslo, pole alebo Zend_Date",
    'dateNotYYYY-MM-DD'            => "'%value%' nie je dátum vo formáte YYYY-MM-DD",
    'dateInvalidDate'              => "'%value%' nie je validný dátum",
    'dateFalseFormat'              => "'%value%' nesedí s daným formátom dátumu",
    // Regex
    'regexInvalid'                 => "Nesprávny dátový tip, hodnota by mala byť reťazec, celé alebo desatinné číslo",
    'regexNotMatch'                => "'%value%' nesúhlasí s formátom regulárneho výrazu '%pattern%'",
    // File -> Count
    'fileCountTooMuch'             => "Príliš mnoho súborov, najviac '%max%' povolených, ale '%count%' bolo zadaných",
    'fileCountTooLess'             => "Príliš málo súborov, najmenej '%min%' očakávaných, ale '%count%' bolo zadaných",
    // File => Size
    'fileSizeTooBig'               => "Maximálna povolená veľkosť pre súbor '%value%' je '%max%', ale '%size%' detekovaná",
    'fileSizeTooSmall'             => "Minimálna očakávaná veľkosť pre súbor '%value%' je '%min%', ale '%size%' detekovaná",
    'fileSizeNotFound'             => "Súbor '%value%' nemohol byť nájdený",
    // File => Extension
    'fileExtensionFalse'           => "Súbor '%value%' má falošnú príponu",
    'fileExtensionNotFound'        => "Súbor '%value%' nebol nájdený",
    // File => ImageSize
    'fileImageSizeWidthTooBig'     => "Maximálna povolená šírka pre obrázok '%value%' by mala byť '%maxwidth%', ale '%width%' detekovaná",
    'fileImageSizeWidthTooSmall'   => "Minimálna očakávaná šírka pre obrázok '%value%' by mala byť '%minwidth%', ale '%width%' detekovaná",
    'fileImageSizeHeightTooBig'    => "Maximálna povolená výška pre obrázok '%value%' by mala byť '%maxheight%', ale '%height%' detekovaná",
    'fileImageSizeHeightTooSmall'  => "Minimálna očakávaná výška pre obrázok '%value%' by mala byť '%minheight%', ale '%height%' detekovaná",
    'fileImageSizeNotDetected'     => "Veľosť obrázku '%value%' nemohla byť detekovaná",
    'fileImageSizeNotReadable'     => "Obrázok '%value%' nemôže byť prečítaný",
    // File => File
    'fileUploadErrorIniSize'       => "Súbor '%value%' presahuje povolenú veľkosť",
    'fileUploadErrorFormSize'      => "Súbor '%value%' presahuje povolenú veľkosť formulára",
    'fileUploadErrorPartial'       => "Súbor '%value%' bol iba čiastočne prenesený",
    'fileUploadErrorNoFile'        => "Súbor '%value%' nebol prenesený",
    'fileUploadErrorNoTmpDir'      => "Dočasný adresár pre súbor '%value%' nebol nájdený",
    'fileUploadErrorCantWrite'     => "Súbor '%value%' nemôže byť zapísaný",
    'fileUploadErrorExtension'     => "Prípona vrátila chybu počas prenosu súboru '%value%'",
    'fileUploadErrorAttack'        => "Súbor '%value%' bol prenesený ilegálne, možnosť útoku",
    'fileUploadErrorFileNotFound'  => "Súbor '%value%' nebol nájdený",
    'fileUploadErrorUnknown'       => "Neznáma chyba počas prenosu súboru '%value%'"
);