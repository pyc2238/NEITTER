@extends('layouts.app')
@section('title')
@lang('inquiry/create.title')
@endsection
@section('ckeditor')
<script src="{{asset('/data/ckeditor/ckeditor.js')}}"></script>
@endsection
@section('content')
<div class="container content">
    <br>
    <h2><b> @lang('inquiry/create.subject')</b></h2>
    <hr>
    <form action="{{route('inquiry.store',['search'=>$search,'where'=>$where,'page'=>$page])}}" method="post" style="margin-top:3%;margin-bottom:3%">
        @csrf
        <table border="2" class="table">
            <tr>
                <td style="text-align:center;"><b> @lang('inquiry/create.write_title')</b></td>
                <td><input type="text" class="form-control" name="title" autocomplete=off required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea name="content" id="content" required></textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace('content', {
                            'filebrowserUploadUrl': '/ckUpload?_token={{csrf_token()}}&type=image&buckets=inquiry_board'
                        });

                    </script>
                </td>
            </tr>
        </table>
        <hr>

        <input class="btn btn-outline-warning float-right" type="button" value=" @lang('inquiry/create.list')" onclick="location.href='{{route('inquiry.index',['search'=>$search,'where'=>$where,'page'=>$page])}}'">
        <input class="btn btn-outline-primary float-right" style="margin-right:1%" type="submit" value=" @lang('inquiry/create.write')" />

        <br>
    </form>
</div>
@endsection
