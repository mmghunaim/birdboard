@csrf
<div class="field mb-6">

    <label class="lable text-sm mb-2 block" for="title">Title</label>

    <div class="control">

        <input 
            type="text" 
            class="input bg-transparent border border-grey-600 rounded p-2 text-xs w-full bg-card " 
            name="title"    
            placeholder="Hmmmm"
            value="{{ $project->title }}" 
            required
        >

    </div>

</div>

<div class="field">

    <label class="lable text-sm mb-2 block" for="description">Description</label>  

    <div class="control">

        <textarea 
            class="input bg-transparent border border-grey-600 rounded p-2 text-xs w-full h-40 bg-card"  
            name="description" 
            placeholder="Feel free to type your description here."
            required
        >
        {{ $project->description }}
        </textarea>

    </div>

</div>

<div class="field">

        <div class="control">

            <button 
                type="submit" 
                class="button is-link mr-2">
                {{ $buttonText }}
            </button>

        <a href="{{ $project->path() }}" class="text-default">Cancel</a>

    </div>

</div>

{{-- @if($errors->any())
    <div class="field mt-6 text-red-600">  
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </div>
@endif --}}
