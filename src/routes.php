<?php

return [

    'home' => [
        'GET', '/', [
            'HomepageController', 'indexAction',
        ],
    ],

    'group' => [
        'GET', '/group/[i:id]', [
            'ExamsGroupController', 'indexAction',
        ],
    ],

    'exam' => [
        'GET|POST', '/exam/[i:id]', [
            'ExamController', 'showAction',
        ],
    ],

    'dashboard' => [
        'GET', '/admin', [
            'DashboardController', 'indexAction',
        ],
    ],

    'login' => [
        [
            'GET', '/admin/login', [
                'LoginController', 'loginAction',
            ],
        ], [
            'POST', '/admin/login', [
                'LoginController', 'postLoginAction',
            ],
        ],
    ],

    'logout' => [
        'GET', '/admin/logout', [
            'LogoutController', 'logoutAction',
        ],
    ],

    'exam/add' => [
        [
            'GET', '/admin/exam/add', [
                'ExamAddController', 'addAction',
            ],
        ], [
            'POST', '/admin/exam/add', [
                'ExamAddController', 'postAddAction',
            ],
        ],
    ],

    'exam/edit' => [
        [
            'GET', '/admin/exam/edit/[i:id]', [
                'ExamEditController', 'editAction',
            ],
        ], [
            'POST', '/admin/exam/edit/[i:id]', [
                'ExamEditController', 'postEditAction',
            ],
        ],
    ],

    'exam/del' => [
        [
            'GET', '/admin/exam/del/[i:id]', [
                'ExamDeleteController', 'deleteAction',
            ],
        ], [
            'POST', '/admin/exam/del/[i:id]', [
                'ExamDeleteController', 'postDeleteAction',
            ],
        ],
    ],

    'question/add' => [
        [
            'GET', '/admin/exam/edit/[i:id]/question/add', [
                'QuestionAddController', 'addAction',
            ],
        ], [
            'POST', '/admin/exam/edit/[i:id]/question/add', [
                'QuestionAddController', 'postAddAction',
            ],
        ],
    ],

    'question/edit' => [
        [
            'GET', '/admin/exam/edit/[i:id]/question/edit/[i:qid]', [
                'QuestionEditController', 'editAction',
            ],
        ], [
            'POST', '/admin/exam/edit/[i:id]/question/edit/[i:qid]', [
                'QuestionEditController', 'postEditAction',
            ],
        ],
    ],

    'question/del' => [
        [
            'GET', '/admin/exam/edit/[i:id]/question/del/[i:qid]', [
                'QuestionDeleteController', 'deleteAction',
            ],
        ], [
            'POST', '/admin/exam/edit/[i:id]/question/del/[i:qid]', [
                'QuestionDeleteController', 'postDeleteAction',
            ],
        ],
    ],
];
