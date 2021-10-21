require.config({
    baseUrl: '/storage/js/', // 默认为index.html所在的目录
    paths: {
        jquery: [
            'https://cdn.staticfile.org/jquery/3.6.0/jquery.min'
        ],
        bootstrap4: [
            "https://cdn.staticfile.org/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min"
        ],
        'jasny-bootstrap': "https://cdn.staticfile.org/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min",
    }
});
require(["jquery", 'bootstrap4', 'jasny-bootstrap'], function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("body").on("click", ".stone-clickajax", function(e){
        e.preventDefault();

        let url = $(this).attr("href");
        let method = $(this).data("method") ?? "POST";
        let msg = $(this).data("confirm") ?? "请确认";

        if(confirm(msg)){
            $.ajax({
                url: url,
                method: method,
                data: {},
                success: function(){
                    console.log("success", arguments);
                },
                error: function(response){
                    let result = response.responseJSON;
                    $.alert(result.msg);
                }
            })
        }
    });


    $(".toolkit-alert").on("click", ".alert", function(){
        $(this).fadeOut(1000);
    });

    $.extend({
        msg: function(msg, level = "info"){
            let html = `<div class="alert alert-${level}" role="alert">
                <strong>${msg}</strong>
            </div>`;
            $(html).appendTo($(".toolkit-alert"))
        },
        //TODO 替换
        alert: function(msg){
            let bool = confirm(msg);
            return Promise.resolve(bool);
        },
        //TODO 替换
        confirm: function(msg){
            let bool = confirm(msg);
            return Promise.resolve(bool);
        },
    });
});
