$(() => {
    let depthChart = $('#depthchart');
    let depthChartData = [];

    depthChart.sortable();

    $('#save-depth-chart').on('click', (event) => {
        event.preventDefault();

        $('tr', depthChart).each((index, row) => {
            row = $(row);
            depthChartData.push(row.attr('data-player-id'));
        });

        console.log(depthChartData);
    });
});