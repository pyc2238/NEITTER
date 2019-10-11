<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

use App\Models\Communities\Community;
use App\Models\Admins\Admin_Notice;
use App\Models\Penpal\Penpal;
use App\Models\Penpal\Sender;
use App\Models\Users\User;


class WelcomeController extends Controller
{


    private $penpalModel            = null;
    private $communityModel         = null;
    private $noticeModel            = null;
    private $senderModel            = null;
    private $userModel              = null;

    public function __construct(){

        $this->communityModel           = new Community();
        $this->noticeModel              = new Admin_Notice();
        $this->penpalModel              = new Penpal();
        $this->senderModel              = new Sender();
        $this->userModel                = new User();

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $now            = date('Y-m-d');
        $koreaPercent   = 0;
        $japanPercent   = 0;
        
        //포인트 상위 유저 5명
        $winners       = $this->userModel
        ->latest('point')
        ->take(5)
        ->get();


        //오늘 만들어진 펜팔
        $penpals        = $this->penpalModel->
                            with(['user:id,name,gender,country,age,selfPhoto'])
                            ->whereDate('created_at',$now)
                            ->latest()
                            ->take(4)
                            ->get();


        // 오늘의 펜팔 수치를 구한다.
        $penpalCounts = $this->penpalModel->whereDate('created_at',$now)->get();

        $japanPenpalCount   = 0;
        $koreaPenpalCount   = 0;
        foreach($penpalCounts as $penpalCounts ){
           if($penpalCounts->user->country == 'jp'){
                $japanPenpalCount += 1;
           }else{
                $koreaPenpalCount += 1;
           }
        }
        
        if($koreaPenpalCount || $japanPenpalCount ){
            $koreaPercent   = (double)sprintf("%2.2f",($koreaPenpalCount / $penpalCounts->count()) * 100);
            $japanPercent   = (double)sprintf("%2.2f",($japanPenpalCount / $penpalCounts->count()) * 100);
        }
        

        
    
        //최근 게시물과 공지사항
        $communities        = $this->communityModel->latest()->take(12)->get();
        $notices            = $this->noticeModel->latest()->take(12)->get();
        

        return view('home.welcome')->with([
            'penpals'           => $penpals,
            'communities'       => $communities,
            'notices'           => $notices,
            'koreaPenpalCount'  => $koreaPenpalCount,
            'japanPenpalCount'  => $japanPenpalCount,
            'koreaPercent'      => $koreaPercent,
            'japanPercent'      => $japanPercent,
            'winners'           => $winners,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //사이트 소개 URL
    public function getIntroduction(){
         return view('home.component.introduction');
    }
    //이용약관 URL
    public function getPolicy(){
        return view('home.component.policy');
    }

    //크리에터 소개 URL
    public function getCreator(){
        return view('home.component.creator');
    }

    //개발자 노트 URL
    public function getDevelopment(){
        return view('home.component.development');
    }

    public function viewImage(Request $request){
        
            return view('home.imageView')->with([
                'image' => $request->image,
            ]);
    }
    

}
