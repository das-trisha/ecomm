<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />

      <title>EComm - One stop shop for all your needs</title>

      <link rel="shortcut icon" href="images/delivery.png" type="x-icon/png">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
   
   </head>
   <body>
      @include('home.header')
      @include('home.product')
      <!-- Comment and reply system starts here -->

      <!-- <div style="text-align:center;padding-bottom:30px;">
         <h1 style="font-size:30px; text-align:center; padding-top:20px; padding-bottom:20px;">Comments</h1>
        
         <form action="{{url('add_comment')}}" method="POST">
            @csrf
            <textarea style="height:150px; width: 600px;" placeholder="Comment something here" name="comment"></textarea>
           <input type="submit" class="btn btn-primary" value="Comment">
         </form>
      </div>
      <div style="padding-left:20%;">
         <h1 style="font-size:20px;padding-bottom:20px;">All Comments</h1>
         @foreach($comment as $comment)
         <div>
            <b>{{$comment->name}}</b>
            <p>{{$comment->comment}}</p>
            <a style="color:blue;"href="javascript::void(0);" onclick="reply(this)" data-Commentid ="{{$comment->id}}">Reply</a>
            @foreach($replies as $reply)
            @if($reply->comment_id == $comment->id)
            <div style="padding-left:3%;padding: bottom 10px;">
            <b>{{$reply->name}}</b>
            <p>{{$reply->reply}}</p>
            <a style="color:blue;" href="javascript::void(0);" onclick="reply(this)" data-Commentid ="{{$comment->id}}">Reply</a>
            </div>
            @endif
            @endforeach
         </div>
         @endforeach
         <div style="display:none;" class="replyDiv">
         <form action="{{url('add_reply')}}" method="POST">
            @csrf
         <input type="text" id = "commentId" name="commentId" id="" hidden="">
            <textarea style="height:100px; width: 500px;" name="reply" placeholder="Write Something here"></textarea>
            <br>
            <button type="submit"  class="btn btn-warning">Reply</button>
            <a href="" class="btn" on-click="reply_close(this)">Close</a>
            </form>
         </div>
      </div> -->
      <!-- Comment and reply system ends here -->

      @include('home.footer')

      <script type="text/javascript">
         function reply(caller){ 
            document.getElementById('commentId').value=$(caller).attr('data-Commentid');
         $('.replyDiv').insertAfter($(caller));
         $('.replyDiv').show();

         }
         function reply_close(caller){  
            $('.replyDiv').hide();
         }
      </script>
      <script>
         document.addEventListener("DOMContentLoaded", function(event) { 
               var scrollpos = localStorage.getItem('scrollpos');
               if (scrollpos) window.scrollTo(0, scrollpos);
         });

         window.onbeforeunload = function(e) {
               localStorage.setItem('scrollpos', window.scrollY);
         };
      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
   </body>
</html>