var counter = 1;
var limit = 3;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<br><input type='text' name='Module[]' placeholder='Module "+(counter+1)+"' class='dynamic-inputs'>";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}