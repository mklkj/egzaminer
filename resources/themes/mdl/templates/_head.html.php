<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$this->pageTitle;?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,500,300italic,500italic,700italic,900,300" rel="stylesheet">
    <link href="<?=$this->dir();?>/themes/mdl/css/main.css" rel="stylesheet">
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
            <a class="mdl-navigation__link" href="<?=$this->dir();?>/admin">Panel administracyjny</a>
            <a class="mdl-navigation__link" href="<?=$this->dir();?>/admin/test/add">Dodaj test</a>
            <a class="mdl-navigation__link" href="<?=$this->dir();?>/admin/logout">Wyloguj</a>
          </nav>
          <?php endif; ?>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">Egzaminy</span>
        <nav class="mdl-navigation">
          <?php if (!empty($this->data['exams_groups'])): ?>
            <?php foreach ($this->data['exams_groups'] as $key => $value): ?>
            <a class="mdl-navigation__link" href="<?=$this->dir();?>/group/<?=$value['id'];?>">
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
