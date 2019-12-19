let $link;
function GetLink() {
    $.ajax({
        url: '/go/linkcreate',
        type: 'POST',
        dataType: 'json',
        data: {
            _token: document.getElementsByName('csrf-token')[0].getAttribute('content'),
            link: document.getElementById('link').value,

        },
        success: function (result) {
            if(result.status) {
                $('#short-link').attr('href', result.link);
                document.getElementById('link').value = "";
                document.getElementById("show-link").style.display = "block";
                $('#short-link-title').html(result.link);
                $link = result.link;
            }

        },
        error: function (error) {
            alert(error)
        }
    });
}
