<?php
return [
    "item" => [
        "create" => [
            "200" => "Item successfully created.",
            "400" => "Failed to create item."
        ],
        "mark" => [
            "200" => "Item successfully marked as complete.",
            "400" => "Failed to mark item as complete.",
            "404" => "Item not found."
        ],
        "delete" => [
            "200" => "Item successfully deleted.",
            "400" => "Failed to delete item."
        ],
        "list" => [
            "200" => "Items successfully retrieved.",
            "400" => "Failed to retrieve items.",
            "404" => "No item available."
        ],
        "view" => [
            "200" => "Item successfully retrieved.",
            "400" => "Failed to retrieve item.",
            "404" => "Item not found."
        ],
    ]
];