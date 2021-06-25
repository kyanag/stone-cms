(function($, window, document){
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
})(jQuery,window,document);

