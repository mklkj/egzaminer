<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Egzaminer</title>
    <link rel="stylesheet" href="<?=$this->dir();?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
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
          <a class="navbar-brand" href="<?=$this->dir();?>/">Egzaminer</a>
        </div>

        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-left">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="https://github.com/mklkj/egzaminer">View project on GitHub</a></li>
              </ul>
            </li>
          </ul>
          <?php if (!empty($this->data['tests_list'])): ?> 
          <ul class="nav navbar-nav navbar-right">
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
        </div>
      </div>
    </nav>
    <section class="container">
