$(() => {
    let depthChart = $('#depthchart');
    let draggableRoster = $('#rosterchart');
    let draggable = $('#draggable-player-row', draggableRoster);

    console.log(draggableRoster.find('#draggable'));

    depthChart.sortable({
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
            var order = depthChart.sortable('serialize');
            //order later on send to the server via jquery-ajax $post
            alert(order);
        }
    });

    draggable.draggable({
        connectToSortable: "#depthchart",
        helper: "clone",
        start: function( event, ui ){
            $(ui.helper).css('cursor','no-drop');
        }
    });

    draggableRoster.droppable({
        accept: "#player-row",
        drop: function(event,ui) {
            $(ui.draggable).remove();
        },
        over: function( event, ui ) {
            $(ui.helper).css('cursor',"alias");
        },
        out: function( event, ui ){
            $(ui.helper).css('cursor','no-drop');
        }
    });

    $('#save-depth-chart').on('click', (event) => {
        let depthChartData = [];

        event.preventDefault();

        $('tr', depthChart).each((index, row) => {
            row = $(row);
            depthChartData.push(row.attr('data-player-id'));
        });

        $.post(
            Routing.generate('app_teams_depth_chart_save', {'teamName': 'Chicago Bulls'}),
            {'depthChart': depthChartData},
            (response) => {
                console.log('result:' + response)
            }
        );
    });

    $( "#sortable" ).sortable({
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
            var order = $('#sortable').sortable('serialize');
            //order later on send to the server via jquery-ajax $post
            alert(order);
        }
    });


    $( ".dr" ).draggable({
        connectToSortable: "#sortable",
        helper: "clone",
        start: function( event, ui ){
            $(ui.helper).css('cursor','no-drop');
        }
    });


    $( "#draggable" ).droppable({
        accept: ".da",
        drop: function(event,ui) {
            $(ui.draggable).remove();
        },
        over: function( event, ui ) {
            $(ui.helper).css('cursor',"alias");
        },
        out: function( event, ui ){
            $(ui.helper).css('cursor','no-drop');
        }
    });
});