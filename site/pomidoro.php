<?php session_start();?>
<!DOCTYPE html> 
<html> 
<head> 
 <meta charset="utf-8"> 
 <title>
	Помидорковый таймер
 </title> 
<meta charset="utf-8">
 <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon">
<link href = "css/style.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width">
 <style> 
 .hide {
        display: none;
		
    }
 </style> 
</head> 
<body> 
	<div id = "allcontent">
		<div id="antifooter">
		<header>
		<div id="logo">
			<a href="/" title="Перейти на главную">TimeControl</a>
		</div>
		<div id="mainMenu" onclick="changeMainMenu()">
			<div><p>=<p></div>
		</div>
		
		
		<div id="regAuth">
		<?php if (!empty($_SESSION['auth'])){?>
			<a href="logout.php">Выйти</a>
		<?php }
		else {?>
			<a href="login.php">Войти</a>
		<?php }?>
		</div>
			</header>
			<div id="wrapper">
		<div id="leftcol">
			<div id="basistimer">
				<p>
				<div id="test"> 
				<p id="filler" style="height:0px">
				<span id="text">
				<span id="min"></span> 
				<span>:</span> 
				<span id="sec"></span>
				</span>
				</p>
				</div> 
				<input id = "pass" type="submit" value = "Пропуск" onclick="change()">
				<input type="submit" value="Старт" onclick="go()" id="go"> 
				<input type="submit" value="Стоп" onclick="stop()" id="stop" class="hide" disabled>
				<input id = "reset" type="submit" value = "Сброс" onclick="reset()">
			</div>	
		<div id="setting" style="height:40px;width:100px;">
		<div id="settingab">
		<div id ="menu" onclick="changeHeight()">Настройки</div>
		<div id ="none">
		<p>Работа:</p>
		<input class = "minus" type="button" value="&minus;" onclick="minus(0)">
			<input class="val" type="text" value="" disabled>
		<input class = "plus" type="button" value="+" onclick = "plus(0)"><br>
		<p>Короткий перерыв:</p>
		<input class = "minus" type="button" value="&minus;" onclick="minus(1)">
			<input class="val" type="text" value="" disabled>
		<input class = "plus" type="button" value="+" onclick = "plus(1)"><br>
		<p>Длинный перерыв:</p>
		<input class = "minus" type="button" value="&minus;" onclick="minus(2)">
			<input class = "val" type="text" value="" disabled>
		<input class = "plus" type="button" value="+" onclick = "plus(2)">
		</div>
	</div>
	</div>
	<p id="countpomidor"> Количество помидорок: <span id="pomidorki"><span><p>
	</div>
				<div id="rightcol">
					<div id="blockmenu">
					<ul>
						<li id="list"><a href="personalArea.php">Личный кабинет</a></li>
						<li id="list"><a href="pomidoro.php">Помидоро</a></li>
						<li id="list"><a href="notepad.php">Блокнот</a></li>
					</ul>
					</div>
				</div>
			</div>
		</div>
	<footer>
		<div id="rights">
			Все права защищены &copy; <?=date ('Y')?>
		</div>
	</footer>
	</div>
	<script src="menu.js"></script>
	<script language="javascript">
	//глобальные переменные
	

	
	var tomati=document.getElementById('pomidorki');
	
	var elem = document.getElementsByClassName('val');
	var min = document.getElementById('min');
	var sec = document.getElementById('sec'); 
	
	var varStart=0;//Для первого раза
	var pomidorki=0;
	var helpPomidor=1;
	
	var filler = document.getElementById('filler');//Для анимации 
	var additionFiller = 0;//Для анимации
	
	if(typeof getCookie('i0')!=='undefined')elem[0].value=getCookie('i0'); 
	else elem[0].value=25;//Работа
	
	if(typeof getCookie('i1')!=='undefined')elem[1].value=getCookie('i1'); 
	else elem[1].value=5;//Короткий перерыв
	
	if(typeof getCookie('i2')!=='undefined')elem[2].value=getCookie('i2'); 
	else elem[2].value=20;//Длинный перерыв
	
	if(typeof getCookie('mi')!=='undefined')min.innerHTML=getCookie('mi'); 
	else min.innerHTML=elem[0].value;//Минуты
	
	if(typeof getCookie('si')!=='undefined')sec.innerHTML=getCookie('si'); 
	else sec.innerHTML='00';//Секунды
	
	if(typeof getCookie('varStart')!=='undefined'){varStart =getCookie('varStart');}
	
	if(typeof getCookie('pomidorki')!=='undefined') {pomidorki =getCookie('pomidorki');}
	
	if(typeof getCookie('helpPomidor')!=='undefined') {helpPomidor =getCookie('helpPomidor');}
	
	if(typeof getCookie('filler')!=='undefined'){filler.style.height=getCookie('filler');}
	else filler.style.height="0px";
	
	if(typeof getCookie('additionFiller')!=='undefined'){additionFiller=getCookie('additionFiller');}
	else additionFiller=200.0/(25*60);
	
	tomati.innerHTML=pomidorki;
	//функция взятия куки по ключу
	function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
	}
  //функции убывания и возрастания при нажатии на + или -
	function minus(i)
	{
		elem[i].value=parseInt(elem[i].value)-1;
		if(varStart==0)
		{min.innerHTML=elem[0].value;}
		document.cookie = 'i'+i+'='+elem[i].value;
	}		
  
	function plus(i)
	{
		elem[i].value=parseInt(elem[i].value)+1;
		if(varStart==0)
		{min.innerHTML=elem[0].value;}
		document.cookie = 'i'+i+'='+elem[i].value;
	}
	
	//функции остановки и воспроизведения
  function go()
	{ 
		
		window.timerId = window.setInterval(timer, 1000); 
		document.getElementById('go').className="hide";
		document.getElementById('stop').className="";
		document.getElementById('go').disabled = true; 
		document.getElementById('stop').disabled = false;
		if(varStart<1)
		{varStart++;document.cookie='varStart='+varStart;
		additionFiller=200.0/(min.innerHTML*60);}
		
	} 
    function stop()
	{ 
		window.clearInterval(window.timerId); 
		document.getElementById('go').className="";
		document.getElementById('stop').className="hide";
		document.getElementById('go').disabled = false; 
		document.getElementById('stop').disabled = true; 
	} 
	//reset
	function reset()
	{
		stop();
		 filler.style.height="0px";
		if(helpPomidor % 8==0){		
			bigBreak();
	   }
	   else if(helpPomidor % 2==0){
			shotBreak();		
	   }
		else {
			timeWork();
		}
	}
	
	//функции перехода 
	function timeWork()
	{
		sec.innerHTML='0'+0;
		if(elem[0].value<10)
			min.innerHTML='0'+elem[0].value;
		else min.innerHTML=elem[0].value;
		additionFiller=200.0/(elem[0].value*60.0);
	}
	
    function shotBreak() 
   {
		sec.innerHTML='0'+0;
		if(elem[1].value<10)
			min.innerHTML='0'+elem[1].value;
		else min.innerHTML=elem[1].value;
		tomati.innerHTML=pomidorki;
		additionFiller=200.0/(elem[1].value*60.0);
   }
   
   function bigBreak()
   {
	   sec.innerHTML='0'+0;
		if(elem[2].value<10)
			min.innerHTML='0'+elem[2].value;
		else min.innerHTML=elem[2].value;
		tomati.innerHTML=pomidorki;
		additionFiller=200.0/(elem[2].value*60.0);
   }
   
   function change()
   {
	   filler.style.height="0px";
	   helpPomidor++;
	   if(helpPomidor % 8==0){	
			pomidorki++;	   
			bigBreak();
	   }
	   else if(helpPomidor % 2==0){
		    pomidorki++;
			shotBreak();		
	   }
		else {
			timeWork();
		}
		if(document.getElementById('go').disabled == true)
		{
		stop();
		go();
		}
		document.cookie='helpPomidor='+helpPomidor;
		document.cookie='pomidorki='+pomidorki;
   }
   
   //счетчик обратного отсчета
   function timer(){ 
		
    
    if(sec.innerHTML!=00) 
    { 
     if(sec.innerHTML > 10) 
      { 
       sec.innerHTML = parseInt(sec.innerHTML)-1; 
      } 
     else{ 
       
       sec.innerHTML = '0'+(parseInt(sec.innerHTML)-1); 
       
      } 
    } 
	else{ 
		if(min.innerHTML > 10) 
		{ 
			min.innerHTML = min.innerHTML-1; 
		} 
		else 
		{ 
			min.innerHTML = '0'+ (parseInt(min.innerHTML)-1); 
		} 
      sec.innerHTML=59; 
    } 
   filler.style.height=(parseFloat(filler.style.height)+parseFloat(additionFiller))+'px';
   if(min.innerHTML == '0'+(-1) ) 
   { 
		change ();
   } 
   document.title=min.innerHTML+':'+sec.innerHTML;
   document.cookie = 'mi='+min.innerHTML;
   document.cookie = 'si='+sec.innerHTML;
   document.cookie = 'filler='+filler.style.height;
   document.cookie = 'additionFiller='+additionFiller;
   console.log(additionFiller);
   console.log(filler.style.height);
  } 

	</script>
</body> 
</html>