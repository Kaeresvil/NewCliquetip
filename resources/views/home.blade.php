@extends('layouts.app')
<style>

body{
  background: #eee;
}
.date{
  font-size: 11px
}
.post-text{
  font-size: 17px;
 
}
.comcontain{
  width: 100%;
}
.postDiv{
  margin-top: -35px;
  margin-bottom: -35px;
white-space: pre-wrap;
}
.comment-text{
  font-size: 18px
}
.commentbtn{
  border: none;
  background: transparent;
}
.fs-12{
  font-size: 15px;
  float: right;
}
.shadow-none{
  box-shadow: none
}
.name{
  color: #007bff
}
.cursor:hover{color: blue}
.cursor{cursor: pointer}
.textarea{resize: none}



</style>
@section('content')
<div  class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

                <div class="card">
                    <div class="card-header">
                   <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Create
                  </button>

                  @if(Session::get('success'))
                          <div class="alert alert-success fade show mt-2">
                                    {{ Session::get('success')}}
                            </div>
                        @endif
                  @if(Session::get('error'))
                          <div class="alert alert-danger fade show mt-2">
                                    {{ Session::get('error')}}
                            </div>
                        @endif
                        
                    </div>

                <div class="card-body" style="background-color: #1c435a;">
                    <!-- post area -->
                    @if($posts->isNotEmpty())
                    @foreach($posts as $post)
                    
                    <div class="card card-body mb-3 p-3" style="background-color: #fff;">
     

                  <div>
                  <img  class="rounded-circle" style="display:inline-block"src="{{asset('images/cliquetip-logo.png')}}" width="40">
                        <p style="display:inline-block; font-weight: 500;  font-size: 15px" class="sentiment">{{ $post->name}}</p>
                        
                      </div>

                    <h5 class="ml-5" style="font-size:2vw;">{{$post->title}} </h5>
                    <span class="date text-black-50 ml-5 mb-2" style="font-size:.8vw;">Shared publicly - {{ $post->created_at}}</span>
                    <p class="ml-5 mt-1" style="font-size:1.1vw;">{{$post->post}}</p>
                    <hr class="p-0">

                    <h6 class="d-flex justify-content-end m-0 p-0" style="font-size:1vw;">
                       
                    <a style="font-size:1vw; color: #4081c5;" data-url="{{ route('commentshow',$post->id) }}" class="commentbtn like p-2 cursor" value="{{ $post->id}}">
                        Comment
                        </a>
                    </h6>

                    <!-- Comment Collapse -->
                    <!-- <div class="d-flex justify-content-center" >
                        <div class="collapse" id="collapseCommend{{$post->id}}" >
                            <h4 style="font-size:1vw;">No Comments Available</h4>
                        </div>
                    </div> -->
                    <!-- //Comment Collapse -->

                </div>

                        @endforeach
                        @else
                        
                    <div class="card card-body mb-3 p-3" style="background-color: #fff;">
                 
                        <h2>No posts Found</h2>
                        </div>
                        @endif
                      
                   
                  
                
          
    
                            
                  
                   
                </div><!-- End of card body -->

            </div>
        </div>
    </div>



<!-- Modal -->
<div class="modal fade" id="comment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
        <div class="added" >

        </div>
      
        <button type="button" class="btn-close closeCom" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

                       
                                <div class="modal-body">
                              
                                <div class="d-flex flex-row align-items-start mt-1 ">

                                    <div class=" mt-2 comcontain">
                                    <!-- //// fetch comments -->
                                   </div>

                                </div>
                                
                            
                           
                                  <div class="d-flex align-items-start mt-2">
                                <input type="hidden" class="form" name="form2" value="form2">
                                <input  class="postid" name="postid" id="postid" type="hidden"  >
                                    <textarea id="commentArea" class="comment form-control shadow-none textarea" placeholder="Write comment..." name="comment"></textarea>
                                  
                                  </div>
                                  <div class="commentSec">
                                  
                                  </div>

                                  <div class="mt-2 text-right">
                                    <button class="btn btn-primary btn-sm shadow-none postcombtn" type="button" data-url="{{ route('addpost')}}" >Post comment</button>

                                    <button class="btn btn-outline-primary btn-sm ml-1 shadow-none closeCom" data-bs-dismiss="modal" type="button">Cancel</button>
                                </div>

                       
                              

                               
                                </div>
                            
                            </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CREATE A POST</h5>
        <button type="button" class="postClose btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

                        <form action="{{ route('addpost')}}" method="POST">
                        {{ csrf_field() }}
                                <div class="modal-body">
                                <input type="hidden" class="form1" name="form1" value="form1">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control title" name="title" placeholder="TITLE" required>
                                    <div class="titleError"></div>
                                  
                                </div>

                                <div class="form-group ">
                                <textarea class="form-control descrip" name="post" id="exampleFormControlTextarea1"  rows="10" placeholder="DESCIPTION" required></textarea>
                                  
                                <div class="descError"></div>
                            
                                </div>

                            

                                </div>
                            
                                <div class="modal-footer">
                               
                                <button type="submit" id="submit-me" class="btn btn-success btn post" >POST</button>
                                <button type="button" class="postClose btn btn-danger btn" data-bs-dismiss="modal">CANCEL</button>
                                </div>
                          </form>
    </div>
  </div>
</div>

</div>


<script>
$(document).ready(function(){

  setTimeout(function() {
            $(".alert").alert('close');
        }, 4000);


 
  $(".postClose").click(function(){ ////Button post close click
    $('.title').val('');
    $('.descrip').val('');
    $('.titleError').empty()
    $('.descError').empty()

  });
 
  $(".closeCom").click(function(){ ////Button comment close click
    $('#commentArea').val('');
    $('.commentSec').empty()

  });


 
  $(".commentbtn").click(function(){ ////Button comment when click

    var userURL = $(this).data('url');
 
  var commentID = $(this).attr("value");
  $('#postid').val(commentID);


  $.ajax({
    type: "GET",
    url: userURL,
    dataType: "json",
    success: function(response){
      $('#comment').modal('show');
      console.log(response)
      if(response.length == 0){
        $('.comcontain').empty()
        $('.comcontain').append('<h3 class="noavail">No Comments Available!</h3>')
      }else{
        $('.comcontain').empty()
        $.each(response, function(key, item) 
        {
              $('.comcontain').append(' <img class="rounded-circle" src="{{asset('images/cliquetip-logo.png')}}" width="40"><p  class="d-inline comment-text">'+item.comment+'</p><hr>')
        });
      }
    
            
    },
    error: function(res){
     console.log(res)
    },
  });

  });

 

  $(".postcombtn").click(function(e){ ////Button post comment when click
      e.preventDefault();
      var postURL = $(this).data('url');
        // console.log(postURL)
    
       var datas = {
          'form': $('.form').val(),
          'postid': $('.postid').val(),
          'comment': $('.comment').val(),
        }
        console.log(datas)
      

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        })


      $.ajax({
        type: "POST",
        url: postURL,
        data: datas,
        dataType: "json",
        success: function(response){
         console.log(response)
            if(response.status == 400){
              $('.commentSec').empty()
              $('.added').empty()
            $.each(response.errors, function(key, error_val) 
            {
                  $('.commentSec').append(' <span class="text-danger fade show">'+error_val+'</span>')
            });
            }else{

                      $('.comcontain').append(' <img class="rounded-circle" src="{{asset('images/cliquetip-logo.png')}}" width="40"><p  class="d-inline comment-text">'+response.comment+'</p><hr>')
                      $('.noavail').hide()
                      $('.commentSec').empty()
                     
            }
                  
        }

      });
      $('#commentArea').val('');

      });

 

  





  
});

</script>
@endsection
