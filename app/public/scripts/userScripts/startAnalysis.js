

function analysis()
{
predloader = $("#loader");
console.log(predloader);
error = $("#error");
inputField = $("#idCommunity").val();
error.empty()
predloader.css("visibility", "visible");

$.ajax({
    type: "POST",
    url: "/calculation/analysis",
    dataType: 'json',
    data: {
        idCommunity: inputField,
    },
    success: function(msg){

      if(!isEmpty(msg["error"])){
          onError(msg)
      }
      if(!isEmpty(msg["report"]))
      {
        redirect(["report"]);
      }
     
     // document.location.href = '/'
     // alert(msg);
    }
  });
}

function onError(msg)
{
  console.log(msg["error"]);
  predloader = $("#loader");
  error = $("#error");
  predloader.css("visibility", "hidden");

  error.text(msg["error"]["text"]);

}


function isEmpty(str)
{
  if (str != null && typeof str !== "undefined") 
    return false;
  else
    return true;
 
}

function redirect(report)
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