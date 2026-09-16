<?php

declare(strict_types=1);

include __DIR__ . '/include/boot.php';
include_once __DIR__ . '/include/login_functions.php';

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit("Este script solo debe ejecutarse por CLI.\n");
}

$groups = [
    'director' => 7,
    'editor' => 8,
    'periodista' => 9,
    'fotografo' => 10,
];

$users = [
    ['Alejandra Velez', 'mavelez@elcomercio.com', 'fotografo', 'LusEFGrt'],
    ['Alexis Sinchire', 'asinchire@elcomercio.com', 'periodista', 'cDmKyOdf'],
    ['Ana Freire', 'afreire@elcomercio.com', 'periodista', 'nUUvhjdf'],
    ['Betty Jumbo', 'bjumbo@elcomercio.com', 'editor', 'gXeSubnh'],
    ['Carlos Rojas', 'crojasc@elcomercio.com', 'editor', 'fwRGNDfd'],
    ['Carolina Castillo', 'ccastillo@elcomercio.com', 'editor', 'zzHmpZfd'],
    ['Carolina Vasco', 'cvasco@elcomercio.com', 'periodista', 'cFvcxdmj'],
    ['Cristian Escudero', 'cescudero@elcomercio.com', 'editor', 'iGOnntfd'],
    ['Diego Pallero', 'dpallero@elcomercio.com', 'fotografo', 'LPFzPrwe'],
    ['Enrique Pesantes', 'enriquep@elcomercio.com', 'fotografo', 'FWvwHQdf'],
    ['Gabriela Quiroz', 'gquiroz@elcomercio.com', 'editor', 'BRTbItvd'],
    ['Giovanna Alvear', 'alvearg@elcomercio.com', 'periodista', 'OaKpYIsd'],
    ['Giovanni Astudillo', 'gastudillo@elcomercio.com', 'editor', 'QCSJdnes'],
    ['Gladys Rivadeneira', 'grivadeneira@elcomercio.com', 'periodista', 'VaWzZyds'],
    ['Jenny Martinez', 'jennym@elcomercio.com', 'periodista', 'dcFJspds'],
    ['Jhorvy Guaynalla', 'jguaynalla@elcomercio.com', 'periodista', 'huNQUMds'],
    ['Jorge Bustillos', 'jbustillos@elcomercio.com', 'fotografo', 'vgNnbmds'],
    ['Jorge Imbaquingo', 'jimbaquingo@elcomercio.com', 'director', 'yrzAGFds'],
    ['Juan Carlos Ocaña', 'jcocania@elcomercio.com', 'fotografo', 'XguEArer'],
    ['Julio Estrella', 'jestrella@elcomercio.com', 'fotografo', 'cEvXOcds'],
    ['Katty Reinoso', 'creinoso@elcomercio.com', 'fotografo', 'wZPYZRds'],
    ['Kevin Puga', 'kpuga@elcomercio.com', 'periodista', 'UjNPqTng'],
    ['Leah Murdoch', 'lmurdoch@elcomercio.com', 'periodista', 'rctvOEcs'],
    ['Marco Sánchez', 'mvsanchez@elcomercio.com', 'fotografo', 'pabUFDzx'],
    ['Marcos Vaca', 'marcosv@elcomercio.com', 'director', 'sGxSImbg'],
    ['María Jose Aguilar', 'aguilarm@elcomercio.com', 'periodista', 'PqnttSsd'],
    ['Michell Sánchez', 'msanchez@elcomercio.com', 'periodista', 'ZNYQetgh'],
    ['Moisés Caceres', 'acaceres@elcomercio.com', 'periodista', 'NoZfmrsd'],
    ['Mónica Jara', 'monica.jara@elcomercio.com', 'periodista', 'PQGImiju'],
    ['Orlando Silva', 'osilva@elcomercio.com', 'periodista', 'jIAYBlds'],
    ['Oscar Alvarez', 'oalvarez@elcomercio.com', 'fotografo', 'nMUhScsd'],
    ['Paola Gavilanes', 'pgavilanes@elcomercio.com', 'editor', 'JuTaoEju'],
    ['Patricio Vela', 'pvela@elcomercio.com', 'periodista', 'IIcSOWer'],
    ['Paulo Álvarez', 'palvarez@elcomercio.com', 'periodista', 'ZrToWesd'],
    ['Pia Andrade', 'pandrade@elcomercio.com', 'fotografo', 'xzApJWju'],
    ['Ramón Nuñez', 'ramonnunezdelarco@gmail.com', 'fotografo', 'AyrdEFsd'],
    ['Richard Jiménez', 'rjimenez@elcomercio.com', 'periodista', 'XVuwXgqw'],
    ['Richard Velasco', 'rvelasco@elcomercio.com', 'periodista', 'pCeFeTfd'],
    ['Rosa Salas', 'rosa.salas@elcomercio.com', 'fotografo', 'VhdUHenh'],
    ['Samuel Fernández', 'sfernandez@elcomercio.com', 'fotografo', 'Ivartgdf'],
    ['Santiago Estrella', 'santiago.estrella@elcomercio.com', 'fotografo', 'xOyAKLsd'],
    ['Sebastián Flores', 'sflores@elcomercio.com', 'periodista', 'webKRdhu'],
    ['Vanessa Ulloa', 'vulloa@elcomercio.com', 'periodista', 'mioifOfd'],
    ['Verónica Jarrín', 'vjarrin@elcomercio.com', 'fotografo', 'JPZQwQsd'],
];

$created = [];
$skipped = [];

foreach ($users as [$fullname, $email, $role, $password]) {
    if (!isset($groups[$role])) {
        $skipped[] = "{$email} - rol no reconocido: {$role}";
        continue;
    }

    $username = explode('@', $email)[0];
    $existing_ref = ps_value(
        'SELECT ref value FROM user WHERE username = ? OR email = ? LIMIT 1',
        ['s', $username, 's', $email],
        0
    );

    if ((int) $existing_ref > 0) {
        $skipped[] = "{$username} ({$email}) ya existe, ref {$existing_ref}";
        continue;
    }

    $password_hash = rs_password_hash("RS{$username}{$password}");

    ps_query(
        'INSERT INTO user (username, password, fullname, email, usergroup, approved, lang, password_last_change)
         VALUES (?, ?, ?, ?, ?, 1, ?, NOW())',
        ['s', $username, 's', $password_hash, 's', $fullname, 's', $email, 'i', $groups[$role], 's', 'es']
    );

    $created[] = "{$username} ({$email})";
}

echo "Usuarios creados: " . count($created) . PHP_EOL;
foreach ($created as $line) {
    echo "  + {$line}" . PHP_EOL;
}

echo PHP_EOL . "Usuarios saltados: " . count($skipped) . PHP_EOL;
foreach ($skipped as $line) {
    echo "  - {$line}" . PHP_EOL;
}

