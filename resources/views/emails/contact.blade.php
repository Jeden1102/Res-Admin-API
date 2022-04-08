@component('mail::message')
# Mail from {{ $info->email }}
<hr/>
<p>{{ $info->content }}</p>
<hr/>
Contact Details : 
<p>Name : {{ $info->name }}</p>
<p>Email : {{ $info->email }}</p>
<p>Phone number : {{ $info->phone }}</p>


@endcomponent
