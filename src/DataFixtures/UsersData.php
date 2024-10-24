<?php

declare(strict_types=1);

namespace App\DataFixtures;

class UsersData {

    public const DATA = [

        [
            'firstName' => 'Samira',
            'lastName' => 'Macias',
            'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/14.webp',
            'email' => 'samira.macias@gmail.com',
            'roles' => 'ROLE_ADMIN',
            'occupation' => 1,
            'department' => 1
        ],
        [
            'firstName' => 'Teresa',
            'lastName' => 'Pratt',
            'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/15.webp',
            'email' => 'teresa.pratt@gmail.com',
            'roles' => 'ROLE_HEAD',
            'occupation' => 1,
            'department' => 2
        ],
        [
            'firstName' => 'Julie',
            'lastName' => 'McCall',
            'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/16.webp',
            'email' => 'julie.mccall@gmail.com',
            'roles' => 'ROLE_MANAGER',
            'occupation' => 2,
            'department' => 2
        ],
        [
            'firstName' => 'Carolina',
            'lastName' => 'Fry',
            'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/17.webp',
            'email' => 'carolina.fry@gmail.com',
            'roles' => 'ROLE_MANAGER',
            'occupation' => 2,
            'department' => 2
        ],
        [
            'firstName' => 'Emma',
            'lastName' => 'Herrera',
            'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/18.webp',
            'email' => 'emma.herrera@gmail.com',
            'roles' => 'ROLE_AGENT',
            'occupation' => 3,
            'department' => 3
        ],
        [
            'firstName' => 'Danny',
            'lastName' => 'Smith',
            'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-1.webp',
            'email' => 'danny.smith@gmail.com',
            'roles' => 'ROLE_AGENT',
            'occupation' => 3,
            'department' => 3
        ],
        [
            'firstName' => 'Alex',
            'lastName' => 'Steward',
            'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-2.webp',
            'email' => 'alex.steward@gmail.com',
            'roles' => 'ROLE_AGENT',
            'occupation' => 3,
            'department' => 3
        ],
        [
            'firstName' => 'Ashley',
            'lastName' => 'Olsen',
            'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-3.webp',
            'email' => 'ashley.olsen@gmail.com',
            'roles' => 'ROLE_USER',
            'occupation' => 4,
            'department' => 4
        ],
        [
            'firstName' => 'Kate',
            'lastName' => 'Moss',
            'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-4.webp',
            'email' => 'kate.moss@gmail.com',
            'roles' => 'ROLE_USER',
            'occupation' => 4,
            'department' => 4
        ],
        [
            'firstName' => 'Lara',
            'lastName' => 'Croft',
            'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp',
            'email' => 'lara.croft@gmail.com',
            'roles' => 'ROLE_USER',
            'occupation' => 4,
            'department' => 4
        ],
        // [
        //     'firstName' => 'Brad',
        //     'lastName' => 'Pitt',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp',
        //     'email' => 'brad.pitt@gmail.com'
        // ],
        // [
        //     'firstName' => 'Kelvin',
        //     'lastName' => 'Jackson',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-7.webp',
        //     'email' => 'kelvin.jackson@gmail.com'
        // ],
        // [
        //     'firstName' => 'Hugo',
        //     'lastName' => 'Daniel',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-8.webp',
        //     'email' => 'hugo.daniel@gmail.com'
        // ],
        // [
        //     'firstName' => 'Reina',
        //     'lastName' => 'Monroe',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-9.webp',
        //     'email' => 'reina.monroe@gmail.com'
        // ],
        // [
        //     'firstName' => 'Jessica',
        //     'lastName' => 'Berg',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-10.webp',
        //     'email' => 'jessica.berg@gmail.com'
        // ],
        // [
        //     'firstName' => 'Samantha',
        //     'lastName' => 'Gray',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-11.webp',
        //     'email' => 'samantha.gray@gmail.com'
        // ],
        // [
        //     'firstName' => 'Annie',
        //     'lastName' => 'Hart',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-12.webp',
        //     'email' => 'annie.hart@gmail.com'
        // ],
        // [
        //     'firstName' => 'Dexter',
        //     'lastName' => 'Clark',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-13.webp',
        //     'email' => 'dexter.clark@gmail.com'
        // ],
        // [
        //     'firstName' => 'Duncan',
        //     'lastName' => 'Marshall',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-14.webp',
        //     'email' => 'duncan.marshall@gmail.com'
        // ],
        // [
        //     'firstName' => 'Ben',
        //     'lastName' => 'Perkins',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-15.webp',
        //     'email' => 'ben.perkins@gmail.com'
        // ],
        // [
        //     'firstName' => 'Melina',
        //     'lastName' => 'Nielsen',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-16.webp',
        //     'email' => 'melina.nielsen@gmail.com'
        // ],
        // [
        //     'firstName' => 'Scott',
        //     'lastName' => 'Gutierrez',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/1.webp',
        //     'email' => 'scott.gutierrez@gmail.com'
        // ],
        // [
        //     'firstName' => 'Devin',
        //     'lastName' => 'Reeves',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/3.webp',
        //     'email' => 'devin.reeves@gmail.com'
        // ],
        // [
        //     'firstName' => 'June',
        //     'lastName' => 'Francis',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/7.webp',
        //     'email' => 'june.francis@gmail.com'
        // ],
        // [
        //     'firstName' => 'Samuel',
        //     'lastName' => 'Quintana',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/8.webp',
        //     'email' => 'samuel.quintana@gmail.com'
        // ],
        // [
        //     'firstName' => 'Nola',
        //     'lastName' => 'Peterson',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/9.webp',
        //     'email' => 'nola.peterson@gmail.com'
        // ],
        // [
        //     'firstName' => 'Estrella',
        //     'lastName' => 'Welch',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/10.webp',
        //     'email' => 'estrella.welch@gmail.com'
        // ],
        // [
        //     'firstName' => 'Nataly',
        //     'lastName' => 'Baxter',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/11.webp',
        //     'email' => 'nataly.baxter@gmail.com'
        // ],
        // [
        //     'firstName' => 'Lana',
        //     'lastName' => 'Pope',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/12.webp',
        //     'email' => 'lana.pope@gmail.com'
        // ],
        // [
        //     'firstName' => 'Sara',
        //     'lastName' => 'Jordan',
        //     'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/13.webp',
        //     'email' => 'sara.jordan@gmail.com'
        // ]
    ];
}
