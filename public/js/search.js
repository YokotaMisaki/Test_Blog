function buttonClick() {
    const table = document.querySelector('#table').innerHTML = '';
    const textbox = document.forms.search.keyword.value;
    if (!textbox) {
        return false;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/search', true);
    xhr.responseType = 'json';
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            (function (data) {
                console.log(data)
                data.forEach(function (value) {
                    let id = value.id;
                    let title = value.title;
                    let updated_at = value.updated_at;
                    table.innerhtml = `
                        <tr>
                        <td>${id}</td>
                        <td><a href="/blog/${id}">${title}</a></td>
                        <td>${updated_at}</td>
                        </tr>
                        `;
                });
            }); elseif(data === 0)
            table.innerhtml = `<p>検索結果がありません</p>`;
            } else {
            alert("通信に失敗しました");
                   }
            }
};