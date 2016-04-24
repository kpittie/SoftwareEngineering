var counter = 1;
var lastdiv = counter+1;
var limit = 5;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<br><input type='text' pattern='^[a-zA-Z0-9\\\s]{1,100}$' required='required' name='Modules[]' placeholder='Module "+(counter+1)+"' class='dynamic-inputs'>";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}

function deleteInput(){
	if(counter>1)
	{
		lastdiv = counter+1;
		document.getElementById('dynamicInput').removeChild(document.getElementById('dynamicInput').children[lastdiv]);
		counter--;
		lastdiv--;
	}
}