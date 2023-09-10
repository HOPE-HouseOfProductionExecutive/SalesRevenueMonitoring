@extends('layout.master')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<link rel="stylesheet" href="/assets/css/home/style.css">

<div class="containers">
    <h2>Monthly Report CSO</h2>
    <div class="filters">
        <div class="input-placeholder">
            <input type="checkbox" name="month" id="jan">
            <label for="jan">January</label>
        </div>
        <div class="input-placeholder">
            <input type="checkbox" name="month" id="feb">
            <label for="feb">February</label>
        </div>
        <div class="input-placeholder">
            <input type="checkbox" name="month" id="mar">
            <label for="mar">March</label>
        </div>
        <div class="input-placeholder">
            <input type="checkbox" name="month" id="apr">
            <label for="apr">April</label>
        </div>
        <div class="input-placeholder">
            <input type="checkbox" name="month" id="may">
            <label for="may">May</label>
        </div>
        <div class="input-placeholder">
            <input type="checkbox" name="month" id="jun">
            <label for="jun">June</label>
        </div>
        <div class="input-placeholder">
            <input type="checkbox" name="month" id="jul">
            <label for="jul">July</label>
        </div>
        <div class="input-placeholder">
            <input type="checkbox" name="month" id="aug">
            <label for="aug">August</label>
        </div>
        <div class="input-placeholder">
            <input type="checkbox" name="month" id="sep">
            <label for="sep">September</label>
        </div>
        <div class="input-placeholder">
            <input type="checkbox" name="month" id="oct">
            <label for="oct">October</label>
        </div>
        <div class="input-placeholder">
            <input type="checkbox" name="month" id="nov">
            <label for="nov">November</label>
        </div>
        <div class="input-placeholder">
            <input type="checkbox" name="month" id="dec">
            <label for="dec">December</label>
        </div>
    </div>

    <div class="count-data">
        <div class="data first">
            <h2>New</h2>
            <p>Revenue Earning</p>
            <h3>{{$new}}</h3>
            <p>+{{$countNew}} Users</p>
        </div>
        <div class="data second">
            <h2>Upgrade</h2>
            <p>Revenue Earning</p>
            <h3>{{$upgrade}}</h3>
            <p>+{{$countUpgrade}} Users</p>

        </div>
        <div class="data third">
            <h2>Downgrade</h2>
            <p>Revenue Loss</p>
            <h3>{{$downgrade}}</h3>
            <p>+{{$countDowngrade}} Users</p>

        </div>
        <div class="data fourth">
            <h2>Churn</h2>
            <p>Revenue Loss</p>
            <h3>{{$churn}}</h3>
            <p>+{{$countChurn}} Users</p>

        </div>
    </div>

    <div class="graphic-container">
        <div id="pie" class="left">

        </div>
        <div id="chart" class="right">

        </div>
    </div>

</div>

<script>
    var colors = ['#3E8DF3', '#735EC9', '#96FFCB', '#F3B344', '#EB5564', '#E855EB']

    $.ajax({
        url: '/get/v1/data/revenue/total/spv',
        type: 'GET',
        dataType: 'json',
        success: function (res) {
            let IdrFormatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'IDR',
            });

            var data1 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            var data2 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            var data3 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            var data4 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            var data5 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            var data6 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]

            res.data1.forEach(element => {
                data1[element.month] = element.total
            });
            res.data2.forEach(element => {
                data2[element.month] = element.total
            });
            res.data3.forEach(element => {
                data3[element.month] = element.total
            });
            res.data4.forEach(element => {
                data4[element.month] = element.total
            });
            res.data5.forEach(element => {
                data5[element.month] = element.total
            });
            res.data6.forEach(element => {
                data6[element.month] = element.total
            });

            var options = {
                series: [{
                        name: 'Andry Setiawan',
                        data: data1
                    },
                    {
                        name: 'Debby Tri',
                        data: data2
                    },
                    {
                        name: 'Emihi Rembo',
                        data: data3
                    },
                    {
                        name: 'Fransiscus Yura',
                        data: data4
                    },
                    {
                        name: 'Fredericksen',
                        data: data5
                    },
                    {
                        name: 'Fredy Mercury',
                        data: data6
                    },
                ],
                chart: {
                    type: 'bar',
                    height: 350,
                    width: '100%'
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                title: {
                    text: '2023 Sales Revenue Projection',
                    align: 'center',
                    style: {
                        fontSize: '20px',
                        fontWeight: '700',
                        fontFamily: 'Poppins',
                        color: '#263238'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                        'Nov', 'Dec'
                    ],
                },
                yaxis: {
                    title: {
                        text: 'Revenue (IDR)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return IdrFormatter.format(val) + ""
                        }
                    }
                },
                colors: colors,
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
    });

</script>

<script>
    $.ajax({
        url: '/get/v1/data/revenue/total/spv',
        type: 'GET',
        dataType: 'json',
        success: function (res) {
            var total1 = 0
            var total2 = 0
            var total3 = 0
            var total4 = 0
            var total5 = 0
            var total6 = 0


            res.data1.forEach(element => {
                total1 += parseInt(element.total, 10)
            });
            res.data2.forEach(element => {
                total2 += parseInt(element.total, 10)
            });
            res.data3.forEach(element => {
                total3 += parseInt(element.total, 10)
            });
            res.data4.forEach(element => {
                total4 += parseInt(element.total, 10)
            });
            res.data5.forEach(element => {
                total5 += parseInt(element.total, 10)
            });
            res.data6.forEach(element => {
                total6 += parseInt(element.total, 10)
            });

            var options = {
                // series: [parseInt(res.data1, 10), parseInt(res.data2, 10), parseInt(res.data3, 10), parseInt(res.data4, 10), parseInt(res.data5, 10), parseInt(res.data6, 10)],
                series: [total1, total2, total3, total4, total5, total6],
                chart: {
                    width: '100%',
                    type: 'pie',
                },
                colors: colors,
                title: {
                    text: 'Pie',
                    align: 'center',
                    style: {
                        fontSize: '20px',
                        fontWeight: '700',
                        fontFamily: 'Poppins',
                        color: '#263238'
                    },
                },
                labels: ['Andry Setiawan', 'Debby Tri', 'Emihi Rembo', 'Fransiscus Yura',
                    'Fredericksen', 'Fredy Mercury'
                ],
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new ApexCharts(document.querySelector("#pie"), options);
            chart.render();
        }
    });

</script>


@endsection
