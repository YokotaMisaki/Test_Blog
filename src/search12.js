$("#search-icon").on('click', function () {
    var keyword = $('#keyword').val(); 
    var request = $.ajax({
        type: 'GET',
        url: '/search',   
        cache: false,
        dataType: 'json', //json形式で受け取る
    });
    /* 成功時 */
    request.done(function(data){
        alert("通信に成功しました");
    });

/* 失敗時 */
    request.fail(function(){
        alert("通信に失敗しました");
    });
});