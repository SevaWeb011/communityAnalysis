

function analysis()
{
predloader = $("#loader");
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
      
      console.log(msg["error"]["text"]);

      if(msg["error"]!= ""){
          onError(msg)
      }
     // document.location.href = '/'
     // alert(msg);
    }
  });
}

function onError(msg)
{
  predloader = $("#loader");
  error = $("#error");
  predloader.css("visibility", "hidden");

  error.text(msg["error"]["text"]);

}