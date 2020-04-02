
<script src="/app/public/scripts/userScripts/startAnalysis.js"></script>
<link href="/app/public/styles/userStyles/startAnalysis.css" rel="stylesheet">

    <div class="col-4"> </div>
    <div class="col-4 center-block">
      
            <h3> Начнем анализ </h3>
            <br />
            <form>
            <h5>Введите id сообщества:</h5>
            <br />
            <input type = "text" id = "idCommunity">
            <input type = "button" class="btn btn-success" onClick="analysis()" value = "Старат"> 
            </form>
            <div id = "error" class ="error"> </div>
            <div class="loader" id="loader">
            <span>Ждите...</span>
        </div>
    </div>

