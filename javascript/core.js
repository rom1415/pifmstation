// Initialize knob button
$(".dial").knob({
    "step":0.1,
    "skin":"tron",
    "cursor":true,
    "thickness": 0.15,
    "displayInput":false,
    "fgColor":"black",
    "angleOffset":271,
    "angleArc":180,
    "change": function(value){
        $('.mhz').text(value.toFixed(1) + ' Mhz');
    }
});

$('.dial').val(27).trigger('change');

$('.options').hide();

startPlaying();

// Bootstrap switch init
$switch = $("[name='my-checkbox']");

$('#pause').hide();

$("[name='my-checkbox']").bootstrapSwitch({
    size: 'large',
    offColor: 'danger',
    onColor: 'success',
    readonly: false,
    labelText: 'PiFM'
});

// Music player events
$('.fa-step-forward').click(function(event){
    $.ajax({
        type:'POST',
        url: 'actions/next.php',
        success: function(){
            noty({
                text: 'Next track<br><br><br>',
                layout: 'bottom',
                timeout: 2500,
                type:'information'
            });
            next();
        }
    });
});

$('.fa-stop').click(function(event){
    $("[name='my-checkbox']").bootstrapSwitch('state', false);
    noty({
        text: 'Stop PiFM<br><br><br>',
        layout: 'bottom',
        timeout: 2500,
        type:'information'
    });
});


$('#pause').click(function(event){
    $.ajax({
        type:'POST',
        url: 'actions/pause.php',
        success: function()
        {
            $('#pause').hide();
            $('#play').show();
            noty({
                text: 'Pause<br><br><br>',
                layout: 'bottom',
                timeout: 2500,
                type:'information'
            });
        }
    });
});

$('#play').click(function(event){
    $.ajax({
        type:'POST',
        url: 'actions/resume.php',
        success: function(){
            $('#play').hide();
            $('#pause').show();
            noty({
                text: 'Resume<br><br><br>',
                layout: 'bottom',
                timeout: 2500,
                type:'information'
            });
        }
    });
});

$('#play_all').click(function(event){
    $.ajax({
        type:'POST',
        url: 'actions/start.php',
        data: 'frequency=' + $('#frequency').val()
    });
    noty({
        text: 'Play all songs<br><br><br>',
        layout: 'bottom',
        timeout: 2500,
        type:'information'
    });
});

$('.song').click(function(event){
    var song = $(this).text();
    $.ajax({
        type:'POST',
        url: 'actions/play.php',
        data: 'file=' + song + '&frequency=' + $('#frequency').val()
    });

    $('table').find('td.highlight').removeClass('highlight');
    $(this).addClass('highlight');

    noty({
        text: 'Now Playing "'+ song +'"<br><br><br>',
        layout: 'bottom',
        timeout: 2500,
        type:'information'
    });
});

// Bootstrap switch event
$('input[name="my-checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {

    // Make ajax call for switching on and off the radio
    if(state){
        $.ajax({
            type:'POST',
            url: 'actions/start.php',
            data: 'frequency=' + $('#frequency').val(),
            success: function()
            {
                $('#play').hide();
                $('#pause').show();
            }
        });
        $('.options').fadeIn();

    } else {
        $.ajax({
            type:'POST',
            url: 'actions/stop.php',
            success: function(){
                $('#pause').hide();
                $('#play').show();
            }
        });
        $('.options').fadeOut();
    }
});

// Highlighting table functions

currentSong = $('.song.highlight');

// Start highlighing playing on the playlist table
function startPlaying()
{
    clear();
    currentSong = $(".song").first();
    currentSong.addClass('highlight');
}

// Clear playlist highlighting
function clear()
{
    $('table').find('td.highlight').removeClass('highlight');
}

// Highlight next track of the playlist
function next()
{
    clear();
    currentSong = currentSong.closest('tr').next().find('.song');
    currentSong.addClass('highlight');
}
