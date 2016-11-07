<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$this->pageTitle;?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,100,500,300italic,500italic,700italic,900,300" rel="stylesheet">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.deep_purple-blue.min.css">
    <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>
    <style>
      .mdl-layout__drawer {
        width: 290px;
        transform: translateX(-290px);
      }
      .mdl-layout-title a {
        color: inherit;
        text-decoration: inherit;
      }
      .img-responsive {
        max-width: 100%;
        height: auto;
        display: block;
      }
      .page-content {
        max-width: 1100px;
        margin: 0 auto 40px;
      }
      .mdl-layout__content {
        flex: 1 0 auto;
      }

      .alert {
        padding: 10px;
        margin: 10px;
      }
      .alert--big {
        padding: 25px;
        margin: 10px 10px 30px;
      }
      .alert--success {
        color: #3c763d;
        background: #dff0d8;
      }
      .alert__text--success {
        color: #3c763d !important;
      }
      .alert--warning {
        color: #8a6d3b;
        background: #fcf8e3;
      }
      .alert__text--warning {
        color: #8a6d3b !important;
      }
      .alert--danger {
        color: #a94442;
        background: #f2dede;
      }
      .alert__text--danger {
        color: #a94442 !important;
      }
      .alert .material-icons {
        margin-right: 5px;
      }
      .table-truncate-container {
        max-width: 700px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      .table-truncate {
        overflow-wrap: break-word;
      }
      .table--responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        overflow-x: scroll;
      }
      .mdl-data-table {
        width: 100%;
      }
      .mdl-textfield {
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">
            <a href="<?=$this->dir();?>/">
              <?=$this->siteTitle;?>
            </a>
          </span>
          <?php if ($this->isLogged()): ?>
          <div class="mdl-layout-spacer"></div>
          <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="<?=$this->dir();?>/admin">Panel administracyjny</a></li>
            <a class="mdl-navigation__link" href="<?=$this->dir();?>/admin/test/add">Dodaj test</a></li>
            <a class="mdl-navigation__link" href="<?=$this->dir();?>/admin/logout">Wyloguj</a></li>
          </nav>
          <?php endif; ?>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title"><?=$this->siteTitle;?></span>
        <nav class="mdl-navigation">
          <?php if (!empty($this->data['tests_list'])): ?>
            <?php foreach ($this->data['tests_list'] as $key => $value): ?>
            <a class="mdl-navigation__link" href="<?=$this->dir();?>/test/<?=$value['id'];?>">
              <?=$value['title'];?>
            </a>
            <?php endforeach; ?>
          <?php endif; ?>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <div class="page-content">
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
              <h1 class="mdl-typography--display-2"><?=$this->title;?></h1>
            </div>
          </div>

          <?php if (false === $this->data['valid']): ?>
          <div class="alert alert--big alert--danger">
            Operacja nie powiodła się!
          </div>
          <?php elseif ($this->data['valid']): ?>
          <div class="alert alert--big alert--success">
            Operacja powiodła się!
          </div>
          <?php endif; ?>
