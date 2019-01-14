@extends('layouts.app')
@section('title')
    @lang('notice/create.title')
@endsection
@section('content')
<div class="container content">
    <br>
    <h2><b> @lang('notice/create.subject')</b></h2>
    <hr>
    <form action="{{route('notice.store',['search'=>$search,'where'=>$where,'page'=>$page])}}" method="post" style="margin-top:3%;margin-bottom:3%">
        @csrf
        <table border="2" class="table">
            <tr>
                <td style="text-align:center;"><b> @lang('notice/create.write_title')</b></td>
                <td><input type="text" class="form-control" name="title" autocomplete=off required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea name="content" id="content" required></textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace('content', {
                            'filebrowserUploadUrl': '/upload.php'
                        });

                    </script>
                </td>
            </tr>
        </table>
        <hr>

        <input class="btn btn-outline-warning float-right" type="button" value=" @lang('notice/create.list')" onclick="location.href='{{route('notice.index',['search'=>$search,'where'=>$where,'page'=>$page])}}'">
        <input class="btn btn-outline-primary float-right" style="margin-right:1%" type="submit" value=" @lang('notice/create.write')" />

        <br>
    </form>
</div>
@endsection
