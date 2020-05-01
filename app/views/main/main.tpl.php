<div class="row">
<div class="col-5"> </div>
    <div class="col-5 center-block">
<h3> Приветствую Вас, <?=$pageData["user_name"]?>! </h3>
</div>
</div>
<br />
<div class="row">
<div class="col-2"> </div>
<div class = "col-10"> 
<span style = "font-size: 1.2em">
<b style="color:#00BFFF"> VK loupe </b> - надежный помощник в анализе сообществ (работает в тестовом режиме). 
Вы вводите ID сообщества и получаете статистическую информацию. 
Все результаты анализов сохраняются в <a href="/reports/all">Отчетах</a>.
<br />
<br />
Приложение помогает находить сообщества, аудитория которых пересекается с активной аудиторией анализируемых сообществ.
<br />
<br />
Для чего это нужно? Инструмент может быть полезен для рекламы или для поиска сообществ по вашим увлечениям.
<br/>
<br/>
<?if(!User::isUserToken()):?>
<h4><a href="/account/login"> Авторизоваться через vk-></a></h4>
<br />
<?endif;?>
<h4><a href="/calculation/start"> Начать анализ-></a></h4>
<br />
<img src="/app/public/images/analysis.png" style="margin:auto;width:80%; height:60%; display:block;"/>
</span>
</div>
</div>