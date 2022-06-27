 @extends('layout')
 @section('content')
     <main class="px-3">
         <form method="POST" action="/comment/create">
             @csrf
             <input name="user" type="hidden" value="{{ $user }}">
             <input name="post" type="hidden" value="{{ $post}}">
             <div class="form-group">
                 <label for="comment" class="form-control m-3">comment Post</label>
                 <textarea id="comment" class="form-control m-3" name="comment" rows="4" cols="50" maxlength="1000">{{$comment ?? ''}}</textarea>
             </div>
             <button type="submit" class="btn btn-white bg-white m-2">Submit</button>
         </form>
     </main>
 @endSection
