<link href="/app/public/styles/userStyles/selectReports.css" rel="stylesheet">
<div class="row">
    <div class="col-2"> </div>
        <div class="col-10"> 
            <ul class="nav nav-tabs">
                <!-- Первая вкладка (активная) -->
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#groupList">Список сообществ</a>
                </li>
                <!-- Вторая вкладка -->
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#activeUsers">Активные подписчики</a>
                </li>
            </ul>
 



    <div class="tab-content"> 
        <div class="tab-pane fade show active" id="groupList">


                <table class="table table-bordered">
                    <thead>
                        <tr class="table-success">
                        <th>№ Группы</th>
                        <th>Логотип</th>
                        <th>Название</th>
                        <th>ID</th>
                        <th title = "При анализе группы формируется лист из самых активных подписчиков. У них проверяются сообщества, самые встречаемые сообщества попадают в отчет.">Кол-во пересечений*</th>
                        <th>Кол-во подписчиков</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
        </div>
   


  <div class="tab-pane fade" id="activeUsers">
  <table class="table table-bordered">
                    <thead>
                        <tr class="table-info">
                        <th>№ Подписчика</th>
                        <th>ФИ</th>
                        <th>ID</th>
                        <th>Кол-во лайков</th>
                        <th title="видно для администраторов сообщества">Кол-во репостов*</th>
                        <th>Очки рейтинга</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
  </div>
</div>
</div>
</div>