@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3> Add Comment to <u><b>{{ $blog->title }}</b></u> Blog </h3>
                </div>
                
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="container">
                    
                    <form method="POST" action="{{ route('store_comment') }}">
                        
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="comment">Description</label>
                            <textarea class="form-control" id="comment" placeholder="Enter Comment" name="comment" style="width:50%;"></textarea>
                            @if ($errors->has('comment'))
                                <span class="help-block" style="color:red" >
                                    <strong>{{ $errors->first('comment') }}</strong>
                                </span>
                            @endif
                        </div>
                        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                        
                        <button type="submit" class="btn btn-default">Submit</button>
                        <a href="{{ route('home') }}" type="cancel" class="btn btn-default">Cancel</a>

                    </form>
                    <br/>
                    
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
