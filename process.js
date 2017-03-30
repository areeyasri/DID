
function checkState(e)
{
   var chkBox = document.getElementById('work');
   var init;

     if (chkBox.checked || status=="ON")
     {  
          localStorage.setItem("STATUS-SWITCH", "ON");

          chrome.tabs.executeScript(null,{code:"var x = document.body.innerText; x"},
                 function(results){
                  $.post("http://localhost:81/DID-master/run.php",{
                    text_to_segment: results[0]
                  },
                  function (data,status){
                    console.log(data);
                    $obj= JSON.parse(data);
                    if($obj.rudeword == "NOT FOUND"){
                      console.log("NOT FOUND");
                    }
                    
                    else {
                      var star ="";
                      for(var i=0; i< $obj.rudeword.length; i++){
                        star = $obj.rudeword[i];
                        chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/"+String(star.trim())+"/g,'***')"});
                        //console.log('chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/'+String(star.trim())+'/g,"***")"})');
                      }
                    }
                  });
                 }
            );
        }
     else {
          localStorage.removeItem("STATUS-SWITCH");
        //document.getElementById('inputId').removeAttribute('readonly');
        chrome.tabs.executeScript(null,{code:"location.reload()"});
     }
}
       

function checkState2(e){
   document.getElementById('imgButton').onClick = goToInbox();
}

document.addEventListener('DOMContentLoaded', function () {
  var divs = document.querySelectorAll('input'); 
  var myInput = document.getElementById('imgButton');

   var chkBox = document.getElementById('work');
  for (var i = 0; i < divs.length; i++) {
         var state = localStorage.getItem("STATUS-SWITCH");
         if(state == "ON"){
               chkBox.checked = true;
               window.addEventListener('load',checkState);
               divs[i].addEventListener('onload',checkState);
               divs[i].addEventListener('click',checkState);
               chrome.contentSettings.plugins
         }else{
               divs[i].addEventListener('click',checkState);
               window.addEventListener('load',checkState);
         }
     
  }

  myInput.addEventListener('click',checkState2);

}, true);

function goToInbox() {
  console.log('Going to inbox...');
  var newURL = "http://localhost:81/DID-master/index.php";
  //var url = "127.0.0.1:3308";
  chrome.tabs.create({ url : newURL });
}

 