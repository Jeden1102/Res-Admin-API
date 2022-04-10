@component('mail::message')
# Thank you {{ $info['name'] }}
@if($info['action'] == 1)
<div>
    Your order has succesfully confirmed !:)
    <h2 style="color:#F47321">Ordered products:</h2>
    <ul>
    @foreach (json_decode($info['items']) as $item)
        <li> {{ $item->name }} -  {{ $item->size }} - ${{ $item->price }}</li>
    @endforeach
    </ul>
    <hr/>
    <h2 style="color:#F47321">Summary:</h2>
    <p>Summ price : ${{ $info['sumPrice']}}</p>
    <hr/>
    <h2 style="color:#F47321">Delivery:</h2>
    <p>{{ $info['date'] }}, {{ $info['time'] }} </p>
    <p>{{ $info['city'] }}, {{ $info['street'] }} {{ $info['number'] }}  </p>
    @component('mail::button', ['url' => 'https://dominikraducki.works/FoodPenguin/'])
    Food Penguin
    @endcomponent
    <p>If there are any issues with the order please contact us (+48) 77 461 66 12 with the order number : {{ $info['id'] }}</p>
    <hr/>
    <p>
        Please prepare the calculated money.
    </p>
</div>
@elseif($info['action']==3)
<div>
    <h2>Good news ! Your order has just been send, wait for the food and enjoy !</h2>
</div>
@else
<div>
    Your order has been rejected !:(
        Reason:
        {{ $info['info'] }}
    <p>If there are any issues with the order please contact us (+48) 77 461 66 12 with the order number : {{ $info['id'] }}</p>
</div>
@endif
Thanks for your patience,<br>
Food Penugin Team :)
@endcomponent
