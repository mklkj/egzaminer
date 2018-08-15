# Egzaminer

[![Build Status](https://travis-ci.org/mklkj/egzaminer.svg?branch=master)](http://travis-ci.org/mklkj/egzaminer)
[![Coverage Status](https://coveralls.io/repos/github/mklkj/egzaminer/badge.svg?branch=master)](https://coveralls.io/github/mklkj/egzaminer?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mklkj/egzaminer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mklkj/egzaminer/?branch=master)
[![StyleCI](https://styleci.io/repos/67722995/shield?branch=master)](https://styleci.io/repos/67722995)
[![Dependency Status](https://www.versioneye.com/user/projects/58754bc341a6c1004426cda5/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/58754bc341a6c1004426cda5) [![Greenkeeper badge](https://badges.greenkeeper.io/mklkj/egzaminer.svg)](https://greenkeeper.io/)

## Instalation

Via composer

```bash
$ composer create-project mklkj/egzaminer
$ cd egzaminer
$ npm install
$ gulp build
$ cp docs/config-examples/* config/
```

Then adjust the settings files in config/ to your preferences and import `docs/database_mysql.sql` tables.


## Theme structure

```
theme/
├── main.js
├── main.scss
└── templates
    ├── admin
    │   ├── delete.twig
    │   ├── exam
    │   │   ├── add.twig
    │   │   └── edit.twig
    │   ├── index.twig
    │   ├── layout.twig
    │   └── question.twig
    └── front
        ├── error.twig
        ├── exam.twig
        ├── index.twig
        ├── layout.twig
        ├── list.twig
        └── login.twig
```
