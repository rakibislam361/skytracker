<?php

namespace App\Http\Controllers\Frontend;

/**
 * Class HomeController.
 */
use App\Models\Info;
use App\Models\Notice;
class HomeController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }
    public function noticedetails($id)
    {
        $notice=Notice::find($id);
        return view('frontend.content.noticedetails',compact('notice'));
    }
    public function infodetails($id)
    {
        $info=Info::find($id);

        return view('frontend.content.infodetails',compact('info'));
    }
    public function noticeall()
    {
        $notices=Notice::orderBy('id', 'DESC')->get();
        return view('frontend.content.noticeall',compact('notices'));
    }
    public function infoall()
    {
        $infos=Info::orderBy('id', 'DESC')->get();
        return view('frontend.content.infoall',compact('infos'));
    }

}
