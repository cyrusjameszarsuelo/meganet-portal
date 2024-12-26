<?php

namespace App\Http\Controllers;

use Dcblogdev\MsGraph\Facades\MsGraph;
use Illuminate\Http\Request;
use App\Models\Meganews;
use App\Models\Megatrivia;
use App\Models\MegagoodVibe;
use App\Models\Megaproject;
use App\Models\BannerQuestion;
use App\Models\BannerQuestionComment;
use App\Models\BannerQuestionLike;
use App\Models\BannerQuestionImage;
use App\Models\User;
use App\Models\Award;
use App\Events\MentionEvent;
use Response;
use File;


class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = MsGraph::get('me');
        $meganews = Meganews::orderBy('created_at', 'DESC')
            ->first();
        $megagoodVibes = MegagoodVibe::orderBy('created_at', 'DESC')
            ->first();
        $megatrivia = Megatrivia::orderBy('created_at', 'DESC')
            ->first();
        $bannerQuestion = BannerQuestion::orderBy('created_at', 'DESC')
            ->first();
        $megaprojects = Megaproject::orderBy('created_at', 'DESC')
            ->first();
        $userList = User::groupBy('name')
            ->get();
        $runningCredit = $this->getRunningCredit();
        $corporateOffice = $this->getCorporateOffice();
        $award = Award::orderBy('created_at', 'DESC')
            ->first();

        // print_r($userList);
        // die();

        return view('pages.meganet')
            ->withUser($user)
            ->withAward($award)
            ->withMeganews($meganews)
            ->withMegatrivia($megatrivia)
            ->withMegaprojects($megaprojects)
            ->withRunningCredit($runningCredit)
            ->withMegagoodVibes($megagoodVibes)
            ->withBannerQuestion($bannerQuestion)
            ->withCorporateOffice($corporateOffice)
            ->withUserList($userList);
    }

    public function ourCompany()
    {
        $user = MsGraph::get('me');
        $corporateOffice = $this->getCorporateOffice();
        $runningCredit = $this->getRunningCredit();


        return view('pages.ourCompany')
            ->withUser($user)
            ->withRunningCredit($runningCredit)
            ->withCorporateOffice($corporateOffice);

    }

    public function ourCompanyDetails()
    {
        $user = MsGraph::get('me');
        $runningCredit = $this->getRunningCredit();

        $corporateOffice = $this->getCorporateOffice();

        return view('pages.ourCompanyDetails')
            ->withUser($user)
            ->withRunningCredit($runningCredit)
            ->withCorporateOffice($corporateOffice);
    }

    public function ourBas()
    {
        $user = MsGraph::get('me');
        $runningCredit = $this->getRunningCredit();

        $corporateOffice = $this->getCorporateOffice();

        return view('pages.ourBAS')
            ->withUser($user)
            ->withRunningCredit($runningCredit)
            ->withCorporateOffice($corporateOffice);
    }

    public function megawideConstruction()
    {
        $user = MsGraph::get('me');
        $runningCredit = $this->getRunningCredit();

        $corporateOffice = $this->getCorporateOffice();

        return view('pages.megawideConstruction')
            ->withUser($user)
            ->withRunningCredit($runningCredit)
            ->withCorporateOffice($corporateOffice);
    }

    public function storeMegawideConstructionFiles($file)
    {
        $user = MsGraph::get('me');
        $corporateOffice = $this->getCorporateOffice();
        $runningCredit = $this->getRunningCredit();

        if (File::exists(public_path('megawideConstructionFolder/' . $file . '/'))) {
            $publicFiles = File::allFiles(public_path('megawideConstructionFolder/' . $file . '/'));
        } else {
            $publicFiles = '';
        }

        return view('pages.megawideConstructionFiles')
            ->withFile($file)
            ->withUser($user)
            ->withPublicFiles($publicFiles)
            ->withRunningCredit($runningCredit)
            ->withCorporateOffice($corporateOffice);
    }

    public function pcs()
    {
        $user = MsGraph::get('me');
        $runningCredit = $this->getRunningCredit();

        $corporateOffice = $this->getCorporateOffice();

        return view('pages.pcs')
            ->withUser($user)
            ->withRunningCredit($runningCredit)
            ->withCorporateOffice($corporateOffice);
    }

    public function storePcsFiles($file)
    {

        $user = MsGraph::get('me');
        $corporateOffice = $this->getCorporateOffice();
        $runningCredit = $this->getRunningCredit();

        if (File::exists(public_path('pcsFolder/' . $file . '/'))) {
            $publicFiles = File::allFiles(public_path('pcsFolder/' . $file . '/'));
        } else {
            $publicFiles = '';
        }


        return view('pages.pcsFiles')
            ->withFile($file)
            ->withUser($user)
            ->withPublicFiles($publicFiles)
            ->withRunningCredit($runningCredit)
            ->withCorporateOffice($corporateOffice);
    }

    public function pcsUpload(Request $request, $file)
    {
        $fileName = $request->file('uploads');
        $name = $fileName->getClientOriginalName();
        $fileName->move(public_path('pcsFolder/' . $file), $name);

        return redirect()->back();
    }

    public function megawideConstructionUpload(Request $request, $file)
    {
        $fileName = $request->file('uploads');
        $name = $fileName->getClientOriginalName();
        $fileName->move(public_path('megawideConstructionFolder/' . $file), $name);

        return redirect()->back();
    }

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitBannerComment(Request $request)
    {

        broadcast(new MentionEvent($request->comment))->toOthers();

        $user = MsGraph::get('me');

        $bannerQuestionComment = new BannerQuestionComment;

        $bannerQuestionComment->banner_question_id = $request->banner_question_id;
        $bannerQuestionComment->comment = $request->comment;
        $bannerQuestionComment->user = $user['displayName'];

        $bannerQuestionComment->save();

        if ($request->hasFile('bannerImage')) {
            $filename = cloudinary()->upload(request()->bannerImage->getRealPath())->getSecurePath();

            $bannerQuestionImage = new BannerQuestionImage;

            $bannerQuestionImage->banner_question_comment_id = $bannerQuestionComment->id;
            $bannerQuestionImage->user = $user['displayName'];
            $bannerQuestionImage->image = $filename;

            $bannerQuestionImage->save();

        } else {
            $filename = '';
        }

        return Response::json(
            array(
                'bannerQuestionComment' => $bannerQuestionComment,
                'filename' => $filename
            )
        );

    }

    public function likeBannerComment(Request $request)
    {
        $user = MsGraph::get('me');

        $getBannerQuestionLike = BannerQuestionLike::where('banner_question_id', $request->banner_question_id)
            ->where('banner_question_comment_id', $request->banner_question_comment_id)
            ->where('user', $user['displayName'])
            ->get();

        if ($getBannerQuestionLike->isEmpty()) {
            $bannerQuestionLike = new BannerQuestionLike;

            $bannerQuestionLike->banner_question_id = $request->banner_question_id;
            $bannerQuestionLike->banner_question_comment_id = $request->banner_question_comment_id;
            $bannerQuestionLike->user = $user['displayName'];

            $bannerQuestionLike->save();
        } else {
            $bannerQuestionLike = BannerQuestionLike::where('banner_question_id', $request->banner_question_id)
                ->where('banner_question_comment_id', $request->banner_question_comment_id)
                ->where('user', $user['displayName'])->delete();
        }

        return Response::json($bannerQuestionLike);
    }

    public function removeLikeBannerComment(Request $request)
    {
        $user = MsGraph::get('me');

        $bannerQuestionLike = BannerQuestionLike::where('banner_question_id', $request->banner_question_id)
            ->where('banner_question_comment_id', $request->banner_question_comment_id)
            ->where('user', $user['displayName'])
            ->delete();

        return Response::json($bannerQuestionLike);
    }

    public function updateBannerComment(Request $request)
    {

        $bannerQuestionComments = BannerQuestionComment::find($request->banner_question_id);

        $bannerQuestionComments->comment = $request->comment;

        $bannerQuestionComments->save();

        return redirect()->back();

    }

    // public function getLikesOnComment(Request $request)
    // {
    //     $user = MsGraph::get('me');

    //     $bannerQuestionLike = BannerQuestionLike::where('banner_question_comment_id', $request->banner_question_comment_id)
    //         ->where('user', $user['displayName'])
    //         ->first();

    //     return Response::json($bannerQuestionLike);
    // }

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
    public function destroy(Request $request)
    {
        $bannerQuestionComments = BannerQuestionComment::find($request->banner_question_id)
            ->delete();

        return Response::json($bannerQuestionComments);
    }
}
