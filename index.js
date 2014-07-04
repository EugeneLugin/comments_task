// сохранение формы в URI строку
function serialize_form(obj) {
	var elements = obj.elements; // элементы формы
	var resURI = '';
	n = elements.length - 1;
	for (var i = 0; i <= n; i++) {		
		if (elements[i].type != 'submit') { // кнопку "отправить" не обрабатываем
			resURI += (i>0 ? '&' : '')+encodeURIComponent(elements[i].name)+'='+
									   encodeURIComponent(elements[i].value.trim());
		}
	}
	return resURI;
}

// отправка формы ajax запросом
function submit_remote(obj) {
	var submit_button = obj.elements[obj.elements.length-1];	
	submit_button.disabled = true; submit_button.value='публикуется...';

	var form = serialize_form(obj)+'&form_id='+obj.id; // отправляем поля формы и её id
	
	var xhr = new XMLHttpRequest();
	xhr.open(obj.method, obj.action, true); // метод и действие - из параметров формы
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')		
	xhr.onreadystatechange = function() { // обработка результатов запроса
		if(xhr.readyState == 4) { // запрос завершен
			if (xhr.status == 200) { // запрос успешен
				// костыль для хостинга - убираем рекламу
				response = xhr.responseText.substr(0,xhr.responseText.indexOf('<!--'));
				eval(response); // выполняем полученный код
			}
		}
    };
	xhr.send(form); // выполняем запрос
	
	return false; // форму не отправляем
}