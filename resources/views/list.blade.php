@extends('home')
    @section('link')
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href= "{{asset('css/app.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    
    @endsection


    @section('content')

    <h1> Your personal wishlist </h1>
   
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-3 col-lg-6">
                    <div class="panel panel-primary">
                            <div class="panel-heading">
                              <h3 class="panel-title">Wishlist <a href="" id="addNew" class="pull-right" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"></i> </a> </h3>
                            </div>
                            <div class="panel-body" id="items">

                                    <ul class="list-group">
                                        @foreach ($items as $item)
                                    <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal" >{{ $item->item}}
                                    <input type="hidden" id='itemId' value={{$item->id}}>
                                    </li>
                                        
                                        @endforeach
                                     </ul>
                            </div>
                          </div>
                          
            </div>

            <div class="col-lg-2">
                <input type="text" class="form-control" name="searchItem" id="searchItem" placeholder="Search" >
            </div>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="title">Add new wish</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id">
                          <p><input type="text" placeholder="Your wish" id="addItem" class="form-control"></p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-warning" data-dismiss="modal" id="delete" style="display:none">Delete</button>
                          <button type="button" class="btn btn-primary" data-dismiss="modal" id="saveChanges">Save changes</button>
                          <button type="button" class="btn btn-primary" data-dismiss="modal" id="AddButton">Add Item</button>
                        </div>
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
            
        </div>
    </div>



    {{ csrf_field() }}

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script> 
    $(document).ready(function(){
        $(document).on('click', '.ourItem', function(event) {
    
            
            var text= $(this).text();
            var id= $(this).find('#itemId').val();
            var text=$.trim(text);
            $('#title').text('Edit Item');
            $('#addItem').val(text);
            $('#delete').show('400');
            $('#saveChanges').show('400');
            $('#AddButton').hide('400');
            $('#id').val(id);
            console.log(text);
    
    });
    $(document).on('click', '#addNew', function(event) {

            $('#title').text('Add new wish');
            $('#addItem').val("");
            $('#delete').hide('400');
            $('#saveChanges').hide('400');
            $('#AddButton').show('400');
            
        });

        $('#AddButton').click(function(event){
            var text= $("#addItem").val();
            if(text=="") {
                alert('Please type in a wish');

            }
            else {
                 $.post('list', {'text': text, '_token':$('input [name=_token]').val()}, function(data) {

            $('#items').load(location.href+ ' #items');

            console.log(data);
            
                    });
            }
            
            });
        

           $('#delete').click(function(event){
               var id=$("#id").val();

               $.post('delete', {'id': id, '_token':$('input [name=_token]').val()}, function(data) {
                $('#items').load(location.href+ ' #items');
               console.log(data);

           });
        });

               $('#saveChanges').click(function(event){
               var id=$("#id").val();
               var value= $.trim( $("#addItem").val());

               $.post('update', {'id': id, 'value': value, '_token':$('input [name=_token]').val()}, function(data) {
               $('#items').load(location.href+ ' #items');
               console.log(data);

           });
        });


        $.ajaxSetup({
             headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#searchItem" ).autocomplete({
      source:   'http://127.0.0.1:8000/search'
    });
  } );

     });
    
    </script>
  @endsection
