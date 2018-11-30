@extends('layouts.app')
@section('title')
글작성
@endsection
@section('content')
<div class="container content">
    <br>
    <h2><b>Community-글 작성</b></h2>
    <hr>
    <form action="{{route('community.store',['search'=>$search,'where'=>$where,'page'=>$page])}}" method="post" style="margin-top:3%;margin-bottom:3%">
        @csrf
        <table border="2" class="table">
            <tr>
                <td style="text-align:center;"><b>제목</b></td>
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

        <input class="btn btn-outline-warning float-right" type="button" value="목록" onclick="location.href='{{route('community.index',['search'=>$search,'where'=>$where,'page'=>$page])}}'">
        <input class="btn btn-outline-primary float-right" style="margin-right:1%" type="submit" value="글쓰기" />

        <br>
    </form>
</div>
@endsection
