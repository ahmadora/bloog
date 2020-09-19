@extends('layouts.layouts')

@section('content')
    <div id="chart" style="height:400px;width: 400px"> </div>
@endsection

@section('scripts')
    <script>
        const cpu = {
            sourceKey: 'cpu',
            data: [],
        };
        const ram = {
            sourceKey: 'ram',
            data: [],
        };
        const temperature = {
            sourceKey: 'temperature',
            data: [],
        }
        let dataset;
        const totalPoints = 100;
        const updateInterval = 500;

        let temp;

        function update(_data) {
            [cpu, ram, temperature].forEach(source => {
                if (source.data.length === totalPoints) {
                    source.data.shift();
                }
                const fetchedData = _data[source.sourceKey][0];
                source.data.push([fetchedData.ts, fetchedData.value]);
            });

            console.log(cpu, ram, temperature);

            //update legend label so users can see the latest value in the legend
            dataset = [
                {
                    label: "CPU:" + _data[cpu.sourceKey][0].value + "%",
                    data: cpu.data,
                    line: {
                        fill: false,
                        lineWidth: 1.0,
                    },
                    color: "#00FF00",
                },
                {
                    label: "RAM:" + _data[ram.sourceKey][0].value + "KB",
                    data: ram.data,
                    line: {
                        fill: false,
                        lineWidth: 1.0,
                    },
                    color: "#0044FF",
                },
                {
                    label: "Temperature:" + _data[temperature.sourceKey][0].value + "C",
                    data: temperature.data,
                    line: {
                        fill: false,
                        lineWidth: 1.0,
                    },
                    color: "#FF0000",
                }
            ];
            $.plot($("#chart"), dataset, {
                type: 'line',
                data:dataset ,
                options: {
                    tooltips: {
                        mode: 'point'
                    }
                }

            });
        }

        function getData() {
            //set no cache
            $.ajaxSetup({cache: false});

            $.ajax({
                url: "{{ route('telemetryData', $id) }}",
                dataType: 'json',
                success: update,  //if success, call update()
                error: start,
            });
        }

        function start() {
            setInterval(getData, updateInterval);
        }

        $(document).ready(() => {
            start();
        });
    </script>
@endsection
