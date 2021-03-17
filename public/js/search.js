function buttonClick() {
    // 検索キーワード取得
    var keyword = document.forms.search.keyword.value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // サーバーにあるHTMLをそのまま差し替える
            let data = document.getElementById("table");
            data.innerHTML = xhr.responseText;
            }   
    }
    xhr.open('GET','/search?keyword='+keyword, true);
    xhr.send();
}