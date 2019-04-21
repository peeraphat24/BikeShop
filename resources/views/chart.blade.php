@extends('layouts.master')
@section('title') BikeShop | รายงาน @stop

@section('content')
<div class = "container">
    <h1>รายงาน</h1>
    <ul class = "breadcrumb">
        <li><a href="{{URL::to('product')}}">หน้าแรก</a></li>
        <li class = "active">รายงาน</li>
    </ul>
    <div class ="panel panel-default">
        <div class = "panel-heading">
            <div class = "panel-title"><strong>มูลค่าสินค้า</strong></div>
        </div>
        <div class = "panel-body"><canvas id = "myBarChart" height="100"></canvas></div>
    </div>
    <script>
        $.get("/api/product/chart/list",function(response)
        {
        var ctx = document.getElementById("myBarChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: response.product_names,
                datasets:[{
                    label:'# of ราคาขาย',
                    data: response.product_prices,
                    
                    backgroundColor: [
                            'rgba(255,99,132,0.2)',
                            'rgba(54,162,235,0.2)',
                            'rgba(255,206,86,0.2)',
                            'rgba(75,192,192,0.2)',
                            'rgba(153,102,255,0.2)',
                            'rgba(255,159,64,0.2)',
                        ],

                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54,162,235,1)',
                            'rgba(255,206,86,1)',
                            'rgba(75,192,192,1)',
                            'rgba(153,102,255,1)',
                            'rgba(255,159,64,1)',
                        ],
                }]
            },
            option: {scales : {yAxes:[{ ticks: {beginAtZero:true} }] }}
        });
    });
    </script>
</div>

<div class ="panel panel-default">
    <div class = "panel-heading">
        <div class = "panel-title"><strong>มูลค่าสินค้าแยกประเภท</strong></div>
    </div>
    <div class = "panel-body"><canvas id = "myPieChart" height="100"></canvas></div>
</div>
<script>
    $.get("/api/category/chart/list",function(response)
    {
    var ctx = document.getElementById("myPieChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets:[{
                data: response.cat_prices,
                backgroundColor: [
                        'rgba(255,99,132,0.2)',
                        'rgba(54,162,235,0.2)',
                        'rgba(255,206,86,0.2)',
                    ], 
            }],
            labels: response.cat_names,
        },
       
    });
});
</script>
</div>
@endsection
