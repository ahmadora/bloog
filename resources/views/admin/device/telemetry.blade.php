@extends('layouts.layouts')

@section('content')
    <div id="chart" style="height:400px;width: 100%"> </div>
@endsection

@section('scripts')
{{--    <script>--}}
{{--        const cpu = {--}}
{{--            sourceKey: 'cpu',--}}
{{--            data: [],--}}
{{--        };--}}
{{--        const ram = {--}}
{{--            sourceKey: 'ram',--}}
{{--            data: [],--}}
{{--        };--}}
{{--        const temperature = {--}}
{{--            sourceKey: 'temperature',--}}
{{--            data: [],--}}
{{--        }--}}
{{--        let dataset;--}}
{{--        const totalPoints = 100;--}}
{{--        const updateInterval = 500;--}}

{{--        let temp;--}}

{{--        function update(_data) {--}}
{{--            [cpu, ram, temperature].forEach(source => {--}}
{{--                if (source.data.length === totalPoints) {--}}
{{--                    source.data.shift();--}}
{{--                }--}}
{{--                const fetchedData = _data[source.sourceKey][0];--}}
{{--                source.data.push([fetchedData.ts, fetchedData.value]);--}}
{{--            });--}}

{{--            console.log(cpu, ram, temperature);--}}

{{--            //update legend label so users can see the latest value in the legend--}}
{{--            dataset = [--}}
{{--                {--}}
{{--                    label: "CPU:" + _data[cpu.sourceKey][0].value + "%",--}}
{{--                    data: cpu.data,--}}
{{--                    line: {--}}
{{--                        fill: false,--}}
{{--                        lineWidth: 1.0,--}}
{{--                    },--}}
{{--                    color: "#00FF00",--}}
{{--                },--}}
{{--                {--}}
{{--                    label: "RAM:" + _data[ram.sourceKey][0].value + "KB",--}}
{{--                    data: ram.data,--}}
{{--                    line: {--}}
{{--                        fill: false,--}}
{{--                        lineWidth: 1.0,--}}
{{--                    },--}}
{{--                    color: "#0044FF",--}}
{{--                },--}}
{{--                {--}}
{{--                    label: "Temperature:" + _data[temperature.sourceKey][0].value + "C",--}}
{{--                    data: temperature.data,--}}
{{--                    line: {--}}
{{--                        fill: false,--}}
{{--                        lineWidth: 1.0,--}}
{{--                    },--}}
{{--                    color: "#FF0000",--}}
{{--                }--}}
{{--            ];--}}
{{--            $.plot($("#chart"), dataset, {--}}
{{--                type: 'line',--}}
{{--                data:dataset ,--}}
{{--                options: {--}}
{{--                    tooltips: {--}}
{{--                        mode: 'point'--}}
{{--                    }--}}
{{--                }--}}

{{--            });--}}
{{--        }--}}

{{--        function getData() {--}}
{{--            //set no cache--}}
{{--            $.ajaxSetup({cache: false});--}}

{{--            $.ajax({--}}
{{--                url: "{{ route('telemetryData', $id) }}",--}}
{{--                dataType: 'json',--}}
{{--                success: update,  //if success, call update()--}}
{{--                error: start,--}}
{{--            });--}}
{{--        }--}}

{{--        function start() {--}}
{{--            setInterval(getData, updateInterval);--}}
{{--        }--}}

{{--        $(document).ready(() => {--}}
{{--            start();--}}
{{--        });--}}
{{--    </script>--}}

    <script>
//         am4core.ready(function() {
//
// // Themes begin
//             am4core.useTheme(am4themes_animated);
// // Themes end
//
// // Create chart instance
//             var chart = am4core.create("chart", am4charts.XYChart);
//
// //
//
// // Increase contrast by taking evey second color
//             chart.colors.step = 2;
//
// // Add data
//             chart.data = generateChartData();
//
// // Create axes
//             var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
//             dateAxis.renderer.minGridDistance = 50;
//
// // Create series
//             function createAxisAndSeries(field, name, opposite, bullet) {
//                 var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
//                 if(chart.yAxes.indexOf(valueAxis) != 0){
//                     valueAxis.syncWithAxis = chart.yAxes.getIndex(0);
//                 }
//
//                 var series = chart.series.push(new am4charts.LineSeries());
//                 series.dataFields.valueY = field;
//                 series.dataFields.dateX = "date";
//                 series.strokeWidth = 2;
//                 series.yAxis = valueAxis;
//                 series.name = name;
//                 series.tooltipText = "{name}: [bold]{valueY}[/]";
//                 series.tensionX = 0.8;
//                 series.showOnInit = true;
//
//                 var interfaceColors = new am4core.InterfaceColorSet();
//
//                 switch(bullet) {
//                     case "triangle":
//                         var bullet = series.bullets.push(new am4charts.Bullet());
//                         bullet.width = 12;
//                         bullet.height = 12;
//                         bullet.horizontalCenter = "middle";
//                         bullet.verticalCenter = "middle";
//
//                         var triangle = bullet.createChild(am4core.Triangle);
//                         triangle.stroke = interfaceColors.getFor("background");
//                         triangle.strokeWidth = 2;
//                         triangle.direction = "top";
//                         triangle.width = 12;
//                         triangle.height = 12;
//                         break;
//                     case "rectangle":
//                         var bullet = series.bullets.push(new am4charts.Bullet());
//                         bullet.width = 10;
//                         bullet.height = 10;
//                         bullet.horizontalCenter = "middle";
//                         bullet.verticalCenter = "middle";
//
//                         var rectangle = bullet.createChild(am4core.Rectangle);
//                         rectangle.stroke = interfaceColors.getFor("background");
//                         rectangle.strokeWidth = 2;
//                         rectangle.width = 10;
//                         rectangle.height = 10;
//                         break;
//                     default:
//                         var bullet = series.bullets.push(new am4charts.CircleBullet());
//                         bullet.circle.stroke = interfaceColors.getFor("background");
//                         bullet.circle.strokeWidth = 2;
//                         break;
//                 }
//
//                 valueAxis.renderer.line.strokeOpacity = 1;
//                 valueAxis.renderer.line.strokeWidth = 2;
//                 valueAxis.renderer.line.stroke = series.stroke;
//                 valueAxis.renderer.labels.template.fill = series.stroke;
//                 valueAxis.renderer.opposite = opposite;
//             }
//
//             createAxisAndSeries("visits", "Visits", false, "circle");
//             createAxisAndSeries("views", "Views", true, "triangle");
//             createAxisAndSeries("hits", "Hits", true, "rectangle");
//
// // Add legend
//             chart.legend = new am4charts.Legend();
//
// // Add cursor
//             chart.cursor = new am4charts.XYCursor();
//
// // generate some random data, quite different range
//             function generateChartData() {
//                 var chartData = [];
//                 var firstDate = new Date();
//                 firstDate.setDate(firstDate.getDate() - 100);
//                 firstDate.setHours(0, 0, 0, 0);
//
//                 var visits = 1600;
//                 var hits = 2900;
//                 var views = 8700;
//
//                 for (var i = 0; i < 15; i++) {
//                     // we create date objects here. In your data, you can have date strings
//                     // and then set format of your dates using chart.dataDateFormat property,
//                     // however when possible, use date objects, as this will speed up chart rendering.
//                     var newDate = new Date(firstDate);
//                     newDate.setDate(newDate.getDate() + i);
//
//                     visits += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
//                     hits += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
//                     views += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
//
//                     chartData.push({
//                         date: newDate,
//                         visits: visits,
//                         hits: hits,
//                         views: views
//                     });
//                 }
//                 return chartData;
//             }
//
//         }); // end am4core.ready()

        am4core.ready(() => {
            am4core.useTheme(am4themes_animated);

            const chart = am4core.create("chart", am4charts.XYChart);
            chart.hiddenState.properties.opacity = 0;
            chart.padding(0, 0, 0, 0);
            chart.zoomOutButton.disabled = true;

            chart.data = [];

            const dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            dateAxis.renderer.grid.template.location = 0;
            dateAxis.renderer.minGridDistance = 30;
            dateAxis.dateFormats.setKey("second", "ss");
            dateAxis.periodChangeDateFormats.setKey("second", "[bold]h:mm a");
            dateAxis.periodChangeDateFormats.setKey("minute", "[bold]h:mm a");
            dateAxis.periodChangeDateFormats.setKey("hour", "[bold]h:mm a");
            dateAxis.renderer.inside = true;
            dateAxis.renderer.axisFills.template.disabled = true;
            dateAxis.renderer.ticks.template.disabled = true;

            const valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.tooltip.disabled = true;
            valueAxis.interpolationDuration = 500;
            valueAxis.rangeChangeDuration = 500;
            valueAxis.renderer.inside = true;
            valueAxis.renderer.minLabelPosition = 0.05;
            valueAxis.renderer.maxLabelPosition = 0.95;
            valueAxis.renderer.axisFills.template.disabled = true;
            valueAxis.renderer.ticks.template.disabled = true;

            const series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.dateX = "date";
            series.dataFields.valueY = "value";
            series.interpolationDuration = 500;
            series.defaultState.transitionDuration = 0;
            series.tensionX = 0.8;

            chart.events.on("datavalidated", () => {
                dateAxis.zoom({ start: 1 / 15, end: 1.2 }, false, true);
            });

            dateAxis.interpolationDuration = 500;
            dateAxis.rangeChangeDuration = 500;

            document.addEventListener("visibilitychange", () => {
                if (document.hidden) {
                    if (interval) {
                        clearInterval(interval);
                    }
                }
                else {
                    startInterval();
                }
            }, false);

            // add data
            let interval;
            function startInterval() {
                interval = setInterval(() => {
                    $.ajax({
                        url: "{{ route('telemetryData', $id) }}",
                        success: data => {
                            const cpuData = data.cpu[0];
                            chart.addData({data: new Date(cpuData.ts), value: cpuData.value}, 1);
                        }
                    });
                }, 1000);
            }

            startInterval();

            // all the below is optional, makes some fancy effects
            // gradient fill of the series
            series.fillOpacity = 1;
            const gradient = new am4core.LinearGradient();
            gradient.addColor(chart.colors.getIndex(0), 0.2);
            gradient.addColor(chart.colors.getIndex(0), 0);
            series.fill = gradient;

            // this makes date axis labels to fade out
            dateAxis.renderer.labels.template.adapter.add("fillOpacity", (fillOpacity, target) => target.dataItem.position);

            // need to set this, otherwise fillOpacity is not changed and not set
            dateAxis.events.on("validated", () => {
                am4core.iter.each(dateAxis.renderer.labels.iterator(), label => {
                    label.fillOpacity = label.fillOpacity;
                });
            });

            // this makes date axis labels which are at equal minutes to be rotated
            dateAxis.renderer.labels.template.adapter.add("rotation", (rotation, target) => {
                const dataItem = target.dataItem;
                if (dataItem.date && dataItem.date.getTime() === am4core.time.round(new Date(dataItem.date.getTime()), "minute").getTime()) {
                    target.verticalCenter = "middle";
                    target.horizontalCenter = "left";
                    return -90;
                }
                else {
                    target.verticalCenter = "bottom";
                    target.horizontalCenter = "middle";
                    return 0;
                }
            });

            // bullet at the front of the line
            const bullet = series.createChild(am4charts.CircleBullet);
            bullet.circle.radius = 5;
            bullet.fillOpacity = 1;
            bullet.fill = chart.colors.getIndex(0);
            bullet.isMeasured = false;

            series.events.on("validated", () => {
                bullet.moveTo(series.dataItems.last.point);
                bullet.validatePosition();
            });
        }); // end am4core.ready()
    </script>
@endsection
