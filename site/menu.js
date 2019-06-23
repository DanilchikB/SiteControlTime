var setting = document.getElementById('setting');
var menu = document.getElementById('menu');
var none = document.getElementById('none');
function changeHeight()
{
	if(menu.innerHTML=='Настройки')
	{
		none.className="";
		menu.innerHTML='Скрыть';
		menu.style.cssText=`
		border-radius:0 0 0 5px;
		border-top:none;
		border-right:none;
		`;
		setting.style.cssText=`
		border-radius:5px 0px 5px 5px;
		border-color:#005D85;
		`;
		setting.style.height="235px";
		setting.style.width="160px";
	}
	else{
		setTimeout(function(){none.className="hide"},50);
		setting.style.cssText=`
		border-radius:5px;
		border:2px solid silver;
		border-color:transparent;
		`;
		setting.style.height="40px";
		setting.style.width="101px";
		menu.style.cssText=`
		border-radius:5px;
		border:2px solid silver;
		border-color:#005D85;
		`;
		menu.innerHTML='Настройки';
	}
}
//главное меню
var i=0;
var rightCol=document.getElementById('rightcol');
function changeMainMenu()
{
	
	rightCol.style.cssText=`
	left:0px;
	`;
	
	console.log(i);
	
	if(i == 0){document.addEventListener('click',check);
}

}

function check(e)
{
	var id_click= e.target.id;
		console.log(id_click);
	if ((e.target.id == 'list') || (e.target.id == 'rightcol')||(e.target.id == 'blockmenu')) 
			{} 
	else if(i==0)
	{
		i++;
	}
	else {rightCol.style.cssText=`
			left:-170px;
			`;
			i--;
			document.removeEventListener('click',check);
		}
}
