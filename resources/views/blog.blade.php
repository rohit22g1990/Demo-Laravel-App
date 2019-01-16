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

                    <div class="col-md-7 right">
                           <h3> <a href="{{ route('home') }}" class="btn btn-primary"> Back </a> </h3>
                    </div>
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

                    <div class="container" style="width: 100%;">
                        
                        <div class="row">
                            <div class="col-md-10">
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
                            <div class="col-md-12">

                                {{ $userBlog->description }}

                            </div>
                        </div>

                        <div class="col-md-12" style="text-align: right;color:gray">
                             <b> - Created By {{ $userBlog->name }} on {{ $userBlog->created_at->format('d/m/Y')}} </b>
                        </div>

                        <hr>

                        @foreach( $blogComments as $blogComment )
                            @if( $blogComment->blog_id == $userBlog->id )

                                <span style="color:blue">{{ $blogComment->name ?? 'Anonymous' }}</span> : {{ $blogComment->comment }}

                            @endif
                            <br>
                        @endforeach

                        <form method="POST" action="{{ route('store_comment') }}">
                            {{ csrf_field() }}
                            <br>
                            <div class="comments" style="float:left;width:80%;">

                                <div class="form-group">
                                    <textarea class="form-control" id="comment" placeholder="Enter Comment" name="comment"></textarea>
                                    @if ($errors->has('comment'))
                                        <span class="help-block" style="color:red" >
                                            <strong>{{ $errors->first('comment') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <input type="hidden" name="blog_id" value="{{ $userBlog->id }}">

                            </div>

                            <div class="buttons" style="float:left;margin-left:2%;">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>

                        </form>

                        <br/> <br/>
                    </div>  
                </div>
           </div>
        </div>
    </div>
</div>
@endsection
