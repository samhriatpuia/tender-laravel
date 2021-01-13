<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">





{{--    Bootstrap style sheet--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Bootstrap 4 link-->
<!--     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    <!-- Bootstrap 4 link end-->

    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script src="js/script.js" type="text/javascript"></script>



    <style>
        body{
            font-size: 16px;
        }
    </style>



<title>@yield('title', 'E-Tender')
</title>


</head>
<body style="background-color: #f3f3f3; font-family: 'Montserrat', sans-serif !important;">

{{-- START   Add by LTP testing purpose--}}


{{--END--}}
    <div style="background-color: #f8f9fa !important;">

    	<div class="container" >
            <nav class="navbar navbar-expand-lg navbar-light bg-light container">
                <a href="{{ route ('home') }}" class="navbar-brand"><img src={{ asset('images/logo.png') }}></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse w-100 order-3" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route ('home') }}">Home <span class="sr-only">(current)</span></a>
                        </li>

                  <!-- Authentication Links -->
                  @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <!-- @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif -->
                    @else
                         <li class="nav-item">
                            <a class="nav-link" href="{{ route ('addtender.index') }}">Add Tender <span class="sr-only">(current)</span></a>
                        </li>

                    @if (Auth::user()->role_id==1 || Auth::user()->role_id==2)
                       <li class="nav-item">
                           <a class="nav-link" href="{{ route('indexedit.index') }}">List Tender</a>
                       </li>
                    @endif


                    @if (Auth::user()->role_id==1)

                       <li class="nav-item">
                           <a class="nav-link" href="{{ route('userList') }}">User List</a>
                       </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>



                            <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{__('Department')}} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                              <!-- ***  Add new dept *** -->

                               <a class="dropdown-item" href="{{ route('reset') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('add-department').submit();">
                                     {{ __('Add Department') }}
                                </a>

                                <form id="add-department" action="{{ route('addnewDept') }}" method="GET" style="display: none;">
                                    @csrf
                                </form>

                                <!-- ***   *** -->


                                <!-- *** List dept *** -->

                               <a class="dropdown-item" href="{{ route('listDepartment') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('list-department').submit();">
                                     {{ __('List Department') }}
                                </a>

                                <form id="list-department" action="{{ route('listDepartment') }}" method="GET" style="display: none;">
                                    @csrf
                                </form>

                                <!-- ***   *** -->



                                </div>

                               </li>



                     @endif
                            &nbsp;&nbsp;&nbsp;
                            <li class="nav-item  border-md-right">

                            </li>

                            &nbsp;&nbsp;&nbsp;
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                              <!-- ***  Change Password *** -->

                              <a class="dropdown-item" href="{{ route('reset') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('change-password').submit();">
                                    {{ __('Change Password') }}
                                </a>

                                <form id="change-password" action="{{ route('reset') }}" method="GET" style="display: none;">
                                    @csrf
                                </form>

                                <!-- ***   *** -->




                            </div>
                        </li>



                    @endguest
                        &nbsp;&nbsp;&nbsp;

                        <li class="nav-item" style="list-style-type:none">
                            <a class="btn btn-primary" href="{{ route ('subscribe.index') }}" style="border-top:20px; float: right;background-color: #05B18B; border: none;" >Subscribe</a>
                        </li>
                    </ul>
                </div>
            </nav>
    	</div>
    </div>
    	<section class="container-fluid">
    		@if(Session::has('msg'))
    			<div class="alert {{Session::get('status')}} alert-dismissible" role="alert">
    				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    				<strong>{!! Session::get("msg") !!}</strong>
    			</div>
    		@endif
    		<div class="content" style="margin-top:10px;">
    			@yield('content')
    		</div>
    	</section>

        <div class="container" style="background-color: white;">
            <div class="row justify-content-start">
                <div class="col-sm-12 col-md-2">
                    <a href="https://india.gov.in" target="_blank"><img src={{ asset('images/india.png') }}></a>
                </div>
                <div class="col-sm-12 col-md-2">
                    <a href="https://www.nvsp.in/" target="_blank"><img src={{ asset('images/osv2.png') }}></a>
                </div>
                <div class="col-sm-12 col-md-2">
                    <a href="https://deity.gov.in/" target="_blank"><img src={{ asset('images/deity.png') }}></a>
                </div>
                <div class="col-sm-12 col-md-2">
                    <a href="https://digitalindia.gov.in/" target="_blank"><img src={{ asset('images/digital.png') }}></a>
                </div>
                <div class="col-sm-12 col-md-2">
                    <a href="https://www.mygov.in/" target="_blank"><img src={{ asset('images/mygov.png') }}></a>
                </div>
                <div class="col-sm-12 col-md-2">
                    <a href="https://mizoramtenders.gov.in/nicgep/app" target="_blank"><img src={{ asset('images/epro.png') }}></a>
                </div>
            </div>
        </div>
<!-- <div class="container">
    <div class="d-flex justify-content-center">


            <div ><a href="https://india.gov.in" target="_blank"><img src={{ asset('images/india.png') }}></a></div>
            <div ><a href="https://www.nvsp.in/" target="_blank"><img src={{ asset('images/osv2.png') }}></a></div>
            <div ><a href="https://deity.gov.in/" target="_blank"><img src={{ asset('images/deity.png') }}></a></div>
            <div ><a href="https://digitalindia.gov.in/" target="_blank"><img src={{ asset('images/digital.png') }}></a></div>
            <div ><a href="https://www.mygov.in/" target="_blank"><img src={{ asset('images/mygov.png') }}></a></div>
            <div ><a href="https://negp.gov.in/" target="_blank"><img src={{ asset('images/nep.png') }}></a></div>
            <div ><a href="https://mizoram.gov.in/" target="_blank"><img src={{ asset('images/mizo.png') }}></a></div>
            <div ><a href="https://mizoramtenders.gov.in/nicgep/app" target="_blank"><img src={{ asset('images/epro.png') }}></a></div>

    </div> -->



    <br>
</div>

<!-- <div class="line"></div> -->
<footer>

    <div class="container footer-nav">
        <div class="nav-list">


            <div class="msegs">
                <p>Crafted with care by <a href="https://msegs.mizoram.gov.in/" target="_blank"> Mizoram State e-Governance Society (MSeGS)</a></p>
                <p>Hosted by <a href="https://dict.mizoram.gov.in/" target="_blank"> Department of ICT</a>, Government of Mizoram</p>
            </div>

        </div>

        <div class="container footer-b ">
            <img src={{ asset('images/footerlinelong.jpg') }} class="line-close">
            <!--img src="images/footerlinelong.jpg" class="line-close"-->
            <img style="height:33px; width:33px" src={{ asset('images/chakra2.svg') }}>
            <img src={{ asset('images/footerlinelong.jpg') }} class="line-close">
        </div>
    </div>
</footer>
<br><br>
<br><br>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
   <!-- <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> -->



   <script type="text/javascript">


$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});




$('#edit').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget)
var name = button.data('myname')
var role = button.data('myrole')
var user_id = button.data('userid')
var password = button.data('password')
var email = button.data('myemail')
var modal = $(this)



modal.find('.modal-body #name').val(name);
modal.find('.modal-body #role').val(role);
modal.find('.modal-body #myid').val(user_id);
modal.find('.modal-body #password').val(password);
modal.find('.modal-body #email').val(email);


})



// $(function(){
// $('.form-group #name').focusout(funtion(){

//     alert("test");
// });

// });




//     $('#edit').validate({
//     rules: {
//       name: {
//         required: true,
//         minlength: 8
//       },
//       action: "required"
//     },
//     messages: {
//       name: {
//         required: "Please enter some data",
//         minlength: "Your data must be at least 8 characters"
//       },
//       action: "Please provide some data"
//     }
//   });








$('#delete').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget)

var user_id = button.data('userid')
var modal = $(this)

modal.find('.modal-body #myid').val(user_id);
})



$('#changePassword').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget)
var password = button.data('password')
var user_id = button.data('userid')
var modal = $(this)


modal.find('.modal-body #myid').val(user_id);
modal.find('.modal-body #mypassword').val(password);

})


//Department List

$('#deleteDept').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget)

var departmentid = button.data('departmentid')
var modal = $(this)

modal.find('.modal-body #mydepartmentid').val(departmentid);
})



$('#editDept').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget)
var departmentid = button.data('departmentid')
var departmentname = button.data('departmentname')
var parent = button.data('parent')

var modal = $(this)

modal.find('.modal-body #mydepartmentname').val(departmentname);
modal.find('.modal-body #myparent').val(parent);
modal.find('.modal-body #mydepartmentid').val(departmentid);

})


//Tender List


$('#delete1').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget)

var tender_id = button.data('tenderid')
var modal = $(this)

modal.find('.modal-body #myid1').val(tender_id);
})



// $('#download').on('show.bs.modal', function (event) {

// var button = $(event.relatedTarget)

// var tender = button.data('tenderdownloads')
// var modal = $(this)

// modal.find('.modal-body #myid').val(user_id);
// })


</script>


</body>
</html>
