@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <div class="col-md-5">
                       <h3> {{ config( 'app.name', 'Social Media Blogs' ) }} </h3>
                    </div>


                    @if( Auth::user() )
                        <div class="col-md-7 right">
                           <h3> <a href="/new_blog" class="btn btn-primary"> Add new blog </a> </h3>
                        </div>
                    @endif
                    <div class="clearfix"></div>
                    <hr>
                
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>

                    <div class="container" style="width:100%;">
                        @foreach( $userBlogs as $userBlog )
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><b>{{ $userBlog->title }}</b></h4>
                                </div>

                                @if( Auth::user()['role_id'] == config('constants.admin') || Auth::user()['id'] == $userBlog->created_by )
                                <div class="col-md-2">
                                    <a href="{{ route('edit_blog', $userBlog->id ) }}">
                                        edit
                                    </a>    
                                </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-10">

                                    {{ str_limit( strip_tags( $userBlog->description ), 50 ) }}

                                    @if ( strlen( strip_tags($userBlog->description ) ) > 50 )
                                       <a href="{{ route('show_blog', $userBlog->id) }}">Read More</a>
                                    @endif
                                    
                                </div>
                                <div class="col-md-12" style="text-align: right;color:gray">
                                     <b> - Created By {{ $userBlog->name }} on {{ $userBlog->created_at->format('d/m/Y')}} </b>
                                </div>
                                
                            </div>
                            <br><hr>

                        @endforeach
                    </div>  

                    <center>{{$userBlogs->render()}}</center> 

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
