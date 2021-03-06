$(() => {
    let depthChartStarters = $('#depthchart_starters');
    let depthChartRoster = $('#depthchart_bench');
    let draggableRoster = $('#rosterchart');
    let draggable = $('#draggable-player-row', draggableRoster);

    $('#save-depth-chart').on('click', (event) => {
        let depthChartData = [];

        event.preventDefault();

        $('tr', depthChart).each((index, row) => {
            row = $(row);
            depthChartData.push(row.attr('data-player-id'));
        });

        $.post(
            Routing.generate('app_teams_depth_chart_save', {'teamName': 'Chicago Bulls'}),
            {
                'depthChart': depthChartData
            },
            (response) => {
                console.log('result:' + response)
            }
        );
    });

    depthChartStarters.sortable({
        cancel: '.unsortable',
        receive: function( event, ui ) {
            console.log('receive');
            $(ui.item).remove();
        },
        over: function( event, ui ) {
            $(ui.helper).css('cursor',"move");
        },
        stop: function( event, ui ) {
            $(ui.item).css('cursor','auto');
        },
        out: function( event, ui ){
            $(ui.helper).css('cursor','no-drop');
        },
        update: function () {
            var order = depthChartStarters.sortable('serialize');
            //order later on send to the server via jquery-ajax $post
            alert(order);
        }
    });

    depthChartRoster.sortable({
        cancel: '.unsortable',
        receive: function( event, ui ) {
            $(ui.item).remove();
        },
        over: function( event, ui ) {
            $(ui.helper).css('cursor',"move");
        },
        stop: function( event, ui ) {
            $(ui.item).css('cursor','auto');
        },
        out: function( event, ui ){
            $(ui.helper).css('cursor','no-drop');
        },
        update: function () {
            var order = depthChartRoster.sortable('serialize');
        }
    });

    depthChartStarters.on('sortreceieve', function (event, ui) {
        console.log('sortreceieve');
        if($(".depthchart_starters.da").length > 5){
            $(ui.sender).sortable('cancel');
        }
    });

    depthChartRoster.on('sortreceieve', function (event, ui) {
        console.log('sortreceieve');
        if($(".depthchart_starters.da").length > 5){
            $(ui.sender).sortable('cancel');
        }
    });


    $('.dr').draggable({
        connectToSortable: "#depthchart_starters",
        helper: "clone",
        start: function(event, ui ) {
            console.log('start drag:');
            console.log(event);

            $(ui.helper).css('cursor','no-drop');
        }
    });

    $('.dr').draggable({
        connectToSortable: "#depthchart_bench",
        helper: "clone",
        start: function(event, ui ) {
            console.log('start drag:');
            console.log(event);

            $(ui.helper).css('cursor','no-drop');
        }
    });


    $('#draggable').droppable({
        accept: '.da',
        drop: function(event,ui) {
            console.log('drop');
            $(ui.draggable).remove();
        },
        over: function( event, ui ) {
            $(ui.helper).css('cursor',"alias");
        },
        out: function( event, ui ) {
            $(ui.helper).css('cursor','no-drop');
        }
    });
});