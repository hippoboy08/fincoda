var minimumScale = 0.5;
function createChart(chartArea, labelArr, dataLabelStr, dataArr, bgColor) {
    var labelArrLength = labelArr.length;
    var bgColorArr = [];
    for (var index = 0; index <= labelArrLength; index++) {
        bgColorArr.push(bgColor);
    }
    return new Chart(chartArea, {
        type: 'bar',
        data: {
            labels: labelArr,
            datasets: [{
                label: dataLabelStr,
                data: dataArr,
                backgroundColor: bgColorArr,
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                      min: minimumScale,
                      stepSize: 0.5
                    }
                }]
            }
        }
    });
};

function createComparedChart(chartArea, labelArr, dataset1, dataset2) {

    return new Chart(chartArea, {
        type: 'bar',
        data: {
            labels: labelArr,
            datasets: [dataset1, dataset2]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                      min: minimumScale,
                      stepSize: 0.5
                    }
                }]
            }
        }
    });
};

function createMaxMinChart(chartArea, labelArr, dataset1, dataset2, dataset3) {

    return new Chart(chartArea, {
        type: 'bar',
        data: {
            labels: labelArr,
            datasets: [dataset1, dataset2, dataset3]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                      min: minimumScale,
                      stepSize: 0.5
                    }
                }]
            }
        }
    });
};

console.log('been here');
