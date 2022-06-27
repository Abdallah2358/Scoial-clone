 @extends('layout')
 @section('content')
     <main class="px-3">
         <form method="POST" action=
         @if ($back??'')
         "{{$back}}"
             @else
            "{{url()->full()}}"
         @endif
         
         >
            @csrf

             <div class="form-group">
                 <label for="post" class="form-control m-3">New Post</label>
                 <textarea id="post"  class="form-control m-3" name="post" rows="4" cols="50"  maxlength="1000"></textarea>
             </div>
              <button type="submit" class="btn btn-white bg-white m-2">Submit</button>
         </form>
     </main>
 @endSection
