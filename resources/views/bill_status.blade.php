@extends('layouts.app')

@section('content')
    <div class="container mt-5">
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">All bills</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th style="width: 10px" class="pl-4 pr-4">#</th>
                    <th colspan="3" class="pl-4">Details</th>
                    <th class="pl-4">Total_price</th>
                    <th class="pl-4">Date</th>
                    <th class="pl-4">Status</th>
                </tr>
                </thead>
                <tbody>

                @foreach($listBill as $bill)
                <tr @if($loop->index % 2 == 1) class="table-success" @endif>
                    <td rowspan="{{count($bill->details_bill)}}" class="p-4">{{$loop->index+1}}</td>
                    <td class="pl-4">{{$bill->details_bill[0]->product_name}}</td>
                    <td>{{$bill->details_bill[0]->quantity}}</td>
                    <td class="pr-4">{{$bill->details_bill[0]->price}}</td>

                    <td class="p-4" rowspan="{{count($bill->details_bill)}}"><span>{{number_format($bill->total_price)}} VND</span></td>
                    <td class="p-4" rowspan="{{count($bill->details_bill)}}"><span>{{$bill->created_at}}</span></td>
                    <td class="p-4" rowspan="{{count($bill->details_bill)}}">
                        <div class="progress progress-xs progress-striped active">
                            @if($bill->status<=4)
                            <div class="progress-bar bg-success" style="width: {{((int)$bill->status/4)*100}}%">{{($bill->status)/4*100}}%</div>
                            @else
                                <div class="progress-bar bg-success" style="width: 0%">0%</div>
                            @endif
                        </div>
                        <div>
                            <?php
                            $class = "btn btn-sm ";
                                switch ($bill->status){
                                    case 0:{
                                        $class .= " btn-secondary";
                                        break;
                                    };
                                    case 1:{
                                        $class .= " btn-info";
                                        break;
                                    };
                                    case 2:{
                                        $class .= " btn-warning";
                                        break;
                                    };
                                    case 3:{
                                        $class .= " btn-primary";
                                        break;
                                    };
                                    case 4:{
                                        $class .= " btn-success";
                                        break;
                                    };
                                    case 5:{
                                        $class .= " btn-danger ";
                                        break;
                                    };


                                }
                            ?>
                            <p class="mt-2 <?php echo $class?>">{{$bill->text_status}}</p>

                        </div>
                    </td >
                    @for($i = 1;$i<count($bill->details_bill);$i++)
                        <tr @if($loop->index % 2 == 1) class="table-success" @endif>
                            <td class="pl-4">{{$bill->details_bill[$i]->product_name}}</td>
                            <td>{{$bill->details_bill[1]->quantity}}</td>
                            <td class="pr-4">{{$bill->details_bill[$i]->price}}</td>
                        </tr>
                    @endfor
                </tr>
                @endforeach
                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
    </div>
@endsection
