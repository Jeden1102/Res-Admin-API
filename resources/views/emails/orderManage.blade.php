@component('mail::message')
# Thank you {{ $info->name }}

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
Thanks for your patience,<br>
Food Penugin Team :)
@endcomponent
