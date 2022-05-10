<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redis</title>
</head>
<body>
<div style="font-size: 15px; color: darkblue; margin-bottom: 10px">
    ps/ при клике на кнопку "вывести" и не заполненном input выведется весь массив Redis
</div>
<input type="text" id="get-value-by-id" placeholder="получить value по ключу">
<button type="button" id="show">Вывести</button>
<ul id="list"></ul>
</body>
</html>
<script>
    const dropValue = (e) => {
        const key = e.getAttribute('data');
        const parent = e.parentElement;
        deleteByKey(key, parent);
    }
    const deleteByKey = async (key, parent) => {
        const url = '/api/redis';
        try {
            let response = await fetch(url + "/" + key, {method: 'DELETE'})
            if (response.ok) {
                let data = await response.json();
                parent.remove()
                console.log(data)
            }
        } catch (error) {
            console.log(error);
        }
    }
    const getAll = async () => {
        const ul = document.getElementById("list");
        const url = '/api/redis';
        ul.innerText = '';
        try {
            let response = await fetch(url);
            if (response.ok) {
                let data = await response.json();
                console.log(data['data'])
                if (data['data'].length == 0){
                    html = `<li style="color: red">нет записей</li>`
                    ul.innerHTML += html;
                }
                for (const key in data['data']) {
                    html = `<li>${key}: ${data['data'][key]} <a onclick="dropValue(this)" data=${key} lass=‘remove’ style="cursor: pointer; color: blueviolet; text-decoration: underline">delete</a></li>`
                    ul.innerHTML += html;
                }
            }
        } catch (error) {
            console.log(error);
        }
    }
    const getValueById = async (key) => {
        const ul = document.getElementById("list");
        const url = '/api/redis';
        const formData = new FormData();
        formData.append('key', key);
        try {
            let response = await fetch(url, {method: 'POST', body: formData})
            if (response.ok) {
                let data = await response.json();
                console.log(data)
                html = `<li>${key}: ${data['data'][key]} <a onclick="dropValue(this)" data=${key} class=‘remove’ style="cursor: pointer; color: blueviolet; text-decoration: underline">delete</a></li>`
                ul.innerHTML += html;
            }
        } catch (error) {
            console.log(error);
        }
    }
    document.getElementById("show").onclick = () => {
        getvaluebyid = document.getElementById("get-value-by-id");
        if (getvaluebyid.value) getValueById(getvaluebyid.value)
        else getAll()
    }

</script>

