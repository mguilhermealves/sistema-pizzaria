$("#votar").click(function(){
    var slug = $(this).data('selfiepet');
    $.get('https://www.cloudflare.com/cdn-cgi/trace', function(data) {   
        data = data.trim().split('\n').reduce(function(obj, pair) {
        pair = pair.split('=');
        return obj[pair[0]] = pair[1], obj;
        }, {});         

        $.ajax({
            method: "POST",
            url: '/voteselfiepet',
            data: {
                ip: data.ip, 
                selfiepet: slug
            },
            beforeSend: function() {
                $("#votar").empty();
                $("#votar").prepend('<div class="spinner-border"></div>');                
            },
            success: function(data) {

                var result = JSON.parse(data);
              
                if(result.erro == false){
                    $("#votar").empty();
                    $("#votar").prepend(result.message);
                    $("#votar").addClass('votado');

                    location.reload();

                }
                
            }
        });
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imagePreview img')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}