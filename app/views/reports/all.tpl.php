<div class="row">
  <div class="col-2"> </div>
<div class="col-10"> 
      <table class="table table-bordered align-middle">
      <thead>
        <tr class="table-info">
          <th>№ Отчета</th>
          <th>Время</th>
          <th>Группа</th>
          <th>Проверено записей</th>
          <th>Подробности</th>
        </tr>
      </thead>

      <tbody>
      <?
      if(!empty($pageData["reports"])):
        $reports = $pageData["reports"];
        $count = 0;
      foreach($reports as $key=>$report): 
        $count++;
        $linkPublic = "https://vk.com/public".$report["group_id"];
        $id = $key;
        $linkReport = "/reports/select"
      ?>
      <tr>
          <td><?=$count?></td>
          <td><?=$report["date_analysis"]?></td>
          <td><a href="<?=$linkPublic?>"><?=$report["group_name"]?></a></td>
          <td><?=$report["count_wall"]?></td>
          <form type="POST" action = "/reports/select/">
          <input type="hidden" name = "reportID" value = <?=$id?>>
          <td><a href="#" style="color:green;" onClick = "redirectSelect(<?=$id?>)" ><b><u>перейти</u></b></a></td>
          </form>
        </tr>
    <?
      endforeach;
      endif;
      ?>
      </tbody>
    </table>

    </div>
</div>
<script>
function redirectSelect(report)
{
  var f = document.createElement("form");
  f.setAttribute('method',"post");
  f.setAttribute('action',"/reports/select");
 
  var i = document.createElement("input");
  i.setAttribute('type',"text");
  i.setAttribute('name',"report");
  i.value = report;
 
  f.appendChild(i);
  document.body.appendChild(f);
  f.submit();
}
  </script>