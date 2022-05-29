
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    .myimg{
        width:130px;
        height:130px;
        object-fit:cover;
        font-size:1vw;
    }
</style>
@endsection


@section('content')
<!-- User Information -->
<div class="d-flex flex-column w-75 container">
    <div class="d-flex justify-content-center">
        <div class="mr-3">
            @if(Auth::user()->prof_image == null)
                <img src="{{ asset('uploads/user/profile.png')}}" class="border img-circle elevation-2 myimg" alt="User Image" style="border-radius: 50%; ">
            @elseif(Auth::user()->prof_image != null)
                <img src="{{ asset('uploads/user/'.(Auth::user()->prof_image))}}" class="border img-circle elevation-2 myimg" alt="User Image" style="border-radius: 50%;">
            @endif
        </div>
        <div class="text-start d-flex align-items-center ml-3">
            <div>
                <h1 class="" style="font-size:2.5vw; color: #64707d;">Name: {{Auth::user()->name}}</h1>
                <h4 class="" style="font-size:1vw; color: #64707d;">Email: {{Auth::user()->email}}</h4>
                <h4  style="font-size:1vw;">
                    <a style="font-size:1vw; color: #4081c5;" data-bs-toggle="collapse" href="#collapse_editProfile" role="button" aria-expanded="false" aria-controls="collapse_editProfile">
                        Edit Profile
                    </a>
                </h4>
            </div>
        </div>
    </div>
    <!-- Edit Profile Collapse -->
    <div class="d-flex justify-content-center" >
        <div class="collapse w-50 " id="collapse_editProfile" >
            <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card card-body mt-3" style="background-color: #1c435a;">
                    <div class="d-flex justify-content-center">
                        <h2 class="text-white" style="font-size:2vw;">User Information</h2>
                    </div>

                    <div class="d-flex justify-content-center mb-4">
                        <div class="w-50">
                            <label for="name" class="input-group text-white" style="font-size:1vw;">{{ __('Name') }}</label>
                            <input style="border-radius: 10px; font-size:1vw;" id="name" type="text" class="form-control @error('name') is-invalid @enderror input-group" value="{{Auth::user()->name}}" name="name" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert" style="font-size:1vw;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mb-4">
                        <div class="w-50 text-white">
                            <label for="profilePicture" class="input-group text-white" style="font-size:1vw;">Profile Picture</label>
                            <input type="file" class="form-control-file" id="profilePicture" name="profilePicture" style="font-size:1vw;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-around">
                        <button data-bs-toggle="collapse" href="#collapse_editProfile" role="button" aria-expanded="false" aria-controls="collapse_editProfile" style="border-radius: 15px; font-size:1vw;" type="button" data-bs-toggle="collapse" class="btn btn-cancel text-white">Cancel</button>
                        <button style="border-radius: 15px; font-size:1vw;" type="submit" class="btn btn-yellow text-white">Update Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- //Edit Profile Collapse -->


    <hr style="height: 2px;">

<!-- delte Modal -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" >
       
      
        <button type="button" class="btn-close closeCom" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

                       
          <div class="modal-body" >
          <h3>Are you sure you want to delete the comment? </h3>
         
          </div>
          <div class="modal-footer" >
                               
                               <button type="submit" id="delete-me" class="btn btn-success btn deletebtn" >YES</button>
                               <button type="button" class="postClose btn btn-danger btn" data-bs-dismiss="modal">NO</button>
                               </div>
    </div>
  </div>
</div>

<!-- delte Modal -->
<!-- delte Modal -->
<div class="modal fade" id="deleteall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" >
       
      
        <button type="button" class="btn-close closeCom" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

                       
          <div class="modal-body" >
          <h3>Are you sure you want to delete all comments? </h3>
         
          </div>
          <div class="modal-footer" >
                               
                               <button type="submit" id="delete-me" class="btn btn-success btn deleteallbtn" >YES</button>
                               <button type="button" class="postClose btn btn-danger btn" data-bs-dismiss="modal">NO</button>
                               </div>
    </div>
  </div>
</div>

<!-- delte Modal -->
    <div>
        <h4 class="fw-bolder" style="font-size:2vw">My Posts</h4>
    </div>
    <div>
        <div class="card card-body" style="background-color: #1c435a;">
            @foreach($posts as $key => $post)
                <div class="card card-body mb-3 p-3" style="background-color: #fff;">
                    <h5 class="m-0" style="font-size:2vw;">{{$post->title}} </h5>
                    <span class="date text-black-50" style="font-size:.8vw;">Shared publicly - {{ $post->created_at}}</span>
                    <p class="m-0 mt-1" style="font-size:1.1vw;">{{$post->post}}</p>
                    <hr class="p-0">

                    <h6 class="d-flex justify-content-end m-0 p-0" style="font-size:1vw;">
                        <a style="font-size:1vw; color: #4081c5;" data-bs-toggle="collapse" href="#collapseCommend{{$post->id}}" role="button" aria-expanded="false" aria-controls="collapseCommend{{$post->id}}">
                        Comment
                        </a>
                    </h6>

                   

                    <!-- Comment Collapse -->
                    <div class="d-flex justify-content-center" >
                        <div class="collapse w-100" id="collapseCommend{{$post->id}}" >
                        <button style="color: red; font-size: 20px;float: left; border: none; background: transparent" class="deleteallRecord " data-id="{{$post->id}}"  data-url="{{ route('allcommentprofBTN',[$post->id])}}" >Delete all</button><br>
                            @foreach($comments[$key] as $key1 => $comment)
                                <div class="p-0 w-100 mt-2">
                                    <h5 style="font-size:1vw">{{$commentNames[$key][$key1]}}: <span>{{$comment->comment}}</span>
                                    <button style="color: red; float: right; border: none; background: transparent" class="deleteRecord mr-2" data-id='{{$comment->id}}' data-url="{{ route('commentprofBTN')}}" >Delete</button>
                                    <hr>
                                    </h5>
                                   
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- //Comment Collapse -->

                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- //User Information -->
<script>
$(document).ready(function(){
    
    $(".deleteRecord").click(function(){
        $('#delete').modal('show');
        var id =  $(this).data("id");
        var comURL =  $(".deleteRecord").data('url');
        console.log(comURL);
    
        $(".deletebtn").click(function(){
          console.log(id)
                var token = $("meta[name='csrf-token']").attr("content");
                var commentID = {
                  "id": id,
                  "_token": token,
              }
      
                $.ajax(
                {
                    url: comURL,
                    type: 'POST',
                    data: commentID,
                    success: function (){
                        console.log("it Works");
                        window.location.reload();

                    
                    }
                });
            
               
              
                });
                });


    $(".deleteallRecord").click(function(){
        $('#deleteall').modal('show');
        var id =  $(this).data("id");
        var comURL =  $(this).data('url');
        console.log(id);
    
        $(".deleteallbtn").click(function(){
          console.log(id)
                var token = $("meta[name='csrf-token']").attr("content");
  
      
                $.ajax(
                {
                    url: comURL,
                    type: 'DELETE',
           
                    success: function (){
                        console.log("it Works");
                        window.location.reload();

                    
                    }
                });
            
               
              
                });
                });

})

</script>
@endsection

@section('js')

@endsection
