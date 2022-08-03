
$('[optn]').on('click', function (e) {
    e.stopPropagation();

    if ($(this).parent().attr('v') === "-1")
    {
        alert("Login to cast your vote");
    }
    else
    {
        if ($(this).parent().attr('status') == "open") {
            if ($(this).parent().attr('v') === "0") {
                $(this).siblings().removeClass('border border-success');
                $(this).siblings().find('.pVote , #vCom').hide();
                $(this).siblings().find('.poVotes , #pCent').show();
    
                $(this).addClass('border border-success');
                $(this).find('.poVotes , #pCent').hide();
                $(this).find('.pVote , #vCom').show();
            }
            else {
                alert('You have already voted for this poll [1]');
            }
        }
        else {
            alert('This poll is closed');
        }
    }
    
});

$('.pVote').on('click', function (e) {
    e.stopPropagation();

    if ($("#user").attr('status') == 'in') {

        const ths = $(this);
        const pollr = $(this).parentsUntil('[poll]').parent();
        const thsopt = ths.parentsUntil('[optn]').parent();

        if (pollr.attr('v') === "0") {
            const optn = $(this).parentsUntil('[optn]').parent().attr('optn');
            $.post('/vote/' + pollr.attr('poll'), { 
                optn: optn, 
                comments: $(this).siblings('#vCom').val(),
                _token: $('input[name=_token]').val() 
            }, function (res) {
                let r = JSON.parse(res);
                if (r.status != 'SessionExpire') {
                    if (r.status == 'success') {
                        pollr.attr('v', '1');
                        ths.text(' ✓ ');
                        thsopt.find('#vCom').prop('disabled',true).addClass('text-white');
                        thsopt.find(".poVotes").text(thsopt.find(".poVotes").text().replace(/(\d)+/,function(match,v){return parseInt(v)+1}));
                        
                        $.get('/getpoll/'+ pollr.attr('poll') +'/comments',function(res){
                            $('#viewCom').replaceWith(res);
                        });

                        setTimeout(function(thsopt){ 
                            thsopt.find('#vCom,.pVote').hide();
                            thsopt.find('#pCent,.poVotes').show();
                            $.get('/getpoll/'+ pollr.attr('poll') +'/options',function(res){
                                $('[poll]').replaceWith(res);
                            });
                         },1500,thsopt);
                        
                        
                    }
                    else if (r.status == 'failure') {
                        if (r.error=='ReVote')
                        {
                            alert('You have already voted for this poll [3]');
                        }
                        else
                        {
                            alert('Sign in with Google before voting');
                        }
                    }
                }
                else {
                    alert('SessionExpire');
                }
            });
        }
        else {
            alert('You have already voted for this poll [5]');
        }
    }
    else {
        alert('Sign in with Google before voting');
    }
});

$('[poll]').parent().on('click', function () {

    let optns = $(this).find('[optn].border-success');
    optns.removeClass('border border-success');
    optns.find('.pVote , #vCom').hide();
    optns.find('.poVotes , #pCent').show();

});

function onsig(res) {

    const user = JSON.parse(atob(res.credential.split('.')[1]));
    $('body #signin').hide();
    $('#user').text(user.name);
    $('#user').attr('status', 'in').show();
    console.log(res);
    $.post("/signin", { 
            creden: res.credential,
            _token: $('input[name=_token]').val() 
        }, function (result) {
        console.log("signin result : " + result);
        location.reload();
    });

}

$("form#add input#binds , form#add input#options").on('input', function () {
    binds();
});

function binds() {
    let binds = $("form#add input#binds").val().split(',');
    let options = [];
    let bindsFill = "<div class='w-100 p-2 bg-light fw-bold mb-3'>Option Binding</div>";
    $.each($("form#add input#options").val().split(','), function (ind, op) {
        options.push(op.split(':')[0]);
    });

    $.each(binds, function (ind, bind) {
        bindsFill += "<fieldset class='w-100 p-3 bg-white rounded border mb-3'><div class='fw-bold'>" + (ind+1) + ". " + bind + "</div><div class='ms-3 me-auto'>";
        
        $.each(options,function(inde,op){
            bindsFill +=
            `<div class="form-check m-3">
                <input class="form-check-input" type="radio" name="`+ ind +`" id="`+ ind +"."+ inde +`" value="`+ ind +"."+ inde +`">
                <label class="form-check-label w-100 text-truncate" for="`+ ind +"."+ inde +`">`+ op +`</label>
            </div>`;
        });

        bindsFill += "</fieldset></div>";

    });

    $('form#add div#binds').html(bindsFill);
}

$('[follow]').on('click',function(){

    let ths = $(this);

    if (ths.attr('follow')==='true')
    {
        ths.text('Unfollow');
        ths.removeClass('bg-success text-white').addClass('bg-white text-muted');
    }
    else
    {
        ths.text('Follow');
        ths.addClass('bg-success text-white').removeClass('bg-white text-muted');
    }

    $.post('/follow',
          {
            follow:ths.attr('follow'),
            user:ths.parent().parent().attr('uid'),
            _token: $('input[name=_token]').val() 
          },function(res){

            let r = JSON.parse(res);
            if (r.status=='success')
            {
                ths.attr('follow',(ths.attr('follow')=='true')?'false':'true');
            }

            setTimeout((ths) => {
                $.post('/viewFoll/' + ths.parent().parent().attr('uid'),
                {_token: $('input[name=_token]').val()},function(res){
                    $('#viewFoll').html(res);
                });
            },500,ths);
    });

});


if (navigator.share) { $('#share').show();$('[share]').parent().show(); }
$('#share,[share]').on('click',function(e){
    e.stopPropagation();
    e.preventDefault();
        if (navigator.share) {
          navigator.share({
            title: 'Opiniate - Share this ' + (($(this).attr('id')=="share")?((/profile/.test(location.href))?"Profile":"Poll"):"Opinion"),
            url: (($(this).attr('id')=="share")?location.href:$(this).attr('share'))
          }).then(() => {
            console.log('Thanks for sharing!');
          })
          .catch(console.error);
        } else {
          // fallback
        }
});