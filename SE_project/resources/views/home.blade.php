@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-2">
                <div class="card-header text-white" style="background-color: #378CE7; font-size: 20px;">{{ __('Dashboard') }}</div>

                
                <div class="card-body" style="font-size: 18px;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Welcome to the home page, {{ Auth::user()->name }}</p>
                    
                    <div id="chart1">
                        <script>
                            // ข้อมูลจำนวนการยืมทั้งปี
                            var borrowings = {!! json_encode($borrowings) !!};

                            // แปลงข้อมูลให้อยู่ในรูปแบบที่ Highcharts เข้าใจ
                            var data1 = borrowings.map(function(item) {
                                return [item.month, item.total];
                            });

                            // สร้างแผนภูมิ
                            Highcharts.chart('chart1', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'จำนวนการยืมของทั้งปี'
                                },
                                xAxis: {
                                    type: 'category',
                                    title: {
                                        text: 'เดือน'
                                    }
                                },
                                yAxis: {
                                    title: {
                                        text: 'จำนวน'
                                    }
                                },
                                series: [{
                                    name: 'จำนวนการยืม',
                                    data: data1,
                                    color: '#FFA500' // กำหนดสีส้ม
                                }]
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mt-2">
                <div class="card-header text-white" style="background-color: #378CE7; font-size: 20px;">{{ __('Dashboard') }}</div>

                <div class="card-body" style="font-size: 18px;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Welcome to the home page, {{ Auth::user()->name }}</p>
                    
                    <div id="chart2">
                        <script>
                            // ข้อมูลจำนวนการเบิกทั้งปี
                            var disbursements = {!! json_encode($disbursements) !!};

                            // แปลงข้อมูลให้อยู่ในรูปแบบที่ Highcharts เข้าใจ
                            var data2 = disbursements.map(function(item) {
                                return [item.month, item.total];
                            });

                            // สร้างแผนภูมิ
                            Highcharts.chart('chart2', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'จำนวนการเบิกของทั้งปี'
                                },
                                xAxis: {
                                    type: 'category',
                                    title: {
                                        text: 'เดือน'
                                    }
                                },
                                yAxis: {
                                    title: {
                                        text: 'จำนวน'
                                    }
                                },
                                series: [{
                                    name: 'จำนวนการเบิก',
                                    data: data2,
                                    color: '#008000' // กำหนดสีเขียว
                                }]
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
