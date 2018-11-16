@component('mail::panel')
 Thông tin đơn đặt hàng sô #ĐHMS{{$bill->id}}
 @php
    $categorys = $bill->shoppingcarts();
    $total = 0;
    $total_format = 0;
    if(!empty($categorys)){ 
        //foreach:
        foreach($categorys as $cart){
            $total += (($cart->price)*($cart->qty));
        }
        $total_format = number_format($total);
    }
 @endphp
 <br>
 @component('mail::table')
    | Tên sản phẩm  | Số lượng      | Đơn giá      | Tạm tính                  |
    | :-------------| :-------------| :------------|:--------------------------|
    @foreach($categorys as $ct)
    | {{$ct->name}} | {{$ct->qty}}  |{{number_format($ct->price)}}|{{number_format(($ct->qty)*($ct->price))}}|
    @endforeach
 @endcomponent
 <h2 style="font-weight: bold">Tổng tiền: <b style="color: red">{{$total_format}}</b> VNĐ </h2>
 <br>
 Xin cám ơn khách hàng!!
 <br>
 {{ config('app.name') }}
 @component('mail::button', ['url' => 'test.com'])
     Xem đơn hàng 
 @endcomponent
@endcomponent