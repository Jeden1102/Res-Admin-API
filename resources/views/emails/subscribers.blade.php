@component('mail::message')
# Thank you {{ $info->name }}

Your order has been set, now wait for an conifirmation e-mail, it won't take us more than 10mins to respond.
<b>Notice : This is not an order cofirmation mail</b>
<h2 style="color:#F47321">Ordered products:</h2>
<ul>
@foreach (json_decode($info->items) as $item)
    <li> {{ $item->name }} -  {{ $item->size }} - ${{ $item->price }}</li>
@endforeach
</ul>
<hr/>
<h2 style="color:#F47321">Summary:</h2>
<p>Summ price : ${{ $info->sumPrice }}</p>
<hr/>
<h2 style="color:#F47321">Delivery:</h2>
<p>{{ $info->date }}, {{ $info->time }} </p>
<p>{{ $info->city }}, {{ $info->street }} {{ $info->number  }}  </p>
@component('mail::button', ['url' => 'https://dominikraducki.works/FoodPenguin/'])
Food Penguin
@endcomponent
<hr/>
<p>
    Please prepare the calculated money.
</p>
Thanks for your patience,<br>
Food Penugin Team :)
@endcomponent
