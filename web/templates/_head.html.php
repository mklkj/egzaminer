<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>tester</title>
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./">Tester</a>
        </div>

        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-left">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="https://github.com/mklkj/tester">View project on GitHub</a></li>
              </ul>
            </li>
          </ul>
          <?php if (!empty($tests)): ?> 
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Testy <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <?php foreach ($tests as $key => $value): ?> 
                <li><a href="./?test=<?=$value['id'];?>"><?=$value['title'];?></a></li>
              <?php endforeach; ?> 
              </ul>
            </li>
          </ul>
          <?php endif;?> 
        </div>
      </div>
    </nav>
    <section class="container">
