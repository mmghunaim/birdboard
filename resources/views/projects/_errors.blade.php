@if($errors->{ $bag ?? 'default' }->any())
    <div class="field mt-6 text-red-600">  
        @foreach($errors->{ $bag ?? 'default' }->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </div>
@endif