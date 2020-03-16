<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title> Главная </title>
        </head>
        <link href="/app/public/styles/dashboard.css" rel="stylesheet">
        <link href="/app/public/styles/bootstrap.css" rel="stylesheet">
        <script src="/app/public/scripts/jquery.js"></script>
        <script src="/app/public/scripts/popper.js"></script>
        <script src="/app/public/scripts/bootstrap.js"></script>
    </head>
    <body>
 <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">VK app</a>

      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#"><span data-feather="log-out"></span></a>
        </li>
      </ul>
    </nav>
  <?php if (Request::isUserToken()): ?>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="/">
                  <span data-feather="home"></span>
                  Главная <span class="sr-only"></span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="zap"></span>
                  Анализ сообщества
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="slack"></span>
                  Отчеты о сообществах
                </a>
              </li>
              
              <li class="nav-item">
                                <a class="nav-link" href="/account/logout">Выход</a>
                            </li>
            </ul>

           
          </div>
        </nav>
        <?php else: ?>
<div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="/account/login">
                  <span data-feather="home"></span>
                  Авторизация <span class="sr-only"></span>
                </a>
              </li>
            </ul>
          </div>
        </nav>

        
                        <?php endif; ?>
        <?php echo $content; ?>
        </div></div>
        <hr>

    </body>
</html>