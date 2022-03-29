<?php

return [
    "super-admin" => [
        "title" => "Super Admin",
        "permissions" => "all",
        "hidden" => true
    ],
    "user" => [
        "title" => "Admin",
        "permissions" => [
            ["viewlist-pixels", "Ver Lista de Pixels"],
            ["create-pixels", "Cadastrar Pixels"],
            ["edit-pixels", "Editar Pixels"],
            ["delete-pixels", "Excluir Pixels"],
        ]
    ],
];
