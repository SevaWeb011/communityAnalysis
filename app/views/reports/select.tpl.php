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
 
<?
$groups = [];
$users = [];

if(!empty($pageData["groups"]))
    $groups = $pageData["groups"];
if(!empty($pageData["users"]))
    $users = $pageData["users"];
?>


    <div class="tab-content"> 
        <div class="tab-pane fade show active" id="groupList">


                <table class="table table-bordered">
                    <thead>
                        <tr class="table-info">
                        <th>№ Группы</th>
                        <th>Логотип</th>
                        <th>Название</th>
                        <th title = "При анализе группы формируется лист из самых активных подписчиков. У них проверяются сообщества, самые встречаемые сообщества попадают в отчет.">Кол-во пересечений*</th>
                        <th>Кол-во подписчиков</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?
                    $count = 0;
                    foreach($groups as $group):
                        $count++;
                        $photo = $group["photo"];
                        $name = $group["name"];
                        $linkGroup = "https://vk.com/public".$group["group_id"];
                        $intersections = $group["count_active_user"];
                        $subscribers = $group["count_subscriber"];
                    ?>
                    <tr>
                    <td><?=$count?></td>
                    <td><a href = <?=$linkGroup?>><img src = "<?=$photo?>"/></a></td>
                    <td><a href = <?=$linkGroup?>> <?=$name?> </a> </td>
                    <td><?=$intersections?>/100</td>
                    <td><?=$subscribers?></td>
                    </tr>
                    <?endforeach;?>
                    </tbody>
                </table>
        </div>
   


  <div class="tab-pane fade" id="activeUsers">
  <table class="table table-bordered">
                    <thead>
                        <tr class="table-info">
                        <th>№ Подписчика</th>
                        <th>ФИ</th>
                        <th>Кол-во лайков</th>
                        <th title="видно для администраторов сообщества">Кол-во репостов*</th>
                        <th>Очки рейтинга</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?
                    $count = 0;
                    foreach($users as $user):
                        $count++;
                        $id = $user["user_id"];
                        $linkUser = "https://vk.com/id".$id; 
                        $name = $user["name"];
                        $likes = $user["count_like"];
                        $reposts = $user["count_repost"];
                        $score = $user["active_score"];
                    ?>
                     <tr>
                    <td><?=$count?></td>
                    <td><a href = "<?=$linkUser?>"> <?=$name?> </a> </td>
                    <td><?=$likes?></td>
                    <td><?=$reposts?></td>
                    <td><?=$score?></td>
                    </tr>
                    <?endforeach;?>
                    </tbody>
                </table>
  </div>
</div>
</div>
</div>