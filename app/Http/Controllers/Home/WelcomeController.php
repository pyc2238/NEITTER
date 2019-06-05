<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

use App\Models\Communities\Community;
use App\Models\Admins\Admin_Notice;
use App\Models\Penpal\Penpal;


class WelcomeController extends Controller
{


    private $penpalModel            = null;
    private $communityModel         = null;
    private $noticeModel            = null;

    public function __construct(){

        $this->communityModel           = new Community();
        $this->noticeModel              = new Admin_Notice();
        $this->penpalModel              = new Penpal();

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now            = date('Y-m-d');
        $penpals        = $this->penpalModel->
                            with(['user:id,name,gender,country,age,selfPhoto'])
                            ->whereDate('created_at',$now)
                            ->latest()
                            ->take(8)
                            ->get();

        $communities        = $this->communityModel->latest()->take(8)->get();
        $notices            = $this->noticeModel->latest()->take(8)->get();
        

        return view('home.welcome')->with([
            'penpals'       => $penpals,
            'communities'   => $communities,
            'notices'       => $notices,
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
    

}
