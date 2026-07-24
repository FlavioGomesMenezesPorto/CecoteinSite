<script LANGUAGE="JavaScript">
function DataFormat(Campo, e) {
	var key = '';
	var len = 0;
	var strCheck = '0123456789';
	var aux = '';
	var whichCode = (window.Event) ? e.which : e.keyCode;
	if (whichCode == 13 || whichCode == 8 || whichCode == 0)
	{
		return true;  // Enter backspace ou FN qualquer um que não seja alfa numerico
	}
	key = String.fromCharCode(whichCode);
	if (strCheck.indexOf(key) == -1){
		return false;  //NÃO E VALIDO
	}
	aux =  Data_Remove_Format(Campo.value);
	len = aux.length;
	if(len>=8)
	{
		return false;	//impede de digitar uma data maior que 8
	}
	aux += key;
	Campo.value = Data_Mont_Format(aux);
	return false;
}

function  Data_Mont_Format(Data)
{
	var aux = len = '';
	len = Data.length;
		tmp = 4;
	aux = '';
	for(i = 0; i < len; i++)
	{
		if(i==0)
		{
			aux = '';
		}
		aux += Data.charAt(i);
		if(i+1==2)
		{
			aux += '/';
		}

		if(i+1==tmp)
		{
			aux += '/';
		}
	}
	return aux ;
}

function  Data_Remove_Format(Data)
{
	var strCheck = '0123456789';
	var len = i = aux = '';
	len = Data.length;
	for(i = 0; i < len; i++)
	{
		if (strCheck.indexOf(Data.charAt(i))!=-1)
		{
			aux += Data.charAt(i);
		}
	}
	return aux;
}
</script>
