
function checkState(e)
{
     var chkBox = document.getElementById('work');
     
     if (chkBox.checked)
     {
        // chrome.tabs.executeScript(null,{code:"document.body.style.backgroundColor='red'"});
        
          $.post("http://localhost:81/thsplitlib-master/readDictionary.php",{
          },
          function(data,status){
            console.log(data);
            $obj = JSON.parse(data);
            //console.log($obj.rudeword);
            //console.log($obj.row);
            var star= "";
            var star1= "";
            for(var j=0; j< $obj.thaiword.length; j++){
              star1 = $obj.thaiword[j];
              //console.log('chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/'+String(star1.trim())+'/g, '+String(star1.trim())+')"})');
             //console.log('chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/'+String(star.trim())+'/g,"***")"})');
            }
            for(var i=0; i< $obj.rudeword.length; i++){
                star = $obj.rudeword[i];
                var tmp = "\|" + star;
                if(i == 0 ){
                  reg = String(star);
                }else{
                  reg = reg.concat(tmp);
                }
                //console.log(star);
              
             chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/"+String(star.trim())+"/g,'***')"});
             //console.log('chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/'+String(star.trim())+'/g,"***")"})');
              }
          });
        }
     else 
     {
      chrome.tabs.executeScript(null,{code:"location.reload()"});
     }
}
        /*var rawFile = new XMLHttpRequest();
        rawFile.open("GET", "dictionary_rude.txt", false);
        rawFile.onreadystatechange = function() {
          if (rawFile.readyState == 4) {
            if(rawFile.status === 200 || rawFile.status == 0){
              var allText = rawFile.responseText;
              var str_array = allText.split('\n');
              
              var star1="แฮร่";
              var star= "";
              var reg1 = "/";
              var reg ="";
              var reg2 ="/";
             
              for(var i=0; i< str_array.length; i++){
                star = str_array[i];
                var tmp = "\|" + star;
                if(i == 0 ){
                  reg = String(star);
                }else{
                  reg = reg.concat(tmp);
                }
                //console.log(star);
             chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/"+String(star.trim())+"/g,'***')"});
           
              
             // chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/"+str_array[0]+"/g,'**')"});
              //  tmp = tmp + ".replace(/"+star+"/g,'***')";
              }
          //console.log(reg1+reg+reg2);

          //chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/"+String(reg)+"/g,'***')"});
           //console.log('chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/"'+String(reg)+'"/g,"***")"});');
           //chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/แฮร่/g,'***')"});
           //chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/INAPPROPRIATE/g,'***')"});
        // chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/"+str+"/g,'***')"});
//          chrome.tabs.executeScript(null, {file: "content_scripts.js"});





            } 
            
          } 
          //chrome.tabs.executeScript(null,document.body.innerHTML = document.body.innerHTML.replace(str_array[0], '***'));
        //  alert(str_array[0]);
        }
        rawFile.send(null);*/
       
        //chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(str_array[0], '***')"});
        //chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/inappropriate/g, '***')"});
        //chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/แฮร่/g, '**')"});
        //chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/แฮร่/g,***)"});
        //chrome.tabs.executeScript(null,{code:"document.body.innerHTML = document.body.innerHTML.replace(/ทำ/g, '**')"});

function checkState2(e){
   document.getElementById('imgButton').onClick = goToInbox();
}

document.addEventListener('DOMContentLoaded', function () {
  var divs = document.querySelectorAll('input'); 
  var myInput = document.getElementById('imgButton');

  for (var i = 0; i < divs.length; i++) {
    divs[i].addEventListener('click',checkState);
  }

  myInput.addEventListener('click',checkState2);

});

function goToInbox() {
  console.log('Going to inbox...');
  var newURL = "http://localhost:3308/thsplitlib-master/home.html";
  //var url = "127.0.0.1:3308";
  chrome.tabs.create({ url : newURL });
}



//   	chrome.tabs.getSelected(null, function(tab) {
// 	    chrome.tabs.sendRequest(tab.id, {method: "getText"}, function(response) {
// 	        if(response.method=="getText"){
// 	            alltext = response.data;
// 	            chrome.tabs.executeScript(null,{code:"alert("+alltext+")"});
// 	        }
// 	    });
// 	});

// 	chrome.tabs.getPageHtml(function(html){
// 		var page = $(html)
// 		var posts = page.find("_4ikz");
// 		for(let i in posts){
// 			let txt = posts[i].text()
// 			$.ajax({
// 				url: "www.aaaaa.com/project/chrome/did.php",
// 				data: {
// 					text: txt,
// 				},
// 				dataType: 'json',
// 				success: function(res){
// 					if(res.hide){
// 						chrome.tabs.executeScript(null,{code:"hide i"});
// 					}
// 				}
// 			});
// 		}
// 	});



//}
  // document.getElementById("work").addEventListener("click", function()
  // {
  	// chrome.storage.sync.get('varMenuSwitch', function (result) {
//     $("#work").change(function() {
//     $('#console-event').html('Toggle: ' + $(this).prop('checked'))
// })
  
// });


// chrome.storage.sync.get('varMenuSwitch', function (result) {
//     $("input:checkbox[name=onoffswitch]").prop('checked', result.varMenuSwitch == '1');
// });

 