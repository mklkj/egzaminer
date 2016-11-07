<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$this->pageTitle;?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
      .alert h2 {
        margin-top: 5px;
      }
      label {
        font-weight: normal;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=$this->dir();?>/"><?=$this->siteTitle;?></a>
        </div>

        <div class="collapse navbar-collapse">
          <?php if (!empty($this->data['tests_list'])): ?> 
          <ul class="nav navbar-nav navbar-left">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Testy <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <?php foreach ($this->data['tests_list'] as $key => $value): ?> 
                <li><a href="<?=$this->dir();?>/test/<?=$value['id'];?>"><?=$value['title'];?></a></li>
              <?php endforeach; ?> 
              </ul>
            </li>
          </ul>
          <?php endif;?> 
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="https://github.com/mklkj/egzaminer">View project on GitHub</a></li>
              </ul>
            </li>
            <?php if ($this->isLogged()): ?> 
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Witaj, adminie <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?=$this->dir();?>/admin">Panel administracyjny</a></li>
                <li><a href="<?=$this->dir();?>/admin/test/add">Dodaj test</a></li>
                <li><a href="<?=$this->dir();?>/admin/logout">Wyloguj</a></li>
              </ul>
            </li>
            <?php endif ?> 
          </ul>
        </div>
      </div>
    </nav>
    <section class="container">
      <div class="page-header">
        <h1><?=$this->title;?></h1>
      </div>

      <?php if (false === $this->data['valid']): ?> 
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Operacja nie powiodła się!
      </div>
      <?php elseif ($this->data['valid']): ?> 
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Operacja powiodła się!
      </div>
      <?php endif; ?> 