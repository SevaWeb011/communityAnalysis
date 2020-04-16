<div class="row">
  <div class="col-2"> </div>
<div class="col-10"> 
      <table class="table table-bordered">
      <thead>
        <tr class="table-info">
          <th>№ Отчета</th>
          <th>Время</th>
          <th>Название группы</th>
          <th>ID группы</th>
          <th>Проверено записей</th>
        </tr>
      </thead>

      <tbody>
      <?
      if(!empty($pageData["reports"])):
        $reports = $pageData["reports"];
        $count = 0;
      foreach($reports as $report): 
        $count++;
        $link = "https://vk.com/public".$report["group_id"];
      ?>
      <tr>
          <td><?=$count?></td>
          <td><?=$report["date_analysis"]?></td>
          <td><a href="<?=$link?>"><?=$report["group_name"]?></a></td>
          <td><?=$report["group_id"]?></a></td>
          <td><?=$report["count_wall"]?></td>
        </tr>
    <?
      endforeach;
      endif;
      ?>
      </tbody>
    </table>

    </div>
</div>